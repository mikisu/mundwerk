<?php

vc_map( array(
	"name" => __("Row", "js_composer"), //Inner Row
	"base" => "vc_row_inner",
	"content_element" => false,
	"is_container" => true,
	"icon" => "icon-wpb-row",
	"weight" => 1000,
	"show_settings_on_create" => false,
	"params" => array(
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
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		),
	"js_view" => 'VcRowView'
	) );