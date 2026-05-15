<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Örnek bölgeler: vitrin kartlarıyla uyumlu 8 destinasyon (düz liste).
 * Kısa açıklama hem taksonomi açıklamasına hem _lazhem_short_description meta alanına yazılır.
 */
class Lazhem_Region_Seeder {

	const OPTION_SEEDED = 'lazhem_listings_demo_regions_dest8_v1';
	const OPTION_FLAT   = 'lazhem_listings_region_parents_cleared_v1';

	/**
	 * Eski hiyerarşiden kalan parent değerlerini sıfırla (bir kez).
	 */
	public static function maybe_flatten_parents() {
		if ( get_option( self::OPTION_FLAT, '' ) !== '' ) {
			return;
		}

		global $wpdb;
		$wpdb->update(
			$wpdb->term_taxonomy,
			array( 'parent' => 0 ),
			array( 'taxonomy' => 'listing_region' ),
			array( '%d' ),
			array( '%s' )
		);

		$term_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT term_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s",
				'listing_region'
			)
		);
		foreach ( $term_ids as $tid ) {
			clean_term_cache( (int) $tid, 'listing_region' );
		}

		update_option( self::OPTION_FLAT, '1' );
	}

	public static function maybe_seed() {
		if ( get_option( self::OPTION_SEEDED, '' ) !== '' ) {
			return;
		}

		$count = wp_count_terms(
			array(
				'taxonomy'   => 'listing_region',
				'hide_empty' => false,
			)
		);

		if ( is_wp_error( $count ) ) {
			return;
		}

		if ( (int) $count > 0 ) {
			update_option( self::OPTION_SEEDED, 'skipped_non_empty' );
			return;
		}

		self::seed();
		update_option( self::OPTION_SEEDED, '1' );
	}

	private static function import_theme_image( $filename ) {
		$path = trailingslashit( get_template_directory() ) . 'assets/images/' . $filename;
		if ( ! is_readable( $path ) ) {
			return 0;
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$bits = file_get_contents( $path );
		if ( false === $bits ) {
			return 0;
		}

		$upload = wp_upload_bits( $filename, null, $bits );
		if ( ! empty( $upload['error'] ) ) {
			return 0;
		}

		$wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
		$attachment  = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		$attach_id = wp_insert_attachment( $attachment, $upload['file'] );
		if ( is_wp_error( $attach_id ) || ! $attach_id ) {
			return 0;
		}

		$meta = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
		wp_update_attachment_metadata( $attach_id, $meta );

		return (int) $attach_id;
	}

	/**
	 * @param array{name:string,slug:string,short:string,image?:string,title?:string} $def
	 */
	private static function insert_one( array $def ) {
		$desc = sanitize_text_field( $def['short'] ?? '' );

		$ret = wp_insert_term(
			$def['name'],
			'listing_region',
			array(
				'slug'        => $def['slug'],
				'description' => $desc,
				'parent'      => 0,
			)
		);

		if ( is_wp_error( $ret ) ) {
			if ( 'term_exists' === $ret->get_error_code() ) {
				$tid = (int) $ret->get_error_data();
				if ( $tid > 0 ) {
					wp_update_term(
						$tid,
						'listing_region',
						array(
							'name'        => $def['name'],
							'description' => $desc,
							'parent'      => 0,
						)
					);
					self::apply_meta( $tid, $def );
				}
			}
			return;
		}

		$tid = (int) $ret['term_id'];
		self::apply_meta( $tid, $def );
	}

	private static function apply_meta( $term_id, array $def ) {
		update_term_meta( $term_id, '_lazhem_short_description', sanitize_text_field( $def['short'] ?? '' ) );

		if ( ! empty( $def['image'] ) ) {
			$aid = self::import_theme_image( $def['image'] );
			if ( $aid ) {
				update_term_meta( $term_id, '_lazhem_image_id', $aid );
			}
		}
	}

	private static function seed() {
		$defs = array(
			array(
				'name'  => 'Ayder Yaylası',
				'slug'  => 'ayder-yaylasi',
				'short' => '1.350M · RİZE',
				'image' => 'ayder-yaylasi-hero.png',
			),
			array(
				'name'  => 'Uzungöl',
				'slug'  => 'uzungol',
				'short' => 'TRABZON · ÇAYKARA',
				'image' => 'uzungol-lake.png',
			),
			array(
				'name'  => 'Çay Bahçeleri',
				'slug'  => 'cay-bahceleri',
				'short' => 'RİZE · İYİDERE',
				'image' => 'rize-tea-plantations.png',
			),
			array(
				'name'  => 'Mavigöl',
				'slug'  => 'mavigol',
				'short' => 'GİRESUN · DERELİ',
				'image' => 'mavigol-mysterious.png',
			),
			array(
				'name'  => 'Pokut Yaylası',
				'slug'  => 'pokut-yaylasi',
				'short' => '2.100M · ÇAMLIHEMŞİN',
				'image' => 'pokut-plateau-aerial.png',
			),
			array(
				'name'  => 'Karagöl',
				'slug'  => 'karagol',
				'short' => 'BORÇKA · ARTVİN',
				'image' => 'karagol-snow.png',
			),
			array(
				'name'  => 'Batum',
				'slug'  => 'batum',
				'short' => 'GÜRCİSTAN',
				'image' => 'batum-seaside.png',
			),
			array(
				'name'  => 'Sümela Manastırı',
				'slug'  => 'sumela-manastiri',
				'short' => 'MAÇKA · TRABZON',
				'image' => 'sumela-monastery.png',
			),
		);

		foreach ( $defs as $def ) {
			self::insert_one( $def );
		}
	}
}
