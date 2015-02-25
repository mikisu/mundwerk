<?php

vc_map( array(
  "name" => __("Column", "js_composer"),
  "base" => "vc_column",
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    $pt_css_animation,
    $pt_css_delay,
    $pt_hidden_viewport,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
      )
    ),
  "js_view" => 'VcColumnView'
  ) );