@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'About view')
@section('pageKeyword', $about->keyword)
@section('pageDescription', $about->seo_description)

<section class="inner-page-title" style="background: url(web/images/about.jpg) no-repeat scroll center center;color:#e66d00;">
	<div class="container">
		<h2>{{$about->title}}</h2>
        <!--<h2>About Us</h2>-->
	</div>
</section>
<?php echo $about->description; ?>
@include('includes.middle_section')
@stop
