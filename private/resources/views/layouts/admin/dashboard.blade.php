@extends('layouts.admin.plane')

@section('body')
<div id="wrapper">
	<div class="main-head">
		<div class="logo-wrap">
			<img src="{{asset('web/images/logo2.png')}}" alt="Logo" class="img-responsive">
		</div>
	</div>

	

	<div class="navbar-default sidebar hidden-xs" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/tutor') }}">
								<i class="fas fa-chalkboard-teacher fa-fw"></i>&nbsp;&nbsp;Tutors
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/invoice') }}">
								<i class="fas fa-file-invoice fa-fw"></i> &nbsp;&nbsp;Invoice
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/employer') }}">
								<i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Employers
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading3">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/language') }}">
								<i class="fas fa-language fa-fw"></i>&nbsp;&nbsp;Languages
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading4">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/certificate') }}">
								<i class="fas fa-award fa-fw"></i>&nbsp;&nbsp;Certificates
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading5">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/qualification') }}">
								<i class="fa fa-user-graduate fa-fw"></i>&nbsp;&nbsp;Qualifications
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading61">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/countries') }}">
								<i class="fa fa-globe fa-fw"></i>&nbsp;&nbsp;Countries
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading6">
						<h4 class="panel-title">
							<a role="button" href="{{ url ('admin/job') }}">
								<i class="fa fa-briefcase fa-fw"></i>&nbsp;&nbsp;Jobs
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading8">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu"
								href="#collapse8" aria-expanded="false" aria-controls="collapse8">
								<i class="fas fa-copy fa-fw"></i>&nbsp;&nbsp;Pages
								<span class="fas fa-angle-down"></span>
							</a>
						</h4>
					</div>
					<div id="collapse8" class="panel-collapse collapse {{ (Request::is('*admin/about/faq') ? 'in' : '') }}" role="tabpanel" aria-labelledby="heading8">
						<div class="panel-body">
							<ul class="nav">
								<li>
									<a href="{{ url ('admin/about') }}">About </a>
								</li>
								<li>
									<a href="{{ url ('admin/faq') }}">Faq </a>
								</li>
								<li>
									<a href="{{ url ('admin/privacy') }}">Privacy Policy </a>
								</li>
								<li>
									<a href="{{ url ('admin/terms') }}">Terms of Service </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading9">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu"
								href="#collapse9" aria-expanded="false" aria-controls="collapse9">
								<i class="fas fa-file-signature fa-fw"></i>&nbsp;&nbsp;Plan
								<span class="fas fa-angle-down"></span>
							</a>
						</h4>
					</div>
					<div id="collapse9" class="panel-collapse collapse {{ (Request::is('*admin/about/faq') ? 'in' : '') }}" role="tabpanel" aria-labelledby="heading9">
						<div class="panel-body">
							<ul class="nav">
								<li>
									<a href="{{ url ('admin/tutor_plan') }}">Employer Plan </a>
								</li>
								<li>
									<a href="{{ url ('admin/employer_plan') }}">Tutor Plan </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading91">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu"
								href="#collapse91" aria-expanded="false" aria-controls="collapse91">
								<i class="fas fa-pen-nib"></i>&nbsp;&nbsp;Contracts
								<span class="fas fa-angle-down"></span>
							</a>
						</h4>
					</div>
					<div id="collapse91" class="panel-collapse collapse {{ (Request::is('*admin/about/faq') ? 'in' : '') }}" role="tabpanel" aria-labelledby="heading91">
						<div class="panel-body">
							<ul class="nav">
								<li>
									<a href="{{ url ('admin/serviece_agree') }}">Service Agreement</a>
								</li>
								<li>
									<a href="{{ url ('admin/freelancer_agree') }}">Freelancer Agreement</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="collapsed" href="{{ url ('admin/settings') }}">
								<i class="fa fa-cog fa-fw"></i>&nbsp;&nbsp;Settings
							</a>
						</h4>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading7">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu"
								href="#collapse7" aria-expanded="false" aria-controls="collapse7">
								<i class="fa fa-user-plus fa-fw"></i>&nbsp;&nbsp;Additional
								<span class="fas fa-angle-down"></span>
							</a>
						</h4>
					</div>
					<div id="collapse7"
						class="panel-collapse collapse {{ (Request::is('*admin/about/faq') ? 'in' : '') }}"
						role="tabpanel" aria-labelledby="heading7">
						<div class="panel-body">
							<ul class="nav">
								<li>
									<a href="{{ url ('admin/upload') }}">Upload Docs</a>
								</li>
								<li>
									<a href="{{ url ('admin/emailtemplate') }}">Email Template</a>
								</li>
								<li>
									<a href="{{ url ('admin/add_logo') }}">Add Logos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.sidebar-collapse -->
	</div>

	<div id="page-wrapper">
		<div class="page-heading-wrap">
			<div class="row">
				<div class="col-md-8">
					<h2 class="dashboard-header">@yield('page_heading')</h2>
				</div>
				<div class="col-md-4 text-right">
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-user fa-fw"></i><span>{{\Sentinel::getUser()->first_name}}
								{{\Sentinel::getUser()->last_name}}</span><i class="fa fa-caret-down fa-fw"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="{{ url('admin/change_password') }}"><i class="fa fa-gear fa-fw"></i>
									Settings</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="content-part ">
			@yield('section')

		</div>
		<!-- /#page-wrapper -->
	</div>
</div>
@stop