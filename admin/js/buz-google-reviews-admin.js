/* Disable the selected element when it is performing an ajax action */
function disableSelect(this_el){
	jQuery(document).ready(function($) {
		var css_rule = {'cursor': 'wait'};

		$(this_el).css(css_rule);
 		$(this_el).prop('disabled', true);

	});
}

/* Enable an element after performing and ajax action */
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

/* Get reviews from the admin php script */
function getReviews(this_el, query_mode){

	jQuery(document).ready(function($) {
		/* Configure the ajax request POST parameters */
		var ajax_args = {
			'action': 'buz_fetch_reviews',
			'query_mode': query_mode,
		}

		/* Hide/Show the certain elements on the page */
		$('.buz-loading-gif').removeClass('hide-element');
		$('#buz_reviews_tb').hide();

		$.ajax({
			url: buz_vars.ajax_url,
			type: 'post',
			data:   ajax_args,
			success: function(response) {

				/* If the length of API error is greater than 0. Show the error msg */
				if(response.API_ERROR.length > 0){
					$('.buz_message').slideToggle();
					$('#buz_reviews_tb').slideUp();
					$('.buz-loading-gif').addClass('hide-element');
					$('.buz_error_message').html('');
					$('.buz_error_message').append(response.API_ERROR);
				}else{
					$('#buz_reviews_tb').fadeIn();
					$('#buz_table_body').html('');
					$('#buz_table_body').append(response.review_row);
					$('.buz-loading-gif').addClass('hide-element');
					$('#buz_reviews_tb').slideDown();
				}

				enableSelect(this_el)

			}
		});
	});
}


jQuery(document).ready(function($) {

	/**
	 */

	$(".rating").rating();

	var this_el = $('#fetch-reviews');

	$('#fetch-reviews').on('click', function() {
		
		 disableSelect(this_el);
		 $('.buz_message').hide();
		 $('#buz_reviews_tb').hide();

		 getReviews(this_el, 'fetch_new');
	 });


	/* Fetch Reviews when the page loads */
	getReviews(this_el, 'fetch_db');

	$('body').on('click', '.show_hide_review', function() {
		var this_el 		= $(this);
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
				//console.log(response);
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
						$('.buz_message').show();
						$('.buz_error_message').html('');
						$('.buz_error_message').append("No reviews were found");

 					}
				}
			});
	});

	

});


