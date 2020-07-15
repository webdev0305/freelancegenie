<!-- <!DOCTYPE html>
<html>
 <head>
  <title>cetificate</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		.cetificate{
			width:800px;
			margin:auto;
			display:table;
			text-align:center;			
		}
		.cetificate-top-img img{
			margin:auto;
			display:table;
		}
		.cstm-input-pdf{
			color: #37383a;
		}
		.cstm-input-pdf input{
			border-bottom: 2px solid #9c9c9c !important;
			border: none;
			width: 320px;
			padding: 15px 15px;
			outline: none;
			background: transparent;
		}	
		.cstm-input-pdf input, .cstm-input-pdf h2{
			text-align: center;
			font-size: 18px;
			font-weight: bold;
			letter-spacing: 5px;
		}
		.cstm-input-pdf input[type="text"]::placeholder{
			color:#37383a;
		}
		.cstm-date-pdf, .cstm-date-pdf input::placeholder{
			color:#fff !important;
		}
		.footer-pdf input{
			border-bottom: none !important;
			width: 200px;
		}
		.footer-pdf{
			
		}
		.cstm-input-pdf h2 {
			padding-top: 15px;
		}
	</style>
 </head>
<body>
   <div class="cetificate">
		<div class="cetificate-top-img">
			<img src="{{url('images/top-img-pdf.jpg')}}" alt="top-img-pdf" class="img-fluid">
		</div>
			<h1 style="text-align:center; font-size: 16px; letter-spacing:5px;">PROUDLY PRESENTED TO</h1>
		<div class="cstm-input-pdf">
			<input type="text" value="" placeholder="EDIT TEXT">
			<h2>COURSE TITLE</h2>
		</div>
		<div class="cstm-input-pdf">
			<input type="text" value="" placeholder="EDIT TEXT">
			<h2>AWARD NAME</h2>
		</div>
		<div class="row footer-pdf" style="background:url({{url('images/pdf-footer-img.jpg')}});background-repeat: no-repeat;
			background-size: contain;
			background-position: bottom center;
			padding: 60px 0px 35px;">
			<div class="col-md-4">
				<div class="cstm-input-pdf cstm-date-pdf">
					<input type="text" value="" placeholder="EDIT TEXT">
					<h2>DATE</h2>
				</div>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="cstm-input-pdf">
					<input type="text" value="" placeholder="EDIT TEXT">
					<h2>SIGNATURE</h2>
				</div>
			</div>
		</div>
   </div>
</body>
</html> -->

<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
span.cls_002{font-family:Arial,serif;font-size:16.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_002{font-family:Arial,serif;font-size:16.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_003{font-family:Arial,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_003{font-family:Arial,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}

</style>
<script type="text/javascript" src="3e318e6c-87d1-11ea-8b25-0cc47a792c0a_id_3e318e6c-87d1-11ea-8b25-0cc47a792c0a_files/wz_jsgraphics.js"></script>
</head>
<body>
<div style="position:absolute;left:50%;margin-left:-425px;top:0px;width:850px;height:603px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="{{url('images/background1.jpg')}}" width=850 height=603></div>
<div style="position:absolute;left:291.42px;top:183.74px" class="cls_002"><span class="cls_002">PROUDLY PRESENTED TO</span></div>
<div style="position:absolute;left:275.20px;top:257.09px" class="cls_003"><span class="cls_003">{{$job_title}}</span></div>
<div style="position:absolute;left:335.10px;top:301.50px" class="cls_003"><span class="cls_003">COURSE TITLE</span></div>
<div style="position:absolute;left:359.81px;top:358.68px" class="cls_003"><span class="cls_003">{{$stuname}} {{$sirname}}</span></div>
<div style="position:absolute;left:325.60px;top:395.09px" class="cls_003"><span class="cls_003">AWARDEE NAME</span></div>
<div style="position:absolute;left:74.69px;top:493.56px" class="cls_003"><span class="cls_003">{{$date}}</span></div>
<div style="position:absolute;left:645.66px;top:450.44px" class="cls_003"><span class="cls_003"><img src="{{url('images/sign.png')}}" width=150 height=80></span></div>
<div style="position:absolute;left:104.45px;top:529.74px" class="cls_003"><span class="cls_003">DATE</span></div>
<div style="position:absolute;left:639.34px;top:531.41px" class="cls_003"><span class="cls_003">SIGNATURE</span></div>
</div>

</body>
</html>

