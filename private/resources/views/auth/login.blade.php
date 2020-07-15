@extends('layouts.dashboard')

@section('section')

    <section class="inner-page-title">

        <h2>Login</h2>

    </section>

    <section id="login" class="form-page">

        <div class="container">

            <div class="form-wrap">

            @include('message.message')

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">

                    {{ csrf_field() }}
					@php 
					$link=str_replace(url()->current(),'',url()->full());
					@endphp
					<input type='hidden' name='search' value='{{$link}}'>
					<div class="cstm-login">
						<h2>LOGIN</h2>
					</div>
			<div class="cstm-input">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <!--<label for="email" class="control-label">E-Mail Address</label>-->

							<i class="fas fa-envelope"></i>
							<input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required autofocus>
							@if ($errors->has('email'))
							<span class="help-block">

                            <strong>{{ $errors->first('email') }}</strong>

                        </span>

                            @endif



                    </div>



                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <!--<label for="password" class=" control-label">Password</label>-->
				
			<i class="fas fa-lock"></i>





                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>



                            @if ($errors->has('password'))

                                <span class="help-block">

                            <strong>{{ $errors->first('password') }}</strong>

                        </span>

                            @endif



                    </div>



                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me

                                    </label>

                                </div>

                            </div>

                            <div class="col-md-6 text-right">

                                <a class="btn-link" href="{{ route('password.request') }}">

                                    Forgot Your Password?

                                </a>

                            </div>



                        </div>



                    </div>

                    <div class="button-wrap">

                        <button type="submit" class="btn btn-primary lgn-btn">

                            Login

                        </button>



                    </div>
		</div>

                </form>



            </div>

        </div>

    </section>



@stop

