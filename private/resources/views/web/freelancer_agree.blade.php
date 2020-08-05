<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Freelancer Agreement</title>
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">
    <meta name="keyword" content="@yield('pageKeyword')">

    <link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('assets/web/stylesheets/styles.css') }}" />
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />-->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,600,700,800"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:300,400,500,600,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e903971e00.js" crossorigin="anonymous"></script>
</head>

<body>
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
                                <a class="dropdown-item" href="{{url('tutor/faq')}}">FAQ</a>
                                <a class="dropdown-item" href="{{url('tutor/change_password')}}">Change Password</a>
                                @else
                                <a class="dropdown-item" href="{{url('employer')}}">Dashboard</a>
                                <a class="dropdown-item"
                                    href="{{url('employer').'/'.encrypt($user->id).'/edit'}}">Profile</a>
                                <a class="dropdown-item" href="{{url('employer/assignment')}}">Live Assignments</a>
                                <a class="dropdown-item" href="{{url('employer/faq')}}">FAQ</a>
                                <a class="dropdown-item" href="{{url('pricing')}}">Renew Plan</a>
                                <a class="dropdown-item" href="{{url('employer/change_password')}}">Change Password</a>
                                @endif



                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
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
                                <div class="tooltiptext">Do you need access to freelance tutors & Trainers. <br>Join
                                    Here
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


    <section class="inner-page-title">
        <div class="container">
            <h2>Edit Profile</h2>
        </div>
    </section>

    <section class="pricing-page">
        <div class="container">
            <div class="step-form">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row" id="serviceagreement">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1 class="form_inner_titile" style="text-align:center">FREELANCER AGREEMENT</h1><br>

                                <form action="" method="POST">
                                    <input name="_method" type="hidden" value="PUT">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group ">
                                                <p><strong>THIS FREELANCER AGREEMENT</strong>(the "Agreement") dated
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group ">
                                                <input class="form-control" id="date" name="date" type="text"
                                                style="background-color:rgba(230,230,230,0.5)" value="<?php echo date("Y-m-d"); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <p><strong>Between</strong> Freelance Genie Ltd, Company Number:
                                                    11982554, Registered Address: Union House, 111 New UnionStreet,
                                                    Coventry, West Midlands, CV1 2NT</p>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group ">
                                                <p>and</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <input class="form-control" id="name" name="name" type="text" style="background-color:rgba(230,230,230,0.5)"
                                                    value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group ">
                                                <p>adress</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <input class="form-control" id="address" name="address" type="text" style="background-color:rgba(230,230,230,0.5)"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <p><strong>IN CONSIDERATION OF </strong> the mutual benefits and
                                                    obligations set forth in this Agreement, the receipt and sufficiency
                                                    of which consideration is hereby acknowledged, Freelance Genie and
                                                    the Freelance subcontractors (individually, the "Party" and
                                                    collectively the "Parties" to this Agreement) agree as follows:</p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo $freelancer->description; ?>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-6" style="text-align:center">
                                            <p>The Parties hereby agree to the conditions set in this Agreement by
                                                placing their signature below:</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group ">
                                                <p>For Freelance Genie</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group " style="text-align:center">
                                                <img style="width:350px"
                                                    src="data:image/png;base64,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">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group ">
                                                <p>For Freelancer</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group " style="text-align:center" id="sign_preview">
                                                <!-- signstart -->
                                                <style>
                                                    #signature {
                                                        width: 570px;
                                                        height: 150px;
                                                        border: 1px solid rgba(0, 0, 0, 0.1);
                                                    }
                                                </style>
                                                <div id="signature" style=''>
                                                    <canvas id="signature-pad" class="signature-pad" width="570px"
                                                        height="150px"></canvas>
                                                </div>
                                                <div style="clear: both;padding-top:20px">
                                                    <input type='button' id='retry' value='Retry'>
                                                </div>
                                                <!-- signend -->
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group ">
                                                <p>Date</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group " style="text-align:center">
                                                <input class="form-control" type="text" style="background-color:rgba(230,230,230,0.5)"
                                                    value="<?php echo date("Y-m-d"); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label class="checkbox"><input type="checkbox" name="terms" id="terms"
                                                        onchange="activateButton(this)"> I can confirm I have read and
                                                    agreed to the <a href="{{url('terms')}}">Terms & Conditions</a> and
                                                    <a href="{{url('policy')}}">Privacy Policy</a>.</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6" style="display:none">
                                <div class="form-group">
                                    <a onclick="window.location.href = '{{ url('tutor_makepdf') }}/{{$user_id}}';"
                                        class="btn btn-success submit_button_custom tooltip_custom" id="download">
                                        Download PDF
                                        <div class="tooltiptext">Please click After Save</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href= "{{url('tutors').'/'.encrypt($user->id)}}" class="btn btn-success submit_button_custom" style="width:180px">
                                        Return to Profile
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="div_checkbox">
                                    <button class="btn btn-success submit_button_custom" style="width:200px" id="sads"
                                        name="submit" type="submit">
                                        Save and Send Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('message.message')
    <script src="{{ asset('assets/jquery-3.0.0.js') }}" type='text/javascript'></script>
    <script src="{{ asset('assets/signature_pad-master/js/signature_pad.js') }}"></script>
    <a href="javascript:" id="back_to_top_btn"><i class="fas fa-angle-up"></i></a>
    <script src="https://localhost/freelancegenie/assets/web/scripts/frontend.js" type="text/javascript"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js">
    </script>
    <script>
        // ===== Scroll to Top ==== 
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
                $('#back_to_top_btn').fadeIn(200); // Fade in the arrow
            } else {
                $('#back_to_top_btn').fadeOut(200); // Else fade out the arrow
            }
            if ($(this).scrollTop() > 130) {
                $('.cstm-scrollup').fadeIn();
            } else {
                $('.cstm-scrollup').fadeOut();
            }
        });
        $('#back_to_top_btn').click(function () { // When arrow is clicked
            $('body,html').animate({
                scrollTop: 0 // Scroll to top of body
            }, 500);
        });

        /* Sample function that returns boolean in case the browser is Internet Explorer*/
        function isIE() {
            ua = navigator.userAgent;
            /* MSIE used to detect old browsers and Trident used to newer ones*/
            var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;

            return is_ie;
        }
        /* Create an alert to show if the browser is IE or not */
        if (isIE()) {
            //alert('show msg');
            $('#browser_msg').show();

        }
        $(function () {

            $('#modelsbun').click(function () {
                $('#email').val('');
                $('.fa-spin').hide();
                $("#Content").html('');
            });
            $('#invite_user_btn').click(function () {
                $("#invite_user_btn").prop("disabled", true);
                $('.fa-spin').show();
                $.ajax({
                    type: 'post',
                    url: 'https://localhost/freelancegenie/subscribe',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'email': $('#email').val()
                    },
                    success: function (data) {
                        // $("#Content").html(data);
                        // $("#Content").show();
                        bootoast.toast({
                            message: data
                        });
                        $("#invite_user_btn").prop("disabled", false);
                        $('.fa-spin').hide();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#head_office_country').multiselect({
                nonSelectedText: 'Select City',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '100%',
                required: true
            });
            $('#comp_country').multiselect({
                nonSelectedText: 'Select City',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '100%',
                required: true
            });
            $('#country').multiselect({
                nonSelectedText: 'Select City',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '100%',
                required: true
            });
        });
    </script>

    <script src="https://localhost/freelancegenie/js/admin/bootstrap-multiselect.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://localhost/freelancegenie/css/bootstrap-multiselect.css" />

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $(document).ready(function () {

            //msieversion();
            /*if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1))
            {
            	$('#browser_msg').show();
            }*/
            $('.center').slick({
                centerMode: true,
                slidesToScroll: 1,
                slidesToShow: 3,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            centerMode: true,
                            slidesToScroll: 1,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: true,
                            centerMode: true,
                            slidesToScroll: 1,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        window.onscroll = function () {
            myFunction()
        };

        var header = document.getElementById("cstm-myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("cstm-sticky");
            } else {
                header.classList.remove("cstm-sticky");
            }
        }
    </script>
    <script>
        var png_data;
        var signaturePad;
        $(document).ready(function () {
            signaturePad = new SignaturePad(document.getElementById('signature-pad'));
            $('#retry').click(function () {
                var c = document.getElementById("signature-pad");
                var ctx = c.getContext("2d");
                ctx.clearRect(0, 0, $('#signature-pad').width(), $('#signature-pad').height());
            });

        })
        $(document).on('click', '#sads', function () {
            png_data = signaturePad.toDataURL('image/png');
            var name = $('#name').val();
            var address = $('#address').val();
            var notice = $('#notice').val();
            $('#name').attr('value', name);
            $('#address').attr('value', address);
            $('#notice').attr('value', notice);
            $('#terms').attr('checked', true);
            // $('#sign_preview').empty();
            // $('#sign_preview').append('<img style="width:350px;height:100px" class="uploadpreview" src="'+png_data+'" />');
            var sign_preview = '<img style="width:350px;height:100px" class="uploadpreview" src="' + png_data +
                '" />'
            var contract = $('#serviceagreement').html();

            const start = new RegExp(/<!--.signstart.-->/gmi)
            const end = new RegExp(/<!--.signend.-->/gmi)
            let start1 = start.exec(contract)
            let end1 = end.exec(contract)
            if (start1 != null && end1 != null) {
                var index_start = contract.indexOf(start1)
                var index_end = contract.indexOf(end1) + end1[0].length
                contract = contract.substr(0, index_start - 1) + sign_preview + contract.substr(index_end)
            }

            $.ajax({
                type: 'POST',
                url: "{{url('tutor/savecontract')}}",
                data: {
                    contract: contract,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    bootoast.toast({
                        message: 'Freelancer Agreement updated and sent successfully !'
                    });
                    $('#download').click();
                }

            });

        });


        $('document').ready(function () {
            document.getElementById("sads").disabled = true;
        });

        function activateButton(element) {
            if (element.checked) {
                document.getElementById("sads").disabled = false;
            } else {
                document.getElementById("sads").disabled = true;
            }
        }
    </script>
</body>

</html>