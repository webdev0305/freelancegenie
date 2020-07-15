@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Care Courses')

<section class="inner-page-title">
    <div class="container">
        <h2>Courses Coming Soon</h2>
    </div>
</section>
<section id="book" class="courses_page">    
<div class="container">        
	<!--<div class="text-center heading">            
	<h2>Book a Tutor</h2>            
	<p>Lorem ipsum dolor sit amet</p>        
	</div> -->
   <div class="row book-list">                                         
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-1.png" class="img-fluid">                            
	   <p>QCF / NVQ Assessor</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-2.png" class="img-fluid">                            
	   <p>SIA / Tutor Trainer</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-3.png" class="img-fluid">                            
	   <p>Corporate Trainer</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-4.png" class="img-fluid">                            
	   <p>Personal Fitness Trainer/Tutor</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-5.png" class="img-fluid">                            
	   <p>Construction Trainer/Tutor</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-6.png" class="img-fluid">                            
	   <p>I.T Trainer/Tutor</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                       
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-7.png" class="img-fluid">                            
	   <p>Management/Business</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-8.png" class="img-fluid">                            
	   <p>Health and Safety</p>                        
	   </a>                    
	   </div>                                                 
	   <div class="col-md-3 health aos-init aos-animate" data-aos="flip-up">                        
	   <a href="#" class="text-wrap text-center">                            
	   <img src="web/images/special-9.png" class="img-fluid">                            
	   <p>Fire Safety</p>                        
	   </a>                    
	   </div>                                        
   </div>    
</div>
</section>
<!--section class="inner-cotent care">
    <div class="container">
		@include('message.message')
		<?php //print_r($categories); ?>
		
		
	</div>
</section!-->



@push('scripts')

@endpush
@stop
