@include('message.message')
<?php //echo '<pre>';print_r($errors);?>
@if ($errors->any())
<span class="help-block">
    <strong>
        {{ implode(' ', $errors->all(':message')) }}
    </strong></span>
@endif
<?php //echo '<pre>';print_r($subs);die('I am here');?>
<fieldset>
    <legend>General Information</legend>
    <div class="row">
        <input type='checkbox'
            {{(isset($subs->plan->plan_no) && ($subs->plan->plan_no == "8" || $subs->plan->plan_no == "9")) ? 'checked' : ''}}
            id="plan_check" value="1" style="opacity:0; position:absolute; left:9999px;">

        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="first_name">
                    Email <span class="asteriskField">*</span>
                </label>
                <input class="form-control" disabled="disabled" id="email" value="{{$usersMeta->email}}" name=""
                    type="text" />
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="first_name">
                    First Name <span class="asteriskField">*</span>
                </label>
                <input class="form-control" id="first_name" value="{{$usersMeta->first_name}}" name="first_name"
                    type="text" />
                @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="last_name">
                    Last Name <span class="asteriskField">*</span>
                </label>
                <input class="form-control" id="last_name" value="{{$usersMeta->last_name}}" name="last_name"
                    type="text" />
                @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="phone">
                    Phone <span class="asteriskField">*</span>
                </label>
                <input class="form-control" id="phone" value="{{$usersMeta->phone}}" name="phone" type="text" />
                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="address">
                    House or Company Door No. <span class="asteriskField">*</span>
                </label>
                <input class="form-control" name="address" id="address" value="{{$usersMeta->tutor_profile->address}}">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="street_name">
                    Street Name
                </label>
                <input class="form-control" id="street_name" value="{{$usersMeta->tutor_profile->street_name}}"
                    name="street_name" type="text" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="country">
                    Town/City <span class="asteriskField">*</span>
                </label>
                <select class="form-control livesearch" name="country" id="country">
                    @foreach(\App\Model\Country::all() as $country)
                    @if(isset($country->children['0']))
                    <optgroup label="{{$country->name}}" data-max-options="1">
                        @foreach($country->children as $categorieChild)
                        <option value="{{$categorieChild->id}}"
                            {{ !empty($usersMeta->tutor_profile->country_id) ? $categorieChild->id ==$usersMeta->tutor_profile->country_id   ? 'selected="selected"' : '' : ''}}>
                            {{$categorieChild->name}}</option>
                        @endforeach
                        @endif
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="city">
                    Country <span class="asteriskField">*</span>
                </label>
                <select class="form-control" id="city" name="city">
                    <option selected>UK</option>
                </select>
                @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="zip">
                    Post Code <span class="asteriskField">*</span>
                </label>
                <input class="form-control" value="{{$usersMeta->tutor_profile->zip}}" id="zip" name="zip"
                    type="text" />
                @if ($errors->has('zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="control-label" for="about">
                    'About You' - Enter a Brief Synopsis <span class="asteriskField">*</span>
                </label>
                <textarea id="about" name="about" class="form-control"
                    rows="3">{{$usersMeta->tutor_profile->about}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">Company Details</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="tutor_company_name">Company Name</label>
                <input class="form-control" id="tutor_company_name"
                    value="{{$usersMeta->tutor_profile->tutor_company_name}}" name="tutor_company_name" type="text" />
                @if ($errors->has('tutor_company_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('tutor_company_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="company_address">House or Company Door No.</label>
                <input class="form-control" id="company_address" value="{{$usersMeta->tutor_profile->company_address}}"
                    name="company_address" type="text" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="comp_street_name">
                    Street Name
                </label>
                <input class="form-control" id="comp_street_name"
                    value="{{$usersMeta->tutor_profile->comp_street_name}}" name="comp_street_name" type="text" />
            </div>
        </div>
        <!--<div class="col-md-6 col-sm-6">
	<div class="form-group ">
		<label class="control-label " for="comp_city">
			Town/City
		</label>
		<input class="form-control" id="comp_city"
			   value="{{$usersMeta->tutor_profile->comp_city}}"
			   name="comp_city" type="text"/>
	  </div>
</div>-->
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="comp_country">
                    Town/City
                </label>
                <select class="form-control" name="comp_country" id="comp_country">
                    @foreach(\App\Model\Country::all() as $country)
                    @if(isset($country->children['0']))
                    <optgroup label="{{$country->name}}" data-max-options="1">
                        @foreach($country->children as $categorieChild)
                        <option value="{{$categorieChild->id}}"
                            {{ !empty($usersMeta->tutor_profile->comp_country_id) ? $categorieChild->id ==$usersMeta->tutor_profile->comp_country_id   ? 'selected="selected"' : '' : ''}}>
                            {{$categorieChild->name}}</option>
                        @endforeach
                        @endif
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="comp_city">
                    Country
                </label>
                <select name="comp_city" id="comp_city" class="form-control">
                    <option selected>UK</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="comp_postcode">
                    Postcode
                </label>
                <input class="form-control" id="comp_postcode" value="{{$usersMeta->tutor_profile->comp_postcode}}"
                    name="comp_postcode" type="text" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="contact_tel">
                    Contact tel
                </label>
                <input class="form-control" id="contact_tel" value="{{$usersMeta->tutor_profile->contact_tel}}"
                    name="contact_tel" type="text" />
                @if ($errors->has('contact_tel'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_tel') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="comp_email">
                    Company Email
                </label>
                <input class="form-control" id="comp_email" value="{{$usersMeta->tutor_profile->comp_email}}"
                    name="comp_email" type="text" />
                @if ($errors->has('comp_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('comp_email') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-sm-6">

            <div class="form-group ">

                <label class="control-label " for="company_reg_no">

                    Company Reg No

                </label>

                <input class="form-control" id="company_reg_no" value="{{$usersMeta->tutor_profile->company_reg_no}}"
                    name="company_reg_no" type="number" />

                @if ($errors->has('company_reg_no'))

                <span class="help-block">

                    <strong>{{ $errors->first('company_reg_no') }}</strong>

                </span>

                @endif

            </div>

        </div>



        <div class="col-md-6 col-sm-6">

            <div class="form-group ">

                <label class="control-label" for="company_vat_reg_no">

                    Company VAT REG No

                </label>

                <input class="form-control" id="company_vat_reg_no"
                    value="{{$usersMeta->tutor_profile->company_vat_reg_no}}" name="company_vat_reg_no" type="number" />

                @if ($errors->has('company_vat_reg_no'))

                <span class="help-block">

                    <strong>{{ $errors->first('company_vat_reg_no') }}</strong>

                </span>

                @endif

            </div>

        </div>

    </div>

</fieldset>
<fieldset>
    <legend>Professional Information</legend>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label> Full UK Driving License? </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="driving_license" id="driving_license" value="0" checked
                            {{ $usersMeta->tutor_profile->driving_license == '0' ?  "checked" : '' }}>No
                    </label>
                    <label>
                        <input type="radio" name="driving_license" id="driving_license" value="1"
                            {{ $usersMeta->tutor_profile->driving_license == '1' ?  "checked" : '' }}>Yes
                    </label></div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label>
                    Did you register for the Internet Update Service?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="internet_update_service" id="internet_update_service" value="0"
                            checked {{ $usersMeta->tutor_profile->internet_update_service == '0' ?  "checked" : '' }}>No
                    </label> <label>
                        <input type="radio" name="internet_update_service" id="internet_update_service" value="1"
                            {{ $usersMeta->tutor_profile->internet_update_service == '1' ?  "checked" : '' }}>Yes
                    </label></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label>
                    Do you have the right to work in the UK?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="work_in_uk" id="work_in_uk" value="0" checked
                            {{ $usersMeta->tutor_profile->work_in_uk == '0' ?  "checked" : '' }}>No
                    </label> <label>
                        <input type="radio" name="work_in_uk" id="work_in_uk" value="1"
                            {{ $usersMeta->tutor_profile->work_in_uk == '1' ?  "checked" : '' }}>Yes
                    </label></div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="language">
                    Select the languages you speak
                </label>
                <select name="language[]" id="language" multiple="" class="form-control">
                    @foreach(\App\Model\Language::all() as $lang)
                    <option value="{{$lang->id}}"
                        {{in_array($lang->id, ($usersMeta->tutor_profile->language_id ? unserialize($usersMeta->tutor_profile->language_id) : array())) ? ' selected="selected" ' : ''}}>
                        {{$lang->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--<div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>
                    Do you speak any other languages?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="speak_languages" id="speak_languages"
                               value="0"
                               checked {{ $usersMeta->tutor_profile->speak_languages == '0' ?  "checked" : '' }} >No
                    </label> <label>
                        <input type="radio" name="speak_languages" id="speak_languages"
                               value="1" {{ $usersMeta->tutor_profile->speak_languages == '1' ?  "checked" : '' }} >Yes
                    </label></div>
            </div>
        </div>-->
    </div>
    <div class="row">
        <!--<div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label> Level of Fluency </label>
                <div class="radio">
                    <label>
                        <input type="radio" checked name="level_of_fluency" id="level_of_fluency"
                               value="0" {{-- $usersMeta->tutor_profile->level_of_fluency == '0' ?  "checked" : '' --}} >Basic
                        understanding
                    </label>
                    <label>
                        <input type="radio" name="level_of_fluency" id="level_of_fluency"
                               value="1" {{-- $usersMeta->tutor_profile->level_of_fluency == '1' ?  "checked" : '' --}} >Semi-Fluent
                    </label>
                    <label>
                        <input type="radio" name="level_of_fluency" id="level_of_fluency"
                               value="2" {{-- $usersMeta->tutor_profile->level_of_fluency == '2' ?  "checked" : '' --}} >Fluent
                    </label></div>
            </div>
        </div>
		-->
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">DBS Information</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label>
                    Do you have a current DBS Cert?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="dbs_cert" id="dbs_cert2" value="0"
                            {{ $usersMeta->tutor_profile->dbs_cert == '0' ?  "checked" : '' }}>No
                    </label> <label>
                        <input type="radio" name="dbs_cert" id="dbs_cert" value="1"
                            {{ $usersMeta->tutor_profile->dbs_cert == '1' ?  "checked" : '' }}>Yes
                    </label>
                    <!--<label>
							<input type="radio" name="dbs_cert" id="dbs_cert3"
								   value="2" {{ $usersMeta->tutor_profile->dbs_cert == '2' ?  "checked" : '' }} >Registered for DBS With reference of Freelance Genie
						</label>-->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="control-label" for="dbs_certificate_no">
                    Please enter your DBS certificate no. <span class="asteriskField">*</span>
                </label>
                <input class="form-control valid" value="{{$usersMeta->tutor_profile->dbs_certificate_no}}"
                    id="dbs_certificate_no" name="dbs_certificate_no" type="number" aria-invalid="false">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label show" for="certificate_issued">
                    Enter the date the DBS Certificate was issued
                </label>
                <div data-date-format="yyyy-mm-dd" class="input-group date date_error" data-provide="datepicker">
                    <input readonly type="text" class="form-control" name="certificate_issued"
                        value="{{$usersMeta->tutor_profile->certificate_issued}}" id="certificate_issued">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"><i class="far fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label show" for="cert_issued">
                    Proposed end date of DBS Certificate
                </label>
                <div data-date-format="yyyy-mm-dd" class="input-group date date_error" data-provide="datepicker">
                    <input readonly type="text" value="{{$usersMeta->tutor_profile->cert_issued}}" class="form-control"
                        name="cert_issued" id="cert_issued">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"><i class="far fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label>
                    Have you registered for the DBS update service?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" name="dbs_update" id="dbs_update2" value="0"
                            {{ $usersMeta->tutor_profile->dbs_update == '0' ?  "checked" : '' }}>No
                    </label>
                    <label>
                        <input type="radio" name="dbs_update" id="dbs_update" value="1"
                            {{ $usersMeta->tutor_profile->dbs_update == '1' ?  "checked" : '' }}>Yes
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label show" for="dbs_reg_update_date">
                    Registration date for the DBS update service
                </label>
                <div data-date-format="yyyy-mm-dd" class="input-group date date_error" data-provide="datepicker">
                    <input readonly type="text" value="{{$usersMeta->tutor_profile->dbs_reg_update_date}}"
                        class="form-control" name="dbs_reg_update_date" id="dbs_reg_update_date">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"><i class="far fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="control-label" for="dbs_service_id">
                    Enter Update Service I.D. No.
                </label>
                <input class="form-control valid" value="{{$usersMeta->tutor_profile->dbs_service_id}}"
                    id="dbs_service_id" name="dbs_service_id" type="number" aria-invalid="false">
            </div>
        </div>
        <!--<div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label show" for="dbs_surname">
                    Surname
                </label>
                    <input type="text"
                           value="{{$usersMeta->tutor_profile->dbs_surname}}"
                           class="form-control" name="dbs_surname"
                           id="dbs_surname">
			</div>
        </div>-->
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">Locations willing to travel</h4>
        </div>
    </div>
    <div class="row">
        <!--<div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label> Are you willing to Travel? </label>
                <div class="radio">
                    <label>
                        <input type="radio" checked name="willing_travel" id="willing_travel"
                               value="0" {{ $usersMeta->tutor_profile->willing_travel == '0' ?  "checked" : '' }} >No
                    </label> <label>
                        <input type="radio" name="willing_travel" id="willing_travel"
                               value="1" {{ $usersMeta->tutor_profile->willing_travel == '1' ?  "checked" : '' }} >Yes
                    </label></div>
            </div>
        </div>-->
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <div class="tooltip_custom">
                    <label class="control-label show" for="travel_location">
                        Please select the locations willing to travel to below...
                        <i class="color-info fa fa-question-circle"></i>
                        <span class="tooltiptext">You will be booked for these locations</span>
                    </label>
                </div>
                <select class="form-control" multiple name="travel_location[]" id="travel_location">
                    @foreach($countries as $keyCun=>$country)
                    @if(isset($country->children['0']))
                    <optgroup label="{{$country->name}}" data-max-options="1">
                        @foreach($country->children as $categorieChild)
                        <option value="{{$categorieChild->id}}"
                            {{in_array( $categorieChild->id, $countryUser ) ? ' selected="selected" ' : ''}}>
                            {{$categorieChild->name}}</option>
                        @endforeach
                        @endif
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">Medical conditions/disabilities</h4>
        </div>
    </div>
    <div class="row">
        <!--<div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="control-label" for="disabilities?">
                    Do you have any disabilities?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" checked name="disabilities" id="disabilities"
                               value="0" {{ $usersMeta->tutor_profile->disabilities == '0' ?  "checked" : '' }} >No
                    </label> <label>
                        <input type="radio" name="disabilities" id="disabilities"
                               value="1" {{ $usersMeta->tutor_profile->disabilities == '1' ?  "checked" : '' }} >Yes
                    </label>
                </div>
            </div>
        </div>-->
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label class="control-label" for="medical_conditions?">
                    Do you have any medical conditions/disabilities that we need to be aware of?
                </label>
                <div class="radio">
                    <label>
                        <input type="radio" checked name="medical_conditions" id="medical_conditions" value="0"
                            {{ $usersMeta->tutor_profile->medical_conditions == '0' ?  "checked" : '' }}>No
                    </label> <label>
                        <input type="radio" name="medical_conditions" id="medical_conditions" value="1"
                            {{ $usersMeta->tutor_profile->medical_conditions == '1' ?  "checked" : '' }}>Yes
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6" id="condition_box"
            style="{{ $usersMeta->tutor_profile->medical_description == '0' ? 'display:none;' : ''}}">
            <div class="form-group">
                <label class="control-label" for="medical_description">
                    Describe the medical conditions and any disabilities
                </label>
                <input class="form-control valid" value="{{$usersMeta->tutor_profile->medical_description}}"
                    id="medical_description" name="medical_description" type="text" aria-invalid="false">
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>My Credentials</legend>
    <div class="row">
        <div class="col-md-12 col-sm-12" id="certificates_div">
            <div class="well clearfix first-well">
                <h2 class="credentials_form_title">Certifications</h2>
                <div id="first">
                    <?php //echo '<pre>';print_r($categorieUser);die('here');?>
                    @foreach($categorieUser as $keyCerti=>$categorie)
                    <div class="recordsetParent" id="parntDiv{{$keyCerti}}">
                        <div class="fieldRow clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <div id="div_disciplines_level" class="form-group">
                                        <label for="disciplines_{{$keyCerti}}_level"
                                            class="control-label  requiredField">
                                            Type<span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls disciplines_level types_div">
                                            <input type='checkbox' name='record' style="display:none;">
                                            <select class="form-control types length"
                                                name="disciplines_level[{{$keyCerti}}]"
                                                id="disciplines_{{$keyCerti}}_level">
                                                <option value="">Select Type</option>
                                                @foreach($disciplines as $discipline)
                                                @if(isset($discipline->childrenDisciplines['0']))
                                                <optgroup label="<?php echo $discipline->name;?>" data-max-options="1"
                                                    discipline_id="{{$discipline->id}}">
                                                    @foreach($discipline->childrenDisciplines as $disciplineChild)
                                                    <option value="{{$disciplineChild->id}}"
                                                        {{isset($usersMeta->disciplines[$keyCerti]) && $usersMeta->disciplines[$keyCerti]->id == $disciplineChild->id ? 'selected="selected"' : ''}}>
                                                        {{$disciplineChild->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" value="{{isset($categorie->id) ? encrypt($categorie->id) : ''}}"
                                        hidden name="certificates_id[{{$keyCerti}}]">
                                    <div id="div_certificates_categorie" class="form-group">
                                        <label for="certificates_{{$keyCerti}}__categorie"
                                            class="control-label  requiredField">
                                            Category<span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls certificates_categorie" id="category_{{$keyCerti}}_select">
                                            <select name="certificates_categorie[{{$keyCerti}}]"
                                                id="certificates_{{$keyCerti}}_categorie"
                                                class="selectpicker length form-control">
                                                <option value="">Select Specialism</option>
                                                @foreach($categories as $categorieItem)
                                                @if(isset($categorieItem->children['0']))
                                                @foreach($categorieItem->children as $categorieChild)
                                                @if($categorieChild->id == $categorie->id)
                                                <option selected value="{{$categorieChild->id}}">
                                                    {{$categorieChild->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="div_certificates_level" class="form-group">
                                        <label for="certificates_{{$keyCerti}}_level"
                                            class="control-label  requiredField">
                                            Level<span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls certificates_level">
                                            <select name="certificates_level[{{$keyCerti}}]"
                                                id="certificates_{{$keyCerti}}_level" class="length form-control">
                                                <option value="">Select Level</option>
                                                @foreach($levels as $level)
                                                @if(isset($level->childrenLevels['0']))
                                                <optgroup label="{{$level->level}}" data-max-options="1">
                                                    @foreach($level->childrenLevels as $levelChild)
                                                    <option value="{{$levelChild->id}}"
                                                        {{( isset($usersMeta->qualified_level[$keyCerti]) && $usersMeta->qualified_level[$keyCerti]->id == $levelChild->id) ? 'selected' : '' }}>
                                                        {{$levelChild->level}}</option> @endforeach
                                                    @endif
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="div_organization_registration" class="form-group certificates_valid">
                                        <label for="certificates_{{$keyCerti}}_valid"
                                            class="control-label  requiredField">
                                            Valid Untill<span class="asteriskField">*</span>
                                        </label>
                                        <div data-date-format="yyyy-mm-dd"
                                            class="input-group certificates_valid date date_error"
                                            data-provide="datepicker">
                                            <input type="text" readonly name="certificates_valid[{{$keyCerti}}]"
                                                value="{{isset($usersMeta->categories[$keyCerti]->pivot->valid) ? $usersMeta->categories[$keyCerti]->pivot->valid : ''}}"
                                                aria-invalid="false" id="certificates_{{$keyCerti}}_valid"
                                                class="textinput form-control length" />
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group ">
                                        <div id="div_certificates_rate" class="form-group certificates_rate">
                                            <label for="certificates_{{$keyCerti}}_rate"
                                                class="control-label  requiredField">
                                                Rate<span class="asteriskField">*</span>
                                            </label>
                                            <?php //print_r($usersMeta->categories[$keyCerti]->pivot);die('here');?>
                                            <input type="number" min="0" name="certificates_rate[{{$keyCerti}}]"
                                                id="certificates_{{$keyCerti}}_rate" class="length form-control"
                                                value="{{isset($usersMeta->categories[$keyCerti]->pivot->rate) ? $usersMeta->categories[$keyCerti]->pivot->rate : ''}}">
                                        </div>
                                    </div>
                                </div>
                                @if($keyCerti > '0')
                                <div id="parntDiv{{$keyCerti}}" class="bunPare" onchange="enableTxt(this)">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div id="czContainer">
                        <div id="first">
                            <div class="recordsetParent">
                                <div class="fieldRow clearfix">
                                    <div class="row">
                                        <input type="text" value="" hidden name="certificates_id[{{'2'}}]">
                                        <div class="col-md-3">
                                            <div id="div_disciplines_level" class="form-group">
                                                <label for="disciplines_1_level" class="control-label  requiredField">
                                                    Type<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls disciplines_level">
                                                    <div class="controls disciplines_level types_div">
                                                        <input type='checkbox' name='record' style="display:none;">
                                                        <select name="disciplines_level[{{'2'}}]"
                                                            id="disciplines_1_level" class="length form-control types">
                                                            <option value="">Select Type</option>
                                                            @foreach($disciplines as $discipline)
                                                            @if(isset($discipline->childrenDisciplines['0']) &&
                                                            $discipline->childrenDisciplines != '')
                                                            <optgroup label="{{$discipline->name}}"
                                                                data-max-options="1">
                                                                @foreach($discipline->childrenDisciplines as
                                                                $disciplineChild)
                                                                <option value="{{$disciplineChild->id}}">
                                                                    {{$disciplineChild->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="div_certificates_categorie" class="form-group">
                                                <label for="certificates_1_categorie"
                                                    class="control-label  requiredField">
                                                    Categorie<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls certificates_categorie" id="category_1_select">
                                                    <select name="certificates_categorie[{{'2'}}]"
                                                        id="certificates_1_categorie"
                                                        class="selectpicker length form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="div_certificates_level" class="form-group">
                                                <label for="certificates_1_level" class="control-label  requiredField">
                                                    Level<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls certificates_level">
                                                    <select name="certificates_level[{{'2'}}]" id="certificates_1_level"
                                                        class="length form-control">
                                                        <option value="">Select Level</option>
                                                        @foreach($levels as $levelVal)
                                                        @if(isset($levelVal->childrenLevels['0']) &&
                                                        $levelVal->childrenLevels != '')
                                                        <optgroup label="{{$levelVal->level}}" data-max-options="1">
                                                            @foreach($levelVal->childrenLevels as $levelChild)
                                                            <option value="{{$levelChild->id}}">{{$levelChild->level}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="div_organization_registration"
                                                class="form-group certificates_valid">
                                                <label for="certificates_1_valid" class="control-label  requiredField">
                                                    Valid Untill<span class="asteriskField">*</span>
                                                </label>
                                                <div data-date-format="yyyy-mm-dd"
                                                    class="input-group certificates_valid date date_error"
                                                    data-provide="datepicker">
                                                    <input type="text" readonly aria-invalid="false"
                                                        name="certificates_valid[{{'2'}}]" id="certificates_1_valid"
                                                        class="textinput form-control length" />
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"><i
                                                                class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div id="div_organization_registration"
                                                class="form-group certificates_rate">
                                                <label for="certificates_1_rate" class="control-label  requiredField">
                                                    Rate<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls certificates_rate">
                                                    <input type="number" min="0" name="certificates_rate[{{'2'}}]"
                                                        id="certificates_1_rate"
                                                        class="textinput form-control length" />
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="well clearfix second-well">
                <h2 class="credentials_form_title">Professional Bodies & Trade Union Memberships</h2>
                <div id="second">
                    @foreach($organisations as $keyWork=>$work_experience)
                    <div class="recordsetWork" id="parntDivWork{{$keyWork}}">
                        <input type="text" value="{{isset($work_experience->id) ? encrypt($work_experience->id) : ''}}"
                            hidden name="work_id[{{$keyWork}}]">
                        <div class="fieldRow clearfix">
                            <div class="row">
                                <div class="col-md-5">
                                    <div id="div_company_name" class="form-group">
                                        <label for="company_{{$keyWork}}_name"
                                            class="control-label  requiredField">Company
                                            Name<span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls company_name">
                                            <input type="text" name="company_name[{{$keyWork}}]"
                                                value="{{$work_experience->company_name}}"
                                                id="company_{{$keyWork}}_name" class="textinput form-control length" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div id="div_organization_registration" class="form-group">
                                        <label for="organization_1_registration" class="control-label  requiredField">
                                            Registration No.<span class="asteriskField">*</span>
                                        </label>
                                        <div class="controls organization_registration">
                                            <input type="number" name="organization_registration[{{$keyWork}}]"
                                                value="{{$work_experience->registration}}"
                                                id="organization_{{$keyWork}}_registration"
                                                class="textinput form-control length" />
                                        </div>
                                    </div>
                                </div>
                                @if($keyWork > '0')
                                <div id="parntDivWork{{$keyWork}}" class="bunPareWork" onchange="enableTxt(this)"><i
                                        class="fa fa-trash-o" aria-hidden="true"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div id="czContainerWork">
                        <div id="second">
                            <div class="recordsetWork">
                                <input type="text" value="" hidden name="work_id[{{'2'}}]">
                                <div class="fieldRow clearfix">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div id="div_company_name" class="form-group">
                                                <label for="company_1_name" class="control-label  requiredField">
                                                    Company Name<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls company_name">
                                                    <input type="text" name="company_name[{{'2'}}]" id="company_1_name"
                                                        class="textinput form-control length" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="div_organization_registration" class="form-group">
                                                <label for="organization_1_registration"
                                                    class="control-label  requiredField">
                                                    Registration<span class="asteriskField">*</span>
                                                </label>
                                                <div class="controls organization_registration">
                                                    <input type="text" name="organization_registration[{{'2'}}]"
                                                        id="organization_1_registration"
                                                        class="textinput form-control length" />
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well fourth-well">
                <div class="row">
                    <div class="col-md-12 col-sm-12" id="choose_option">
                        <div class="form-group">
                            <label>
                                Please choose the one you have <span class="asteriskField">*</span>
                            </label>
                            <div class="radio">
                                <label>
                                    <input {{ $usersMeta->tutor_profile->work_permit_option == '0' ?  'checked' : '' }}
                                        type="radio" id="rtowork1" name="rtowork" class="rtowork" value="0">Passport
                                </label> <label>
                                    <input {{ $usersMeta->tutor_profile->work_permit_option == '1' ?  'checked' : '' }}
                                        type="radio" id="rtowork2" name="rtowork" class="rtowork" value="1">Work Permit
                                </label>
                                <label>
                                    <input {{ $usersMeta->tutor_profile->work_permit_option == '2' ?  'checked' : '' }}
                                        type="radio" id="rtowork3" name="rtowork" class="rtowork" value="2">Home Office
                                    Doc, or I.D/Citzenship Card
                                </label> <label>
                                    <input {{ $usersMeta->tutor_profile->work_permit_option == '3' ?  'checked' : '' }}
                                        type="radio" id="rtowork4" name="rtowork" class="rtowork" value="3">Birth
                                    Certificate
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="passport"
        style="{{ $usersMeta->tutor_profile->work_permit_option == '0' ?  '' : 'display:none' }}">
        <div class="col-md-12">
            <div class="well third-well">
                <h2 class="credentials_form_title">Passport</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="checkbox" for="indifinite_st">
                                <input name="indifinite_st"
                                    {{ $usersMeta->tutor_profile->indifinite_st == '1' ?  'checked' : '' }}
                                    id="indifinite_st" value="1" onchange="manage_expiry(this)"
                                    type="checkbox">Indifinite Stay</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pass_start_date" class="control-label">
                                Start Date: <span class="asteriskField">*</span>
                            </label>
                            <div data-date-format="dd-mm-yyyy" class="input-group  date date_error  passStartDates"
                                data-provide="datepicker">
                                <input readonly type="text" class="form-control valid" name="pass_start_date"
                                    value="{{$usersMeta->tutor_profile->pass_start_date}}" id="pass_start_date">
                                <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" id="expiry_div"
                        style="{{ $usersMeta->tutor_profile->indifinite_st == '1' ?  'display:none' : '' }}">
                        <label for="pass_expiry_date" class="control-label">
                            Expiry Date: <span class="asteriskField">*</span>
                        </label>
                        <div data-date-format="dd-mm-yyyy" class="input-group date date_error permitEndDates"
                            data-provide="datepicker">
                            <input readonly type="text" readonly class="form-control valid" name="pass_expiry_date"
                                value="{{$usersMeta->tutor_profile->pass_expiry_date}}" id="pass_expiry_date">
                            <div class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="passport_no" class="control-label">
                                Passport No: <span class="asteriskField">*</span>
                            </label>
                            <input type="number" value="{{$usersMeta->tutor_profile->passport_no}}" name="passport_no"
                                id="passport_no" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="passport">
                                Upload Passport <span class="asteriskField">*</span>
                            </label>
                            <input name="passport" id="passport" type="file">
                            <a download="{{$usersMeta->tutor_profile->passport}}"
                                href="{{asset('images/passport').'/'.$usersMeta->tutor_profile->passport}}"
                                title="Passport">
                                {{($usersMeta->tutor_profile->passport != '') ? 'Download' : ''}}
                            </a>
                            @if ($errors->has('passport'))
                            <span class="help-block">
                                <strong>{{ $errors->first('passport') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="work_permit"
        style="{{ $usersMeta->tutor_profile->work_permit_option == '1' ?  '' : 'display:none;' }}">
        <div class="col-md-12">
            <div class="well fourth-well">
                <h2 class="credentials_form_title">Work Permit</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="checkbox" for="indifinite_workperm">
                                <input name="indifinite_workperm"
                                    {{ $usersMeta->tutor_profile->indifinite_workperm == '1' ?  'checked' : '' }}
                                    id="indifinite_workperm" value="1" onchange="manage_expiry_permit(this)"
                                    type="checkbox">Indifinite Stay</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="permit_start_date" class="control-label">
                            Start Date: <span class="asteriskField">*</span>
                        </label>
                        <div data-date-format="dd-mm-yyyy" class="input-group date date_error permitStartDates"
                            data-provide="datepicker">
                            <input readonly type="text" class="form-control valid" name="permit_start_date"
                                value="{{$usersMeta->tutor_profile->permit_start_date}}" id="permit_start_date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div id="expiry_permit_div" class="col-md-3">
                        <label for="permit_expiry_date" class="control-label">
                            Expiry Date: <span class="asteriskField">*</span>
                        </label>
                        <div data-date-format="dd-mm-yyyy" class="input-group date date_error permitEndDates"
                            data-provide="datepicker">
                            <input readonly type="text" readonly class="form-control valid" name="permit_expiry_date"
                                value="{{$usersMeta->tutor_profile->permit_expiry_date}}" id="permit_expiry_date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="permit_no" class="control-label">
                            Work Permit No: <span class="asteriskField">*</span>
                        </label>
                        <input type="number" value="{{$usersMeta->tutor_profile->permit_no}}" name="permit_no"
                            id="permit_no" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="work_permit">
                                Work Permit
                            </label>
                            <input name="work_permit" id="work_permit" type="file">
                            <a download="{{$usersMeta->tutor_profile->work_permit}}"
                                href="{{asset('images/work_permit').'/'.$usersMeta->tutor_profile->work_permit}}"
                                title="ImageName">
                                {{($usersMeta->tutor_profile->work_permit != '') ? 'Download' : ''}}
                            </a>
                            @if ($errors->has('work_permit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('work_permit') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="birth_certificate"
        style="{{ $usersMeta->tutor_profile->work_permit_option == '3' ?  '' : 'display:none' }}">
        <div class="col-md-12">
            <div class="well fourth-well">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="birth_certificate">
                                Upload Birth Certificate
                            </label>
                            <input name="birth_certificate" id="birth_certificate" type="file">
                            <a download="{{$usersMeta->tutor_profile->birth_certificate}}"
                                href="{{asset('images/birth_certificate').'/'.$usersMeta->tutor_profile->birth_certificate}}"
                                title="ImageName">
                                {{($usersMeta->tutor_profile->birth_certificate != '') ? 'Download' : ''}}
                            </a>
                            @if ($errors->has('birth_certificate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birth_certificate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="home_office_doc"
        style="{{ $usersMeta->tutor_profile->work_permit_option == '2' ?  '' : 'display:none' }}">
        <div class="col-md-12">
            <div class="well fourth-well">
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="checkbox" for="indifinite_homedoc">
                                <input name="indifinite_homedoc"
                                    {{ $usersMeta->tutor_profile->indifinite_homedoc == '1' ?  'checked' : '' }}
                                    id="indifinite_homedoc" value="1" type="checkbox">Indifinite Stay</label>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="teaching_qual">
                                Upload Home Office Doc, or I.D/Citzenship Card
                            </label>
                            <input name="teaching_qual" id="teaching_qual" type="file">
                            <a download="{{$usersMeta->tutor_profile->teaching_qual}}"
                                href="{{asset('images/teaching_qual').'/'.$usersMeta->tutor_profile->teaching_qual}}"
                                title="User photo">
                                {{($usersMeta->tutor_profile->teaching_qual != '') ? 'Download' : ''}}
                            </a>
                            @if ($errors->has('teaching_qual'))
                            <span class="help-block">
                                <strong>{{ $errors->first('teaching_qual') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well fourth-well">
                <h2 class="credentials_form_title">Bank Account Details</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank" class="control-label">
                                Bank Name: <span class="asteriskField">*</span>
                            </label>
                            <input type="text" value="{{$usersMeta->tutor_profile->bank}}" name="bank" id="bank"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account_fname" class="control-label">
                                Account Holder's Name: <span class="asteriskField">*</span>
                            </label>
                            <input type="text" value="{{$usersMeta->tutor_profile->account_fname}}" name="account_fname"
                                placeholder="Name appears on bank docs" id="account_fname" class="form-control" />
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <label for="account_mname"
                               class="control-label">
                            Account Holder's Middle Name (as it appears on bank docs): <span class="asteriskField">*</span>
                        </label>
                        <input type="text" value="{{$usersMeta->tutor_profile->account_mname}}"
                               name="account_mname"
                               id="account_mname"
                               class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label for="account_sname"
                               class="control-label">
                            Acc Holders Surname (as it appears on bank docs): <span class="asteriskField">*</span>
                        </label>
                        <input type="text" value="{{$usersMeta->tutor_profile->account_sname}}"
                               name="account_sname"
                               id="account_sname"
                               class="form-control"/>
                    </div>-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account_no" class="control-label">
                                Bank Account No: <span class="asteriskField">*</span>
                            </label>
                            <input type="number" value="{{$usersMeta->tutor_profile->account_no}}" name="account_no"
                                id="account_no" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="re_account_no" class="control-label">
                                Retype Bank Account No: <span class="asteriskField">*</span>
                            </label>
                            <input type="number" value="{{$usersMeta->tutor_profile->account_no}}" name="re_account_no"
                                id="re_account_no" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_code" class="control-label">
                                Bank Sort Code: <span class="asteriskField">*</span>
                            </label>
                            <input type="number" value="{{$usersMeta->tutor_profile->bank_code}}" name="bank_code"
                                id="bank_code" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="re_bank_code" class="control-label">
                                Retype Bank Sort Code: <span class="asteriskField">*</span>
                            </label>
                            <input type="number" value="{{$usersMeta->tutor_profile->bank_code}}" name="re_bank_code"
                                id="re_bank_code" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">Referee 1</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref1_company_name">Company Name</label>
                <input class="form-control" id="ref1_company_name"
                    value="{{$usersMeta->tutor_profile->ref1_company_name}}" name="ref1_company_name" type="text" />
                @if ($errors->has('ref1_company_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref1_company_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref1_name">Referee Full Name</label>
                <input class="form-control" id="ref1_name" value="{{$usersMeta->tutor_profile->ref1_name}}"
                    name="ref1_name" type="text" />
                @if ($errors->has('ref1_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref1_name') }}</strong>
                </span>
                @endif
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="ref1_contact_tel">
                    Contact tel
                </label>
                <input class="form-control" id="ref1_contact_tel"
                    value="{{$usersMeta->tutor_profile->ref1_contact_tel}}" name="ref1_contact_tel" type="text" />
                @if ($errors->has('ref1_contact_tel'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref1_contact_tel') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref1_email">
                    Email Address
                </label>
                <input class="form-control" id="ref1_email" value="{{$usersMeta->tutor_profile->ref1_email}}"
                    name="ref1_email" type="text" />
                @if ($errors->has('ref1_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref1_email') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4 class="form_inner_titile">Referee 2</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref2_company_name">Company Name</label>
                <input class="form-control" id="ref2_company_name"
                    value="{{$usersMeta->tutor_profile->ref2_company_name}}" name="ref2_company_name" type="text" />
                @if ($errors->has('ref2_company_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref2_company_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref2_name">Referee Full Name</label>
                <input class="form-control" id="ref2_name" value="{{$usersMeta->tutor_profile->ref2_name}}"
                    name="ref2_name" type="text" />
                @if ($errors->has('ref2_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref2_name') }}</strong>
                </span>
                @endif
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label " for="ref2_contact_tel">
                    Contact tel
                </label>
                <input class="form-control" id="ref2_contact_tel"
                    value="{{$usersMeta->tutor_profile->ref2_contact_tel}}" name="ref2_contact_tel" type="text" />
                @if ($errors->has('ref2_contact_tel'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref2_contact_tel') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group ">
                <label class="control-label" for="ref2_email">
                    Email Address
                </label>
                <input class="form-control" id="ref2_email" value="{{$usersMeta->tutor_profile->ref2_email}}"
                    name="ref2_email" type="text" />
                @if ($errors->has('ref2_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('ref2_email') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="well other-well v">
                <h2 class="credentials_form_title">Upload Documents</h2>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="photo">
                                Profile Image <span class="asteriskField">*</span>
                            </label>
                            <input name="photo" id="photo" type="file">
                            <a download="{{$usersMeta->photo}}" href="{{asset('images/photo').'/'.$usersMeta->photo}}"
                                title="{{$usersMeta->photo}}">
                                <?php echo ($usersMeta->photo != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="cv">
                                Resume <span class="asteriskField">*</span>
                            </label>
                            <input required name="cv" id="cv" type="file">
                            <a download="{{$usersMeta->tutor_profile->cv}}"
                                href="{{asset('images/cv').'/'.$usersMeta->tutor_profile->cv}}"
                                title="{{$usersMeta->tutor_profile->cv}}">
                                <?php echo ($usersMeta->tutor_profile->cv != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @if ($errors->has('cv'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cv') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="dbs_cert_upload">
                                Dbs Cert <span class="asteriskField">*</span>
                            </label>
                            <input required name="dbs_cert_upload" id="dbs_cert_upload" type="file">
                            <a download="{{$usersMeta->tutor_profile->dbs_cert_upload}}"
                                href="{{asset('images/dbs_cert_upload').'/'.$usersMeta->tutor_profile->dbs_cert_upload}}"
                                title="{{$usersMeta->tutor_profile->dbs_cert_upload}}">
                                <?php echo ($usersMeta->tutor_profile->dbs_cert_upload != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @if ($errors->has('dbs_cert_upload'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dbs_cert_upload') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="tooltip_custom">
                                <label class="control-label" for="certificates_upload">
                                    Teaching Certificates & other Certifications <span class="asteriskField">*</span>
                                    <i class="color-info fa fa-question-circle"></i>
                                    <span class="tooltiptext">Please attach all certificates ralated to Certifications
                                        section on top of this page.</span>
                                </label>
                            </div>
                            <input name="certificates_upload[]" id="certificates_upload" type="file"
                                multiple="multiple">
                            @if(isset($usersMeta->teaching_certificates))
                            @foreach($usersMeta->teaching_certificates as $certificates)
                            @if($certificates->type == 0)
                            <a download="{{$certificates->originalname}}"
                                href="{{url('../storage/app').'/'.$certificates->filename}}"
                                title="{{$certificates->originalname}}">
                                <?php echo ($certificates->originalname != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="professionalbodies_upload">
                                Professional Bodies docs <span class="asteriskField">*</span>
                            </label>
                            <input name="professionalbodies_upload[]" id="professionalbodies_upload" type="file"
                                multiple="multiple">
                            @if(isset($usersMeta->teaching_certificates))
                            @foreach($usersMeta->teaching_certificates as $certificates)
                            @if($certificates->type == 1)
                            <a download="{{$certificates->originalname}}"
                                href="{{url('../storage/app').'/'.$certificates->filename}}"
                                title="{{$certificates->originalname}}">
                                <?php echo ($certificates->originalname != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="drl">
                                Driving Licence <span class="asteriskField">*</span>
                            </label>
                            <input name="drl" id="drl" type="file">
                            <a download="{{$usersMeta->tutor_profile->drl}}"
                                href="{{asset('images/drl').'/'.$usersMeta->tutor_profile->drl}}"
                                title="{{$usersMeta->tutor_profile->drl}}">
                                <?php echo ($usersMeta->tutor_profile->drl != '') ? '<i class="fas fa-download"></i>' : ''?>
                            </a>
                            @if ($errors->has('drl'))
                            <span class="help-block">
                                <strong>{{ $errors->first('drl') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-md-12 col-sm-12">
			<h4 class="form_inner_titile">Subcontract Agreement</h4>
		</div>
	</div>
    <div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group ">
				<a href="{{url('tutor/freelancer_agree')}}" class="btn btn-default prev" id="preview_contract" name="preview_contract" style="width:250px">
					<i class="fas fa-pen-nib" aria-hidden="true"> Sign Contract</i>
				</a>
			</div>
		</div>
		<!-- <div class="col-md-6 col-sm-6">
			<div class="form-group ">
				<a href="" class="btn btn-default prev" id="preview_contract" name="preview_contract" style="width:250px">
					<i class="fa fa-file-text" aria-hidden="true"> Review Contract</i>
				</a>
			</div>
		</div> -->
	</div>
    <div class="row">
		<div class="col-md-12 col-sm-12">
			<h4 class="form_inner_titile"></h4>
		</div>
	</div>
    <div class="" id="div_checkbox">
        <button class="btn btn-success submit_button_custom" id="sads" name="submit" type="submit">Submit</button>
    </div>
</fieldset>
<div class="modal fade maiilModal" style="top:32%;z-index:9999999" id="dbs_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DBS Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                    <p id="comment">Please click on below link to register for the DBS update service:</p>
                    <a href="https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1"
                        target="_blank">https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade maiilModal" style="top:32%;z-index:9999999" id="dbs_cert_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DBS Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                    <p id="comment">Please click on below link for the DBS registration:</p><a
                        href="http://www.personnelchecks.co.uk/freelance-genie"
                        target="_blank">http://www.personnelchecks.co.uk/freelance-genie</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>-->
<script>
    function manage_expiry(element) {
        if (element.checked) {
            $("#expiry_div").hide();
        } else {
            $("#expiry_div").show();
        }
    }

    function manage_expiry_permit(element) {
        if (element.checked) {
            $("#expiry_permit_div").hide();
        } else {
            $("#expiry_permit_div").show();
        }
    }
    $(document).ready(function () {

        $('#country').multiselect({
            nonSelectedText: 'Select City',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            required: true
        });
        $('#comp_country').multiselect({

            nonSelectedText: 'Select City',

            enableFiltering: true,

            enableCaseInsensitiveFiltering: true,

            buttonWidth: '100%',

            required: true

        });

        /*$('.check_rtowork').click(function(){
    if($(this).val()==1){
    $('#choose_option').show();
	}
});*/
        $("input[name='medical_conditions']").change(function () {
            //alert($(this).val());
            if ($(this).val() == 1) {
                $('#condition_box').show();
            } else {
                $('#condition_box').hide();
            }
        });
        $('input[name="dbs_cert"]').change(function () {
            if ($(this).val() == 0) {
                $('#dbs_cert_modal').modal('show');
            } else {
                $('#dbs_cert_modal').modal('hide');
            }
        });
        $('input[name="dbs_update"]').change(function () {
            if ($(this).val() == 0) {
                $('#dbs_modal').modal('show');
            } else {
                $('#dbs_modal').modal('hide');
            }
        });
        /*$('#msform #step1Next').click(function(){
        	if($('input[name="dbs_update"]:checked').val()==0){
        		$('#dbs_modal').modal('show');
        	}else{
        		$('#dbs_modal').modal('hide');
        	}
        });*/
        $('.rtowork').click(function () {
            if ($(this).val() == 0) {
                $('#passport').show();
                $('#work_permit').hide();
                $('#birth_certificate').hide();
                $('#home_office_doc').hide();
            }
            if ($(this).val() == 1) {
                $('#work_permit').show();
                $('#passport').hide();
                $('#birth_certificate').hide();
                $('#home_office_doc').hide()
            }
            if ($(this).val() == 2) {
                $('#home_office_doc').show()
                $('#work_permit').hide();
                $('#passport').hide();
                $('#birth_certificate').hide();
            }
            if ($(this).val() == 3) {
                $('#birth_certificate').show();
                $('#work_permit').hide();
                $('#passport').hide();
                $('#home_office_doc').hide()
            }
        });
        $('#certificates_div').on('change', '.types',
    function () { //certificates_div is the outer div in which all dynamic content is added
            //alert('ok');
            var id = $(this).val();
            //const selectMembers = $("#specialist");
            //  selectMembers.empty();
            $('input[name="record"]').prop('checked', false);
            $(this).closest('#certificates_div .types_div').find('input[name="record"]').prop('checked',
                true);
            $("#certificates_div").find('input[name="record"]').each(function (i) {
                if ($(this).is(":checked")) {
                    var number = i;
                    //alert(number);
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/tutors/get_option')}}",
                        data: {
                            get_option: id,
                            page: 'tutor_profile',
                            index_num: number,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            //$('#sp').html(response);
                            /*$('.certificates_categorie').find(".length").each(function (index) {
                            	if (index == number){
                            	}
                            });*/
                            $('#category_' + number + '_select').html(response);
                            //selectMembers.append(response.categories);
                            //alert('here');
                            //$(this).closest('#certificates_div .recordset').html(response);
                            //$(this).closest('#certificates_div .recordset').find('.certificates_categorie').html(response);
                            //$('#sp').html(response);
                            $('#certificates_' + number + '_categorie')
                        .multiselect({
                                nonSelectedText: 'Select Specialism',
                                enableFiltering: true,
                                enableCaseInsensitiveFiltering: true,
                                buttonWidth: '100%'
                            });
                            console.log(response);
                        }
                    });
                }
            });
        });
    });
</script>
@endpush