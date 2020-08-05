<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;
use App\Model\About;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service=About::where('slug','service')->first();
        return View('admin.service_view', compact('service'));
        
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
        try {
            $data = $request->input();
            $validation = Validator::make($data, ValidationRequest::$terms);
            // var_dump($data);die();
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }
            $service=About::where('slug','service')->first();
            $service->title = $data['title'];
            // $about->shot = $data['shot'];
            $service->description = $data['description'];
			// $about->keyword = $data['keyword'];
			// $about->seo_description = $data['seo_description'];
            $service->save();
            Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));
            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $about = About::where('slug','about')->first();
    //     return View('admin.privacy_view', compact('about'));
    // }

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
