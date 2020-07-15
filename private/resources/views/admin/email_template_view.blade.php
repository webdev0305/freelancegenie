@extends('layouts.admin.dashboard')

@section('page_heading','Edit')

@section('section')



    <div class="view-page">

        <div class="text-wrap  mb2">

            @include('message.message')

            <form class="form-hrizontal" method="POST" action="{{ url('admin/emailtemplate') }}">

                {{ csrf_field() }}

                <input id="slug" type="hidden" class="form-control"  name="slug" value="email_template" required

                       autofocus>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                    <label for="email" class="control-label">Title</label>



                    <input id="title" type="text" maxlength="255" class="form-control" name="title" value="{{ $email_template->title }}" required

                           autofocus>

                    @if ($errors->has('title'))

                        <span class="help-block">

                            <strong>{{ $errors->first('title') }}</strong>

                        </span>

                    @endif

                </div>





                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                    <label for="email" class="control-label">Layout Content</label>



                    <textarea name="body"  class="form-control"  id="body">{{ $email_template->body }}</textarea>

                    @if ($errors->has('body'))

                        <span class="help-block">

                            <strong>{{ $errors->first('body') }}</strong>

                        </span>

                    @endif

                </div>



                <div class="button-wrap">

                    <button type="submit" class="btn btn-primary">

                        Update

                    </button>

                </div>

            </form>



        </div>

    </div>

    @push('scripts')
	<script>tinymce.init({ selector: "#body" });</script>

    @endpush

@stop

