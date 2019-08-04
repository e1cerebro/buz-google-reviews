=== WP Google Business Reviews ===
Contributors: nwachuku
Donate link: #
Tags: reviews, google, business reviews, google reviews, google ratings, ratings, customer ratings
Requires at least: 3.0.1
Tested up to: 5.2
Stable tag: 5.2
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Google Business Reviews was designed to display the google customers ratings on your website using shortcodes.

== Description ==

WP Google Business Reviews was designed to display the google customers ratings on your website using shortcodes.

To display the google reviews you will need Google API and the Google business name.

A few notes about the sections above:

*   "Contributors" is a comma separated list of wp.org/wp-plugins.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `buz-google-reviews.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= How to display reviews on my website? =

To display the reviews on your webiste, use the following shortcodes. [gbr_reviews]

= Can I modify the display based on shortcode parameters? =

You can use the following shortcodes to modify the display.

* cols (Default Params = 1)
* display_google_logo (Acceptable Values are true or false)
* display_company_name (Acceptable Values are true or false)
* display_total_rating (Acceptable Values are true or false)
* display_see_all_button (Acceptable Values are true or false)

**NOTE: Any changes made through the shortcode parameters has a higher precedence over the settings made on the settings page**

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot
