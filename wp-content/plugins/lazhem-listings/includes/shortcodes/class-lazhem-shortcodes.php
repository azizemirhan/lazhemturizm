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
		$atts = shortcode_atts( array( 'type' => 'tur' ), $atts, 'lazhem_listings' );
		$type = sanitize_key( $atts['type'] );

		$query = new WP_Query(
			array(
				'post_type'      => $type,
				'posts_per_page' => 12,
			)
		);

		ob_start();
		echo '<div class="items-grid">'; // Theme CSS classını kullanıyoruz
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			$data    = get_post_meta( $post_id, '_lazhem_listing_data', true );
			$price   = $data['regular_price'] ?? '';
			$sale    = $data['sale_price'] ?? '';
			$loc     = $data['location'] ?? '';
			
			?>
			<a href="<?php the_permalink(); ?>" class="item-card">
				<div class="item-card__img-wrap">
					<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium_large', array( 'class' => 'item-card__img' ) ); endif; ?>
				</div>
				<div class="item-card__content">
					<span class="item-card__type">İlan</span>
					<h3 class="item-card__title"><?php the_title(); ?></h3>
					<div class="item-card__meta">
						<span class="item-card__meta-item">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<?php echo esc_html( $loc ); ?>
						</span>
					</div>
					<div class="item-card__footer">
						<div class="item-card__price">
							<span class="price-label">Fiyat</span>
							<span class="price-value">
								<?php if($sale): ?>
									<small style="text-decoration:line-through;opacity:0.6;font-size:0.7em;">₺<?php echo esc_html($price); ?></small>
									₺<?php echo esc_html($sale); ?>
								<?php else: ?>
									₺<?php echo esc_html($price); ?>
								<?php endif; ?>
							</span>
						</div>
						<span class="btn-detail">İncele</span>
					</div>
				</div>
			</a>
			<?php
		}
		echo '</div>';
		wp_reset_postdata();
		return ob_get_clean();
	}

	public static function featured( $atts ) {
		return self::listings( $atts );
	}

	public static function inquiry_form( $atts ) {
		ob_start();
		include LAZHEM_LISTINGS_PATH . 'templates/parts/inquiry-form.php';
		return ob_get_clean();
	}

	public static function related_items( $atts ) {
		return '';
	}
}
