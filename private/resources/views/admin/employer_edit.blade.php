@extends('layouts.admin.dashboard')
@section('page_heading','Edit Employee')
@section('section')

    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1>Socio Professionista</h1>
                    <div id='progress'>
                        <div id='progress-complete'></div>
                    </div>

                    {{ Form::model($usersMeta, array('route' => array('employer.update', \encrypt($usersMeta->id)),'id' => 'employerForm','enctype'=>'multipart/form-data','files' => true,'method' => 'PUT') ) }}

                    @include('includes.employer_form')

                    {{--</form>--}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/formtowizard.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-multiselect.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}"/>
    @endpush
@stop
