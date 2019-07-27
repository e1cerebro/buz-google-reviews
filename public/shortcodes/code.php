<?php

    add_shortcode('g_reviews', 'buz_show_reviews');

    function buz_show_reviews($attr){
        extract(shortcode_atts(array(
             'cols'            => '-1',
             ), $attr));

        if(sizeof(get_transient('buz_reviews_trans') <= 1)){
            global $wpdb;
            $table 		 = $wpdb->prefix.'buz_google_reviews';
            $query 		 = "SELECT * FROM $table ORDER BY ID DESC";
            
            $reviews = $wpdb->get_results($query);
        }else{
            $reviews = get_transient( 'buz_reviews_trans');
        }

        require_once plugin_dir_path( __FILE__ ) . '../../includes/process/buz-functions.php';


  ?>
  <div class="buz-reviews-public">
          <div class="buz_review_header" id="buz_review_header"
                data-cols = <?php echo $cols; ?>>
                <?php if(1 == get_option('buz_google_logo_el')): ?>
                    <img width="205" src="<?php  echo GOOGLE_IMAGE_PATH; ?>" alt="Powered by Google">
                <?php endif; ?>
                <?php if(1 == get_option('buz_toggle_company_name_el')): ?>
                    <p class="buz_rating_text">  <a  target="_blank" href="https://search.google.com/local/reviews?placeid=<?php echo get_option('buz_reference_id'); ?>">  <span class="buz-company-name"><?php echo get_option('buz_company_name_el'); ?></span></a> </p>
                <?php endif; ?>
                <?php if(1 == get_option('buz_company_review_star_el')): ?>
                <p class="buz_header_star"><?php echo sprintf("%.1f", get_option('buz_company_rating')); ?> <span class="Stars buz-header-stars" style="--rating: <?php echo get_option('buz_company_rating'); ?> ;" aria-label="Rating of this product is <?php echo get_option('buz_company_rating'); ?> out of 5."></span></p>
                <?php endif; ?>    
            </div>

              <div class="testimonial-slider" class="owl-carousel">

                <?php foreach( $reviews as  $review): ?>
                    <?php if('show' == buz_get_review_status($review->author_id)): ?>
                    <div class="testimonial">
                        <div class="pic">
                            <img src="<?php echo $review->profile_photo_url; ?>">
                        </div>

                        <?php
                            $review_text = trim($review->text);
                        ?>
                        <?php echo sprintf("%.1f", $review->rating); ?> <span class="Stars" style="--rating: <?php echo  $review->rating; ?> ;" aria-label="Rating of this product is <?php echo  $review->rating; ?> out of 5."></span> 
                        <p class="description more">
                        <?php echo  $review_text; ?>
                        </p>
 
    
                        <h3 class="title"><?php echo $review->author_name; ?>  </h3>
                        <small class="post"> - <?php echo ucfirst($review->relative_time); ?> </small>
                    </div>
                    <?php endif; ?>
                <?php  endforeach; ?>
 
                </div>
                <div class="buz_footer_text">
                    <?php if(1 == get_option('buz_toggle_see_all_el')): ?>
                        <a class="buz-see-all" target="_blank" href="https://search.google.com/local/reviews?placeid=<?php echo get_option('buz_reference_id'); ?>"> See All Reviews</a>
                    <?php endif; ?>
                </div>
    </div>
  <?php
       
    }