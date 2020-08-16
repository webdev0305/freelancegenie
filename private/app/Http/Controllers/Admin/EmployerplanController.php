<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Requests\ValidationRequest;
use App\Model\Faq;
use App\Model\Specialization;
use App\Model\About;
use App\Model\plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use View;

class EmployerplanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('post_assignment','=','0')->get();
        $plans =  json_decode(json_encode($plans));
        $count = '1';
		//echo '<pre>';print_r($seo);die;
        return View::make('admin.employerplan_view',compact('plans','count'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $data = $request->input();
            
            if($request->file('file')){

                $photo = $request->file('file');
                $name = rand(1,100);
                $name = $name.time();
                $imagename = $name.'.'.$photo->getClientOriginalExtension();
                $destinationPath = public_path('../../web/images'); 
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0700, true);
                }
                $photo->move($destinationPath, $imagename);
                
                $data['image'] = $imagename;
            }

            $validation = \Validator::make($data, ValidationRequest::$employerplan);
            if ($validation->fails()) {
                $errors = $validation->messages()->all();
                return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
            }
            Plan::insert(['title' => $data['title'],'sub_title' => $data['sub_title'],'price' => 0,'status' => 0,'details' => $data['details'],'duration' => 0,'post_assignment' => 0,'premium' => 0,'book_tutor' => 0,'image' => $data['image']]);
            return Response(array('success' => '1', 'data' => null, 'errors' => null));
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {
            $data = $request->input();
            
            if($request->file('file')){
                $photo = $request->file('file');
                $name = rand(1,100);
                $name = $name.time();
                $imagename = $name.'.'.$photo->getClientOriginalExtension();
                $destinationPath = public_path('../../web/images'); 
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0700, true);
                }
                $photo->move($destinationPath, $imagename);
                
                $data['image'] = $imagename;
            }else{
                $data['image'] = 'no_exist';
            }

            $validation = \Validator::make($data, ValidationRequest::$employerplan_edit);
            if ($validation->fails()) {
                $errors = $validation->messages()->all();
                return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
            }
            if($data['image'] == 'no_exist'){
                Plan::where('id', $id)->update(['title' => $data['title'],'sub_title' => $data['sub_title'],'details' => $data['details']]);
            }else{
                Plan::where('id', $id)->update(['title' => $data['title'],'sub_title' => $data['sub_title'],'details' => $data['details'],'image' => $data['image']]);
            }
            
            return Response(array('success' => '1', 'data' => null, 'errors' => null));
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }
	// public function saveSeo(Request $request)
    // {
    //     try {
    //         $data = $request->input();
            

    //         About::where('slug', 'faq')->update(['keyword' => $data['keyword'],'seo_description' => $data['description']]);
    //         return Response(array('success' => '1', 'data' => null, 'errors' => null));
    //     } catch (Exception $ex) {
    //         return View::make('errors.exception')->with('Message', $ex->getMessage());
    //     }
    // }
	

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plan::destroy($id);
    }

    
}
