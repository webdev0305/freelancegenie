<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>@yield('pageTitle') - {{ config('app.name', 'Tutorsandtrainersonline') }}</title>
	<!-- Required meta tags -->
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="@yield('pageDescription')">
	<meta name="keyword" content="@yield('pageKeyword')">

	<link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon" />
	
	<link rel="stylesheet" href="{{ asset('assets/web/stylesheets/styles.css') }}" />
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />-->
	
 	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:300,400,500,600,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/e903971e00.js" crossorigin="anonymous"></script>
</head>
<body>
	@yield('body')
	
	@include('includes.footer')
	
	<script src="{{ asset("assets/web/scripts/frontend.js") }}" type="text/javascript"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>
	<script>    
	// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#back_to_top_btn').fadeIn(200);    // Fade in the arrow
    } else {
        $('#back_to_top_btn').fadeOut(200);   // Else fade out the arrow
    }
	if ($(this).scrollTop() > 130) {
          $('.cstm-scrollup').fadeIn();
      } else {
          $('.cstm-scrollup').fadeOut();
      }
});
$('#back_to_top_btn').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
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
		if (isIE()){
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
                $("#invite_user_btn").prop("disabled",true);
                $('.fa-spin').show();
                $.ajax({
                    type: 'post',
                    url: '{{url('subscribe')}}',
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
                        $("#invite_user_btn").prop("disabled",false);
                        $('.fa-spin').hide();
                    }
                });
            });
        });</script>
	@stack('scripts')
	
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
$(document).ready(function(){

	//msieversion();
	/*if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1))
	{
		$('#browser_msg').show();
	}*/
$('.center').slick({
  centerMode: true,
  slidesToScroll: 1,
  slidesToShow: 3,
  responsive: [
    {
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
window.onscroll = function() {myFunction()};

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
</body>
</html>
