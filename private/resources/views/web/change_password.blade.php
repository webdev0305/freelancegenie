@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Change Password')
@include('message.message')
<section class="inner-page-title">
    <div class="container">
        <h2>{{'Change Password'}}</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">


                    <div class="form-wrap">
                        <form role="form" method="POST" action="{{ url('change_password') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="disabledSelect">Old Password</label>
                                <input name="old_password" class="form-control" type="password">
                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="disabledSelect">New Password</label>
                                <input name="password" class="form-control" type="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="disabledSelect">Confirm Password</label>
                                <input name="confirm_password" class="form-control" type="password">
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>

    </div>
</section>
@stop
