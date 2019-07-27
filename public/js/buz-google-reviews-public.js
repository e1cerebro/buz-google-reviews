jQuery(document).ready(function($) {
	var dataValue = $('#buz_review_header').data('cols');
	var cols = dataValue == '-1' ? 2 : dataValue; 
	
	$(".testimonial-slider").owlCarousel({
		items:cols,
		itemsDesktop:[1000,2],
		itemsDesktopSmall:[990,2],
		itemsTablet:[768,1],
		pagination:true,
		navigation:false,
		navigationText:["",""],
		slideSpeed:1000,
		autoPlay:true
	});

 
	
	$('.more').readmore({
		speed: 300,
		collapsedHeight: 100,
		moreLink: '<a href="#">Read more &gt;</a>',
		lessLink: '<a href="#">Read less</a>',
		heightMargin: 10
	});

	//$('.buz-reviews-public').delay(2000).fadeIn(1000);
});


 