<?php
//overwrites composer size_arr
$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;

 
$size_arr = array(  __("Normal", "js_composer") => "btn-normal", __("Large", "js_composer") => "btn-large", __("Small", "js_composer") => "btn-small"); 

$pt_array_text_align = array("left"=>"text-left", "center"=>"text-center", "right"=>"text-right");

$pt_social_networks = array('Select a Social Network', 'fivehundredpx', 'aboutme', 'addme', 'amazon', 'aol', 'appstorealt', 'appstore', 'apple', 'bebo', 'behance', 'bing', 'blip', 'blogger', 'coroflot', 'daytum', 'delicious', 'designbump', 'designfloat', 'deviantart', 'diggalt', 'digg', 'dribble', 'drupal', 'ebay', 'email', 'emberapp', 'etsy', 'facebook', 'feedburner', 'flickr', 'foodspotting', 'forrst', 'foursquare', 'friendsfeed', 'friendstar', 'gdgt', 'github', 'githubalt', 'googlebuzz', 'googleplus', 'googletalk', 'gowallapin', 'gowalla', 'grooveshark', 'heart', 'hyves', 'icondock', 'icq', 'identica', 'imessage', 'itunes', 'lastfm', 'linkedin', 'meetup', 'metacafe', 'mixx', 'mobileme', 'mrwong', 'msn', 'myspace', 'newsvine', 'paypal', 'photobucket', 'picasa', 'pinterest', 'podcast', 'posterous', 'qik', 'quora', 'reddit', 'retweet', 'rss', 'scribd', 'sharethis', 'skype', 'slashdot', 'slideshare', 'smugmug', 'soundcloud', 'spotify', 'squidoo', 'stackoverflow', 'star', 'stumbleupon', 'technorati', 'tumblr', 'twitterbird', 'twitter', 'viddler', 'vimeo', 'virb', 'www', 'wikipedia', 'windows', 'wordpress', 'xing', 'yahoobuzz', 'yahoo', 'yelp', 'youtube', 'instagram');

$pt_css_animation_list = array(
	__("No", "js_composer") => '',

	__("fadeIn", "js_composer") => "fadeIn",
	__("fadeInUp", "js_composer") => "fadeInUp",
	__("fadeInDown", "js_composer") => "fadeInDown",
	__("fadeInLeft", "js_composer") => "fadeInLeft",
	__("fadeInRight", "js_composer") => "fadeInRight",

	__("bounceIn", "js_composer") => "bounceIn",
	__("bounceInDown", "js_composer") => "bounceInDown",
	__("bounceInUp", "js_composer") => "bounceInUp",
	__("bounceInLeft", "js_composer") => "bounceInLeft",
	__("bounceInRight", "js_composer") => "bounceInRight",

	__("rotateIn", "js_composer") => "rotateIn",
	__("rotateInDownLeft", "js_composer") => "rotateInDownLeft",
	__("rotateInDownRight", "js_composer") => "rotateInDownRight",
	__("rotateInUpLeft", "js_composer") => "rotateInUpLeft",
	__("rotateInUpRight", "js_composer") => "rotateInUpRight",

	__("flip", "js_composer") => "flip",
	__("flipInX", "js_composer") => "flipInX",
	__("flipInY", "js_composer") => "flipInY",

	__("lightSpeedIn", "js_composer") => "lightSpeedIn",
	__("lightSpeedOut", "js_composer") => "lightSpeedOut",
	__("hinge", "js_composer") => "hinge",
	__("rollIn", "js_composer") => "rollIn",
	__("rollOut", "js_composer") => "rollOut",

);

$pt_css_animation = array(
	"type" => "dropdown",
	"heading" => __("CSS Animation", "js_composer"),
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => $pt_css_animation_list,
	"description" => __('Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers. <a href="https://daneden.me/animate/" target="_blank">Browse the animation effects gallery.</a>', "js_composer")
);

$pt_css_delay = array(
	"type" => "textfield",
	"heading" => __("Animation delay", "js_composer"),
	"param_name" => "css_delay",
	"admin_label" => true,
	"description" => __("You can set a delay for the animation in seconds.", "js_composer")
);


$pt_hidden_viewport = array(
	"type" => "checkbox",
	"heading" => __("Hidden Viewport", "js_composer"),
	"param_name" => "pt_hidden_viewport",
	"value" => array ("Hidden Phone" => "hidden-phone", "Hidden Tablet" => "hidden-tablet", "Hidden Desktop" => "hidden-desktop"),
	"description" => ""
	);

$pt_ExtraClass  = array(
	"type" => "textfield",
	"heading" => __("Extra class name", "js_composer"),
	"param_name" => "el_class",
	"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	);

// NEW OPTION

$pt_DesignOptions  = array(
        "type" => "css_editor",
        "heading" => __('Css', "js_composer"),
        "param_name" => "css",
        // "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
        "group" => __('Design options', 'js_composer')
      );
      


/* Load Shortcodes */

require_once("shortcodes/pt_alertblock.php");
require_once("shortcodes/pt_animated_text.php");
require_once("shortcodes/pt_audio.php");
require_once("shortcodes/pt_button_share.php");
require_once("shortcodes/pt_buttons.php");
//require_once("shortcodes/pt_clients.php");
require_once("shortcodes/pt_contact_form.php");
//require_once("shortcodes/pt_contact_form_mini.php");
require_once("shortcodes/pt_countdown.php");
require_once("shortcodes/pt_counter.php");
require_once("shortcodes/pt_fold_buttons.php");
require_once("shortcodes/pt_gallery.php");
require_once("shortcodes/pt_gmaps.php");
//require_once("shortcodes/pt_heading.php");
require_once("shortcodes/pt_icon_effects.php");
//require_once("shortcodes/pt_icon_text.php");
require_once("shortcodes/pt_icon_text_block.php");
require_once("shortcodes/pt_icon_text_list.php");
require_once("shortcodes/pt_icons.php");
require_once("shortcodes/pt_labels.php");
require_once("shortcodes/pt_marginblock.php");
require_once("shortcodes/pt_newsletter_form.php");
require_once("shortcodes/pt_pie_chart.php");
//require_once("shortcodes/pt_portfolio.php");
//require_once("shortcodes/pt_posts.php");
require_once("shortcodes/pt_pricing_tab.php");
require_once("shortcodes/pt_progress_bar.php");
require_once("shortcodes/pt_rules_horizontal.php");
require_once("shortcodes/pt_rules_vertical.php");
require_once("shortcodes/pt_single_image.php");
require_once("shortcodes/pt_social_icons.php");
require_once("shortcodes/pt_social_icons_row.php");
require_once("shortcodes/pt_team.php");
require_once("shortcodes/pt_testimonials.php");
require_once("shortcodes/pt_testimonials_image.php");
require_once("shortcodes/pt_testimonials_balloon.php");
require_once("shortcodes/pt_text.php");
require_once("shortcodes/pt_thumbs_gallery.php");
require_once("shortcodes/pt_twitter_feed.php");


/* Load VC Extend */

require_once("vc_extend/vc_accordion.php");
require_once("vc_extend/vc_accordion_tab.php");
require_once("vc_extend/vc_column.php");
require_once("vc_extend/vc_row.php");
require_once("vc_extend/vc_row_inner.php");
require_once("vc_extend/vc_tab.php");
require_once("vc_extend/vc_tabs.php");
require_once("vc_extend/vc_tour.php");
