@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Employer dashboard')
<link rel="stylesheet" href="{{ asset('assets/web/scripts/jquery-ui/jquery-ui.min.css') }}" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

<section class="inner-page-title">
    <div class="container">
        <h2>Assignments</h2>
    </div>
</section>
<section class="inner-cotent care">
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-md-12 text-right">

                <button type="button" class="btn btn-primary mb-3" id="myModal1">
                    Post Assignment
                </button>

            </div>
        </div>
        <div class="kamkaaj-jobs kamkaaj-jobs-listing-view1">
            <ul id="load_data" class="row"></ul>
        </div>
        <div id="load_data_message"></div>

    </div>
</section>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert_form">
                    {{ csrf_field() }}
                    <input type="hidden" name="assignment" value="1">
                    <div id="step0" class="stepDetails">
                        <fieldset>
                            <legend>Assignment Information</legend>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label " for="title">
                                            Assignment Heading<span class="asteriskField">*</span>
                                        </label>
                                        <input class="form-control" name="tutor_id" value="" type="hidden" />
                                        <input class="form-control" id="title" name="title" type="text" />
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger">
                                            <small id="title-error"></small>
                                        </span>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6">

                                    <div class="form-group ">
                                        <label class="control-label" for="Rate">
                                            Day Rate(£)<span class="asteriskField">*</span>
                                        </label>
                                        <input class="form-control" name="rate" type="number" min="0" max="10000"
                                            id="rate">

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
                                    <div class="form-group ">
                                        <label class="control-label " for="type_levels">
                                            Select type of tutor matched with your assignment<span
                                                class="asteriskField">*</span>
                                        </label>
                                        <select class="form-control" name="disciplines" id="disciplines">
                                            <option value="">Select Tutor Type</option>
                                            @foreach($disciplines as $discipline)
                                            @if(isset($discipline->childrenDisciplines['0']))
                                            <optgroup label="<?php echo $discipline->name;?>" data-max-options="1"
                                                discipline_id="{{$discipline->id}}">
                                                @foreach($discipline->childrenDisciplines as $disciplineChild)
                                                <option value="{{$disciplineChild->id}}"
                                                    {{ !empty(\Input::get('disciplines')) ? in_array($disciplineChild->id , \Input::get('disciplines'))   ? 'selected="selected"' : '' : ''}}>
                                                    {{$disciplineChild->name}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="control-label " for="date">
                                            Booking Date(s)<span class="asteriskField">*</span>
                                        </label>
                                        <div id='datePick'></div>
                                        <input name="date" class="form-control" id="altField" type="hidden" />
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger">
                                            <small id="date-error"></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label " for="time_start">
                                            Start Time<span class="asteriskField">*</span>
                                        </label>
                                        <input type="time" id="time_start" name="time_start" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label " for="time_end">
                                            End Time<span class="asteriskField">*</span>
                                        </label>
                                        <input type="time" id="time_end" name="time_end" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <label class="control-label">
                                        Where do you want your booking to take place?<span
                                            class="asteriskField">*</span>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label for="usr">
                                                <input checked type="radio" name="booking_address" value="0"
                                                    id="usr">Your Company Address
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label for="na">
                                                <input type="radio" name="booking_address" value="1" id="na">Enter your
                                                own Delivery Address
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <span class="text-danger">
                                    <small id="booking_address-error"></small>
                                </span>
                            </div>

                            <div id="address_box" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="address">
                                                House or Company Door No.<span class="asteriskField">*</span>
                                            </label>
                                            <input class="form-control" name="address" id="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group ">

                                            <label class="control-label " for="street_name">
                                                Street Name<span class="asteriskField">*</span>
                                            </label>
                                            <input class="form-control" id="street_name" name="street_name" type="text">
                                        </div>
                                    </div>



                                </div>

                                <div class="row">

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="city">
                                                Town/City<span class="asteriskField">*</span>
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
                                                Post Code<span class="asteriskField">*</span>
                                            </label>
                                            <input class="form-control" id="zip" name="zip" type="text">
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6">
                            <div class="form-group ">
                                
                                <input type="button" name="checkd" data-tutor_id="29" id="checkd" value="Check Distance" class="btn btn-success">
							</div>

                        </div>-->

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label " for="awarding">
                                            Awarding body
                                        </label>

                                        <input class="form-control" id="awarding" name="awarding" type="text" />
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger">
                                            <small id="awarding-error"></small>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label " for="type">
                                            Upload any additional doc here.
                                        </label>
                                        <input type="file" class="form-control" multiple="multiple" id="file"
                                            name="photos[]">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger">
                                            <small id="file-error"></small>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="control-label " for="description">
                                            Enter details of your Requirement<span class="asteriskField">*</span>
                                        </label>
                                        <textarea class="form-control" name="description" value=""
                                            id="description"></textarea>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger">
                                            <small id="description-error"></small>
                                        </span>
                                    </div>

                                </div>

                            </div>
                            <div id="premium_div">

                                <label class="checkbox"><input type="checkbox" name="premium" id="premium"
                                        onchange="activateButton(this)"> Post as a premium</label>
                                <div class="row" id="logo_div">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="type">
                                                Upload Logo
                                            </label>
                                            <input type="file" class="form-control" id="premium_logo" name="logo">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <span class="text-danger">
                                                <small id="file-error"></small>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                            <label class="checkbox"><input type="checkbox" name="" id="">I agree <a
                                    href="{{url('terms')}}">terms & conditions</label>
                            <input type="button" id="insert" class="btn btn-success" name="assignment_sub"
                                value="submit">
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/formtowizard.js') }}" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>
<script src="{{ asset('js/admin/jquery-ui.multidatespicker.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script>
    $(document).ready(function () {
        $('#insert_form #step0Next').click(function (e) {
            /*var options = $('#disciplines').find(":selected").text();
            alert(options);
             if(options == "Select Tutor Type"){
            	 alert('Please select a tutor type for your assignment');
            	 //e.preventDefault();
            	 $('#disciplines').focus();
            	 //return false;
             }*/
            alert(
                'Have you considered standardisation? If you have not used this Subcontractor previously then you must include into your booking. If you have used this Subcontractor before then simply, continue.');
        });
    });
    $('#usr').click(function () {
        $('#address_box').hide();
    });
    $('#na').click(function () {
        $('#address_box').show();
    });
    $('#city').multiselect({
        nonSelectedText: 'Select City',
        enableFiltering: true,
        multiselect: false,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '220px'
    });
    $("#checkd").click(function () {
        var address = $('#address').val();
        var city = $('#city').val();
        var street_name = $('#street_name').val();
        var zip = $('#zip').val();
        var country = $('#country').val();
        var startDate = $('#date').data('daterangepicker').startDate._d;
        var endDate = $('#date').data('daterangepicker').endDate._d;
        var booking_days = showDays(endDate, startDate);

        //alert(booking_days);
        //var address=$(input[name:'booking_address']).val();
        var tutor_id = $(this).data('tutor_id');
        $.ajax({
            type: 'POST',
            url: "{{url('tutors/get_coordinates')}}",
            data: {
                address: address,
                'tutor_id': tutor_id,
                'city': city,
                'street_name': street_name,
                'zip': zip,
                'country': country,
                "_token": "Uq4h23qq8zeSBdYJt95oSjZCEHqS4X1Tx9OTGUyt"
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
    });

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

    var disabledArr = [""];
    $(document).ready(function () {
        $('#datePick').multiDatesPicker({
            altField: '#altField',
            dateFormat: "dd/mm/yy",
            minDate: 3, // Booking dates should be selected after 2 days of current date
        });
    });


    $('#myModal1').click(function (e) {
        $.ajax({
            type: 'POST',
            url: "{{url('/tutors/check_limit')}}",
            data: {
                'check': 'assignment',
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                //var response=$.parseJSON(data);
                //console.log(data);
                //alert (data);
                if (parseInt(data)) {
                    //$('#myModal').modal('toggle');
                    $('#myModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                    if (parseInt(data) == 1) {
                        $('#premium_div').html('');
                    }
                } else {
                    alert(
                        'You have posted all assignments included in your subscription.Please renew your subscription plan to post more.');
                }
            }

        });

        $("#insert_form")[0].reset();
        $('#title-error').html("");
        $('#date-error').html("");
        $('#specialist-error').html("");
        $('#qualified_levels-error').html("");
        $('#type_levels-error').html("");
        $('#description-error').html("");
        $('#file-error').html("");
    });

    $("#insert").click(function () {

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
        $('#description-error').html("");
        $('#file-error').html("");
        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            url: "{{url('/tutors')}}",
            // data: $('#insert_form').serialize(),
            data: new FormData($("#insert_form")[0]),
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors.title);
                    $('#date-error').html(data.errors.date);
                    $('#specialist-error').html(data.errors.specialist);
                    $('#qualified_levels-error').html(data.errors.qualified_levels);
                    $('#type_levels-error').html(data.errors.type_levels);
                    $('#description-error').html(data.errors.description);
                    $('#file-error').html(data.errors.file);
                }

                if (data.success) {
                    $('#insert_form').trigger("reset");
                    bootoast.toast({
                        message: data.message
                    });
                    $('#myModal').modal('toggle');
                    location.reload();
                }
            }
        });
        event.preventDefault();
    });








    /*$('#insert_form').on("submit", function (event) { // commented on 30-07-2019
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
                        
						$('#myModal').modal({backdrop: 'static', keyboard: false})
						window.location.href = "{{url('/booking')}}"+'?job_id='+job_id+'&total='+total+'&care_tutor='+care_tutor;
                    }
                }
            });
            event.preventDefault();
        });*/
    $('.confirm').click(function () {
        priceAjax($(this).data('id'));
        $("#pay").data("job_id", $(this).data('id'));
    });
    $(document).ready(function () {
        $(".announce").click(function (e) { // Click to only happen on announce links
            //alert('event occured');alert($(this).data('id'));
            $("#jobid").val($(this).data('id'));
            $("#status").val($(this).data('status'));
            //$('#deleteMerchant').modal('show');
        });

    });

    function priceAjax(id) {
        //alert(id);

        $.ajax({

            type: "POST",
            url: "{{url('/tutors/assignnment_price_calculation')}}",
            data: {
                'job_id': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                var res = jQuery.parseJSON(data);
                console.log(res);

                $('#cost').text('Tutor Cost: £' + res.cost);

                if (res.include_mileage) {
                    if (res.time != "" && res.time > 7200) {

                        $('#additional_cost').html('Hotel Cost: £' + res.hotel_cost +
                            ' <br>Travel Cost from Tutor Venue to Hotel: £' + res.travel_cost +
                            ' <br>Travel Cost from Hotel to Booking Address: £' + res
                            .travel_cost_hot_booking);
                    } else {

                        $('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £' + res
                            .travel_cost);
                    }
                }
                $('#total').val(res.total_cost);
                $('#total_text').text('Total: £' + res.total_cost);

            }
        });
    }
    $('#pay').click(function () {
        var job_id = $(this).data('job_id');
        //var care_tutor="2";
        window.location.href = "{{url('/booking')}}" + '?job_id=' + job_id;
    });
</script>
<script>
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
    $('document').ready(function () {
        $("#logo_div").hide();
    });

    function activateButton(element) {

        if (element.checked) {
            $("#logo_div").show();
        } else {
            $("#logo_div").hide();
        }

    }
    $('#disciplines').multiselect({
        nonSelectedText: 'Select Type',
        enableFiltering: true,
        multiselect: false,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '300px'
    });
    $(document).ready(function () {
        var limit = 7;
        var start = 0;
        var action = 'inactive';

        function load_data(limit, start) {
            $.ajax({
                url: "{{url('/employer/assignment_lazy')}}",
                method: "POST",
                data: {
                    limit: limit,
                    start: start,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function (data) {
                    var obj = data.jobs_lazy;
                    var html = '';
                    $.each(obj, function (key, value) {
                        var link = '{{url("employer/detail_assignment")}}/' + obj[key][
                        'id'];
                        var logo = '';
                        console.log(obj[key]['job_docs']);
                        if (obj[key]['job_docs'] != '') {
                            $.each(obj[key]['job_docs'], function (doc_key, doc_value) {
                                if (obj[key]['job_docs'][doc_key]['logo']) {
                                    logo = '{{url("../storage/app")}}/' + obj[key][
                                        'job_docs'
                                    ][doc_key]['filename'];
                                }

                            });
                        }
                        if (obj[key]['assignment'] == "2") {
                            html +=
                                '<li class="col-md-12"><div class="kamkaaj-table"><div class="kamkaaj-table-row"><div class="kamkaaj-table-cell" style="width: 170px;"><a href="#" class="kamkaaj-jobs-listing-view1-thumb"> <img src="' +
                                logo +
                                '" alt=""></a> </div><div class="kamkaaj-table-cell"><div class="kamkaaj-jobs-listing-view1-wrap2"><h2><a href="' +
                                link + '">' + obj[key]['title'] +
                                '</a></h2><i class="fas fa-pound-sign"></i> <b>' + obj[key][
                                    'rate'
                                ] +
                                '</b><ul class="kamkaaj-jobs-listing-view1-options"><li class="text">' +
                                obj[key]['description'] +
                                '</li><li><i class="far fa-calendar-check"></i>Posted ' +
                                obj[key]['posted'] +
                                ' days ago</li><li><i class="far fa-calendar-alt"></i>Booking Dates ' +
                                obj[key]['date'] +
                                '</li><li><i class="far fa-calendar-alt"></i>Start Time ' +
                                obj[key]['time_start'] + ' End Time ' + obj[key][
                                'time_end'] +
                                '</li></ul></div></div><div class="kamkaaj-table-cell"><a href="#" class="kamkaaj-job-type-btn"><span>Premium</span></a></div></div></div></li>';
                        } else {
                            html +=
                                '<li class="col-md-12"><div class="kamkaaj-table"><div class="kamkaaj-table-row"><div class="kamkaaj-table-cell"><div class="kamkaaj-jobs-listing-view1-wrap2"><h2><a href="' +
                                link + '">' + obj[key]['title'] +
                                '</a></h2><i class="fas fa-pound-sign"></i> <b>' + obj[key][
                                    'rate'
                                ] +
                                '</b><ul class="kamkaaj-jobs-listing-view1-options"><li class="text">' +
                                obj[key]['description'] +
                                '</li><li><i class="far fa-calendar-check"></i>Posted ' +
                                obj[key]['posted'] +
                                ' days ago</li><li><i class="far fa-calendar-alt"></i>Booking Dates ' +
                                obj[key]['date'] +
                                '</li><li><i class="far fa-calendar-alt"></i>Start Time ' +
                                obj[key]['time_start'] + ' End Time ' + obj[key][
                                'time_end'] +
                                '</li></ul></div></div><div class="kamkaaj-table-cell"></div></div></div></li>';
                        }

                    });
                    $('#load_data').append(html);
                    if (obj == '') {
                        $('#load_data_message').html(
                            "<button type='button' class='btn btn-info'>No More Assignments</button>"
                            );
                        action = 'active';
                    } else {
                        $('#load_data_message').html(
                            "<button type='button' class='btn btn-warning'>Loading Assignments ....</button>"
                            );
                        action = "inactive";
                    }
                }
            });
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action ==
                'inactive') {
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_data(limit, start);
                }, 1000);
            }
        });
    });
</script>
@endpush
@stop