<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Utils {
	public static function get_option( $key, $default = '' ) {
		$options = get_option( 'lazhem_listings_options', array() );
		return isset( $options[ $key ] ) ? $options[ $key ] : $default;
	}

	public static function money_format( $amount, $currency = '₺' ) {
		$amount = is_numeric( $amount ) ? number_format_i18n( (float) $amount, 0 ) : $amount;
		return sprintf( '%s %s', esc_html( $currency ), esc_html( $amount ) );
	}

	public static function listing_post_types() {
		return array( 'tur' );
	}

	/**
	 * İlan bölgesi taksonomisi — kart için başlık, alt satır, görsel URL.
	 *
	 * @param int|WP_Term $term Term ID veya nesne.
	 * @return array{title:string,subtitle:string,image_url:string,term_id:int,slug:string,url:string}|null
	 */
	public static function get_listing_region_card( $term ) {
		$t = is_object( $term ) ? $term : get_term( (int) $term );
		if ( ! $t || is_wp_error( $t ) || 'listing_region' !== $t->taxonomy ) {
			return null;
		}
		$tid    = (int) $t->term_id;
		$dtitle = get_term_meta( $tid, '_lazhem_display_title', true );
		$title  = ( is_string( $dtitle ) && trim( $dtitle ) !== '' ) ? $dtitle : $t->name;
		$sub    = (string) get_term_meta( $tid, '_lazhem_short_description', true );
		$img_id = (int) get_term_meta( $tid, '_lazhem_image_id', true );
		$imgurl = $img_id ? (string) wp_get_attachment_image_url( $img_id, 'large' ) : '';

		$link = get_term_link( $t );
		if ( is_wp_error( $link ) ) {
			$link = '';
		}

		return array(
			'title'      => $title,
			'subtitle'   => $sub,
			'image_url'  => $imgurl,
			'term_id'    => $tid,
			'slug'       => $t->slug,
			'url'        => (string) $link,
		);
	}

	public static function yesno( $value ) {
		return ( '1' === (string) $value ) ? '1' : '0';
	}

	public static function get_whatsapp_url( $post_id ) {
		$phone = preg_replace( '/\D+/', '', self::get_option( 'whatsapp_number', '' ) );
		if ( empty( $phone ) ) {
			return '';
		}

		$data = get_post_meta( $post_id, '_lazhem_listing_data', true );
		$message = $data['whatsapp_text'] ?? '';
		
		if ( empty( $message ) ) {
			$post_title = get_the_title( $post_id );
			$default = self::get_option( 'default_whatsapp_message', 'Merhaba, [ilan] hakkinda bilgi almak istiyorum.' );
			$message = str_replace( '[ilan]', $post_title, $default );
		}
		return 'https://wa.me/' . rawurlencode( $phone ) . '?text=' . rawurlencode( $message );
	}
}
