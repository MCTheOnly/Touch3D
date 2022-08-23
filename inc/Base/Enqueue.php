<?php 
/**
 * @package Touch3D
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * 
 */



 class Enqueue extends BaseController {

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	public function enqueue() {
		//enqueue scripts & styles
		wp_enqueue_style( 'touchstyle', $this->plugin_url . 'assets/touchstyle.css', __FILE__ );
		wp_enqueue_script( 'touchjs', $this->plugin_url . 'assets/touchjs.js', __FILE__ );
		wp_enqueue_script( 'touch3djs', $this->plugin_url . 'build/index.js', __FILE__ );
	}
}
