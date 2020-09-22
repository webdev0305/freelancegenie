@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor Invoice')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  text-align: left;
  padding: 8px;
}

tr:nth-child(odd) {
  background-color: #dddddd;
}
.subtotal, .total{
	background:transparent !important;
}
</style>

<section class="inner-page-title">
    <div class="container">
        <h2>Invoice Details</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">
        @include('message.message')
		<?php //echo '<pre>';print_r($invoice);echo '</pre>';?>
        <?php //echo '<pre>';print_r($mileage);echo '</pre>';?>
		<?php $booking_days=count(explode(',',$invoice->date));?>
        <table id="example" class="table table-striped table-bordered table-responsive-lg" style="width:100%">
            <thead>
                <tr>
                    <th>Booking Id</th>
    				<th>Booking Dates</th>
    				<th>Attended Date</th>
    				<th>Tutor Rate</th>
    				<?php if($invoice->hotel_charges >0){?>
    				<th>Hotel Charges</th>
    				<th>Travel Cost Hotel to Booking Venue</th>
    				<?php }else{ ?>
    				<th>Travel Cost Tutor Venue to Booking Venue</th>
    				<?php } ?>
    				<th>Cost per Day</th>
    			</tr>
            </thead>
            <tbody>
    			@php ($subtotal=0 & $travel_cost_h=0 & $travel_cost=0);
    			if(sizeof($invoice['Invoice'])>0){ @endphp
                @foreach($invoice['Invoice'] as $key=>$inv)
    			@if($inv->sent == "1") <!-- Only last sent invoice-->
				<tr>
                    <td>{{$inv->booking_no}}</td>
					<td>{{$invoice->date}}</td>
					<td>{{$inv->date}}</td>
					<td>{{'£'.$inv->rate}}</td>
					<?php if($invoice->hotel_charges >0){
					$hot_booking_dist=15;?>
					<td>{{'£'.$invoice->hotel_charges}}</td>
					<td>{{'£'.$travel_cost=2*$hot_booking_dist*$mileage}}</td>
					<?php }else{ ?>
                    <td>{{'£'.$travel_cost=2*$invoice->distance*$mileage}}</td>
					<?php }?>
					<td>{{'£'.$day_total=$inv->rate+$travel_cost+$invoice->hotel_charges}}</td>
                </tr>
				
				@php $subtotal+=$day_total;@endphp
				@endif
			    @endforeach
			    <?php if($invoice->hotel_charges >0){?>
			    <tr class="subtotal">
                    <td colspan="5"></td>
                    <td>Travel Cost Tutor - Booking Venue</td>
                    <td>{{'£'.$travel_cost_h=2*$invoice->distance*$mileage}}</td>
                </tr>
                <?php }?>
                <tr class="subtotal">
                    <td colspan="<?php if($invoice->hotel_charges >0){echo 5;}else{echo 4;}?>"></td>
                    <td>Subtotal</td>
                    <td>{{'£'.$subtotal=$subtotal+$travel_cost_h}}</td>
                </tr>
                <tr>
                    <td colspan="<?php if($invoice->hotel_charges >0){echo 5;}else{echo 4;}?>"></td>
                    <td>20% VAT</td>
                    <td>{{'£'.$vat=$vat_rate/100*$subtotal}}</td>
                </tr>
                <tr class="subtotal">
                    <td colspan="<?php if($invoice->hotel_charges >0){echo 5;}else{echo 4;}?>"></td>
                    <td>Total</td>
                    <td>{{'£'.$total=$subtotal+$vat}}</td>
                </tr>
                <tr class="subtotal">
                    <td colspan="<?php if($invoice->hotel_charges >0){echo 5;}else{echo 4;}?>"></td>
                    <td>FTA Deduction(10%)</td>
                    <td>{{'£'.$fta_deduct=10/100*$total}}</td>
                </tr>
                <tr class="subtotal">
                    <td colspan="<?php if($invoice->hotel_charges >0){echo 5;}else{echo 4;}?>"></td>
                    <td>Amount Payable</td>
                    <td>{{'£'.$total=$total-$fta_deduct}}</td>
                </tr>
                @php } @endphp
            </tbody>
        </table>
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
		$('#update_recordform').on("submit", function (event) {
		alert('here');
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

        $(document).ready(function(){
            $(".announce").click(function(e){ // Click to only happen on announce links
			    $("#jobid").val($(this).data('id'));
                $("#status").val($(this).data('status'));
                //$('#deleteMerchant').modal('show');
            });
			
        });
        /*$(document).ready(function () {
            //$('#example').DataTable();
			oTable = $('#example').DataTable({
				"dom": 'Bfrtip',
				//"buttons": [ 'excel', 'pdf', 'print'],
				"buttons": [ 'excel','print'],
                });
        });*/
    </script>
@endpush
@stop