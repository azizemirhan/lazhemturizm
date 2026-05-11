<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Frontend {
	public static function register_handlers() {
		add_action( 'admin_post_nopriv_lazhem_inquiry_submit', array( __CLASS__, 'handle_inquiry' ) );
		add_action( 'admin_post_lazhem_inquiry_submit', array( __CLASS__, 'handle_inquiry' ) );
	}

	public static function enqueue() {
		wp_enqueue_style( 'lazhem-listings-frontend', LAZHEM_LISTINGS_URL . 'assets/css/frontend.css', array(), LAZHEM_LISTINGS_VERSION );
	}

	public static function template_include( $template ) {
		if ( is_singular( Lazhem_Utils::listing_post_types() ) ) {
			$theme_template = locate_template( array( 'lazhem-listings/detail.php' ) );
			if ( $theme_template ) {
				return $theme_template;
			}
			return LAZHEM_LISTINGS_PATH . 'templates/detail.php';
		}
		return $template;
	}

	public static function handle_inquiry() {
		if ( ! isset( $_POST['lazhem_inquiry_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lazhem_inquiry_nonce'] ) ), 'lazhem_inquiry_submit' ) ) {
			wp_die( 'Guvenlik dogrulamasi basarisiz.' );
		}

		$listing_id = isset( $_POST['listing_id'] ) ? absint( $_POST['listing_id'] ) : 0;
		if ( ! $listing_id || ! in_array( get_post_type( $listing_id ), Lazhem_Utils::listing_post_types(), true ) ) {
			wp_die( 'Gecersiz ilan.' );
		}

		$data = array(
			'name'        => sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) ),
			'phone'       => sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) ),
			'email'       => sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ),
			'checkin'     => sanitize_text_field( wp_unslash( $_POST['checkin'] ?? '' ) ),
			'checkout'    => sanitize_text_field( wp_unslash( $_POST['checkout'] ?? '' ) ),
			'guest_count' => sanitize_text_field( wp_unslash( $_POST['guest_count'] ?? '' ) ),
			'variation'   => sanitize_text_field( wp_unslash( $_POST['variation'] ?? '' ) ),
			'message'     => sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) ),
			'kvkk'        => isset( $_POST['kvkk'] ) ? '1' : '0',
		);

		if ( empty( $data['name'] ) || empty( $data['phone'] ) || empty( $data['email'] ) || '1' !== $data['kvkk'] ) {
			wp_safe_redirect( add_query_arg( 'lazhem_msg', 'invalid', wp_get_referer() ?: get_permalink( $listing_id ) ) );
			exit;
		}

		$inquiry_id = wp_insert_post(
			array(
				'post_type'   => 'lazhem_talep',
				'post_status' => 'publish',
				'post_title'  => $data['name'] . ' - ' . get_the_title( $listing_id ),
			)
		);

		if ( $inquiry_id ) {
			foreach ( $data as $k => $v ) {
				update_post_meta( $inquiry_id, '_lazhem_' . $k, $v );
			}
			update_post_meta( $inquiry_id, '_lazhem_listing_id', $listing_id );
			update_post_meta( $inquiry_id, '_lazhem_listing_type', get_post_type( $listing_id ) );
			update_post_meta( $inquiry_id, '_lazhem_ip', sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) ) );
			update_post_meta( $inquiry_id, '_lazhem_status', 'yeni' );
		}

		$to      = Lazhem_Utils::get_option( 'inquiry_email', get_option( 'admin_email' ) );
		$subject = 'Yeni Talep: ' . get_the_title( $listing_id );
		$body    = "Ad Soyad: {$data['name']}\nTelefon: {$data['phone']}\nE-posta: {$data['email']}\nGiris/Cikis: {$data['checkin']} - {$data['checkout']}\nMisafir: {$data['guest_count']}\nVaryasyon: {$data['variation']}\nMesaj: {$data['message']}\n";
		wp_mail( $to, $subject, $body );

		wp_safe_redirect( add_query_arg( 'lazhem_msg', 'success', get_permalink( $listing_id ) ) );
		exit;
	}
}
