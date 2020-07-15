//OwlSlider

jQuery(document).ready(function() {
	$('#owl-test').owlCarousel({
		items:2,
		smartSpeed:450,
		loop:true,
		nav:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:2
			}
		}
	});
});

// Fixed Header

jQuery(function() {
    var header = jQuery(".clearHeader");
    jQuery(window).scroll(function() {    
        var scroll = jQuery(window).scrollTop();
    
        if (scroll >= 100) {
            header.removeClass('clearHeader').addClass("fixHeader");
        } else {
            header.removeClass("fixHeader").addClass('clearHeader');
        }
    });
});
