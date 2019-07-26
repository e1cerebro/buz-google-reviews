function disableSelect(this_el){
	jQuery(document).ready(function($) {
		var css_rule = {
							'cursor': 'wait'
						};

		$(this_el).css(css_rule);
		//$('.wpr-reviews-selection .wpr-products-dropdown').css(css_rule);
		$(this_el).prop('disabled', true);

	});
}

function enableSelect(this_el){
	jQuery(document).ready(function($) {
		var css_rule = {
			'cursor': 'pointer'
		};

		$(this_el).css(css_rule);
		//$('.wpr-products-dropdown').css(css_rule);
		$(this_el).prop('disabled', false);
	});
}


function getReviews(this_el, query_mode){

	console.log(query_mode)
	jQuery(document).ready(function($) {
		var ajax_args = {
			'action': 'buz_fetch_reviews',
			'query_mode': query_mode,
		}

		$('.buz-loading-gif').removeClass('hide-element');
		$('#buz_reviews_tb').hide();

		$.ajax({
			url: buz_vars.ajax_url,
			type: 'post',
			data:   ajax_args,
			success: function(response) {

				console.log(response);
				if('ignore' != response.updated_review_from_api){
					
					console.log('New Review Was Found');
				}else{
					console.log('No New Review Was Found');
				}
				$('#buz_reviews_tb').fadeIn();
				$('#buz_table_body').html('');
				$('#buz_table_body').append(response.review_row);
				
				$('.buz-loading-gif').addClass('hide-element');
				$('#buz_reviews_tb').slideDown();
				
				enableSelect(this_el)

			}
		});
	});
}


jQuery(document).ready(function($) {

	/**
	 * All of the code for your admin-facing JavaScript source
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

	$(".rating").rating();

	var this_el = $('#fetch-reviews');

	$('#fetch-reviews').on('click', function() {
		
		 disableSelect(this_el);
		 $('#buz_reviews_tb').hide();
		 getReviews(this_el, 'fetch_new');
	 });


	 	 /* Fetch Reviews when the page loads */
	getReviews(this_el, 'fetch_db');

	$('body').on('click', '.show_hide_review', function() {
		var this_el = $(this);
		var checkbox_status = '';
		var author_id 		= this_el.data('row_id');

		disableSelect(this_el)

		if($(this).prop("checked") == true){
			
			checkbox_status = 'show';
		}
		else if($(this).prop("checked") == false){
			checkbox_status = 'hide';
		}

		var form = {
			'action': 'buz_toggle_reviews',
			'check_status' : checkbox_status,
			'author_id': author_id
		}

		$.ajax({
			url: buz_vars.ajax_url,
			type: 'post',
			data:   form,
			success: function(response) {
				enableSelect(this_el)
				console.log(response);
			}
		});
	});


	$('#delete_all_reviews').on('click',  function() {

			var this_el = $(this);
 
			disableSelect(this_el)
		
			var form = {
				'action': 'buz_trauncate_db',
  			}

			$.ajax({
				url: buz_vars.ajax_url,
				type: 'post',
				data:   form,
				success: function(response) {
					enableSelect(this_el)
					if(true == response){
						$('#buz_reviews_tb').fadeOut();
					}
				}
			});
	});

	

});


