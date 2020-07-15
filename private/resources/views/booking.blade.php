@extends('layouts.dashboard')

@section('section')

@section('pageTitle', 'Payment')



<section class="inner-page-title">

    <div class="container">

        <h2>Payment</h2>

    </div>

</section>

<section class="inner-cotent">

    <div class="container">

		

		<div class="form-wrap">

		<!--<div class="button-wrap">

			<button type="submit" id="btn_credit" class="btn btn-primary">Credit Card</button>

			<button type="submit" id="btn_acc" class="btn btn-primary">On Account</button>

		</div>-->

			@include('message.message')

            <?php //echo '<pre>';print_r($job);echo '</pre>';?>

			

		<br>		

<div id="paid_form">

<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!!route('addmoney.booking')!!}" >

				{{ csrf_field() }}

				<input type="hidden" name="job_id" value="{{\Input::get('job_id')}}">

                <input type="hidden" id="pending_paid" name="pending_paid">

                <input type="hidden" name="half_paid" value="{{$half_paid}}">

				<div class='form-group  required'>

					<label class='control-label'>Card Number</label>



					<div class="input-group">

						<input autocomplete='off' required  value="4242424242424242" class='form-control card-number' size='20' type='number' name="card_no">

						<div class="input-group-append">

							<span class="input-group-text" id="image-strip"><img src="{{asset('images/logo-stripe.png')}}" class="img-fluid"></span>

						</div>

					</div>





				</div>



				<div class='form-row'>

					<div class='col-12 col-md-4 form-group cvc required'>

						<label class='control-label'>CVV</label>

						<input autocomplete='off' required value="314" class='form-control card-cvc' maxlength="3" minlength="3"  placeholder='ex. 311' size='6' type='number' name="cvvNumber">

					</div>

					<div class='col-6 col-md-4 form-group expiration required'>

						<label class='control-label'>Expiration (Month)</label>

						<input class='form-control card-expiry-month' value="10" required placeholder='MM' size='2' type='text' name="ccExpiryMonth">

					</div>

					<div class='col-6 col-md-4 form-group expiration required'>

						<label class='control-label'>(Year)</label>

						<input class='form-control card-expiry-year' value="2020" required placeholder='YYYY' size='4' type='text' name="ccExpiryYear">

						<input  required   type='hidden' value="{{Request::segment(2)}}" name="user_id">

					</div>

				</div>





                <div class='form-row'>

                    <div class='col-md-12'>

                        <div class='form-group total btn btn-info w-100 text-center'>

                            Total: £<span class='amount'>

								@if($half_paid==1)

                                {{$total=$total/2}}

                                @else

                                {{$total}}

                                @endif

								  </span> 

								  <input type="hidden" id="amount_pay" name="amount_pay" value="{{$total}}">

                        </div>

						

                    </div>

                </div>

                

				{{--@if(!(\Input::get('care_tutor')) && $half_paid ==0)

						 <div class="form-row">

							<div class="col-md-6">

								<div id="full" class="form-group w-100 total btn btn-info text-center">

									Pay Full Amount

								</div>

							</div>

							<div class="col-md-6">

								<div id="fifty" class="form-group w-100 total btn btn-info text-center">

									Pay 50%

								</div>

							</div>

						</div>

						@endif --}}

                        @if(\Sentinel::getUser()->fta_count >= 1)

                <div class="form-row">

							<div class="col-md-6">

								<div id="" class="form-group w-100 total text-center">

									FTA: 1

								</div>

							</div>

							<div class="col-md-6">

								<div id="rdmft" class="form-group w-100 total btn btn-info text-center">

									Redeem FTA

								</div>

							</div>

						</div>

                        @endif

				<div class='form-row'>

                    <div class='col-md-12'>

					<button class='form-control w-100 text-center btn btn-primary submit-button' type='submit'>Pay »</button>

				    </div>

                </div>

				</form>

			</div>

			

		</div>

    </div>

	

</section>

@push('scripts')

<script>

	$('#fifty').click(function(){

		$('#amount_pay').val({{$total/2}});

		$('.amount').text({{$total/2}});

        $('#pending_paid').val(1);

	});

	$('#full').click(function(){

		$('#amount_pay').val({{$total}});

		$('.amount').text({{$total}});

        $('#pending_paid').val(0);

	});

    $('#rdmft').click(function(){

    //alert('here');

    //alert($('#amount_pay').val());

        var amount_pay=$('#amount_pay').val()-($('#amount_pay').val()/10);

        //alert(amount_pay);

		$('#amount_pay').val(amount_pay);

		$('.amount').text(amount_pay);

	});

</script>

@endpush

@stop

