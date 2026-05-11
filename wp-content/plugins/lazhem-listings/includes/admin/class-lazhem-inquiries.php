<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Inquiries {
	public static function register_menu() {
		add_filter( 'manage_lazhem_talep_posts_columns', array( __CLASS__, 'columns' ) );
		add_action( 'manage_lazhem_talep_posts_custom_column', array( __CLASS__, 'column_content' ), 10, 2 );
	}

	public static function columns( $columns ) {
		unset( $columns['date'] );
		$columns['phone']   = 'Telefon';
		$columns['email']   = 'E-posta';
		$columns['listing'] = 'Ilgili Ilan';
		$columns['dates']   = 'Tarih Araligi';
		$columns['guest']   = 'Misafir';
		$columns['status']  = 'Durum';
		$columns['date']    = 'Gonderim';
		return $columns;
	}

	public static function column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'phone':
				echo esc_html( get_post_meta( $post_id, '_lazhem_phone', true ) );
				break;
			case 'email':
				echo esc_html( get_post_meta( $post_id, '_lazhem_email', true ) );
				break;
			case 'listing':
				$listing_id = (int) get_post_meta( $post_id, '_lazhem_listing_id', true );
				echo $listing_id ? '<a href="' . esc_url( get_edit_post_link( $listing_id ) ) . '">' . esc_html( get_the_title( $listing_id ) ) . '</a>' : '-';
				break;
			case 'dates':
				echo esc_html( get_post_meta( $post_id, '_lazhem_checkin', true ) . ' - ' . get_post_meta( $post_id, '_lazhem_checkout', true ) );
				break;
			case 'guest':
				echo esc_html( get_post_meta( $post_id, '_lazhem_guest_count', true ) );
				break;
			case 'status':
				echo esc_html( get_post_meta( $post_id, '_lazhem_status', true ) ?: 'yeni' );
				break;
		}
	}
}
