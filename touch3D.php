<?php 
/**
 * @package Touch3D
 */

 /*
 Plugin Name: Touch3D
 Plugin URI: /
 Description: 3D scenes editor
 Version: 0.1.0
 Author: Martin Chorzewski
 License: GPLv2 or later
 Text Domain: touch3d
 */

defined( 'ABSPATH' ) or die('Nothing here...');

if ( ! class_exists( 'Touch3D' ) ) {
	class Touch3D {

		public $plugin;

		function __construct() {
			$this->plugin = plugin_basename( __FILE__ );
		}

		public function register() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
		}

		public function settings_link( $links ) {
			//custom setting slink
			$settings_link = '<a href="admin.php?page=touch3d">Settings</a>';
			array_push( $links, $settings_link );
			return $links;
		}

		public function add_admin_pages() {
			add_menu_page( 'Touch3D', 'Touch3D', 'manage_options', 'touch3d', array( $this, 'admin_index' ), 'dashicons-image-filter', 110 );
		}

		public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		protected function custom_post_type() {
			register_post_type( 'scenes', array( 'public' => true, 'label' => 'Scenes' ) );
		}
		public function enqueue() {
			//enqueue scripts & styles
			wp_enqueue_style( 'touchstyle', plugins_url( '/assets/touchstyle.css', __FILE__ ) );
			wp_enqueue_script( 'touchjs', plugins_url( '/assets/touchjs.js', __FILE__ ) );
		}
	}

	if ( class_exists( 'Touch3D' ) ) {
		$touch3D = new Touch3D();
		$touch3D->register();
	}
	//activation
	require_once plugin_dir_path( __FILE__ ) . 'inc/touch3D-activate.php';
	register_activation_hook( __FILE__, array( 'Touch3DActivate', 'activate' ) );
	//deactivation
	require_once plugin_dir_path( __FILE__ ) . 'inc/touch3D-deactivate.php';
	register_deactivation_hook( __FILE__, array( 'Touch3DDeactivate', 'deactivate' ) );
}
