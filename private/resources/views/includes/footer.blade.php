<footer id="main-footer">
		
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<img src="{{asset('web/images/logo2.png')}}" class="img-fluid">
					</div>
					<div class="col-sm-4">
						<div class="footer-text">
							<h3>Registered Office Address</h3>
							<ul class="address">
								<li class="home">
									<span>Union House, 111 New Union Street, Coventry, West Midlands, United Kingdom, CV1 2NT</span>
								</li>
								@foreach($settings_info as $info)
									@if($info->name =="admin_info_email")
									<li class="mail"><a href="mailto:{{$info->value}}">{{$info->value}}</a></li>
									@endif
									@if($info->name =="contact")
									<li class="tel"><a href="tel:{{$info->value}}">{{$info->value}}</a></li>
									@endif
									@endforeach
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="footer-text">
							<h3>Newsletter</h3>
							<p>Subscribe to our Newsletter </p>
							<form class="form-inline" >
								<input type="text" class="form-control mb-2 mr-sm-2" id="email" placeholder="Email Address">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="button" id="invite_user_btn" class="btn btn-primary mb-2"><i style="display: none;" class="fa fa-spinner fa-spin"></i>Subscribe</button>
							</form>
						</div>
					</div>
					<ul class="left_social_icon">
						<li><a href="https://www.facebook.com/flgenie/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://twitter.com/fl_genie" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="https://www.linkedin.com/in/freelance-genie-280911159/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
					</ul>
				</div>
				
				
			</div>
	</footer>
	<div class="copyright"><!--&copy; 2019 Freelance Genie. All Rights Reserved. Company Reg Number: 11982554-->
		<div class="container">
				
					<span class="copyright-text">&copy; Copyright 2019 - Freelance Genie - Company Reg Number: 11982554</span>
				
					<div class="ftr-menu-sec">
						<ul class="footer-menu">
							<li class=""><a href="{{url('terms')}}">Terms of Service</a></li>
							<li class=""><a href="{{url('policy')}}">Privacy Policy</a></li>
						</ul>
					</div>
			
        </div>
	</div>
	
	
	<div class="call_action_btn">
		<a class="tooltip_custom_top" href="/tutor_design/public/care_courses">Book A Course<div class="tooltiptext_top">Suitable For All Staff And All Industries</div></a>
	</div>
	<div id="browser_msg" style="display:none;" class="cstm-fixe-footer">
		<h3>Sorry, the browser you are using may not be supported</h3>
		<p>To have the best experience of our site,We recommend the latest version of Chrome, Firefox, Safari or Edge browsers.</p>
	</div>
	

<a href="javascript:" id="back_to_top_btn"><i class="fas fa-angle-up"></i></a>