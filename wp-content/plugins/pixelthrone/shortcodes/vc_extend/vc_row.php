<?php

vc_map( array(
	"name" => __("Row", "js_composer"),
	"base" => "vc_row",
	"is_container" => true,
	"icon" => "icon-wpb-row",
	"show_settings_on_create" => false,
	"category" => __('Content', 'js_composer'),
	"params" => array(
		array(
			"type" => "textfield",
			"param_name" => "pt_vc_dummy_textfield", // don't touch
			"value"=> "vc_row", // class name
			"description" => "Dummy textfield Pixelthrone. Just change the value to the desired class"
		),
		array(
			"type" => "textfield",
			"heading" => __("Padding Top", "js_composer"),
			"param_name" => "pt_vc_padding_top",
			"description" => __("Only numbers. Value in pixels", "js_composer")
		),
		array(
			"type" => "textfield",
			"heading" => __("Padding Bottom", "js_composer"),
			"param_name" => "pt_vc_padding_bottom",
			"description" => __("Only numbers. Value in pixels", "js_composer")
		),
		array(
			"type" => "attach_image",
			"heading" => __("Select Background Image", "js_composer"),
			"param_name" => "pt_vc_bg_image",
		),
		array(
			"type" => "dropdown",
			"heading" => __("Enable Parallax", "js_composer"),
			"param_name" => "pt_vc_parallax",
			"value" => array('No', 'Yes'),
			"description" => __("You need to select an image", "js_composer")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Background Color", "js_composer"),
			"param_name" => "pt_vc_bg_color",
			"value" => '', //Default color
		),
		array(
			"type" => "dropdown",
			"heading" => __("Full Width", "js_composer"),
			"param_name" => "pt_vc_full_width",
			"value" => array('No', 'Yes'),
			"description" => __("Set this row to be full width", "js_composer")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "pt_vc_text_color",
			"value" => '', //Default color
		),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "checkbox",
			"heading" => __("Tablet Layout", "js_composer"),
			"param_name" => "tablet_layout",
			"value" => array ("Yes" => "tablet-layout"),
			"description" => "Tablet layout sets columns to 50% or 100%, so content look more tablet friendly. Try it out."
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
		)
	),
	"js_view" => 'VcRowView'
) );