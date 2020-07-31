@extends('layouts.plane')
@section('body')
<!-- @if (empty(\Sentinel::check()) && !(Request::has('live')))
<div id="overlay">

</div>
@endif -->
<style>
    #overlay {
        position: fixed;
        /* Sit on top of the page content */
        width: 100%;
        /* Full width (cover the whole page) */
        height: 100%;
        /* Full height (cover the whole page) */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('web/images/site_underconstruction.png');
        /* Black background with opacity */
        z-index: 9999999;
        /* Specify a stack order in case you're using a different order for other elements */
        cursor: pointer;
        /* Add a pointer on hover */
        background-position: center;
    }

    #text {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }
</style>
@include('includes.top_head')
<header class="main-head clearHeader" data-scroll="100" id="cstm-myHeader">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{url('/')}}"><img class="d-block w-100"
                    src="{{asset('web/images/logo.png')}}" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav justify-content-end w-100">
                    <li class="nav-item {{ (Request::is('*dashboard') ? 'active' : '') }}"><a class="nav-link"
                            href="{{url('/')}}">Home</a></li>
                    <li class="nav-item {{ (Request::is('*about') ? 'active' : '') }}"><a class="nav-link"
                            href="{{url('about')}}">About Us</a></li>

                    <li class="nav-item {{ (Request::is('courses') ? 'active' : '') }}"><a class="nav-link"
                            href="{{url('courses')}}">Courses</a></li>
                    <li class="nav-item {{ (Request::is('care_courses') ? 'active' : '') }}"><a
                            class="nav-link tooltip_custom" href="{{url('care_courses')}}">CQC Care Courses<i
                                class="fas fa-heart heart-icon"></i>
                            <div class="tooltiptext">Suitable For All Staff And All Industries</div>
                        </a></li>
                    <li class="nav-item {{ (Request::is('*faq') ? 'active' : '') }}"><a class="nav-link"
                            href="{{url('faq')}}">Faq</a></li>
                    <li class="nav-item {{ (Request::is('*contact-us') ? 'active' : '') }}"><a class="nav-link"
                            href="{{url('contact-us')}}">Contact Us</a></li>
                </ul>
            </div>
            <div class="right-section d-none d-lg-block">
                <ul class="">

                    @if (!empty(\Sentinel::check()))
                    @if ($user = Sentinel::getUser())
                    <li class="{{($user->inRole('tutor'))?'tutor':'employer'}} dropdown">
                        <a class="" href="#" id="navbardrop"
                            data-toggle="dropdown"><span>{{\Sentinel::getUser()->first_name}}
                                {{\Sentinel::getUser()->last_name}}</span></a>

                        <div class="dropdown-menu">

                            @if ($user->inRole('tutor'))
                            <a class="dropdown-item" href="{{url('tutor')}}">Dashboard</a>

                            <a class="dropdown-item" href="{{url('tutors').'/'.encrypt($user->id)}}">Profile</a>
                            <a class="dropdown-item" href="{{url('tutor/assignment')}}">Live Assignments</a>
                            <a class="dropdown-item" target="_blank"
                                href="https://secure.crbonline.gov.uk/crsc/subscriber">Update DBS</a>
                            <a class="dropdown-item" href="{{url('tutor/upload')}}">My Docs</a>
                            <a class="dropdown-item" href="{{url('faq')}}">FAQ</a>
                            <a class="dropdown-item" href="{{url('tutor/change_password')}}">Change Password</a>
                            @else
                            <a class="dropdown-item" href="{{url('employer')}}">Dashboard</a>
                            <a class="dropdown-item"
                                href="{{url('employer').'/'.encrypt($user->id).'/edit'}}">Profile</a>
                            <a class="dropdown-item" href="{{url('employer/assignment')}}">Live Assignments</a>
                            <a class="dropdown-item" href="{{url('faq')}}">FAQ</a>
                            <a class="dropdown-item" href="{{url('pricing')}}">Renew Plan</a>
                            <a class="dropdown-item" href="{{url('employer/change_password')}}">Change Password</a>
                            @endif



                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    @endif

                    @else
                    <!--<li class="tutor dropdown">
							<a href="{{url('register/tutor')}}"><span>For Tutor</span></a>
						</li>-->
                    <li class="tutor dropdown">
                        <a class=" tooltip_custom" href="#" id="navbardrop" data-toggle="dropdown"><span>For
                                Tutor</span>
                            <div class="tooltiptext">Are you tutor? Sign up for free here.</div>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('login')}}">Login</a>
                            <a class="dropdown-item" href="{{url('tutor_type')}}">Register</a>
                        </div>
                    </li>
                    <li class="employer dropdown">
                        <a class=" tooltip_custom" href="#" id="navbardrop" data-toggle="dropdown"><span>For
                                Employer</span>
                            <div class="tooltiptext">Do you need access to freelance tutors & Trainers. <br>Join Here
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('login')}}">Login</a>
                            <a class="dropdown-item" href="{{url('pricing')}}">Register</a>
                        </div>
                    </li>

                    <!--<li class="employer">
							<a href="{{url('register/employer')}}"><span>For Employer</span></a>
						</li>-->
                    @endif
                </ul>
            </div>
        </nav>

    </div>
</header>


@yield('section')

@stop