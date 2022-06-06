<?php 
/**
* @package Touch3D
*/

namespace Inc\Base;

/**
* 
*/

class Activate {
	public static function activate() {

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $wpdb->prefix . 'touch3d_main';

		// /DEV ENV/ ->
		$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
		// <- /DEV ENV/
	
		$sql = "CREATE TABLE $table_name (
			t3d_option_id mediumint(9) NOT NULL AUTO_INCREMENT,
			t3d_option_name varchar(191) NOT NULL,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			UNIQUE KEY id (t3d_option_id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		flush_rewrite_rules();
	}
}
