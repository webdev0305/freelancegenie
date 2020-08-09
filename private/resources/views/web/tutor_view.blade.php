@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor view')
<link rel="stylesheet" href="{{asset('web/scripts/jquery-ui/jquery-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<section class="inner-page-title">
	@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('tutor'))
	<h2>{{$usersMeta->first_name}} {{$usersMeta->last_name}}</h2>
	@else
	<h2>Tutor Profile</h2>
	@endif
</section>

<section id="tutor-view">

	<div class="container">

		<div class="persnl-info tutor_view_profile">
			<div class="row">
				<div class="col-sm-3">
					@if (empty(\Sentinel::check()))<img class="img-fluid blurr"
						src="{{asset('images/photo/'.$usersMeta->photo)}}">
					@else
					<img class="img-fluid" src="{{asset('images/photo/'.$usersMeta->photo)}}">
					@endif
				</div>
				<div class="col-md-9">
					<div class="text-wrap">
						{{--<h4 class="media-heading">{{substr($usersMeta->first_name,'0',1  ) . str_repeat("*", strlen($usersMeta->first_name)-1)}}
						{{substr($usersMeta->last_name,'0',1  ) . str_repeat("*", strlen($usersMeta->last_name)-1)}}
						</h4>--}}
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
							<div class="col-md-4 text-right" id="book_a_tutor">
								@if (empty(\Sentinel::check()))
								<button type="button" title="Please login with employer account to book."
									class="btn btn-primary">Book a Tutor</button>
								@endif
								@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
								<button type="button" class="btn btn-primary" id="myModal1">Book a Tutor</button>
								@endif
								@if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('tutor'))
								<a class="btn btn-primary"
									href="{{url('tutor').'/'.encrypt(Sentinel::getUser()->id).'/edit'}}">Edit
									Profile</a>
								@endif
							</div>
						</div>
						<p>{{$usersMeta->tutor_profile->about}}</p>
					</div>
				</div>
			</div>

			<div class="row last_border_remove">
				<div class="col-md-12">
					<div class="persnl-info">
						<div class="row">
							<div class="col-md-6">
								<h3>Skills</h3>
								<div class="text-wrap main_box">
									@foreach($usersMeta->categories as $keyCat=>$categorie)
									<div class="row">
										<div class="col-sm-6">
											<div class="text-wrap listing">
												<p>

													<span>{{$categorie->name}}</span></p>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="text-wrap listing">
												<p>
													<span>Qualified:</span>
													<span
														class="">@if(isset($usersMeta->qualified_level[$keyCat]->level))
														{{$usersMeta->qualified_level[$keyCat]->level}}@endif</span></p>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							<div class="col-md-6">
								<h3>Driving License</h3>
								<div class="text-wrap main_box">
									<div class="row">
										<div class="col-md-6">
											<div class="text-wrap listing">
												<p>
													<span>Full UK Driving
														License:
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
							<div class="col-md-6">
								<h3>Work Permit</h3>
								<div class="text-wrap main_box">
									<div class="row">

										<div class="col-md-12">
											<div class="text-wrap listing">
												<p>
													<span>Right to work in the UK:
													</span>
													<span>{{$usersMeta->tutor_profile->driving_license == '1' ? 'YES' : 'NO'}}</span>
												</p>
											</div>
										</div>

									</div>
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
													<span>{{date('d/m/Y',strtotime($usersMeta->tutor_profile->permit_start_date))}}</span>
												</p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="text-wrap listing">
												<p>
													<span>Permit Expiry Date:</span>
													<span>{{date('d/m/Y',strtotime($usersMeta->tutor_profile->permit_expiry_date))}}</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<h3>Spoken Languages</h3>
								<div class="text-wrap main_box">
									<div class="row">

										<div class="col-md-6">
											<div class="text-wrap listing">

												@foreach($ttrLan as $lang)
												<p><span class="multiple">{{$lang->name}}</span></p>
												@endforeach

											</div>
										</div>
										<!--<div class="col-md-6">
										<div class="text-wrap listing">
											
											<p><span>Fluency: {{($usersMeta->tutor_profile->level_of_fluency == 0) ? "Basic understanding" : (($usersMeta->tutor_profile->level_of_fluency == 1)  ? "Semi-Fluent" : "Fluent")}}</span></p>
											
										</div>
									</div>-->
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="persnl-info">
						<div class="row">
							<div class="col-md-6">
								<h3>Internet Update Service</h3>
								<div class="text-wrap main_box">
									<div class="row">
										<div class="col-md-12">
											<div class="text-wrap listing">
												<p>
													<span>Register for the Internet Update Service:</span>
													<span>{{$usersMeta->tutor_profile->internet_update_service == '1' ? 'YES' : 'NO'}}</span>
												</p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="text-wrap listing">
												<p>
													<span>Certificate Issued Date:</span>
													<span
														class="">{{date('d/m/Y',strtotime($usersMeta->tutor_profile->cert_issued))}}</span>
												</p>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="col-md-6">
								<h3>Disabilities/Medical conditions</h3>
								<div class="text-wrap main_box">
									<div class="row">
										<div class="col-md-12">
											<div class="text-wrap listing">
												<p>
													<span>Any Medical conditions/Disabilities:</span>
													<span
														class="">{{$usersMeta->tutor_profile->medical_conditions == '1' ? 'YES' : 'NO'}}</span>
												</p>
												<p>{{$usersMeta->tutor_profile->medical_description}}</p>
											</div>
										</div>

									</div>
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
	<div class="modal-dialog modal-lg">

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
					<input class="form-control" name="tutor_id" value="{{$usersMeta->id}}" type="hidden" />

					<input class="form-control" id="distance_value" name="distance_value" value="" type="hidden" />
					<div id="step0" class="stepDetails">
						<fieldset>
							<legend>Booking Information</legend>
							@if(!empty(\Input::get('cat_id')))
							<input class="form-control" name="care_tutor" value="1" type="hidden" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group ">
										<label class="control-label " for="title">
											Title
										</label>
										<input class="form-control" id="title" name="title" readonly
											value="@foreach($categories as $category){{$category->name.', '}}@endforeach"
											type="text" />
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
										<input class="form-control" id="title" name="duration" readonly
											value="@foreach($categories as $category){{$category->duration.' hours, '}}@endforeach"
											type="text" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you wish to 'Include Mileage'?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="mileage" id="mileage" value="0">No
											</label>
											<label>
												<input type="radio" name="mileage" id="mileage" value="1">Yes
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you wish to 'Include hotel cost'?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="hotel_cost" id="hotel_cost"
													value="0">No
											</label>
											<label>
												<input type="radio" name="hotel_cost" id="hotel_cost" value="1">Yes
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group radio">
										<label class="control-label " for="booking_address">
											Booking Address1
										</label><br>
										<label for="usr"><input type="radio" data-tutor_id='{{$usersMeta->id}}' required
												name="booking_address" value="0" id="usr">Company Address</label>
										<label for="na"><input type="radio" data-tutor_id='{{$usersMeta->id}}' required
												name="booking_address" value="1" id="na">Delivery Address</label><br>
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
											<input class="form-control" id="street_name" name="street_name"
												type="text" />
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
												@foreach(\App\Model\Country::all() as $country)

												@if(isset($country->children['0']))

												<optgroup label="{{$country->name}}" data-max-options="1">

													@foreach($country->children as $categorieChild)

													<option value="{{$categorieChild->name}}"
														{{ !empty($usersMeta->tutor_profile->country) ? $categorieChild->name ==$usersMeta->tutor_profile->country   ? 'selected="selected"' : '' : ''}}>
														{{$categorieChild->name}}</option>

													@endforeach
												</optgroup>

												@endif

												@endforeach


											</select>

										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label class="control-label " for="country">
												Country
											</label>
											<select class="form-control" id="country" name="country">
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
											<input class="form-control" id="zip" name="zip" type="text" />
											@if ($errors->has('zip'))
											<span class="help-block">
												<strong>{{ $errors->first('zip') }}</strong>
											</span>
											@endif
										</div>
									</div>
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
											<input class="form-control" type="text" name="distance" id="distance"
												readonly>
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

								<div class="col-md-6">
									<div class="form-group ">
										<label class="control-label " for="time_start">
											Start Time<span class="asteriskField">*</span>
										</label>
										<input type="time" id="time_start" name="time_start" min="06:00" max="18:00"
											required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group ">
										<label class="control-label " for="time_end">
											End Time<span class="asteriskField">*</span>
										</label>
										<input type="time" id="time_end" name="time_end" min="06:00" max="18:00"
											required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group ">
										<label class="control-label " for="description">
											Description
										</label>
										<textarea class="form-control" name="description" value=""
											id="description"></textarea>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
										<span class="text-danger">
											<span id="description-error"></span>
										</span>
									</div>

								</div>
							</div>
							@php $care_cost=0;@endphp
							@foreach($categories as $category)
							@php $care_cost +=$category->cost;@endphp
							@endforeach

							<input class="form-control" value="{{$care_cost}}" name="rate" type="hidden" id="rate">

							@else
							<input name="title" id="job_title" value="" type="hidden" />
							<div class="row">
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
										<select required class="form-control" id="type_levels"
											onchange="fetch_select(this.value)" name="type_levels">
											@php $title=''; @endphp
											@if(!empty(\Input::get('disciplines')))
											@foreach($usersMeta->disciplines as $discipline)
											@if (in_array($discipline->id , \Input::get('disciplines')))
											<option value="{{$discipline->id}}">{{$discipline->name}}</option>
											@php $title=$discipline->name; @endphp
											@endif
											@endforeach
											@endif
										</select>
										<input type="hidden" name="title" value="{{$title}}">
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

										<select required class="form-control" id="specialist"
											onchange="fetch_select_cat(this.value);" name="specialist">
											@if(!empty(\Input::get('specialist')))
											@foreach($usersMeta->categories as $category)
											@if (in_array($category->id , \Input::get('specialist')))
											<option value="{{$category->id}}">{{$category->name}}</option>
											@endif
											@endforeach
											@endif
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
										<select required class="form-control" id="qualified_levels"
											name="qualified_levels">
											@if(!empty(\Input::get('level')))
											@foreach($usersMeta->qualified_level as $level)
											@if (in_array($level->id , \Input::get('level')))
											<option value="{{$level->id}}">{{isset($level->name)?$level->name:''}}
											</option>
											@endif
											@endforeach
											@endif
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
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you wish to 'Include Mileage'?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="mileage" id="mileage" value="0">No
											</label>
											<label>
												<input type="radio" name="mileage" id="mileage" value="1">Yes
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you wish to 'Include hotel cost'?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="hotel_cost" id="hotel_cost"
													value="0">No
											</label>
											<label>
												<input type="radio" name="hotel_cost" id="hotel_cost" value="1">Yes
											</label>
										</div>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group radio">
										<label class="control-label " for="booking_address">
											Booking Address
										</label><br>

										<label for="usr"><input data-tutor_id='{{$usersMeta->id}}' type="radio" required
												name="booking_address" value="0" id="usr">Company Address</label>
										<label for="na"><input data-tutor_id='{{$usersMeta->id}}' type="radio" required
												name="booking_address" value="1" id="na">Delivery Address</label><br>
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
											<input class="form-control" id="street_name" name="street_name"
												type="text" />
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
												@foreach(\App\Model\Country::all() as $country)

												@if(isset($country->children['0']))

												<optgroup label="{{$country->name}}" data-max-options="1">

													@foreach($country->children as $categorieChild)

													<option value="{{$categorieChild->name}}"
														{{ !empty($usersMeta->tutor_profile->country) ? $categorieChild->name ==$usersMeta->tutor_profile->country   ? 'selected="selected"' : '' : ''}}>
														{{$categorieChild->name}}</option>

													@endforeach
												</optgroup>
												@endif
												@endforeach
											</select>

										</div>
									</div>

									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label class="control-label " for="country">
												Country
											</label>

											<select class="form-control" id="country" name="country">
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
											<input class="form-control" id="zip" name="zip" type="text" />
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
											<input class="form-control" type="text" name="distance" id="distance"
												readonly>
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
								<div class="col-md-6">
									<div class="form-group ">
										<label class="control-label " for="time_start">
											Start Time<span class="asteriskField">*</span>
										</label>
										<input type="time" id="time_start" name="time_start" min="06:00" max="18:00"
											required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group ">
										<label class="control-label " for="time_end">
											End Time<span class="asteriskField">*</span>
										</label>
										<input type="time" id="time_end" name="time_end" min="06:00" max="18:00"
											required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group ">
										<label class="control-label " for="description">
											Description
										</label>
										<textarea class="form-control" name="description" value=""
											id="description"></textarea>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
										<span class="text-danger">
											<span id="description-error"></span>
										</span>
									</div>
								</div>
							</div>
							@endif
						</fieldset>
					</div>
					<div id="step1" class="stepDetails" style="display: none;">
						<fieldset>
							<legend>Equipment Information</legend>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you have an onsite projector?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="onsite_projector"
													id="onsite_projector" value="0">No
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
												<input type="radio" name="wipe_board" id="wipe_board" value="1">Yes
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
												<input type="radio" checked name="flip_chart_and_stand"
													id="flip_chart_and_stand" value="0">No
											</label> <label>
												<input type="radio" name="flip_chart_and_stand"
													id="flip_chart_and_stand" value="1">Yes
											</label>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>

											Do any of the Audience have any learning difficulties or disabilities that
											we
											need to be aware of?
										</label>

										<div class="radio">
											<label>
												<input type="radio" checked name="disabilities" id="disabilities"
													value="0">No
											</label> <label>
												<input type="radio" name="disabilities" id="disabilities" value="1">Yes
											</label>
										</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div id="difficulty_div" class="col-md-6 col-sm-6" style="display:none;">
									<div class="form-group">
										<label class="control-label" for="difficulty_info">
											Please fill details of difficulty<span class="asteriskField">*</span>
										</label>
										<textarea id="difficulty_info" name="difficulty_info" class="form-control"
											rows="3"></textarea>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>
											Do you have an IT Suite/I.T equipment available for use if necessary?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="equipment_available"
													id="equipment_available" value="0">No
											</label> <label>
												<input type="radio" name="equipment_available" id="equipment_available"
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
											Is there any equipment available onsite to be used? , if not, please tell us
											what you would like provided?
										</label>
										<div class="radio">
											<label>
												<input type="radio" checked name="equipment_available_onsite"
													id="equipment_available_onsite" value="0">No
											</label> <label>
												<input type="radio" name="equipment_available_onsite"
													id="equipment_available_onsite" value="1">Yes
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6" id="eqipment_div">
									<div class="form-group">
										<label class="control-label" for="equipment_info">
											Please fill equipment details<span class="asteriskField">*</span>
										</label>
										<textarea id="equipment_info" name="equipment_info" class="form-control"
											rows="3"></textarea>
									</div>
								</div>
							</div>

							<input type="hidden" value="@if(!empty(\Input::get('cat_id'))){{$care_cost}}@endif"
								name="total" id="total">
							<div class="row">
								<div class="col-md-12 summary">
									<span id="cost"></span>
									<div id="additional_cost"></div>
									<span id="total_text"></span><br>
									@if(empty(\Input::get('cat_id')))
									<div class="">
										<label class="checkbox">
											<input required="" class="" name="fifty" type="checkbox" id="fifty"><span>I
												agree to 30days invoice terms</span>
										</label>
									</div>
									@else
									<div class="row payment_row">
										<div class="col-md-12 col-lg-12 col-sm-12">
											<h3>Select a payment method</h3>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4">
											<div class="pymnt_optns">
												<div class="pymnt_optns1 cs_py">
													<i class="far fa-credit-card"></i>
													<div class="cstm-bc-cntr">
														<label class="radio">
															<input type="radio" name="py_slct" value="CREDIT CARD"
																class="chk_py" checked="">CREDIT CARD</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4">
											<div class="pymnt_optns2 cs_py">
												<i class="fas fa-money-check-alt"></i>
												<div class="cstm-bc-cntr">
													<label class="radio">
														<input type="radio" name="py_slct" value="BANK TRANSFER"
															class="chk_py">BANK TRANSFER</label>
												</div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4">
											<div class="pymnt_optns3 cs_py">
												<i class="fas fa-file-invoice-dollar"></i>
												<div class="cstm-bc-cntr">
													<label class="radio">
														<input type="radio" name="py_slct" value="INVOICING"
															class="chk_py">INVOICING</label>
												</div>
											</div>
										</div>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
										<span class="text-danger">
											<span id="fifty-error"></span>
										</span>
									</div>
									@endif

								</div>

							</div>
							<input type="submit" name="insert" id="insert" value="Book a Tutor"
								class="btn btn-success" />
						</fieldset>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /Modal content-->
	</div>
</div>
<!-- /Modal-->
<!-- Course Modal -->
<div class="modal fade maiilModal" id="course_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
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
<!-- /Course Modal -->
@push('scripts')
<script src="{{ asset('js/admin/formtowizard.js') }}" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>
<script src="{{ asset('js/admin/jquery-ui.multidatespicker.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript" ></script>
<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<script>

	

	$(document).ready(function () {
		$('#date').multiDatesPicker({
			altField: '#altField',
			dateFormat: "dd/mm/yy",
			minDate: 3, // Booking dates should be selected after 2 days of current date
			@php
			if (!empty($dates)) {
				@endphp
				addDisabledDates: [@php echo $dates;@endphp],
					@php
			}
			@endphp
			onSelect: function (date) {
				priceAjax();
			}
		});
		$('#city').multiselect({
			nonSelectedText: 'Select Type',
			enableFiltering: true,
			multiselect: false,
			enableCaseInsensitiveFiltering: true,
			buttonWidth: '220px'
		});


	});
	$('input[name="equipment_available_onsite"]').change(function () {
		if ($(this).val() == 0) {
			$('#eqipment_div').show();
		} else {
			$('#eqipment_div').hide();
		}
	});
	$('input[name="disabilities"]').change(function () {
		if ($(this).val() == 1) {
			$('#difficulty_div').show();
		} else {
			$('#difficulty_div').hide();
		}
	});
	$('#usr').click(function () {
		$('#address_box').hide();
	});
	$('#na').click(function () {
		$('#address_box').show();
	});
	$('input[name="booking_address"],#address,#street_name,#city,#zip').change(function () {

		var tutor_id = $('input[name="booking_address"]').data('tutor_id');
		$('#distance').val('');
		$('#time').val('');
		var address_option = $("input[name='booking_address']:checked").val();
		if (address_option && $('#address').val() != "" && $('#city').val() != "" && $('#street_name').val() !=
			"" && $('#zip').val() != "") {

			check_distance(tutor_id);
			//priceAjax();
		}
		if (address_option == 0) {
			check_distance(tutor_id);
			//priceAjax();
		}

	});



	function check_distance(tutor_id) {

		var address_option = $("input[name='booking_address']:checked").val();
		//if(address_option){
		var address = $('#address').val();
		var city = $('#city').val();
		var street_name = $('#street_name').val();
		var zip = $('#zip').val();
		var country = $('#country').val();
		//}else{

		//}

		var booking_days = parseInt($('#date').multiDatesPicker('getDates').length);

		//alert(booking_days);


		$.ajax({
			type: 'POST',
			url: "{{url('/tutors/get_coordinates')}}",
			data: {
				'address_option': address_option,
				'address': address,
				'tutor_id': tutor_id,
				'city': city,
				'street_name': street_name,
				'zip': zip,
				'country': country,
				"_token": "{{ csrf_token() }}"
			},
			success: function (data) {
				var response = $.parseJSON(data);
				if (response.status == 'OK') {

					var distance_text = response.rows[0].elements[0].distance.text;
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
		return new Date(mdy[2], mdy[0] - 1, mdy[1]);
	}

	function showDays(firstDate, secondDate) {
		var startDay = new Date(firstDate);
		var endDay = new Date(secondDate);
		var millisecondsPerDay = 1000 * 60 * 60 * 24;
		var millisBetween = startDay.getTime() - endDay.getTime();
		var days = (millisBetween / millisecondsPerDay) + 1;
		// Round down.
		return (Math.floor(days));
	}

	function fetch_select(val) {
		var optionText = $('#type_levels option[value="' + val + '"]').text();
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

	function getLevels(val) {

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
					document.getElementById("qualified_levels").innerHTML = response.qualifiedlevel;
					$('#rate').val(response.rate);
					priceAjax();
				}
			}

		});
	}
</script>


<script>
	$('#myModal1').click(function (e) {
		// var tutor_id=$(this).data('tutor_id');
		$.ajax({
			type: 'POST',
			url: "{{url('/tutors/check_limit')}}",
			data: {
				'check': 'booked',
				"_token": "{{ csrf_token() }}"
			},
			success: function (data) {
				//var response=$.parseJSON(data);
				//console.log(data);
				//alert (data);
				if (parseInt(data)) {
					getLevels(
						{{Input::get('specialist')[0]}}
					);
					$('#myModal').modal({
						backdrop: 'static',
						keyboard: false
					});
				} else {
					alert(
						'You have used all of your direct bookings.Please renew your subscription plan.');
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
	$("#myModal2").click(function () {
		// $('#title-error').html("");
		var ids = $(this).data('id');
		// var ids = 88;
		//alert(ids);

		//$("#tutor_id").val(ids);
		$.ajax({
			type: 'GET',
			url: "{{url('/admin/view_rating/')}}" + '/' + ids,
			data: { //tutorid:ids,

			},
			success: function (data) {

				console.log(data);
				var res = JSON.parse(data);
				//alert(res);
				console.log(res[0].comment);
				//$("#sid").val(res.tutor_profile.updatesid);
				$("#comment").text('');
				$(".rating_no").text('');
				$('#rating_img').attr('src', '');


				$("#comment").text(res[0].comment);
				$('#rating_img').attr('src', res[0].star_img);
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
					var job_id = data.job_id;
					var total = data.total;
					var care_tutor = data.care_tutor;
					$('#insert_form').trigger("reset");
					/*bootoast.toast({
					    message: data.message
					});*/
					$('#myModal').modal({
						backdrop: 'static',
						keyboard: false
					})
					window.location.href = "{{url('/booking')}}" + '?job_id=' + job_id +
						'&care_tutor=' + care_tutor;
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
		var tutor_cost = booking_days * $('#rate').val();
		//console.log(booking_days);

		//alert(dates);
		var distance_text = $('#distance').val();
		//alert(distance_text);
		$('#cost').text('Tutor Cost: £' + tutor_cost);
		var total_additional = 0;
		@if(!empty(\Input::get('cat_id')))
		//alert('cond1');
		var travel_cost = 2 * booking_days * parseFloat(distance_text) * 0.30;
		total_additional = travel_cost;
		total_additional = 0; /*temporary*/
		/* temporary commented nned to check anf fixed*/
		//$('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £'+travel_cost.toFixed(2));
		@else
		//alert('cond2');
		if ($('#use_time').val() != "") {
			if ($('#use_time').val() > 7200) { //Add hotel cost when travel time is more than 2 hours
				//alert('cond3');
				var hotel_cost = 50 * booking_days;

				//alert(parseInt(distance_text));
				var travel_cost = 2 * parseInt(distance_text) * 0.30;
				var hot_booking_dist = 15;
				var travel_cost_hot_booking = 2 * booking_days * hot_booking_dist * 0.30;
				total_additional = hotel_cost + travel_cost + travel_cost_hot_booking;
				$('#additional_cost').html('Hotel Cost: £' + hotel_cost.toFixed(2) +
					' <br>Travel Cost from Tutor Venue to Hotel: £' + travel_cost.toFixed(2) +
					' <br>Travel Cost from Hotel to Booking Address: £' + travel_cost_hot_booking.toFixed(2));
			} else {
				//alert('cond4');
				var travel_cost = 2 * booking_days * parseInt(distance_text) * 0.30;
				$('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £' + travel_cost.toFixed(2));
				total_additional = travel_cost;
			}
		}
		@endif
		//alert('cond5');
		var total_cost = total_additional + parseInt(tutor_cost);
		$('#total').val(total_cost.toFixed(2));
		$('#total_text').text('Total: £' + total_cost.toFixed(2));
	}
</script>


@endpush
@stop