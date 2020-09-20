<?php

namespace App\Http\Controllers;

use App\Rating;
//use App\Model\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('I am here');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         echo 'I am here in create function';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $data = $request->input();
        $check = Rating::where('job_id',$data['job_id'])->first();
        if($check != false){
            $rating = new Rating;
            $rating->objectives = $data['objectives'] == NULL ? NULL : $data['objectives'];
            $rating->job_id = $data['job_id'];
            $rating->delivery = $data['delivery'];
            $rating->professional = $data['professional'];
            $rating->style = $data['style'];
            $rating->paperwork = $data['paperwork'];
            $rating->employer_id = \Sentinel::getUser()->id;
            $rating->tutor_profile_user_id = $data['tutor_id'];
            $rating->tutor = $data['tutor'];
            $rating->training = $data['training'];
            $rating->comment = $data['comment'];
            $rating->save();
            $res[] = [
               "success"=>1,
               "message"=>'Rating Submitted Successfully',
            ];
            return  json_encode($res);
        }else{
            $res[] = [
               "success"=>1,
               "message"=>'Rating Already Submitted. You cannot rate again.',
            ];
            return  json_encode($res);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
