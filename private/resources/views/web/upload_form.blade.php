@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor Documents')

<section class="inner-page-title">
    <div class="container">
        <h2>Tutor Documents</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">
        @include('message.message')
        <div class="row">
        <div class="col-md-12">
		<form action="{{url('tutor/upload')}}" enctype="multipart/form-data" class="uplod" method="post">
            {{ csrf_field() }} 
            <h2>Upload documents <small>(can attach more than one):</small></h2>
            <input multiple="multiple" name="photos[]" type="file" required> 
            
            <input class="btn btn-success" type="submit" value="Upload">
            </form>
            </div>
            </div>
            <?php //echo '<pre>';print_r($userdoc);die;?>
            <h3>Personal Documents</h3>
            <div class="row">
            @foreach($userdoc as $doc)
            <div class="col-md-3">
			<div class="file-wrap">
            <h6>{{$doc->originalname}}</h6>
            
            <a download="{{$doc->originalname}}" class="announce btn " href="{{url('../storage/app').'/'.$doc->filename}}">Download</a>
            </div>
			</div>
            @endforeach
            </div>
            <h3>Public Documents</h3>
            <div class="row">
            @foreach($globaldoc as $doc)
            <div class="col-md-3">
			<div class="file-wrap">
            <h6>{{$doc->originalname}}</h6>
            
            <a download="{{$doc->originalname}}" class="announce btn " href="{{url('../storage/app').'/'.$doc->filename}}">Download</a>
            </div>
			</div>
            @endforeach
            </div>
        
    </div>
	
</section>
@stop