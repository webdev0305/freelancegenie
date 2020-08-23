@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor Dashboard')
<link rel="stylesheet" href="{{ asset('assets/web/scripts/jquery-ui/jquery-ui.min.css') }}" />
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<style>
    td.off.disabled {
        background: mediumspringgreen !important;
        color: #fff !important;
        font-size: 18px !important;
        cursor: context-menu !important;
        text-decoration: overline !important;
    }

    .highlight a {
        background-color: #29f274 !important;
        color: #ffffff !important;
    }
</style>
<section class="inner-page-title">
    <div class="container" id="date-range12-container">
        <h2>Tutor Dashboard</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">
        @include('message.message')
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#date_modal">My Calendar</button>
        <a target="_blank" href="{{url('tutor/tutor_swap')}}" class="btn btn-info btn-lg">Swap Requests</a>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#availability_mod">Set Availability</button>

        <table id="" class="table table-striped table-bordered table-responsive-lg" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Booking Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Booking Dates</th>
                    <th>Booking Time</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php ($i = 1) @endphp
                @foreach($jobs as $key=>$job)
                <?php 
                    $date = explode(',', $job['userjobs']->date);
                    $date_from = str_replace('/', '-', $date['0']);
                    $date_from = strtotime($date_from);
                    $date_to = end($date);
                    $date_to = str_replace('/', '-', $date_to);
                    $date_to = strtotime($date_to);
                    $current_date=date("d-m-Y");
                    $current_day=date("D");
                    $current_date=strtotime($current_date);
                    echo ($date_from);
                    if($current_date >= $date_from && $current_date <= $date_to){
                        $attended_date=date("m/d/Y");
                    }else{
                        $attended_date='';
                    }
                ?>
                @if($job->status != 2)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{$job['userjobs']->id}}</td>
                    <td><a target="_blank"
                            href="tutor/job_detail/{{$job['userjobs']->id}}">{{$job['userjobs']->title}}</a></td>
                    <td>{{$job['userjobs']->description}}</td>
                    <td>{{$job['userjobs']->date}}</td>
                    <td>{{'Start Time: '.$job['userjobs']->time_start.' End Time: '.$job['userjobs']->time_end}}</td>
                    <td>{{$job['userjobs']->rate}}</td>
                    <td>
                        @php $status=$job['userjobs']->status;@endphp
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
                        @if($status == '6')
                        {{'Booked'}}
                        @endif
                        @if($status == '7')
                        {{'Declined by Employer'}}
                        @endif
                        @if($status == '8')
                        {{'Awaiting Employer Approval'}}
                        @endif
                    </td>
                    <td>{{-- $status --}}

                        @if($current_date <= $date_from && $status=="0" ) 
                        <button type="button" class="announce btn btn-success float-left mr-1" data-id="{{encrypt($job['userjobs']->id)}}" data-status="1" data-toggle="modal" data-target="#deleteMerchant">
                            Accept
                        </button>
                        @endif

                        @if($status == "0")
                        <button type="button" class="announce btn btn-danger float-left mr-1" data-id="{{encrypt($job['userjobs']->id)}}" data-status="2" data-toggle="modal" data-target="#deleteMerchant">
                            Reject
                        </button>
                        @endif

                        @if(($status == "6" || $status == "1") && $current_date >= $date_from && $current_date <= $date_to) 
                        <button type="button" class="update_record_btn btn btn-success float-left mr-1" data-id="{{$job['userjobs']->id}}" data-status="2" data-toggle="modal" data-target="#update_record">
                            Confirm Arrival
                        </button>
                        <button type="button" class="update_register_btn btn btn-success float-left mr-1" data-id="{{$job['userjobs']->id}}" data-target="#update_register">
                            Update Register
                        </button>
                        @endif

                        @if(($status == "6" || $status == "1") && $current_date >= $date_to)
                        <button type="button" class="announce btn btn-success float-left mr-1" data-id="{{$job['userjobs']->id}}" data-status="3" data-toggle="modal" data-target="#deleteMerchant">
                            Job Done
                        </button>
                        @endif

                        @if($current_date >= $date_from && $status!=0)
                        <a class="announce btn btn-success float-left mr-1" href="{{url('tutor/invoice').'/'.$job['userjobs']->id}}">
                            View Invoice
                        </a>
                        @endif

                        @if(($current_day == "Mon" && $status !=0) || $status == '4')
                        <button type="button" class="invoice_sent btn btn-success float-left mr-1" data-id="{{$job['userjobs']->id}}" data-tutor_id="{{$job['userjobs']->tutor_id}}">
                            Send Invoice
                        </button>
                        @endif

                        @if((($status == '6' && $job['userjobs']->assignment) || (!$job['userjobs']->assignment && $status=='1')) && ($current_date < strtotime('-1 Day',$date_from))) 
                        <button type="button" class="swap btn btn-primary float-left mr-1" data-id="{{encrypt($job['userjobs']->id)}}">
                            Swap Tutor
                        </button>
                        @endif
                    </td>
                </tr>
                @endif
                @php ($i++) @endphp

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade maiilModal" id="deleteMerchant" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Job Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <p>Please make sure you have submitted the Student Register.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;"
                        onclick="$(this).find('form').submit();">Submit
                        <form action="{{url('tutor/change_job_status')}}" method="POST" style="display:none">
                            <input type="hidden" id="jobid" name="jobid" value="">
                            <input type="hidden" id="status" name="status" value="">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        </form>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="update_record" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Arrival</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <p>Please mark your attendence on every attended day to generate invoice.</p>
                    </div>
                    <form method="POST" id="update_recordform">
                        {{ csrf_field() }}
                        <input type="hidden" id="rate" name="rate" value="">
                        <input type="hidden" id="booking_no" name="booking_no" value="">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label " for="levels">
                                        Date Attended
                                    </label>
                                    <select class="form-control" id="attended" name="attended">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-success" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="update_register" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="control-label " for="levels">
                                                        First Name
                                                    </label>
                                                    <input type="text" class="stuname form-control"
                                                        name="stuinfo[0][stuname]">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group ">
                                                    <label class="control-label " for="levels">
                                                        Surname
                                                    </label>
                                                    <input type="text" class="rollno form-control"
                                                        name="stuinfo[0][rollno]">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="btnPlus" style="cursor: pointer;">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="register" id="register" value="Submit" class="btn btn-success" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tutor List</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="insert_form">
                {{ csrf_field() }}
                <div class="modal-body select_tutor">
                    <select class="form-control" name="tutor_assign[]" id="tutor_assign" multiple="">
                    </select>
                    <div id="title-error"></div>
                    <input type="hidden" id="tutor_id" name="tutor_id" value="{{\Sentinel::getUser()->id}}">
                    <input type="hidden" id="job_id" name="job_id">
                    <input type="submit" name="insert" id="insert" value="Swap" class="btn btn-success" />
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="date_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content manage_bookings_popup">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Bookings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                    <p>You can see all your bookings here.</p>
                </div>
                <div class="row" id='md'>
                    <!-- Calendar will be loaded here-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="availability_mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set your Availability</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                    <p>Set your availability to accept bookings</p>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" {{ (!$user->availability) ? 'checked' :''}} name="available"
                                        value="0">Unavailable
                                </label>
                                <label>
                                    <input {{($user->availability) ? 'checked' :''}} type="radio" name="available"
                                        value="1">Available
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal maiilModal" id="dbs_expire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DBS Certificate Expire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="dbs_expire_text" class="text-wrap">

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{ asset('js/admin/bootstrap-multiselect.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" />

<script>
    <?php if ($dbs_expire == 1) {?>
    $('#dbs_expire').modal('show');
    $('#dbs_expire_text').html('<p>Your DBS Renewal is now due. Please complete your new DBS to avoid account restrictions. Registration for DBS update service is also required.</p> <p>Below is the link to register for DBS and DBS update service.</p><p id="comment">Link to register for the DBS registration:</p><a href="http://www.personnelchecks.co.uk/freelance-genie" target="_blank">http://www.personnelchecks.co.uk/freelance-genie</a><p id="">Link to register for the DBS update service:</p><a href="https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1" target="_blank">https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1</a>');
    <?php } ?>
    <?php if($dbs_expire ==2){?>
    $('#dbs_expire').modal('show');
    $('#dbs_expire_text').html('<p>Your account is now at risk of being restricted until you complete and provide new DBS Criteria</p> <p>Below is the link to register for DBS and DBS update service.</p><p id="comment">Link to register for the DBS registration:</p><a href="http://www.personnelchecks.co.uk/freelance-genie" target="_blank">http://www.personnelchecks.co.uk/freelance-genie</a> <p id="">Link to register for the DBS update service:</p><a href="https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1" target="_blank">https://secure.crbonline.gov.uk/crsc/apply?execution=e3s1</a>');
    <?php } ?>

    $('#tutor_assign').multiselect({
        nonSelectedText: 'Select Tutor',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '500px'
    });

    $('#first').on('click','.btnPlus',function(){

        $('#first').append('<div class="row"><div class="col-md-6"><div class="form-group "> <label class="control-label " for="levels"> First Name </label> <input type="text" class="stuname form-control" name="stuname"> </div><div class="col-md-5"><div class="form-group "> <label class="control-label " for="levels"> Surname </label> <input type="text" class="rollno form-control" name="rollno"> </div></div><div class="col-md-1"><div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div></div></div>');
        $('.stuname').each(function(i){
            $(this).attr('name', 'stuinfo['+i+'][stuname]');
        });
        $('.rollno').each(function(i){
            $(this).attr('name', 'stuinfo['+i+'][rollno]');
        });
    });
    
    $('input[name="available"]').change(function(){
        var availability=$('input[name="available"]:checked').val();
        $.ajax({
            type: "POST",
            url: "{{url('/tutor/set_availability')}}",
            data: {"_token": "{{ csrf_token() }}","availability":availability},
            success: function (data) {
                if (data.success) {
                    bootoast.toast({
                        message: data.message
                    });
                    $('#availability_mod').modal('toggle');
                }
            }
        });
    });

    $('.update_register_btn').click(function (event) {
        event.preventDefault();
        $('#job_students').val($(this).data('id'));
        $.ajax({
            type: "POST",
            url: "{{url('/tutor/students_data')}}",
            data: {"_token": "{{ csrf_token() }}",jobid:$(this).data('id')},
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);
                }
                if (data.success) {
                    $('#first').html('');
                    var obj=data.student;
                    console.log(data);
                    //alert(data.student[0].stuname);
                    $.each( obj, function( key, value ) {
                        //key--;
                        $('#first').append('<div class="row"><div class="col-md-6"><div class="form-group "> <label class="control-label " for="levels"> First Name </label> <input type="text" class="stuname form-control" name="stuinfo['+key+'][stuname]" value="'+value[" stuname"]+'"> </div></div><div class="col-md-5"><div class="form-group "> <label class="control-label " for="levels"> Surname </label> <input type="text" class="rollno form-control" name="stuinfo['+key+'][rollno]" value="'+value[" rollno"]+'"> </div></div><div class="col-md-1"><div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div></div></div>');
                    });
                }
            }
        });
    });

    $('.update_record_btn').click(function (event) {
        event.preventDefault();
        $('#title-error').html("");
        $.ajax({
            type: "POST",
            url: "{{url('/tutor/job_data')}}",
            data: {"_token": "{{ csrf_token() }}",jobid:$(this).data('id')},
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);
                }
                if (data.success) {
                    $("#booking_no").val(data.jobs.id);
                    $("#rate").val(data.jobs.rate);
                    $("#user_id").val(data.jobs.tutor_id);
                    $("#attended").html('<option value="'+data.attended_date+'">'+data.attended_date+'</option>');
                }
            }
        });
        event.preventDefault();
    });

    $('#update_registerform').on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#title-error').html("");

        $.ajax({
            type: "POST",
            url: "{{url('/tutor/insert_register')}}",
            data: $('#update_registerform').serialize(),
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);
                }
                if (data.success) {
                    bootoast.toast({
                        message: data.message
                    });
                    $('#update_register').modal('toggle');
                }
            }
        });
        event.preventDefault();
    });

    $('#update_recordform').on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#title-error').html("");

        $.ajax({
            type: "POST",
            url: "{{url('/tutor/insert_invoice')}}",
            data: $('#update_recordform').serialize(),
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);
                }

                if (data.success) {
                    $('#update_recordform').trigger("reset");
                    bootoast.toast({
                        message: data.message
                    });
                    location.reload();
                }
            }
        });
        event.preventDefault();
    });

    $('#insert_form').on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#title-error').html("");

        $.ajax({
            type: "POST",
            url: "{{url('/tutor/swap_request')}}",
            data: $('#insert_form').serialize(),
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);
                }
                if (data.success) {
                    $('#insert_form').trigger("reset");
                    bootoast.toast({
                        message: data.message
                    });
                    // $('#myModal').modal('toggle');
                    location.reload();
                }
            }
        });
        event.preventDefault();
    });

    $(".swap").click(function(){ // Click to only happen on announce links
        $('#title-error').html("");
        var ids = $(this).data('id');
        $("#job_id").val(ids);
        $.ajax({
            type: 'GET',
            url: "{{url('/tutor/get_swap/')}}"+'/'+ids,
            data: {},
            success: function (data) {
                $("#tutor_assign").multiselect('dataprovider', JSON.parse(data));
                //$("#job_id").val(JSON.parse(data)[0].job_id);
            }
        });
        $('#myModal').modal('show');
    });

    $(document).ready(function(){
        $(".announce").click(function(e){ // Click to only happen on announce links
            $("#jobid").val($(this).data('id'));
            $("#status").val($(this).data('status'));
            $('#deleteMerchant').modal('show');
        });

    });

    $('.invoice_sent').click(function (event) {
        event.preventDefault();
        //$('#title-error').html("");
        alert($(this).data('tutor_id'));
        $.ajax({
            type: "POST",
            url: "{{url('/tutor/invoice_sent')}}",
            data: {"_token": "{{ csrf_token() }}",jobid:$(this).data('id'),tutor_id:$(this).data('tutor_id')},
            success: function (data) {
                /* if (data.errors) {
                $('#title-error').html(data.errors);
                }*/
                if (data.success) {
                    console.log(data);
                    bootoast.toast({
                        message: data.message
                    });
                }
            }
        });
        //event.preventDefault();
    });


    $(document).ready(function () {
        oTable = $('#example').DataTable();
    });


    var highlight_dates = [ @php echo $booked_dates; @endphp ];
    //var highlight_dates = ['02/07/2019','27/07/2019'];
    $(document).ready(function(){//$('#date_modal').modal('show');
        // Initialize datepicker
        //$('#datePick').multiDatesPicker();
        $('#md').datepicker({
            //multidate: true,
            beforeShowDay: function(date){
                var month = ("0" + (date.getMonth() + 1)).slice(-2);//leading zero format
                var year = date.getFullYear();
                var day = ("0" + (date.getDate())).slice(-2);//leading zero format
                // Change format of date
                var newdate = day+"/"+month+'/'+year;
                // Set tooltip text when mouse over date
                var tooltip_text = "You have booking on " + newdate;
                // Check date in Array
                if(jQuery.inArray(newdate, highlight_dates) != -1){
                    return [true, "highlight", tooltip_text ];
                }
                return [true];
            }
        });

        $("#md").on("change",function(){
            var selected = $(this).val();
            var dateAr = selected.split('/');
            var newDate = dateAr[2] + '-' + dateAr[0].slice(-2)+ '-' + dateAr[1];
            window.location.href="{{url('/tutor')}}"+'?date='+newDate;
            //alert(newDate);
        });
    });

</script>
@endpush
@stop