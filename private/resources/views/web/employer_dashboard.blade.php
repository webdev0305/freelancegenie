@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Employer Dashboard')


<section class="inner-page-title">
    <div class="container">
        <h2>Employer Dashboard</h2>
    </div>
</section>
<section class="plan_details_employer">

    <div class="button_details"><i class="fas fa-arrow-alt-circle-left"></i></div>

    <div class="inner_plan_details">
        <h4>Plan Details</h4>
        <p><strong>Plan:</strong> {{$subs->plan->title}}</p>
        <p><strong>Subscription Expires On:</strong>
            {{$subs_end=date('d/m/Y', strtotime(' + '.$subs->plan->duration, strtotime($subs->updated_at)))}}</p>
        <p><strong>Bookings Made:</strong>
            {{(isset($SubscriptionLimit->booked))?($SubscriptionLimit->booked):$subs->plan->book_tutor}} out of
            {{$subs->plan->book_tutor}}</p>
        <p><strong>Assignment Posts:</strong>
            {{isset($SubscriptionLimit->assignment)?($SubscriptionLimit->assignment):$subs->plan->post_assignment}} out
            of {{$subs->plan->post_assignment}}</p>
    </div>
</section>
<section class="inner-cotent">

    <div class="container">
        @include('message.message')
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Booking Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Booking Dates</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th>Outstanding Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php //echo '<pre>';print_r ($jobs);echo '</pre>';
			//die('checking here');
			?>
                @foreach($jobs as $key=>$job)
                <?php $date = explode(',', $job->date);
                    $date_from = $date['0'];
                    $date_from = str_replace('/', '-', $date_from);
                    $date_from = strtotime($date_from);
                    $date_to = end($date);
                    $date_to = str_replace('/', '-', $date_to);
                    $date_to = strtotime($date_to);
                    $current_date=date("m/d/Y");
                    $current_date=strtotime($current_date);
                            
                    if($current_date >= $date_from && $current_date <= $date_to){
                        $attended_date=date("m/d/Y");
                    }else{
                        $attended_date='';
                    }
                    $outstanding_amt=0;
                    if($job->half_paid == 1){
                        $outstanding_amt=$job->total/2;
                    }
                    
                ?>
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$job->id}}</td>
                    <td><a href="tutors/{{encrypt($job->tutor_id)}}">{{$job->title}}</a></td>
                    <td>{{$job->description}}</td>
                    <td>{{$job->date}}</td>
                    <td>{{$job->rate}}</td>
                    <td>@php $status=$job->status;@endphp
                        @if($status == '1')
                        {{'Booked'}}
                        @endif
                        @if($status == '0')
                        {{'Awaiting Tutor Acceptance'}}
                        @endif
                        @if($status == '2')
                        {{'Rejected'}}
                        @endif
                        @if($status == '3')
                        {{'Completed'}}
                        @endif
                        @if($status == '4')
                        {{'FTA'}}
                        @endif
                        @if($status == '5')
                        {{'Cancelled'}}
                        @endif
                    </td>
                    <td>{{$outstanding_amt}} @if($job->half_paid == 1) <a class="btn btn-success mr-1"
                            href="{{url('/booking')}}?job_id={{$job->id}}&care_tutor=0&tutor_id={{$job->tutor_id}}">Pay
                        </a>@endif</td>
                    <td>
                        <!--<button type="button" class="dbs btn btn-success mr-1" data-id="{{$job->tutor_id}}"  data-status="1"  data-toggle="modal" data-target="#dbs">Check DBS Record
                        </button>-->
                        <button type="button" class="dbs btn btn-success mr-1" data-id="{{$job->id}}">Request DBS Update
                        </button>
                        @if($status == '3')
                        <button type="button" class="btn btn-success mr-1 rating" data-id="{{$job->tutor_id}}"
                            data-job_id="{{$job->id}}" data-status="1" data-toggle="modal" data-target="#rating">Rate
                            Tutor
                        </button>
                        <button type="button" class="update_register_btn btn btn-success float-left mr-1"
                            data-id="{{$job->id}}" data-status="2" data-toggle="modal"
                            data-target="#update_register">View Register
                        </button>
                        @endif
                        @if($status != '3')
                        <button type="button" id="rptb" class="btn btn-success mr-1" data-id="{{$job->tutor_id}}"
                            data-job_id="{{$job->id}}" data-status="1" data-toggle="modal" data-target="#rptm">Report
                            Problem
                        </button>
                        @endif
                        @if($status == '1' && $current_date >= $date_from && $current_date <= $date_to) <button
                            type="button" id="failed_to_attend" class="failed_to_attend btn btn-success mr-1" data-id="{{$job->tutor_id}}"
                            data-job_id="{{$job->id}}" data-status="4" data-toggle="modal" data-target="#session_fail">
                            Failed to Attend
                            </button>
                            @endif
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>
</section>

<div class="modal fade maiilModal" id="update_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Students Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="update_registerform">
                    {{ csrf_field() }}

                    <input type="hidden" name="job_students" id="job_students">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well clearfix first-well">
                                <div id="first">
                                    <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label " for="levels">
                                        First Name
                                    </label>
                                    <input disabled type="text" class="stuname form-control" name="stuinfo_stuname">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label class="control-label " for="levels">
                                        Surname
                                    </label>
                                    <input disabled type="text" class="rollno form-control" name="stuinfo_rollno">
                                </div>
                            </div>
                            <div class="col-md-1">
                            <div class="btnPlus" style="cursor: pointer;"><i title="Download Certificate" class="fa fa-download" aria-hidden="true"></i></div>
                        </div>
                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<input type="submit" name="register" id="register" value="Submit" class="btn btn-success"/>-->
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="rating" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rate the Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert_rate">
                    {{ csrf_field() }}
                    <input type="hidden" name="tutor_id" id="tutor_id">
                    <input type="hidden" name="job_id" id="job_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="objectives">
                                    Did the course deliver on all its main aims and objectives?
                                </label>
                                <select class="form-control" name="objectives">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="delivery">
                                    Was the method/s of Delivery appropriate for you?
                                </label>
                                <select class="form-control" name="delivery">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="professional">
                                    How Professional was your Tutor/Trainer/Assessor?
                                </label>
                                <select class="form-control" name="professional">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="style">
                                    How would you rate the Tutors/Trainers/Assessors Delivery and Style of Delivery?
                                </label>
                                <select class="form-control" name="style">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="paperwork">
                                    If applicable; - How would you rate the Tutors/Trainers/Assessors Paperwork
                                    completion?
                                </label>
                                <select class="form-control" name="paperwork">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="tutor">
                                    How would you rate your Trainer/Tutor/Assessor?
                                </label>
                                <select class="form-control" name="tutor">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="training">
                                    How would you rate your Training on the whole?
                                </label>
                                <select class="form-control" name="training">
                                    <option value="">Select</option>
                                    @for($n=1;$n <= 5;$n++) <option value="{{$n}}">{{$n}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="comment">
                                    What, if anything, would you change to make the Training better?
                                </label>
                                <textarea name="comment" style="width:100%;height:100px;"></textarea>
                            </div>

                        </div>
                    </div>
                    <input type="button" name="insertrate" id="insertrate" value="Save" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade maiilModal" id="session_fail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Failed to Attend</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                    <p>Are you sure this session is failed?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;"
                    onclick="$(this).find('form').submit();">Submit
                    <form action="{{url('employer/change_job_status')}}" method="POST" style="display:none">
                        <input type="hidden" id="jobid" name="jobid" value="">
                        <input type="hidden" id="status" name="status" value="">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    </form>
                </a>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="rptm" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Your Problem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="rpte" action="{{url('employer/report_problem')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="tutor_id" id="rpt_tutor_id">
                    <input type="hidden" name="job_id" id="rpt_job_id">
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="control-label " for="comment">
                                    Please write your query
                                </label>
                                <textarea name="comment" style="width:100%;height:100px;"></textarea>
                            </div>

                        </div>
                    </div>
                    <input type="submit" name="rpts" id="rtps" value="Send To Admin" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://www.datejs.com/build/date.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
    $('#usr').click(function () {
        $('#address_box').hide();
    });
    $('#na').click(function () {
        $('#address_box').show();
    });

    $(document).on("click", '.fa-download', function (event) {
        $(this).closest('form').submit();
    });
    $('#failed_to_attend').click(function () {
        $('#jobid').val($(this).data("job_id"));
        $('#status').val($(this).data("status"));
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
            url: "http://localhost/tutorsandtrainersonline/public/tutors/get_coordinates",
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
    $("#date").daterangepicker({
        minDate: new Date(),
        timePicker: true,
        locale: {
            format: 'M/DD/Y hh:mm A'
        },
        isInvalidDate: function (arg) {
            // Prepare the date comparision
            var thisMonth = arg._d.getMonth() + 1; // Months are 0 based
            if (thisMonth < 10) {
                thisMonth = "0" + thisMonth; // Leading 0
            }
            var thisDate = arg._d.getDate();
            if (thisDate < 10) {
                thisDate = "0" + thisDate; // Leading 0
            }
            var thisYear = arg._d.getYear() + 1900; // Years are 1900 based

            var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;
            console.log(thisCompare);

            if ($.inArray(thisCompare, disabledArr) != -1) {
                return arg._pf = {
                    userInvalidated: true
                };
            }
        }
    }).focus();


    $('#myModal1').click(function (e) {
        $('#myModal').modal('toggle');
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
        // $('#insert').on("submit", function (event) {
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
    $(".rating").click(function () {
        var ids = $(this).data('id');
        var job_id = $(this).data('job_id');
        //alert(ids);
        $('#tutor_id').val(ids);
        $('#job_id').val(job_id);
    });
    $("#rptb").click(function () {
        var ids = $(this).data('id');
        var job_id = $(this).data('job_id');
        //alert(ids);
        $('#rpt_tutor_id').val(ids);
        $('#rpt_job_id').val(job_id);
    });
    /*$("#session_fail_go").click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			
        
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: "{{url('sessionfail')}}",
                data : new FormData($("#insert_rate")[0]),
                success: function (data) {
                        bootoast.toast({
                            message: "One token credited to your account"
                        });
                        $('#session_fail').modal('toggle');
                }
            });
            event.preventDefault();
        });
        */
    $("#insertrate").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            url: "{{url('rating/store')}}",
            data: new FormData($("#insert_rate")[0]),
            success: function (data) {
                console.log(data);
                $('#insert_rate').trigger("reset");
                bootoast.toast({
                    message: "Rating saved successfully"
                });
                $('#rating').modal('toggle');

            }
        });
        event.preventDefault();
    });

    $(".dbs").click(function () { // Click to only happen on announce link
        // $('#title-error').html("");
        var ids = $(this).data('id');
        //alert(ids);

        //$("#tutor_id").val(ids);
        $.ajax({
            type: 'GET',
            url: "{{url('/employer/request_dbs_update/')}}" + '/' + ids,
            data: { //tutorid:ids,

            },
            success: function (data) {
                bootoast.toast({
                    message: "Request Successfully Sent"
                });
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
                    $('#myModal').modal('toggle');
                    window.location.href = "{{url('/booking')}}" + '?job_id=' + job_id + '&total=' +
                        total + '&care_tutor=' + care_tutor;
                }
            }
        });
        event.preventDefault();
    });
    $(document).ready(function () {
        $(".failed_to_attend").click(function (e) { // Click to only happen on announce links
            $("#jobid").val($(this).data('job_id'));
            $("#status").val($(this).data('status'));
            //$('#deleteMerchant').modal('show');
        });

    });


    $(document).ready(function () {
        $(".button_details").click(function () {
            $(".inner_plan_details").toggle();
        });
    });
    $('.update_register_btn').click(function (event) {
        event.preventDefault();
        $('#job_students').val($(this).data('id'));
        $.ajax({
            type: "POST",
            url: "{{url('/employer/students_data')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                jobid: $(this).data('id')
            },
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);

                }
                if (data.success) {
                    $('#first').html('');
                    var obj = data.student;
                    var job_title = data.job_title;
                    //alert(obj);
                    console.log(job_title);
                    //alert(data.student[0].stuname);
                    $.each(obj, function (key, value) {
                        //key--;
                        $('#first').append(
                            '<form method="post" action="{{url("/employer/downloadCertificate")}}"> {{ csrf_field() }} <input type="hidden" name="job_title" value="' +
                            job_title +
                            '"><div class="row"> <div class="col-md-6"> <div class="form-group "> <label class="control-label " for="levels"> First Name </label> <input type="text" class="stuname form-control" name="stuname" value="' +
                            value["stuname"] +
                            '"> </div> </div> <div class="col-md-5"> <div class="form-group "> <label class="control-label " for="levels"> Surname </label> <input type="text" class="rollno form-control" name="sirname" value="' +
                            value["rollno"] +
                            '"> </div> </div> <div class="col-md-1"> <div class="btnPlus" style="cursor: pointer;"><i title="Download Certificate" class="fa fa-download" aria-hidden="true"></i></div> </div> </div></form>'
                            );
                    });


                }
            }
        });
    });
</script>
@endpush
@stop