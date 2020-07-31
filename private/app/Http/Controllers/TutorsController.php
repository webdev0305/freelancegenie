<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Model\Category;
use App\Model\CategoryUser;
use App\Model\Country;
use App\Model\Disciplines;
use App\model\Jobs;
use App\Model\Language;
use App\Model\QualifiedLevel;
use App\model\TutorProfile;
use App\model\EmployerProfile;
use App\Model\EmailTemplate;
use App\Model\GlobalSettings;
use App\Model\SubscriptionLimit;
use App\Model\Subscription;
use App\Model\Plan;
use App\Model\UserJobs;
use App\CreditToken;
use App\Rating;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use View;
use Illuminate\Support\Facades\Session;

class TutorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer', ['except' => ['getOption','getLevelByCat','show']]);
		//$this->middleware('employer', ['except' => ['index', 'show', 'getOption']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 /*  public function checkDbs(Request $request)
    {
        $data = $request->input();
        return Response::json(['success' => '1', 'message' => 'Swap Successfully']);
    }*/
    public function index()
    {
		if(!empty(\Input::get('disciplines'))){
			$options_ids1=array("2","3","4","5","6","7","33","34","35","36","37","38","39","40","41","42","43","44");//Apprenticeships
        $options_ids2=array("9","10","11","12","13","14");// Traineeships
        $options_ids3=array("16","17","18","19");//Apprenticeships
        $options_ids4=array("21","22","23","24");//HR
        $disciplines_id=7;
        if(in_array(\Input::get('disciplines')[0],$options_ids1)){
            $disciplines_id=1;
        }
         if(in_array(\Input::get('disciplines')[0],$options_ids2)){
            $disciplines_id=8;
        }
        if(in_array(\Input::get('disciplines')[0],$options_ids3)){
            $disciplines_id=1;
        }
        if(in_array(\Input::get('disciplines')[0],$options_ids4)){
            $disciplines_id=20;
        }
        if(\Input::get('disciplines')[0]==61){// Social Care
            $disciplines_id=61;
        }
		if(\Input::get('disciplines')[0]==60){// Care Courses
            $disciplines_id=60;
        }
		$categories = Category::with('children')->where('disciplines_id', '=', $disciplines_id)->get();
		//$categories = Category::with('children')->get();
		}else{
		$categories = [];
		}
        $levels = QualifiedLevel::with('childrenLevels')->orderBy('priority', 'asc')->get();
        $disciplines = Disciplines::with('childrenDisciplines')->get();
        $countrys = Country::with('children')->get();
		$tutor_profiles = TutorProfile::distinct()->get(['zip']);//to get dinstinct record

        $usersMeta = TutorProfile::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name', 'photo');

        }, 'Disciplines','Country', 'Categories', 'QualifiedLevel','Rating'))->select('id','zip', 'user_id', 'uuid', 'country_id', 'about', 'status');
        $usersMeta = $usersMeta->WhereHas('User', function ($query) {
                $query->where('users.availability', 1);
            });
		if (!empty(input::get('id'))) {
			$usersMeta=$usersMeta->where('user_id', !empty(input::get('id')) ? input::get('id') : '');

        }

       /*  if (!empty(input::get('zip'))) {
			$usersMeta=$usersMeta->whereIn('zip', !empty(input::get('zip')) ? input::get('zip') : []);

        }*/
		if (!empty(input::get('disciplines'))) {
            $usersMeta = $usersMeta->WhereHas('Disciplines', function ($query) {
                $query->whereIn('disciplines.id', !empty(input::get('disciplines')) ? input::get('disciplines') : []);
            });
        }

        if (!empty(input::get('location'))) {
            $usersMeta = $usersMeta->WhereHas('Country', function ($query) {
                $query->whereIn('countries.id', !empty(input::get('location')) ? input::get('location') : []);
            });
        }
        if (!empty(input::get('specialist'))) {
            $usersMeta = $usersMeta->WhereHas('Categories', function ($query) {
                $query->whereIn('categories.id', !empty(input::get('specialist')) ? input::get('specialist') : []);
            });
        }
		/*if (!empty(input::get('subcat'))) {
            $usersMeta = $usersMeta->WhereHas('Categories', function ($query) {
                $query->whereIn('name', !empty(input::get('subcat')) ? input::get('subcat') : []);
            });
        }*/
        
        if (!empty(input::get('level'))) {
            $usersMeta = $usersMeta->WhereHas('QualifiedLevel', function ($query) {
                $query->whereIn('qualified_levels.id', !empty(input::get('level')) ? input::get('level') : []);
            });
        }


		/*if (!empty(input::get('subcat'))) {
            $usersMeta = $usersMeta->WhereHas('Categories', function ($query) {
                $query->where('id', decrypt(input::get('subcat')));
            });
        }*/

        $usersMeta = $usersMeta->paginate(10)->toArray();
		//dd($usersMeta);

		//$rating = Rating::with('ratings')->where('tutor_id',29)->get();
		//$rating = Rating::find('tutor_id',29);
		//$rating = DB::table('ratings')->where('tutor_id', 29)->get();
		$i=0;
		foreach($usersMeta['data'] as $user){
		$tutor_id=$user['user_id'];
		$rating = DB::select("SELECT COUNT(*) as records,SUM(objectives + delivery + professional + style + paperwork + tutor + training)
		as total FROM ratings WHERE tutor_profile_user_id=$tutor_id");
		if($rating[0]->records >0){
		$star_rating=$rating[0]->total/(7*$rating[0]->records);
		$star_rating = floor(($star_rating * 2) + 0.5) / 2;
		}else{
		$star_rating=0;
		}
		$usersMeta['data'][$i]['rating']=$star_rating;
		foreach($user['categories']  as $categorie){
			$disIds = CategoryUser::where('user_id',$tutor_id)->where('category_id', $categorie['pivot']['category_id'])->first();
			$usersMeta['data'][$i]['rates'][]=$disIds->rate;
		}
		//echo $star_rating;
		$i++;
		}

		//echo '<pre>';print_r($usersMeta['data']);echo '</pre>';die;
        $user = \Sentinel::check();
//        if (empty($user)) {
//            \Session::put('CheckRediraction', $_SERVER['REQUEST_URI']);
//        }

        return View('web.tutor_lists', compact('usersMeta', 'categories', 'disciplines', 'countrys', 'levels', 'tutor_profiles'));
    }
	public function CourseDescription($id)
    {
		//print_r($request->input);die('checking here');
        $categories = Category::where('id',decrypt($id))->first();
		return View::make('web.care_course_description',compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        try {
            $data = $request->input();
            
			if(isset($data['care_tutor'])){ // care trainer
                
                $care_tutor=1;
				$status="1";
                $validation = \Validator::make($request->all(), ValidationRequest::$carejobPost);
                if ($validation->fails()) {
                    $errors = $validation->messages();
                    return Response::json(['errors' => $validation->errors()]);
                }
			}elseif(isset($data['assignment'])){ // Assignment
				$care_tutor=2;
				$status="0";
				$validation = \Validator::make($request->all(), ValidationRequest::$assignmentPost);
					if ($validation->fails()) {
						$errors = $validation->messages();
						return Response::json(['errors' => $validation->errors()]);

					}
			}else{  // Direct tutor booking
				$status="1";
				$validation = \Validator::make($request->all(), ValidationRequest::$jobPost);
				if ($validation->fails()) {
					$errors = $validation->messages();
					return Response::json(['errors' => $validation->errors()]);

				}
				$care_tutor=0;
			}
            /* if ($data['tutor_id'] != '') {
                $ckeJob = Jobs::where('tutor_id', $data['tutor_id'])->where('employer_id', \Sentinel::getUser()->id)->first();
                if (!empty($ckeJob)) {
                    return Response::json(['success' => '2', 'message' => Config::get('message.options.JOBSUBMTD')]);
                }
            }*/
			$user_id =\Sentinel::getUser()->id;
            $jobs = new Jobs;
            $jobs->tutor_id = $data['tutor_id'] == NULL ? NULL : $data['tutor_id'];
			$msg=Config::get('message.options.JOB_SUBMITED');// msg for tutor booking successfully
			if(!$care_tutor){// Direct booking
                $jobs->category_id = $data['specialist'];
                $jobs->qualified_levels_id = $data['qualified_levels'];
                $jobs->sub_disciplines_id = $data['type_levels'];
                $jobs->type = $data['type'];
                $msg=Config::get('message.options.JOB_SUBMITED');// msg for tutor Care Course Tutor booking successfully
			}
            $jobs->rate = $data['rate'];
			$jobs->mileage = $data['mileage'];
            $jobs->wipe_board = $data['wipe_board'];
            $jobs->onsite_projector = $data['onsite_projector'];
            $jobs->flip_chart_and_stand = $data['flip_chart_and_stand'];
            $jobs->disabilities = $data['disabilities'];
            $jobs->equipment_available = $data['equipment_available'];
            $jobs->equipment_available_onsite = $data['equipment_available_onsite'];
			$jobs->equipment_info = isset($data['equipment_info'])?$data['equipment_info']:'';
			$jobs->difficulty_info = isset($data['difficulty_info'])?$data['difficulty_info']:'';
			if($care_tutor == 2){ // For Assignment
                $msg=Config::get('message.options.ASSIGNMENT_SUBMITED');
                $jobs->awarding = $data['awarding'];
                //$data['total']=$data['rate'];
                $data['distance_value']="0";
                if(isset($data['premium'])){
                    $jobs->assignment="2";
                }else{
                    $jobs->assignment="1";
                }
            }
            //$total= $data['total'];
            //$data['total']=$data['rate'];
            // print_r($data);die;
			$jobs->description = $data['description'];
			$jobs->title = $data['title'];
			$jobs->booking_address = $data['booking_address'];
			$jobs->distance = $data['distance_value'];
			$jobs->hotel_charges = 50;

			if($jobs->booking_address){
                $jobs->address = $data['address'];
                $jobs->street_name = $data['street_name'];
                $jobs->city = $data['city'];
                $jobs->country_id = $data['country'];
                $jobs->zip = $data['zip'];
			}
            $jobs->employer_id = $user_id;
            $jobs->date = $data['date'];
			$jobs->time_start = $data['time_start'];
			$jobs->time_end = $data['time_end'];
			//echo '<pre>';print_r($jobs);
            $jobs->status = $status;
			
            if($care_tutor !=2){
                $jobs->total = $data['total'];
            }
            $subs =  Subscription::whereUserId($user_id)->first();

            $SubscriptionLimit = SubscriptionLimit::where('subscription_code',$subs->subscription_code)->first();
            if($care_tutor==2){
				if ($SubscriptionLimit){
					$SubscriptionLimit->assignment=$SubscriptionLimit->assignment+1;
					if(isset($data['premium'])){
					$SubscriptionLimit->premium=$SubscriptionLimit->premium+1;
					}
				}else{
				$SubscriptionLimit =new SubscriptionLimit;
				$SubscriptionLimit->user_id=$user_id;
				$SubscriptionLimit->subscription_code=$subs->subscription_code;
				$SubscriptionLimit->assignment=1;
				if(isset($data['premium'])){
					$SubscriptionLimit->premium=1;
					}
				}
            }else{
                if ($SubscriptionLimit){
                    $SubscriptionLimit->booked=$SubscriptionLimit->booked+1;
                }else{
                    $SubscriptionLimit =new SubscriptionLimit;
                    $SubscriptionLimit->user_id=$user_id;
                    $SubscriptionLimit->subscription_code=$subs->subscription_code;
                    $SubscriptionLimit->booked=1;
                }
            }
			//print_r($jobs);die('working here');
            $SubscriptionLimit->save();
            $jobs->save();
			//$job = Jobs::find($jobs->id); 
            if (Input::hasFile('photos')){  
                try{  
                    foreach ($request->photos as $photo) {
                        $original=$photo->getClientOriginalName();              
                        $filename = $photo->store('photos');             
                        \App\Model\JobDocs::create([ 
                            'job_id' => $jobs->id,             
                            'filename' => $filename,
                            'originalname' =>$original,             
                            'logo'    =>0
                            ]);
                    }                         
                }catch(\Exception $e){// do task when error            
                    die($e->getMessage());
                }   
            }   
            if (Input::hasFile('logo')){  
                $logo=$request->logo;            
                $original=$logo->getClientOriginalName();
                $filename = $logo->store('logo');
                \App\Model\JobDocs::create([
                    'job_id' => $jobs->id,
                    'filename' => $filename,
                    'originalname' =>$original,
                    'logo'    =>1
                ]);
            }

           $jobs->userJobs()->sync($data['tutor_id']);
		   $email_template=EmailTemplate::first();
		   $admin_email=GlobalSettings::where('name','admin_email')->first()->value;
		   $to="krishankmr.bbdit@gmail.com";
		   // Always set content-type for all emails
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <'.$admin_email.'>' . "\r\n";
            $subject = "Freelance Genie Live Assignment";  
            $title = '<title>Freelance Genie Live Assignment</title>';
                //Send Email to Admin				
            $content = "<p>Thanks for posting assignment on Freelance Genie.</p>
                        <p>Our expert frerlancers will accept your assignment shortly.</p>		
            <p>Thanks</p>
            <p>FL Genie</p>";
            $message=str_replace('<title></title>',$title,$email_template->body);
            $message=str_replace('<p></p>',$content,$message);
            // mail($to, $subject, $message, $headers);
			return Response::json(['care_tutor'=>$care_tutor,'job_id'=>$jobs->id,'success' => '1', 'message' => $msg]);

        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }
	
    function CheckLimit(Request $request){
        $data = $request->input();
        $check = $data['check'];
        $user_id=\Sentinel::getUser()->id;
        $subs =  Subscription::with('Plan')->whereUserId($user_id)->first();
        // echo '<pre>';print_r($subs);die('checking here');
        $SubscriptionLimit =  SubscriptionLimit::where('subscription_code',$subs->subscription_code)->first();
        $no_booking=0;
        $no_assignment=0;
        $no_prem_assignment=0;
        if($SubscriptionLimit){
            $no_booking=$SubscriptionLimit->booked;
            $no_assignment=$SubscriptionLimit->assignment;
            $no_prem_assignment=$SubscriptionLimit->premium;
        }
        $allowed_booking=$subs->plan->book_tutor;
        $allowed_assignment=$subs->plan->post_assignment;
        $allowed_prem_assignment=$subs->plan->premium;
        if($check=='booked'){
            if($no_booking >= $allowed_booking){
                return 0;
            }else{
            return 1;
            }
        }else{
            if($no_assignment >= $allowed_assignment){
                return 0;
            }else{
		        if($no_prem_assignment < $allowed_prem_assignment){
			        return 2; //Can post both premium and standard
		        }else{
			        return 1; //Can post only standard
		        }
            }
        }
    }

function GetCoordinates(Request $request)
{
	$data = $request->input();
	$tutor_id=$data['tutor_id'];
	//$tutor_profiles = json_decode(json_encode(User::with(['Country','TutorProfile'])->find($tutor_id)));
	$tutor_profiles = TutorProfile::select('address','city','street_name','country_id','zip')->where('user_id',$tutor_id)->first();
	//echo '<pre>';print_r($tutor_profiles);
	$ohouse_no= $tutor_profiles['address'];
	$ocity=Country::where(['id'=>$tutor_profiles->country_id])->first()->name;
    $ostreet=$tutor_profiles->street_name;
    $ocountry='UK';
	$ozip=$tutor_profiles->zip;
	//$origin = urlencode($house_no.','.$ocity.','.$ostreet.','.$ozip.','.$ocountry);
	$origin = urlencode($ohouse_no.','.$ocity.','.$ostreet.','.$ozip.','.$ocountry);
    //$data['booking_address']=1;
	if($data['address_option']){
		$house_no= $data['address'];
		$city= $data['city'];
		$street= $data['street_name'];
		$country= $data['country'];
		$zip= $data['zip'];
		}else{
		$employer_id=\Sentinel::getUser()->id;
		$employer_profiles = json_decode(json_encode(User::with(['CountryEmployer', 'EmployerProfile'])->find($employer_id)));
	//$employer_profiles = EmployerProfile::select('address','city','street_name','country_id','zip')->where('user_id',$employer_id)->first();
	//echo '<pre>';print_r($employer_profiles);die;
	$house_no= $employer_profiles->employer_profile->company_address;
	$city=Country::where(['id'=>$employer_profiles->employer_profile->comp_country_id])->first()->name;
    $street=$employer_profiles->employer_profile->comp_street_name;
    $country=$employer_profiles->employer_profile->comp_city;
	$zip=$employer_profiles->employer_profile->comp_postcode;
		}
	$destination = urlencode($house_no.','.$city.','.$street.','.$zip.','.$country);
    $url="https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&units=imperial&key=AIzaSyCrnv5HH8NgX42n_80dG61HSgmMouEFfjE";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    //$response_a = json_decode($response);
   // echo '<pre>';print_r($response_a);echo '</pre>';
    //$status = $response_a->status;
	return $response;
}
	public function price_calculation(Request $request)
    {

        try {
            $data = $request->input();
			//print_r($data);
			//return $data['date'];
			$dates=explode('-',$data['date']);
			$date1=strtotime($dates[0]);
			$date2=strtotime($dates[1]);
			$diff=1+floor(($date2 - $date1)/(24*60*60));
			//die($diff);
			return $diff*$data['rate'];
			}catch(\Exception $e){
			die($e->getMessage());
			}
	}
    public function assignnment_price_calculation(Request $request)
    {

        try {
            $data = $request->input();
            $jobs = Jobs::with('userJobsMeta','userJobs','EmployerProfile')->where('id', $data['job_id'])->orderBy('id', 'desc')->first();
            //$jobs['rate']="500";
            $info=[];
			//echo '<pre>';print_r($jobs);die;

			//return $data['date'];
            $total_additional=0;
			$dates=explode(',',$jobs['date']);
			$booking_days=count($dates);
			$cost=$booking_days*$jobs['rate'];
			$info['cost']=$cost;// format no to two deimal place and get float value
			 
            $tutor_id=$jobs->userJobsMeta[0]->user_id;
            //echo $tutor_id;die;
            if($jobs['mileage']){
			$tutor_profiles = TutorProfile::select('address','city','street_name','country_id','zip')->where('user_id',$tutor_id)->first();
            //echo '<pre>';print_r($tutor_profiles);
            $ohouse_no= $tutor_profiles->address;
            $ocity=$tutor_profiles->city;
			$ocity=Country::where(['id'=>$tutor_profiles->country_id])->first()->name;
            $ostreet=$tutor_profiles->street_name;
            $ocountry=$tutor_profiles->city;
            $ozip=$tutor_profiles->zip;
            $origin = urlencode($ohouse_no.','.$ocity.','.$ostreet.','.$ozip.','.$ocountry);
            if($jobs['booking_address']){
                $house_no= $jobs['address'];
                $city= $jobs['city'];
                $street= $jobs['street_name'];
                $country= $jobs['country'];
                $zip= $jobs['zip'];
                }else{// yaha peaddress fetch karna he employer profile include he upar usme se
                $house_no= $jobs->EmployerProfile->company_address;
				$city=Country::where(['id'=>$jobs->EmployerProfile->comp_country_id])->first()->name;
                $street= $jobs->EmployerProfile->comp_street_name;
                $country= $jobs->EmployerProfile->comp_city;
                $zip= $jobs->EmployerProfile->comp_postcode;
                }
				$destination = urlencode($house_no.','.$city.','.$street.','.$zip.','.$country);
            $url="https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&units=imperial&key=AIzaSyCrnv5HH8NgX42n_80dG61HSgmMouEFfjE";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $response_a = json_decode($response);
            $distance=floatval($response_a->rows[0]->elements[0]->distance->text);
			//echo $distance;die('here');
            $time=$response_a->rows[0]->elements[0]->duration->value;
            if($time != "" && $time > 7200){
						$hotel_cost=50*$booking_days;
						$hot_booking_dist=15;
                        $travel_cost=2*$distance*0.30;
                        $info['travel_cost_hot_booking']=2*$booking_days*$hot_booking_dist*0.30;
						$total_additional=$hotel_cost+$travel_cost+$info['travel_cost_hot_booking'];
                        $info['hotel_cost']=$hotel_cost;
                        $info['travel_cost']=number_format($travel_cost,2);

					}else{
						$info['travel_cost']=number_format(2*$booking_days*$distance*0.30,2);
						$total_additional=$info['travel_cost'];

					}
			}
                    $info['total_cost']=$total_additional+$info['cost'];
					$info['include_mileage']=$jobs['mileage'];// IF mileage have to include or exclude
                    $jobs = Jobs::find($data['job_id']);
                    $jobs->total=$info['total_cost'];
                    $jobs->tutor_id=$tutor_id;
                    $jobs->save();
           //echo '<pre>';print_r($info);echo '</pre>';die;
            return json_encode($info);
			}catch(\Exception $e){
			die($e->getMessage());
			}
	}


    private function UploadFile($file)
    {
       $file = $file['file'];
        $filename = time(). '.' . $file->getClientOriginalExtension();
        $file->move(public_path().'/images/job_files/', $filename);
        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
        $user = \Sentinel::check();
		$usersMeta = json_decode(json_encode(User::with(['Country', 'TutorProfile', 'Categories','Disciplines', 'OrganisationsWork', 'QualifiedLevel'])->find(decrypt($id))));
        $array = array();
		//echo '<pre>';print_r($usersMeta);echo '</pre>';
        $ttrLan = json_decode(json_encode(Language::whereIn('id', $usersMeta->tutor_profile->language_id != '' ? unserialize($usersMeta->tutor_profile->language_id) : $array)->get()));
        $ttrLocaWill = json_decode(json_encode(Country::whereIn('id', $usersMeta->tutor_profile->language_id != '' ? unserialize($usersMeta->tutor_profile->travel_location) : $array)->get()));
        //$disciplines = CategoryUser::with('Disciplines')->select('disciplines_id')->where('user_id', decrypt($id))->groupBy('disciplines_id')->get();
       //echo '<pre>';print_r($disciplines);die('working here');echo '</pre>';
		$jobs = json_decode(json_encode(UserJobs::with('userJobs')->where('user_id', decrypt($id))->get()));
		if(!empty(\Input::get('cat_id'))){
		$categories = Category::whereIn('id',\Input::get('specialist'))->get();
		}else{
			$categories=[];
		}
		$dates ='';
        foreach ($jobs as $job) {
            if ($job->status == '1') {
                $job_dates = explode(',', $job->user_jobs->date);
				foreach($job_dates as $date){
					$dates .="'".trim($date)."',";			
				}
            }
        }
		$tutor_id=$usersMeta->id;
		$rating = DB::select("SELECT COUNT(*) as records,SUM(objectives + delivery + professional + style + paperwork + tutor + training)
		as total FROM ratings WHERE tutor_profile_user_id=$tutor_id");
		if($rating[0]->records >0){
		$star_rating=$rating[0]->total/(7*$rating[0]->records);
		$star_rating = floor(($star_rating * 2) + 0.5) / 2;
		}else{
		$star_rating=0;
		}
		$usersMeta->rating=$star_rating;
		return View('web.tutor_view', compact('usersMeta', 'ttrLan', 'ttrLocaWill', 'dates', 'categories'));
    }

    public function getOption(Request $request)
    {
        $data = $request->input();

       if($data['get_option'] == ''){
           return Response::json(['status' => '0']);
       }
	   if(isset($data['tutor_id'])){
        $disIds = CategoryUser::with('Categories')->where('user_id',decrypt($data['tutor_id']))->where('disciplines_id', $data['get_option'])->get();
        foreach ($disIds as $disId) {
            $categories[] = "<option value='" . $disId['categories']->id . "'>" . $disId['categories']->name . "</option>";
//            $qualifiedlevel[] = "<option value='" . $disId['qualifiedlevel']->id . "'> " . $disId['qualifiedlevel']->level . "</option>";
        }
//        , 'qualifiedlevel' => $qualifiedlevel
        return Response::json(['categories' => $categories]);
		}else{
        $options_ids1=array("2","3","4","5","6","7","33","34","35","36","37","38","39","40","41","42","43","44");//Apprenticeships
        $options_ids2=array("9","10","11","12","13","14");// Traineeships
        $options_ids3=array("16","17","18","19");//Apprenticeships
        $options_ids4=array("21","22","23","24");//HR
        $disciplines_id=7;
        if(in_array($data['get_option'],$options_ids1)){
            $disciplines_id=1;
        }
         if(in_array($data['get_option'],$options_ids2)){
            $disciplines_id=8;
        }
        if(in_array($data['get_option'],$options_ids3)){
            $disciplines_id=1;
        }
        if(in_array($data['get_option'],$options_ids4)){
            $disciplines_id=20;
        }
        if($data['get_option']==61){// Social Care
            $disciplines_id=61;
        }
		if($data['get_option']==60){// Care Courses
            $disciplines_id=60;
        }
		$categories = Category::with('children')->where('disciplines_id', '=', $disciplines_id)->get();
		//print_r($categories);die('here');
		if($data['page']=='search_form'){
        $spc='<select class="form-control" name="specialist[]" id="specialist">';		$spc.='<option value="">Select Specialism</option>';
		}
		if($data['page']=='tutor_profile'){
        $spc='<select class="form-control length" name="certificates_categorie['.$data['index_num'].']" id="certificates_'.$data['index_num'].'_categorie">';		$spc.='<option value="">Select Specialism</option>';
		}
		foreach($categories as  $categorieItem){
                     if(isset($categorieItem->children['0'])){
					 $spc.='<optgroup label="'.$categorieItem->name.'"
                                   data-max-options="1">';
                            foreach($categorieItem->children as  $categorieChild){
							//echo $categorieChild->name;
									$spc.='<option value="'.$categorieChild->id.'">'.$categorieChild->name.'</option>';
								}
					 $spc.='</optgroup>';
					 }
					 
                 }
                 $spc.='</select>';
                 
				 
				 //return Response::json(['categories' => $sp,'spl' => $spl]);
                 return $spc;

		}

    }



    public function getLevelByCat(Request $request)
    {
        $data = $request->input();

        if($data['get_option'] == ''){
            return Response::json(['status' => '0']);
        }

        $disIds = CategoryUser::with('QualifiedLevel')->where('user_id',decrypt($data['tutor_id']))->where('category_id', $data['get_option'])->first();

//            $categories[] = "<option value='" . $disId['categories']->id . "'>" . $disId['categories']->name . "</option>";
            $qualifiedlevel = "<option value='" . $disIds['qualifiedlevel']->id . "'> " . $disIds['qualifiedlevel']->level . "</option>";
           $rate = $disIds->rate;
        return Response::json(['qualifiedlevel' => $qualifiedlevel,'rate' => $rate]);


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
