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
	//echo 'rating store funaction';
	 //dd('I am here in store function');
	$data = $request->input();
	//print_r($data);
	//die('I am here');
         $rating = new Rating;
            $rating->objectives = $data['objectives'] == NULL ? NULL : $data['objectives'];
			//print_r($rating);
			$rating->job_id = $data['job_id'];
            $rating->delivery = $data['delivery'];
            $rating->professional = $data['professional'];
            $rating->style = $data['style'];
            $rating->paperwork = $data['paperwork'];
			//print_r($rating);
			//$rating->employer_id = 2;
            $rating->employer_id = \Sentinel::getUser()->id;
			$rating->tutor_profile_user_id = $data['tutor_id'];
            $rating->tutor = $data['tutor'];
			
           
            $rating->training = $data['training'];
            $rating->comment = $data['comment'];
			//print_r($rating);
			//die('I am here');
			$rating->save();
			$res[] = [
               "success"=>1,
               "message"=>'Rating Submitted Successfully',
           ];
		  // print_r($rating);
			//die('I am here');
       return  json_encode($res);
			//print_r($rating);
            //return Response::json(['success' => '1', 'message' => Config::get('message.options.JOB_SUBMITED')]);
			 //return Response::json(['success' => '1', 'message' =>'Rating Submitted Successfully']);
			 

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
