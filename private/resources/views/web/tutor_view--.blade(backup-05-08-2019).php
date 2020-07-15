@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor view')
<link rel="stylesheet" href="http://freelancegenie.co.uk/tutor_design/public/assets/web/scripts/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<section class="inner-page-title">
@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('tutor'))
    <h2>{{$usersMeta->first_name}} {{$usersMeta->last_name}}</h2>
@else
	<h2>Tutor Profile</h2>
@endif
</section>

<section id="tutor-view">

    <div class="container">
	
        <div class="persnl-info">
		<div class="row">	
		<div class="col-sm-3"> 
		@if (empty(\Sentinel::check()))<img class="img-fluid blurr" src="{{asset('images/photo/'.$usersMeta->photo)}}"> 
		@else 
			<img class="img-fluid" src="{{asset('images/photo/'.$usersMeta->photo)}}"> 
		@endif
		</div>
		<div class="col-md-9">	
		<div class="text-wrap"> 
		{{--<h4 class="media-heading">{{substr($usersMeta->first_name,'0',1  ) . str_repeat("*", strlen($usersMeta->first_name)-1)}} {{substr($usersMeta->last_name,'0',1  ) . str_repeat("*", strlen($usersMeta->last_name)-1)}} </h4>--}}  
		<div class="row mb-3"> 
		<div class="col-md-8"> 
		<h4 style="display: inline-block;">{{$usersMeta->tutor_profile->uuid}}</h4>	
		@if($usersMeta->tutor_profile->status == '0')
			<span class="verified">Undergoing Verification</span>
		@else
			<span class="verified">Verified</span>	
		@endif	
		<p><span class="rating_no">{{$rating = number_format($usersMeta->rating, 1)}}</span>
		<img src="{{asset('images/photo/Star_rating_').$usersMeta->rating.'.png'}}"></p> 
		</div>	
		<div class="col-md-4 text-right">
		@if (empty(\Sentinel::check()))
			<button type="button" title="Please login with employer account to book." class="btn btn-primary">Book a Tutor</button>	
		@endif
		@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
			<button type="button" class="btn btn-primary" id="myModal1">Book a Tutor</button>
		@endif
		@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('tutor'))
			<a class="btn btn-primary" href="{{url('tutor').'/'.encrypt(Sentinel::getUser()->id).'/edit'}}">Edit Profile</a>
		@endif 
		</div>  
		</div>
		<p>{{$usersMeta->tutor_profile->about}}</p>
		</div>
		</div>
		</div>
		
            <div class="row">
                
                <div class="col-md-12">
                    
					  <div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Skills</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        @foreach($usersMeta->categories as $keyCat=>$categorie)
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-wrap listing">
                                        <p>
                                            <span>Skills name:</span>
                                            <span>{{$categorie->name}}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-wrap listing">
                                        <p>
                                            <span>Qualified:</span>
                                            <span class="">@if(isset($usersMeta->qualified_level[$keyCat]->level))
                                            {{$usersMeta->qualified_level[$keyCat]->level}}@endif</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

<div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Work Permit</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Full UK Driving
                                            License?:
                                        </span>
                                        <span>{{$usersMeta->tutor_profile->driving_license == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Are you willing to
                                            Travel?:
                                        </span>
                                        <span>{{$usersMeta->tutor_profile->willing_travel == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>-->

                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Do you have the right to work in the
                                            UK?:
                                        </span>
                                        <span>{{$usersMeta->tutor_profile->driving_license == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Permit Details</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Permit No:</span>
                                        <span>{{$usersMeta->tutor_profile->permit_no}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Permit Start Date:</span>
                                        <span>{{$usersMeta->tutor_profile->permit_start_date}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Permit Expiry Date:</span>
                                        <span>{{$usersMeta->tutor_profile->permit_expiry_date}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Languages</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Do you speak any other
                                            languages?:
                                        </span>
                                        <span>{{$usersMeta->tutor_profile->speak_languages == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Language:</span>@foreach($ttrLan as $lang) <span
                                                class="multiple">{{$lang->name}}</span> @endforeach</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Level of
                                            Fluency:
                                        </span>
                                        <span>{{($usersMeta->tutor_profile->level_of_fluency == 0) ? "Basic understanding" : (($usersMeta->tutor_profile->level_of_fluency == 1)  ? "Semi-Fluent" : "Fluent")}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Internet Update Service</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Did you register for the Internet Update Service?:</span>
                                        <span>{{$usersMeta->tutor_profile->internet_update_service == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Enter the date the Certificate was issued?:</span>
                                        <span
                                                class="">{{$usersMeta->tutor_profile->cert_issued}}</span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Disabilities</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Did you register for the Internet Update Service?:</span>
                                        <span>{{$usersMeta->tutor_profile->internet_update_service == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-wrap listing">
                                    <p>
                                        <span>Do you have any medical conditions that we need to be aware of?:</span>
                                        <span class="">{{$usersMeta->tutor_profile->medical_conditions == '1' ? 'YES' : 'NO'}}</span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="persnl-info">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Organization</h3>
                </div>
                <div class="col-sm-8">
                    <div class="text-wrap">
                        @if($usersMeta->organisations_work)
                            @foreach($usersMeta->organisations_work as $organisation)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-wrap listing">
                                            <p>
                                                <span>Company
                                                    name:
                                                </span>
                                                <span>{{$organisation->company_name}}</span></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-wrap listing">
                                            <p>
                                                <span>Registration:</span>
                                                <span
                                                        class="">{{$organisation->registration}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        

                </div>

            </div>
        </div>

        {{--<div class="persnl-info">--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-4">--}}
        {{--<h3>Personal Information</h3>--}}
        {{--</div>--}}
        {{--<div class="col-sm-8">--}}
        {{--<div class="text-wrap">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Phone:</span><span>{{$usersMeta->phone}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Address:</span><span>{{$usersMeta->tutor_profile->address}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>City:</span><span>{{$usersMeta->tutor_profile->city}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>State:</span><span>{{$usersMeta->tutor_profile->state}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Country:</span><span>{{$usersMeta->country['0']->name}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Zip:</span><span>{{$usersMeta->tutor_profile->zip}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
      
        {{--<div class="persnl-info">--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-4">--}}
        {{--<h3>Passport</h3>--}}
        {{--</div>--}}
        {{--<div class="col-sm-8">--}}
        {{--<div class="text-wrap">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Permit--}}
        {{--No:</span><span>{{$usersMeta->tutor_profile->passport_no}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Permit Start Date:</span><span--}}
        {{--class="">{{$usersMeta->tutor_profile->pass_start_date}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Permit Expiry--}}
        {{--Date:</span><span>{{$usersMeta->tutor_profile->pass_expiry_date}}</span>--}}
        {{--</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="persnl-info">--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-4">--}}
        {{--<h3>DBS Certertificate</h3>--}}
        {{--</div>--}}
        {{--<div class="col-sm-8">--}}
        {{--<div class="text-wrap">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Do you have a current DBS--}}
        {{--Cert?:</span><span>{{$usersMeta->tutor_profile->passport_no}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>Enter the date the Certificate was issued?:</span><span--}}
        {{--class="">{{$usersMeta->tutor_profile->cert_issued}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
        {{--<div class="text-wrap listing">--}}
        {{--<p><span>If entered yes, please enter your DBS certificate no:</span><span--}}
        {{--class="">{{$usersMeta->tutor_profile->dbs_certificate_no}}</span></p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book a Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    {{ csrf_field() }}
					 <input class="form-control"
                                       name="tutor_id" value="{{$usersMeta->id}}" type="hidden"/>
        
		<input class="form-control" id="distance_value" name="distance_value" value="" type="hidden"/>
					@if(!empty(\Input::get('cat_id')))
					<input class="form-control"
                                       name="care_tutor" value="1" type="hidden"/>
					
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="title">
                                    Title
                                </label>
                                <input class="form-control" id="title"
                                       name="title" readonly value="{{$categories->name}}" type="text"/>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="title-error"></span>
                            </span>
                            </div>

                        </div>
					</div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="type">
                                    Book For
                                </label>
                                <select class="form-control" id="type" name="type">
									<option value="0">Hourly</option>
									</select>
                            </div>

                        </div>
						<div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="title">
                                    Course Duration
                                </label>
                               <input class="form-control" id="title"
                                       name="duration" readonly value="{{$categories->duration.' hours'}}" type="text"/>
                                
                            </div>

                        </div>
                    </div>
					<div class="row">
					<div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="booking_address">
                                    Booking Address
                                </label><br>
                                <input type="radio"  required name="booking_address" value="0" id="usr">
								<label for="usr">Company Address</label>
								<input type="radio" required name="booking_address" value="1" id="na">
								<label for="na">Delivery Address</label><br>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="booking_address-error"></span>
                            </span>
                            </div>

                        </div>
					</div>
		<div id="address_box" style="display:none;">
		<div class="row">
        <div class="col-md-6 col-sm-6">
			<div class="form-group ">
				<label class="control-label " for="address">
                    House or Company Door No.
                </label>
				<input class="form-control" name="address" id="address">
			</div> 
	   </div>
	   <div class="col-md-6 col-sm-6">
			<div class="form-group ">
               
				<label class="control-label " for="street_name">
                    Street Name
                </label>
                <input class="form-control" id="street_name" name="street_name" type="text"/>
               </div>
		</div>
			   
		
        
    </div>

    <div class="row">
	<div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="city">
                    Town/City
                </label>
                <input class="form-control" id="city" name="city" type="text"/>
                @if ($errors->has('city'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="country">
                    Country
                </label>

                <select name="country" id="country" class="form-control">
                    <option value="">Select</option>
                    @foreach(\App\Model\Country::all() as $country)
                        <option value="{{$country['id']}}">{{$country['name']}}</option>
                    @endforeach
                </select>

                @if ($errors->has('country'))
                    <span class="help-block">
                   <strong>{{ $errors->first('country') }}</strong>
                   </span>
                @endif
            </div>
        </div>

        
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="zip">
                    Post Code test
                </label>
                <input class="form-control" id="zip" name="zip" type="text"/>
                @if ($errors->has('zip'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
		<!--<div class="col-md-6">
                            <div class="form-group ">
                                
                                <input type="button" name="checkd" data-tutor_id='{{$usersMeta->id}}' id="checkd" value="Check Distance" class="btn btn-success">
							</div>

                        </div>-->

    </div>	

                       
					</div>
				<div id="distance_time_box" style="display:none;">
					<div class="row">
					<input class="form-control" type="hidden" name="use_time" id="use_time">
						<div class="col-md-6 col-sm-6">
							<div class="form-group ">
								<label class="control-label " for="zip">
								Distance
								</label>
								<input class="form-control" type="text" name="distance" id="distance" readonly>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
						<div class="form-group ">
								<label class="control-label " for="zip">
								Time
								</label>
						<input class="form-control" type="text" name="time" id="time" readonly>
						</div>
						<!--<span id="distance"></span>
						<span id="time"></span>-->
                        </div>
						
					</div>
						
					</div>
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="date">
                                    Date
                                </label>
                                <input class="form-control" name="date" type="text" id="date">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="date-error"></span>
                            </span>
                            </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="description">
                                    Description
                                </label>
                                <textarea class="form-control" name="description" value="" id="description"></textarea>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="description-error"></span>
                            </span>
                            </div>

                        </div>
						
						
					</div>
					
                                <input class="form-control" value="{{$categories->cost}}" name="rate" type="hidden" id="rate">

					@else
                    <input name="title" id="job_title" value="" type="hidden"/>
                    <div class="row">
                    
                        <!--<div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="title">
                                    Title
                                </label>
                               
                                <input class="form-control" id="title"
                                       name="title" type="text"/>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="title-error"></span>
                            </span>
                            </div>

                        </div>-->
                        <div style="display:none;" class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="type">
                                    Booking Period
                                </label>
                                <select class="form-control" id="type" name="type">
									<option value="1">Daily</option>
								</select>
                            </div>

                        </div>
                    </div>

                    
						
						<div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="type_levels">
                                    Type
                                </label>
                                <select required class="form-control" id="type_levels" onchange="fetch_select(this.value)"
                                        name="type_levels">
                                    <option value="">Type</option>
                                    @foreach($disciplines as  $discipline)
                                        <option value="{{$discipline->disciplines->id}}">{{$discipline->disciplines->name}}</option>

                                    @endforeach
                                </select>


                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="type_levels-error"></span>
                            </span>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="specialist">
                                    Specialist
                                </label>

                                <select required class="form-control" id="specialist" onchange="fetch_select_cat(this.value);" name="specialist">
                                    <option value="">Specialist</option>

                                </select>

                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="specialist-error"></span>
                            </span>
                            </div>

                        </div>

                    </div>
					

                    <div class="row">
					
                        
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="levels">
                                    Levels
                                </label>


                                <select required class="form-control" id="qualified_levels" name="qualified_levels">
                                    <option value="">Level</option>

                                </select>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="qualified_levels-error"></span>
                            </span>
                            </div>
                        </div>
						<div class="col-md-6 col-sm-6">

                            <div class="form-group ">
                                <label class="control-label" for="Rate">
                                    Day Rate (£)
                                </label>
                                <input class="form-control" name="rate" readonly="" type="text" id="rate">

                            </div>
                        </div>
						

						
                        
						
                    </div>
					<div class="row">
					<div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="booking_address">
                                    Booking Address
                                </label><br>
                                <input data-tutor_id='{{$usersMeta->id}}' type="radio"  required name="booking_address" value="0" id="usr">
								<label for="usr">Company Address</label>
								<input data-tutor_id='{{$usersMeta->id}}' type="radio" required name="booking_address" value="1" id="na">
								<label for="na">Delivery Address</label><br>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="booking_address-error"></span>
                            </span>
                            </div>

                        </div>
					</div>
		<div id="address_box" style="display:none;">
		<div class="row">
        <div class="col-md-6 col-sm-6">
			<div class="form-group ">
				<label class="control-label " for="address">
                    House or Company Door No.
                </label>
				<input class="form-control" name="address" id="address">
			</div> 
	   </div>
	   <div class="col-md-6 col-sm-6">
			<div class="form-group ">
               
				<label class="control-label " for="street_name">
                    Street Name
                </label>
                <input class="form-control" id="street_name" name="street_name" type="text"/>
               </div>
		</div>
			   
		
        
    </div>

    <div class="row">
	
		<div class="col-md-6 col-sm-6">
            <div class="form-group ">
            <label class="control-label " for="city">
                    Town/City
                </label>
                <select class="form-control livesearch" name="city" id="city">
@foreach(\App\Model\Country::all() as  $country)

            @if(isset($country->children['0']))

                <optgroup label="{{$country->name}}"

                          data-max-options="1">

                    @foreach($country->children as  $categorieChild)

                        <option value="{{$categorieChild->name}}" {{ !empty($usersMeta->tutor_profile->country) ? $categorieChild->name ==$usersMeta->tutor_profile->country   ? 'selected="selected"' : '' : ''}}>{{$categorieChild->name}}</option>

                    @endforeach

                    @endif

                    @endforeach

                </optgroup>  
  </select>
                
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6">
         <div class="form-group ">
                <label class="control-label " for="country">
                    Country
                </label>

                <select class="form-control" id="country"  name="country">
                    <option selected>UK</option>
                </select>

                @if ($errors->has('country'))
                    <span class="help-block">
                           <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>

           </div>

        
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="zip">
                    Post Code
                </label>
                <input class="form-control" id="zip" name="zip" type="text"/>
                @if ($errors->has('zip'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
		<!--<div class="col-md-6">
                            <div class="form-group ">
                                
                                <input type="button" name="checkd" data-tutor_id='{{$usersMeta->id}}' id="checkd" value="Check Distance" class="btn btn-success">
							</div>

                        </div>-->

    </div>	

                       
					</div>
				<div id="distance_time_box" style="display:none;">
					<div class="row">
					<input class="form-control" type="hidden" name="use_time" id="use_time">
						<div class="col-md-6 col-sm-6">
							<div class="form-group ">
								<label class="control-label " for="zip">
								Distance
								</label>
								<input class="form-control" type="text" name="distance" id="distance" readonly>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
						<div class="form-group ">
								<label class="control-label " for="zip">
								Time
								</label>
						<input class="form-control" type="text" name="time" id="time" readonly>
						</div>
						<!--<span id="distance"></span>
						<span id="time"></span>-->
                        </div>
						
					</div>
						
					</div>
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group " id="date_div">
                                <label class="control-label " for="date">
                                   Select Date
                                </label>
                                <div id="date"></div>
								<input type='hidden' name='date' id="altField">
                            </div>
                        </div>
						</div>
					<div class="row">
					
					<div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="description">
                                    Description
                                </label>
                                <textarea class="form-control" name="description" value="" id="description"></textarea>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                <span id="description-error"></span>
                            </span>
                            </div>

                        </div>
					</div>
					@endif
                    
	


<div class="row">
<div class="col-md-6 col-sm-6">
	<div class="form-group">
		<label>
			Do you have an onsite projector?
		</label>		
		<div class="radio">
			<label>
				<input type="radio" checked name="onsite_projector" id="onsite_projector"
					   value="0">No
			</label> 
			<label>
				<input type="radio" name="onsite_projector" id="onsite_projector"
					   value="1">Yes
			</label>
		</div>
	</div>
</div>
<div class="col-md-6 col-sm-6">
	<div class="form-group">
		<label>
			Do you have a wipe board?
		</label>
		<div class="radio">
			<label>
				<input type="radio" checked name="wipe_board" id="wipe_board"

					   value="0">No
			</label>
			<label>
				<input type="radio" name="wipe_board" id="wipe_board"
					   value="1">Yes
			</label>
		</div>
	</div>
</div>

</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		 <div class="form-group">
			<label>
				Do you have a flip chart and stand?
			</label>
			<div class="radio">
				<label>
					<input type="radio" checked name="flip_chart_and_stand" id="flip_chart_and_stand"
						   value="0">No
				</label> <label>
					<input type="radio" name="flip_chart_and_stand" id="flip_chart_and_stand"
						   value="1">Yes
				</label>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6">
		<div class="form-group">
			<label>

				Do any of the Audience have any learning difficulties or disabilities that we
				need to be aware of?
			</label>

			<div class="radio">
				<label>
					<input type="radio" checked name="disabilities" id="disabilities"
						   value="0">No
				</label> <label>
					<input type="radio" name="disabilities" id="disabilities"
						   value="1">Yes
				</label>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-6 col-sm-6">
		 <div class="form-group">
			<label>
				Do you have an IT Suite/I.T equipment available for use if necessary?
			</label>
			<div class="radio">
				<label>
					<input type="radio" checked name="equipment_available" id="equipment_available"
						   value="0">No
				</label> <label>
					<input type="radio" name="equipment_available" id="equipment_available"
						   value="1">Yes
				</label>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6">
		<div class="form-group">
			<label>
				Is there any equipment available onsite to be used? , if not, please tell us what you would like provided?
			</label>
			<div class="radio">
				<label>
					<input type="radio" checked name="equipment_available_onsite" id="equipment_available_onsite"
						   value="0">No
				</label> <label>
					<input type="radio" name="equipment_available_onsite" id="equipment_available_onsite"
						   value="1">Yes
				</label>
			</div>
		</div>
	</div>
</div>
					
					<input type="hidden" value="@if(!empty(\Input::get('cat_id'))){{$categories->cost}}@endif" name="total" id="total">
					
					
					<span id="cost"></span>
					<div id="additional_cost"></div> 
					<span id="total_text"></span>
					
					<div class="row">
					<div class="col-md-12">
					
					@if(empty(\Input::get('cat_id')))<input required="" class="" name="fifty" type="checkbox" id="fifty"><span>Minimum 50% payment is required for booking</span>
					@endif
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger">
                        <span id="fifty-error"></span>
                    </span>
					</div>
					</div>
                    <input type="submit" name="insert" id="insert" value="Book a Tutor" class="btn btn-success"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade maiilModal" id="course_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rating for the job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                       
						<p><span class="rating_no"></span><img id="rating_img" src=""></p>
						<p id="comment"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
	<!-- Modal -->
	

@push('scripts')
	
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"/> </script> 
	<script src="{{ asset('js/admin/jquery-ui.multidatespicker.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
	$(document).ready(function(){  
		$('#date').multiDatesPicker({
			altField: '#altField',
			dateFormat: "dd/mm/yy",
			minDate: 3, // Booking dates should be selected after 2 days of current date
			addDisabledDates: [@php echo $dates; @endphp],
			onSelect: function(date){
			priceAjax();
		}
		}); 
		$('#city').multiselect({
            nonSelectedText: 'Select Type',
            enableFiltering: true,
			multiselect:false,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '220px'
        });		
	});
	$('#usr').click(function(){
		$('#address_box').hide();
	});
	$('#na').click(function(){
		$('#address_box').show();
	});
	$('input[name="booking_address"],#address,#street_name,#city,#zip').change(function(){
		
			var tutor_id=$('input[name="booking_address"]').data('tutor_id');
			$('#distance').val('');
			$('#time').val('');
			var address_option=$("input[name='booking_address']:checked").val();
			if(address_option && $('#address').val() !="" && $('#city').val() !="" && $('#street_name').val() !="" && $('#zip').val() !=""){
			
			check_distance(tutor_id);
			//priceAjax();
			}
			if(address_option == 0){
				check_distance(tutor_id);
				//priceAjax();
			}
			
	});
	
		$('#specialist').change(function(){
			alert('change specialist');
		});
    
	function check_distance(tutor_id){
		
			var address_option=$("input[name='booking_address']:checked").val();
			//if(address_option){
           var address=$('#address').val();
		   var city=$('#city').val();
		   var street_name=$('#street_name').val();
		   var zip=$('#zip').val();
		   var country=$('#country').val();
			//}else{
				
			//}
		   
		   var booking_days = parseInt($('#date').multiDatesPicker('getDates').length);
		   
		   //alert(booking_days);
		   
		   
            $.ajax({
                type: 'POST',
                url: "{{url('/tutors/get_coordinates')}}",
                data: {
                    'address_option':address_option,'address': address,'tutor_id':tutor_id,'city':city,'street_name':street_name,
					'zip':zip,'country':country,
					"_token": "{{ csrf_token() }}"
                },
                success: function (data) {
				var response=$.parseJSON(data);
                    if (response.status == 'OK') {
					
					var distance_text=response.rows[0].elements[0].distance.text;
					$('#distance').val(distance_text);
					$('#distance_value').val(parseFloat(distance_text));
					$('#time').val(response.rows[0].elements[0].duration.text);
					$('#use_time').val(response.rows[0].elements[0].duration.value);
					
					$('#distance_time_box').show();
					priceAjax();
					/*if(response.rows[0].elements[0].duration.value > 7200){
					var hotel_cost=50*booking_days;
					var travel_cost=2*parseInt(distance_text)*0.30;
					var travel_cost_hot_booking=booking_days*parseInt(distance_text)*0.30;
						$('#additional_cost').html('Hotel Cost: £'+hotel_cost+' <br>Travel Cost from Tutor Venue to Hotel: £'+travel_cost+' <br>Travel Cost from Hotel to Booking Address: £'+travel_cost_hot_booking);
					}else{
						var travel_cost=2*booking_days*parseInt(distance_text)*0.30;
						$('#additional_cost').html('Travel Cost from Tutor Venue to Hotel: £'+travel_cost);
					}*/
					
                   } else {
                        
                    }
                }

            });
	}
	function parseDate(str) {
    var mdy = str.split('/')
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}
	function showDays(firstDate,secondDate){
                var startDay = new Date(firstDate);
                  var endDay = new Date(secondDate);
                  var millisecondsPerDay = 1000 * 60 * 60 * 24;
					var millisBetween = startDay.getTime() - endDay.getTime();
                  var days = (millisBetween / millisecondsPerDay)+1;
					// Round down.
                  return( Math.floor(days));
	}

        function fetch_select(val) {
        var optionText = $('#type_levels option[value="'+val+'"]').text();
        $('#job_title').val(optionText);

            $.ajax({
                type: 'POST',
                url: "{{url('/tutors/get_option')}}",
                data: {
                    get_option: val,
                    tutor_id: '{{\Request::segment('2')}}',
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.status == '0') {
                        document.getElementById("specialist").innerHTML = '<option value="">Specialist</option>';
                       document.getElementById("qualified_levels").innerHTML = '<option value="">Level</option>';
                    } else {
                        document.getElementById("specialist").innerHTML = response.categories;
                        getLevels($('#specialist').val());
                    //    document.getElementById("qualified_levels").innerHTML = response.qualifiedlevel;
                    }
                }

            });


        }


        function fetch_select_cat(val) {

            getLevels(val);
			
        }

        function getLevels(val){

            $.ajax({
                type: 'POST',
                url: "{{url('/tutors/get_level_by_cat')}}",
                data: {
                    get_option: val,
                    tutor_id: '{{\Request::segment('2')}}',
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.status == '0') {
                        //    document.getElementById("specialist").innerHTML = '<option value="">Specialist</option>';
                        document.getElementById("qualified_levels").innerHTML = '<option value="">Level</option>';
                        $('#rate').val('');
                    } else {
                        //   document.getElementById("specialist").innerHTML = response.categories;
                        document.getElementById("qualified_levels").innerHTML = response.qualifiedlevel;
                        $('#rate').val(response.rate);
						priceAjax();
                    }
                }

            });
        }

       // var disabledArr = @php echo json_encode($dates); @endphp
         //var disabledArr = ["04/25/2019","04/26/2019","04/28/2019","04/29/2019"];
            /*$(date).daterangepicker({
            minDate: new Date(),
                timePicker: true,
                locale: {
                    format: 'M/DD/Y hh:mm A'
                },                showWeekNumbers:true,                
              isInvalidDate: function(date) {
                var disabled_start = moment('06/26/2019', 'MM/DD/YYYY');
                var disabled_end = moment('06/28/2019', 'MM/DD/YYYY');
                return date.isAfter(disabled_start) && date.isBefore(disabled_end);
              }             // var highlight_dates=["21-6-2019","23-6-2019"];                                
            }*//*, function(start, end, label) {    var years = moment().diff(start, 'days');    alert("You are " + years + " years old!");}*/    
			//);

    </script>


    <script>
	

        $('#myModal1').click(function (e) {
       // var tutor_id=$(this).data('tutor_id');
            $.ajax({
                type: 'POST',
                url: "{{url('/tutors/check_limit')}}",
                data: {
                'check':'booked',
					"_token": "{{ csrf_token() }}"
                },
                success: function (data) {
				//var response=$.parseJSON(data);
                  //console.log(data);
                  //alert (data);
                    if(parseInt(data)){
						$('#myModal').modal({backdrop: 'static', keyboard: false});
                        }else{
                        alert('You have used all of your direct bookings.Please renew your subscription plan.');
                        }
                }

            });
            
            $("#insert_form")[0].reset();
            $('#title-error').html("");
            $('#date-error').html("");
            $('#specialist-error').html("");
            $('#qualified_levels-error').html("");
            $('#type_levels-error').html("");
			$('#booking_address-error').html("");
        });
		$("#myModal2").click(function(){
           // $('#title-error').html("");
			var ids = $(this).data('id');
		 // var ids = 88;
		  //alert(ids);
		   
          //$("#tutor_id").val(ids);
            $.ajax({
                type: 'GET',
				url: "{{url('/admin/view_rating/')}}"+'/'+ids,
                data: {//tutorid:ids,

                },
                success: function (data) {
				
				console.log(data);
				var res=JSON.parse(data);
				//alert(res);
				console.log(res[0].comment);
				//$("#sid").val(res.tutor_profile.updatesid);
				$("#comment").text('');
				$(".rating_no").text('');
				$('#rating_img').attr('src','');
				
				
				$("#comment").text(res[0].comment);
				$('#rating_img').attr('src',res[0].star_img);
				$(".rating_no").text(res[0].rating);
				
				
                }

            });

            //$('#myModal').modal('show');

        });


        $('#insert_form').on("submit", function (event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#title-error').html("");
            $('#date-error').html("");
            $('#specialist-error').html("");
            $('#qualified_levels-error').html("");
            $('#type_levels-error').html("");
			$('#booking_address-error').html("");
			$('#fifty-error').html("");
            $.ajax({
                type: "POST",
                url: "{{url('/tutors')}}",
                data: $('#insert_form').serialize(),
                success: function (data) {
				console.log(data);
                    if (data.errors) {
                        $('#title-error').html(data.errors.title);
                        $('#date-error').html(data.errors.date);
                        $('#specialist-error').html(data.errors.specialist);
                        $('#qualified_levels-error').html(data.errors.qualified_levels);
                        $('#type_levels-error').html(data.errors.type_levels);
						$('#booking_address-error').html(data.errors.booking_address);
						$('#fifty-error').html(data.errors.fifty);
                    }

                    if (data.success) {
						var job_id=data.job_id;
						var total=data.total;
						var care_tutor=data.care_tutor;
                        $('#insert_form').trigger("reset");
                        /*bootoast.toast({
                            message: data.message
                        });*/
						$('#myModal').modal({backdrop: 'static', keyboard: false})
						window.location.href = "{{url('/booking')}}"+'?job_id='+job_id+'&care_tutor='+care_tutor;
                    }
                }
            });
            event.preventDefault();
        });
		
		
		
		
		function priceAjax() {
						//var startDate = $('#date').data('daterangepicker').startDate._d;
						//var endDate = $('#date').data('daterangepicker').endDate._d;
						//var booking_days=showDays(endDate,startDate);
						var booking_days = parseInt($('#date').multiDatesPicker('getDates').length);
						var tutor_cost=booking_days*$('#rate').val();
						//console.log(booking_days);
						
						//alert(dates);
						var distance_text=$('#distance').val();
						$('#cost').text('Tutor Cost: £'+tutor_cost);
						var total_additional=0;
						@if(!empty(\Input::get('cat_id')))
						var travel_cost=2*booking_days*parseFloat(distance_text)*0.30;
							total_additional=travel_cost;
							$('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £'+travel_cost);
						@else
						
						if($('#use_time').val() != ""){
						if($('#use_time').val() > 7200){ //Add hotel cost when travel time is more than 2 hours
						
						var hotel_cost=50*booking_days;
						
						//alert(parseInt(distance_text));
					var travel_cost=2*parseInt(distance_text)*0.30;
					var hot_booking_dist=15;
					var travel_cost_hot_booking=2*booking_days*hot_booking_dist*0.30;
						total_additional=hotel_cost+travel_cost+travel_cost_hot_booking;
						$('#additional_cost').html('Hotel Cost: £'+hotel_cost+' <br>Travel Cost from Tutor Venue to Hotel: £'+travel_cost+' <br>Travel Cost from Hotel to Booking Address: £'+travel_cost_hot_booking);
					}else{
						var travel_cost=2*booking_days*parseInt(distance_text)*0.30;
							total_additional=travel_cost;
						$('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £'+travel_cost);
					}
					}
					@endif
						var total_cost=total_additional+parseInt(tutor_cost);
						$('#total').val(total_cost);
						$('#total_text').text('Total: £'+total_cost);
			}
    </script>


@endpush
@stop
