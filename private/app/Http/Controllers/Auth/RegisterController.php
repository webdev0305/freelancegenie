<?php

namespace App\Http\Controllers\Auth;

use Activation;
use App\Http\Controllers\Controller;
use App\Model\Subscription;
use App\Model\GlobalSettings;
use App\Model\EmailTemplate;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Exception;
use Cartalyst\Sentinel\Users\UserInterface;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

//    public function showRegistrationForm()
//    {
//        return view('auth.register');
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        try {
            $data = $request->input();
            
            $validation = Validator::make($data, ValidationRequest::$register);
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }
            //Get and check user data by email
            $userData = User::GetUserByMail($data['email']);



            //Check Email Exit
            if (!empty($userData)) {
                Session::flash('error', Config::get('message.options.REGISTERED_MAIL'));
                //Session::flash('error', 'here');
                return Redirect::back();
            }

            $userData = User::GetUserByMail($data['email']);
            ////Check Email Exit
            if (!empty($userData)) {
                $user = Sentinel::findById($userData->id);
                if (!$activation = Activation::completed($user)) {
                    Session::flash('error', USER_NOT_ACTIVATE);
                    return Redirect::back();
                }
            }
			$credential = [
                'email' => $data['email'],
                'password' => $data['password'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
            ];
           

            $user = \Sentinel::registerAndActivate($credential);
			$email_template=EmailTemplate::first();
			
            if (!empty($user)) {
                $role = \Sentinel::findRoleByName($data["type"]);
                $role->users()->attach($user);
				$admin_email=GlobalSettings::where('name','admin_email')->first()->value;
				$admin_info_email=GlobalSettings::where('name','admin_info_email')->first()->value;
				// Always set content-type for all emails
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <'.$admin_email.'>' . "\r\n";
                if ($data["type"] == 'tutor') {
					$type = new \App\Model\TutorProfile;
                    $type->uuid = mt_rand();
                    $type->user_id = $user->id;
                    $type->save();
					$subs = New Subscription;
                    $subs->plan_id = decrypt($data['planId']);
                    $subs->user_id = $user->id;
					$subs->onaccount = 0;
                    $subs->save();
					$subject = "Tutor Signup";  
					$title = '<title>Tutor Signup</title>';
					 //Send Email to Admin				
					$content = "<p>A Tutor has been Signup.Below are the details:</p>
					Name: ".$data['first_name']." ".$data['last_name']."<br>
					Email: ".$data['email']."<br>				
					<p>Thanks</p>
					<p>FL Genie</p>";
					$message=str_replace('<title></title>',$title,$email_template->body);
					$message=str_replace('<p></p>',$content,$message);
					mail($admin_info_email, $subject, $message, $headers);
					//Send Email to Tutor
					$to = $data['email'];				
					$content = "<p>Welcome ".$data['first_name']." 
					".$data['last_name']."</p>               
					<p>You have successfully sinup with 
					us. Please <a href='http://www.freelancegenie.co.uk/tutorsandtrainersonline/public/login'><span>Login</span></a> and complete your profile.
					Please make sure you have all the necessary document (DL etc)</p>				
					<p>Thanks</p>
					<p>FL Genie</p>";
					$message=str_replace('<title></title>',$title,$email_template->body);
					$message=str_replace('<p></p>',$content,$message);
					// mail($to, $subject, $message, $headers);
				} else {
                    $type = new \App\Model\EmployerProfile;
                    $type->user_id = $user->id;
                    $type->save();
                    $subs = New Subscription;
                    $subs->plan_id = decrypt($data['planId']);
                    $subs->user_id = $user->id;
					$subs->onaccount = 0;
                    $subs->save();
					// $title = '<title>Employer Signup</title>';
					// $subject = "Employer Signup";
     //                //Send Email to Admin
					// $content = 	"<p>An Employer has been Signup.Below are the details:</p>
					// Name: ".$data['first_name']." ".$data['last_name']."<br>
					// Email: ".$data['email']."<br>				
					// <p>Thanks</p>
					// <p>FL Genie</p>";
					// $message=str_replace('<title></title>',$title,$email_template->body);
					// $message=str_replace('<p></p>',$content,$message);                
					// mail($admin_info_email, $subject, $message, $headers);
					// //Send Email to Employer
					// $to = $data['email'];				               
					// $content = "<p>Welcome ".$data['first_name']." 
					// ".$data['last_name']."</p>               
					// <p>You have successfully sinup with 
					// us. Please <a href='http://www.freelancegenie.co.uk/tutorsandtrainersonline/public/login'><span>Login</span></a> and complete your profile.
					// Please make sure you have all the necessary document (DL etc)</p>				
					// <p>Thanks</p>
					// <p>FL Genie</p>";               
					// mail($to, $subject, $message, $headers);
			        return Redirect::to('subscription/'.encrypt($user->id));
                }

                Session::flash('error', Config::get('message.options.REGISTERED_USER'));
            } else {
                Session::flash('error', Config::get('message.options.REGISTERED_NOT_USER'));

            }

            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
