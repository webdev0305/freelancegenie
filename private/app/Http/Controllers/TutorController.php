<?php
namespace App\Http\Controllers;
use App\Http\Requests\ValidationRequest;
use App\Model\Activations;
use App\Model\Category;
use App\Model\CategoryUser;
use App\Model\Country;
use App\Model\Course;
use App\Model\Discipline;
use App\Model\Disciplines;
use App\model\Educations;
use App\model\Jobs;
use App\model\userJobsMeta;
use App\Model\EmailTemplate;
use App\Model\GlobalSettings;
use App\Model\Language;
use App\Model\SwapRequests;
use App\Model\Organisations;
use App\Model\QualifiedLevel;
use App\Model\Skill;
use App\Model\Specialization;
use App\Model\Subscription;
use App\model\TutorProfile;
use App\model\EmployerProfile;
use App\Model\UserJobs;
use App\model\Invoice;
use App\model\Students;
use App\model\UserDoc;
//use App\model\JobDocs;
use App\User;
use DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use PDF;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index()
    {	
        $user_id=\Sentinel::getUser()->id;

		$user_email=\Sentinel::getUser()->email;
        
		$tutor_profile=TutorProfile::where('user_id',$user_id)->first(['certificate_issued']);

		// print_r($tutor_profile);die('here');
		//echo date('Y-m-d',strtotime($tutor_profile->certificate_issued));
		$date_before_year=date('Y-m-d',strtotime("+24 months",strtotime($tutor_profile->certificate_issued)));
		$date_before_sixm=date('Y-m-d',strtotime("+30 months",strtotime($tutor_profile->certificate_issued)));
        $current_date=date('Y-m-d');
		//die('here');
		$dbs_expire=0;
		if($current_date > $date_before_year && $current_date < $date_before_sixm){// send notification before year of expiry
			$dbs_expire=1;
		}
		if($current_date > $date_before_sixm){// send notification before six months of expiry
			$dbs_expire=2;
		}
		//die('working here');
		$jobs = UserJobs::with('userJobs','Students');

		$user= User::whereId($user_id)->first();
        if (!empty(input::get('date'))) {
            $jobs=$jobs->whereHas('Jobs', function($query) {
                $date=input::get('date');
                $query->where('from_date', '<=',$date);
                $query->where('to_date', '>=',$date);
            });
        }
        
        $jobs=$jobs->where('user_id', $user_id)->orderBy('id','desc')->get();
        $job_dates = UserJobs::with('userJobs')->where('user_id', $user_id)->orderBy('id','desc')->get();
        
        $booked_dates ='';
        foreach ($job_dates as $job) {
            if ($job->status == '1') {
                $job_date = explode(',', $job->userJobs->date);
				foreach($job_date as $date){
					$booked_dates .="'".$date."',";			
				}
            }
        }
        return view('web/tutor_dashboard', compact('jobs','booked_dates','user','dbs_expire'));
    }
	public function Swapdata()
    {	
        $user_id=\Sentinel::getUser()->id;
        // var_dump($user_id);die();
        $tutor_request=SwapRequests::with('Jobs','User')->where(['to_tutor_id'=>$user_id,'status'=>0])->get();
        // echo '<pre>';print_r($tutor_request);
        //die;
        return view('web/tutor_swap', compact('tutor_request'));
    }
	public function SwapDetail($id){
        $jobs = Jobs::with('JobDocs')->where(['id'=>$id])->first();
       //echo '<pre>'; print_r($jobs);die;
            $jobs->rate=($jobs->rate > 0)?$jobs->rate:'--';
            $jobs->posted=round((strtotime(date('y-m-d')) - strtotime($jobs->created_at))/86400);
        return View::make('web.swap_detail',compact('jobs'));
    }
	public function JobDetail($id){
        $jobs = Jobs::with('JobDocs')->where(['id'=>$id])->first();
       //echo '<pre>'; print_r($jobs);die;
            $jobs->rate=($jobs->rate > 0)?$jobs->rate:'--';
            $jobs->posted=round((strtotime(date('y-m-d')) - strtotime($jobs->created_at))/86400);
        return View::make('web.job_detail',compact('jobs'));
    }
	public function SetAvailability(Request $request){
		$user_id=\Sentinel::getUser()->id;
		try{
			$user=User::whereId($user_id)->first();
			$user->availability=$request->availability;
			$user->save();
			return Response::json(['success'=>1,'message'=>'Availability changed successfully']);
		}catch(Exception $e){
			return Response::json(['success'=>0,'message'=>$e->getMessage()]);
		}
		
	}
    public function AssignmentLazy(Request $request)
    {
        $data = $request->input();
       
        if(isset($data['limit'])){
            $jobs = Jobs::with('JobDocs')->where([['assignment','!=',"0"],['status','=',"0"]])->skip($data['start'])->take($data['limit']);
            $jobs_count =$jobs->count();
            if($jobs){
                $jobs =$jobs->orderBy('id','desc')->get();
                $i=0;
                foreach($jobs as $job){
                    $jobs[$i]->rate=($job->rate > 0)?$job->rate:'--';
                    $jobs[$i]->posted=round((strtotime(date('y-m-d')) - strtotime($job->created_at))/86400);
                    $jobs[$i]->description=str_limit($job->description,115);
                    $i++;
                }
                }else{
                    $jobs='';
                }
			    //print_r($jobs);die('Working here');
            return Response::json(['success' => '1','jobs_lazy'=>$jobs,'records'=>$jobs_count,'start'=>$data['start'],'limit'=>$data['limit']]);
        }
    }
    public function AssignmentDetail($id)
    {
        $jobs = Jobs::with('JobDocs','EmployerProfile')->where(['id'=>$id])->first();
        // echo '<pre>'; print_r($jobs);die;
        $jobs->rate=($jobs->rate > 0)?$jobs->rate:'--';
        $jobs->posted=round((strtotime(date('y-m-d')) - strtotime($jobs->created_at))/86400);
        return View::make('web.assignment_detail',compact('jobs'));
    }
    public function Assignment(Request $request)
    {
        // die('I am here');
        $data = $request->input();
        
        if (!empty(input::get('date'))) {
            $date=input::get('date');
            //$jobs=$jobs->where(['from_date', '<=',$date,'to_date', '>=',$date]);
            $jobs=Jobs::where([
                ['from_date', '<=',$date],
                ['to_date', '>=',$date],
            ])->orderBy('id','desc')->get();
        }else{
            //$jobs=Jobs::where('assignment',"1")->take(2)->orderBy('id','desc')->get();
            $jobs = DB::table('jobs')->where(['assignment'=>"1",'status'=>"0"])->take(5)->get();
            //$jobs=Jobs::where(['assignment'=>"1",'status'=>"0"])->orderBy('id','desc')->get();
        }
        
        $job_dates=Jobs::where('assignment',"1")->orderBy('id','desc')->get();
        $booked_dates=array();
        foreach($job_dates as $job){
            $date_from = $job->from_date;
            //$date_from = "2010-02-03";   
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
            // Specify the end date. This date can be any English textual format  
            $date_to = $job->to_date; 
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
            // Loop from the start date to end date and output all dates inbetween  
            for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                $booked_dates[]=date("j-n-Y", $i); //print_r($booked_dates);die('I am here'); 
            }
        }
        $booked_dates=array_unique($booked_dates);
        // echo '<pre>';print_r($booked_dates);die;
        return View::make('web.liveassignments',compact('jobs','booked_dates'));
    }
    public function TutorCalendar()
    {
        $jobs = UserJobs::with('userJobs')->where('user_id', \Sentinel::getUser()->id)->orderBy('id','desc')->get();
        //echo '<pre>';print_r($jobs);die('here');
		//$jobs = Jobs::with('userJobsMeta')->where('tutor_id', \Sentinel::getUser()->id)->orderBy('id', 'desc')->get();
		//echo '<pre>';print_r($jobs);die;

        //$status = '0';
        $booked_dates=array();
        foreach($jobs as $job){
        $date_from = $job->userJobs->from_date;
        //$date_from = "2010-02-03";   
        $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
  
        // Specify the end date. This date can be any English textual format  
        $date_to = $job->userJobs->to_date; 
        $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
        
        // Loop from the start date to end date and output all dates inbetween  
        for ($i=$date_from; $i<=$date_to; $i+=86400) {  
            $booked_dates[]=date("j-n-Y", $i); //print_r($booked_dates);die('I am here'); 
        }

        }
        $booked_dates=array_unique($booked_dates);
        //echo '<pre>';print_r($booked_dates);die('I am here');
        // Specify the start date. This date can be any English textual format  

        return view('web/tutor_calendar', compact('booked_dates'));
    }
    public function uploadSubmit(Request $request)
    {
        foreach ($request->photos as $photo) {
            $original=$photo->getClientOriginalName();
            $filename = $photo->store('photos');
            \App\Model\UserDoc::create([
                'user_id' => \Sentinel::getUser()->id,
                'filename' => $filename,
                'originalname' =>$original,
                'global' =>0
            ]);
        }
        Session::flash('success','Upload successful!');
        return Redirect::back();
    }
	public function Invoice($id)
    {
		$invoice=Jobs::with('Invoice')->where('id',$id)->first();
		//echo '<pre>';print_r($invoice);
		return view('web/invoice', compact('invoice'));
	}
	public function JobData(Request $request)
    {	$data = $request->input();
		$job_id=$data['jobid'];
        $jobs = Jobs::where('id', $job_id)->orderBy('id','desc')->first();
		$date = explode(',', str_replace('/', '-', str_replace(' ', '', $jobs->date)));
		//print_r($date);die;
		$current_date=date("d-m-Y");
		if (in_array($current_date, $date)){
				$attended_date=date("d/m/Y");
			}else{
				$attended_date='';
			}
		
		return Response::json(['success' => '1','jobs'=>$jobs,'attended_date'=>$attended_date]);
    }
	public function InsertInvoice(Request $request)
    {	$data = $request->input();
		$invoice=new Invoice;
		$invoice->booking_no=$data['booking_no'];
		$invoice->rate=$data['rate'];
		$invoice->user_id=$data['user_id'];
		$invoice->date=$data['attended'];
		$invoice->save();
        //$jobs = UserJobs::with('userJobs')->where('job_id', $job_id)->orderBy('id','desc')->get();
		//return Redirect::back();
		return Response::json(['success' => '1','message' => 'Record Inserted Successfully']);
    }
    public function InvoiceSent(Request $request)
    {	$data = $request->input();
        //print_r($data);die;
		$invoice_no=mt_rand(1000, 100000);
        $user=User::find($data['tutor_id']);
		//$invoice=Invoice::where('booking_no',$data['jobid'])->first();
		$invoice=Invoice::where(['booking_no'=>$data['jobid'],'invoice_no'=>0]);
		$invoice->update(['sent' => 1, 'invoice_no' => $invoice_no]);
		if($user->fta==1){
		$invoice->update(['fta_deduct' => 1]);
        $user->fta = $user->fta-1;
        $user->save();
        }
		return Response::json(['success' => '1','message' => Config::get('message.options.UPDATE_SUCCESS')]);
    }
    
	public function InsertRegister(Request $request)
    {	$data = $request->input();
        //print_r($data);die;
        $students=Students::where('job_id',$data['job_students'])->first();
        //print_r($students);die('here');
       if($students){
            $students->stuinfo=json_encode($data['stuinfo']);
            $students->save();
        }else{
		$students=new Students;
		$students->stuinfo=json_encode($data['stuinfo']);
        $students->job_id=$data['job_students'];
        $students->save();
       }
		
		return Response::json(['success' => '1','message' => 'Record Inserted Successfully']);
    }
    
    public function StudentsData(Request $request)
    {	$data = $request->input();
		$job_id=$data['jobid'];
        $student = Students::where('job_id', $job_id)->first();
        
		return Response::json(['success' => '1','job_id' =>$job_id,'student'=>json_decode($student->stuinfo)]);
        //return $student;
    }

    public function ChangeJobStatus(Request $request)
    {
        $data = $request->input();
        
        if(isset($data['tutor_id'])){
            $job=new userJobs;
            $job->user_id=$data['tutor_id'];
            $job->job_id=decrypt($data['jobid']);
            $job->status=$data['status'];
            $job->save(); // Tutor Accept job
            $jobs = Jobs::where(['id'=>decrypt($data['jobid'])])->first();
            $jobs->status=$data['status'];
            $jobs->save();
            $email_template=EmailTemplate::first();
            $admin_email=GlobalSettings::where('name','admin_email')->first()->value;
            $tutor_email="krishankmr.bbdit@gmail.com";
		    // Always set content-type for all emails
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <'.$admin_email.'>' . "\r\n";
            $subject = "Assignment Accepted by Tutor on Freelance Genie";  
            $title = '<title>Assignment Accepted</title>';
                //Send Email to Admin				
            $content = "<p>Your assignment has been accepted.</p>
            <p>Please login to your dashboard and confirm the booking.</p>				
            <p>Thanks</p>
            <p>FL Genie</p>";
            $message=str_replace('<title></title>',$title,$email_template->body);
            $message=str_replace('<p></p>',$content,$message);
            // mail($tutor_email, $subject, $message, $headers);
        }else{
            /*$job = UserJobs::find(decrypt($data['jobid']));
            $job->status=$data['status'];
            $job->save();*/
            //echo decrypt($data['jobid']);
            //echo $data['jobid'];die;
            $jobs = Jobs::where(['id'=>$data['jobid']])->first();
            //print_r($jobs);
            //die('here');
            $jobs->status=$data['status'];
            $jobs->save();
        }
        Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));
        // return Redirect::back();
        return Redirect::to('/tutor');
    }
	public function SwapRequest(Request $request)
    {
        $data = $request->input();
		//echo '<pre>';print_r($data);die;
        if(empty($data['tutor_assign'])) {
            return Response::json(['errors' => 'Please select tutor']);
        }
		foreach($data['tutor_assign'] as $tutor_assign){
            $swp_req=new SwapRequests;
            $swp_req->job_id = decrypt($data['job_id']);
            $swp_req->from_tutor_id = $data['tutor_id'];
            $swp_req->to_tutor_id = $tutor_assign;
            $swp_req->save();		
		}
		return Response::json(['success' => '1', 'message' => 'Swap Request Sent Successfully']);
    }

    public function SwapUser(Request $request)
    {
        $data = $request->input();
        if(empty($data['tutor_assign'])) {
            return Response::json(['errors' => 'Please select tutor']);
        }
        $job = Jobs::find($data['job_id']);
        $job->userJobs()->sync($data['tutor_assign']);
		$swap=SwapRequests::where('id',$data['swap_id']);
		$swap->update(['status' => 1]);
        return Response::json(['success' => '1', 'message' => 'Swap Successfully']);
    }
	 /* public function CheckDbs($id)
        {
		 $data[] = ["dbsid"=>15, "dob"=>16           ];
       return  json_encode($data);
       }
	    public function CheckDbs(Request $request)
    {
        $data = $request->input();
        return Response::json(['success' => '1', 'message' => 'Swap Successfully']);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function GetSwap($id)
    {
        $jobs = Jobs::find(decrypt($id));
        
        $qualifiedLevels = QualifiedLevel::find($jobs['qualified_levels_id'])->id;
        $categoriesGet = Category::find($jobs['category_id'])->id;
        $disciplinesGet = Disciplines::find($jobs['sub_disciplines_id'])->id;
		$usersMeta = TutorProfile::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name', 'photo');
        }, 'Disciplines','Categories', 'QualifiedLevel'))->select('id', 'user_id', 'uuid', 'country_id', 'about');

        if (!empty($disciplinesGet)) {
            $usersMeta = $usersMeta->WhereHas('Disciplines', function ($query) use ($disciplinesGet) {
                $query->where('disciplines.id', $disciplinesGet);
            });
        }

        if (!empty($categoriesGet)) {
            $usersMeta = $usersMeta->WhereHas('Categories', function ($query) use ($categoriesGet) {
                $query->where('categories.id', $categoriesGet);
            });
        }

        if (!empty($qualifiedLevels)) {
            $usersMeta = $usersMeta->WhereHas('QualifiedLevel', function ($query) use ($qualifiedLevels) {
                $query->where('qualified_levels.id', $qualifiedLevels);
            });
        }
        $usersMetas = $usersMeta->get();
		//echo '<pre>';print_r($usersMetas);

        foreach ($usersMetas as $usersMeta) {
            if($usersMeta['user']->id != \Sentinel::check()->id) {
           $data[] = [
               "label"=>$usersMeta["user"]->first_name,
               "value"=>$usersMeta["user"]->id,
			   "job_id"=>decrypt($id),
           ];

            }
        }
        return  json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usersMeta = json_decode(json_encode(User::with(['Country', 'TutorProfile', 'Categories', 'OrganisationsWork', 'QualifiedLevel', 'Disciplines', 'TeachingCertificates'])->find(decrypt($id))));
        $categorieUser = empty($usersMeta->categories) ? json_decode(json_encode(array(array('id' => '0', 'name' => '', 'pivot' => array('level' => '')))), false) : $usersMeta->categories;
        $categories = Category::with('children')->get();
        $categoriesSubs = Category::where('status','1')->get();
        $organisations = empty($usersMeta->organisations_work) ? json_decode(json_encode(array(array('id' => '0', 'registration' => '', 'company_name' => ''))), false) : $usersMeta->organisations_work;
        $levels = QualifiedLevel::with('childrenLevels')->orderBy('priority','asc')->get();
        $disciplines = Disciplines::with('childrenDisciplines')->orderBy('priority','asc')->get();
		$subs =  Subscription::with('plan')->whereUserId(decrypt($id))->first();
        $countries = Country::with('children')->get();
        $countryUser[] = '';
        if (isset($usersMeta->country['0'])) {
            foreach ($usersMeta->country as $countryUse) {
                $countryUser[] = $countryUse->id;
            }
        }
		//echo '<pre>';print_r($usersMeta);echo '</pre>';die('here');
        return View('web.tutor_edit', compact('usersMeta','subs', 'categories', 'categorieUser', 'organisations', 'levels', 'disciplines','categoriesSubs', 'countries', 'countryUser'));

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
    public function Freelanceragree()
	{
        $user_id=\Sentinel::getUser()->id;
        $freelancer = \App\Model\About::where("slug","freelancer")->first();
        return view('web/freelancer_agree',compact('user_id', 'freelancer'));
    }
    public function Savecontract(Request $request)

    {
        try {
            $data = $request->input();
            $user_id=\Sentinel::getUser()->id;
            
            TutorProfile::where('user_id', $user_id)->update(['contract' => $data['contract']]);
            
            $date = date("Y-m-d H:i:s");
            $user = User::find($user_id);
            $from_email = $user->email;
          
            $email_template=EmailTemplate::first();
            $admin_email=GlobalSettings::where('name','admin_email')->first()->value;
            $subject = "Service Agreement";  
            $title = '<title>Service Agreement</title>';
            $content = "<p>Dear Freelance Genie I have read your Terms & Conditions carefully and agree with Freelance Genie.</p>
            <p>I have signed in Contract and Send it to you. You can check it on my Profile<br></p>
            <p>Thanks</p>
            <p>".ucfirst($user->first_name) ." ".$user->last_name . "</p>
            <p>".$date."</p>";
            $message=str_replace('<title></title>',$title,$email_template->body);
            $message=str_replace('<p></p>',$content,$message);
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <'.$from_email.'>' . "\r\n";

            // mail($admin_email,$subject,$message,$headers);
            // \Session::flash('success', 'Service Agreement updated and sent successfully');
            
            return Response(array('success' => '1', 'data' => null, 'errors' => null ));
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }

    }
    function tutor_makepdf($id) {
        
        $down = TutorProfile::where('user_id', $id)->first()->contract;
        
        $pdf = [
            'data' => $down,
        ];
        
        $pdf = PDF::loadView('web.freelancer_agree_pdf', $pdf);
        
        return $pdf->download('user'.$id.'-freelanceragreement.pdf');
    }
}
