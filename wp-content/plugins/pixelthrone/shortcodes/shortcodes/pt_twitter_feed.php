<?php

class WPBakeryShortCode_pt_twitter_feed extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $class = $output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'icon_position' 		=> 'left',
			'color' 				=> '',
			'el_class'   			=> '',
			'css_animation' 		=> '',
			'css_delay' 			=> '',
			'pt_hidden_viewport' 	=> '',
			'color'					=> '',
			'color_icon'			=> '',
			'icon_line'				=> '',
			
			
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		//$style .= 'color: '. $color .'; ';

		$iconTemp = ( trim($icon_line) ) ? "ion-social-twitter-outline" : "ion-social-twitter";
		

		if ( $icon_position == 'left' )
		{
			$output = '
			<div class="twitterfeed '. $icon_position .' '. $el_class .'" '. $animation_attr .'>
				<div class="row">
					<div class="twitterfeed-icon '.$iconTemp.' col-md-2 col-xs-12" style="color:' . $color_icon . '"></div>
					<div class="twitterfeed-feed col-md-10 col-xs-12" style="color:' . $color . ';"></div>
				</div>
			</div>';
		}

		if ( $icon_position == 'right' )
		{
			$output = '
			<div class="twitterfeed '. $icon_position .' '. $el_class .'" '. $animation_attr .'>
				<div class="row">
					<div class="twitterfeed-feed col-md-10 col-xs-12" style="color:' . $color . ';"></div>
					<div class="twitterfeed-icon fa fa-twitter fa-flip-horizontal col-md-2 col-xs-12" style="color:' . $color_icon . '"></div>
				</div>
			</div>';
		}

		if ( $icon_position == 'top' )
		{
			$output = '
			<div class="twitterfeed '. $icon_position .' '. $el_class .'" '. $animation_attr .'>
				<div class="row">
					<div class="text-center col-md-12 col-sx-12">
						<div class="twitterfeed-icon fa fa-twitter" style="color:' . $color_icon . '"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="twitterfeed-feed" style="color:' . $color . ';"></div>
					</div>
				</div>
			</div>';
		}

		if ( $icon_position == 'bottom' )
		{
			$output = '
			<div class="twitterfeed '. $icon_position .' '. $el_class .'" '. $animation_attr .'>
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="twitterfeed-feed" style="color:' . $color . ';"></div>
					</div>
				</div>
				<div class="row">
					<div class="text-center col-md-12 col-xs-12" >
						<div class="twitterfeed-icon fa fa-twitter" ></div>
					</div>
				</div>
			</div>';
		}

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_twitter_feed",
	"name"      => __("Twitter Feed", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-twitter", "js_composer"),
	"category"  => __('Social', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select twitter icon position", "js_composer"),
			"param_name" => "icon_position",
			"value" => array("left"=>"left", "right"=>"right", "top"=>"top", "bottom"=>"bottom"),
			"description" => 'All twitter configurations are set in <a href="admin.php?page=theme_options&tab=3" target="_blank">Theme Options > Social Networks</a>'
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Pick text color", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon color", "js_composer"),
			"param_name" => "color_icon",
			"value" => '00abee', 
			//"description" => __("Pick text color", "js_composer")
			),
		array(
			"type" => "checkbox",
			"heading" => __("Icon in Outline", "js_composer"),
			"param_name" => "icon_line",
			"value" => array(__("Yes", "js_composer") => "Yes")
		),

		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
		)
) );