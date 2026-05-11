<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_CPT {
	public static function register_all() {
		self::register_bungalov();
		self::register_tur();
		self::register_paket();
		self::register_talep();
	}

	private static function register_bungalov() {
		register_post_type(
			'bungalov',
			array(
				'labels' => array(
					'name'          => 'Bungalovlar',
					'singular_name' => 'Bungalov',
				),
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => array( 'slug' => 'bungalov' ),
				'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'menu_icon'    => 'dashicons-admin-home',
				'show_in_menu' => 'lazhem-listings',
			)
		);
	}

	private static function register_tur() {
		register_post_type(
			'tur',
			array(
				'labels' => array(
					'name'          => 'Turlar',
					'singular_name' => 'Tur',
				),
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => array( 'slug' => 'tur' ),
				'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'menu_icon'    => 'dashicons-location-alt',
				'show_in_menu' => 'lazhem-listings',
			)
		);
	}

	private static function register_paket() {
		register_post_type(
			'paket',
			array(
				'labels' => array(
					'name'          => 'Paketler',
					'singular_name' => 'Paket',
				),
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => array( 'slug' => 'paket' ),
				'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'menu_icon'    => 'dashicons-screenoptions',
				'show_in_menu' => 'lazhem-listings',
			)
		);
	}

	private static function register_talep() {
		register_post_type(
			'lazhem_talep',
			array(
				'labels' => array(
					'name'          => 'Talepler',
					'singular_name' => 'Talep',
				),
				'public'             => false,
				'show_ui'            => true,
				'show_in_menu'       => false,
				'supports'           => array( 'title' ),
				'capability_type'    => 'post',
				'map_meta_cap'       => true,
				'exclude_from_search'=> true,
			)
		);
	}
}
