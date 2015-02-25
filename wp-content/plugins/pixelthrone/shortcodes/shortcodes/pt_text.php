<?php

class WPBakeryShortCode_pt_text extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'color'					=> '',
			'el_class'				=> '',
			'css_animation'			=> '',
			'css_delay'				=> '',
			'pt_hidden_viewport' 	=> '',
			'css' 					=> ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);

		$el_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_text_column wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
		$el_class .= $this->getCSSAnimation($css_animation);
		
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output  = '<div class="pt_text_shortcode '. $el_class .'" style="color:' . $color . ';" ' . $animation_attr . '>' . wpb_js_remove_wpautop($content) . '</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_text",
	"name"      => __("Text", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-font",
	"category"  => __('Typography', 'js_composer'),
	"params"    => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", "js_composer"),
			"param_name" => "content",
			"value" => __("<p>Your Text here</p>", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Pick text color", "js_composer"),
			"edit_field_class" => "textColorClass",
			
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		$pt_ExtraClass,
		$pt_DesignOptions,
		)
) );