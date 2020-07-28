<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Input;

Auth::routes();
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/', function () { //basic routing
    $user = Sentinel::check();
    if (!empty($user) && $user != '') {
        if (\Sentinel::getUser()->roles()->first()->slug == 'admin') {
            return Redirect::to('/admin');
        } elseif (\Sentinel::getUser()->roles()->first()->slug == 'tutor') {
            return \Redirect::to('/dashboard');
        } elseif (\Sentinel::getUser()->roles()->first()->slug == 'employer') {
            return Redirect::to('/dashboard');
        }
    }else{
        return Redirect::to('/dashboard');
    }
});

Route::get('/register/{type}/{plan?}', function () { //using basic routing
    return View::make('auth.register');
});
Route::get('/pdf','EmployerController@generatePdf');
Route::get('/viewpdf','EmployerController@viewPdf');
Route::get('/employer_makepdf/{id}','EmployerController@employer_makepdf');
Route::get('/tutor_makepdf/{id}','TutorController@tutor_makepdf');

Route::get('subscription/{id?}', array('as' => 'subscription','uses' => 'AddMoneyController@payWithStripe'));
Route::get('booking/{id?}', array('as' => 'booking','uses' => 'AddMoneyController@payBooking'));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));
Route::post('addmoney/booking', array('as' => 'addmoney.booking','uses' => 'AddMoneyController@postPaymentBooking'));
Route::post('addmoney/onaccount', array('as' => 'addmoney.onaccount','uses' => 'AddMoneyController@onAccount'));
Route::get('/contact-us', function () { //using basic routing
    return View::make('web.contact_us');
});
Route::post('contact_us', 'UserController@contactUs');
Route::post('ultimate', 'UserController@Ultimate');
Route::post('subscribe', 'UserController@subscribe');
Route::get('/about', function () { //using basic routing
    $about = \App\Model\About::first();
    return View::make('web.about', compact('about'));
});
    Route::get('/terms', function () { //using basic routing    
    return View::make('web.termsandcondition'); 
}); 
Route::get('/policy', function () { //using basic routing   
    return View::make('web.privacy_policy');    
});
Route::get('/pricing', function () {
    $pricing = \App\Model\Plan::where("post_assignment",">=","1")->get();
    return View::make('web.pricing',compact('pricing'));
});
Route::get('/courses', function () {
    return View::make('web.courses');
});
Route::get('/care_courses', function () {
$categories = \App\Model\Category::with('children')->where('disciplines_id',60)->get();
    return View::make('web.care_courses',compact('categories'));
});
Route::get('/how_it_works', function () {
    return View::make('web.how_it_works');
});
Route::get('/cookie', 'PagesController@setCookie');

/*Route::get('/course_description', function () {
$categories = \App\Model\Category::with('children')->where('id',input::get('cat_id'))->get();
    return View::make('web.care_course_description',compact('categories'));
});*/
Route::get('/course_description/{id}', 'TutorsController@CourseDescription');

Route::get('/tutor_type', function () {
    $tutor_types = \App\Model\Plan::where("post_assignment","=","0")->get();
    return View::make('web.tutor_type',compact('tutor_types'));
});

Route::get('/faq', function () {
    $tut_faqs_gt = \App\Model\Faq::where(['visible'=>"0",'category'=>1])->get();
	$tut_faqs_pr = \App\Model\Faq::where(['visible'=>"0",'category'=>2])->get();
	$tut_faqs_sw = \App\Model\Faq::where(['visible'=>"0",'category'=>3])->get();
	$tut_faqs_us = \App\Model\Faq::where(['visible'=>"0",'category'=>4])->get();
	$emp_faqs_gt = \App\Model\Faq::where(['visible'=>"0",'category'=>5])->get();
	$emp_faqs_pr = \App\Model\Faq::where(['visible'=>"0",'category'=>6])->get();
	$emp_faqs_sw = \App\Model\Faq::where(['visible'=>"0",'category'=>7])->get();
    $emp_faqs_us = \App\Model\Faq::where(['visible'=>"0",'category'=>8])->get();
    $about = \App\Model\About::where("slug","faq")->first();
    return View::make('web.FAQ', compact('tut_faqs_gt','tut_faqs_pr','tut_faqs_sw','tut_faqs_us','emp_faqs_gt','emp_faqs_pr','emp_faqs_sw','emp_faqs_us','about'));
});
Route::get('employer/faq', function () {
    $faqs = \App\Model\Faq::where('visible',"2")->get();
    $faqs = json_decode(json_encode($faqs));
    return View::make('web.FAQ', compact('faqs'));
});
Route::get('tutor/faq', function () {
    $faqs = \App\Model\Faq::where('visible',"1")->get();
    $faqs = json_decode(json_encode($faqs));
    return View::make('web.FAQ', compact('faqs'));
});



Route::get('/dashboard', 'UserController@index');
Route::get('/quarterly', 'UserController@quarterly');
Route::get('/subs_exp', 'UserController@checkSubscriptions');
Route::post('/sessionfail', 'UserController@sessionFail');
Route::resource('tutors', 'TutorsController');
Route::post('/tutors/price_calculation', 'TutorsController@price_calculation');
Route::post('/tutors/assignnment_price_calculation', 'TutorsController@assignnment_price_calculation');
Route::post('tutors/get_option', 'TutorsController@getOption');
Route::post('tutors/get_level_by_cat', 'TutorsController@getLevelByCat');
Route::post('tutors/get_coordinates', 'TutorsController@GetCoordinates');
Route::post('change_password', 'UserController@changePassword');
Route::post('tutors/check_dbs', 'TutorsController@checkDbs');
Route::post('tutors/check_limit', 'TutorsController@CheckLimit');
Route::resource('rating', 'RatingController');
Route::get('rating', 'RatingController@index');
Route::post('rating/create', 'RatingController@create');
Route::post('rating/store', 'RatingController@store');
Route::get('tutor/assignment', 'TutorController@Assignment');
Route::post('tutor/assignment_lazy', 'TutorController@AssignmentLazy');
Route::get('tutor/detail_assignment/{id}', 'TutorController@AssignmentDetail');
Route::get('tutor/swap_detail/{id}', 'TutorController@SwapDetail');
Route::get('tutor/job_detail/{id}', 'TutorController@JobDetail');
Route::get('employer/detail_assignment/{id}', 'EmployerController@AssignmentDetail');
Route::post('tutor/assignment_lazy', 'TutorController@AssignmentLazy');
Route::post('employer/assignment_lazy', 'EmployerController@AssignmentLazy');
Route::get('tutor/tutor_swap', 'TutorController@Swapdata');
Route::get('tutor/freelancer_agree', 'TutorController@Freelanceragree');





Route::group(['middleware' => 'tutor'], function () {
    
    Route::get('tutor/change_password', function () {
        return View::make('web.change_password');
    });
    
    Route::get('tutor/upload', function () {
            //return View::make('web.upload_form');
        $userdoc = \App\Model\UserDoc::where('user_id',\Sentinel::getUser()->id)->get();
        $globaldoc = \App\Model\UserDoc::where('global',1)->get();
        return View::make('web.upload_form',compact('userdoc','globaldoc'));
    });
    Route::resource('/tutor', 'TutorController');
    Route::match(['put', 'patch'], 'tutor_update/{tutor}', 'Admin\TutorController@update');
    Route::post('tutor/change_job_status', 'TutorController@ChangeJobStatus');
    Route::get('tutor/get_swap/{id}', 'TutorController@GetSwap');
	//Route::get('tutor/check_dbs/{id}', 'TutorController@CheckDbs');
    Route::post('tutor/swap_user', 'TutorController@SwapUser');
	Route::post('tutor/swap_request', 'TutorController@SwapRequest');
	Route::post('tutor/insert_invoice', 'TutorController@InsertInvoice');
	Route::post('tutor/insert_register', 'TutorController@InsertRegister');
	Route::post('tutor/job_data', 'TutorController@JobData');
    Route::post('tutor/students_data', 'TutorController@StudentsData');
	Route::get('tutor/invoice/{id}', 'TutorController@Invoice');
    Route::get('tutor/calendar/{id}', 'TutorController@TutorCalendar');
	//Route::post('tutor/check_dbs', 'TutorController@CheckDbs');
    Route::post('tutor/upload', 'TutorController@uploadSubmit');
    Route::post('tutor/invoice_sent', 'TutorController@InvoiceSent');
    Route::post('tutor/set_availability', 'TutorController@SetAvailability');
    Route::post('tutor/savecontract', 'TutorController@Savecontract');
});


Route::group(['middleware' => 'employer' ], function () {

    Route::get('employer/assignment', 'EmployerController@assignments');
    Route::get('employer/change_password', function () {
        return View::make('web.change_password');
    });
    Route::get('employer/service_agree', 'EmployerController@Serviceagree');
    Route::post('employer/savecontract', 'EmployerController@Savecontract');
    Route::resource('/employer', 'EmployerController');
    Route::match(['put', 'patch'], 'employer_update/{tutor}', 'Admin\EmployerController@update');
	Route::get('employer/request_dbs_update/{id}', 'EmployerController@RequestDbsUpdate');
    //Route::get('employer/emp_calendar/{id}', 'EmployerController@EmpCalendar');
	Route::post('employer/cancel_job', 'EmployerController@CancelJob');
    Route::post('employer/change_job_status', 'EmployerController@ChangeJobStatus');
	Route::post('employer/report_problem', 'EmployerController@ReportProblem');
	Route::post('employer/students_data', 'EmployerController@StudentsData');
	Route::post('/employer/downloadCertificate', 'EmployerController@generatePdf');
    //Route::post('employer/check_dbs', 'EmployerController@CheckDbs');
});

Route::get('employer/check_dbs/{id}', 'EmployerController@CheckDbs');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    Route::resource('/', 'Admin\AdminController');
    Route::get('/change_password', function () {
        return View::make('admin.change_password');
    });
    Route::get('settings', 'UserController@Settings');
    Route::post('settings/update', 'UserController@updateSettings');
    Route::post('change_password', 'UserController@changePassword');
	Route::post('saveSeo', 'Admin\FaqController@saveSeo');
    Route::post('activate_users', 'UserController@activateUsers');
	Route::post('activate_onaccounts', 'UserController@activateOnaccounts');
    Route::resource('tutor', 'Admin\TutorController');  
	Route::get('invoice', 'Admin\TutorController@Invoice');
	Route::get('view_invoice/{id}', 'Admin\TutorController@ViewInvoice');
	Route::post('/invoice_to_accountant', 'Admin\TutorController@InvoicetoAccountant');
    Route::post('/tutor_approved', 'Admin\TutorController@tutorApproved');
    Route::get('view_tutors', 'Admin\TutorController@viewTutors');
    Route::resource('employer', 'Admin\EmployerController');
    Route::resource('tutor_plan', 'Admin\TutorplanController');
    Route::resource('employer_plan', 'Admin\EmployerplanController');
    Route::get('view_employer', 'Admin\EmployerController@viewEmployer');
    Route::resource('language', 'Admin\LanguagesController');
    Route::resource('certificate', 'Admin\CertificatesController');
    Route::resource('qualification', 'Admin\QualifiedController');
    Route::resource('job', 'Admin\JobController');
	Route::get('view_rating/{id}', 'Admin\JobController@viewRatings');
    Route::get('view_jobs', 'Admin\JobController@viewJobs');
    Route::post('students_data', 'Admin\JobController@StudentsData');
    Route::resource('types', 'Admin\TypesController');
    Route::resource('about', 'Admin\AboutController');
    Route::resource('privacy', 'Admin\PrivacyController');
    Route::resource('terms', 'Admin\TermsController');

    // Route::get('/privacy', function(){
    //     return View::make('web.privacy_policy');
    // });
    // Route::get('/terms', function(){
    //     return View::make('web.termsandcondition');
    // });
    
	Route::resource('emailtemplate', 'Admin\EmailTemplateController');
    Route::post('assign_job', 'Admin\JobController@assignJob');
    Route::resource('faq', 'Admin\FaqController');
    Route::resource('tutorplan', 'Admin\TutorplanController');
    Route::post('tutorplan/{id}', 'Admin\TutorplanController@update');
    Route::resource('employerplan', 'Admin\EmployerplanController');
    Route::post('employerplan/{id}', 'Admin\EmployerplanController@update');
    Route::resource('countries', 'Admin\CountriesController');
    Route::get('upload', function () {
        $userdoc = \App\Model\UserDoc::where('user_id',\Sentinel::getUser()->id)->get();
        return View::make('admin.admin_upload_form',compact('userdoc'));
    });
    Route::post('upload', 'Admin\TutorController@uploadSubmit');
});
URL::forceScheme('https');