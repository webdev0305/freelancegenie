<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Tutorsandtrainersonline</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<link rel="stylesheet" href="{{ asset('assets/admin/stylesheets/styles.css') }}" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
	<script src="https://kit.fontawesome.com/e903971e00.js" crossorigin="anonymous"></script>
</head>
<body>
	@yield('body')

	<script src="{{ asset("assets/admin/scripts/frontend.js") }}" type="text/javascript"></script>
	<script>
		//Sidebar-nav
		$(document).ready(function() {
			$(".openbtn").click(function(){
				
				document.getElementById("mySidenav").style.width = "250px";
			});

			$(".closebtn").click(function(){
			
				document.getElementById("mySidenav").style.width = "0px";
			});
		});
		
	</script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		
		<script type="text/javascript" src="https://cdn.datatables.net/w/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
		<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	@stack('scripts')
	
	
	
</body>
</html>