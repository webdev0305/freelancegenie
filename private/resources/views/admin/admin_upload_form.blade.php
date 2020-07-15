@extends('layouts.admin.dashboard')
@section('page_heading','Documents')
@section('section')

    <div class="view-page">
        <div class="text-wrap  mb2">
            @include('message.message')
            <h2>Tutor Documents</h2>
            <div class="row">
        <div class="col-md-6">
		<form action="{{url('admin/upload')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }} 
            Upload (can attach more than one): <br>
            <input multiple="multiple" name="photos[]" type="file" required> 
            <br><br>
            <input class="btn btn-success" type="submit" value="Upload">
            </form>
            </div>
            </div>
            <?php //echo '<pre>';print_r($userdoc);die;?>
            <h3>Uploaded Documents</h3>
            <div class="row">
            @foreach($userdoc as $doc)
            <div class="col-md-3">
            <h6>{{$doc->originalname}}</h6>
            
            <a download="{{$doc->originalname}}" class="announce btn btn-success float-left mr-1" href="<?php echo '/storage/app/'.$doc->filename;?>">Download</a>
            </div>
            @endforeach
            </div>

        </div>
    </div>
@stop
