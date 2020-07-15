<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Requests\ValidationRequest;
use App\Model\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use View;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->get();
//
        $count = '1';
        return View('admin.certificates_view', compact('categories', 'count'));
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

            $validation = \Validator::make($data, ValidationRequest::$cate);
            if ($validation->fails()) {
                $errors = $validation->messages()->all();
                return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
            }
            $dataCat = Category::where('name', $data['nameCat'])->get();

            if (!empty(json_decode(json_encode($dataCat)))) {
                return Response(array('success' => '0', 'data' => null, 'errors' => Config::get('message.options.NAME_EXIT')));
            }

//            if($data['radioVal'] == '0') {
//                Category::insert(['name' => $data['nameCat']]);
//            }else{
                Category::insert(['name' => $data['nameCat'],'sub_category_id' => $data['nameCatId']]);
//            }
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

            $validation = \Validator::make($data, ValidationRequest::$cate);
            if ($validation->fails()) {
                $errors = $validation->messages()->all();
                return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
            }
            if ($id == $data['nameCat']) {
                return Response(array('success' => '0', 'data' => null, 'errors' => Config::get('message.options.NAME_EXIT')));
            }

            Category::with('children')->where('name', $id)->update(['name' => $data['nameCat']]);
            return Response(array('success' => '1', 'data' => null, 'errors' => null));
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::with('children')->where('id',$id)->delete();
    }
}
