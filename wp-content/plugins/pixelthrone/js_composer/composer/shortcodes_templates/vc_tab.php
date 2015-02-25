<?php
$output = $title = $tab_id = $style = '';
extract(shortcode_atts($this->predefined_atts, $atts));

wp_enqueue_script('jquery_ui_tabs_rotate');

/* Setting paddings*/
if ( isset($atts['pt_vc_padding_top']) || isset($atts['pt_vc_padding_right']) || isset($atts['pt_vc_padding_bottom']) || isset($atts['pt_vc_padding_left']) ) {
	$style  = 'style="';
	$style .= 'padding-top: '. (!isset($atts['pt_vc_padding_top']) || $atts['pt_vc_padding_top']>=0  ? (int)$atts['pt_vc_padding_top'].'px' : '') .'; ';
	$style .= 'padding-right: '. (!isset($atts['pt_vc_padding_right']) || $atts['pt_vc_padding_right']>=0 ? (int)$atts['pt_vc_padding_right'].'px' : '') .'; ';
	$style .= 'padding-bottom: '. (!isset($atts['pt_vc_padding_bottom']) || $atts['pt_vc_padding_bottom']>=0 ? (int)$atts['pt_vc_padding_bottom'].'px' : '') .'; ';
	$style .= 'padding-left: '. (!isset($atts['pt_vc_padding_left']) || $atts['pt_vc_padding_left']>=0 ? (int)$atts['pt_vc_padding_left'].'px' : '') .'; ';
	$style .= '"';
}

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_tab ui-tabs-panel wpb_ui-tabs-hide clearfix', $this->settings['base']);
$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'.$css_class.'" '. $style .'>';
$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');

echo $output;