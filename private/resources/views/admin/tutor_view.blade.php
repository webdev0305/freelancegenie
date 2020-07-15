@extends('layouts.admin.dashboard')
@section('page_heading','View Tutor')
@section('section')
    @include('message.message')
    <div class="view-page">
        <div class="text-wrap  mb2">
		<section class="plan_details_employer">

		<div class="button_details"><i class="fas fa-arrow-alt-circle-left"></i></div>

		<div class="inner_plan_details">
		<h4>Plan Details</h4>
		<p><strong>Plan:</strong> {{(isset($subs->plan->title))?$subs->plan->title:''}}</p>
		</div>
		</section>
            <div class="img-wrap text-center">
                @if (empty(\Sentinel::check()))
                    <img class="img-responsive blurr" src="{{asset('images/photo/'.$usersMeta->photo)}}">
                @else
                    <img class="img-responsive" src="{{asset('images/photo/'.$usersMeta->photo)}}">
                @endif
            </div>
            <div class="heading"><h2>Personal Information</h2></div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>First Name:</strong>
                            <span>{{$usersMeta->first_name}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Last Name:</strong>
                            <span>{{$usersMeta->last_name}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Phone:</strong>
                            <span>{{$usersMeta->phone}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Address:</strong>
                            <span>{{$usersMeta->tutor_profile->address}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>City:</strong>
                            <span>{{$usersMeta->tutor_profile->city}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>State:</strong>
                            <span>{{$usersMeta->tutor_profile->state}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Country:</strong>
                            <span>U.K</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Zip:</strong>
                            <span>{{$usersMeta->tutor_profile->zip}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Work Permit</h2>
                    </div>
                    <div class="col-md-4 text-right">
                        <a download="{{$usersMeta->tutor_profile->work_permit}}"
                           href="{{asset('images/work_permit').'/'.$usersMeta->tutor_profile->work_permit}}"
                           title="ImageName">
                            {!!($usersMeta->tutor_profile->work_permit != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Full UK Driving License?:</strong>
                            <span>{{$usersMeta->tutor_profile->driving_license == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Are you willing to Travel?:</strong>
                            <span>{{$usersMeta->tutor_profile->willing_travel == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Please select the locations willing to travel</strong>
                            @foreach($ttrLocaWill as $LocaWill)
                                <span class="multiple">{{$LocaWill->name}}</span>
                            @endforeach</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Do you have the right to work in the UK?:</strong>
                            <span>{{$usersMeta->tutor_profile->driving_license == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit No:</strong>
                            <span>{{$usersMeta->tutor_profile->permit_no}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit Start Date:</strong>
                            <span>{{$usersMeta->tutor_profile->permit_start_date}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit Expiry Date:</strong>
                            <span>{{$usersMeta->tutor_profile->permit_expiry_date}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <h2>Languages</h2>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Do you speak any other languages?:</strong>
                            <span>{{$usersMeta->tutor_profile->speak_languages == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Language:</strong>
                            @foreach($ttrLan as $lang)
                                <span class="multiple">{{$lang->name}}</span> @endforeach</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Level of Fluency:</strong>
                            <span>{{($usersMeta->tutor_profile->level_of_fluency == 0) ? "Basic understanding" : (($usersMeta->tutor_profile->level_of_fluency == 1)  ? "Semi-Fluent" : "Fluent")}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Passport</h2>
                    </div>
                    <div class="col-md-4 text-right">
                        <a download="{{$usersMeta->tutor_profile->passport}}"
                           href="{{asset('images/passport').'/'.$usersMeta->tutor_profile->passport}}"
                           title="ImageName">
                        {!!($usersMeta->tutor_profile->passport != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit No:</strong>
                            <span>{{$usersMeta->tutor_profile->passport_no}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit Start Date:</strong>
                            <span class="">{{$usersMeta->tutor_profile->pass_start_date}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Permit Expiry Date:</strong>
                            <span>{{$usersMeta->tutor_profile->pass_expiry_date}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>DBS Certertificate</h2>
                    </div>
                    <div class="col-md-4 text-right">
                        <a download="{{$usersMeta->tutor_profile->dbs_cert_upload}}"
                           href="{{asset('images/dbs_cert').'/'.$usersMeta->tutor_profile->dbs_cert_upload}}"
                           title="ImageName">
                            {!!($usersMeta->tutor_profile->dbs_cert_upload != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Do you have a current DBS Cert?:</strong>
                            <span>{{$usersMeta->tutor_profile->passport_no}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>Enter the date the Certificate was issued?:</strong>
                            <span class="">{{$usersMeta->tutor_profile->cert_issued}}</span></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="out-wrap">
                        <p><strong>If entered yes, please enter your DBS certificate no:</strong>
                            <span class="">{{$usersMeta->tutor_profile->dbs_certificate_no}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Internet Update Service</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Did you register for the Internet Update Service?:</strong>
                            <span>{{$usersMeta->tutor_profile->internet_update_service == '1' ? 'YES' : 'NO'}}</span>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Enter the date the Certificate was issued?:</strong>
                            <span class="">{{$usersMeta->tutor_profile->cert_issued}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Disabilities</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have any disabilities?:</strong>
                            <span>{{$usersMeta->tutor_profile->disabilities == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have any medical conditions that we need to be aware of?:</strong>
                            <span class="">{{$usersMeta->tutor_profile->medical_conditions == '1' ? 'YES' : 'NO'}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Organization</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            @if($usersMeta->organisations_work)
                @foreach($usersMeta->organisations_work as $organisation)
                    <div class="row mb1">
                        <div class="col-sm-6">
                            <div class="out-wrap">
                                <p><strong>Company name:</strong>
                                    <span>{{$organisation->company_name}}</span></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="out-wrap">
                                <p><strong>Registration:</strong>
                                    <span class="">{{$organisation->registration}}</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Skills</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            @foreach($usersMeta->categories as $keyCat=>$categorie)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="out-wrap">
                            <p><strong>Skills name:</strong>
                                <span>{{$categorie->name}}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="out-wrap">
                            <p><strong>Qualified:</strong>
                                <span class="">{{$usersMeta->qualified_level[$keyCat]->level}}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Certificates</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Birth Certificate:</strong>
                            <span class=""><a download="{{$usersMeta->tutor_profile->birth_certificate}}"
                                              href="{{asset('images/birth_certificate').'/'.$usersMeta->tutor_profile->birth_certificate}}"
                                              title="ImageName">
             {!!($usersMeta->tutor_profile->birth_certificate != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                          </a></span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>CV:</strong>
                            <span class=""><a download="{{$usersMeta->tutor_profile->cv}}"
                                              href="{{asset('images/cv').'/'.$usersMeta->tutor_profile->cv}}"
                                              title="ImageName">
                               {!!($usersMeta->tutor_profile->cv != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                            </a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Certificates:</strong>
                            <span class=""><a download="{{$usersMeta->tutor_profile->birth_certificate}}"
                                              href="{{asset('images/birth_certificate').'/'.$usersMeta->tutor_profile->birth_certificate}}"
                                              title="ImageName">
                                  {!!($usersMeta->tutor_profile->birth_certificate != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                         </a></span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Teaching Qualifications:</strong>
                            <span class="">
                                <a download="{{$usersMeta->tutor_profile->teaching_qual}}"
                                   href="{{asset('images/teaching_qual').'/'.$usersMeta->tutor_profile->teaching_qual}}"
                                   title="ImageName">
                              {!!($usersMeta->tutor_profile->teaching_qual != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
                   </a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Teaching Certificates:</strong>
                            <span class=""><a download="{{$usersMeta->tutor_profile->teaching_cert}}"
                                              href="{{asset('images/teaching_cert').'/'.$usersMeta->tutor_profile->teaching_cert}}"
                                              title="ImageName">
                              {!!($usersMeta->tutor_profile->teaching_cert != '') ?  "<i class='fa fa-download' aria-hidden='true'></i>" : ''!!}
   </a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop