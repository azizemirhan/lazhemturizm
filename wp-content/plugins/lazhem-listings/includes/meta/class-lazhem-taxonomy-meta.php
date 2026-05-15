<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * İlan Bölgeleri (listing_region) — Başlık, kısa açıklama, görsel (çekirdek alanlar gizli).
 */
class Lazhem_Taxonomy_Meta {

	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'sync_region_request_post' ), 0 );

		add_action( 'listing_region_add_form_fields', array( __CLASS__, 'add_region_fields' ), 10 );
		add_action( 'listing_region_edit_form_fields', array( __CLASS__, 'edit_region_fields' ), 10, 2 );

		add_action( 'created_listing_region', array( __CLASS__, 'save_region_meta' ), 10, 1 );
		add_action( 'edited_listing_region', array( __CLASS__, 'save_region_meta' ), 10, 1 );

		add_filter( 'pre_insert_term', array( __CLASS__, 'pre_insert_region_term_name' ), 10, 3 );

		add_action( 'admin_head', array( __CLASS__, 'hide_core_region_fields_css' ) );
		add_action( 'admin_footer', array( __CLASS__, 'disable_core_region_inputs_script' ) );

		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Çekirdek taksonomi alanlarına (tag-name / name / description) bizim alanlardan değer aktar.
	 */
	public static function sync_region_request_post() {
		if ( ! is_admin() || empty( $_POST['taxonomy'] ) || 'listing_region' !== $_POST['taxonomy'] ) {
			return;
		}

		$action = isset( $_POST['action'] ) ? sanitize_key( wp_unslash( $_POST['action'] ) ) : '';

		$title = '';
		if ( isset( $_POST['lazhem_region_title'] ) ) {
			$title = sanitize_text_field( wp_unslash( (string) $_POST['lazhem_region_title'] ) );
		}

		$short = '';
		if ( isset( $_POST['region_meta']['short_description'] ) ) {
			$short = sanitize_text_field( wp_unslash( (string) $_POST['region_meta']['short_description'] ) );
		}

		if ( 'add-tag' === $action ) {
			if ( $title !== '' ) {
				$_POST['tag-name'] = $title;
			}
			$_POST['description'] = $short;
			$_POST['slug']         = '';
		}

		if ( 'editedtag' === $action ) {
			if ( $title !== '' ) {
				$_POST['name'] = $title;
			}
			$_POST['description'] = $short;
			$_POST['slug']       = '';
		}
	}

	/**
	 * tag-name boş kaldıysa yedek olarak başlık meta alanından ad üret.
	 *
	 * @param string|WP_Error $term
	 * @return string|WP_Error
	 */
	public static function pre_insert_region_term_name( $term, $taxonomy, $args ) {
		if ( 'listing_region' !== $taxonomy || is_wp_error( $term ) ) {
			return $term;
		}
		if ( is_string( $term ) && trim( $term ) !== '' ) {
			return $term;
		}
		if ( ! empty( $_POST['lazhem_region_title'] ) ) {
			return sanitize_text_field( wp_unslash( (string) $_POST['lazhem_region_title'] ) );
		}
		return $term;
	}

	public static function hide_core_region_fields_css() {
		$tax = isset( $_GET['taxonomy'] ) ? sanitize_key( wp_unslash( $_GET['taxonomy'] ) ) : '';
		if ( 'listing_region' !== $tax ) {
			return;
		}
		?>
		<style id="lazhem-region-hide-core-fields">
			body.taxonomy-listing_region .term-name-wrap,
			body.taxonomy-listing_region .term-slug-wrap,
			body.taxonomy-listing_region .term-description-wrap { display: none !important; }
		</style>
		<?php
	}

	public static function disable_core_region_inputs_script() {
		$tax = isset( $_GET['taxonomy'] ) ? sanitize_key( wp_unslash( $_GET['taxonomy'] ) ) : '';
		if ( 'listing_region' !== $tax ) {
			return;
		}
		?>
		<script>
		document.addEventListener('DOMContentLoaded', function () {
			var s = 'input[name="tag-name"], input[name="name"], #tag-name, #name, #tag-slug, #slug, #tag-description, #description';
			document.querySelectorAll(s).forEach(function (el) {
				el.disabled = true;
				el.removeAttribute('required');
				el.removeAttribute('aria-required');
			});
			var focus = document.getElementById('lazhem_region_title');
			if (focus) { try { focus.focus(); } catch (e) {} }
		});
		</script>
		<?php
	}

	public static function enqueue_assets( $hook ) {
		if ( 'edit-tags.php' !== $hook && 'term.php' !== $hook ) {
			return;
		}
		$tax = isset( $_GET['taxonomy'] ) ? sanitize_key( wp_unslash( $_GET['taxonomy'] ) ) : '';
		if ( 'listing_region' !== $tax ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/js/admin.js', array( 'jquery' ), LAZHEM_LISTINGS_VERSION, true );
		wp_enqueue_style( 'lazhem-admin', LAZHEM_LISTINGS_URL . 'assets/css/admin.css', array(), LAZHEM_LISTINGS_VERSION );
	}

	public static function add_region_fields() {
		?>
		<div class="form-field form-required lazhem-region-meta-field">
			<label for="lazhem_region_title"><?php esc_html_e( 'Başlık', 'lazhem-listings' ); ?></label>
			<input type="text" name="lazhem_region_title" id="lazhem_region_title" class="large-text" value="" autocomplete="off" required>
			<p class="description"><?php esc_html_e( 'Bölgenin adı (sitede ve listelerde görünür).', 'lazhem-listings' ); ?></p>
		</div>
		<div class="form-field lazhem-region-meta-field">
			<label for="lazhem_short_description"><?php esc_html_e( 'Kısa açıklama', 'lazhem-listings' ); ?></label>
			<input type="text" name="region_meta[short_description]" id="lazhem_short_description" class="large-text" value="" placeholder="<?php esc_attr_e( 'Örn: Rize · Çamlıhemşin', 'lazhem-listings' ); ?>">
			<p class="description"><?php esc_html_e( 'Kartta alt satır; ayrıca taksonomi açıklamasına yazılır.', 'lazhem-listings' ); ?></p>
		</div>
		<div class="form-field lazhem-region-meta-field">
			<label><?php esc_html_e( 'Bölge görseli', 'lazhem-listings' ); ?></label>
			<div class="lazhem-media-wrap">
				<button type="button" class="button lazhem-media-upload" data-multi="false"><?php esc_html_e( 'Ortamdan seç', 'lazhem-listings' ); ?></button>
				<input type="hidden" class="lazhem-media-id" name="region_meta[image_id]" value="">
				<div class="lazhem-media-preview"></div>
			</div>
		</div>
		<?php
	}

	public static function edit_region_fields( $term, $taxonomy ) {
		$short_desc = get_term_meta( $term->term_id, '_lazhem_short_description', true );
		if ( ( ! is_string( $short_desc ) || trim( $short_desc ) === '' ) && ! empty( $term->description ) ) {
			$short_desc = $term->description;
		}
		$image_id = (int) get_term_meta( $term->term_id, '_lazhem_image_id', true );
		?>
		<tr class="form-field form-required lazhem-region-meta-field">
			<th scope="row"><label for="lazhem_region_title"><?php esc_html_e( 'Başlık', 'lazhem-listings' ); ?></label></th>
			<td>
				<input type="text" name="lazhem_region_title" id="lazhem_region_title" class="large-text" value="<?php echo esc_attr( $term->name ); ?>" autocomplete="off" required>
			</td>
		</tr>
		<tr class="form-field lazhem-region-meta-field">
			<th scope="row"><label for="lazhem_short_description"><?php esc_html_e( 'Kısa açıklama', 'lazhem-listings' ); ?></label></th>
			<td>
				<input type="text" name="region_meta[short_description]" id="lazhem_short_description" class="large-text" value="<?php echo esc_attr( $short_desc ); ?>">
			</td>
		</tr>
		<tr class="form-field lazhem-region-meta-field">
			<th scope="row"><label><?php esc_html_e( 'Bölge görseli', 'lazhem-listings' ); ?></label></th>
			<td>
				<div class="lazhem-media-wrap">
					<button type="button" class="button lazhem-media-upload" data-multi="false"><?php esc_html_e( 'Ortamdan seç', 'lazhem-listings' ); ?></button>
					<input type="hidden" class="lazhem-media-id" name="region_meta[image_id]" value="<?php echo esc_attr( (string) $image_id ); ?>">
					<div class="lazhem-media-preview">
						<?php
						if ( $image_id ) {
							$url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
							if ( $url ) {
								echo '<div class="lazhem-preview-item"><img src="' . esc_url( $url ) . '" alt=""><span class="remove-img">×</span></div>';
							}
						}
						?>
					</div>
				</div>
			</td>
		</tr>
		<?php
	}

	public static function save_region_meta( $term_id ) {
		if ( ! isset( $_POST['region_meta'] ) || ! is_array( $_POST['region_meta'] ) ) {
			return;
		}

		$tax = get_taxonomy( 'listing_region' );
		if ( ! $tax || ! current_user_can( $tax->cap->edit_terms ) ) {
			return;
		}

		$meta = wp_unslash( $_POST['region_meta'] );

		update_term_meta( $term_id, '_lazhem_short_description', sanitize_text_field( $meta['short_description'] ?? '' ) );
		delete_term_meta( $term_id, '_lazhem_display_title' );

		$img = isset( $meta['image_id'] ) ? $meta['image_id'] : '';
		if ( is_string( $img ) && strpos( $img, ',' ) !== false ) {
			$parts = explode( ',', $img );
			$img   = $parts[0];
		}
		update_term_meta( $term_id, '_lazhem_image_id', absint( $img ) );
	}
}
