@extends('layouts.dashboard')
@section('section')
<section id="regiter" class="form-page">
	<div class="container">
		<div class="form-wrap">
			<h3>Register Youself</h3>
			<form>
				<div class="form-group">
					<input type="text" class="form-control" id="" placeholder="Enter Name ">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="" placeholder="Phone Number ">
				</div>
				<div class="form-group">
					<select class="form-control" id="">
						<option>Select Your Service</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="alread-text"><a href="">Already A User? Login</a></div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</section>
@stop