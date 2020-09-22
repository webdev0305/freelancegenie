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
	.active_cir h2 {
		font-size: 15px !important;
	}
	.active_cir h2 p {
		font-size: 15px !important;
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
							role="tab" aria-controls="nav-profile" aria-selected="true">For Tutors</a>
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
							role="tab" aria-controls="nav-home" aria-selected="false">For Employers</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<h2>HOW TO GET STARTED AS AN EMPLOYER/CLIENT?</h2>
						<div style="text-align: center;padding-bottom: 30px;">
							<h3>HOW TO REGISTER</h3>
						</div>
						<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_reg_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_reg_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_reg_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_reg_4.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_reg_5.png"
													alt="Third slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators1" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Click ‘EMPLOYERS’ icon at the top of the screen</h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="1"
											class="active_cir">
											<h2 class="title">Select ‘register’</h2><br>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Choose a plan and click ‘subscribe’</h2><br>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="3"
											class="active_cir">
											<h2 class="title">Follow all steps and complete the form and all fields. </h2>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators1" data-slide-to="4"
											class="active_cir">
											<h2 class="title">Click ‘submit’ and that’s it, your done!</h2>
											<div class="circle_text">5</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div style="text-align: center;padding-bottom: 30px;">
							<h3>HOW TO LOG IN</h3>
						</div>
						<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carouse2">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_log_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_log_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_log_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_log_4.png"
													alt="Fourth slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators2" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Click ‘EMPLOYERS’ icon at the top of the screen </h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="1"
											class="active_cir">
											<h2 class="title">Select ‘log in’</h2><br>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Enter your details and create a username and password</h2><br>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators2" data-slide-to="3"
											class="active_cir">
											<h2 class="title">If your payment was successful, you will now be required to log in</h2>
											<div class="circle_text">4</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<h2 style="padding-top:80px">HOW TO BOOKING A FREELANCER?</h2>
						<div style="text-align: center;padding-bottom: 30px;">
							<h3>Booking a ‘care or staff training course’</h3>
						</div>
						<div id="carouselExampleIndicators3" class="carousel slide" data-ride="carouse3">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_cqc_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_cqc_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_cqc_3.png"
													alt="Third slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators3" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">There are 3 ways an Employer/Client can book a Freelancer. The first is by booking and purchasing a ‘course’ from the course areas here? And follow the steps within,</h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators3" data-slide-to="1"
											class="active_cir">
											<h2 class="title">After you have followed the steps, you will see your booking form. Fill in the form providing as much detail as possible. – Then hit ‘Next’</h2>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators3" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Review your payment, Make Payment and that’s it, ‘Your done’!</h2>
											<div class="circle_text">3</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div style="text-align: center;padding-bottom: 30px;">
							<h3>Home page Search Bar</h3>
						</div>
						<div id="carouselExampleIndicators4" class="carousel slide" data-ride="carouse4">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_src_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_src_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_src_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_src_4.png"
													alt="Fourth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_src_5.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_src_6.png"
													alt="Fourth slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators4" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Using the search area allows you to select your criteria, see results and book a Tutor/Freelancer in a few simple steps,… <br>Once you have selected your criteria, hit ‘find’ and you will now see a list of results related only to your selection. – Click the Candidate number here, for full view. </h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators4" data-slide-to="1"
											class="active_cir">
											<h2 class="title">You can now browse through the profiles and see a synopsis of each freelancer’s credentials including rating and verification status. - See Profile page for further details.</h2>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators4" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Once you have made your selection, click ‘book’ </h2><br>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators4" data-slide-to="3"
											class="active_cir">
											<h2 class="title">You will now see a booking form. Complete the booking form providing as much detail as possible. You can choose to add mileage, hotel stay if required, or offer a flat inclusive rate. Please see Terms of Service agreement for full details. </h2>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators4" data-slide-to="4"
											class="active_cir">
											<h2 class="title">You will also see your ‘Terms of Service agreement’ here which you will be required to read and sign before proceeding. </h2>
											<div class="circle_text">5</div>
										</div>
										<div data-target="#carouselExampleIndicators4" data-slide-to="5"
											class="active_cir">
											<h2 class="title">When you are done and ready to proceed, choose a payment option, and that’s it your done!<br><p style="color:#e8058e;">Note: Please ensure that you choose the appropriate qualifications and levels if you are booking within Scotland.</p> </h2>
											<div class="circle_text">6</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div style="text-align: center;padding-bottom: 30px;">
							<h3>Live assignment postings</h3>
						</div>
						<div id="carouselExampleIndicators5" class="carousel slide" data-ride="carouse2">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/emp_liv_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_4.png"
													alt="Fourth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_5.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_6.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/emp_liv_7.png"
													alt="Fourth slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators5" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Employers/Clients can post ‘Live assignments’ these are essentially live bookings that are posted in ‘real time’. – ‘Live assignment’ postings are also included within your membership plan so be sure to use them before your plan ends. </h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="1"
											class="active_cir">
											<h2 class="title">click on top right member icon, here, and it will display a dropdown menu.  </h2>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Select ‘Live assignment’ where you will now see ‘live’ assignment posts, </h2>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="3"
											class="active_cir">
											<h2 class="title">Now select ‘post a job’ and you will now see the booking form. Complete the booking form in as much detail as possible and including all your requirements<br><p style="color:#e8058e">Note: Post cannot be edited. If the user makes a mistake here then they will need to cancel the post entirely and re-post another at the employer’s cost. </p> </h2>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="4"
											class="active_cir">
											<h2 class="title">Once posted, your advert will be seen only by Freelancers who match the skills/specialism that you have selected.</h2>
											<div class="circle_text">5</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="5"
											class="active_cir">
											<h2 class="title">These Freelancers will now have the option to accept or decline. If someone accepts, the booking will appear in both of your dashboard. And that’s it, your done!</h2>
											<div class="circle_text">6</div>
										</div>
										<div data-target="#carouselExampleIndicators5" data-slide-to="6"
											class="active_cir">
											<h2 class="title">If they decline, the ‘assignment’ will automatically repost until a suitable and available Freelancer accepts.<br><p style="color:#e8058e;">Note: If your post is a ‘managed ad’ then we will actively provide you with a match.  If unmanaged, then there is no guarantee of acceptance. </p>  </h2>
											<div class="circle_text">7</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<h2>HOW TO REGISTER</h2>
						<div id="carouselExampleIndicators6" class="carousel slide" data-ride="carouse6">
							<div class="row screenshot_block">
								<div class="col-md-8">
									<div class="bg-slider-img">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="web/images/tut_reg_1.png"
													alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/tut_reg_2.png"
													alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/tut_reg_3.png"
													alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/tut_reg_4.png"
													alt="Fouth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/tut_reg_5.png"
													alt="Fifth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="web/images/tut_reg_6.png"
													alt="Fifth slide">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="carousel-indicators how-it-indicator">
										<div data-target="#carouselExampleIndicators6" data-slide-to="0"
											class="active_cir active">
											<h2 class="title">Click ‘Freelancer’ icon at the top of the screen </h2>
											<div class="circle_text">1</div>
										</div>
										<div data-target="#carouselExampleIndicators6" data-slide-to="1"
											class="active_cir">
											<h2 class="title">Select ‘register’</h2><br>
											<div class="circle_text">2</div>
										</div>
										<div data-target="#carouselExampleIndicators6" data-slide-to="2"
											class="active_cir">
											<h2 class="title">Choose an option and click ‘subscribe’</h2>
											<div class="circle_text">3</div>
										</div>
										<div data-target="#carouselExampleIndicators6" data-slide-to="3"
											class="active_cir">
											<h2 class="title">Follow all steps and complete the form and all fields.</h2>
											<div class="circle_text">4</div>
										</div>
										<div data-target="#carouselExampleIndicators6" data-slide-to="4"
											class="active_cir">
											<h2 class="title">Click ‘submit’ </h2><br>
											<div class="circle_text">5</div>
										</div>
										<div data-target="#carouselExampleIndicators6" data-slide-to="5"
											class="active_cir">
											<h2 class="title">You will now receive an email from your nominated 3rd party payment provider, follow all steps, and that’s it, your done! </h2>
											<div class="circle_text">6</div>
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