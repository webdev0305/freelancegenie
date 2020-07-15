@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Edit Profile')
<section class="inner-page-title">
    <div class="container">
        <h2>Edit Profile</h2>
    </div>
</section>
<section class="pricing-page">
    <div class="container">
        <div class="step-form">
            <div class="row">
                <div id="mtform" class="col-md-12 col-sm-12 col-xs-12">
                    <h1>Professional Partner</h1>
                    <div id='progress'>
                        <div id='progress-complete'></div>
                    </div>

                    {{--{{ Form::model($usersMeta, array('route' => array('tutor.update', \encrypt($usersMeta->id)),'id' => 'msform','enctype'=>'multipart/form-data','files' => true,'method' => 'PUT') ) }}--}}
                    <form action="{{url('tutor_update').'/'.\encrypt($usersMeta->id)}}"  id="msform"  enctype='multipart/form-data'  method="POST">
                        <input name="_method"  type="hidden" value="PUT">
                        {{ csrf_field() }}
                        @include('includes.tutor_form')
                    </form>
                    {{--{{ Form::close() }}--}}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')<script src="{{ asset("js/admin/formtowizard.js") }}" type="text/javascript"></script><script src="{{ asset("js/admin/tutor_certificates.js") }}" type="text/javascript"></script><script src="{{ asset("js/admin/tutor_work.js") }}" type="text/javascript"></script><script> $("#czContainer").czMore();</script><script> $("#czContainerWork").czMores();</script> <script>$('#disciplines').multiselect({
            nonSelectedText: 'Select type',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });	$('#language').multiselect({
            nonSelectedText: 'Select Language',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
        $('#travel_location').multiselect({
            nonSelectedText: 'Select locations ',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });						
    </script>
@endpush
@stop
