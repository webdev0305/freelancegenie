@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Contact Us')


<section class="inner-page-title">
    <div class="container">
        <h2>Contact Us</h2>
    </div>
</section>

<section class="inner-cotent contact_page">
    <div class="container">
	
	<div class="row">
		<div class="col-md-7">
			@include('message.message')

		<div class="form-wrap">
			<form class="form-horizontal" method="POST" action="{{ url('contact_us') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="email" class="control-label">Name</label>
					<input id="name" type="text" class="form-control" name="name" value="" required autofocus>
					@if ($errors->has('name'))
						<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">E-Mail Address</label>


					<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
					  @if ($errors->has('email'))
						<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
					<label for="password" class=" control-label">Subject</label>
					<input id="subject" type="text" class="form-control" name="subject" required>
					@if ($errors->has('subject'))
						<span class="help-block">
					<strong>{{ $errors->first('subject') }}</strong>
				</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
					<label for="body" class=" control-label">Message</label>
					<textarea id="body" type="text" class="form-control" name="body" required></textarea>
					@if ($errors->has('body'))
						<span class="help-block">
					<strong>{{ $errors->first('body') }}</strong>
				</span>
					@endif
				</div>


				<div class="button-wrap">
					<button type="submit" class="btn btn-primary">
						Contact us
					</button>

				</div>
			</form>
		</div>
		
		</div>
		<div class="col-md-5">
		<h3>Registered Office Address</h3>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2434.0944683423686!2d-1.5126349841968203!3d52.404964079792535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48774bba9e26199d%3A0xb96a69d947997120!2s111+New+Union+St%2C+Coventry+CV1+2NT%2C+UK!5e0!3m2!1sen!2sin!4v1565335770890!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		<div class="map-tel">
			<span><i class="fas fa-phone-volume"></i>Call us:</span> 
			<a class="" href="tel:+(56) 123 456 546">+(56) 123 456 546</a>
		</div>
		</div>
	</div>
		
            
    </div>
</section>



@push('scripts')

@endpush
@stop
