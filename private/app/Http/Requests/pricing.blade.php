@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Pricing Plans')
<section class="inner-page-title" style="background: url(web/images/employer_signup.jpg) no-repeat scroll center center;color:#e66d00;">
	<div class="container">
		<h2>Pricing Plans</h2>
	</div>
</section>

<section class="new-plan">
    <div class="container">
        <div class="pricing-list">
            <div class="center">
				<div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>59
							<h6>28 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Mini Plan1</h3>
							<strong>Post a Standard Advert Assignment</strong>
						</div>
                        <ul class="text-wrap">
                            <li class="tick">Post a Standard Advert Assignment to be circulated among our Tutor network and wait for someone to accept.<br>
                        Note: No tutor guaranteed to accept.</li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('1')}}">Subscribe up</a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('1')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
				<div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>89
							<h6>28 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Mini Plan2</h3>
							<strong>Have your own space and stand out from the crowd</strong>
						</div>
                        <ul class="text-wrap">
                            <li class="tick">Post a Premium Advert and choose to insert a Company Logo
                        </li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('2')}}">Subscribe </a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('2')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
				<div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>99
							<h6>14 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Starter</h3>
							<strong>Perfect for first time user - 1 Tutor/Trainer</strong>
						</div>
						
                        <ul class="text-wrap">
                            <li class="tick">Post 1 Standard Unmanaged Ad Assignment</li>
						<li class="tick">Book 1 Tutor Directly Online</li>
						<li class="tick">All on boarding Covered</li>
						<li class="tick">Fully Verified and Vetted</li>
						<li class="tick">View Credentials</li>
						
						<li class="tick">Guaranteed Tutor arrival</li>
						<li class="tick">Full Access' activation may vary Subject to your Status'.</li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('3')}}">Subscribe</a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('3')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
				<div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>199<h6>30 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Voyager	</h3>
							<strong>Perfect For casual users - 5 Tutors/Trainers</strong>
						</div>
                        <ul class="text-wrap">
                            <li class="tick">Post 5 Managed Ad Assignments 1 Premium</li>
						<li class="tick">Book 5 Tutors Directly Online</li>
						<li class="tick">All on boarding Covered</li>
						<li class="tick">Fully Verified and Vetted</li>
						<li class="tick">View Credentials</li>
						
						<li class="tick">Guaranteed Tutor arrival</li>
                        <li class="tick">Fully Managed</li>
                        <li class="tick">Receive DBS Updates</li>
						<li class="tick">Full Access' activation may vary Subject to your Status'.</li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('4')}}">Subscribe</a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('4')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
                <div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>299<h6>30 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Pioneer	</h3>
							<strong>Perfect for Frequent users - 10 Tutors/Trainers</strong>
						</div>
                        <ul class="text-wrap">
                            <li class="tick">Post 10 Managed Ad Assignments 5 Premium</li>
						<li class="tick">Book 10 Tutors Directly Online</li>
						<li class="tick">All on boarding Covered</li>
						<li class="tick">Fully Verified and Vetted</li>
						<li class="tick">View Credentials</li>
						
						<li class="tick">Guaranteed Tutor arrival</li>
                        <li class="tick">Fully Managed</li>
                        <li class="tick">Receive DBS Updates</li>
                        
						<li class="tick">Full Access' activation may vary Subject to your Status'.</li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('5')}}">Subscribe</a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('5')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
                <div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>399<h6>30 days Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>Enterprise</h3>
							<strong>Perfect for Large Org’s - 20 Tutors/Trainers</strong>
						</div>
                        <ul class="text-wrap">
                            <li class="tick">Post Unlimited Managed Ad Assignments All Premium</li>
						<li class="tick">Book 20 Tutors Directly Online</li>
						<li class="tick">All on boarding Covered</li>
						<li class="tick">Fully Verified and Vetted</li>
						<li class="tick">View Credentials</li>
						
						<li class="tick">Guaranteed Tutor arrival</li>
                        <li class="tick">Fully Managed</li>
                        <li class="tick">Receive DBS Updates</li>
                        
						<li class="tick">Full Access' activation may vary Subject to your Status'.</li>
                        </ul>
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                <a class="btn" href="{{url('subscription').'/'.encrypt('6')}}">Subscribe</a>
                @else
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('6')}}">Subscribe</a>
                @endif
                        </div>
                    </div>
                </div>
			<div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="cost-wrap">
                         <!-- <span>£</span>799/m - <span>£</span>999/m-->
                          <h6>1 Years Full Access</h6>
                        </div>
						<div class="title-wrap">
							<h3>ULTIMATE</h3>
							<strong>ULTIMATE FREELANCE SUB-CONTRACTOR SUPPORT</strong>
						</div>
                        <ul class="text-wrap">
                        <li class="tick">Full Access</li>
						<li class="tick">Unlimited Direct Bookings</li>
						<li class="tick">Unlimited Premium ‘Live Assignments’</li>
						<li class="tick">DBS Updates</li>
						<li class="tick">Ultimate Compliance</li>
                        </ul>
                        <div class="button-wrap">
                            
                <a class="btn" href="">Enquire Now</a>
                
                        </div>
                    </div>
                </div>
               
			</div>
        </div>
    </div>
</section>




@include('includes.middle_section')


@push('scripts')

	<script>
@if (empty(\Sentinel::check()))
                         bootoast.toast({
                            message: "Go to login if you already registered",
                             icon: 'exclamation-sign',// Glyphicons name
                             timeout: 5,
                             animationDuration: 300,
                             position: 'top-center',
                         });
     
@endif
	</script>


@endpush
@stop