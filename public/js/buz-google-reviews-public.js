jQuery(document).ready(function($) {

	var dataValue 					= $('#buz_review_header').data('cols');
	var reviews_per_row 			= buz_vars.reviews_per_row;
	var buz_show_pagination_el 		= 'true' == buz_vars.buz_show_pagination_el ? true: false ;
	var buz_show_navigation_el 		= 'true' == buz_vars.buz_show_navigation_el ? true: false ;
	var buz_next_nav_text_el   		=  buz_vars.buz_next_nav_text_el;
		buz_next_nav_text_el   		=  buz_next_nav_text_el.length <= 0 ? 'next' : buz_next_nav_text_el;
	var buz_prev_nav_text_el   		=  buz_vars.buz_prev_nav_text_el;
		buz_prev_nav_text_el   		=  buz_prev_nav_text_el.length <= 0 ? 'prev' : buz_prev_nav_text_el;
	var cols				   		=  dataValue == '-1' ? reviews_per_row : dataValue; 
	var buz_slider_speed			=  buz_vars.buz_slider_speed_el;

	$(".testimonial-slider").owlCarousel({
		items:cols,
		itemsDesktop : [1199,4],
		itemsDesktopSmall : [980,3],
		itemsTablet: [768,2],
		itemsTabletSmall: false,
		itemsMobile : [479,1],
		singleItem : false,

		pagination:buz_show_pagination_el,
		navigation:buz_show_navigation_el,
		navigationText:[buz_prev_nav_text_el,buz_next_nav_text_el],

		slideSpeed:buz_slider_speed,
		autoPlay:true,

		lazyLoad : true,
		lazyFollow: true,

		touchDrag: true,
		paginationNumbers: true,

		stopOnHover: true,


	});

 
	
	$('.more').readmore({
		speed: 300,
		collapsedHeight: 100,
		moreLink: '<a href="#">Read more &gt;</a>',
		lessLink: '<a href="#">Read less</a>',
		heightMargin: 16
	});

	//$('.buz-reviews-public').delay(2000).fadeIn(1000);
});


 