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
			@include('message.message')
			<br>
			<div id="paid_form">
                <div class='form-group  required'>
                    <p>Your payment, although successful can take 3 days to show in our account, Don't worry you can still gain access, but if payment has not cleared after 3 days, your account may become restricted</p>
                </div>
			</div>
            <div class='form-row'>
                <div class='col-md-12'>
                    <a class='form-control w-100 text-center btn btn-primary submit-button' href="{{url('/')}}" >Ok, Go to Dashboard</a>
                </div>
            </div>
		</div>
        
	</div>

</section>



@stop