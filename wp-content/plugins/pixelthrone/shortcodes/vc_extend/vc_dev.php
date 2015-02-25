<?php

/* NEW TYPE RADIO ICON */
/*
function pt_param_radio_icons($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);

	$param_line = '';

	$current_value = explode(",", $param_value);
	$values = is_array($param['value']) ? $param['value'] : array();

	$param_line .= '<ul>';
	foreach ( $values as $label => $v ) {
		$checked = in_array($v, $current_value) ? ' checked="checked"' : '';
		$param_line .= '<li><input id="'. $param['param_name'] . '_' . $v .'" value="' . $v . '" class="wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="radio" name="'.$param['param_name'].'"'.$checked.'><label for="'. $param['param_name'] . '_' . $v .'"><i class="'. $v .'"></i></label></li>';
	}
	$param_line .= '</ul>';

	return $param_line;
}
*/

// add_shortcode_param('pt_radio_icons', 'pt_param_radio_icons', get_template_directory_uri().'/functions/vc_extend/vc_extend.js');

/*
in file: js_composer/assets/js/backend/composer-atts.js

pt_radio_icons:{
    parse:function (param) {
        var arr = [],
            new_value = '';
        $('input[name=' + param.param_name + ']', this.$content).each(function (index) {
            var self = $(this);
            if (self.is(':checked')) {
                arr.push(self.attr("value"));
            }
        });
        if (arr.length > 0) {
            new_value = arr.join(',');
        }
        return new_value;
    },
    render:function (param, value) {
        return '<i class="' +  value + '"></i>';
    }
 }
*/
