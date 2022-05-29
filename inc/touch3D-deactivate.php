<?php 
/**
 * @package Touch3D
 */

 class Touch3DDeactivate {
	 public static function deactivate() {
		 flush_rewrite_rules();
	 }
 }
