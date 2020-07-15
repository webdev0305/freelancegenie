@extends('layouts.admin.dashboard')
@section('page_heading','Change Password')
@section('section')
    @include('message.message')
    <div class="row">
        
        <div class="col-md-6">
            <div class="form-wrap">
            <form role="form" method="POST" action="{{ url('admin/change_password') }}">
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
    </div>

@stop
