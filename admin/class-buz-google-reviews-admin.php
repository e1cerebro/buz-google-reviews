<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/admin
 * @author     Uchenna Nwachukwu <nwachukwu16@gmail.com>
 */
class Buz_Google_Reviews_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function buz_admin_enqueue_styles($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buz_Google_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buz_Google_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 
		if($hook_suffix != 'toplevel_page_buz-google-reviews') {
			return;
		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buz-google-reviews-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-semantic-ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.css', array(), $this->version );


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function buz_admin_enqueue_scripts($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buz_Google_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buz_Google_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

 
		if($hook_suffix != 'toplevel_page_buz-google-reviews') {
			return;
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buz-google-reviews-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-semantic-ui-js', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.js');
		
		wp_localize_script($this->plugin_name, 
							'buz_vars',
								[
									'ajax_url' => admin_url('admin-ajax.php')
								]
							);

	}

	public function buz_admin_menu(){
		add_menu_page(
						$page_title = __('Google Reviews',TEXT_DOMAIN),
						$menu_title = __('Google Reviews', TEXT_DOMAIN), 
						$capability = 'manage_options', 
						$menu_slug  = $this->plugin_name, 
						$function   = [$this, 'buz_admin_menu_cb'], 
						$icon_url   = 'dashicons-star-filled');

	}

	public function buz_admin_menu_cb(){
		include_once( 'partials/buz-google-reviews-admin-display.php' );
	}

	public function buz_settings_options(){
		
		/******** SECTION SETTINGS ********/
		add_settings_section(
			'buz_general_section',
			__( 'General Settings', TEXT_DOMAIN ),
			[$this, 'buz_general_settings_section_cb' ],
			$this->plugin_name
		);

		add_settings_section(
			'buz_slider_section',
			__( 'Slider Settings', TEXT_DOMAIN ),
			[$this, 'buz_general_settings_section_cb' ],
			$this->plugin_name
		);

		/********FIELDS SETTINGS********/

		/* Google Api */
		add_settings_field(
			'buz_google_api_el',
			__( 'Google Api Key', TEXT_DOMAIN),
			[ $this,'buz_google_api_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);

		register_setting( $this->plugin_name, 'buz_google_api_el');
		
		/* Company Name  */
		add_settings_field(
			'buz_company_name_el',
			__( 'Company Name', TEXT_DOMAIN ),
			[ $this,'buz_company_name_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);
		register_setting( $this->plugin_name, 'buz_company_name_el', [$this, 'buz_company_name_sanitize_input']);
		
		
		/* Toggle company name */
		add_settings_field(
			'buz_toggle_company_name_el',
			__( 'Show/Hide Company Name', TEXT_DOMAIN ),
			[ $this,'buz_toggle_company_name_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);
		register_setting( $this->plugin_name, 'buz_toggle_company_name_el');
		
		/* Toggle company logo */
		add_settings_field(
			'buz_google_logo_el',
			__( 'Show/Hide Google Logo', TEXT_DOMAIN ),
			[ $this,'buz_google_logo_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);
		register_setting( $this->plugin_name, 'buz_google_logo_el');
		
		/* Toggle company review rating */
		add_settings_field(
			'buz_company_review_star_el',
			__( 'Show/Hide Company Review Star', TEXT_DOMAIN ),
			[ $this,'buz_company_review_star_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);
		register_setting( $this->plugin_name, 'buz_company_review_star_el');

		/* Toggle see all reviews button */
		add_settings_field(
			'buz_toggle_see_all_el',
			__( 'Toggle See All Button', TEXT_DOMAIN ),
			[ $this,'buz_toggle_see_all_cb'],
			$this->plugin_name,
			'buz_general_section'
 		);
		register_setting( $this->plugin_name, 'buz_toggle_see_all_el');

		 /**** SLIDER SETTINGS *****/

		/* Show Min review ratings */
		add_settings_field(
			'buz_show_min_review_el',
			__( 'Show Min Rating', TEXT_DOMAIN ),
			[ $this,'buz_show_min_review_cb'],
			$this->plugin_name,
			'buz_slider_section'
 		);
		register_setting( $this->plugin_name, 'buz_show_min_review_el');
	
		/* Show Reviews Per Row */
		add_settings_field(
			'buz_reviews_per_row_el',
			__( 'Reviews Per Row', TEXT_DOMAIN ),
			[ $this,'buz_reviews_per_row_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_reviews_per_row_el');
		
		/* Show Reviews Per Row */
		add_settings_field(
			'buz_show_pagination_el',
			__( 'Toggle Pagination',TEXT_DOMAIN ),
			[ $this,'buz_show_pagination_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_show_pagination_el');
	
		/* Show Reviews Per Row */
		add_settings_field(
			'buz_show_navigation_el',
			__( 'Toggle Navigation', TEXT_DOMAIN ),
			[ $this,'buz_show_navigation_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_show_navigation_el');
	
		/* Next Nav Text */
		add_settings_field(
			'buz_next_nav_text_el',
			__( 'Next Navigation Text', TEXT_DOMAIN ),
			[ $this,'buz_next_nav_text_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_next_nav_text_el');
	
		/* Prev Nav Text */
		add_settings_field(
			'buz_prev_nav_text_el',
			__( 'Prev Navigation Text', TEXT_DOMAIN ),
			[ $this,'buz_prev_nav_text_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_prev_nav_text_el');
	
		/* Slider Speed */
		add_settings_field(
			'buz_slider_speed_el',
			__( 'Slider Speed', TEXT_DOMAIN ),
			[ $this,'buz_slider_speed_cb'],
			$this->plugin_name,
			'buz_slider_section');

		register_setting( $this->plugin_name, 'buz_slider_speed_el', [$this, 'buz_slider_speed_sanitize_input']);

	}


	public function buz_general_settings_section_cb(){

	}

	

	/* Display the input controls foe the google API settings */
	public function buz_google_api_cb(){
		$buz_google_api =  get_option('buz_google_api_el');
		
		$api_setup_link  = "Set the google API key here. ";
		$api_setup_link .= "<a target='_blank' href='".esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key')."'>";
		$api_setup_link .= "Click here to create a google API";
		$api_setup_link .= "</a>";

		?>
		<div class="ui input">
		 	<input class="regular-text" type="text" name="<?php echo 'buz_google_api_el'; ?>" value="<?php echo $buz_google_api; ?>" >
		</div>
		<p class="description"><?php _e($api_setup_link, TEXT_DOMAIN) ?></p>

		<?php
	}

	/* Display the input controls foe the google API settings */
	public function buz_google_logo_cb(){

		$buz_google_logo =  get_option('buz_google_logo_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_google_logo_el" name="buz_google_logo_el" value = "1" <?php echo 1 == $buz_google_logo ? 'checked' : ''; ?> >
			<label for="buz_google_logo_el"><?php _e('Toggle to Show or Hide option', TEXT_DOMAIN); ?></label>
		</div>
		<?php
	}

	/* Display the input controls foe the google API settings */
	public function buz_show_min_review_cb(){

		$buz_show_min_review =  get_option('buz_show_min_review_el'); 
		?>
		<select class="ui dropdown" name="buz_show_min_review_el" >
			<option value="1" <?php echo '1' == $buz_show_min_review ? 'SELECTED' : ''; ?>>1</option>
			<option value="2" <?php echo '2' == $buz_show_min_review ? 'SELECTED' : ''; ?>>2</option>
			<option value="3" <?php echo '3' == $buz_show_min_review ? 'SELECTED' : ''; ?>>3</option>
			<option value="4" <?php echo '4' == $buz_show_min_review ? 'SELECTED' : ''; ?>>4</option>
			<option value="5" <?php echo '5' == $buz_show_min_review ? 'SELECTED' : ''; ?>>5</option>
		</select>
		<p class="description"><?php _e('Minimum rating to display to the visitors', TEXT_DOMAIN) ?></p>
		<?php
	}
	/* Display the input controls foe the google API settings */
	public function buz_reviews_per_row_cb(){

		$buz_reviews_per_row =  get_option('buz_reviews_per_row_el'); 
		?>
		<select class="ui dropdown" name="buz_reviews_per_row_el" >
			<option value="1" <?php echo '1' == $buz_reviews_per_row ? 'SELECTED' : ''; ?>>1</option>
			<option value="2" <?php echo '2' == $buz_reviews_per_row ? 'SELECTED' : ''; ?>>2</option>
			<option value="3" <?php echo '3' == $buz_reviews_per_row ? 'SELECTED' : ''; ?>>3</option>
			<option value="4" <?php echo '4' == $buz_reviews_per_row ? 'SELECTED' : ''; ?>>4</option>
		</select>
		<p class="description"><?php _e('Display Number Of Reviews Per Row', TEXT_DOMAIN) ?></p>
		<?php
	}

	/* Display the input controls foe the google API settings */
	public function buz_company_review_star_cb(){

		$buz_company_review_star =  get_option('buz_company_review_star_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_company_review_star_el" name="buz_company_review_star_el" value = "1" <?php echo 1 == $buz_company_review_star ? 'checked' : ''; ?> >
			<label for="buz_company_review_star_el"> <?php _e('Toggle to Show or Hide option',TEXT_DOMAIN); ?> </label>
		</div>
		<?php
	}
	

	/* Display the input controls foe the google API settings */
	public function buz_toggle_company_name_cb(){

		$buz_toggle_company_name =  get_option('buz_toggle_company_name_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_toggle_company_name_el" name="buz_toggle_company_name_el" value = "1" <?php echo 1 == $buz_toggle_company_name ? 'checked' : ''; ?> >
			<label for="buz_toggle_company_name_el"><?php _e('Toggle to Show or Hide option', TEXT_DOMAIN); ?></label>
		</div>
		<?php
	}


	/* Display the input controls foe the google API settings */
	public function buz_toggle_see_all_cb(){
		$buz_toggle_see_all =  get_option('buz_toggle_see_all_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_toggle_see_all_el" name="buz_toggle_see_all_el" value = "1" <?php echo 1 == $buz_toggle_see_all ? 'checked' : ''; ?> >
			<label for="buz_toggle_see_all_el"><?php _e('Toggle to Show or Hide option', TEXT_DOMAIN) ?></label>
		</div>
		<?php
	}
	

	/* Display the input controls foe the google API settings */
	public function buz_show_pagination_cb(){
		$buz_show_pagination =  get_option('buz_show_pagination_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_show_pagination_el" name="buz_show_pagination_el" value = "true" <?php echo true == $buz_show_pagination ? 'checked' : ''; ?> >
			<label for="buz_show_pagination_el"><?php _e('Show/Hide Pagination Links', TEXT_DOMAIN) ?></label>
		</div>
		<?php
	}

	/* Display the input controls foe the google API settings */
	public function buz_show_navigation_cb(){
		$buz_show_navigation =  get_option('buz_show_navigation_el'); 
		?>
		<div class="ui toggle checkbox">
			<input type="checkbox" id="buz_show_navigation_el" name="buz_show_navigation_el" value = "true" <?php echo true == $buz_show_navigation ? 'checked' : ''; ?> >
			<label for="buz_show_navigation_el"><?php _e('Show/Hide Navigation Links', TEXT_DOMAIN); ?></label>
		</div>
		<?php
	}
	
	public function buz_company_name_cb(){
		$buz_company_name =  get_option('buz_company_name_el'); 
		?>
		<div class="ui input">
		 	<input required class="regular-text" type="text" name="<?php echo 'buz_company_name_el'; ?>" value="<?php echo $buz_company_name; ?>" >
		</div>
		<p class="description"><?php _e('Enter Google Business name.', TEXT_DOMAIN); ?></p>

		<?php
	}
	
	public function buz_prev_nav_text_cb(){
		$buz_prev_nav_text =  get_option('buz_prev_nav_text_el'); 
		?>
		<div class="ui input">
		 	<input required class="regular-text" type="text" name="<?php echo 'buz_prev_nav_text_el'; ?>" value="<?php echo $buz_prev_nav_text; ?>" >
		</div>
		<p class="description"><?php _e('Previous Navigation Text', TEXT_DOMAIN); ?></p>

		<?php
	}
	
	public function buz_next_nav_text_cb(){
		$buz_next_nav_text =  get_option('buz_next_nav_text_el'); 
		?>
		<div class="ui input">
		 	<input required class="regular-text" type="text" name="<?php echo 'buz_next_nav_text_el'; ?>" value="<?php echo $buz_next_nav_text; ?>" >
		</div>
		<p class="description"><?php _e('Next Navigation Text', TEXT_DOMAIN); ?></p>

		<?php
	}

	public function buz_slider_speed_cb(){
		$buz_slider_speed =  get_option('buz_slider_speed_el'); 
		?>
		<div class="ui input">
		 	<input required class="regular-text" min="100" type="number" name="<?php echo 'buz_slider_speed_el'; ?>" value="<?php echo $buz_slider_speed; ?>" >
		</div>
		<p class="description"><?php _e('Set the slider speed. Default is 1000', TEXT_DOMAIN); ?></p>

		<?php
	}

	public function buz_slider_speed_sanitize_input($input){
		$value =  trim($input);
		$value =  (int)$value;

		return is_int($value) ? $value : 1000;
	}

	public function buz_company_name_sanitize_input($input){
		$old_comp_name = get_option('buz_company_name_el');

		if($old_comp_name != $input){
			$this->buz_truncate_db_fc();
		} 

		return trim($input);
	}

	public function Buz_test($x){
		die($x);
	}


	public function buz_fetch_reviews(){

		$file = plugin_dir_path( __FILE__ ).'partials/templates/buz_review_rows.php';
        require_once plugin_dir_path( __FILE__ ) . '../includes/process/buz-functions.php';

		//Get DB Review Data
		$last_db_review    =  $this->buz_get_last_bd_review();
		$buz_db_review     =  buz_get_db_reviews();
		$output = [];
		$output['API_ERROR'] = '';
		$row_output = '';

		$output['query_mode'] = $_POST['query_mode'];

		//Normal Page Reload:
		if('fetch_db' == $_POST['query_mode']){
				//'DB Exists and equal to API => Fetch from BD'
				if(sizeof($buz_db_review) > 0){
					
					$output['updated_review_from_api']   = 'ignore';
 
					foreach( $buz_db_review as  $review){
						/* Get the templates contents */
						$response_template 		= file_get_contents($file, true);
						/* Overwrite the placeholder contents from the template file */
						$response_template 		= str_replace(NAME, $review->author_name , $response_template);
						$response_template 		= str_replace(ROW_ID, $review->ID , $response_template);
						$response_template 		= str_replace(PHOTO_URL, $review->profile_photo_url , $response_template);
						$response_template 		= str_replace(REVIEW_TEXT, $review->text , $response_template);
						$rating					= sprintf("%.1f", $review->rating);
						$response_template 		= str_replace(RATING, $rating , $response_template);
						$response_template 		= str_replace(DATE_DSC, $review->relative_time , $response_template);

						$checked 		   		= 'show' == buz_get_review_status($review->author_id) ? 'checked' : '';

						$toggle_status 			= '<div class="ui checkbox toggle">';
						$toggle_status 		   .= '<input type="checkbox" '.$checked.' class="show_hide_review" data-row_id = "'.$review->author_id.'"> <label></label>';
						$toggle_status 		   .= '</div>';

						$response_template 		= str_replace(TOGGLE_STATUS, $toggle_status , $response_template);

						$row_output			   .= $response_template;
					}

					set_buz_transient_data();
					
			}else{
					$output['API_ERROR'] 		= __('No reviews were found', TEXT_DOMAIN);
			}
		}
		//Fetch Query Clicked
		elseif('fetch_new' ==  $_POST['query_mode']){

			$buz_google_api 	= trim(get_option('buz_google_api_el'));
			$companyName 		= urlencode(get_option('buz_company_name_el'));

			$referenceObj 		= file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$companyName.'&sensor=true&key='.$buz_google_api);
			$data 				= json_decode($referenceObj);

			$referenceID   		= $data->results[0]->reference;

			$reviewsJson  		= file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?reference='.$referenceID.'&key='.$buz_google_api);
			$reviewsOBJ   		= json_decode($reviewsJson);

			$companyAddress		= $reviewsOBJ->result->formatted_address;
			$companyName		= $reviewsOBJ->result->name;
			$companyPhone		= $reviewsOBJ->result->international_phone_number;
			$companyRating		= $reviewsOBJ->result->rating;
			$companyReviews		= $reviewsOBJ->result->reviews;
			$queryStatus		= $reviewsOBJ->result->queryStatus;

			//Get the last row of the company review gotten from the API result
			$google_api_review = $companyReviews[4]->text;
			
			//If data was retrieved from the API request
		  if(sizeof($google_api_review) > 0){
				$buz_db_review = [];
				$last_db_review = [];
				$this->buz_truncate_db_fc();
				update_option('buz_reference_id', $referenceID);
				update_option('buz_company_rating', $companyRating);
 		  }  

		//Reviews is in DB and last DB review === API last review = Get reviews from DB and don't insert new one
		if(sizeof($buz_db_review) > 0 && strlen($reviewsOBJ->error_message) <= 0 && $last_db_review == $google_api_review ){
			
			//$output['status'] = 'DB Exists and equal to API => Fetch from BD';

			foreach( $buz_db_review as  $review){
				//Get the file template
				$response_template = file_get_contents($file, true);

				//Check if the reviews is allowed to be shown on the fron page
				$checked 		   = 'show' == buz_get_review_status($review->author_id) ? 'checked' : '';

				//Build the checkbox
				$toggle_status	   = '<div class="ui checkbox toggle">';
				$toggle_status 	  .= '<input type="checkbox" '.$checked.' class="show_hide_review" data-row_id = "'.$review->author_id.'"> <label></label>';
				$toggle_status    .= '</div>';

				//replace the constant placeholders with the values
				$response_template = str_replace(NAME, $review->author_name , $response_template);
				$response_template = str_replace(ROW_ID, $review->ID , $response_template);
				$response_template = str_replace(PHOTO_URL, $review->profile_photo_url , $response_template);
				$response_template = str_replace(REVIEW_TEXT, $review->text , $response_template);
				$response_template = str_replace(RATING, $review->rating , $response_template);
				$response_template = str_replace(DATE_DSC, $review->relative_time , $response_template);
				$response_template = str_replace(TOGGLE_STATUS, $toggle_status , $response_template);

				//conc the final output
				$row_output.= $response_template;
			}

			//Set the transient caching
			set_buz_transient_data();

		//'DB Exists But Not equal to API => Insert new Data'
		}elseif(sizeof($buz_db_review) > 0 && strlen($reviewsOBJ->error_message) <= 0 && $last_db_review != $google_api_review ){
				
				$this->buz_truncate_db_fc();

				foreach($companyReviews as  $review){

					//Get the file templates
					$response_template = file_get_contents($file, true);

					//Insert data into the database
					$insert_id = $this->buz_insert_data($review);

					$path_array			= explode('/', $review->author_url);
	 
					/* Configure the checkboxes */
					$checked 		   = 'checked';

					$toggle_status =  '<div class="ui checkbox toggle">';
					$toggle_status .= '<input type="checkbox" '.$checked.' class="show_hide_review" data-row_id = "'.$review->author_id.'"> <label></label>';
					$toggle_status .= '</div>';
		
					/* Replace the Placeholders */
					$response_template = str_replace(NAME, $review->author_name , $response_template);
					$response_template = str_replace(ROW_ID, $insert_id , $response_template);
					$response_template = str_replace(PHOTO_URL, $review->profile_photo_url , $response_template);
					$response_template = str_replace(REVIEW_TEXT, $review->text , $response_template);
					$response_template = str_replace(RATING, $review->rating , $response_template);
					$response_template = str_replace(DATE_DSC, $review->relative_time_description , $response_template);
					$response_template = str_replace(TOGGLE_STATUS, $toggle_status , $response_template);

					$row_output.= $response_template;
				}

				//Set the transient caching
				set_buz_transient_data();
			 
			//DB Not Exists And Not equal to API => Insert new Data'
			}elseif( sizeof($buz_db_review) <= 0 && strlen($reviewsOBJ->error_message) <= 0 && $last_db_review != $google_api_review ){

					foreach($companyReviews as  $review){
						//Get the file contents for the template
						$response_template = file_get_contents($file, true);

						//Insert data into the database
						$insert_id = $this->buz_insert_data($review);

						//get the author ID
						$path_array		   = explode('/', $review->author_url);

						$checked 		   =  'checked';

						$toggle_status     =  '<div class="ui checkbox toggle">';
						$toggle_status 	  .= '<input type="checkbox" '.$checked.' class="show_hide_review" data-row_id = "'.$review->author_id.'"> <label></label>';
						$toggle_status    .= '</div>';

						//Replace the placeholders
						$response_template = str_replace(NAME, $review->author_name , $response_template);
						$response_template = str_replace(ROW_ID,  $insert_id , $response_template);
						$response_template = str_replace(PHOTO_URL, $review->profile_photo_url , $response_template);
						$response_template = str_replace(REVIEW_TEXT, $review->text , $response_template);
						$response_template = str_replace(RATING, $review->rating , $response_template);
						$response_template = str_replace(DATE_DSC, $review->relative_time_description , $response_template);
						$response_template = str_replace(TOGGLE_STATUS, $toggle_status , $response_template);

						$row_output.= $response_template;
					}

					//Set the transient caching
					set_buz_transient_data();
			 
			//'DB Data Doesn\'t exits'
			}elseif(sizeof($buz_db_review) <= 0 &&  $last_db_review != $google_api_review && strlen($reviewsOBJ->error_message) >=1){
 				$output['API_ERROR'] = $reviewsOBJ->error_message;
			}else{
				$output['API_ERROR'] = $reviewsOBJ->error_message;
 			}
		}

		$output['review_row']  			= $row_output;
		$output['last_review']  		= $this->buz_get_bd_review();
		$output['reviews'] 				= $companyReviews;

		$output['transient_reviews'] 	= get_transient( 'buz_reviews_trans');

		wp_send_json($output);

	}


	public function buz_insert_data($review){
		
		global $wpdb;

		$table = $wpdb->prefix.'buz_google_reviews';

		$data = array(
			'author_name'		=> (string)trim($review->author_name),
			'author_id'		    => (string)trim($this->buz_get_author_id($review->author_url)),
			'profile_photo_url' => (string)$review->profile_photo_url, 
			'author_url' 		=> (string)$review->author_url, 
			'rating' 			=> (int)$review->rating, 
			'relative_time' 	=> (string)$review->relative_time_description, 
			'text' 				=> (string)$review->text); 
			 
		$format = array('%s','%s','%s','%s','%d', '%s','%s');

		$wpdb->insert($table,$data,$format);

		return $wpdb->insert_id;
	}

	public function buz_get_author_id($url){
		$path_array			= explode('/',$url);
		return $path_array[5];
	}

	public function buz_get_last_bd_review(){
		
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';
		$query 		 = "SELECT * FROM $table ORDER BY ID DESC LIMIT 1";
		$last_review = $wpdb->get_results($query);
		return $last_review[0]->text;

	}

	public function buz_get_bd_review(){
		
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';
		$query 		 = "SELECT * FROM $table";
		$result = $wpdb->get_results($query);

		return $result;

	}

	public function buz_get_author_name($name){
		
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';
		$query 		 = "SELECT * FROM $table WHERE `author_name` = '".$name."' LIMIT 1";
		$result 	 = $wpdb->get_results($query);

 		return sizeof($result) > 0 ? $result[0] : false;
	}

	public function buz_toggle_reviews(){
		
		global $wpdb;

		$check_status 	= $_POST['check_status'];
		$author_id 		= $_POST['author_id'];

		$table 			= $wpdb->prefix.'buz_google_reviews';

		$wpdb->update(
						$table, 
					array('status'=>$check_status), 
					array('author_id' => $author_id )
				);

				delete_transient('buz_reviews_trans');

		wp_send_json($check_status." ".$author_id);
	}


	public function buz_trauncate_db(){
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';

		$delete		 = $wpdb->query("TRUNCATE TABLE $table");

		wp_send_json($delete);
	}

	public function buz_truncate_db_fc(){
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';

		$wpdb->query("TRUNCATE TABLE $table");
	}

}
