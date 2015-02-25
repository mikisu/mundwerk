<?php

//global $pt_theme_options;

$pt_theme_options = get_option('pt_theme_options');

if ($pt_theme_options['vc_gallery'] != 1 ) 				wpb_remove("vc_gallery");
if ($pt_theme_options['vc_single_image'] != 1 ) 		wpb_remove("vc_single_image");
if ($pt_theme_options['vc_button'] != 1 ) 				wpb_remove("vc_button");
if ($pt_theme_options['vc_column_text'] != 1 ) 			wpb_remove("vc_column_text");
if ($pt_theme_options['vc_gmaps'] != 1 ) 				wpb_remove("vc_gmaps");
if ($pt_theme_options['vc_progress_bar'] != 1 ) 		wpb_remove("vc_progress_bar");

if ($pt_theme_options['vc_wp_rss'] != 1 ) 				wpb_remove("vc_wp_rss");
if ($pt_theme_options['vc_wp_archives'] != 1 ) 			wpb_remove("vc_wp_archives");
if ($pt_theme_options['vc_wp_search'] != 1 ) 			wpb_remove("vc_wp_search");
if ($pt_theme_options['vc_wp_meta'] != 1 ) 				wpb_remove("vc_wp_meta");
if ($pt_theme_options['vc_wp_recentcomments'] != 1 ) 	wpb_remove("vc_wp_recentcomments");
if ($pt_theme_options['vc_wp_calendar'] != 1 ) 			wpb_remove("vc_wp_calendar");
if ($pt_theme_options['vc_wp_pages'] != 1 ) 			wpb_remove("vc_wp_pages");
if ($pt_theme_options['vc_wp_tagcloud'] != 1 ) 			wpb_remove("vc_wp_tagcloud");
if ($pt_theme_options['vc_wp_custommenu'] != 1 ) 		wpb_remove("vc_wp_custommenu");
if ($pt_theme_options['vc_wp_text'] != 1 ) 				wpb_remove("vc_wp_text");
if ($pt_theme_options['vc_wp_posts'] != 1 ) 			wpb_remove("vc_wp_posts");
if ($pt_theme_options['vc_wp_links'] != 1 ) 			wpb_remove("vc_wp_links");
if ($pt_theme_options['vc_wp_categories'] != 1 ) 		wpb_remove("vc_wp_categories");

if ($pt_theme_options['vc_pie'] != 1 ) 					wpb_remove("vc_pie");
if ($pt_theme_options['vc_flickr'] != 1 ) 				wpb_remove("vc_flickr");
if ($pt_theme_options['vc_widget_sidebar'] != 1 ) 		wpb_remove("vc_widget_sidebar");
if ($pt_theme_options['vc_posts_slider'] != 1 ) 		wpb_remove("vc_posts_slider");
if ($pt_theme_options['vc_teaser_grid'] != 1 ) 			wpb_remove("vc_teaser_grid");
if ($pt_theme_options['vc_text_separator'] != 1 ) 		wpb_remove("vc_text_separator");
if ($pt_theme_options['vc_separator'] != 1 ) 			wpb_remove("vc_separator");
if ($pt_theme_options['vc_pinterest'] != 1 ) 			wpb_remove("vc_pinterest");
if ($pt_theme_options['vc_cta_button'] != 1 ) 			wpb_remove("vc_cta_button");

if ($pt_theme_options['vc_images_carousel'] != 1 ) 		wpb_remove("vc_images_carousel");
if ($pt_theme_options['vc_carousel'] != 1 ) 			wpb_remove("vc_carousel");
if ($pt_theme_options['vc_posts_grid'] != 1 ) 			wpb_remove("vc_posts_grid");
if ($pt_theme_options['vc_message'] != 1 ) 				wpb_remove("vc_message");


/* Remove content element from Visual Composer */

// wpb_remove("vc_accordion");
// wpb_remove("vc_video");
// wpb_remove("vc_raw_html");
// wpb_remove("vc_raw_js");
// wpb_remove("vc_twitter");
// wpb_remove("vc_facebook");
// wpb_remove("vc_tweetmeme");
// wpb_remove("vc_googleplus");
// wpb_remove("vc_tab");
// wpb_remove("vc_tabs");
// wpb_remove("vc_toggle");
// wpb_remove("vc_tour");
