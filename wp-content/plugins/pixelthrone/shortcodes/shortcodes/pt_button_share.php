<?php

class WPBakeryShortCode_pt_button_share extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'text_button' => '',
			'text' => '',
			'color' => '',
			'bgcolor' => '',
			'bgopacity' => '',
			'el_class' => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$uniq_id = 'ls-'.uniqid();

		$style .= '<style type="text/css">';
		$style .= '#'.$uniq_id.'.lightwindow-share {';
		if ( trim($bgcolor) ) {
			$style .= 'background-color: rgba('. pt_hex2rgb($bgcolor) .', ' . $bgopacity/100 . '); ';
		}
		if ( trim($color) ) {
			$style .= 'color: '. $color .'; ';
		}
		$style .= '}';

		$style .= '#'.$uniq_id.'.lightwindow-share ul.share a, #'.$uniq_id.'.lightwindow-share .close {';
		if ( trim($color) ) {
			$style .= 'color: '. $color .'; ';
		}
		$style .= '}';

		$style .= '</style>';

		$output = $style;

		$output .= '<div ' . $animation_attr . '><a href="#" class="bt-share '. $el_class .'" data-action="open-lightwindow" data-target=".lightwindow-share" data-title="' . $text . '" data-id="' . $uniq_id . '"><i class="ion-share"></i> <small>' . $text_button . '</small></a></div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_button_share",
	"name"      => __("Share Button", "js_composer"),
	"class"     => "",
	"icon"      => " fa fa-share-square",
	"category"  => __('Buttons', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"heading" => __("Text on button", "js_composer"),
			"param_name" => "text_button",
			"value" => 'Share', //Default color
			"description" => __("Text show next to button", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Text inside", "js_composer"),
			"param_name" => "text",
			"value" => 'Share on', //Default color
			"description" => __("Text inside lightwindow", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Text Color inside lightwindow", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Background color", "js_composer"),
			"param_name" => "bgcolor",
			"value" => '', //Default color
			"description" => __("Background Color inside lightwindow", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Background Opacity", "js_composer"),
			"param_name" => "bgopacity",
			"value" => '', //Default color
			"description" => __("Background Opacity inside lightwindow. Only numbers (0-100)", "js_composer")
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
	)
) );
