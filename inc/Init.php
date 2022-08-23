<?php 
/**
 * @package Touch3D
 */

namespace Inc;

final class Init {

	/**
	* Stores all classes
	* @return array 			array of classes
	*/

	public static function get_services() {
		return array(
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class
		);
	}

	/**
	* loops through the classes 
	* and calls a register() method
	* @return null
	*/

	public static function register_services() {
		foreach( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	* Initializes the class
	* @param class $class 		class from services array
	* @return class instance 	new instance of the class
	*/
	
	private static function instantiate( $class ) {
		$service = new $class;

		return $service;
	}
}
