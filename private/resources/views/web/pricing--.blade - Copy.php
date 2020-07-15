@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Pricing Plans')
<section class="inner-page-title">
	<div class="container">
		<h2>Pricing Plans</h2>
	</div>
</section>
<section class="pricing-page">
	<div class="container">
		<div class="section-heading text-center anim d06 t24 fadeIn">
			<h1>Mini Plan</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam a libero non porttitor. Maecenas sit amet libero id est dignissim ornare. Integer sagittis, elit ut rhoncus lacinia, enim diam semper dolor</p>
		</div>
		<div class="row listing-wrap">
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">Post a basic advert/assignment </p>
						<h2 class="package-type">first timer!</h2>
						<div class="package-icon"><i class="fa fa-database"></i></div>
						<div class="pricing-ribbon">
							<h5>featured</h5>
						</div>
					</div>
					<div class="price-wrap">
						<h1 class="price ">£59<span class="deci">.00</span></h1>
						<h5 class="per">28 days Access</h5>
					</div>
					<ul class="table-list">
						<li>Post a standard, Ad/Assignment to be circulated among our Tutor network and wait for someone to accept.<br>
                        Note: No tutor guaranteed to accept.</li>
						
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('1')}}">Pay</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">Starting At</p>
						<h2 class="package-type">INTERMEDIATE</h2>
						<div class="package-icon"><i class="fa fa-server"></i></div>
						
					</div>
					<div class="price-wrap">
						<h1 class="price "><span class="currency">$</span>£499<span class="deci">.00</span></h1>
						<h5 class="per">6 Month Access</h5>
					</div>
					<ul class="table-list">
						<li>Ads Post 30 Managed assignments</li>
						<li>Full Search Access</li>
						<li>Book Directly Online</li>
						<li>All on boarding Covered</li>
						<li>Fully Verified and Vetted</li>
						<li>View Credentials</li>
						<li>Fully Managed</li>
						<li>Guaranteed Tutor arrival</li>
						<li>Receive DBS Updates</li>
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('2')}}">Order Now!</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">PRO</p>
						<h2 class="package-type">Frequent user</h2>
						<div class="package-icon"><i class="fa fa-cubes"></i></div>
						<div class="pricing-ribbon">
							<h5>POPULAR</h5>
						</div>
					</div>
					<div class="price-wrap">
						<h1 class="price "><span class="currency">$</span>£999<span class="deci">.00</span></h1>
						<h5 class="per">12 Month Access</h5>
					</div>
					<ul class="table-list">
						<li>Unlimited</li>
						<li>Full Search Access</li>
						<li>Book Directly O/L</li>
						<li>All on boarding Covered</li>
						<li>Fully Verified and Vetted</li>
						<li>View Credentials</li>
						<li>Fully Managed</li>
						<li>Guaranteed Tutor arrival</li>
						<li>Receive DBS Updates</li>
						<li>Receive Analytics</li>
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('3')}}">Order Now!</a>
				</div>
			</div>
			
		</div>
	<div class="section-heading text-center anim d06 t24 fadeIn">
			<h1>Lorem ipsum dolor</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam a libero non porttitor. Maecenas sit amet libero id est dignissim ornare. Integer sagittis, elit ut rhoncus lacinia, enim diam semper dolor</p>
		</div>
		<div class="row listing-wrap">
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">BASIC</p>
						<h2 class="package-type">first timer!</h2>
						<div class="package-icon"><i class="fa fa-database"></i></div>
						<div class="pricing-ribbon">
							<h5>featured</h5>
						</div>
					</div>
					<div class="price-wrap">
						<h1 class="price "><span class="currency">$</span>£99<span class="deci">.00</span></h1>
						<h5 class="per">30 day Access</h5>
					</div>
					<ul class="table-list">
						<li>Ads Post x2 Managed Ads</li>
						<li>Search facility (Ltd Access)</li>
						<li>Book x1 Tutor Directly Online</li>
						<li>All on boarding Covered</li>
						<li>Fully Verified and Vetted</li>
						<li>View Credentials</li>
						<li>Fully Managed</li>
						<li>Guaranteed Tutor arrival</li>
						<li>Receive DBS Updates</li>
						<li>Receive Analytics</li>
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('1')}}">Order Now!</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">Starting At</p>
						<h2 class="package-type">INTERMEDIATE</h2>
						<div class="package-icon"><i class="fa fa-server"></i></div>
						
					</div>
					<div class="price-wrap">
						<h1 class="price "><span class="currency">$</span>£499<span class="deci">.00</span></h1>
						<h5 class="per">6 Month Access</h5>
					</div>
					<ul class="table-list">
						<li>Ads Post 30 Managed assignments</li>
						<li>Full Search Access</li>
						<li>Book Directly Online</li>
						<li>All on boarding Covered</li>
						<li>Fully Verified and Vetted</li>
						<li>View Credentials</li>
						<li>Fully Managed</li>
						<li>Guaranteed Tutor arrival</li>
						<li>Receive DBS Updates</li>
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('2')}}">Order Now!</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="pricing-wrap">
					<div class="pricing-head">
						<p class="">PRO</p>
						<h2 class="package-type">Frequent user</h2>
						<div class="package-icon"><i class="fa fa-cubes"></i></div>
						<div class="pricing-ribbon">
							<h5>POPULAR</h5>
						</div>
					</div>
					<div class="price-wrap">
						<h1 class="price "><span class="currency">$</span>£999<span class="deci">.00</span></h1>
						<h5 class="per">12 Month Access</h5>
					</div>
					<ul class="table-list">
						<li>Unlimited</li>
						<li>Full Search Access</li>
						<li>Book Directly O/L</li>
						<li>All on boarding Covered</li>
						<li>Fully Verified and Vetted</li>
						<li>View Credentials</li>
						<li>Fully Managed</li>
						<li>Guaranteed Tutor arrival</li>
						<li>Receive DBS Updates</li>
						<li>Receive Analytics</li>
					</ul>
					<a class="btn" href="{{url('register/employer/').'/'.encrypt('3')}}">Order Now!</a>
				</div>
			</div>
			
		</div>
	
    </div>
</section>@include('includes.middle_section')

@push('scripts')

	<script>

                         bootoast.toast({
                            message: "Go to login if you already registered",
                             icon: 'exclamation-sign',// Glyphicons name
                             timeout: 2000,
                             animationDuration: 300,
                             position: 'top-center',
                         });

	</script>


@endpush
@stop