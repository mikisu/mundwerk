<?php
$output = $el_class = $css_class = $css_class_outter = $css_style = $css_style_outter = $is_row = $before_output = $after_output = $animation_attr = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'pt_vc_padding_top' => '',
    'pt_vc_padding_bottom' => '',
    'pt_vc_bg_image' => '',
    'pt_vc_bg_color' => '',
    'pt_vc_text_color' => '',
    'pt_vc_parallax' => '',
    'pt_vc_full_width' => '',
    'pt_vc_dummy_textfield' => '',
    'css_animation' => '',
	'css_delay' => '',
	'pt_hidden_viewport' => '',
	'tablet_layout' => ''
), $atts));

if ( trim($pt_vc_dummy_textfield) === "vc_row" ) {
	$is_row = true;
} else {
	$is_row = false;
}

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
$el_class .= $this->getExtraClass($pt_hidden_viewport);

$tablet_layout = str_replace(',', ' ', $tablet_layout);
$el_class .= $this->getExtraClass($tablet_layout);


$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

if ($css_animation)
{
	$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
}

if ( $is_row ) {

	$css_style .= "padding-top: " . (int)$pt_vc_padding_top . "px; ";
	$css_style .= "padding-bottom: " . (int)$pt_vc_padding_bottom . "px; ";

	if ( $pt_vc_text_color ) {
		$css_style .= "color: " . $pt_vc_text_color . "; ";
	}

	if ( $pt_vc_bg_color ) {
		$css_style_outter .= "background-color: " . $pt_vc_bg_color . "; ";
	}

	if ( $pt_vc_bg_image ) {
		$image = wp_get_attachment_image_src( $pt_vc_bg_image, 'full' );
		$css_style_outter .= "background-image: url(" . $image[0] . "); ";

		$css_class_outter .= $this->getExtraClass('bg-cover');

		if ( $pt_vc_parallax=="Yes" ) {
			$css_class_outter .= $this->getExtraClass('parallax');
		}
	}

	$css_style = 'style="'. $css_style .'"';

	if ( $css_class_outter ) {
		$css_class_outter = 'class="'. $css_class_outter .'"';
	}

	if ( $pt_vc_full_width == "Yes" or $pt_vc_parallax=="Yes" or $pt_vc_bg_color or $pt_vc_bg_image )  $before_output .= "</div>";
		
	$before_output .= "<div ".$css_class_outter." style='".$css_style_outter."'>";
	if ( $pt_vc_full_width != "Yes" )  $before_output .= "<div class='container'>";

	//$after_output = "";
	$after_output .= "</div>";

	if ( $pt_vc_full_width != "Yes" ) 	$after_output .= "</div>";
	if ( $pt_vc_full_width == "Yes" or $pt_vc_parallax=="Yes" or $pt_vc_bg_color or $pt_vc_bg_image )  	$after_output .= "<div class='container'>";


	$output .= $before_output;
		$output .=  '<div class="'.$css_class.'" '.$css_style.' ' . $animation_attr . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>'.$this->endBlockComment('row');
	$output .= $after_output;
}
else {
	//$output .=  '<div class="container" role="main">';
	$output .=  '<div class="'.$css_class.'" '.$css_style.' ' . $animation_attr . '>';
	$output .= wpb_js_remove_wpautop($content);
	//$output .= '</div>';
	$output .= '</div>'.$this->endBlockComment('row');

}

echo $output;