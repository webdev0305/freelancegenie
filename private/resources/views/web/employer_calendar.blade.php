@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Employer dashboard')


<section class="inner-page-title">
    <div class="container">
        <h2>Employer dashboard</h2>
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
                <th>Date Form - To</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
			<?php //echo '<pre>';print_r ($jobs);echo '</pre>';
			//die('checking here');
			?>
            @foreach($jobs as $key=>$job)
            <?php $date = explode('-', $job->date);
			$date_from = $date['0'];
			$date_from = strtotime($date_from);
			$date_from = date("m/d/Y",$date_from);
			$date_from = strtotime($date_from);
			$date_to = $date['1'];
			$date_to = strtotime($date_to);
			$date_to = date("m/d/Y",$date_to);
			$date_to = strtotime($date_to);
			$current_date=date("m/d/Y");
			$current_date=strtotime($current_date);
		
			if($current_date >= $date_from && $current_date <= $date_to){
				$attended_date=date("m/d/Y");
				//$current_date=;
			}else{
				$attended_date='';
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
                                {{'Approved'}}
                                @endif
                              @if($status == '0')
                                {{'Pending'}}
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
                      <td>
							 <!--<button type="button" class="dbs btn btn-success mr-1" data-id="{{$job->tutor_id}}"  data-status="1"  data-toggle="modal" data-target="#dbs">Check DBS Record
                        </button>-->
						<button type="button" class="dbs btn btn-success mr-1" data-id="{{$job->id}}">Request DBS Update
                        </button>
						@if($status == '3')
						<button type="button" class="btn btn-success mr-1 rating" data-id="{{$job->tutor_id}}" data-job_id="{{$job->id}}" data-status="1"  data-toggle="modal" data-target="#rating">Rate Tutor
                        </button>
						@endif
						@if($status == '1' && $current_date >= $date_from && $current_date <= $date_to)
						<button type="button" class="failed_to_attend btn btn-success mr-1" data-id="{{$job->tutor_id}}" data-job_id="{{$job->id}}" data-status="4"  data-toggle="modal" data-target="#session_fail">Failed to Attend
                        </button>
						@endif
						</td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
</section>

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
                <form method="post"  enctype="multipart/form-data" id="insert_rate">
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
                                    @endfor
                                </select>
                            </div>
						</div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label " for="paperwork">
                                    If applicable; - How would you rate the Tutors/Trainers/Assessors Paperwork completion?
								</label>
                                <select class="form-control" name="paperwork">
                                    <option value="">Select</option>
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
									@for($n=1;$n <= 5;$n++)
                                     <option value="{{$n}}">{{$n}}</option>
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
                                <textarea name="comment"  style="width:100%;height:100px;"></textarea>
                            </div>

                        </div>
                    </div>
                    <input type="button" name="insertrate" id="insertrate" value="Save" class="btn btn-success"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade maiilModal" id="session_fail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <p>Are you sure this session is failed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Submit
                        <form action="{{url('employer/change_job_status')}}" method="POST"  style="display:none">
                            
                            <input type="hidden" id="jobid" name="jobid" value="">
                            <input type="hidden" id="status" name="status" value="">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        </form>
                    </a>
                </div>

            </div>
        </div>
    </div>
	
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
	<script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
    <script>


        $(document).ready(function () {
            $('#example').DataTable();
        });
        $('#usr').click(function(){
		$('#address_box').hide();
	});
	$('#na').click(function(){
		$('#address_box').show();
	});
	$("#checkd").click(function(){
           var address=$('#address').val();
		   var city=$('#city').val();
		   var street_name=$('#street_name').val();
		   var zip=$('#zip').val();
		   var country=$('#country').val();
		   var startDate = $('#date').data('daterangepicker').startDate._d;
			var endDate = $('#date').data('daterangepicker').endDate._d;
			var booking_days=showDays(endDate,startDate);
		   
		   //alert(booking_days);
		   //var address=$(input[name:'booking_address']).val();
		   var tutor_id=$(this).data('tutor_id');
            $.ajax({
                type: 'POST',
                url: "http://localhost/tutorsandtrainersonline/public/tutors/get_coordinates",
                data: {
                    address: address,'tutor_id':tutor_id,'city':city,'street_name':street_name,
					'zip':zip,'country':country,
					"_token": "Uq4h23qq8zeSBdYJt95oSjZCEHqS4X1Tx9OTGUyt"
                },
                success: function (data) {
				var response=$.parseJSON(data);
                    if (response.status == 'OK') {
					
					var distance_text=response.rows[0].elements[0].distance.text;
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
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}
	function showDays(firstDate,secondDate){
                var startDay = new Date(firstDate);
                  var endDay = new Date(secondDate);
                  var millisecondsPerDay = 1000 * 60 * 60 * 24;
					var millisBetween = startDay.getTime() - endDay.getTime();
                  var days = (millisBetween / millisecondsPerDay)+1;
					// Round down.
                  return( Math.floor(days));
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
                var thisMonth = arg._d.getMonth() + 1;   // Months are 0 based
                if (thisMonth < 10) {
                    thisMonth = "0" + thisMonth; // Leading 0
                }
                var thisDate = arg._d.getDate();
                if (thisDate < 10) {
                    thisDate = "0" + thisDate; // Leading 0
                }
                var thisYear = arg._d.getYear() + 1900;   // Years are 1900 based

                var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;
                console.log(thisCompare);

                if ($.inArray(thisCompare, disabledArr) != -1) {
                    return arg._pf = {userInvalidated: true};
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

        $("#insert").click(function(){
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
                data : new FormData($("#insert_form")[0]),
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
		$(".rating").click(function(){
		var ids = $(this).data('id');
		var job_id = $(this).data('job_id');
			//alert(ids);
			$('#tutor_id').val(ids);
			$('#job_id').val(job_id);
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
		$("#insertrate").click(function(){
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
                data : new FormData($("#insert_rate")[0]),
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
		
		$(".dbs").click(function(){ // Click to only happen on announce link
           // $('#title-error').html("");
          var ids = $(this).data('id');
		  //alert(ids);
		   
          //$("#tutor_id").val(ids);
            $.ajax({
                type: 'GET',
				url: "{{url('/employer/request_dbs_update/')}}"+'/'+ids,
                data: {//tutorid:ids,

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
						var job_id=data.job_id;
						var total=data.total;
						var care_tutor=data.care_tutor;
                        $('#insert_form').trigger("reset");
                        /*bootoast.toast({
                            message: data.message
                        });*/
                        $('#myModal').modal('toggle');
						window.location.href = "{{url('/booking')}}"+'?job_id='+job_id+'&total='+total+'&care_tutor='+care_tutor;
                    }
                }
            });
            event.preventDefault();
        });
        $(document).ready(function(){
            $(".failed_to_attend").click(function(e){ // Click to only happen on announce links
			    $("#jobid").val($(this).data('job_id'));
                $("#status").val($(this).data('status'));
                //$('#deleteMerchant').modal('show');
            });
			
        });
		
    </script>
@endpush
@stop
