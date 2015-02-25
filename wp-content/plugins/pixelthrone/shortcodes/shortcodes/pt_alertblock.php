<?php

/* Alert Block

<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h5>Warning!</h5>Best check yo self, you're not...</div>

<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>

<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Well done!</strong> You successfully read this important alert message.</div>

<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><strong>Heads up!</strong> This alert needs your attention, but it's not super important.</div>
*/

class WPBakeryShortCode_pt_alertblock extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'title' => '',
			'alert_type' => 'alert-block',
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

		$output =  '<div class="alert '. $alert_type . $el_class.'"' . $animation_attr . '><button type="button" class="close" data-dismiss="alert">×</button>';

		if ( $alert_type == "alert-block") {
			$output .= '<h2>'.wpb_js_remove_wpautop($title).'</h2>';
		}else{
			$output .= '<strong>'.$title.'</strong> ';
		}
		
		$output .= wpb_js_remove_wpautop($content).'</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_alertblock",
	"name"      => __("Alerts", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-warning",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select Message type", "js_composer"),
			"param_name" => "alert_type",
			"value" => array("Error Message"=>"alert-danger", "Success Message"=>"alert-success", "Info Message"=>"alert-info", "Warning Message"=>"alert-warning", ),
			"description" => __("Warning, Error, Success, Info", "js_composer")
			),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"value" => __("Title", "js_composer")
			),
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Message", "js_composer"),
			"param_name" => "content",
			"value" => __("Message", "js_composer")
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
