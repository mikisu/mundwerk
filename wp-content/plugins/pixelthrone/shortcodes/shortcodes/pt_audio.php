<?php

/* Audio Shortcode */


wpb_map( array(
	"base"      => "audio",
	"name"      => __("Audio", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-music",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"heading" => __("Select File", "js_composer"),
			"param_name" => "src",
			"value" => "",
			"description" => __("URL for the MP3 file", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Loop", "js_composer"),
			"param_name" => "loop",
			"value" => array("off"=>"off", "on"=>"on" ),
			"description" => __("Allows for the looping of media", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Autoplay", "js_composer"),
			"param_name" => "autoplay",
			"value" => array("off"=>"off", "on"=>"on" ),
			"description" => __("Causes the media to automatically play as soon as the media file is ready", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Preload", "js_composer"),
			"param_name" => "preload",
			"value" => array("none"=>"none", "auto"=>"auto"),
			"description" => __("Specifies if and how the audio should be loaded when the page loads.", "js_composer")
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
