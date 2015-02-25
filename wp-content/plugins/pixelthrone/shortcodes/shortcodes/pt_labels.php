<?php

/* Bootstrap Labels */
/*

Default     <span class="label">Default</span>
Success     <span class="label label-success">Success</span>
Warning     <span class="label label-warning">Warning</span>
Important   <span class="label label-important">Important</span>
Info        <span class="label label-info">Info</span>
Inverse     <span class="label label-inverse">Inverse</span>
*/

class WPBakeryShortCode_pt_labels extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'label_text'		=> '',
			'lbl_type'			=> '',
			'el_class'			=> '',
			'css_animation'		=> '',
			'css_delay'			=> '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$label_text = str_replace(array('<p>', '</p>'), '', $label_text);
		$output  = '<span class="label '. $lbl_type . $el_class .'" '. $animation_attr .'>'. wpb_js_remove_wpautop($label_text) .'</span>';
		
		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_labels",
	"name"      => __("Labels", "js_composer"),
	"controls"  => "edit_popup_delete",
	"class"     => "",
	"icon"      => "fa fa-tag",
	"category"  => __('Typography', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select label type", "js_composer"),
			"param_name" => "lbl_type",
			"value" => array(
				"Default" => "label-default", 
				"Primary" => "label-primary", 
				"Success" => "label-success", 
				"Info" => "label-info", 
				"Warning" => "label-warning", 
				"Danger" => "label-danger"
				),
			"description" => __("Default, Primary, Success, Info, Warning, Danger", "js_composer")
			),
		array(
			"type" => "textfield",
			"holder" => "span",
			"class" => "",
			"heading" => __("Text on the label", "js_composer"),
			"param_name" => "label_text",
			"value" => __("Text on the label", "js_composer"),
			"description" => __("Text on the label", "js_composer")
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
