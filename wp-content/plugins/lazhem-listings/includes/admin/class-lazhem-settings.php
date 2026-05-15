<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Settings {
	public static function register_menu() {
		// Ayrı bir ana menü oluşturmak yerine, Ayarlar'ı CPT menüsünün altına ekliyoruz
		add_submenu_page( 
			'edit.php?post_type=tur', // İlanlar menüsünün altına bağla
			'Ayarlar', 
			'Ayarlar', 
			'manage_options', 
			'lazhem-listings-settings', 
			array( __CLASS__, 'render_settings' ) 
		);
	}

	public static function register_settings() {
		register_setting( 'lazhem_listings_settings_group', 'lazhem_listings_options', array( __CLASS__, 'sanitize' ) );
	}

	public static function sanitize( $input ) {
		$output = array();
		$output['whatsapp_number']          = isset( $input['whatsapp_number'] ) ? sanitize_text_field( $input['whatsapp_number'] ) : '';
		$output['default_whatsapp_message'] = isset( $input['default_whatsapp_message'] ) ? sanitize_textarea_field( $input['default_whatsapp_message'] ) : '';
		$output['currency']                 = isset( $input['currency'] ) ? sanitize_text_field( $input['currency'] ) : 'TRY';
		$output['default_cta_text']         = isset( $input['default_cta_text'] ) ? sanitize_text_field( $input['default_cta_text'] ) : '';
		$output['inquiry_email']            = isset( $input['inquiry_email'] ) ? sanitize_email( $input['inquiry_email'] ) : get_option( 'admin_email' );
		$output['google_maps_api']          = isset( $input['google_maps_api'] ) ? sanitize_text_field( $input['google_maps_api'] ) : '';
		$output['kvkk_text']                = isset( $input['kvkk_text'] ) ? wp_kses_post( $input['kvkk_text'] ) : '';
		$output['thanks_message']           = isset( $input['thanks_message'] ) ? sanitize_textarea_field( $input['thanks_message'] ) : 'Tesekkurler. Talebiniz alindi.';
		return $output;
	}

	public static function render_settings() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$options = get_option( 'lazhem_listings_options', array() );
		?>
		<div class="wrap">
			<h1>Lazhem Listings Ayarlar</h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'lazhem_listings_settings_group' ); ?>
				<table class="form-table">
					<tr><th>WhatsApp Numarasi</th><td><input type="text" class="regular-text" name="lazhem_listings_options[whatsapp_number]" value="<?php echo esc_attr( $options['whatsapp_number'] ?? '' ); ?>"></td></tr>
					<tr><th>Varsayilan WhatsApp Mesaji</th><td><textarea class="large-text" rows="3" name="lazhem_listings_options[default_whatsapp_message]"><?php echo esc_textarea( $options['default_whatsapp_message'] ?? '' ); ?></textarea></td></tr>
					<tr><th>Para Birimi</th><td><input type="text" name="lazhem_listings_options[currency]" value="<?php echo esc_attr( $options['currency'] ?? 'TRY' ); ?>"></td></tr>
					<tr><th>Varsayilan CTA Metni</th><td><input type="text" class="regular-text" name="lazhem_listings_options[default_cta_text]" value="<?php echo esc_attr( $options['default_cta_text'] ?? '' ); ?>"></td></tr>
					<tr><th>Form E-posta</th><td><input type="email" class="regular-text" name="lazhem_listings_options[inquiry_email]" value="<?php echo esc_attr( $options['inquiry_email'] ?? get_option( 'admin_email' ) ); ?>"></td></tr>
					<tr><th>Google Maps API</th><td><input type="text" class="regular-text" name="lazhem_listings_options[google_maps_api]" value="<?php echo esc_attr( $options['google_maps_api'] ?? '' ); ?>"></td></tr>
					<tr><th>KVKK Metni</th><td><textarea class="large-text" rows="5" name="lazhem_listings_options[kvkk_text]"><?php echo esc_textarea( $options['kvkk_text'] ?? '' ); ?></textarea></td></tr>
					<tr><th>Tesekkur Mesaji</th><td><textarea class="large-text" rows="3" name="lazhem_listings_options[thanks_message]"><?php echo esc_textarea( $options['thanks_message'] ?? '' ); ?></textarea></td></tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
