@extends('layouts.admin.dashboard')
@section('page_heading','View Tutor')
@section('section')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="step-form">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                <div class="col-md-8">

                    <h1>Professional Partner</h1>
                </div>
                <div class="col-md-4 text-right">

                    <input id="toggle-event" type="checkbox" data-toggle="toggle" data-on="Approved"
                           data-off="Not Approved">
                </div>
                </div>
                <div id='progress'>
                    <div id='progress-complete'></div>
                </div>

                {{ Form::model($usersMeta, array('route' => array('tutor.update', \encrypt($usersMeta->id)),'id' => 'msform','enctype'=>'multipart/form-data','files' => true,'method' => 'PUT') ) }}
                @include('includes.tutor_form')
                {{--</form>--}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="{{ asset('js/admin/formtowizard.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-multiselect.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}"/>
        <script src="{{ asset('js/admin/tutor_certificates.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/tutor_work.js') }}" type="text/javascript"></script>
        <script> $("#czContainer").czMore();</script>
        <script> $("#czContainerWork").czMores();</script>
        @if($usersMeta->tutor_profile->status == '1')
            <script>
                $('#toggle-event').bootstrapToggle('on');
            </script>
        @else
            <script>
                $('#toggle-event').bootstrapToggle('off');
            </script>
        @endif
        <script>
            $(function () {
                $('#toggle-event').change(function () {

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/admin/tutor_approved')}}",
                        data: {
                            checkVal: $(this).prop('checked'),
                            tutor_id: '{{$usersMeta->id}}',
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            alert(response);
                        }

                    });
                })
            })
        </script>
        <script>
            $('#disciplines').multiselect({
                nonSelectedText: 'Select type',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '500px'
            });
        </script>


    @endpush
@stop
