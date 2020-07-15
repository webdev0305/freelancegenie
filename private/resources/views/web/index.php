<!doctype html>
<html lang="en">
<head>
<title>Home</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.css" >
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"><style>.buttonload {    background-color: #4CAF50; /* Green background */    border: none; /* Remove borders */    color: white; /* White text */    padding: 12px 24px; /* Some padding */    font-size: 16px; /* Set a font-size */}/* Add a right margin to each icon */.fa {    margin-left: -12px;    margin-right: 8px;}</style>
</head>
<body>
	<div class="lading-wrap">
		<div class="timer-wrap">
		<strong class="top-ttl">We are coming in</strong>
		<div class="timer j-timer-first"></div>
		</div>
        <div class="main-content text-center">
			<h1>Are you a...'Freelance' Tutor, Trainer, Teacher, Education Practitioner, Assessor or Lecturer?</h1>
			<div class="text-wrap">
				<strong>Maybe you’re a Freelance IQA, or have IQA/EV Experience dealing with Apprenticeships and Assessments’?</strong>
				<p>No matter what sector, Area of specialism or discipline you work in,</p><strong>We want to hear from you!</strong>
				<p>Please 'sign up' to our mailing list to discover an Exciting and Fresh New approach to securing assignments. </p>
				<p>Our platform will be launching soon - You can unsubscribe at any Time!</p>
			</div>
			<button class="btn btn-primary big btn-primry" data-toggle="modal" id="modelsbun" data-target="#myModal">Signup &amp; Subscribe to our Newsletter</button>
			<div class="main-content">			
				<div class="text-wrap">
					<p style="color:#007bff;"> If you are simply interested in becoming an Assessor, Tutor or IQA, then please get</p>
					<p style="color:#007bff;"> in touch by sending an email to </p>
					<p style="color:#007bff;"> <a href="mailto:info@tutorsandtrainersonline.com">info@tutorsandtrainersonline.com </a></p>
				</div>
				<ul class="list-social">
					<li class="fb"><a href="https://www.facebook.com/Tutorsandtrainersonline-152426918810148/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li class="link"><a href="https://www.linkedin.com/in/tutorsandtrainers-online-280911159/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<li class="tweet"><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li class="insta"><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li class="google"><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
		
    </div>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body"> <div id="Content" style="background: lightblue;padding: 0px 11px;"> </div>
					<h3 class="text-center modal-title">Please fill Your Name and Email</h3>
					<form id="notesmodal">     
						<div class="form-row">
							<div class="form-group col-sm-12">
								<input type="name" id="name" required class="form-control"   placeholder="Your Full Name">
							</div>
							<div class="form-group col-sm-12">
								<input type="email" id="email" class="form-control" required id="" placeholder="Your Email">
							</div>
						</div>
						<div class="button-wrap text-center">
							<button  id="invite_user_btn" type="button"   class="btn btn-primary btn-primry"><i style="display: none;" class="fa fa-spinner fa-spin"></i>Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script></body><script>    $(function () {       $('#modelsbun').click(function () {		  $('#name').val('');		  $('#email').val('');		     $('.fa-spin').hide();		       $("#Content").html('');		       });		           $('#invite_user_btn').click(function () {              $('.fa-spin').show();                $.ajax({                    type: 'post',                    url: 'action.php',                    data: {                       'email': $('#email').val(),                        'name': $('#name').val(),                                       },                    success: function (data) {				      $("#Content").html(data);					    $("#Content").show();                     $('.fa-spin').hide();                        if (data.success == '1') {                                             }                        if (data.success == '0') {                                               }                    }                });               });    });</script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/timezz.js"></script>
<script>
  new TimezZ('.j-timer-first', {
    daysName: ' days',
    hoursName: ' hours',
    minutesName: ' minutes',
    secondsName: ' seconds',
    template: '<div class="wrap"><span>NUMBER</span><i>LETTER</i></div> ',
  });
</script>
</html>