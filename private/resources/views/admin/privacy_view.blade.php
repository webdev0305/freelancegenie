@extends('layouts.admin.dashboard')
@section('page_heading','Edit')
@section('section')

    <div class="view-page">
        <div class="text-wrap  mb2">
            @include('message.message')
            <form class="form-hrizontal" method="POST" action="{{ url('admin/privacy') }}">
                {{ csrf_field() }}
                
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Title</label>

                    <input id="title" type="text" maxlength="255" class="form-control" name="title" value="{{ $privacy->title }}" required
                           autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Description</label>

                    <textarea name="description"  class="form-control"  id="description">{{ $privacy->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
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
    @push('scripts')	<script>tinymce.init({ selector: "#description" });</script>	@endpush
@stop
