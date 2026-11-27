<?php
/**
 * Plugin Name: Insightistic Black Friday Landing
 * Description: Serves the Agent JOLLEY Version 3 campaign template on the existing Black Friday page.
 * Version: 1.1.0
 * Author: WordPressistic LLC
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'template_include',
	static function ( $template ) {
		if ( ! is_page( 605 ) || 'blackfriday' !== get_post_field( 'post_name', 605 ) || is_preview() ) {
			return $template;
		}

		return __DIR__ . '/landing.php';
	},
	99
);

function insightistic_blackfriday_container_id() {
	$id = (string) get_option( 'insightistic_blackfriday_container', '' );
	return preg_match( '/^GTM-[A-Z0-9]+$/D', $id ) ? $id : '';
}

function insightistic_blackfriday_clarity_id() {
	$id = (string) get_option( 'clarity_project_id', '' );
	return preg_match( '/^[a-z0-9]{5,24}$/Di', $id ) ? $id : '';
}

function insightistic_blackfriday_google_ads_destination() {
	$id = (string) get_option( 'insightistic_blackfriday_google_ads', 'AW-18594936041/WRcTCPvt1MAdEOnp4KJF' );
	return preg_match( '/^AW-[0-9]+\/[A-Za-z0-9_-]+$/D', $id ) ? $id : '';
}

function insightistic_blackfriday_meta_pixel_id() {
	$id = (string) get_option( 'insightistic_blackfriday_meta_pixel', '1641654483985208' );
	return preg_match( '/^[0-9]{10,25}$/D', $id ) ? $id : '';
}

add_action(
	'admin_init',
	static function () {
		register_setting(
			'insightistic_blackfriday',
			'insightistic_blackfriday_container',
			array(
				'type'              => 'string',
				'default'           => '',
				'sanitize_callback' => static function ( $input ) {
					$id = strtoupper( trim( (string) $input ) );
					if ( '' === $id || preg_match( '/^GTM-[A-Z0-9]+$/D', $id ) ) {
						return $id;
					}

					add_settings_error( 'insightistic_blackfriday_container', 'invalid_container', 'Enter a valid Google Tag Manager container ID.' );
					return insightistic_blackfriday_container_id();
				},
			)
		);
		register_setting(
			'insightistic_blackfriday',
			'insightistic_blackfriday_google_ads',
			array(
				'type'              => 'string',
				'sanitize_callback' => static function ( $input ) {
					$id = trim( (string) $input );
					if ( '' === $id || preg_match( '/^AW-[0-9]+\/[A-Za-z0-9_-]+$/D', $id ) ) {
						return $id;
					}

					add_settings_error( 'insightistic_blackfriday_google_ads', 'invalid_ads_destination', 'Enter the Google Ads destination from the event snippet.' );
					return insightistic_blackfriday_google_ads_destination();
				},
			)
		);
		register_setting(
			'insightistic_blackfriday',
			'insightistic_blackfriday_meta_pixel',
			array(
				'type'              => 'string',
				'sanitize_callback' => static function ( $input ) {
					$id = trim( (string) $input );
					if ( '' === $id || preg_match( '/^[0-9]{10,25}$/D', $id ) ) {
						return $id;
					}

					add_settings_error( 'insightistic_blackfriday_meta_pixel', 'invalid_meta_pixel', 'Enter the numeric Meta Pixel ID.' );
					return insightistic_blackfriday_meta_pixel_id();
				},
			)
		);
	}
);

add_action(
	'admin_menu',
	static function () {
		add_options_page(
			'Black Friday measurement',
			'Black Friday measurement',
			'manage_options',
			'insightistic-blackfriday',
			static function () {
				if ( ! current_user_can( 'manage_options' ) ) {
					return;
				}
				?>
				<div class="wrap">
					<h1>Black Friday measurement</h1>
					<?php settings_errors(); ?>
					<form action="options.php" method="post">
						<?php settings_fields( 'insightistic_blackfriday' ); ?>
						<p><label for="bf-gtm">Google Tag Manager container ID</label></p>
						<input class="regular-text" id="bf-gtm" name="insightistic_blackfriday_container" value="<?php echo esc_attr( insightistic_blackfriday_container_id() ); ?>" placeholder="GTM-…">
						<p class="description">Use a container you own with consent checks for each analytics and advertising tag. Leave blank to keep the container disabled.</p>
						<p><label for="bf-google-ads">Google Ads outbound-click destination</label></p>
						<input class="regular-text" id="bf-google-ads" name="insightistic_blackfriday_google_ads" value="<?php echo esc_attr( insightistic_blackfriday_google_ads_destination() ); ?>" placeholder="AW-…/…">
						<p class="description">Runs when advertising measurement is allowed. Leave blank if this conversion is already managed by Tag Manager.</p>
						<p><label for="bf-meta-pixel">Meta Pixel ID</label></p>
						<input class="regular-text" id="bf-meta-pixel" name="insightistic_blackfriday_meta_pixel" value="<?php echo esc_attr( insightistic_blackfriday_meta_pixel_id() ); ?>" inputmode="numeric">
						<p class="description">Runs when advertising measurement is allowed. Leave blank if the selected Pixel is already managed by Tag Manager.</p>
						<?php submit_button(); ?>
					</form>
				</div>
				<?php
			}
		);
	}
);
