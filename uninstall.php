<?php

/**
 * @package Touch3D
 */

defined( 'WP_UNINSTALL_PLUGIN' ) or die('Nothing here...');

//DB access
global $wpdb;

$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'scenes'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
