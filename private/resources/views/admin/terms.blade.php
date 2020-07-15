@extends('layouts.admin.dashboard')
@section('page_heading','Edit Terms of Service')
@section('section')

    <div class="view-page">
        <div class="text-wrap  mb2">
            @include('message.message')
            <form class="form-hrizontal" method="POST" action="{{ url('admin/about') }}">
                {{ csrf_field() }}
                <input id="slug" type="hidden" class="form-control"  name="slug" value="terms" required
                       autofocus>
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Title</label>

                    <input id="title" type="text" maxlength="255" class="form-control" name="title" value="{{ $about->title }}" required
                           autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

               

                    <input name="shot"  class="form-control"  maxlength="500" id="shot" value="{{ $about->shot }}">
                   

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Description</label>

                    <textarea name="description"  class="form-control"  id="description">{{ $about->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
				<h3>Seo</h3>
				<div class="form-group">
                    <label for="keyword" class="control-label">Keywords</label>
					<textarea class="form-control" id="keyword" name="keyword" placeholder="Add Keywords">{{$about->keyword}}</textarea>
                    
                </div>
				<div class="form-group">
                    <label for="keyword" class="control-label">Description</label>
					<textarea class="form-control" id="seo_description" name="seo_description" placeholder="Add Description">{{$about->seo_description}}</textarea>
                    
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
