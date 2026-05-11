<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Shortcodes {
	public static function register() {
		add_shortcode( 'lazhem_listings', array( __CLASS__, 'listings' ) );
		add_shortcode( 'lazhem_featured', array( __CLASS__, 'featured' ) );
		add_shortcode( 'lazhem_inquiry_form', array( __CLASS__, 'inquiry_form' ) );
		add_shortcode( 'lazhem_related_items', array( __CLASS__, 'related_items' ) );
	}

	public static function listings( $atts ) {
		$atts = shortcode_atts( array( 'type' => 'bungalov' ), $atts, 'lazhem_listings' );
		$type = sanitize_key( $atts['type'] );
		if ( ! in_array( $type, Lazhem_Utils::listing_post_types(), true ) ) {
			return '';
		}

		$meta_query = array();
		if ( isset( $_GET['featured'] ) && '1' === $_GET['featured'] ) {
			$meta_query[] = array( 'key' => '_lazhem_featured', 'value' => '1' );
		}
		if ( ! empty( $_GET['capacity'] ) ) {
			$meta_query[] = array( 'key' => '_lazhem_capacity', 'value' => sanitize_text_field( wp_unslash( $_GET['capacity'] ) ) );
		}

		$query = new WP_Query(
			array(
				'post_type'      => $type,
				'posts_per_page' => 12,
				'meta_query'     => $meta_query,
			)
		);

		ob_start();
		echo '<div class="lazhem-grid">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			echo '<article class="lazhem-card">';
			echo get_the_post_thumbnail( $post_id, 'medium_large' );
			echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
			echo '<p>' . esc_html( get_post_meta( $post_id, '_lazhem_region', true ) ) . '</p>';
			echo '<p><strong>' . esc_html( Lazhem_Utils::money_format( get_post_meta( $post_id, '_lazhem_price_start', true ), get_post_meta( $post_id, '_lazhem_currency', true ) ) ) . '</strong></p>';
			$wa = Lazhem_Utils::get_whatsapp_url( $post_id );
			echo '<p><a class="button" href="' . esc_url( get_permalink() ) . '">Detay</a> ';
			if ( $wa ) {
				echo '<a class="button button-whatsapp" target="_blank" rel="noopener" href="' . esc_url( $wa ) . '">WhatsApp</a>';
			}
			echo '</p></article>';
		}
		echo '</div>';
		wp_reset_postdata();
		return ob_get_clean();
	}

	public static function featured( $atts ) {
		$_GET['featured'] = '1';
		return self::listings( $atts );
	}

	public static function inquiry_form( $atts ) {
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return '';
		}
		ob_start();
		include LAZHEM_LISTINGS_PATH . 'templates/parts/inquiry-form.php';
		return ob_get_clean();
	}

	public static function related_items( $atts ) {
		$current_id   = get_the_ID();
		$current_type = get_post_type( $current_id );
		if ( ! in_array( $current_type, Lazhem_Utils::listing_post_types(), true ) ) {
			return '';
		}
		$query = new WP_Query(
			array(
				'post_type'      => $current_type,
				'post__not_in'   => array( $current_id ),
				'posts_per_page' => 3,
			)
		);
		ob_start();
		echo '<div class="lazhem-related">';
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<a class="lazhem-related-item" href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>';
		}
		echo '</div>';
		wp_reset_postdata();
		return ob_get_clean();
	}
}
