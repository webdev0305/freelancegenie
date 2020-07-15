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
	
        <div class="row">
		@include('message.message')

            <div class="col-md-12">
                <!-- JobDetail List -->
                <div class="kamkaaj-jobdetail-list">

                    <div class="kamkaaj-jobdetail-list-text custom_float col-md-9">
                    <?php //echo '<pre>';print_r($jobs);die;
                    $date = explode(',', $jobs->date);
					$date_from = str_replace('/', '-', $date['0']);
					$date_from = strtotime($date_from);
					$current_date=date("d-m-Y");
					$current_date=strtotime($current_date);?>
					@foreach($jobs['userjobsmeta'] as  $jobMet)
                        @if($jobMet->user_id !='')
                        @php $tutor_id=$jobMet->user_id;@endphp
                        @endif
                        @if($jobMet->pivot->status == '1')
                           @php   $status = '1';  @endphp
                            @continue
                        @endif
					@endforeach
			 
                        <h2>{{$jobs->title}}</h2>
                        <ul>
                            <li>
                                <i class="fa fa-calendar-alt"></i> Booking Date: {{$jobs->date}}
                            </li>
							<li><i class="far fa-calendar-check"></i>Posted {{$jobs->posted}} days ago</li>
							<li class="pricing"><i class="fas fa-pound-sign"></i>{{$jobs->rate}}/Day</li>
							<li>Status: @if($jobs->status == "6")
                                {{'Booked'}}
								@elseif($jobs->status == "8")
                                {{'Awaiting Your Approval'}}
								@elseif($jobs->status == "5")
                                {{'Cancelled'}}
                                @else
                                {{'Awaiting Tutor Acceptance'}}
                            @endif
							</li>
                        </ul>
                        
                        
						@if($jobs->status == '0' && $current_date <= $date_from)
                        <button type="button" class="announce kamkaaj-jobdetail-list-btn" data-id="{{$jobs->id}}"  data-status="5"  data-toggle="modal" data-target="#deleteMerchant2">Cancel
                        </button>
						@endif
                        @if($jobs->status == '8' && $current_date <= $date_from)
                        <button type="button" class="confirm kamkaaj-jobdetail-list-btn" data-id="{{$jobs->id}}"  data-status="6"  data-toggle="modal" data-target="#deleteMerchant">Confirm
                        </button>
						<button type="button" class="announce kamkaaj-jobdetail-list-btn" data-id="{{$jobs->id}}"  data-status="7"  data-toggle="modal" data-target="#deleteMerchant2">Decline
                        </button>
                        @endif
                        @if($jobs->status)
                        <a class="kamkaaj-jobdetail-list-btn" target="_blank" href="{{url('/tutors')}}/{{encrypt($tutor_id)}}">View Tutor</a>
						<button type="button" class="dbs kamkaaj-jobdetail-list-btn" data-id="{{$jobs->id}}">Request DBS Update
                        </button>
                        @endif
						@if($jobs->status == '3')
						<button type="button" class="kamkaaj-jobdetail-list-btn rating" data-id="{{$jobs->tutor_id}}" data-job_id="{{$jobs->id}}" data-status="1"  data-toggle="modal" data-target="#rating">Rate Tutor
                        </button>
						@endif
						@if($jobs->status == '8' && $current_date >= $date_from)
                        
						<button type="button" class="kamkaaj-jobdetail-list-btn" data-id="{{$jobs->tutor_id}}" data-job_id="{{$jobs->id}}" data-status="4"  data-toggle="modal" data-target="#session_fail">Failed to Attend
                        </button>
						@endif
						
                        <!--a href="#" class="kamkaaj-jobdetail-list-btn"><i class="far fa-envelope"></i> Email Job</a-->
                        <span class="kamkaaj-jobdetail-list-featured">Premium</span>
                    </div>
                    @if($jobs->JobDocs !='')
						@foreach($jobs->JobDocs as $docs)
							@if($docs->logo)
								<div class="custom_float col-md-3"><img src="{{url('../storage/app').'/'.$docs->filename}}"/></div>
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
					<div class="col-sm-5">
					<p><strong>Onsite Projector: </strong><span>{{($jobs->onsite_projector)? 'Yes' : 'No'}}</span></p>
					<p><strong>Wipe Board: </strong><span>{{($jobs->wipe_board)? 'Yes' : 'No'}}</span></p>
					<p><strong>Flip Chart and Stand: </strong><span>{{($jobs->flip_chart_and_stand)? 'Yes' : 'No'}}</span></p>
					<p><strong>Any of the Audience have any learning difficulties or disabilities that we need to be aware of: </strong><span>{{($jobs->disabilities)? 'Yes' : 'No'}}</span></p>
					</div>
					<div class="col-sm-7">
					<p><strong>Audience learning difficulties or disabilities: </strong><span>{{($jobs->difficulty_info)? $jobs->difficulty_info : ''}}</span></p>
					<p><strong>IT Suite/I.T equipment available for use: </strong><span>{{($jobs->equipment_available)? 'Yes' : 'No'}}</span></p>
					<p><strong>Equipment available onsite to be used: </strong><span>{{($jobs->equipment_available_onsite)? 'Yes' : 'No'}}</span></p>
                    <p><strong>Equipment available: </strong><span>{{($jobs->equipment_info)? $jobs->equipment_info : ''}}</span></p>
					</div>
					</div>
                </div>



            </div>



        </div>
		
		<div class="row">		<div class="col-md-12">			<div class="attached_doc">
		<h3 style="color: #000;font-size: 22px;margin-bottom: 8px;font-weight: 600;">Attached Docs</h3>
		@if($jobs->JobDocs !='')
			@foreach($jobs->JobDocs as $docs)
				@if(!$docs->logo)
					<div class="col-md-3">
					<div class="file-wrap">
					<h6>{{$docs->originalname}}</h6>
					
					<a download="{{$docs->originalname}}" class="announce btn" href="{{url('../storage/app').'/'.$docs->filename}}">Download</a>
					</div>
				</div>
				@endif
			@endforeach
					
        @endif
        </div>        </div>        </div>
</section>



<section class="inner-cotent">
    <div class="container">
	<div class="modal fade maiilModal" id="deleteMerchant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm & Pay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <span id="cost"></span>
					<div id="additional_cost"></div> 
					<span id="total_text"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="pay" data-job_id="" class="btn btn-secondary" style="cursor:pointer;" onclick="$(this).find('form').submit();">Pay
                    </a>
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
		<div class="modal fade maiilModal" id="deleteMerchant2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <p id="status_text">Are you sure you want to cancel this assignment.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-secondary" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Confirm
                        <form action="{{url('employer/cancel_job')}}" method="POST"  style="display:none">
                            <input type="hidden" id="cancel" name="cancel" value="1">
                            <input type="hidden" id="jobid" name="jobid" value="">
                            <input type="hidden" id="status" name="status" value="">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        </form>
                    </a>
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
                    <a href="https://secure.crbonline.gov.uk/crsc/check" id="session_fail_go" target="_blank" class="btn btn-secondary" data-method="delete" style="cursor:pointer;">Failed to Attend
                       
                    </a>
                </div>

            </div>
        </div>
    </div>

    </div>
    			
	
	
</section>


@push('scripts')
<script>
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
                url: "{{url('tutors/get_coordinates')}}",
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
 $(".rating").click(function(){
		var ids = $(this).data('id');
		var job_id = $(this).data('job_id');
			//alert(ids);
			$('#tutor_id').val(ids);
			$('#job_id').val(job_id);
		});
		$("#session_fail_go").click(function(){
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
$('.confirm').click(function(){
            priceAjax($(this).data('id'));
            $("#pay").data("job_id",$(this).data('id'));
        });
        $(document).ready(function(){
            $(".announce").click(function(e){ // Click to only happen on announce links
			    //alert('event occured');alert($(this).data('id'));
                $("#jobid").val($(this).data('id'));
                $("#status").val($(this).data('status'));
				if($(this).data('status')==7){
					$('#status_text').text('Are you sure you want to decline this tutor.');
				}
                //$('#deleteMerchant').modal('show');
            });
			
        });
		function priceAjax(id) {
        //alert(id);
						
            $.ajax({
					
                type: "POST",
                url: "{{url('/tutors/assignnment_price_calculation')}}",
                data:{'job_id':id,"_token": "{{ csrf_token() }}"},
                success: function (data) {
                var res=jQuery.parseJSON(data);
				console.log(res);
				 
                        $('#cost').text('Tutor Cost: £'+res.cost);
						if (parseInt(res.include_mileage)) {
							if(res.time != "" && res.time > 7200){
							
							$('#additional_cost').html('Hotel Cost: £'+res.hotel_cost+' <br>Travel Cost from Tutor Venue to Hotel: £'+res.travel_cost+' <br>Travel Cost from Hotel to Booking Address: £'+res.travel_cost_hot_booking);
							}else{
								
								$('#additional_cost').html('Travel Cost from Tutor Venue to Booking Venue: £'+res.travel_cost);
							}
						}
                        $('#total').val(res.total_cost);
						$('#total_text').text('Total: £'+res.total_cost);
					
                }
            });
			}
 $('#pay').click(function(){
            var job_id=$(this).data('job_id');
            //var care_tutor="2";
            window.location.href = "{{url('/booking')}}"+'?job_id='+job_id;
            });		
</script>
@endpush
@stop