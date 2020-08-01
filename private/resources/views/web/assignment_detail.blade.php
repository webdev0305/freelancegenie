@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Live Assignment Detail Page')

<section class="inner-page-title">
    <div class="container">
        <h2>Live Assignment</h2>
    </div>
</section>
<section class="new-plan">
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-md-12">
                <!-- JobDetail List -->
                <div class="kamkaaj-jobdetail-list">
                    <div class="kamkaaj-jobdetail-list-text custom_float col-md-9">
                        <?php //echo '<pre>';print_r($jobs);die;
                    $date = explode(',', $jobs->date);
					$date_from1 = str_replace('/', '-', $date['0']);
					$date_from = strtotime($date_from1);
					$current_date=date("d-m-Y");
					$current_date=strtotime($current_date);?>
                        <h2>{{$jobs->title}}</h2>
                        <ul>
                            <li class="pricing"><i class="fas fa-pound-sign"></i>{{$jobs->rate}}</li>
                            <li><i class="far fa-calendar-check"></i>Posted: {{$jobs->posted}} days ago</li>
                            <li><i class="fa fa-calendar-alt"></i> Booking Date(s): {{$jobs->date}}</li>
                            <li><i class="fa fa-calendar-alt"></i> Job Location: @if($jobs->booking_address ==1)
                                {{$jobs->address}} {{$jobs->street_name}}, {{$jobs->zip}}
                                @else
                                {{$jobs->EmployerProfile->company_address}}
                                {{$jobs->EmployerProfile->comp_street_name}}, {{$jobs->EmployerProfile->comp_postcode}}
                                @endif</li>
                        </ul>

                        @if( $current_date <= $date_from) <button type="button"
                            class="announce kamkaaj-jobdetail-list-btn" data-id="{{encrypt($jobs->id)}}" data-status="8"
                            data-toggle="modal" data-target="#deleteMerchant">Accept
                            </button>
                            @endif
                            <!--a href="#" class="kamkaaj-jobdetail-list-btn"><i class="far fa-envelope"></i> Email Job</a-->
                            <span class="kamkaaj-jobdetail-list-featured">Premium</span>
                    </div>
                    @if($jobs->JobDocs !='')
                    @foreach($jobs->JobDocs as $docs)
                    @if($docs->logo)
                    <div class="custom_float col-md-3"><img src="{{url('private/storage/app').'/'.$docs->filename}}" /></div>
                    @endif
                    @endforeach

                    @endif
                </div>

                <!-- JobDetail Editor -->
                <div class="kamkaaj-jobdetail-editor">

                    <h2>Job Description</h2>
                    <p>{{$jobs->description}}</p>

                </div>
                <!-- JobDetail Editor -->
                <div class="kamkaaj-jobdetail-editor">

                    <h2>Available Equipments Information</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <p><strong>Onsite Projector:
                                </strong><span>{{($jobs->onsite_projector)? 'Yes' : 'No'}}</span></p>
                            <p><strong>Wipe Board: </strong><span>{{($jobs->wipe_board)? 'Yes' : 'No'}}</span></p>
                            <p><strong>Flip Chart and Stand:
                                </strong><span>{{($jobs->flip_chart_and_stand)? 'Yes' : 'No'}}</span></p>
                        </div>
                        <div class="col-sm-8">
                            <p><strong>Any of the Audience have any learning difficulties or disabilities that we need
                                    to be aware of: </strong><span>{{($jobs->disabilities)? 'Yes' : 'No'}}</span></p>
                            <p><strong>Audience learning difficulties or disabilities:
                                </strong><span>{{($jobs->difficulty_info)? $jobs->difficulty_info : ''}}</span></p>
                            <p><strong>IT Suite/I.T equipment available for use:
                                </strong><span>{{($jobs->equipment_available)? 'Yes' : 'No'}}</span></p>
                            <p><strong>Equipment available onsite to be used:
                                </strong><span>{{($jobs->equipment_available_onsite)? 'Yes' : 'No'}}</span></p>
                            <p><strong>Equipment available:
                                </strong><span>{{($jobs->equipment_info)? $jobs->equipment_info : ''}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="attached_doc">
                    <h3 style="color: #000;font-size: 22px;margin-bottom: 8px;font-weight: 600;">Attached Docs</h3>
                    @if($jobs->JobDocs !='')
                    @foreach($jobs->JobDocs as $docs)
                    @if(!$docs->logo)
                    <div class="col-md-3">
                        <div class="file-wrap">
                            <h6>{{$docs->originalname}}</h6>
                            <a download="{{$docs->originalname}}" class="announce btn"
                                href="{{url('private/storage/app').'/'.$docs->filename}}">Download</a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



<section class="inner-cotent">
    <div class="container">
        <?php //echo '<pre>';print_r($jobs);echo '</pre>';?>
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
                        <p>Do you wish to accept this Assignment booking?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;"
                        onclick='$(this).find("form").submit(); '>Confirm
                        <form action="{{url('tutor/change_job_status')}}" method="POST" style="display:none">
                            <input type="hidden" id="jobid" name="jobid" value="">
                            <input type="hidden" id="status" name="status" value="">
                            <input type="hidden" id="tutor_id" name="tutor_id" value="{{\Sentinel::getUser()->id}}">
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
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
                                                        Name
                                                    </label>
                                                    <input type="text" class="stuname form-control"
                                                        name="stuinfo[0][stuname]">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group ">
                                                    <label class="control-label " for="levels">
                                                        Roll No.
                                                    </label>
                                                    <input type="text" class="rollno form-control"
                                                        name="stuinfo[0][rollno]">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="btnPlus" style="cursor: pointer;"><i
                                                        class="fa fa-plus-circle" aria-hidden="true"></i></div>
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <form method="post" id="insert_form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <select class="form-control" name="tutor_assign[]" id="tutor_assign" multiple="">

                    </select>
                    <div id="title-error"></div>
                </div>
                <input type="hidden" id="tutor_id" name="tutor_id">
                <input type="submit" name="insert" id="insert" value="Book a Session" class="btn btn-success" />
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@push('scripts')
<script src="{{ asset('js/admin/bootstrap-multiselect.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" />

<script>
    $('#tutor_assign').multiselect({
        nonSelectedText: 'Select Tutor',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '500px'
    });
</script>
<script>
    $('#first').on('click', '.btnPlus', function () {

        $('#first').append(
            '<div class="row"> <div class="col-md-6"> <div class="form-group "> <label class="control-label " for="levels"> Name </label> <input type="text" class="stuname form-control" name="stuname"> </div> </div> <div class="col-md-5"> <div class="form-group "> <label class="control-label " for="levels"> Roll No. </label> <input type="text" class="rollno form-control" name="rollno"> </div> </div> <div class="col-md-1"> <div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div> </div> </div>'
        );
        $('.stuname').each(function (i) {
            $(this).attr('name', 'stuinfo[' + i + '][stuname]');
        });
        $('.rollno').each(function (i) {
            $(this).attr('name', 'stuinfo[' + i + '][rollno]');
        });
    });
    $('.update_register_btn').click(function (event) {
        event.preventDefault();
        $('#job_students').val($(this).data('id'));
        $.ajax({
            type: "POST",
            url: "{{url('/tutor/students_data')}}",
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
                    //alert(obj);
                    console.log(data);
                    //alert(data.student[0].stuname);
                    $.each(obj, function (key, value) {
                        //key--;
                        $('#first').append(
                            '<div class="row"> <div class="col-md-6"> <div class="form-group "> <label class="control-label " for="levels"> Name </label> <input type="text" class="stuname form-control" name="stuinfo[' +
                            key + '][stuname]" value="' + value["stuname"] +
                            '"> </div> </div> <div class="col-md-5"> <div class="form-group "> <label class="control-label " for="levels"> Roll No. </label> <input type="text" class="rollno form-control" name="stuinfo[' +
                            key + '][rollno]" value="' + value["rollno"] +
                            '"> </div> </div> <div class="col-md-1"> <div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div> </div> </div>'
                        );
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
            data: {
                "_token": "{{ csrf_token() }}",
                jobid: $(this).data('id')
            },
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);

                }
                if (data.success) {
                    $("#booking_no").val(data.jobs.id);
                    $("#rate").val(data.jobs.rate);
                    $("#user_id").val(data.jobs.tutor_id);
                    $("#attended").html('<option value="' + data.attended_date + '">' + data
                        .attended_date + '</option>');

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
                    // $('#myModal').modal('toggle');
                    location.reload();
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
                    // $('#myModal').modal('toggle');
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
            url: "{{url('/tutor/swap_user')}}",
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

    $(".swap").click(function () { // Click to only happen on announce links
        $('#title-error').html("");
        var ids = $(this).data('id');
        $("#tutor_id").val(ids);
        $.ajax({
            type: 'GET',
            url: "{{url('/tutor/get_swap/')}}" + '/' + ids,
            data: {

            },
            success: function (data) {

                $("#tutor_assign").multiselect('dataprovider', JSON.parse(data));
            }

        });

        $('#myModal').modal('show');

    });
    var cur_index = 0;
    $(document).ready(function () {
        $(".announce").click(function (e) { // Click to only happen on announce links
            $("#jobid").val($(this).data('id'));
            $("#status").val($(this).data('status'));
            //$('#deleteMerchant').modal('show');
        });

    });

    /*$(document).ready(function () { // commented 31-07-2019
            //$('#example').DataTable();
			oTable = $('#example').DataTable({
				//"dom": 'Bfrtip',
				//"buttons": [ 'excel','print'],
                });
        });*/
</script>
@endpush
@stop