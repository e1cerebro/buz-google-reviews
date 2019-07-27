<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/admin/partials
 */


function buz_admin_tabs( $current = 'homepage' ) {
    $tabs = array( 'homepage' => 'Home Settings', 'general' => 'General', 'footer' => 'Footer' );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : ’;
        echo "<a class='nav-tab$class' href='?page=theme-settings&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}


?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
<?php settings_errors(); ?>
    <h1><?php echo get_admin_page_title(); ?></h1>
    <hr/>
    
    <?php
//we check if the page is visited by click on the tabs or on the menu button.
//then we get the active tab.
$active_tab = "buz_general_settings";

if(isset($_GET["tab"]))
{
    if($_GET["tab"] == "buz_general_settings")
    {
        $active_tab = "buz_general_settings";
    }
    else
    {
        $active_tab = "buz_google_reviews";
    }
}
?>

<!-- wordpress provides the styling for tabs. -->
 <h2 class="nav-tab-wrapper">
<!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
 <a href="?page=<?php echo $this->plugin_name; ?>&tab=buz_general_settings" class="nav-tab <?php if($active_tab == 'buz_general_settings'){echo 'nav-tab-active';} ?> "><?php _e('General', 'buz-google-reviews'); ?></a>
<a href="?page=<?php echo $this->plugin_name; ?>&tab=buz_google_reviews" class="nav-tab <?php if($active_tab == 'buz_google_reviews'){echo 'nav-tab-active';} ?>"><?php _e('Reviews', 'buz-google-reviews'); ?></a>
</h2> 


    <form method="post" action="options.php">
        <?php
                

                if("buz_general_settings" == $active_tab)
                {
                    settings_fields($this->plugin_name);
                    do_settings_sections($this->plugin_name);
                    submit_button(); 
                } elseif("buz_google_reviews" == $active_tab) {

                    ?>
                <br/>

                <div class="buz-loading-gif">
                    <img width="250" height="auto" src="<?php echo LOADING_IMAGE_PATH; ?>" alt="Loading Review">
                </div>

                <table class="ui compact celled definition table hide-element" id="buz_reviews_tb">
                    <thead class="full-width">
                        <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Text</th>
                        <th>Rating</th>
                        <th>Date</th>
                        <th>Show/Hide</th>
                        </tr>
                    </thead>
                    <tbody id="buz_table_body">

                    </tbody>
                
                </table>
                <hr/>
                <input type="button" name="fetch-reviews" id="fetch-reviews" class="button button-primary" value="Fetch Reviews"> &nbsp;
                <input type="button" name="delete-all-reviews" id="delete_all_reviews" class="button button-secondary right" value="Delete All Reviews">
                
                <div class="ui warning message buz_message hide-element">
                    <i class="close icon"></i>
                    <div class="header">
                        No reviews were found!
                    </div>
                 </div>
               <?php

                
                }
            
        ?>
</form>


</div>