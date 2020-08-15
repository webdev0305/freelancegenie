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
                            <img style="max-width: 50px;" src="web/images/{{$plan->image}}" alt="image-plan" />
                        </div>
                        <div class="cost-wrap">
                            @if($plan->status== 0)
                            <span>£</span>{{$plan->price}}
                            @endif
                            <h6>{{$plan->duration}} days Access</h6>
                        </div>
                        <div class="title-wrap">
                            <h3>{{$plan->title}}</h3>
                            <strong>{{$plan->sub_title}}</strong>
                        </div>
                        {!!$plan->details!!}
                        <div class="button-wrap">
                            @if (!empty(\Sentinel::check()) && Sentinel::getUser()->inRole('employer'))
                            <a class="btn" href="{{url('subscription').'/'.encrypt($plan->id)}}">Subscribe up</a>
                            @else
                                @if($plan->status== 0)
                                <a class="btn" href="{{url('register/employer/').'/'.encrypt($plan->id)}}">Subscribe</a>
                                @else
                                <a id="ultimate" data-toggle="modal" data-target="#date_modal" class="btn">Enquire Now</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                

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