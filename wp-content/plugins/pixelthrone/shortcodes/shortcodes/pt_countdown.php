<?php

class WPBakeryShortCode_pt_countdown extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $icon_color = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'date'       => '',
			'text_align' => '',
			'el_class'  => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => '',
			'text_color' => '',
			'box_color' => '',
			
			
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}


		$output = "";

		$ShortID = "ShortID_".uniqid();
		if ( $text_color or $box_color) {

			$output .= '<style>';

			if ( $text_color ) {
				$output .= '
				.'.$ShortID.'.pt-countdown div {
					background-color: rgba(' . pt_hex2rgb($box_color) . ',1);
				}';
			}

			if ( $text_color) {
				$output .= '
				.'.$ShortID.'.pt-countdown  {
					color: rgba(' . pt_hex2rgb($text_color) . ',1);
				}';
			}

			$output .= '</style>';

		}


		$output .= '<div class="'.$ShortID.' pt-countdown '. $text_align  . $el_class .'" data-countdown="'. $date .'" ' . $animation_attr . '></div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_countdown",
	"name"      => __("Countdown", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-clock-o",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield", //Dummy textfield Pixelthrone. Just change the value to the desired class
			"param_name" => "pt_vc_dummy_textfield", // don't touch
			"value"=> "pt_countdown_dummy" // class name
			),
		array(
			"type" => "textfield",
			"holder" => "span",
			"class" => "",
			"heading" => __("Date", "js_composer"),
			"param_name" => "date",
			"value" => "2013/12/25",
			"description" => __("Date (format: yyyy/mm/dd)", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Box Color", "js_composer"),
			"param_name" => "box_color",
			"value" => '', 
			"description" => __("Pick text color", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "text_color",
			"value" => '', 
			"description" => __("Pick text color", "js_composer")
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select text align", "js_composer"),
			"param_name" => "text_align",
			"value" => $pt_array_text_align,
			"description" => ''
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)
) );