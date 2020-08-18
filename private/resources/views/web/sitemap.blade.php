@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Contact Us')


<section class="inner-page-title">
    <div class="container">
        <h2>Sitemap</h2>
    </div>
</section>

<section class="inner-cotent contact_page">
    <div class="container">

        <div class="row">
            <div class="col-md-7">
                @include('message.message')
                <div class="form-wrap">
                    <div class="form-group">
                        <h3 for="email" class="control-label">Sitemap</h3>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/dashboard" ><h5 for="email" class="control-label">Home</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/about"><h5 for="email" class="control-label">About Us</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/care_courses"><h5 for="email" class="control-label">CQC Care Courses</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/faq"><h5 for="email" class="control-label">FAQ</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/contact-us"><h5 for="email" class="control-label">Contact Us</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/how_it_works"><h5 for="email" class="control-label">How It Works</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/pricing"><h5 for="email" class="control-label">Pricing Plan</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/tutor_type"><h5 for="email" class="control-label">Tutor Plan</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/terms"><h5 for="email" class="control-label">Terms of service</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/policy"><h5 for="email" class="control-label">Privacy Policy</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/password/reset"><h5 for="email" class="control-label">Register</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/login"><h5 for="email" class="control-label">Login</h5></a>
                    </div>
                    <div class="form-group" style="padding-left:20px">
                        <a href="https://freelancegenie.co.uk/password/reset"><h5 for="email" class="control-label">Reset Password</h5></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@push('scripts')

@endpush
@stop