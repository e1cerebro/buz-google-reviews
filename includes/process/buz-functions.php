<?php

    function buz_get_review_status($author_id){
            
        global $wpdb;
        $table 		 = $wpdb->prefix.'buz_google_reviews';
        $query 		 = "SELECT * FROM $table WHERE `author_id` = '".$author_id."' LIMIT 1";
        $result = $wpdb->get_results($query);

        return $result[0]->status;
    }