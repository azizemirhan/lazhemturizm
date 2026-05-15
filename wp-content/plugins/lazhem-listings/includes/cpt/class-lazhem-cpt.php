<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_CPT {
	public static function register_all() {
		self::register_taxonomies();
		self::register_listing();
		
		// Öne çıkarılmış görseli yukarı taşımak için hook ekliyoruz
		add_action( 'do_meta_boxes', array( __CLASS__, 'move_featured_image_box' ) );
	}

	public static function move_featured_image_box() {
		// Yayınla kutusunu en tepeye zorla
		remove_meta_box( 'submitdiv', 'tur', 'side' );
		add_meta_box( 'submitdiv', 'Yayınla', 'post_submit_meta_box', 'tur', 'side', 'high' );

		// Öne çıkarılmış görseli onun bir altına al
		remove_meta_box( 'postimagediv', 'tur', 'side' );
		add_meta_box( 'postimagediv', 'Öne çıkarılmış görsel', 'post_thumbnail_meta_box', 'tur', 'side', 'default' );
	}

	private static function register_taxonomies() {
		// İlan Kategorileri
		register_taxonomy( 'listing_cat', 'tur', array(
			'labels' => array(
				'name'          => 'İlan Kategorileri',
				'singular_name' => 'İlan Kategorisi',
				'menu_name'     => 'Kategoriler',
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'ilan-kategorisi' ),
		));

		// İlan Bölgeleri
		register_taxonomy( 'listing_region', 'tur', array(
			'labels' => array(
				'name'              => 'İlan Bölgeleri',
				'singular_name'     => 'İlan Bölgesi',
				'menu_name'         => 'Bölgeler',
				'add_new_item'      => 'Yeni Bölge Ekle',
				'edit_item'         => 'Bölgeyi düzenle',
				'update_item'       => 'Bölgeyi güncelle',
				'new_item_name'     => 'Yeni bölge adı',
				'search_items'      => 'Bölge ara',
				'not_found'         => 'Bölge bulunamadı',
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'ilan-bolgesi' ),
		));

		// İlan Etiketleri
		register_taxonomy( 'listing_tag', 'tur', array(
			'labels' => array(
				'name'          => 'İlan Etiketleri',
				'singular_name' => 'İlan Etiketi',
				'menu_name'     => 'Etiketler',
			),
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'ilan-etiketi' ),
		));
	}

	private static function register_listing() {
		register_post_type(
			'tur',
			array(
				'labels' => array(
					'name'               => 'İlanlar',
					'singular_name'      => 'İlan',
					'add_new'            => 'Yeni İlan Ekle',
					'add_new_item'       => 'Yeni İlan Ekle',
					'edit_item'          => 'İlanı Düzenle',
					'all_items'          => 'Tüm İlanlar',
					'view_item'          => 'İlanı Görüntüle',
					'search_items'       => 'İlan Ara',
					'not_found'          => 'İlan bulunamadı',
					'not_found_in_trash' => 'Çöpte ilan bulunamadı',
					'menu_name'          => 'Lazhem İlanları',
				),
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => array( 'slug' => 'ilan' ),
				'supports'     => array( 'title', 'editor', 'thumbnail' ),
				'taxonomies'   => array( 'listing_cat', 'listing_region', 'listing_tag' ),
				'menu_icon'    => 'dashicons-admin-multisite',
				'show_in_menu' => true,
				'hierarchical' => false,
			)
		);
	}
}
