<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Meta_Boxes {
	public static function enqueue_admin_assets( $hook ) {
		global $post;
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}
		if ( ! $post || ! in_array( $post->post_type, array( 'bungalov', 'tur', 'paket', 'lazhem_talep' ), true ) ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/js/admin.js', array( 'jquery', 'jquery-ui-sortable' ), LAZHEM_LISTINGS_VERSION, true );
		wp_enqueue_style( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/css/admin.css', array(), LAZHEM_LISTINGS_VERSION );
	}

	public static function register() {
		foreach ( Lazhem_Utils::listing_post_types() as $type ) {
			add_meta_box( 'lazhem_common', 'Genel Bilgiler', array( __CLASS__, 'render_common' ), $type, 'normal', 'high' );
		}
		add_meta_box( 'lazhem_bungalov', 'Bungalov Ozellikleri', array( __CLASS__, 'render_bungalov' ), 'bungalov', 'normal', 'default' );
		add_meta_box( 'lazhem_bungalov_variations', 'Bungalov Varyasyonlari', array( __CLASS__, 'render_bungalov_variations' ), 'bungalov', 'normal', 'default' );
		add_meta_box( 'lazhem_tur', 'Tur Ozellikleri', array( __CLASS__, 'render_tur' ), 'tur', 'normal', 'default' );
		add_meta_box( 'lazhem_tur_program', 'Tur Programi', array( __CLASS__, 'render_tur_program' ), 'tur', 'normal', 'default' );
		add_meta_box( 'lazhem_paket', 'Paket Ozellikleri', array( __CLASS__, 'render_paket' ), 'paket', 'normal', 'default' );
		add_meta_box( 'lazhem_paket_relations', 'Paket Iliskileri', array( __CLASS__, 'render_paket_relations' ), 'paket', 'side', 'high' );
		add_meta_box( 'lazhem_talep', 'Talep Detayi', array( __CLASS__, 'render_talep' ), 'lazhem_talep', 'normal', 'high' );
	}

	private static function field( $name, $label, $post_id, $type = 'text' ) {
		$value = get_post_meta( $post_id, '_lazhem_' . $name, true );
		echo '<p><label><strong>' . esc_html( $label ) . '</strong></label><br>';
		if ( 'textarea' === $type ) {
			echo '<textarea style="width:100%;" rows="3" name="lazhem[' . esc_attr( $name ) . ']">' . esc_textarea( $value ) . '</textarea>';
		} elseif ( 'checkbox' === $type ) {
			echo '<label><input type="checkbox" name="lazhem[' . esc_attr( $name ) . ']" value="1" ' . checked( $value, '1', false ) . '> Evet</label>';
		} else {
			echo '<input type="' . esc_attr( $type ) . '" style="width:100%;" name="lazhem[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '">';
		}
		echo '</p>';
	}

	public static function render_common( $post ) {
		wp_nonce_field( 'lazhem_save_meta', 'lazhem_meta_nonce' );
		self::field( 'short_description', 'Kisa Aciklama', $post->ID, 'textarea' );
		self::field( 'status', 'Durum (aktif/pasif)', $post->ID );
		self::field( 'featured', 'One Cikan Mi?', $post->ID, 'checkbox' );
		self::field( 'price_start', 'Baslangic Fiyati', $post->ID, 'number' );
		self::field( 'currency', 'Para Birimi', $post->ID );
		self::field( 'season_discount', 'Sezon Indirimi', $post->ID );
		self::field( 'includes', 'Dahil Olan Hizmetler', $post->ID, 'textarea' );
		self::field( 'excludes', 'Dahil Olmayan Hizmetler', $post->ID, 'textarea' );
		self::field( 'optional_services', 'Opsiyonel Hizmetler', $post->ID, 'textarea' );
		self::field( 'whatsapp_message', 'WhatsApp Mesaj Metni', $post->ID, 'textarea' );
		self::field( 'form_cta_title', 'Form CTA Basligi', $post->ID );
		self::field( 'form_cta_description', 'Form CTA Aciklamasi', $post->ID, 'textarea' );
		self::field( 'gallery_ids', 'Galeri Görsel IDleri (virgül ile)', $post->ID, 'text' );
	}

	public static function render_bungalov( $post ) {
		$fields = array(
			'location' => 'Konum', 'region' => 'Bolge', 'city' => 'Sehir', 'district' => 'Ilce', 'altitude' => 'Rakim',
			'area_m2' => 'Toplam Alan m2', 'capacity' => 'Kapasite', 'min_stay' => 'Minimum Konaklama',
			'bed_layout' => 'Yatak Duzeni', 'bathroom_count' => 'Banyo Sayisi', 'view_type' => 'Manzara Tipi',
			'kitchen' => 'Mutfak', 'wifi' => 'Wi-Fi', 'jacuzzi' => 'Jakuzi', 'fireplace' => 'Somine', 'parking' => 'Otopark',
		);
		foreach ( $fields as $key => $label ) {
			$type = in_array( $key, array( 'kitchen', 'wifi', 'jacuzzi', 'fireplace', 'parking' ), true ) ? 'checkbox' : 'text';
			self::field( $key, $label, $post->ID, $type );
		}
	}

	public static function render_bungalov_variations( $post ) {
		$items = get_post_meta( $post->ID, '_lazhem_bungalov_variations', true );
		$items = is_array( $items ) ? $items : array();
		echo '<div class="lazhem-repeater" data-name="bungalov_variations"><button class="button add-row" type="button">Varyasyon Ekle</button><div class="rows">';
		foreach ( $items as $item ) {
			self::variation_row( $item );
		}
		echo '</div></div>';
		self::variation_row_template();
	}

	private static function variation_row( $item = array() ) {
		echo '<div class="lazhem-row"><p><strong>Varyasyon</strong></p>';
		$map = array(
			'name' => 'Varyasyon Adi', 'short_description' => 'Kisa Aciklama', 'capacity' => 'Kapasite', 'bed_layout' => 'Yatak Duzeni',
			'room_m2' => 'Oda m2', 'bathroom_count' => 'Banyo Sayisi', 'view' => 'Manzara', 'night_price' => 'Gecelik Fiyat',
			'weekend_price' => 'Hafta Sonu Fiyati', 'season_price' => 'Sezon Fiyati', 'min_night' => 'Minimum Gece', 'stock' => 'Stok', 'gallery' => 'Galeri IDleri', 'status' => 'Durum',
		);
		foreach ( $map as $key => $label ) {
			echo '<label>' . esc_html( $label ) . '<input type="text" name="lazhem_variations[' . esc_attr( $key ) . '][]" value="' . esc_attr( $item[ $key ] ?? '' ) . '"></label>';
		}
		echo '<p><button class="button-link-delete remove-row" type="button">Sil</button></p></div>';
	}

	private static function variation_row_template() {
		echo '<script type="text/template" id="tmpl-lazhem-bungalov-variations">';
		self::variation_row();
		echo '</script>';
	}

	public static function render_tur( $post ) {
		$fields = array(
			'tour_type' => 'Tur Tipi', 'region' => 'Bolge', 'destinations' => 'Destinasyonlar', 'duration' => 'Sure',
			'min_people' => 'Minimum Kisi', 'max_people' => 'Maksimum Kisi', 'price_mode' => 'Fiyat Tipi (kisi/grup)',
			'guide_included' => 'Rehber Dahil', 'transfer_included' => 'Transfer Dahil', 'breakfast_included' => 'Kahvalti Dahil', 'free_cancel' => 'Ucretsiz Iptal',
		);
		foreach ( $fields as $key => $label ) {
			$type = in_array( $key, array( 'guide_included', 'transfer_included', 'breakfast_included', 'free_cancel' ), true ) ? 'checkbox' : 'text';
			self::field( $key, $label, $post->ID, $type );
		}
	}

	public static function render_tur_program( $post ) {
		$items = get_post_meta( $post->ID, '_lazhem_tur_program', true );
		$items = is_array( $items ) ? $items : array();
		echo '<div class="lazhem-repeater" data-name="tur_program"><button class="button add-row" type="button">Program Satiri Ekle</button><div class="rows">';
		foreach ( $items as $item ) {
			echo '<div class="lazhem-row">';
			echo '<label>Gun Basligi<input type="text" name="lazhem_tur_program[day_title][]" value="' . esc_attr( $item['day_title'] ?? '' ) . '"></label>';
			echo '<label>Saat Araligi<input type="text" name="lazhem_tur_program[time_range][]" value="' . esc_attr( $item['time_range'] ?? '' ) . '"></label>';
			echo '<label>Aktivite Basligi<input type="text" name="lazhem_tur_program[activity_title][]" value="' . esc_attr( $item['activity_title'] ?? '' ) . '"></label>';
			echo '<label>Aciklama<textarea name="lazhem_tur_program[description][]">' . esc_textarea( $item['description'] ?? '' ) . '</textarea></label>';
			echo '<p><button class="button-link-delete remove-row" type="button">Sil</button></p></div>';
		}
		echo '</div></div>';
		echo '<script type="text/template" id="tmpl-lazhem-tur-program"><div class="lazhem-row"><label>Gun Basligi<input type="text" name="lazhem_tur_program[day_title][]"></label><label>Saat Araligi<input type="text" name="lazhem_tur_program[time_range][]"></label><label>Aktivite Basligi<input type="text" name="lazhem_tur_program[activity_title][]"></label><label>Aciklama<textarea name="lazhem_tur_program[description][]"></textarea></label><p><button class="button-link-delete remove-row" type="button">Sil</button></p></div></script>';
	}

	public static function render_paket( $post ) {
		$fields = array(
			'package_type' => 'Paket Tipi', 'package_duration' => 'Paket Suresi', 'package_capacity' => 'Paket Kapasitesi',
			'package_content' => 'Paket Icerigi', 'package_program' => 'Paket Programi',
			'package_price' => 'Paket Fiyati', 'discount_price' => 'Indirimli Fiyat', 'price_mode' => 'Fiyat Tipi (cift/kisi/grup)',
		);
		foreach ( $fields as $key => $label ) {
			$type = in_array( $key, array( 'package_content', 'package_program' ), true ) ? 'textarea' : 'text';
			self::field( $key, $label, $post->ID, $type );
		}
	}

	public static function render_paket_relations( $post ) {
		$selected_bungalov = get_post_meta( $post->ID, '_lazhem_selected_bungalovlar', true );
		$selected_turlar   = get_post_meta( $post->ID, '_lazhem_selected_turlar', true );
		$selected_bungalov = is_array( $selected_bungalov ) ? $selected_bungalov : array();
		$selected_turlar   = is_array( $selected_turlar ) ? $selected_turlar : array();

		echo '<p><strong>Secili Bungalovlar</strong></p>';
		$bungalovlar = get_posts( array( 'post_type' => 'bungalov', 'numberposts' => -1 ) );
		foreach ( $bungalovlar as $item ) {
			echo '<label><input type="checkbox" name="lazhem[selected_bungalovlar][]" value="' . esc_attr( $item->ID ) . '" ' . checked( in_array( $item->ID, $selected_bungalov, true ), true, false ) . '> ' . esc_html( $item->post_title ) . '</label><br>';
		}
		echo '<hr><p><strong>Secili Turlar</strong></p>';
		$turlar = get_posts( array( 'post_type' => 'tur', 'numberposts' => -1 ) );
		foreach ( $turlar as $item ) {
			echo '<label><input type="checkbox" name="lazhem[selected_turlar][]" value="' . esc_attr( $item->ID ) . '" ' . checked( in_array( $item->ID, $selected_turlar, true ), true, false ) . '> ' . esc_html( $item->post_title ) . '</label><br>';
		}
	}

	public static function render_talep( $post ) {
		$keys = array( 'name', 'phone', 'email', 'checkin', 'checkout', 'guest_count', 'variation', 'message', 'kvkk', 'listing_id', 'listing_type', 'ip', 'status' );
		echo '<table class="widefat striped"><tbody>';
		foreach ( $keys as $key ) {
			$value = get_post_meta( $post->ID, '_lazhem_' . $key, true );
			echo '<tr><th style="width:220px;">' . esc_html( ucfirst( str_replace( '_', ' ', $key ) ) ) . '</th><td>' . esc_html( (string) $value ) . '</td></tr>';
		}
		echo '</tbody></table>';
		echo '<p><label>Durum <select name="lazhem[status]"><option value="yeni">yeni</option><option value="arandi">arandi</option><option value="teklif gonderildi">teklif gonderildi</option><option value="kapandi">kapandi</option></select></label></p>';
	}

	public static function save( $post_id, $post ) {
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( ! isset( $_POST['lazhem_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lazhem_meta_nonce'] ) ), 'lazhem_save_meta' ) ) {
			if ( 'lazhem_talep' !== $post->post_type ) {
				return;
			}
		}

		if ( isset( $_POST['lazhem'] ) && is_array( $_POST['lazhem'] ) ) {
			$allowed_html = wp_kses_allowed_html( 'post' );
			foreach ( wp_unslash( $_POST['lazhem'] ) as $key => $value ) {
				$meta_key = '_lazhem_' . sanitize_key( $key );
				if ( is_array( $value ) ) {
					$clean = array_map( 'absint', $value );
					update_post_meta( $post_id, $meta_key, $clean );
				} else {
					if ( in_array( $key, array( 'includes', 'excludes', 'optional_services', 'whatsapp_message', 'short_description', 'form_cta_description', 'package_content', 'package_program' ), true ) ) {
						update_post_meta( $post_id, $meta_key, wp_kses( (string) $value, $allowed_html ) );
					} elseif ( in_array( $key, array( 'featured', 'kitchen', 'wifi', 'jacuzzi', 'fireplace', 'parking', 'guide_included', 'transfer_included', 'breakfast_included', 'free_cancel' ), true ) ) {
						update_post_meta( $post_id, $meta_key, Lazhem_Utils::yesno( (string) $value ) );
					} else {
						update_post_meta( $post_id, $meta_key, sanitize_text_field( (string) $value ) );
					}
				}
			}
		}

		if ( 'bungalov' === $post->post_type && isset( $_POST['lazhem_variations'] ) ) {
			$variations = self::sanitize_repeater( wp_unslash( $_POST['lazhem_variations'] ) );
			update_post_meta( $post_id, '_lazhem_bungalov_variations', $variations );
		}

		if ( 'tur' === $post->post_type && isset( $_POST['lazhem_tur_program'] ) ) {
			$program = self::sanitize_repeater( wp_unslash( $_POST['lazhem_tur_program'] ) );
			update_post_meta( $post_id, '_lazhem_tur_program', $program );
		}
	}

	private static function sanitize_repeater( $raw ) {
		if ( ! is_array( $raw ) ) {
			return array();
		}
		$rows = array();
		$keys = array_keys( $raw );
		$count = isset( $keys[0], $raw[ $keys[0] ] ) && is_array( $raw[ $keys[0] ] ) ? count( $raw[ $keys[0] ] ) : 0;
		for ( $i = 0; $i < $count; $i++ ) {
			$row = array();
			foreach ( $raw as $key => $values ) {
				$row[ sanitize_key( $key ) ] = sanitize_text_field( $values[ $i ] ?? '' );
			}
			if ( implode( '', $row ) !== '' ) {
				$rows[] = $row;
			}
		}
		return $rows;
	}
}
