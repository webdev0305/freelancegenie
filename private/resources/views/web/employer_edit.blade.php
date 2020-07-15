@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Edit Employee')
<section class="inner-page-title">
    <div class="container">
        <h2>Edit Profile</h2>
    </div>
</section>
<section class="pricing-page">
    <div class="container">
        <div class="step-form">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h1>Professional Member Profile</h1>
                            <div id='progress'>
                                <div id='progress-complete'></div>
                            </div>

                            {{--{{ Form::model($usersMeta, array('route' => array('employer.update', \encrypt($usersMeta->id)),'id' => 'employerForm','enctype'=>'multipart/form-data','files' => true,'method' => 'PUT') ) }}--}}
                            <form action="{{url('employer_update').'/'.\encrypt($usersMeta->id)}}"  id="employerForm"  enctype='multipart/form-data'  method="POST">
                                <input name="_method"  type="hidden" value="PUT">
                                {{ csrf_field() }}
                            @include('includes.employer_form')

                            </form>
                            {{--{{ Form::close() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset("js/admin/formtowizard.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/admin/bootstrap-multiselect.js") }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset("css/bootstrap-multiselect.css") }}"/>
@endpush
@stop
