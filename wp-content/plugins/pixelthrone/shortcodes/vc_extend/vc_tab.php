<?php

vc_map( array(
	"name" => __("Tab", "js_composer"),
	"base" => "vc_tab",
	"allowed_container_element" => 'vc_row',
	"is_container" => true,
	"content_element" => false,
	"params" => array(
		array(
			"type" => "textfield",
			"param_name" => "pt_vc_dummy_textfield", // don't touch
			"value"=> "vc_tab", // class name
			"description" => "Dummy textfield Pixelthrone. Just change the value to the desired class"
			),
		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"description" => __("Tab title.", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Padding Top", "js_composer"),
			"param_name" => "pt_vc_padding_top",
			"value"=> "70",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Padding Right", "js_composer"),
			"param_name" => "pt_vc_padding_right",
			"value"=> "0",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Padding Bottom", "js_composer"),
			"param_name" => "pt_vc_padding_bottom",
			"value"=> "70",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Padding Left", "js_composer"),
			"param_name" => "pt_vc_padding_left",
			"value"=> "0",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
            "type" => "textfield",
            "heading" => __("Select an icon", "js_composer"),
            "param_name" => "font_icons",
            "value" => "",
            "description" => __("Select an Icon", "js_composer")
			),
		array(
			"type" => "tab_id",
			"heading" => __("Tab ID", "js_composer"),
			"param_name" => "tab_id"
			)
		),
	'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
	) );