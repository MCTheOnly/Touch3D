<?php 
/**
* @package Touch3D
*/

namespace Inc\Api\Callbacks;

/**
* 
*/

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController { 

	public function AdminDashboard() {
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function AdminScenes() {
		return require_once( "$this->plugin_path/templates/scenes.php" );
	}
}
