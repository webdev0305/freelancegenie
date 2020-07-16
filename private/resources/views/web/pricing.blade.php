@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Pricing Plans')
<section class="inner-page-title">
    <div class="container">
        <h2>Pricing Plans</h2>
    </div>
</section>
<?php //echo '<pre>';print_r($pricing);?>
<section class="new-plan">
    <div class="container">
        <div class="pricing-list">
            <div class="center">
                @foreach($pricing as $plan)
                <div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <img style="max-width: 50px;" src="web/images/plan{{$plan->plan_no}}.png" alt="mini-plan" />
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>59
                            <h6>28 days Access</h6>
                        </div>
                        <div class="title-wrap">
                            <h3>{{$plan->title}}</h3>
                            <strong>{{$plan->sub_title}}</strong>
                        </div>
                        <ul class="text-wrap">
                            <li class="tick">Post a Standard Advert Assignment to be circulated among our Tutor network
                                and wait for someone to accept.<br>
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
                @endforeach
                <div class="pricing-wrap">
                    <div class="pricing-inner">
                        <div class="img-wrap">
                            <img style="max-width: 50px;" src="web/images/mini-plan.png" alt="mini-plan" />
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

                            <img style="max-width: 50px;" src="web/images/startericon.png" alt="Starter" />

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
                            <!--i class="fas fa-trophy"></i-->
                            <img style="max-width: 50px;" src="web/images/Voyager-icon.png" alt="Voyager" />
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>199<h6>30 days Access</h6>
                        </div>
                        <div class="title-wrap">
                            <h3>Voyager </h3>
                            <strong>Perfect For casual users - 3 Tutors/Trainers</strong>
                        </div>
                        <ul class="text-wrap">
                            <li class="tick">Post 1 Premium Managed Advert Assignments</li>
                            <li class="tick">Post 2 standard ads</li>
                            <li class="tick">Book 3 Tutors Directly Online</li>
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
                            <img style="max-width: 50px;" src="web/images/pioneer-icon.png" alt="Pioneer" />
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>299<h6>30 days Access</h6>
                        </div>
                        <div class="title-wrap">
                            <h3>Pioneer </h3>
                            <strong>Perfect for Frequent users - 5 Tutors/Trainers</strong>
                        </div>
                        <ul class="text-wrap">
                            <li class="tick">Post 5 All Premium Managed Advert Assignments</li>
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
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="cost-wrap">
                            <span>£</span>399<h6>30 days Access</h6>
                        </div>
                        <div class="title-wrap">
                            <h3>Enterprise</h3>
                            <strong>Perfect for Large Org’s - 10 Tutors/Trainers</strong>
                        </div>
                        <ul class="text-wrap">
                            <li class="tick">Post 10 All Premium Managed Ad Assignments</li>
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
                            <img style="max-width: 50px;" src="web/images/ultimate.png" alt="ultimate" />
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

                            <a id="ultimate" data-toggle="modal" data-target="#date_modal" class="btn">Enquire Now</a>
                            <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#date_modal">My Calendar</button>-->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="modal" id="date_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Plan Enquiry</h5> <button type="button" class="close"
                    data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div class="form-wrap">
                    <form id="ultimate_form" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>


                            <input id="email" type="email" class="form-control" name="email" value="" required
                                autofocus>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>



                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class=" control-label">Message</label>
                            <textarea id="body" type="text" class="form-control" name="body" required></textarea>
                            @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="button-wrap">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div>


@include('includes.middle_section')


@push('scripts')

<script>
    @if(empty(\Sentinel::check()))
    bootoast.toast({
        message: "Go to login if you already registered",
        icon: 'exclamation-sign', // Glyphicons name
        timeout: 5,
        animationDuration: 300,
        position: 'top-center',
    });

    @endif

    $('#ultimate_form').on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#title-error').html("");

        $.ajax({
            type: "POST",
            url: "{{url('/ultimate')}}",
            data: $('#ultimate_form').serialize(),
            success: function (data) {
                if (data.errors) {
                    $('#title-error').html(data.errors);

                }

                if (data.success) {
                    $('#ultimate_form').trigger("reset");
                    bootoast.toast({
                        message: data.message
                    });
                    // $('#myModal').modal('toggle');
                    //location.reload();
                }
            }
        });
        event.preventDefault();
    });
</script>


@endpush
@stop