<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1',
    'template' => '1',
    'color' => ''
), $atts));

$id = "accordion-".uniqid();

if ( $color ) {
	$output .= '<style type="text/css" media="screen">';
	if ( $template==1 ) {
		$output .=' #'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.wpb_accordion_header:hover,
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.wpb_accordion_header:focus { border-color: '. $color .'; }
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.wpb_accordion_header:hover a,
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.wpb_accordion_header:focus a,
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.wpb_accordion_header:hover i,
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.ui-accordion-header-active a i,
		#'.$id.'.wpb_accordion.template1 .wpb_accordion_wrapper h3.ui-accordion-header-active a { color: '. $color .'; }';
	}
	if ( $template==2 ) {
		$output .= '#'.$id.'.wpb_accordion.template2 h3:hover a,
		#'.$id.'.wpb_accordion.template2 h3.ui-accordion-header-active a { color: '. $color .'; }
		#'.$id.'.wpb_accordion.template2 .wpb_accordion_wrapper h3.ui-state-default .ui-icon,
		#'.$id.'.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon { color: '. $color .'; }
		#'.$id.'.wpb_accordion.template2 .wpb_accordion_wrapper h3 span.ui-accordion-header-icon:before { color: '. $color .'; }';
	}
	$output .= '</style>';
}

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element '.$el_class.' not-column-inherit'.' template'.$template, $this->settings['base']);

$output .= "\n\t".'<div id="'. $id .'" class="'.$css_class.'" data-collapsible='.$collapsible.' data-active-tab="'.$active_tab.'">'; //data-interval="'.$interval.'"
$output .= "\n\t\t".'<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');

echo $output;