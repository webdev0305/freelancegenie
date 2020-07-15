@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Payment')
<style>
a.btn.btn-primary {
    width: fit-content;
    padding: 8px 16px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 50px;
}
</style>
<section class="inner-page-title">
    <div class="container">
        <h2>Payment</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">
		
		<div class="form-wrap">
		@include('message.message')
		<div class="button-wrap">
			<!--<button type="submit" id="btn_credit" class="btn btn-primary">Credit Card</button>
			<button type="submit" id="btn_acc" class="btn btn-primary">On Account</button> -->
			@php if (isset($_GET['expire'])) { @endphp
            <a class="btn btn-primary" href="{{url('/pricing')}}">Choose Another Plan</a>
            @php } @endphp
		</div>
			
			
		<br>		
<div id="paid_form">
<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!!route('addmoney.stripe')!!}" >
				{{ csrf_field() }}
                <input type="hidden" name="plan_id" value="{{$plan_id}}"> 
                <input type='hidden' value="{{Request::segment(2)}}" name="user_id">                
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
						
					</div>
				</div>


                <div class='form-row'>
                    <div class='col-md-12'>
                        <div class='form-group total btn btn-info w-100 text-center'>
                            Total: <span class='amount'>{{$plan}}</span>
                        </div>
                    </div>
                </div>
				<div class='form-row'>
                    <div class='col-md-12'>
					<button class='form-control w-100 text-center btn btn-primary submit-button' type='submit'>Pay »</button>
				    </div>
                </div>
				</form>
			</div>
			
			
			<div id="onaccount_form" style="display:none;">
			<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!!route('addmoney.onaccount')!!}" >
				{{ csrf_field() }}
				
			<div class='form-row'>
                    <div class='col-md-12'>
					<input  required   type='hidden' value="{{Request::segment(2)}}" name="user_id">
					<p>Admin will verify your profile and request. Once approved you will receive an email within 24-48hrs where you can gain access using the Username and Password you entered during your registration</p>
					<button class='form-control w-100 text-center btn btn-primary submit-button' type='submit'>Go</button>
				    </div>
                </div>
				</form>
			</div>
		</div>
    </div>
	
</section>
@push('scripts')
<script>
	$('#btn_credit').click(function(){
		$('#paid_form').show();
		$('#onaccount_form').hide();
	});
	$('#btn_acc').click(function(){
		$('#paid_form').hide();
		$('#onaccount_form').show();
	});
</script>
@endpush
@stop
