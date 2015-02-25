<?php

class WPBakeryShortCode_pt_fold_buttons extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'font_icons'	=> '',
			'title'     	=> '',
			'text'      	=> '',
			'color1'    	=> '',
			'color2'    	=> '',
			'color3'    	=> '',
			'el_class' 		=> '',
			'css_animation' => '',
			'css_delay' 	=> '',
			'pt_hidden_viewport' => ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output = '<div class="fold-button origami'. $el_class .'" ' . $animation_attr . '>
					<div class="kami" style="background-color: '. $color1 .';">
						<span class="hi-icon '. $font_icons .'" style="color: '. $color2.'; "></span>
						<h3 style="color: '. $color2.'; ">'. $title .'</h3>
					</div>

					<div class="kami origami-content"  style="background-color: '. $color2.';">
						<span class="hi-icon '. $font_icons .'" style="color: '. $color1 .'; "></span>
						<h4>'. $title .'</h4>
						<p>'. $text .'</p>
					</div>
				</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_fold_buttons",
	"name"      => __("Fold Button", "js_composer"),
	"controls"  => "edit_popup_delete",
	"class"     => "",
	"icon"      => "fa fa-folder-open",
	"category"  => __('Buttons', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "button",
			"class" => "",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"value" => __("Title", "js_composer"),
			"description" => __("Write a title", "js_composer")
			),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Text", "js_composer"),
			"param_name" => "text",
			"value" => 'Text',
			"description" => __("Write some text", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Background color", "js_composer"),
			"param_name" => "color1",
			"value" => '', //Default color
			"description" => __("Outside Background color and inside icon color", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon color", "js_composer"),
			"param_name" => "color2",
			"value" => '', //Default color
			"description" => __("Outside icon and text color and inside background color", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon color", "js_composer"),
			"param_name" => "color3",
			"value" => '', //Default color
			"description" => __("Inside text color", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
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
