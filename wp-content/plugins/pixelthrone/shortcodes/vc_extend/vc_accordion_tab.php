<?php

vc_map( array(
	"name" => __("Accordion Section", "js_composer"),
	"base" => "vc_accordion_tab",
	"allowed_container_element" => 'vc_row',
	"is_container" => true,
	"content_element" => false,
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"description" => __("Accordion section title<br><strong>Icons only apply for accordion template 1</strong>.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
			),
		),
	'js_view' => 'VcAccordionTabView'
	) );