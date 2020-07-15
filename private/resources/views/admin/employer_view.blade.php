@extends('layouts.admin.dashboard')
@section('page_heading','View Employer')
@section('section')
    @include('message.message')
    <div class="view-page">
        <div class="text-wrap  mb2">
		<section class="plan_details_employer">

		<div class="button_details"><i class="fas fa-arrow-alt-circle-left"></i></div>

		<div class="inner_plan_details">
		<h4>Plan Details</h4>
		<p><strong>Plan:</strong> {{$subs->plan->title}}</p>
		<p><strong>Subscription Expires On:</strong> {{$subs_end=date('d/m/Y', strtotime(' + '.$subs->plan->duration, strtotime($subs->updated_at)))}}</p>
		<p><strong>Bookings Made:</strong> {{(isset($SubscriptionLimit->booked))?($SubscriptionLimit->booked):$subs->plan->book_tutor}} out of {{$subs->plan->book_tutor}}</p>
		<p><strong>Assignment Posts:</strong> {{isset($SubscriptionLimit->assignment)?($SubscriptionLimit->assignment):$subs->plan->post_assignment}} out of {{$subs->plan->post_assignment}}</p>
		</div>
		</section>
            <div class="img-wrap text-center"> <img class="img-responsive" src="{{asset('images/photo/'.$usersMeta->photo)}}"></div>
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Phone:</strong>
                        <span>{{$usersMeta->phone}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="img-wrap text-center"> <img class="img-responsive" src="{{asset('images/company_logo/'.$usersMeta->employer_profile->company_logo)}}"></div>
            <div class="heading"><h2>Company Information</h2></div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Company Name:</strong>
                        <span>{{$usersMeta->employer_profile->company_name}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Company Address:</strong>
                        <span>{{$usersMeta->employer_profile->company_address}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Phone:</strong>
                        <span>{{$usersMeta->employer_profile->contact_tel}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Head Office Address:</strong>
                        <span>{{$usersMeta->employer_profile->head_office_address}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Authorised User:</strong>
                        <span>{{$usersMeta->employer_profile->authorised_user}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Other Authorised User:</strong>
                        <span>{{$usersMeta->employer_profile->authorised_user_second}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Contact Person:</strong>
                        <span>{{$usersMeta->employer_profile->contact_person}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Head Office Contact Person:</strong>
                        <span>{{$usersMeta->employer_profile->head_office_contact_person}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <!--<div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Second Contact Person:</strong>
                        <span>{{--$usersMeta->employer_profile->contact_person_second--}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Head Office Second Contact Person:</strong>
                        <span>{{--$usersMeta->employer_profile->head_office_contact_person_second--}}</span></p>
                    </div>
                </div>-->
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Department:</strong>
                        <span>{{$usersMeta->employer_profile->dept}}</span></p>
                    </div>
                </div>
                <!--<div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Second Department:</strong>
                        <span>{{--$usersMeta->employer_profile->dept_second--}}</span></p>
                    </div>
                </div>-->
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Contact No.:</strong>
                        <span>{{$usersMeta->employer_profile->contact_no}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Second Contact No.:</strong>
                        <span>{{$usersMeta->employer_profile->contact_no_second}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Email:</strong>
                        <span>{{$usersMeta->employer_profile->email}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Second Email:</strong>
                        <span>{{$usersMeta->employer_profile->email_second}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Company Registration Number:</strong>
                        <span>{{$usersMeta->employer_profile->company_reg_no}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Company VAT REG No:</strong>
                        <span>{{$usersMeta->employer_profile->company_vat_reg_no}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Will the Tutor be required to travel from different locations/sites?</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            @if($usersMeta->employer_profile->different_locations == '1')
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Address:</strong>
                        <span>{{$usersMeta->employer_profile->address}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>City:</strong>
                        <span>{{$usersMeta->employer_profile->city}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>State:</strong>
                        <span>{{$usersMeta->employer_profile->state}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Country:</strong>
                        <span>{{$usersMeta->country_employer['0']->name}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Zip:</strong>
                        <span>{{$usersMeta->employer_profile->zip}}</span></p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="text-wrap  mb2">
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have an onsite projector?</strong>
                        <span>{{$usersMeta->employer_profile->onsite_projector == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have a wipe board?</strong>
                        <span>{{$usersMeta->employer_profile->wipe_board == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have a flip chart and stand?</strong>
                        <span>{{$usersMeta->employer_profile->flip_chart_and_stand == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do any of the Audience have any learning difficulties or disabilities that we need to be aware of?</strong>
                        <span>{{$usersMeta->employer_profile->disabilities == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do you have an IT Suite/I.T equipment available for use if necessary?</strong>
                        <span>{{$usersMeta->employer_profile->flip_chart_and_stand == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do any of the Audience have any learning difficulties or disabilities that we need to be aware of?</strong>
                        <span>{{$usersMeta->employer_profile->equipment_available == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Is there any equipment available onsite to be used? , if not, please tell us what you would like provided?</strong>
                        <span>{{$usersMeta->employer_profile->equipment_available_onsite == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Do any of the Audience have any learning difficulties or disabilities that we need to be aware of?</strong>
                        <span>{{$usersMeta->employer_profile->equipment_available == '1' ? 'YES' : 'NO'}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-wrap  mb2">
            <div class="heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Who should they report to on the day?</h2>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Name:</strong>
                        <span>{{$usersMeta->employer_profile->report_name}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Department:</strong>
                        <span>{{$usersMeta->employer_profile->report_name}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row mb1">
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Additional Information:</strong>
                        <span>{{$usersMeta->employer_profile->additional_information}}</span></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="out-wrap">
                        <p><strong>Enter Additional Details:</strong>
                        <span>{{$usersMeta->employer_profile->additional_details}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop