
jQuery(document).ready(function($) { 
	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	

});

 

jQuery(document).ready(function($) {
 
	$("#testimonial-slider").owlCarousel({
		items:2,
		itemsDesktop:[1000,2],
		itemsDesktopSmall:[990,2],
		itemsTablet:[768,1],
		pagination:true,
		navigation:false,
		navigationText:["",""],
		slideSpeed:1000,
		autoPlay:true
	});


	// The function toggles more (hidden) text when the user clicks on "Read more". The IF ELSE statement ensures that the text 'read more' and 'read less' changes interchangeably when clicked on.
	$(document).ready(function() {
	
		$('.more').readmore({
			speed: 300,
			collapsedHeight: 100,
			moreLink: '<a href="#">Read more &gt;</a>',
			lessLink: '<a href="#">Read less</a>',
			heightMargin: 16
		});
		
	});


});