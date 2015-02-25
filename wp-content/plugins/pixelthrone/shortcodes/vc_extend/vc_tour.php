<?php

$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
	"name" => __("Tour Section", "js_composer"),
	"base" => "vc_tour",
	"show_settings_on_create" => false,
	"is_container" => true,
	"container_not_allowed" => true,
	"icon" => "icon-wpb-ui-tab-content-vertical",
	"category" => __('Content', 'js_composer'),
	"wrapper_class" => "clearfix",
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __("Tabs Position", "js_composer"),
			"param_name" => "position",
			"value" => array('Left'=>'left', 'Right'=>'right'),
			"description" => __("", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Choose color", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Auto rotate slides", "js_composer"),
			"param_name" => "interval",
			"value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
			"description" => __("Auto rotate slides each X seconds.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Slide 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Slide 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );