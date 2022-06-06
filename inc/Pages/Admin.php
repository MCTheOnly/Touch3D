<?php 
/**
 * @package Touch3D
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
/**
 * 
 */

 class Admin extends BaseController {

	public $settings;
	public $pages = array();
	public $subpages = array();

	public function __construct() {

		$this->settings = new SettingsApi();

		$this->pages = array(
			array(
				'page_title' => 'Touch3D',
				'menu_title' => 'Touch3D',
				'capability' => 'manage_options',
				'menu_slug'  => 'touch3d',
				'callback'   => function() { echo '<h1>Touch3D</h1>'; },
				'icon_url'   => 'dashicons-image-filter',
				'position'   => '110'
			)
		);

		$this->subpages = array(
			array(
				'parent_slug' => 'touch3d',
				'page_title' => 'General',
				'menu_title' => 'General',
				'capability' => 'manage_options',
				'menu_slug'  => 'touch3doptions',
				'callback'   => function() { echo '<h1>General</h1>'; }
			)
		);
	}

	public function register() {
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}
 }
