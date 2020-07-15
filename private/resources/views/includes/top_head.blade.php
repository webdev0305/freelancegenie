<div class="main-top">
	<div class="container">
		<ul class="cstm-top-info">
			@foreach($settings_info as $info)
			@if($info->name =="admin_info_email")
			<li><a href="mailto:{{$info->value}}"><i class="fa fa-envelope"></i>{{$info->value}}</a></li>
			@endif
			@if($info->name =="contact")
			<li><a href="tel:{{$info->value}}"><i class="fa fa-phone"></i>{{$info->value}}</a></li>
			@endif
			@endforeach
		</ul>
	</div>
</div>