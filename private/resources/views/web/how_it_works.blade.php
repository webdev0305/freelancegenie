@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'How it Works')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
	.set-icon p a {
		width: 100%;
		padding: 20px;
		color: #fff;
		background-size: cover !important;
		min-height: 170px;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		text-decoration: none;
		display: inline-flex;
		font-size: 25px;
	}

	.collapsed-img-1 {
		background: rgb(219, 5, 135);
	}

	.collapsed-img-3 {
		background: rgb(0, 207, 84);
	}

	.collapsed-img-2 {
		background: #f2e32b;
	}

	.set-icon li {
		list-style-type: none;
		padding: 15px 0px;
		border-bottom: 1px solid #fff;
	}

	.icon-cstm {
		margin-bottom: 0px;
	}

	.cstm-list {
		background: #000;
		padding: 30px 30px;
	}

	.cstm-list li a {
		color: #fff !important;
	}

	.cstm-list li a:hover {
		text-decoration: none;
		color: #aba8a8 !important;
	}

	.cstm-ancor.set-icon a img {
		max-width: 50px;
		margin-bottom: 10px;
	}

	.how_it_works .video_block {
		margin-bottom: 40px;
	}

	.how_it_works .screenshot_block {
		align-items: center;
	}

	.how_it_works .video_block .title,
	.how_it_works .screenshot_block .title {
		font-size: 25px;
		text-align: left;
		padding-bottom: 5px;
		margin: 0;
		border: none;
		text-transform: capitalize;
		position: relative;
	}

	.how_it_works .video_block p,
	.how_it_works .screenshot_block p {
		font-size: 18px;
	}

	.screenshot_section {
		margin: 60px 0;
	}

	.screenshot_block {
		margin: 60px 0 0;
	}

	.screenshot_block:first-child {
		margin: 0;
	}
</style>
<section class="inner-page-title"
	style="background: url(web/images/care_course_main.jpg) no-repeat scroll center center;">
	<div class="container">
		<h2>How it Works</h2>
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
				<h2 class="title">Working Process</h2>
			</div>
		</div>
		<div class="row tabing_sec">
			<div class="col-md-12">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link " id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
							role="tab" aria-controls="nav-profile" aria-selected="true">For Tutor</a>
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
							role="tab" aria-controls="nav-home" aria-selected="false">For Employer</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<h2>Book a Tutor</h2>
						<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
							<div class="row screenshot_block">
								<div class="col-md-6">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_screenshot_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_screenshot_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_screenshot_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_screenshot_4.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_screenshot_5.png"
													alt="Third slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators1" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Fill the tutor search form</h2>
											<p>Select the suitable fields of form as per your need and click on find
												button.</p>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="1"
											class="active_cir">
											<h2 class="title">Select the tutor</h2>
											<p>A list of all tutors matching your search terms will be shown. You can
												select the tutor from the list based on rating and price.</p>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Click on Go to Booking</h2>
											<p>Review the complete profile of the user and click on Go to Booking
												button.</p>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="3"
											class="active_cir">
											<h2 class="title">Click on Book a Tutor</h2>
											<p>Fill the booking form and click on Book a Tutor button.</p>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="4"
											class="active_cir">
											<h2 class="title">View your dashboard</h2>
											<p>Booking is done. You can view your booking in your dashboard.</p>
											<div class="circle_text">5</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<h2>Register</h2>
						<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
							<div class="row screenshot_block">
								<div class="col-md-6">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/reg_screenshot_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/reg_screenshot_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/reg_screenshot_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/reg_screenshot_4.png"
													alt="Fouth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/reg_screenshot_5.png"
													alt="Fifth slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators2" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Click on Regsiter</h2>
											<p>Click on For Tutor button and select the Regsiter</p>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="1"
											class="active_cir">
											<h2 class="title">Select The Tutor</h2>
											<p>The page of membership will be shown. You can select the membership from the list based on rating and skill and click on Sign Up.</p>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Click on Register</h2>
											<p>Fill the register form. Preview the complete profile of the user and click on Regsiter button. </p>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="3"
											class="active_cir">
											<h2 class="title">Click on Login</h2>
											<p>Register is done. You can login now. Fill the Login form and click on Login button.</p>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="4"
											class="active_cir">
											<h2 class="title">View your Dashboard</h2>
											<p>You can see your dashboard table in your dashboard page.</p>
											<div class="circle_text">5</div>
										</div>
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

@stop