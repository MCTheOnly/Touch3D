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

	function form_shortcode() {

		ob_start(); ?>

		<div class="form__container">
			<h1><?php _e( "Kalkulator Brutto" ); ?></h1>
			<form method="post">
				<div class="form__label-wrapper">
					<label for="nazwa_produktu">
						<input type="text" name="nazwa_produktu[]" id="nazwa_produktu" placeholder="Nazwa produktu" required>
					</label>
				</div>
				<div class="form__label-wrapper">
					<label for="kwota_netto" class="half">
						<input type="number" name="kwota_netto[]" placeholder="Kwota netto" id="kwota_netto" required>
					</label>
					<label for="waluta" class="half">
						<input type="text" name="waluta[]" placeholder="Waluta" value="PLN" id="waluta" class="form__label-wrapper--waluta" disabled>
					</label>
				</div>
				<div class="form__label-wrapper">
					<label for="stawka_vat">
						<select name="stawka_vat[]" id="stawka_vat" required>
							<option value=""><?php _e( "Stawka VAT" ); ?></option>
							<option value="0.23"><?php _e( "23%" ); ?></option>
							<option value="0.22"><?php _e( "22%" ); ?></option>
							<option value="0.8"><?php _e( "8%" ); ?></option>
							<option value="0.7"><?php _e( "7%" ); ?></option>
							<option value="0.5"><?php _e( "5%" ); ?></option>
							<option value="0.3"><?php _e( "3%" ); ?></option>
							<option value="0"><?php _e( "0%" ); ?></option>
							<option value="0"><?php _e( "z.w." ); ?></option>
							<option value="0"><?php _e( "n.p." ); ?></option>
							<option value="0"><?php _e( "o.o." ); ?></option>
						</select>
					</label>
				</div>	
				<input type="submit" name="vat_form" value="Oblicz" class="js--form-submit">
			</form>
		 </div>

 		<?php

		if ( isset( $_POST["vat_form"] ) ) { 

			$nazwa         = $_POST["nazwa_produktu"][0];
			$kwota_netto   = $_POST["kwota_netto"][0];
			$podatek       = $_POST["stawka_vat"][0];
			$kwota_podatku = $kwota_netto * $podatek;
			$kwota_brutto  = $kwota_netto + $kwota_podatku;
			$data          = date("Y-m-d") . " " . date("h:i:s");
			?>

			<div class="results__container">
				<h2><?php _e( "Cena produktu " . $nazwa . " wynosi:" ) ?></h2>
				<p><?php _e( $kwota_brutto . " zł brutto, kwota podatku to " . $kwota_podatku . " zł" )?></p>
			</div>
			
			<?php
			$content = array(
				"nazwa"         => $nazwa,
				"kwota_netto"   => $kwota_netto,
				'podatek'       => $podatek,
				"kwota_podatku" => $kwota_podatku,
				"kwota_brutto"  => $kwota_brutto,
				"IP"            => get_user_ip(),
				"data"          => $data
			);

			$post_id = wp_insert_post(array (

				'post_type'      => 'results',
				'post_title'     => $nazwa . " " . $data,
				'post_content'   => json_encode( $content ),
				'post_status'    => 'publish',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			));
		}
		return ob_get_clean();
	}

	add_shortcode( 'custom_form_shortcode', 'form_shortcode' );

	// /DEV ENV/ ->
	echo do_shortcode( "[custom_form_shortcode]" );
	// <- /DEV ENV/

