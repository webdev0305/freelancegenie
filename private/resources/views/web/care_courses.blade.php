@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Care Courses')
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
<style>
		.set-icon p a{
		width: 100%;
		padding: 20px;
		color: #fff;
		background-size: cover !important;
		min-height: 170px;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		text-decoration: none;
		display:inline-flex;
		font-size: 25px;
	}
	.collapsed-img-1{
		background: rgb(219, 5, 135);
	}
    .collapsed-img-3{
		background: rgb(0, 207, 84);
	}
    .collapsed-img-2{
		background: #f2e32b;
	}
	.set-icon li{
		list-style-type: none;
		padding: 15px 0px;
		border-bottom: 1px solid #fff;
	}
	.icon-cstm{
		margin-bottom:0px;
	}
	.cstm-list{
		background:#000;
		padding: 30px 30px;
	}
	.cstm-list li a{
		color:#fff !important;
	}
	.cstm-list li a:hover{
		text-decoration:none;
		color:#aba8a8 !important;
	}.cstm-ancor.set-icon a img {	max-width: 50px;	margin-bottom: 10px;}
</style>
<section class="inner-page-title" style="background: url(web/images/care_course_main.jpg) no-repeat scroll center center;">
    <div class="container">
        <h2>Care Courses</h2>
    </div>
</section>
	
<section class="inner-cotent care">
    <div class="container">
	<div class="row img_content_care" style=" margin-bottom: 50px; align-items: center;background: #f2f2f2;">
	<div class="col-md-6 text-center">
		<div class="inner-cotent">
		<p><strong>Care Providers, Childcare Providers, Hospices, NHS, Dr’s Surgeries,Hospitality and Retailers</strong></p>
		<strong style="color:#e8058e">Or any other related industries that require ½ or 1 day courses</strong>
		</div>
	</div>
	<div class="col-md-6">
	<img src="web/images/care_courses.jpg">
	
	</div>
	</div>
	<div class="row book_course_title">
		<div class="col-md-12">
			<h2 class="title">Book A Single Course</h2>
			<h6>Click a tab, browse courses, book a Tutor’! Done!</h6>
		</div>
	</div>
	
	
		@include('message.message')
        <div class="row">
        @php $i=1;@endphp
		@foreach($categories as  $categorieItem)
                @if(isset($categorieItem->children['0']))
                <div class="col-md-4">
			<div class="cstm-ancor set-icon" id="accordion-{{$i}}">
			<p class="icon-cstm" id="heading-{{$i}}">				
				<a href="#" class="collapsed collapsed-img-{{$i}}" data-toggle="collapse" data-target="#demo-{{$i}}" aria-expanded="false" aria-controls="demo-{{$i}}"><img src="web/images/care_icon-{{$i}}.png"/>{{$categorieItem->name}}</a>
			</p>
				<div id="demo-{{$i}}" aria-labelledby="heading-{{$i}}" data-parent="#accordion-{{$i}}" aria-expanded="true" class="collapse" style="">
					<ul class="cstm-list">
				
						@foreach($categorieItem->children as  $categorieChild)
						<li><a href="{{url('course_description/'.encrypt($categorieChild->id))}}">{{$categorieChild->name}}</a></li>
				<!--<li><a href="{{url('tutors?subcat[]='.$categorieChild->name.'&cat_id='.encrypt($categorieChild->id))}}">{{$categorieChild->name}}</a></li>-->
               
                 @endforeach
				 </ul>
			</div>
	</div>
    </div> 
    @php $i++;@endphp
                 @endif
				
			
        @endforeach
        </div>
	
	<div class="row img_content_care" style=" margin-bottom: 50px; align-items: center;background: #f2f2f2;">
	<div class="col-md-6">
	<img src="web/images/care_courses-2.jpg">
	
	</div>
	<div class="col-md-6 text-center">
		<div class="inner-cotent">
		<p><strong>We also provide Staff Training to a wide variety of industries.</strong></p>
		<p><strong>If you require your staff to undergo ½ or full day, mandatory/regularity staff training then simply follow the steps below.</strong></p>
		<strong style="color:#e8058e; display:block; font-size: 18px; padding: 0 24px;">Please Note:</strong>
		<strong style="color:#e8058e; display:block; font-size: 18px; padding: 0 24px;">- All course certificates will be industry approved and in-house accredited.</strong>
		<strong style="color:#e8058e; display:block; font-size: 18px; padding: 0 24px;">- If you require accredited training, then please send an enquiry as there will be additional charges.</strong>
		</div>
	</div>
	</div>
	
	
		<div class="row book_course_title multiple_course_section">
			<div class="col-md-12">
				<h2 class="title">Book Multiple Courses, to take place over 1 day</h2>
				<h6>Select your courses from the below list. If no results are found, then you may need to book then individually, as single day courses.</h6>
			</div>
		
			<form class="form-inline" method="get" action="tutors">
			<input type="hidden" name="cat_id" value="1">
			<div class="form-group " id="sp">

			<select class="form-control" name="specialist[]" id="specialist" multiple="">
				@foreach($categories as  $categorieItem)
					@if(isset($categorieItem->children['0']))
						<optgroup label="{{$categorieItem->name}}"
								  data-max-options="1">
							@foreach($categorieItem->children as  $categorieChild)
								<option value="{{$categorieChild->id}}" {{ !empty(\Input::get('specialist')) ? in_array($categorieChild->id , \Input::get('specialist'))   ? 'selected="selected"' : '' : ''}} >{{$categorieChild->name}}</option>
							@endforeach
							@endif
							@endforeach
						</optgroup>
				</select>
			</div>
			<button type="submit" class="btn btn-primary serach_btn" id='find'><i class="fas fa-search"></i>Search Tutor</button>
			</form>
		</div>
		
		
	
	</div>
</section>

<section class="tabing_sec">
	<div class="container">
		
	</div>
</section>


<section class="how_it_works">
<div class="container">
<div class="row">
<div class="col-md-12">
	<h2 class="title">How to Book a Course</h2>
</div>
</div>
<div class="row tabing_sec">
			<div class="col-md-12">
				 <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Single Day Course</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Multi Day Course</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>1</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Register with us and choose a Plan of your choice.</p>
								</div>
								</div>
							</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>2</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Once you have access go to ‘CQC Care Courses’  at the top of the page.</p>
							</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>3</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Select your course from the 6 tabs – You may be required to login</p>
								<!--<p>select the courses from dropdown list and hit 'Search Tutor' button'</p>-->
								</div>
							</div>
					</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>4</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Once you have made your selection, hit the ‘Find a Tutor’ button</p>
								</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>5</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Search and Select a Tutor, once selected hit ‘Book’</p>
								</div>
								</div>
							</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>6</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Choose a date and complete the form adding as much detail as possible and then hit ‘Next’</p>
							</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>7</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Review your payment.</p>
								</div>
							</div>
					</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>8</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Make your Payment & receive an email confirmation of your booking, then your done!</p>
								</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>1</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Register with us and choose a Plan of your choice.</p>
								</div>
								</div>
							</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>2</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Once you have access go to ‘CQC Care Courses’  at the top of the page.</p>
							</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>3</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Select the courses from multi select course dropdown list and hit 'Search Tutor' button – You may be required to login</p>
								</div>
							</div>
					</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>4</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Select a Tutor, once selected hit ‘Book’</p>
								</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>5</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Choose a date and complete the form adding as much detail as possible and then hit ‘Next’</p>
								</div>
								</div>
							</div>
					</div>
					<div class="row">
							<div class="col-md-6 pull-left" data-aos="fade-right">
							<div class="inner_con_how_work green_color">
								<span>6</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Review your payment.</p>
							</div>
							</div>
							</div>
							<div class="col-md-6"></div>
					</div>
					<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6 pull-right" data-aos="fade-left">
								<div class="inner_con_how_work">
								<span>7</span>
								<div class="desc_con">
								<h3>Step</h3>
								<p>Make your Payment & receive an email confirmation of your booking, then your done!</p>
								</div>
							</div>
					</div>
					</div>
                    </div>
                  </div>
			</div>
		</div>


</div>
</section>




@push('scripts')
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script>
		$('#specialist').multiselect({
            nonSelectedText: 'Select Courses',
            enableFiltering: true,
			multiselect:false,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '550px'
        });
		</script>
@endpush
@stop
