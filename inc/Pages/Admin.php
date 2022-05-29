<?php 
/**
 * @package Touch3D
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;

/**
 * 
 */

 class Admin extends BaseController {

	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() {
		add_menu_page( 'Touch3D', 'Touch3D', 'manage_options', 'touch3d', array( $this, 'admin_index' ), 'dashicons-image-filter', 110 );
	}

	public function admin_index() {
		require_once $this->plugin_path . 'templates/admin.php';
	}
 }