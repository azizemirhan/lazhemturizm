<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Utils {
	public static function get_option( $key, $default = '' ) {
		$options = get_option( 'lazhem_listings_options', array() );
		return isset( $options[ $key ] ) ? $options[ $key ] : $default;
	}

	public static function money_format( $amount, $currency = '' ) {
		$currency = $currency ? $currency : self::get_option( 'currency', 'TRY' );
		$amount   = is_numeric( $amount ) ? number_format_i18n( (float) $amount, 0 ) : $amount;
		return sprintf( '%s %s', esc_html( $amount ), esc_html( $currency ) );
	}

	public static function listing_post_types() {
		return array( 'bungalov', 'tur', 'paket' );
	}

	public static function yesno( $value ) {
		return ( '1' === (string) $value ) ? '1' : '0';
	}

	public static function get_whatsapp_url( $post_id ) {
		$phone = preg_replace( '/\D+/', '', self::get_option( 'whatsapp_number', '' ) );
		if ( empty( $phone ) ) {
			return '';
		}

		$post_title = get_the_title( $post_id );
		$message    = get_post_meta( $post_id, '_lazhem_whatsapp_message', true );
		if ( empty( $message ) ) {
			$default = self::get_option( 'default_whatsapp_message', 'Merhaba, [ilan] hakkinda fiyat ve musaitlik bilgisi almak istiyorum.' );
			$message = str_replace( '[ilan]', $post_title, $default );
		}
		return 'https://wa.me/' . rawurlencode( $phone ) . '?text=' . rawurlencode( $message );
	}
}
