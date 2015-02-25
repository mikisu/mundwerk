<?php
$output = $title = $interval = $el_class = '';

extract(shortcode_atts(array(
	'title' => '',
	'interval' => 0,
	'el_class' => '',
	'position' => '',
	'font_icons' => '',
	'color' => '',
	'pt_vc_padding_top' => '',
	'pt_vc_padding_right' => '',
	'pt_vc_padding_bottom' => '',
	'pt_vc_padding_left' => '',
	'template' => ''
	), $atts));


wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

// Extract tab icons
$font_icons_aux = explode('[/vc_tab]', $content);

// remove empty key
unset($font_icons_aux[count($font_icons_aux)-1]);

// extract icon code
foreach ($font_icons_aux as $key => $value) {
	$font_icons[$key] = explode('font_icons="', $value);

	if ( isset($font_icons[$key][1]) ) {
		$font_icons[$key] = explode('"]', $font_icons[$key][1]);
		$font_icons[$key] = $font_icons[$key][0];
	} else {
		$font_icons[$key] = null;
	}
}

$id = "tabs-".uniqid();

if ( $color ) {
	$output .= '<style type="text/css" media="screen">';
	if ( 'vc_tour' == $this->shortcode) {
	//VC_TOUR
		$output .='
		.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li:hover { border-color: '. $color .'; }
		.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li:hover a { color: '. $color .'; }
		.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active:hover a { color: #FFFFFF; }
		.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active { background-color: '. $color .'; border-color: '. $color .'; }';
		if ($position=='right') {
			$output .= '.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active:after { border-color: transparent '. $color .' transparent transparent; }';
		} else {
			$output .= '.wpb_tour.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active:after { border-color: transparent transparent transparent '. $color .'; }';
		}
	} else {
	//VC_TABS
		if ($position=='bottom') {
			$output .='.wpb_tabs.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active { border-color: #ffffff transparent '. $color .'; }';
		} else {
			$output .='.wpb_tabs.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active { border-color: '. $color .' transparent #ffffff transparent; }';
		}
		$output .='.wpb_tabs.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active a i { color: '. $color .'; }
		.template1.wpb_content_element ul#'.$id.'.wpb_tabs_nav li.ui-tabs-active a i { border-color: '. $color .'; }
		.template1.wpb_content_element ul#'.$id.'.wpb_tabs_nav li:not(.ui-tabs-active) a:hover i { background-color: '. $color .'; }
		';
	}
	$output .= '</style>';
}

/* Tabs Bottom */
if ($position=='bottom') {
	$output .= ' <script>jQuery(function() { jQuery( "#'.$id.'.ui-tabs-nav" ).appendTo( jQuery( "#'.$id.'.ui-tabs-nav" ).parent(".ui-tabs") ); });</script>';
}


/**
 * vc_tabs
 *
 */

global $page_data;
$page_options = get_fields($page_data->ID);

if ( isset($page_options['bg_color']) && $template == 1 ) {
	echo '<style type="text/css" media="screen">
	.wpb_tabs.wpb_content_element.template1 ul#'.$id.' li a i { color: '. $page_options['bg_color'] .'; }
	.wpb_tabs.wpb_content_element.template1 ul#'.$id.' li:not(.ui-tabs-active) a i { color: rgba(' . pt_hex2rgb($page_options['bg_color']) . ', 0.7);
	</style>';

	//.wpb_tabs.wpb_content_element.template1 ul#'.$id.' li:not(.ui-tabs-active) a i { color: rgba(' . pt_hex2rgb($page_options['bg_color']) . ', ' . ($page_options['bg_opacity']/100) . ');
}

if ( isset($matches[0]) ) { $tab_titles = $matches[0]; $calc_li = 100 / count($matches[0]);}
$tabs_nav = '';
$tabs_nav .= '<ul id="'. $id .'" class="wpb_tabs_nav ui-tabs-nav clearfix">';
foreach ( $tab_titles as $key=>$tab ) {
	preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
	if(isset($tab_matches[1][0])) {
		if ($template==1) {
			$tabs_nav .= '<li style="width:'.$calc_li.'%"><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">'. ($font_icons[$key] ? '<i class="'. $font_icons[$key] .'"></i>' : '') .'  <h3>'. $tab_matches[1][0] . '</h3></a></li>';
		}
		else{
			$tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . ($font_icons[$key] ? '<i class="'. $font_icons[$key] .' pull-left"></i>' : '') .'  <span>'. $tab_matches[1][0] . '</span></a></li>';
		}
	}
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);

$output .= "\n\t".'<div class="pt-tab-'. $position .' template'. $template .' '.$css_class.'" data-interval="'.$interval.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs clearfix">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
if ( 'vc_tour' == $this->shortcode) {
	$output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
}
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($element);

echo $output;