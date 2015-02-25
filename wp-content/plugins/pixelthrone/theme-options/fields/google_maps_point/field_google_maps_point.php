<?php
class ReduxFramework_google_maps_point extends ReduxFramework{  

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since ReduxFramework 1.0.0
     */
    function __construct($field = array(), $value = '', $parent) {
    
        //parent::__construct( $parent->sections, $parent->args );
        $this->parent = $parent;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since ReduxFramework 1.0.0
     */
    function render() {

        if ( is_string( $this->value ) ) {

            if ( empty( $this->value['latitude'] ) ) {
            $this->value['latitude'] = '';
            }

            if ( empty( $this->value['longitude'] ) ) {
            $this->value['longitude'] = '';
            }
        }

        /*
         * Acceptable values checks.  If the passed variable doesn't pass muster, we unset them
         * and reset them with default values to avoid errors.
         */

        echo '<fieldset id="'.$this->field['id'].'" class="redux-dimensions-container" data-id="'.$this->field['id'].'">';

            //Latitude
                echo '<div class="field-dimensions-input input-prepend">';
                echo '<span class="add-on"><i class="el-icon-resize-horizontal"></i></span>';
                echo '<input type="text" class="redux-dimensions-input redux-dimensions-latitude mini'.$this->field['class'].'" placeholder="'.__('Latitude','redux-framework').'" rel="'.$this->field['id'].'-latitude" value="'.$this->value['latitude'].'">';
                echo '<input data-id="'.$this->field['id'].'" type="hidden" id="'.$this->field['id'].'-latitude" name="' . $this->field['name'] . '[latitude]" value="'.$this->value['latitude'].'"></div>';
                  
            //Longitude
                echo '<div class="field-dimensions-input input-prepend">';
                echo '<span class="add-on"><i class="el-icon-resize-vertical"></i></span>';
                echo '<input type="text" class="redux-dimensions-input redux-dimensions-longitude mini'.$this->field['class'].'" placeholder="'.__('Longitude','redux-framework').'" rel="'.$this->field['id'].'-longitude" value="'.$this->value['longitude'].'">';
                echo '<input data-id="'.$this->field['id'].'" type="hidden" id="'.$this->field['id'].'-longitude" name="' . $this->field['name'] . '[longitude]" value="'.$this->value['longitude'].'"></div>';

        echo "</fieldset>";

    }
//function

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since ReduxFramework 1.0.0
     */
    function enqueue() {
        wp_enqueue_script('select2-js');
        wp_enqueue_style('select2-css');

        wp_enqueue_script(
            'redux-field-google_maps_point-js', 
            PLUGIN_URL . 'theme-options/fields/google_maps_point/field_google_maps_point.js', 
            array('jquery'), 
            time(), 
            true
        );

        // wp_enqueue_style(
        //     'redux-field-google_maps_point-css', 
        //     PLUGIN_URL . 'theme-options/fields/google_maps_point/field_google_maps_point.css', 
        //     time(), 
        //     true
        // );
    }
    
}//class