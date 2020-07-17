@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Sub-contractor Operating Options')
<section class="inner-page-title">
    <div class="container">
        <h2>Choose an Operating Status</h2>
    </div>
</section>
<section class="new-plan">
    <div class="container">
        <div class="pricing-list">
            <div class="center">
                @foreach($tutor_types as $type)
                <div class="pricing-wrap premium">
                    <div class="pricing-inner">
                        @if($type->plan_no == 7)
                        <div class="ribbon ribbon-top-left"><span>Recommended</span></div>
                        @endif
                        <div class="img-wrap">
                            <img style="max-width: 50px;" src="web/images/{{$type->image}}" />
                        </div>
                        <div class="title-wrap">
                            <h3>{{$type->title}}</h3>
                            <strong>{{$type->sub_title}}</strong>
                        </div>
                        {!!$type->details!!}
                        <div class="button-wrap">
                            <a class="btn" href="{{url('register/tutor/').'/'.encrypt('7')}}">Sign Up</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($tutor_types as $type)
                <div class="pricing-wrap premium">
                    <div class="pricing-inner">
                        @if($type->plan_no == 7)
                        <div class="ribbon ribbon-top-left"><span>Recommended</span></div>
                        @endif
                        <div class="img-wrap">
                            <img style="max-width: 50px;" src="web/images/{{$type->image}}" />
                        </div>
                        <div class="title-wrap">
                            <h3>{{$type->title}}</h3>
                            <strong>{{$type->sub_title}}</strong>
                        </div>
                        {!!$type->details!!}
                        <div class="button-wrap">
                            <a class="btn" href="{{url('register/tutor/').'/'.encrypt('$type->plan_no')}}">Sign Up</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--<section class="pricing-page">
    <div class="container">
        <div class="section-heading text-center anim d06 t24 fadeIn">
            <h1>Lorem ipsum dolor</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam a libero non porttitor. Maecenas sit
                amet libero id est dignissim ornare. Integer sagittis, elit ut rhoncus lacinia, enim diam semper dolor
            </p>
        </div>
        <div class="row listing-wrap">
            <div class="col-md-6">
                <div class="pricing-wrap">
                    <div class="pricing-head">
                        <p class="">FREE’ Sign up using ‘our’ - <span>UMBRELLA COMPANY</span></p>
                        <h4>Must use our complete 360, P.A.Y.E umbrella solutions.</h4>
                        <p>[Pay-as you earn Fees Apply Within]</p>

                        <div class="package-icon"><i class="fa fa-database"></i></div>

                    </div>
                    <div class="price-wrap">

                    </div>
                    <ul class="table-list">
                        <li class="tick">‘Free’ Sign up</li>
                        <li class="tick">Full UK Driving Licence & Own Car Required</li>
                        <li class="tick">Self Employed Freelancer</li>
                        <li class="tick">We manage your Income Tax</li>
                        <li class="tick">We manage your N.I. Contributions</li>
                        <li class="tick">We can offer pension assistance</li>
                        <li class="tick">We provide Professional Indemnity</li>
                        <li class="tick">We provide Public Liability</li>
                        <li class="tick">We provide Employers Liability</li>
                    </ul>
                    <a class="btn" href="{{url('register/tutor/').'/'.encrypt('1')}}">Sign Up</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pricing-wrap">


                    <div class="pricing-head">
                        <p class="">FREE’ Sign up using ‘your own’- <span>LTD COMPANY</span></p>
                        <h4>Use ‘Without’ our Complete 360 Accounting Service.</h4>
                        <p>[Pay-as you earn Fees Apply Within]</p>

                        <div class="package-icon"><i class="fa fa-database"></i></div>

                    </div>

                    <div class="price-wrap">

                    </div>
                    <ul class="table-list">
                        <li class="tick">‘Free’ Sign up</li>
                        <li class="tick">Full UK Driving Licence & Own Car Required</li>
                        <li class="tick">Self Employed Freelancer - Ltd Status Operator</li>
                        <li class="tick">Responsible for your own Income Tax</li>
                        <li class="tick">Responsible for your own N.I.</li>
                        <li class="tick">Responsible for own Pension</li>
                        <li class="tick">Must provide Public liability cert</li>
                        <li class="tick">Must provide Professional Indemnity cert</li>
                        <li class="tick">Must provide Employers Liability cert</li>
                        <li class="tick">Must provide Company Reg No.</li>
                        <li class="tick">Must provide Company Bank Account Details</li>
                        <li class="tick">Must provide Vat Reg No, if applicable</li>
                    </ul>
                    <a class="btn" href="{{url('register/tutor/').'/'.encrypt('2')}}">Sign Up</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="pricing-wrap">
                    <div class="pricing-head">
                        <p class="">FREE’ Sign up using ‘your own’ – <span>LTD COMPANY</span></p>
                        <h4>Use ‘With’ our Complete 360 Accounting Service.</h4>
                        <p>[Pay-as you earn Fees Apply Within]</p>

                        <div class="package-icon"><i class="fa fa-database"></i></div>

                    </div>
                    <div class="price-wrap">

                    </div>
                    <ul class="table-list">
                        <li class="tick">‘Free’ Sign up</li>
                        <li class="tick">Full UK Driving Licence & Own Car Required</li>
                        <li class="tick">Self Employed Freelancer - Ltd Status Operator –With Complete Accounting
                            Service.</li>
                        <li class="tick">WE Take Care of you’re...</li>
                        <li class="tick">Income Tax</li>
                        <li class="tick">N.I.</li>
                        <li class="tick">Pension Cont</li>
                        <li class="tick">Public Liability</li>
                        <li class="tick">Professional Indemnity</li>
                        <li class="tick">Employers Liability</li>
                        <li class="tick">What we’ll Need...</li>
                        <li class="tick">You’re Company Reg No.</li>
                        <li class="tick">Your Company Bank Account Details</li>
                        <li class="tick">Your Vat Reg No, if applicable</li>
                    </ul>
                    <a class="btn" href="{{url('register/tutor/').'/'.encrypt('3')}}">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</section>-->
@include('includes.middle_section')
@stop