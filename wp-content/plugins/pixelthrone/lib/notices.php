<?php
/**
 * PixelThrone — Alma — Custom Notices
 */

if (!defined('ABSPATH')) die('-1');
if (!class_exists('pt_notices')) {

	class pt_notices{

	    public function __construct() {
	    }

		public static function custom_error_notice_vcomposer_already_instaled(){
			global $current_screen;
			echo '<div class="error custom_error_notice_file_not_writable">
				<h1>Warning</h1>

				<p>We detected that you already have <b>WPBakery Visual Composer</b> instaled.
				<br>We recomend to <a href="plugins.php">deactivate</a> it, the theme comes with <b>WPBakery Visual Composer</b> bundled and some theme features might not work as expected.</p>

				</div>';
		}
	}

}