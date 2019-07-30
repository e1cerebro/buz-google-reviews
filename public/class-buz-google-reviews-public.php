<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/public
 * @author     Uchenna Nwachukwu <nwachukwu16@gmail.com>
 */
class Buz_Google_Reviews_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buz-google-reviews-public.css', array(), $this->version, 'all' );

		//wp_enqueue_style( $this->plugin_name.'-bootstrap-css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" , array(), time() );
		//wp_enqueue_style( $this->plugin_name.'-fontawesome-css', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  , array(), time() );
		wp_enqueue_style( $this->plugin_name.'-carousel-css', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css", array(), time() );
		wp_enqueue_style( $this->plugin_name.'-theme-css', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css", array(), time() );

 
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buz-google-reviews-public.js', array( 'jquery' ),time(), false );
		wp_enqueue_script( $this->plugin_name.'-car-js', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js", array( 'jquery' ), '', false );
		wp_enqueue_script( $this->plugin_name.'-more-js', "https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.2.0/readmore.min.js", array( 'jquery' ), '', false );
		
		wp_localize_script($this->plugin_name, 
		'buz_vars',
			[
				'ajax_url' 				     => admin_url('admin-ajax.php'),
				'reviews_per_row' 		     => get_option('buz_reviews_per_row_el'),
				'buz_show_pagination_el' 	 => get_option('buz_show_pagination_el'),
				'buz_show_navigation_el' 	 => get_option('buz_show_navigation_el'),
				'buz_next_nav_text_el' 	 	 => get_option('buz_next_nav_text_el'),
				'buz_prev_nav_text_el' 	 	 => get_option('buz_prev_nav_text_el'),
				'buz_slider_speed_el' 	 	 => get_option('buz_slider_speed_el')
			]
		);
 
	}

	public function bgr_testing_cb(){
		/* $CompanyName  = urlencode('EasyFold Canada - Portable Power Wheelchair');
		$api          = 'AIzaSyAzK4xc9_rlfT4rKvaOWdLRFWLGUlcVLD0';
		
		//$referenceObj = file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$CompanyName.'&sensor=true&key='.$api);
		$data = json_decode($referenceObj);
		$referencID   = $data->results[0]->reference;
		//$reviewsJson  = file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?reference='.$referencID.'&key='.$api);
		 */
		//$reviewsOBJ   	= json_decode($reviewsJson);

		/* $results = [];
		$companyAddress = $reviewsOBJ->result->formatted_address;
		$companyName	= $reviewsOBJ->result->name;
		$companyPhone	= $reviewsOBJ->result->international_phone_number;
		$companyRating	= $reviewsOBJ->result->rating;
		$companyReviews	= $reviewsOBJ->result->reviews;
		$queryStatus	= $reviewsOBJ->result->status;

		$results        = [
				'companyAddress' => $companyAddress,
				'companyName'    => $companyName,
				'companyPhone'   => $companyPhone,
				'companyRating'  => $companyRating,
				'companyReviews' => $companyReviews,
				'queryStatus'    => $queryStatus
		]; */
		
		/* echo "<pre>";
			//print_r($results);
		echo "</pre>" */;


		//SELECT * FROM [TABLE] ORDER BY ID DESC LIMIT 1;
		global $wpdb;

		$table = $wpdb->prefix.'buz_google_reviews';

		$data = array(
			'author_name'		=> 'John Doe', 
			'profile_photo_url' => '', 
			'rating' 			=> 5, 
			'relative_time' 	=> '3 Months', 
			'text' 				=> 'Nice'); 
			//'status' 			=> 123);
			$format = array('%s','%s','%d', '%s','%s');

			//$status = $wpdb->insert($table,$data,$format);

			//die($status);

	}


	public function buz_get_reviews(){
		
    	require_once plugin_dir_path( __FILE__ ) . '../includes/process/buz-functions.php';
		$file = plugin_dir_path( __FILE__ ).'templates/buz-reviews.php';
		global $wpdb;
		$table 		 = $wpdb->prefix.'buz_google_reviews';
		$query 		 = "SELECT * FROM $table ORDER BY ID DESC";
        
		$reviews = $wpdb->get_results($query);
		$row = '';
		foreach( $reviews as  $review){
			$response_template = file_get_contents($file, true);

			$response_template = str_replace(PROFILE_PICS_URL, $review->profile_photo_url , $response_template);
			$response_template = str_replace(REVIEW_RATING, sprintf("%.1f", $review->rating) , $response_template);
			$review_text = trim($review->text);
			$response_template = str_replace(REVIEW_TEXT, $review_text , $response_template);
			$response_template = str_replace(AUTHOR_NAME, $review->author_name , $response_template);
			$response_template = str_replace(REVIEW_TIME, ucfirst($review->relative_time)  , $response_template);


			$row .= $response_template;
		}
		

		wp_send_json($row);



	}

}
