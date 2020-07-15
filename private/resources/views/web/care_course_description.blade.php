@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'QCQ Care Course')
@php
$desc='';
if($categories->sub_category_id == "44"){
	$desc='Fire safety management in the workplace is a very complex process, which is why our trainers can offer a wide variety of different courses to provide employees with the correct knowledge. The potentially devastating effects of fires in the workplace can cause loss of life, injuries, damage to property and the environment, and to business continuity - but most of them can be prevented with the right training.
		Health and safety legislation has now placed a responsibility on employers to institute systems and procedures and ensure their employees undergo suitable training. With our fire safety courses, the attendees will benefit from the years of experience that our range of specialist tutors have.';
}
if($categories->sub_category_id == "46"){
	$desc='If an emergency was to occur in any situation, being equipped with the knowledge and confidence from a first aid course could help you deliver potentially life-saving assistance. These skills are also invaluable in everyday situations, which gives individuals plenty of reasons to learn first aid. You will also be equipped with the knowledge and skills to administer a wide variety of first aid techniques in the workplace with confidence.
		No matter which trainer you decide to work with, they will offer face to face support from start to finish. Utilising their expertise, the tutor can guide you through the techniques and information needed while assessing your ability to deliver first aid. Each of our trainers is also fully vetted and verified, with in-depth subject knowledge and the ability to empathise - a combination that makes their teaching methods very effective.';
}
if($categories->sub_category_id == "48"){
	$desc='All of our care training courses will be carried out by specialist individuals who understand the unique needs and challenges you face in a caregiving environment. These may include practising healthcare professionals, who have first-hand experience working as care workers, healthcare assistants and social care support workers.

All staff working within residential care and nursing home care are required to meet set standards when it comes to training, so each of the courses aims to increase delegate’s knowledge of different conditions, ideal for anyone who needs first-hand knowledge.';
}
@endphp	
@section('pageDescription', $desc)
<section class="inner-page-title">
<h2>QCQ Care Course</h2>
<div class="col-md-4 text-right">
<!--<button type="button" class="btn btn-primary"
		id="myModal2">
	Book a Tutor
</button>-->
</div>

</section>

<section id="tutor-view">

    <div class="container">
        <?php //echo '<pre>';print_r($categories);echo '</pre>';?>                
		
		<div class="row">
			<div class="col-md-8">
				<h2>{{$categories->name}}</h2>
				<div class="cstm-prc">
				<p><i class="fas fa-clock"></i>Course Duration: {{$categories->duration.' hours'}}</p>
				<p><i class="fas fa-pound-sign"></i>Cost: {{'£'.$categories->cost}}</p>
				<p><i class="fas fa-users"></i>Max No of Delegates: 15</p>
				<p><i class="fas fa-chalkboard-teacher"></i>Onsite</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="text-right">
					<a class="btn btn-primary" href="{{url('tutors?specialist[]='.$categories->id.'&cat_id='.encrypt($categories->id))}}">{{'Find a Tutor'}}</a>
				</div>
			</div>	
		</div>
	<div class="row">
		
			<?php echo $categories->course_detail; ?>
		
	</div>
	</div>
</section>



@push('scripts')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endpush
@stop
