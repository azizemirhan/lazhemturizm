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
		if ( ! $post || 'tur' !== $post->post_type ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/js/admin.js', array( 'jquery' ), LAZHEM_LISTINGS_VERSION, true );
		wp_enqueue_style( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/css/admin.css', array(), LAZHEM_LISTINGS_VERSION );
	}

	public static function register() {
		add_meta_box( 'lazhem_listing_data', 'İlan Detayları', array( __CLASS__, 'render_tabs' ), 'tur', 'normal', 'high' );
		
		add_action( 'edit_form_after_title', array( __CLASS__, 'render_base_variation_field' ) );
		
		// Remove WordPress footer text to fix overlap
		add_filter( 'admin_footer_text', '__return_empty_string', 11 );
		add_filter( 'update_footer', '__return_empty_string', 11 );
	}

	public static function render_base_variation_field( $post ) {
		if ( 'tur' !== $post->post_type ) return;
		$options = get_post_meta( $post->ID, '_lazhem_listing_data', true );
		$options = is_array( $options ) ? $options : array();
		$value = $options['base_variation_name'] ?? '';
		?>
		<div style="margin-top: 20px; background: #fff; padding: 15px; border: 1px solid #ccd0d4; border-radius: 4px;">
			<label style="font-weight: 600; display: block; margin-bottom: 8px;">Ana Varyasyon Adı (Örn: Standart Paket)</label>
			<input type="text" name="lazhem_listing[base_variation_name]" value="<?php echo esc_attr($value); ?>" style="width: 100%; height: 40px; font-size: 14px;" placeholder="Bu ilan için ana varyasyon ismini girin...">
			<p class="description">İlan detay sayfasında ilk varyasyon butonu olarak bu isim görünecektir.</p>
		</div>
		<?php
	}

	public static function render_tabs( $post ) {
		wp_nonce_field( 'lazhem_save_listing', 'lazhem_listing_nonce' );
		$options = get_post_meta( $post->ID, '_lazhem_listing_data', true );
		$options = is_array( $options ) ? $options : array();
		?>
		<div class="lazhem-meta-container">
			<ul class="lazhem-tabs-nav">
				<li class="active"><a href="#tab-general">Genel Bilgiler</a></li>
				<li><a href="#tab-gallery">Ana Galeri</a></li>
				<li><a href="#tab-variations">Varyasyonlar (3+1, 4+1 vb.)</a></li>
			</ul>

			<!-- TAB: GENEL -->
			<div id="tab-general" class="lazhem-tab-content active">
					<?php 
					self::field( 'is_featured', 'Anasayfada Göster (Slider)', $options, 'checkbox' );
					self::field( 'regular_price', 'Normal Fiyat (₺)', $options ); 
					self::field( 'sale_price', 'İndirimli Fiyat (₺)', $options ); 
					self::field( 'duration', 'Tur Süresi (Örn: 2 Gece / 3 Gün)', $options );
					self::field( 'badge_text', 'Rozet Metni (Örn: Yeni Sezon)', $options );
					self::field( 'badge_type', 'Rozet Tipi', $options, 'select', array(
						'default'   => 'Varsayılan',
						'video'     => 'Video (Kırmızı Noktalı)',
						'house'     => 'Konaklama / Ev',
						'honeymoon' => 'Balayı',
						'new'       => 'Yeni',
						'globe'     => 'Yurtdışı',
						'transfer'  => 'Transfer',
					) );
					self::field( 'short_desc', 'Kısa Açıklama', $options, 'textarea' );
					?>
				
				<div class="lazhem-sections-area">
					<h3>Genel Detay Sekmeleri (Akordeon)</h3>
					<p class="description">Tüm ilanı kapsayan genel bilgi sekmeleri (Örn: İptal Şartları, Önemli Bilgiler).</p>
					<div class="lazhem-section-list lazhem-list-container">
						<?php 
						$sections = $options['sections'] ?? array();
						foreach ( $sections as $idx => $s ) {
							self::render_section_item( $idx, $s );
						}
						?>
					</div>
					<button type="button" class="button button-secondary add-repeater-row" data-type="section">Yeni Genel Sekme Ekle</button>
				</div>
			</div>

			<!-- TAB: GALERİ -->
			<div id="tab-gallery" class="lazhem-tab-content">
				<p>İlanın ana galeri görsellerini seçin.</p>
				<?php self::media_field( 'main_gallery', 'Galeri Görselleri', $options, true ); ?>
			</div>

			<!-- TAB: VARYASYONLAR -->
			<div id="tab-variations" class="lazhem-tab-content">
				<div class="lazhem-variation-list lazhem-list-container">
					<?php 
					$variations = $options['variations'] ?? array();
					foreach ( $variations as $idx => $v ) {
						self::render_variation_item( $idx, $v );
					}
					?>
				</div>
				<button type="button" class="button button-primary add-repeater-row" data-type="variation">Yeni Varyasyon Ekle</button>
			</div>
		</div>

		<!-- JS Templates -->
		<script type="text/template" id="tmpl-lazhem-variation">
			<?php self::render_variation_item( '{{index}}' ); ?>
		</script>
		<script type="text/template" id="tmpl-lazhem-section">
			<?php self::render_section_item( '{{index}}' ); ?>
		</script>
		<script type="text/template" id="tmpl-lazhem-var_section">
			<?php self::render_var_section_item( '{{v_index}}', '{{index}}' ); ?>
		</script>
		<?php
	}

	private static function render_variation_item( $index, $data = array() ) {
		?>
		<div class="lazhem-variation-item lazhem-repeater-item" data-index="<?php echo esc_attr( $index ); ?>">
			<div class="lazhem-variation-header">
				<strong>Varyasyon #<?php echo is_numeric($index) ? esc_html($index + 1) : 'Yeni'; ?></strong>
				<span class="remove-repeater-row dashicons dashicons-trash"></span>
			</div>
			<div class="lazhem-variation-body">
				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
					<p><label>Varyasyon Adı (Örn: 3+1 Villa)</label><br>
					<input type="text" name="lazhem_listing[variations][<?php echo esc_attr( $index ); ?>][name]" value="<?php echo esc_attr( $data['name'] ?? '' ); ?>" style="width:100%"></p>
					<p><label>Varyasyon Fiyatı</label><br>
					<input type="number" name="lazhem_listing[variations][<?php echo esc_attr( $index ); ?>][price]" value="<?php echo esc_attr( $data['price'] ?? '' ); ?>" style="width:100%"></p>
				</div>
				
				<div style="margin-top: 10px;">
					<label>Varyasyon Görseli & Galerisi</label>
					<?php self::media_field_var( $index, $data ); ?>
				</div>

				<div style="margin-top: 20px; padding: 15px; background: #fff; border: 1px solid #e5e5e5;">
					<strong style="display:block; margin-bottom:10px;">Bu Varyasyona Özel Sekmeler</strong>
					<div class="lazhem-var_section-list lazhem-list-container">
						<?php 
						$v_sections = $data['sections'] ?? array();
						foreach ( $v_sections as $s_idx => $s ) {
							self::render_var_section_item( $index, $s_idx, $s );
						}
						?>
					</div>
					<button type="button" class="button button-small add-repeater-row" data-type="var_section">Varyasyon Sekmesi Ekle</button>
				</div>
			</div>
		</div>
		<?php
	}

	private static function render_section_item( $index, $data = array() ) {
		?>
		<div class="lazhem-section-item lazhem-repeater-item" data-index="<?php echo esc_attr( $index ); ?>" style="background:#fefefe; border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:4px;">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
				<strong>Genel Sekme #<?php echo is_numeric($index) ? esc_html($index + 1) : 'Yeni'; ?></strong>
				<span class="remove-repeater-row dashicons dashicons-trash" style="color:#d63638; cursor:pointer;"></span>
			</div>
			<p><label>Sekme Başlığı</label><br>
			<input type="text" name="lazhem_listing[sections][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $data['title'] ?? '' ); ?>" style="width:100%"></p>
			<p><label>Sekme İçeriği</label><br>
			<textarea name="lazhem_listing[sections][<?php echo esc_attr( $index ); ?>][content]" rows="3" style="width:100%"><?php echo esc_textarea( $data['content'] ?? '' ); ?></textarea></p>
		</div>
		<?php
	}

	private static function render_var_section_item( $v_index, $s_index, $data = array() ) {
		?>
		<div class="lazhem-var_section-item lazhem-repeater-item" style="border-left: 3px solid #2271b1; padding-left: 10px; margin-bottom: 10px; background: #f9f9f9; padding: 10px;">
			<div style="display:flex; justify-content:space-between; align-items:center;">
				<input type="text" placeholder="Sekme Başlığı" name="lazhem_listing[variations][<?php echo esc_attr( $v_index ); ?>][sections][<?php echo esc_attr( $s_index ); ?>][title]" value="<?php echo esc_attr( $data['title'] ?? '' ); ?>" style="width:40%">
				<span class="remove-repeater-row dashicons dashicons-trash" style="font-size:16px; cursor:pointer; color:#d63638;"></span>
			</div>
			<textarea placeholder="Sekme İçeriği" name="lazhem_listing[variations][<?php echo esc_attr( $v_index ); ?>][sections][<?php echo esc_attr( $s_index ); ?>][content]" rows="2" style="width:100%; margin-top:5px;"><?php echo esc_textarea( $data['content'] ?? '' ); ?></textarea>
		</div>
		<?php
	}

	private static function field( $name, $label, $options, $type = 'text', $select_options = array() ) {
		$value = $options[ $name ] ?? '';
		echo '<div class="lazhem-field-row"><label>' . esc_html( $label ) . '</label><div class="field-input">';
		if ( 'textarea' === $type ) {
			echo '<textarea rows="3" name="lazhem_listing[' . esc_attr( $name ) . ']">' . esc_textarea( $value ) . '</textarea>';
		} elseif ( 'checkbox' === $type ) {
			echo '<input type="checkbox" name="lazhem_listing[' . esc_attr( $name ) . ']" value="1" ' . checked( $value, '1', false ) . '>';
		} elseif ( 'select' === $type ) {
			echo '<select name="lazhem_listing[' . esc_attr( $name ) . ']" style="width:100%">';
			foreach ( $select_options as $val => $lbl ) {
				echo '<option value="' . esc_attr( $val ) . '" ' . selected( $value, $val, false ) . '>' . esc_html( $lbl ) . '</option>';
			}
			echo '</select>';
		} else {
			echo '<input type="' . esc_attr( $type ) . '" name="lazhem_listing[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '">';
		}
		echo '</div></div>';
	}

	private static function media_field( $name, $label, $options, $is_multi = false ) {
		$value = $options[ $name ] ?? '';
		?>
		<div class="lazhem-media-wrap">
			<button type="button" class="button lazhem-media-upload" data-multi="<?php echo $is_multi ? 'true' : 'false'; ?>"><?php echo $is_multi ? 'Galeri Yönet' : 'Görsel Seç'; ?></button>
			<input type="hidden" class="lazhem-media-id" name="lazhem_listing[<?php echo esc_attr( $name ); ?>]" value="<?php echo esc_attr( $value ); ?>">
			<div class="lazhem-media-preview">
				<?php 
				$ids = !empty($value) ? explode(',', $value) : array();
				foreach($ids as $id) {
					$url = wp_get_attachment_image_url($id, 'thumbnail');
					if($url) echo '<div class="lazhem-preview-item" data-id="'.esc_attr($id).'"><img src="'.esc_url($url).'"><span class="remove-img">×</span></div>';
				}
				?>
			</div>
		</div>
		<?php
	}

	private static function media_field_var( $index, $data ) {
		$value = $data['gallery'] ?? '';
		?>
		<div class="lazhem-media-wrap">
			<button type="button" class="button lazhem-media-upload" data-multi="true">Görsel/Galeri Yönet</button>
			<input type="hidden" class="lazhem-media-id" name="lazhem_listing[variations][<?php echo esc_attr( $index ); ?>][gallery]" value="<?php echo esc_attr( $value ); ?>">
			<div class="lazhem-media-preview">
				<?php 
				$ids = !empty($value) ? explode(',', $value) : array();
				foreach($ids as $id) {
					$url = wp_get_attachment_image_url($id, 'thumbnail');
					if($url) echo '<div class="lazhem-preview-item" data-id="'.esc_attr($id).'"><img src="'.esc_url($url).'"><span class="remove-img">×</span></div>';
				}
				?>
			</div>
		</div>
		<?php
	}

	public static function save( $post_id ) {
		if ( ! isset( $_POST['lazhem_listing_nonce'] ) || ! wp_verify_nonce( $_POST['lazhem_listing_nonce'], 'lazhem_save_listing' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['lazhem_listing'] ) ) {
			$data = wp_unslash( $_POST['lazhem_listing'] );
			$clean = array();
			$clean['regular_price'] = sanitize_text_field( $data['regular_price'] ?? '' );
			$clean['sale_price']    = sanitize_text_field( $data['sale_price'] ?? '' );
			$clean['is_featured']   = isset( $data['is_featured'] ) ? '1' : '0';
			$clean['duration']      = sanitize_text_field( $data['duration'] ?? '' );
			$clean['badge_text']    = sanitize_text_field( $data['badge_text'] ?? '' );
			$clean['badge_type']    = sanitize_text_field( $data['badge_type'] ?? 'default' );
			$clean['base_variation_name'] = sanitize_text_field( $data['base_variation_name'] ?? 'Genel Bilgi' );
			$clean['short_desc']    = sanitize_textarea_field( $data['short_desc'] ?? '' );
			$clean['main_gallery']  = sanitize_text_field( $data['main_gallery'] ?? '' );

			// Global Sections
			$clean['sections'] = array();
			if ( ! empty( $data['sections'] ) && is_array( $data['sections'] ) ) {
				foreach ( $data['sections'] as $s ) {
					if ( empty( $s['title'] ) ) continue;
					$clean['sections'][] = array(
						'title'   => sanitize_text_field( $s['title'] ),
						'content' => wp_kses_post( $s['content'] ),
					);
				}
			}

			// Variations with nested sections
			$clean['variations'] = array();
			if ( ! empty( $data['variations'] ) && is_array( $data['variations'] ) ) {
				foreach ( $data['variations'] as $v ) {
					if ( empty( $v['name'] ) ) continue;
					
					$var_clean = array(
						'name'    => sanitize_text_field( $v['name'] ),
						'price'   => sanitize_text_field( $v['price'] ),
						'gallery' => sanitize_text_field( $v['gallery'] ),
						'sections'=> array()
					);

					if ( ! empty( $v['sections'] ) && is_array( $v['sections'] ) ) {
						foreach ( $v['sections'] as $vs ) {
							if ( empty( $vs['title'] ) ) continue;
							$var_clean['sections'][] = array(
								'title'   => sanitize_text_field( $vs['title'] ),
								'content' => wp_kses_post( $vs['content'] ),
							);
						}
					}

					$clean['variations'][] = $var_clean;
				}
			}

			update_post_meta( $post_id, '_lazhem_listing_data', $clean );
		}
	}
}
