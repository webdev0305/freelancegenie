@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Live Assignments')
<section class="inner-page-title">
    <div class="container">
        <h2>Live Assignments</h2>
    </div>
</section>
<section class="inner-cotent care">
<div class="container">
@include('message.message')
<div class="kamkaaj-jobs kamkaaj-jobs-listing-view1">
<ul id="load_data" class="row"></ul></div>
   <div id="load_data_message"></div>
   
</div></section>
<section class="inner-cotent">
    <div class="container">
        @include('message.message')
    </div>
    <div class="modal fade maiilModal" id="deleteMerchant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Submit
                        <form action="{{url('tutor/change_job_status')}}" method="POST"  style="display:none">
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
	<div class="modal fade maiilModal" id="update_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
							
							<input type="submit" name="insert" id="insert" value="Submit" class="btn btn-success"/>
					</form>
                </div>
				
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
	<div class="modal fade maiilModal" id="update_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									<input type="text" class="stuname form-control" name="stuinfo[0][stuname]">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group ">
									<label class="control-label " for="levels">
										Roll No.
									</label>
									<input type="text" class="rollno form-control" name="stuinfo[0][rollno]">
								</div>
							</div>
							<div class="col-md-1">
							<div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
						</div>
						</div>
						</div>
						</div></div></div>
							
							<input type="submit" name="register" id="register" value="Submit" class="btn btn-success"/>
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
                <select class="form-control" name="tutor_assign[]" id="tutor_assign"
                        multiple="">

                </select>
                <div id="title-error"></div>
            </div>
                <input type="hidden" id="tutor_id" name="tutor_id">
                <input type="submit" name="insert" id="insert" value="Book a Session" class="btn btn-success"/>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@push('scripts')
    <script src="{{ asset("js/admin/bootstrap-multiselect.js") }}"
            type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}"/>

    <script>
        $('#tutor_assign').multiselect({
            nonSelectedText: 'Select Tutor',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
    </script>
    <script>
	$('#first').on('click','.btnPlus',function(){
    
	$('#first').append('<div class="row"> <div class="col-md-6"> <div class="form-group "> <label class="control-label " for="levels"> Name </label> <input type="text" class="stuname form-control" name="stuname"> </div> </div> <div class="col-md-5"> <div class="form-group "> <label class="control-label " for="levels"> Roll No. </label> <input type="text" class="rollno form-control" name="rollno"> </div> </div> <div class="col-md-1"> <div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div> </div> </div>');
	$('.stuname').each(function(i){
    $(this).attr('name', 'stuinfo['+i+'][stuname]');
    });
    $('.rollno').each(function(i){
    $(this).attr('name', 'stuinfo['+i+'][rollno]');
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
                        //alert(obj);
                        console.log(data);
                        //alert(data.student[0].stuname);
                        $.each( obj, function( key, value ) {
                        //key--;
                            $('#first').append('<div class="row"> <div class="col-md-6"> <div class="form-group "> <label class="control-label " for="levels"> Name </label> <input type="text" class="stuname form-control" name="stuinfo['+key+'][stuname]" value="'+value["stuname"]+'"> </div> </div> <div class="col-md-5"> <div class="form-group "> <label class="control-label " for="levels"> Roll No. </label> <input type="text" class="rollno form-control" name="stuinfo['+key+'][rollno]" value="'+value["rollno"]+'"> </div> </div> <div class="col-md-1"> <div class="btnPlus" style="cursor: pointer;"><i class="fa fa-plus-circle" aria-hidden="true"></i></div> </div> </div>');
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

        $(".swap").click(function(){ // Click to only happen on announce links
            $('#title-error').html("");
   var ids = $(this).data('id');
          $("#tutor_id").val(ids);
            $.ajax({
                type: 'GET',
                url: "{{url('/tutor/get_swap/')}}"+'/'+ids,
                data: {

                },
                success: function (data) {

                    $("#tutor_assign").multiselect('dataprovider', JSON.parse(data));
                }

            });

            $('#myModal').modal('show');

        });
var cur_index = 0;
        $(document).ready(function(){
            $(".announce").click(function(e){ // Click to only happen on announce links
			    $("#jobid").val($(this).data('id'));
                $("#status").val($(this).data('status'));
                //$('#deleteMerchant').modal('show');
            });
			
        });
$(document).ready(function(){
 var limit = 7;
 var start = 0;
 var action = 'inactive';
 function load_data(limit, start)
 {
  $.ajax({
   url: "{{url('/tutor/assignment_lazy')}}",
   method:"POST",
   data:{limit:limit, start:start,_token: "{{ csrf_token() }}"},
   cache:false,
   success:function(data)
   {
   var obj=data.jobs_lazy;
   var html='';
   $.each( obj, function( key, value ) {
   var link='{{url("tutor/detail_assignment")}}/'+obj[key]['id'];
   var logo='';
   console.log(obj[key]['job_docs']);
   if(obj[key]['job_docs'] !=''){
		$.each( obj[key]['job_docs'], function( doc_key, doc_value ) {
			if(obj[key]['job_docs'][doc_key]['logo']){
				logo='{{url("../storage/app")}}/'+obj[key]['job_docs'][doc_key]['filename'];
			}
			
		});
   }
   if(obj[key]['assignment'] == "2"){ 
                        html +='<li class="col-md-12"><div class="kamkaaj-table"><div class="kamkaaj-table-row"><div class="kamkaaj-table-cell" style="width: 170px;"><a href="#" class="kamkaaj-jobs-listing-view1-thumb"> <img src="'+logo+'" alt=""></a> </div><div class="kamkaaj-table-cell"><div class="kamkaaj-jobs-listing-view1-wrap2"><h2><a href="'+link+'">'+obj[key]['title']+'</a></h2><i class="fas fa-pound-sign"></i> <b>'+obj[key]['rate']+'</b><ul class="kamkaaj-jobs-listing-view1-options"><li class="text">'+obj[key]['description']+'</li><li><i class="far fa-calendar-check"></i>Posted '+obj[key]['posted']+' days ago</li><li><i class="far fa-calendar-alt"></i>Booking Dates '+obj[key]['date']+'</li><li><i class="far fa-calendar-alt"></i>Start Time '+obj[key]['time_start']+' End Time '+obj[key]['time_end']+'</li></ul></div></div><div class="kamkaaj-table-cell"><a href="#" class="kamkaaj-job-type-btn"><span>Premium</span></a></div></div></div></li>';
                      }else{
                      html +='<li class="col-md-12"><div class="kamkaaj-table"><div class="kamkaaj-table-row"><div class="kamkaaj-table-cell"><div class="kamkaaj-jobs-listing-view1-wrap2"><h2><a href="'+link+'">'+obj[key]['title']+'</a></h2><i class="fas fa-pound-sign"></i> <b>'+obj[key]['rate']+'</b><ul class="kamkaaj-jobs-listing-view1-options"><li class="text">'+obj[key]['description']+'</li><li><i class="far fa-calendar-check"></i>Posted '+obj[key]['posted']+' days ago</li><li><i class="far fa-calendar-alt"></i>Booking Dates '+obj[key]['date']+'</li><li><i class="far fa-calendar-alt"></i>Start Time '+obj[key]['time_start']+' End Time '+obj[key]['time_end']+'</li></ul></div></div><div class="kamkaaj-table-cell"></div></div></div></li>';
                      }
                        
                        });
    $('#load_data').append(html);
    if(obj == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>No More Assignments</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Loading Assignments ....</button>");
     action = "inactive";
    }
   }
  });
 }

        if(action == 'inactive')
 {
  action = 'active';
  load_data(limit, start);
 }
    $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_data(limit, start);
   }, 1000);
  }
 });
});
    </script>
@endpush
@stop