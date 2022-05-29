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

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

function activate_touch3D() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_touch3D' );

function deactivate_touch3D() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_touch3D' );

if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}
