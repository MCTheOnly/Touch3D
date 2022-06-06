<?php 
/**
 * @package Touch3D
 */

namespace Inc\Api;

use \Inc\Base\BaseController;

/**
 * 
 */

 class SettingsApi { 

	public $this->admin_pages;

	 public function AddPages( array $pages ) {
		$this->admin_pages = $pages;

		return $this;
	 }
 }
