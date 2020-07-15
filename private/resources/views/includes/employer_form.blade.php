@include('message.message')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<fieldset>
    <legend>General Information</legend>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
		<label class="control-label " for="first_name">Email</label>
		<input class="form-control" disabled="disabled" id="email" value="{{$usersMeta->email}}" name="" type="text"/>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
		<label class="control-label " for="first_name">First Name</label>
		<input class="form-control" id="first_name"	value="{{$usersMeta->first_name}}" name="first_name" type="text"/>
		@if ($errors->has('first_name'))
		<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>
		@endif
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
		<label class="control-label " for="last_name">
		Last Name
		</label>
		<input class="form-control" id="last_name" value="{{$usersMeta->last_name}}"
		name="last_name" type="text"/>
		@if ($errors->has('last_name'))
		<span class="help-block">
		<strong>{{ $errors->first('last_name') }}</strong>
		</span>
		@endif
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
			<label class="control-label" for="company_name">Company Name</label>
			<input class="form-control" id="company_name"
				   value="{{$usersMeta->employer_profile->company_name}}"
				   name="company_name" type="text"/>
					@if ($errors->has('company_name'))
				<span class="help-block">
				<strong>{{ $errors->first('company_name') }}</strong>
				</span>
				@endif
		</div>
	</div>

	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
			<label class="control-label " for="company_address">House or Company Door No.</label>
			<input class="form-control" id="company_address"
				   value="{{$usersMeta->employer_profile->company_address}}"
				   name="company_address" type="text"/>
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
		   value="{{$usersMeta->employer_profile->comp_street_name}}"
		   name="comp_street_name" type="text"/>
   </div>
</div>
<!--<div class="col-md-6 col-sm-6">
	<div class="form-group ">
		<label class="control-label " for="comp_city">
			Town/City
		</label>
		<input class="form-control" id="comp_city"
			   value="{{$usersMeta->employer_profile->comp_city}}"
			   name="comp_city" type="text"/>
	  </div>
</div>-->
<div class="col-md-6 col-sm-6">
            <div class="form-group ">
            <label class="control-label " for="comp_country">
                    Town/City
                </label>
                <select class="form-control" name="comp_country" id="comp_country">
@foreach(\App\Model\Country::all() as  $country)

            @if(isset($country->children['0']))

                <optgroup label="{{$country->name}}"

                          data-max-options="1">

                    @foreach($country->children as  $categorieChild)

                        <option value="{{$categorieChild->id}}" {{ !empty($usersMeta->employer_profile->comp_country_id) ? $categorieChild->id ==$usersMeta->employer_profile->comp_country_id   ? 'selected="selected"' : '' : ''}}>{{$categorieChild->name}}</option>

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

		<select name="comp_city" id="comp_city"
				class="form-control">
			<option selected>UK</option>
		</select> 
       
	</div>
</div>
<div class="col-md-6 col-sm-6">
	<div class="form-group ">
		<label class="control-label " for="comp_postcode">
			Postcode
		</label>
		<input class="form-control" id="comp_postcode"
			   value="{{$usersMeta->employer_profile->comp_postcode}}"
			   name="comp_postcode" type="text"/>
	   
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6 col-sm-6">
	<div class="form-group ">
		<label class="control-label " for="contact_tel">
			Contact tel
		</label>
		<input class="form-control" id="contact_tel"
			   value="{{$usersMeta->employer_profile->contact_tel}}"
			   name="contact_tel" type="text"/>
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
		<input class="form-control" id="comp_email"
			   value="{{$usersMeta->employer_profile->comp_email}}"
			   name="comp_email" type="text"/>
		@if ($errors->has('comp_email'))
			<span class="help-block">
								<strong>{{ $errors->first('comp_email') }}</strong>
							</span>
		@endif
	</div>
</div>
</div>
		
<div class="row">
	<div class="col-md-12 col-sm-12">
	<h4 class="form_inner_titile">Head Office Details</h4>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		 <div class="form-group ">
				<label class="control-label " for="head_office_address">
                    Head Office Door No.
                </label>
                <input class="form-control" id="head_office_address"
                       value="{{$usersMeta->employer_profile->head_office_address}}"
                       name="head_office_address" type="text"/>
                @if ($errors->has('head_office_address'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('head_office_address') }}</strong>
                                    </span>
                @endif
			</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
				<label class="control-label " for="head_office_street_name">
                    Head Office Street Name
                </label>
                <input class="form-control" id="head_office_street_name"
                       value="{{$usersMeta->employer_profile->head_office_street_name}}"
                       name="head_office_street_name" type="text"/>
              </div>
	</div>
</div>

<div class="row">
	<!--<div class="col-md-6 col-sm-6">
		<div class="form-group "> 
				<label class="control-label " for="head_office_city">
                    Head Office Town/City
                </label>
                <input class="form-control" id="head_office_city"
                       value="{{$usersMeta->employer_profile->head_office_city}}"
                       name="head_office_city" type="text"/>
              </div>
	</div>-->
    <div class="col-md-6 col-sm-6">
            <div class="form-group ">
            <label class="control-label " for="head_office_country">
                    Head Office Town/City
                </label>
                <select class="form-control" name="head_office_country" id="head_office_country">
@foreach(\App\Model\Country::all() as  $country)

            @if(isset($country->children['0']))

                <optgroup label="{{$country->name}}"

                          data-max-options="1">

                    @foreach($country->children as  $categorieChild)

                        <option value="{{$categorieChild->id}}" {{ !empty($usersMeta->employer_profile->head_office_country_id) ? $categorieChild->id ==$usersMeta->employer_profile->head_office_country_id   ? 'selected="selected"' : '' : ''}}>{{$categorieChild->name}}</option>

                    @endforeach

                    @endif

                    @endforeach

                </optgroup>  
  </select>
                
            </div>
        </div>
   <div class="col-md-6 col-sm-6">
         <div class="form-group ">
                <label class="control-label " for="head_office_city">
                    Head Office Country
                </label>

                <select class="form-control" id="head_office_city"  name="head_office_city">
                    <option selected>UK</option>
                </select>

                @if ($errors->has('head_office_city'))
                    <span class="help-block">
                           <strong>{{ $errors->first('head_office_city') }}</strong>
                    </span>
                @endif
            </div>

           </div>

	
</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
				<label class="control-label " for="head_office_postcode">
                    Head Office Postcode
                </label>
                <input class="form-control" id="head_office_postcode"
                       value="{{$usersMeta->employer_profile->head_office_postcode}}"
                       name="head_office_postcode" type="text"/>
            </div>
	</div>
	<div class="col-md-6 col-sm-6">
		 <div class="form-group ">
                <label class="control-label " for="head_office_contact_person">
                    Head Office Contact Person
                </label>
                <input class="form-control" id="head_office_contact_person"
                       value="{{$usersMeta->employer_profile->head_office_contact_person}}"
                       name="head_office_contact_person" type="text"/>
                @if ($errors->has('head_office_contact_person'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('head_office_contact_person') }}</strong>
                                    </span>
                @endif
            </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
                <label class="control-label" for="dept">
                    Dept Name
                </label>
                <input class="form-control" id="dept"
                       value="{{$usersMeta->employer_profile->dept}}"
                       name="dept" type="text"/>
                @if ($errors->has('dept'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('dept') }}</strong>
                                    </span>
                @endif
            </div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
                <label class="control-label" for="head_o_no">
                    H/O Contact Tel
                </label>
                <input class="form-control" id="head_o_no"
                       value="{{$usersMeta->employer_profile->head_o_no}}"
                       name="head_o_no" type="text"/>
                @if ($errors->has('head_o_no'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('head_o_no') }}</strong>
                                    </span>
                @endif
            </div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12">
		 <div class="form-group ">
                <label class="control-label" for="head_o_email">
                    H/O Email       
                </label>
                <input class="form-control" id="head_o_email"
                       value="{{$usersMeta->employer_profile->head_o_email}}"
                       name="head_o_email" type="text"/>
                @if ($errors->has('head_o_email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('head_o_email') }}</strong>
                                    </span>
                @endif
            </div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12">
	<h4 class="form_inner_titile">Authorised User</h4>
	</div>
</div>
 <div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
			<label class="control-label " for="authorised_user">
				Name Authorised User 1                   
			</label>
			<input class="form-control" id="authorised_user"
				   value="{{$usersMeta->employer_profile->authorised_user}}"
				   name="authorised_user" type="text"/>
			@if ($errors->has('authorised_user'))
				<span class="help-block">
									<strong>{{ $errors->first('authorised_user') }}</strong>
								</span>
			@endif
		</div>
		<div class="form-group ">
			<label class="control-label" for="email">
				Company Email
			</label>
			<input class="form-control" id="email"
				   value="{{$usersMeta->employer_profile->email}}"
				   name="email" type="text"/>
			@if ($errors->has('email'))
				<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
			@endif
		</div>
		<div class="form-group ">
			<label class="control-label" for="dd_tel">
				DD Tel
			</label>
			<input class="form-control" id="dd_tel"
				   value="{{$usersMeta->employer_profile->dd_tel}}"
				   name="dd_tel" type="text"/>
			
		</div>
		
		<div class="form-group ">
			<label class="control-label" for="contact_no">
				Mob Tel
			</label>
			<input class="form-control" id="contact_no"
				   value="{{$usersMeta->employer_profile->contact_no}}"
				   name="contact_no" type="text"/>
			
		</div>
		
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
			<label class="control-label " for="authorised_user_second">
				Name Authorised User 2
			</label>
			<input class="form-control" id="authorised_user_second"
				   value="{{$usersMeta->employer_profile->authorised_user_second}}"
				   name="authorised_user_second" type="text"/>
			@if ($errors->has('authorised_user_second'))
				<span class="help-block">
									<strong>{{ $errors->first('authorised_user_second') }}</strong>
								</span>
			@endif
		</div>
		<div class="form-group ">
			<label class="control-label" for="email_second">
			   Company Email
			</label>
			<input class="form-control" id="email_second"
				   value="{{$usersMeta->employer_profile->email_second}}"
				   name="email_second" type="text"/>
			@if ($errors->has('email_second'))
				<span class="help-block">
									<strong>{{ $errors->first('email_second') }}</strong>
								</span>
			@endif
		</div>
		<div class="form-group ">
			<label class="control-label " for="dd_tel2">
			  DD Tel
			</label>
			<input class="form-control" id="dd_tel2"
				   value="{{$usersMeta->employer_profile->dd_tel2}}"
				   name="dd_tel2" type="text"/>
			
		</div>
		<div class="form-group ">
			<label class="control-label " for="contact_no_second">
				Mob Tel
			</label>
			<input class="form-control" id="contact_no_second"
				   value="{{$usersMeta->employer_profile->contact_no_second}}"
				   name="contact_no_second" type="text"/>
			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12">
	<h4 class="form_inner_titile">Additional Company Info</h4>
	</div>
</div>
<div class="row">    
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
			<label class="control-label " for="company_reg_no">
				Company Reg No
			</label>
			<input class="form-control" id="company_reg_no"
				   value="{{$usersMeta->employer_profile->company_reg_no}}"
				   name="company_reg_no" type="text"/>
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
				   value="{{$usersMeta->employer_profile->company_vat_reg_no}}"
				   name="company_vat_reg_no" type="text"/>
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
    <legend>General Information</legend>
<!--<div class="row">
<div class="col-md-12 col-sm-12">
	<div class="form-group">
		<label>
			Will the Tutor be required to travel from different locations/sites?
		</label>
		<div class="radio">
			<label>
				<input type="radio" checked  name="different_locations" id="different_locations"
					   value="0" {{ $usersMeta->employer_profile->different_locations == '0' ?  "checked" : '' }} >No
			</label> <label>
				<input type="radio" name="different_locations" id="different_locations"
					   value="1" {{ $usersMeta->employer_profile->different_locations == '1' ?  "checked" : '' }} >Yes
			</label></div>
	</div>
</div>
</div>-->

<!--<div class="row">
<div class="col-md-6 col-sm-6">
	 <div class="form-group ">
		<label class="control-label " for="phone">
			Phone
		</label>
		<input class="form-control disable_different_locations" id="phone"
			   value="{{$usersMeta->phone}}"
			   name="phone" type="text"/>
		@if ($errors->has('phone'))
			<span class="help-block">
								<strong>{{ $errors->first('phone') }}</strong>
								 </span>
		@endif
	</div>
</div>
<div class="col-md-6 col-sm-6">
            <div class="form-group ">
            <label class="control-label " for="country">
                    Town/City
                </label>
                <select class="form-control disable_different_locations" name="country" id="country">
@foreach(\App\Model\Country::all() as  $country)

            @if(isset($country->children['0']))

                <optgroup label="{{$country->name}}"

                          data-max-options="1">
                          <option value="">Select</option>

                    @foreach($country->children as  $categorieChild)

                        <option value="{{$categorieChild->id}}" {{ !empty($usersMeta->tutor_profile->country_id) ? $categorieChild->id ==$usersMeta->tutor_profile->country_id   ? 'selected="selected"' : '' : ''}}>{{$categorieChild->name}}</option>

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
		<label class="control-label " for="state">
			State
		</label>
		<input class="form-control disable_different_locations"
			   value="{{$usersMeta->employer_profile->state}}"
			   id="state" name="state" type="text"/>
		@if ($errors->has('state'))
			<span class="help-block">
				<strong>{{ $errors->first('state') }}</strong>
				</span>
		@endif
	</div>
</div>
<div class="col-md-6 col-sm-6">
	<div class="form-group ">
		<label class="control-label " for="city">
			Country
		</label>
		<select class="form-control disable_different_locations" id="city"  name="city">
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
<div class="col-md-12 col-sm-12">
	<div class="form-group ">
		<label class="control-label " for="zip">
			Zip
		</label>
		<input class="form-control disable_different_locations"
			   value="{{$usersMeta->employer_profile->zip}}"
			   id="zip" name="zip" type="text"/>
		@if ($errors->has('zip'))
			<span class="help-block">
				<strong>{{ $errors->first('zip') }}</strong>
				</span>
		@endif
	</div>
</div>
</div>

-->

<div class="row">
	<div class="col-md-12 col-sm-12">
	   <div class="form-group">
			<label class="control-label" for="company_logo">
				Company Logo
			</label>
			<input name="company_logo" id="company_logo" type="file">
			<a class="download_btn" download="{{$usersMeta->photo}}"
			   href="{{asset('images/company_logo').'/'.$usersMeta->photo}}"
			   title="User photo">
				{{($usersMeta->photo != '') ? 'Download' : ''}}
			</a>
			@if ($errors->has('company_logo'))
				<span class="help-block">
										<strong>{{ $errors->first('company_logo') }}</strong>
									</span>
			@endif
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12 col-sm-12">
	<h4 class="form_inner_titile">Purchase Order Agreements</h4>
	</div>
</div>



<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="form-group ">
			<label class="control-label " for="amount_limit">
				Purchase Order Limit
			</label>
			<input class="form-control valid" id="amount_limit"   value="{{$usersMeta->employer_profile->amount_limit}}"
				   name="amount_limit" type="text">
		</div>
	</div>

	<div class="col-md-6 col-sm-6">
		<div class="form-group">
			<label class="control-label" for="order_limit">
				Purchase Order Agreement
			</label>
			<input name="order_limit" id="order_limit" type="file">
			<a class="download_btn" download="{{$usersMeta->order_limit}}"
			   href="{{asset('images/order_limit').'/'.$usersMeta->order_limit}}"
			   title="User Order Agreement">
				{{($usersMeta->order_limit != '') ? 'Download' : ''}}
			</a>
			@if ($errors->has('order_limit'))
				<span class="help-block">
										<strong>{{ $errors->first('order_limit') }}</strong>
									</span>
			@endif
		</div>
	</div>
</div>
    {{--</fieldset>--}}
    {{--<fieldset>--}}
    {{--<legend>Disponibilità</legend>--}}




    <div class="form-group" id="div_checkbox">

        <div class="form-group">
            <div>
                <button class="btn btn-success submit_button_custom" id="sads" name="submit" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</fieldset>
@push('scripts')
<script>

 $(document).ready(function () {
	 $('#head_office_country').multiselect({
            nonSelectedText: 'Select City',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            required:true
        });
		$('#comp_country').multiselect({
            nonSelectedText: 'Select City',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            required:true
        });
		$('#country').multiselect({
            nonSelectedText: 'Select City',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            required:true
        });
 });
</script>

@endpush