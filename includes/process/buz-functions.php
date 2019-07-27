<?php

    function buz_get_review_status($author_id){
            
        global $wpdb;
        $table 		 = $wpdb->prefix.'buz_google_reviews';
        $query 		 = "SELECT * FROM $table WHERE `author_id` = '".$author_id."' LIMIT 1";
        $result = $wpdb->get_results($query);

        return $result[0]->status;
    }

    function set_buz_transient_data(){
        delete_transient('buz_reviews_trans');
        $reviews = buz_get_db_reviews();
        set_transient( 'buz_reviews_trans', $reviews , 604800 );
    }

    function get_buz_transient_data(){
        get_transient( 'buz_reviews_trans');
    }

	function buz_get_db_reviews(){
		
        global $wpdb;
        
		$table 		 = $wpdb->prefix.'buz_google_reviews';
		$query 		 = "SELECT * FROM $table";
		$result = $wpdb->get_results($query);

		return $result;

	}