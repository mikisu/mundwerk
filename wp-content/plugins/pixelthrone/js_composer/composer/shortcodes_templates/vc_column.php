<?php
$output = $el_class = $width = $animation_attr ='';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'css_animation' => '',
	'css_delay' => '',
	'pt_hidden_viewport' => ''
), $atts));

if ($css_animation)
{
	$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
}

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$el_class .= ' wpb_column column_container';

$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
$el_class .= $this->getExtraClass($pt_hidden_viewport);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper" ' . $animation_attr . '>';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;