<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;

use App\Model\Category;
use App\Model\CategoryUser;
use App\Model\Disciplines;
use App\model\Jobs;
use App\Model\QualifiedLevel;
use App\model\TutorProfile;
use App\User;
use DB;
use App\Rating;
use App\model\Students;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.jobs_view');
    }


    public function viewJobs()
    {
        $jobs = Jobs::with(['Employer'])->orderBy('id', 'desc')->get();
		//print_r($jobs);die('here');

        return Datatables::of($jobs)
            ->addColumn('actions', function ($userd) {
			if($userd->dbs==1){
                return '<a   href="#" data-index="' . $userd->id . '" id="job_del"  class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-trash"></i></a><a  href="job/' . encrypt($userd->id) . '/edit"   class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-edit"></i></a><button type="button" data-id="'.$userd->id.'" data-status="2" data-toggle="modal" data-target="#update_register" class="update_register_btn btn mr-1">Students Register</button><button type="button" class="view_rating btn mr-1" data-id="'.$userd->id.'"  data-status="1"  data-toggle="modal" data-target="#rating_show">View Rating
                        </button><button type="button" class="dbs btn btn-success mr-1" data-id="'.$userd->tutor_id.'"  data-status="1"  data-toggle="modal" data-target="#dbs">Check DBS
                        </button>';
			}else{
				return '<a   href="#" data-index="' . $userd->id . '" id="job_del"  class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-trash"></i></a><a  href="job/' . encrypt($userd->id) . '/edit"   class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-edit"></i></a><button type="button" data-id="'.$userd->id.'" data-status="2" data-toggle="modal" data-target="#update_register" class="update_register_btn btn mr-1">Students Register</button><button type="button" class="view_rating btn mr-1" data-id="'.$userd->id.'"  data-status="1"  data-toggle="modal" data-target="#rating_show">View Rating
                        </button>';
			}
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();
    }
	public function viewRatings($id)
    {
	//echo 'I ma in function ';
        //$usersMeta = json_decode(json_encode(TutorProfile::with(['Rating'])->find($id)));
		$jobs = json_decode(json_encode(Jobs::with(['Rating'])->find($id)));
		
		//print_r($jobs);
		//die('here');
		if($jobs->rating){
		$rating=($jobs->rating->objectives+$jobs->rating->delivery+$jobs->rating->professional+$jobs->rating->style
		+$jobs->rating->paperwork+$jobs->rating->tutor+$jobs->rating->training)/7;
		$star_rating = floor(($rating * 2) + 0.5) / 2;
		$star_img=asset('images/photo/Star_rating_').$star_rating.'.png';
		$star_rating = number_format($star_rating, 1);
		$data[] = [
               "rating"=>$star_rating,
               "comment"=>$jobs->rating->comment,
			   "star_img"=>$star_img
			   ];
		}else{
		$data[] = [
               "rating"=>'',
               "comment"=>'Rating not given yet',
			   "star_img"=>''
			   
           ];
		}
       return  json_encode($data);
    }
     public function StudentsData(Request $request)
        {	
            //die('i am here ok');
            $data = $request->input();
            $job_id=$data['jobid'];
            $student = Students::where('job_id', $job_id)->first();
            //print_r($student);die;
            if(count($student) >=1){
            return Response::json(['success' => '1','job_id' =>$job_id,'student'=>json_decode($student->stuinfo)]);
            
            }else{
            return Response::json(['errors' => '1','job_id' =>$job_id,'student'=>'']);
            }
            //return Datatables::of($student)->make(true);
            /*return Datatables::of($student)
           ->addColumn('actions', function ($userd) {
                return '<a   href="#" data-index="' . $userd->id . '" id="job_del"  class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-trash"></i></a>';
			
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();*/
        
        }
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobs = Jobs::with(['Tutor', 'Employer', 'userJobs','Disciplines','QualifiedLevels','Categories'])->find(decrypt($id));

        if ($jobs['tutor'] != '') {
            $disciplines = CategoryUser::with('Disciplines')->select('disciplines_id')->where('user_id', $jobs['tutor']->id)->groupBy('disciplines_id')->get();

            if($jobs['qualified_levels_id']){
			$qualifiedLevels[] = QualifiedLevel::find($jobs['qualified_levels_id'])->level;
			$categoriesGet[] = Category::find($jobs['category_id'])->name;
            $disciplinesGet[] = Disciplines::find($jobs['sub_disciplines_id'])->name;
			}else{
			$qualifiedLevels[] ='';
			$categoriesGet[] ='';
			$disciplinesGet[] ='';
			}
            

        } else {
            $categories = Category::with('children')->get();
            $levels = QualifiedLevel::with('childrenLevels')->get();
            $disciplines = Disciplines::with('childrenDisciplines')->get();

            $qualifiedLevels[] = '';
            $categoriesGet[] = '';
            $disciplinesGet[] = '';
        }


        $usersMeta = TutorProfile::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name', 'photo');
        }, 'Disciplines', 'Country', 'Categories', 'QualifiedLevel'))->select('id', 'user_id', 'uuid', 'country_id', 'about');

        if (!empty($disciplinesGet)) {
            $usersMeta = $usersMeta->OrWhereHas('Disciplines', function ($query) use ($disciplinesGet) {
                $query->whereIn('name', $disciplinesGet);
            });
        }

        if (!empty($categoriesGet)) {
            $usersMeta = $usersMeta->OrWhereHas('Categories', function ($query) use ($categoriesGet) {
                $query->whereIn('name', $categoriesGet);
            });
        }

        if (!empty($qualifiedLevels)) {
            $usersMeta = $usersMeta->OrWhereHas('QualifiedLevel', function ($query) use ($qualifiedLevels) {
                $query->whereIn('level', $qualifiedLevels);
            });
        }

        $usersMeta = $usersMeta->get();
        return view::make('admin.job_edit', compact('jobs', 'categories', 'usersMeta', 'levels', 'disciplines'));
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
        try {
            $data = $request->input();
            $validation = Validator::make($request->all(), ValidationRequest::$jobPost);
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }

            $jobs = Jobs::find(decrypt($id));

            $jobs->category_id = $data['specialist'];
            $jobs->qualified_levels_id = $data['qualified_levels'];
            $jobs->sub_disciplines_id = $data['type_levels'];
            $jobs->description = $data['description'];
            $jobs->title = $data['title'];
            $jobs->date = $data['date'];
            $jobs->type = $data['type'];
            $jobs->status = '0';
            if (Input::hasFile('file'))
            {
                $file = $request->file();
                $name =  $jobs->file;
                $jobs->file = $this->UploadFile($file, $name);
            }
            $jobs->save();

            Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));
            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    private function UploadFile($file,$name)
    {
        $file = $file['file'];
        $filename = time(). '.' . $file->getClientOriginalExtension();
        $file->move(public_path().'/images/job_files/', $filename);
        $profileImg =  '/images/job_files/' . $name;
        if (\File::exists(public_path($profileImg))) {
            \File::delete(public_path($profileImg));
        }
        return $filename;
    }
    public function assignJob(Request $request)
    {
        try {
            $data = $request->input();
            $validation = Validator::make($request->all(), ValidationRequest::$assignJob);
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }
            $job = Jobs::find($data['job_id']);
            $job->userJobs()->sync($data['tutor_assign']);

            Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));
            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jobs::destroy($id);

    }
}
