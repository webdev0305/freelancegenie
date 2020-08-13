@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Home')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
h2{
  text-align:center;
  padding: 20px;
}
/* Slider */

.slick-slide {
    margin: 0px 20px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
/* #tutor-area .row.no-gutters {
	margin-top: 0;
}
#tutor-area {
	background: none;
	text-align: left;
	font-weight: 400;
}
#home-banner #tutor-area p {
	font-size: 18px;
	color: #fff;
	font-weight: 400;
	margin-bottom: 1rem;
}
#home-banner .form-wrap .form_bnr_bg{
	background: rgba(0, 0, 0, 0.5);
	padding: 30px;
	margin-bottom:25px;
}
#home-banner .form-wrap{
	background:none;
	padding: 0;
} */

</style>
<section id="home-banner" class="text-center">
   <div class="container">
        <div class="form-wrap">
			<div class="form_bnr_bg">
			@include('../message.message')
			<h1>Find A Tutor <i class="fas fa-angle-down"></i></h1>
			@include('includes.search_form')
            <p>Freelance Tutors & Trainers Online</p>
			</div>
        </div>
		</div>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!--<ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
        </ol>-->
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('web/images/slider0.jpg')">
            <div class="carousel-caption d-none d-md-block">
			
            </div>
          </div>
          <!--div class="carousel-item" style="background-image: url('web/images/slider7.jpg')">
            
          </div-->
		  <!--div class="carousel-item" style="background-image: url('web/images/slider2.jpg')">
            
          </div-->
		  <!--<div class="carousel-item" style="background-image: url('web/images/slider3.jpg')">
           
          </div>
		  <div class="carousel-item" style="background-image: url('web/images/slider4.jpg')">
           
          </div>
		  <div class="carousel-item" style="background-image: url('web/images/slider5.jpg')">
           
          </div>
		  <div class="carousel-item" style="background-image: url('web/images/slider6.jpg')">
           
          </div>
          <div class="carousel-item" style="background-image: url('web/images/slider7.jpg')">
            
          </div>-->
          
         
        </div>
        <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<div class="sl-arrow">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  </div>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<div class="sl-arrow">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
		</div>
          <span class="sr-only">Next</span>
        </a>-->
      </div>

</section>
	 
	<section id="tutor-area">
  <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 tutors data-aos=" fade-right"">
				<div class="tooltip_custom">
                <div class="row heading">
                    <div class="col-sm-8 col-8">
                        <h3>For Tutors</h3>
                    </div>
                    <div class="col-sm-4 col-4">
                        <img src="web/images/icon-4.png" class="img-fluid">
                    </div>
                </div>
                <div class="text-wrap">
					
					<p><i class="fas fa-angle-right"></i> Sign up and create a ‘free’ profile </p>                                                     
					<p><i class="fas fa-angle-right"></i> Search and accept suitable assignments </p>                                       
					<p><i class="fas fa-angle-right"></i> Create a perfect work-life-balance</p>
					<p><i class="fas fa-angle-right"></i> Remain in complete control </p>
                    <a class="round-button" href="{{url('tutor_type')}}"><span>Sign Up</span><i
                                class="fas fa-angle-double-right"></i></a>
                </div>
				<div class="tooltiptext">Are you tutor? Sign up for free here.</div>
				</div>
            </div>
            <div class="col-md-6 employees data-aos="fade-left"">
				<div class="tooltip_custom">
                <div class="row heading">
                    <div class="col-sm-8 col-8">
                        <h3>For Employers</h3>
                    </div>
                    <div class="col-sm-4 col-4">
                        <img src="web/images/icon-3.png" class="img-fluid">
                    </div>
                </div>
                <div class="text-wrap">
                    <p><i class="fas fa-angle-right"></i> Choose the appropriate plan and gain access to the Best FL talent </p>                                                     
					<p><i class="fas fa-angle-right"></i> Choose to Post, Browse or Book </p>                                       
					<p><i class="fas fa-angle-right"></i> Quality, Affordability & Efficiency all in one place</p>
					<p><i class="fas fa-angle-right"></i> Guaranteed Savings’ on ‘Time and Money </p>
                    <a class="round-button" href="{{url('pricing')}}"><span>Sign Up</span><i class="fas fa-angle-double-right"></i></a>
                </div>
				<div class="tooltiptext">Do you need access to freelance tutors & Trainers. <br>Join Here</div>
                </div>
            </div>
        </div>
        </div>
   
</section>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-5" data-aos="fade-right">
                <div class="text-wrap">
                    <strong>About Us</strong>
                    <!--h2>{{$about->title}}</h2-->
                    <h2>Freelance Genie <br><span>Tutors and Trainers Online<span></h2>
                    <!--<p> <?php  print_r( \Illuminate\Support\Str::words($about->shot, 80,'....') ); ?></p>-->
                    <p>{{$about->shot}}</p>
                    <a class="semi-round" href="{{url('about')}}"><span>Learn More</span><i
                                class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
            <div class="col-md-7" data-aos="fade-left">	
			<div class="img-wrap big">
			<img src="web/images/about_image_.jpg" class="img-fluid">
			</div>
                
            </div>
        </div>
    </div>
</section>
<section class="how_it_work_both">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="inner_box">
				<div class="left_img"><img src="web/images/icon-4.png"></div>
				<div class="content"><h2>How It Works For Tutors</h2>
				<p>The Freelance Genie platform is one of the most exciting opportunities for freelance trainers. As a freelance tutor or Subcontractor, you can easily sign up through our free online registration where you will have access to a simple online facility used to find assignments and manage each of your bookings.</p><p> Across the platform, you will have access to a wide variety of live assignments and can maximise your earning potential by accepting and rejecting freelance tutor jobs online. The entire service is completely flexible, helping you to maintain a healthy work-life balance and manage your own workflow - with all mileage and expenses covered. Through our simple onboarding process, you can start your job search immediately and have the ability to subsidise your income, maximising your time through providing course tuition, working as and when you want.  </p>
				<a href="{{url('how_it_works')}}">Read More</a></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="inner_box employer_work">
				<div class="left_img"><img src="web/images/icon-3.png"></div>
				<div class="content"><h2>How It Works For Employers</h2>
				<p>With our 24/7 access online platform, you can easily find Independent freelance tutors, trainers and subcontractors online who have each been fully vetted and verified - giving you complete peace of mind with regular DBS updates.</p><p> We offer simple subscription options which allow you to post live assignments that can be auto accepted by trainers, with accurate and transparent pricing structures for all bookings. Detailed in our terms, our dedicated team pay and manage all tutor costs, covering any absences and sickness - guaranteeing the arrival of your tutor, keeping to your agreed schedule and avoiding changes. Our entire service is quick and easy, as well as fully compliant. You will no longer have to worry about interviewing individual candidates and cancelling courses, as everything will be managed by us. </p>
				<a href="{{url('how_it_works')}}">Read More</a></div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="customer-logos slider">
    @foreach($logos as $key=>$logo)
    <div class="slide"><img src="images/company_logo/{{$logo->image}}"></div>
    @endforeach
</section>
<div class="modal maiilModal" id="form_validation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				
                <div class="modal-body">
                    <div id="" class="text-wrap">
					<p id="validation"></p>
                       
                    </div>
					
                </div>
				
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@include('includes.middle_section')
@push('scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
	<script>
  AOS.init();
  $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>

@endpush
@stop

