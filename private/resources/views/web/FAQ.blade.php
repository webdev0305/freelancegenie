@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'FAQs view')
@section('pageKeyword', $about->keyword)
@section('pageDescription', $about->seo_description)

<section class="inner-page-title">
    <div class="container">
        <h2>FAQs</h2>
    </div>
</section>

<section id="faq-main">
    <div class="container">
        <div class="section-heading text-center anim d06 t24 fadeInUp">
            <h1>Hello, how can we help?</h1>
        </div>
		<div class="col-md-6 cstm-faq-input">
<!-- input tag -->
    <input class="form-control" id="searchbar" onkeyup="search_faq()" type="text"
        name="search" placeholder="Search your query">
		</div>
		<p class="choose-cstm">or choose a category to quickly find the help you need</p>
	
		<div class="cstm-tab-btn">
			<ul class="nav nav-pills cstm-tab-section">
				<li>
					<a href="#1a" class="active tutemp" data-toggle="tab">For Tutors</a>
				</li>
				<li class="emplyr"><a href="#2a" class="tutemp" data-toggle="tab">For Employers</a>
				</li>
			</ul>
		</div>
		<div class="tab-content clearfix cstm-tab">
			<div class="tab-pane active" id="1a">
				<div class="row">
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="gt">
							<i class="fas fa-rocket"></i>
							<h3>Getting Started</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="pr">
							<i class="fas fa-id-card"></i>
							<h3>Profile</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="sw">
							<i class="fas fa-briefcase"></i>
							<h3>Start Working</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="us">
							<i class="fas fa-file-invoice"></i>
							<h3>Usage Guides</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="2a">
				<div class="row">
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="egs">
							<i class="fas fa-rocket"></i>
							<h3>Getting Started</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="epr">
							<i class="fas fa-id-card"></i>
							<h3>Profile</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="esw">
							<i class="fas fa-briefcase"></i>
							<h3>Start Working</h3>
						</div>
					</div>
					<div class="col-md-3">
						<div class="cstm-tab-clmn" acd="eug">
							<i class="fas fa-file-invoice"></i>
							<h3>Usage Guides</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		
        <div id="accordion" class="accordion">
            <div id="gt" class="card mb-0">
                @foreach($tut_faqs_gt as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="pr" class="card mb-0">
                @foreach($tut_faqs_pr as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="sw" class="card mb-0">
                @foreach($tut_faqs_sw as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="us" class="card mb-0">
                @foreach($tut_faqs_us as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="egt" class="card mb-0">
                @foreach($emp_faqs_gt as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="epr" class="card mb-0">
                @foreach($emp_faqs_pr as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="esw" class="card mb-0">
                @foreach($emp_faqs_sw as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			<div id="eus" class="card mb-0">
                @foreach($emp_faqs_us as  $key=>$faq)
                    <div class="card-header collapsed" data-toggle="collapse" href="#{{$faq->id}}">
                        <a class="card-title">
                            {{$faq->title}}
                        </a>
                    </div>
                    <div id="{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
                        <p>
                            <?php echo $faq->description;?>
                        </p>
                    </div>
                @endforeach
            </div>
			
        </div>
		@if (!empty(\Sentinel::check()))
				@php $user = Sentinel::getUser();@endphp
				@if ($user->inRole('tutor'))
					<p><b>Note:</b>as a freelancer you are of course free to undertake any bookings outside of Freelance genie, however, any client/s that was introduced to you via Freelance genie will not be permitted!  
					If you work directly or are contacted to work directly by and for one of our clients, you will not be permitted to do so until 6 months have passed from your last assignment with Freelance genie. Failure to comply will result in an immediate restriction for up-to 12 months.  There are numerous ways that we stay aware of any potential incidences and where one/any are found, we may restrict you from the site for up-to 12months. 
					</p>
				@endif
				@if ($user->inRole('employer'))
					<p class="cstm-faq-nt"><b>Note: </b>As an Employer you have agreed to use the services of freelance genie for any/all of our services, therefore soliciting of any kind, constituting to coercing any/all of our sub-contractors to working directly with them on a separate contract would be a direct breach of our terms.  If we suspect and later find that you have engaged in this type of activity, then we may fully restrict your access for up-to 12 months or in more severe cases, indefinitely.  In addition, we will further pursue a legal case against you.</p>
				@endif
		@endif
		@if (empty(\Sentinel::check()))
		<div class="section-heading text-center anim d06 t24 fadeInUp">
		<br><br>
					<p style="color: #e8058e;">There are additional FAQs,Please check in your dashboard FAQ Menu page.</p>
		</div>
		@endif
    </div>
</section>
  @push('scripts')
<script>
	// JavaScript code 
function search_faq() { 
    let input = document.getElementById('searchbar').value 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('card-header'); 
      
    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="block";                  
        } 
    } 
}
</script>
<script>
$(document).ready(function() {
$("#1a .cstm-tab-clmn").click(function () {
    $("#1a .cstm-tab-clmn").removeClass("active");
    $(this).addClass("active");
	$('.card.mb-0').hide();
	var id=$(this).attr('acd');
	//alert(id);
	$('#'+id).show();
});
$("#2a .cstm-tab-clmn").click(function () {
    $("#2a .cstm-tab-clmn").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active"); 
$('.card.mb-0').hide();
	var id=$(this).attr('acd');
	//alert(id);
	$('#'+id).show();	
});
$('.tutemp').click(function(){
	var id=$('.cstm-tab-clmn.active').attr('acd');
	$('.card.mb-0').hide();
	$('#'+id).show();
});
});
</script>
@endpush
@stop