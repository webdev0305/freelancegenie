<?php
namespace App\Http\Controllers;

use App\Model\About;
use App\Model\GlobalSettings;
use App\Model\Activations;
use App\Model\Category;
use App\Model\Country;
use App\Model\Disciplines;
use App\Model\QualifiedLevel;
use App\model\TutorProfile;
use App\CreditToken;
use App\User;
use App\Model\Subscription;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use View;


class UserController extends Controller
{

    public function index()

    {
        // die('user cont');

        $categories = Category::with('children')->get();

        $categoriesSubs = Category::where('status','1')->get();

        $levels = QualifiedLevel::with('childrenLevels')->orderBy('priority', 'asc')->get();

        $disciplines = Disciplines::where(['Search_form'=>1])->orderBy('priority','asc')->get();

        $countrys = Country::all();

        $about = About::select('id','shot')->first();

        $tutor_profiles = TutorProfile::distinct()->get(['zip']);

        return View::make('web.index', compact('categories', 'disciplines', 'countrys', 'levels','about','categoriesSubs','tutor_profiles'));

    }

public function quarterly(Request $request)

    {

    try{

        $posts = TutorProfile::all();

        $posts->each(function($post) // foreach($posts as $post) { }

        {

            $tutor_id=$post['user_id'];

            $crtoken = CreditToken::where(['user_id'=>$tutor_id,'token_year'=>date("Y")])->first();

            if($crtoken){

                $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($crtoken->updated_at)));

                if($crtoken && $crtoken->token < 5 && !$crtoken->used && $effectiveDate == date('Y-m-d')){ // Credit token can be 5 in a year

                    $crtoken->token=$crtoken->token+1;

                    $crtoken->updated_at=date('Y-m-d h:i:s');

                    $crtoken->save();

                }

            }

    //do something

        }); die('here');

        }catch(\Exception $e){

        die($e->getMessage());

        }

    }

    /*public function sessionFail(Request $request)

    {

    try{

        $user_id=\Sentinel::getUser()->id;

        $crtoken = CreditToken::where(['user_id'=>$user_id,'token_year'=>date("Y")])->first();

            if($crtoken){

                

                    $crtoken->token=$crtoken->token+1;

                    $crtoken->updated_at=date('Y-m-d h:i:s');

                    $crtoken->save();

                    return Response(array('success' => '1', 'errors' => ''));

                

            }

        }catch(\Exception $e){

        die($e->getMessage());

        }

    }*/

    public function checkSubscriptions()

        {

            $users = User::with('Subscription','plan')->whereHas('roles', function ($q) {

                $q->whereIn('slug', ['employer']);

            })->get();
            $admin_email=GlobalSettings::where('name','admin_email')->first()->value;

            //echo '<pre>';print_r($users);echo '</pre>';die('I am here');

            $users->each(function($user) // foreach($posts as $post) { }

            {

                $subs_end=date('Y-m-d', strtotime(' + '.$user['plan'][0]['duration'], strtotime($user['Subscription']['updated_at'])));

                $subs_30=date('Y-m-d', strtotime(' + '.$user['plan'][0]['duration'].' - 30 days', strtotime($user['Subscription']['updated_at'])));

                $subs_10=date('Y-m-d', strtotime(' + '.$user['plan'][0]['duration'].' - 10 days', strtotime($user['Subscription']['updated_at'])));

                //echo $user['id'].$user['Subscription']['updated_at'].$subs_end.$subs_10.$subs_30;

                //echo $user['id'];echo date('Y-m-d'); echo $subs_10;echo $subs_end;

                if(date('Y-m-d') == $subs_30){

                echo $user['id'];echo 'send a mail before 30 days';

                }

                if(date('Y-m-d') >= $subs_10 && date('Y-m-d') <= $subs_end){

                /*$data=array('email'=>'a@gmail.com','subject'=>'test','name'=>'arjun','body'=>'this is the mail content');

                echo $user->id; echo 'send mails before 10 days';

                \Mail::to('krishankmr.bbdit@gmail.com')->send(new \App\Mail\CheckSubscription($data));*/

                $to = $user->email;

                $subject = "Subscription Expire Notification";



                $message = "

                <html>

                <head>

                <title>Subscription Expire</title>

                </head>

                <body>

                <p>Dear ".$user->first_name ." ".$user->last_name . ", Your Subscription is going to expire on ". $subs_end. ". Please renew your subscription soon.</p>

                <p>Thanks</p>

                <p>FL Genie</p>

                </body>

                </html>

                ";



                // Always set content-type when sending HTML email

                $headers = "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



                // More headers

                $headers .= 'From: <webmaster@example.com>' . "\r\n";

                $headers .= 'Cc: myboss@example.com' . "\r\n";



                mail($to,$subject,$message,$headers);

                }

             echo '<pre>';print_r($user['plan'][0]['duration']);echo '</pre>';

            });

        }



    public function changePassword(Request $request) {

        try {

            $data = $request->input();

            $validation = \Validator::make($data, ValidationRequest::$change_pass);

            if ($validation->fails()) {

                $errors = $validation->messages();

                 return Redirect::back()->with('errors', $errors);

            }

            $hasher = \Sentinel::getHasher();

            $oldPassword = $data['old_password'];

            $password = $data['password'];

            $passwordConf = $data['confirm_password'];

            $user = \Sentinel::getUser();

            if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {

                Session::flash('error', Config::get('message.options.VALID_PASS_MAIL') );

                return Redirect::back();

            }

            \Sentinel::update($user, array('password' => $password));

            \Sentinel::logout();

            Session::flash('success', Config::get('message.options.PAS_CHNGE'));

            return Redirect::to('/login');

        } catch (Exception $ex) {

            return View::make('errors.exception')->with('Message', $ex->getMessage());

        }

    }



    public function activateUsers(Request $request)

    {

        $data = $request->input();

        $user = \Sentinel::findById(decrypt($data['id']));

        $UsrActCkh = Activations::where('user_id', decrypt($data['id']))->first();

        if (empty($UsrActCkh) || $UsrActCkh['completed'] == '0') {

            $ActCode = \Activation::create($user);

            \Activation::complete($user, $ActCode['code']);

        } else {

            \Activation::remove($user);

        }

        return Response(array('success' => '1', 'errors' => ''));





    }

    public function activateOnaccounts(Request $request)

    {

        $data = $request->input();

        $user = \Sentinel::findById(decrypt($data['id']));

        $UsrActCkh = Activations::where('user_id', decrypt($data['id']))->first();

        if (empty($UsrActCkh) || $UsrActCkh['completed'] == '0') {

            $ActCode = \Activation::create($user);

            \Activation::complete($user, $ActCode['code']);

        } else {

            \Activation::remove($user);

        }

        return Response(array('success' => '1', 'errors' => ''));

    }



    public function contactUs(Request $request)

    {

        $data = $request->input();

        $validation = \Validator::make($request->all(), ValidationRequest::$contct);

        if ($validation->fails()) {

            $errors = $validation->messages();

            return Redirect::back()->with('errors', $errors);

        }

        //\Mail::to('krishankmr.bbdit@gmail.com')->send(new \App\Mail\ContactUs($data));

        $to = $admin_email=GlobalSettings::where('name','admin_email')->first()->value;

                $subject = $data['subject'];

                $message = "

                <html>

                <head>

                <title>Contact Request</title>

                </head>

                <body>

                <p>Name: ".$data['name']."<br>".$data['body']."</p>

                <p>Thanks</p>

                <p>FL Genie</p>

                </body>

                </html>";



                // Always set content-type when sending HTML email

                $headers = "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



                // More headers

                $headers .= 'From: <'.$data['email'].'>' . "\r\n";

                mail($to,$subject,$message,$headers);



        Session::flash('success', Config::get('message.options.SUCCESS'));

        return Redirect::back();

    }

    public function Ultimate(Request $request)

    {

        $data = $request->input();

        //die('I am here');

        $validation = \Validator::make($request->all(), ValidationRequest::$enquiry);

        if ($validation->fails()) {

            $errors = $validation->messages();

            return Redirect::back()->with('errors', $errors);

        }

        //\Mail::to('krishankmr.bbdit@gmail.com')->send(new \App\Mail\ContactUs($data));

        $to = $admin_email=GlobalSettings::where('name','admin_email')->first()->value;

                $subject = 'Ultimate Plan Enquiry';

                $message = "

                <html>

                <head>

                <title>Contact Request</title>

                </head>

                <body>

                <p>Name: ".$data['name']."<br>".$data['body']."</p>

                <p>Thanks</p>

                <p>FL Genie</p>

                </body>

                </html>";



                // Always set content-type when sending HTML email

                $headers = "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



                // More headers

                $headers .= 'From: <'.$data['email'].'>' . "\r\n";

               mail($to,$subject,$message,$headers);

        return Response::json(['success' => '1','message'=>'Your request has been submitted successfully.We will contact you shortly.']);



    } 
    public function Settings()
    {
        $settings=GlobalSettings::all();
        return view('admin.settings',compact('settings'));
    }
    public function updateSettings(Request $request)
    {
        $settings=GlobalSettings::where('name',$request->name)->update(['value'=>$request->value]);
        Session::flash('success','Updated successfully');
        return Response(array('success' => '1', 'errors' => ''));
    }



    public function subscribe(Request $request)

    {

        $data = $request->input();

        $validation = \Validator::make($request->all(), ValidationRequest::$forgot_email);

        if ($validation->fails()) {

              return  Config::get('message.options.REQ_MAIL');

        }

        $email = $data['email'];



        // MailChimp API credentials

        $apiKey = 'b68be37a6121571f7b6881d38742ef7f-us18';

        //$apiKey = 'f58126ef0cbfe1c6337a83096fba892c-us3';

        $listID = 'c2e6acc490';



        // MailChimp API URL

        $memberID = md5(strtolower($email));

        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);

        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;



        // member information

        $json = json_encode([

            'email_address' => $email,

            'status'        => 'subscribed',

            'merge_fields'  => [

                'FNAME'     => ''

            ]

        ]);



        // send a HTTP POST request with curl

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);

        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $result = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        //print_r($result);die;



        // store the status message based on response code

        if ($httpCode == 200) {

            echo 'You have successfully subscribed to our news letter.';

        } else {

            switch ($httpCode) {

                case 214:

                    echo    $msg = 'You are already subscribed.';

                    break;

                default:

                    echo     $msg = 'Some problem occurred, please try again.';

                    break;

            }

            print_r($msg);

        }

    }



}

