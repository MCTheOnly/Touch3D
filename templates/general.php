<h1 id="App"><?php _e( "Touch 3D" ); ?></h1>

<h3><?php _e( "Twój Shortcode:" ); ?></h3>
<p><?php _e( "[custom_form_shortcode]" ); ?></p>

<?php

	function is_localhost( $whitelist = ['127.0.0.1', '::1'] ) {
		return in_array( $_SERVER['REMOTE_ADDR'], $whitelist );
	}

	function get_user_ip() {

		if ( is_localhost() ) {
			if ( ! empty( getenv('REMOTE_ADDR') ) ) {
				$ip = getenv( 'REMOTE_ADDR' );	
			} elseif ( ! empty( getenv( 'HTTP_X_FORWARDED_FOR' ) ) ) {	
				$ip = getenv( 'HTTP_X_FORWARDED_FOR' );
			} else {		
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			
			return apply_filters( 'wpb_get_ip', $ip );

		} else {
			if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {	
				$ip = $_SERVER['HTTP_CLIENT_IP'];	
			} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			
			return apply_filters( 'wpb_get_ip', $ip );
		}
	}

	// /DEV ENV/ ->
	echo do_shortcode( "[custom_form_shortcode]" );
	// <- /DEV ENV/

