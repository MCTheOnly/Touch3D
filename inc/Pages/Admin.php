<?php 
/**
 * @package Touch3D
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
/**
 * 
 */

 class Admin extends BaseController {

	public $settings;
	public $callbacks;
	public $pages    = array();
	public $subpages = array();

	public function register() {

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();
		
		$this->setSubpages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() {
		$this->pages = array(
			array(
				'page_title' => 'Touch3D',
				'menu_title' => 'Touch3D',
				'capability' => 'manage_options',
				'menu_slug'  => 'touch3d',
				'callback'   => array( $this->callbacks, 'AdminDashboard' ),
				'icon_url'   => 'dashicons-image-filter',
				'position'   => '110'
			)
		);

		$this->subpages = array(
			array(
				'parent_slug' => 'touch3d',
				'page_title'  => 'General',
				'menu_title'  => 'General',
				'capability'  => 'manage_options',
				'menu_slug'   => 'touch3doptions',
				'callback'    => array( $this->callbacks, 'AdminScenes' )
			)
		);
	}

	public function setSubpages() {
	
	}

 }
