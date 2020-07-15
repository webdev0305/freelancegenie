@extends('layouts.dashboard')
@section('section')
<section class="inner-page-title">
	<h2>Register</h2>
</section>
<section id="regiter" class="form-page">
    <div class="container">
        <div class="form-wrap">

				@include('message.message')
				
					<form class="form-horizontal" method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}
						<div class="cstm-login ">
							<h2>REGISTER</h2>
						</div>
						<div class="cstm-input register-page">
						<input type="hidden" value="{{Request::segment(2)}}" name="type">
						<input type="hidden" value="{{Request::segment(3)}}" name="planId">
						<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
							<label for="name" class="control-label">First Name</label>

							
								<input id="name" type="text" class="form-control" name="first_name"
									   value="{{ old('first_name') }}" required autofocus>

								@if ($errors->has('first_name'))
									<span class="help-block">
									<strong>{{ $errors->first('first_name') }}</strong>
								</span>
								@endif
							
						</div>

						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="name" class="control-label">Last Name</label>

							
								<input id="name" type="text" class="form-control" name="last_name"
									   value="{{ old('last_name') }}" required autofocus>

								@if ($errors->has('last_name'))
									<span class="help-block">
									<strong>{{ $errors->first('last_name') }}</strong>
								</span>
								@endif
							
						</div>


						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="control-label">E-Mail Address</label>

							
								<input id="email" type="email" class="form-control" name="email"
									   value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="control-label">Password</label>

							
								<input id="password" type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label for="password-confirm" class="control-label">Confirm Password</label>

								<input id="password-confirm" type="password" class="form-control"
									   name="password_confirmation" required>
								@if ($errors->has('password_confirmation'))
									<span class="help-block">
									<strong>{{ $errors->first('password_confirmation') }}</strong>
								</span>
								@endif
							
						</div>
<label class="checkbox"><input type="checkbox" name="terms" id="terms" onchange="activateButton(this)">  I Agree Terms & Conditions</label>
						
						<div class="button-wrap">
							<button type="submit" id="submit" class="btn btn-primary">Register</button>
						</div>
						</div>
					</form>
				

        </div>
    </div>
</section>
@push('scripts')
<script>
 $('document').ready(function() {
  document.getElementById("submit").disabled = true;
 });

  function activateButton(element) {

      if(element.checked) {
        document.getElementById("submit").disabled = false;
       }
       else  {
        document.getElementById("submit").disabled = true;
      }

  }
</script>
@endpush
@stop
