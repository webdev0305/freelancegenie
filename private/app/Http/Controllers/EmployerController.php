<?php namespace App\Http\Controllers;
use App\Http\Requests\ValidationRequest;
use App\Model\Category;
use App\Model\Country;
use App\Model\Disciplines;
use App\model\Jobs;
use App\Model\Language;
use App\Model\QualifiedLevel;
use App\model\TutorProfile;
use App\Model\UserJobs;
use App\User;
use App\Model\EmailTemplate;
use App\Model\Students;
use App\Model\GlobalSettings;
use App\Model\Subscription;
use App\Model\SubscriptionLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use PDF;
use View;
class EmployerController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
	{

    $user_id=\Sentinel::getUser()->id;

        $jobs = Jobs::with('userJobsMeta')->where(['employer_id'=>$user_id, 'assignment'=>"0"])->orderBy('id', 'desc')->get();

        $status = '0';

         $subs =  Subscription::with('plan')->whereUserId($user_id)->first();

         $SubscriptionLimit =  SubscriptionLimit::where('subscription_code',$subs->subscription_code)->first();

         

        //echo '<pre>';

        //print_r($subs);die;



        /*$categories = Category::with('children')->get();

        $levels = QualifiedLevel::with('childrenLevels')->get();

        $disciplines = Disciplines::with('childrenDisciplines')->get();*/

        return view('web/employer_dashboard',compact('jobs','status','subs','SubscriptionLimit'));

    }
    function generatePdf(Request $request) {
        $data = [
            'stuname' => $request->stuname,
            'sirname' => $request->sirname,
            'job_title' => str_replace(',', '', $request->job_title),
            'date' => date("Y-m-d")
        ];

//         $pdf = \App::make('dompdf.wrapper');
// $pdf->loadHTML('<h1>Test</h1>');
// return $pdf->stream();

        $pdf = PDF::loadView('web.certificate_pdf', $data);
        return $pdf->download($request->stuname.'-'.$request->sirname.'-certificate.pdf');
    }
    function viewPdf() {
        return view('web.certificate_pdf');
    }
    public function StudentsData(Request $request)
    {	$data = $request->input();
		$job_id=$data['jobid'];
        $student = Students::with('Jobs')->where('job_id', $job_id)->first();
        $job_title=$student->Jobs->title;
        //echo '<pre>';print_r($student);die('here');
		return Response::json(['success' => '1','job_id' =>$job_id,'job_title' =>$job_title,'student'=>json_decode($student->stuinfo)]);
        //return $student;
    }
	public function ReportProblem(Request $request)
	{
        $data = $request->input();
		$emp=User::whereId(\Sentinel::getUser()->id)->first();
		$email_template=EmailTemplate::first();
		$admin_email=GlobalSettings::where('name','admin_email')->first()->value;
		//$tutor_email="krishankmr.bbdit@gmail.com";
		// Always set content-type for all emails
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$admin_email.'>' . "\r\n";
		$subject = "Employer Report Problem on Freelance Genie";  
		$title = '<title>Report Problem</title>';

			 //Send Email to Admin				
		$content = "<p>Employer have an issue with the tutor booking.</p>
					Employer Name:".$emp->name."<br>Employer Email:".$emp->email."<br>Booking No.".$data['job_id']."
					<p>".$data['comment']."</p>";

			$message=str_replace('<title></title>',$title,$email_template->body);

			$message=str_replace('<p></p>',$content,$message);

			mail($admin_email, $subject, $message, $headers);
        //Session::flash('success', Config::get('message.options.ReportProblem'));
		Session::flash('success', Config::get('Success sent'));
        return Redirect::back();
    }

    public function EmpCalendar()

    {

        $jobs = Jobs::with('userJobsMeta')->where(['employer_id'=>\Sentinel::getUser()->id, 'assignment'=>"0"])->orderBy('id', 'desc')->get();

        $status = '0';

        //echo '<pre>';

        //print_r($jobs);die;



        /*$categories = Category::with('children')->get();

        $levels = QualifiedLevel::with('childrenLevels')->get();

        $disciplines = Disciplines::with('childrenDisciplines')->get();*/

        return view('web/employer_calendar',compact('jobs','status'));

    }

    

    public function CancelJob(Request $request)

    {

        $data = $request->input();

        $jobs = Jobs::where(['id'=>$data['jobid']])->first();

        $jobs->status=$data['status'];

        $jobs->save();

        Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));

        return Redirect::back();

    }

    public function ChangeJobStatus(Request $request)

    {

        $data = $request->input();

        

        $jobs = Jobs::where(['id'=>$data['jobid']])->first();

        //print_r($jobs);die('here');

        if($jobs->status==4){

            Session::flash('success', Config::get('message.options.ALREADY_FTA'));

            return Redirect::back();

        }

        $jobs->status=$data['status'];

        $jobs->save();

       

       

       $tuPro = User::whereId($jobs->tutor_id)->first();

       $tuPro->fta = 1;

       if($tuPro->fta_count==2){

            $tuPro->block=1;

            $tuPro->block_date=date("Y-m-d H:i:s");

       }

       $tuPro->fta_count = $tuPro->fta_count+1;

       $tuPro->save();

       $empPro = User::whereId($jobs->employer_id)->first();

       $empPro->fta_count = $empPro->fta_count+1;

       $empPro->save();

        Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));

        return Redirect::back();

    }

    public function assignments()

    {

		$disciplines = Disciplines::where(['Search_form'=>1])->get();

        $jobs = Jobs::with('userJobsMeta')->where([['employer_id','=',\Sentinel::getUser()->id],['assignment','!=',"0"]])->orderBy('id', 'desc')->get();

        $status = '0';

        return view('web/employer_assignments',compact('jobs','status','disciplines'));

    }

	public function AssignmentLazy(Request $request)

    {

     $data = $request->input();

    if(isset($data['limit'])){

            $jobs = Jobs::with('JobDocs')->where([['employer_id','=',\Sentinel::getUser()->id],['assignment','!=',"0"]])->skip($data['start'])->take($data['limit']);

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

    public function AssignmentDetail($id){

        $jobs = Jobs::with('JobDocs','userJobsMeta')->where(['id'=>$id])->first();

       //echo '<pre>'; print_r($jobs);die;

            $jobs->rate=($jobs->rate > 0)?$jobs->rate:'--';

            $jobs->posted=round((strtotime(date('y-m-d')) - strtotime($jobs->created_at))/86400);

			$status = '0';

        return View::make('web.employer_assignment_detail',compact('jobs','status'));

    }

  

	public function CheckDbs($id)

        {

		$usersMeta = json_decode(json_encode(User::with(['TutorProfile'])->find($id)));

		//print_r($usersMeta);

		 $data[] = [

               "dbs_forename"=>$usersMeta->tutor_profile->dbs_forename,

               "dbs_organisation"=>$usersMeta->tutor_profile->dbs_organisation,

			   "dbs_surname"=>$usersMeta->tutor_profile->dbs_surname,

           ];

       return  json_encode($usersMeta);

       }

	   public function RequestDbsUpdate($id)

        {

		$job = Jobs::find($id);

		$job->dbs = "1";

        //$job->description = "I am here";

        $job->save();

		//print_r($job);

		//die('here');

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

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $usersMeta = json_decode(json_encode(User::with(['CountryEmployer', 'EmployerProfile'])->find(decrypt($id))));

        return View('web.employer_edit', compact('usersMeta'));

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

