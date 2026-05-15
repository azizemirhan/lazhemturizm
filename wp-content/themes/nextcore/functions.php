<?php
/**
 * nextcore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nextcore
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

require_once get_template_directory() . '/inc/lazhem-about-defaults.php';
require_once get_template_directory() . '/inc/lazhem-kvkk-defaults.php';
require_once get_template_directory() . '/inc/lazhem-terms-defaults.php';
require_once get_template_directory() . '/inc/lazhem-privacy-defaults.php';
require_once get_template_directory() . '/inc/lazhem-cookies-defaults.php';
require_once get_template_directory() . '/inc/lazhem-sales-defaults.php';
require_once get_template_directory() . '/inc/lazhem-refund-defaults.php';

/**
 * Next Content: dolu değer döndürür; boşsa varsayılan.
 *
 * @param string $key eternal_general_{$key}.
 * @param string $default
 * @return string
 */
function lazhem_nc( $key, $default = '' ) {
	if ( function_exists( 'ece_general_get' ) ) {
		$v = ece_general_get( $key, '' );
		if ( is_string( $v ) && trim( $v ) !== '' ) {
			return $v;
		}
	}
	return $default;
}

/**
 * Footer için seçilen bölgeleri döner.
 *
 * @return WP_Term[]
 */
/**
 * Footer için seçilen bölgeleri döner.
 *
 * @return WP_Term[]
 */
function lazhem_nc_footer_regions() {
	if ( ! function_exists( 'ece_general_get' ) || ! taxonomy_exists( 'listing_region' ) ) {
		return array();
	}
	$ids = ece_general_get( 'footer_region_ids', array() );
	if ( ! is_array( $ids ) || empty( $ids ) ) {
		return array();
	}
	$terms = get_terms(
		array(
			'taxonomy'   => 'listing_region',
			'include'    => $ids,
			'hide_empty' => false,
			'orderby'    => 'include', // Seçim sırasına göre
		)
	);
	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * @param string $phone_display Görünen numara veya sadece rakamlar.
 * @return string tel:+… href
 */
function lazhem_nc_tel_href( $phone_display ) {
	$digits = preg_replace( '/\D+/', '', (string) $phone_display );
	if ( $digits === '' ) {
		return '';
	}
	return 'tel:+' . ltrim( $digits, '+' );
}

/**
 * Şablona atanmış yayınlanmış sayfanın URL’si; yoksa yedek path.
 *
 * @param string $template Dosya adı, örn. template-listings.php
 * @param string $fallback_path home_url için path, örn. /ilanlar
 */
function lazhem_page_url_by_template( $template, $fallback_path = '/' ) {
	static $cache = array();
	$key = $template . "\0" . $fallback_path;
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$posts = get_posts(
		array(
			'post_type'              => 'page',
			'posts_per_page'         => 1,
			'post_status'            => 'publish',
			'meta_key'               => '_wp_page_template',
			'meta_value'             => $template,
			'orderby'                  => 'menu_order',
			'order'                    => 'ASC',
			'no_found_rows'            => true,
			'update_post_meta_cache'   => false,
			'update_post_term_cache'   => false,
		)
	);
	if ( ! empty( $posts[0] ) && $posts[0] instanceof WP_Post ) {
		$cache[ $key ] = get_permalink( $posts[0] );
		return $cache[ $key ];
	}
	$path = '/' . ltrim( (string) $fallback_path, '/' );
	$cache[ $key ] = home_url( $path );
	return $cache[ $key ];
}

/**
 * İlanlar sayfası + listing_cat ön seçimi. Önce slug adayları, sonra tam ada göre listing_cat aranır.
 *
 * @param string[] $slug_hints Örn. array( 'balayi', 'balayi-paketleri' ).
 * @param string[] $name_hints Örn. array( 'Balayı' ).
 */
function lazhem_listings_url_with_category_hints( array $slug_hints, array $name_hints = array() ) {
	$base = lazhem_page_url_by_template( 'template-listings.php', '/ilanlar' );
	if ( ! taxonomy_exists( 'listing_cat' ) ) {
		return $base;
	}
	foreach ( $slug_hints as $s ) {
		$slug = sanitize_title( (string) $s );
		if ( $slug === '' ) {
			continue;
		}
		$t = get_term_by( 'slug', $slug, 'listing_cat' );
		if ( $t && ! is_wp_error( $t ) ) {
			return add_query_arg( array( 'listing_cat' => array( $t->slug ) ), $base );
		}
	}
	foreach ( $name_hints as $n ) {
		$n = (string) $n;
		if ( $n === '' ) {
			continue;
		}
		$t = get_term_by( 'name', $n, 'listing_cat' );
		if ( $t && ! is_wp_error( $t ) ) {
			return add_query_arg( array( 'listing_cat' => array( $t->slug ) ), $base );
		}
	}
	return $base;
}

/**
 * Metinden TL tutarı (rakam dışını atar; 4.500 → 4500).
 */
function lazhem_parse_tl_number( $raw ) {
	$s = preg_replace( '/\D+/', '', (string) $raw );
	return ( $s === '' ) ? 0.0 : (float) $s;
}

/**
 * İlan meta _lazhem_listing_data için gösterim fiyatı (önce indirimli).
 *
 * @param mixed $data
 */
function lazhem_listing_effective_price_tl( $data ) {
	if ( ! is_array( $data ) ) {
		return 0.0;
	}
	$sale = lazhem_parse_tl_number( $data['sale_price'] ?? '' );
	$reg  = lazhem_parse_tl_number( $data['regular_price'] ?? '' );
	if ( $sale > 0 ) {
		return $sale;
	}
	return $reg > 0 ? $reg : 0.0;
}

/**
 * Mega menü kartları — önce Next Content’te seçilen bölgeler (listing_region, en fazla 4);
 * boşsa eski manuel satırlar; o da boşsa tema varsayılanları.
 *
 * @return array<int, array{name:string,meta:string,image:string,url:string}>
 */
function lazhem_nc_mega_destinations() {
	$out = array();

	if ( function_exists( 'ece_general_get' ) && taxonomy_exists( 'listing_region' ) ) {
		$ids = ece_general_get( 'mega_region_ids', array() );
		if ( is_array( $ids ) ) {
			$ids = array_values( array_unique( array_filter( array_map( 'absint', $ids ) ) ) );
			$ids = array_slice( $ids, 0, 4 );
			foreach ( $ids as $tid ) {
				$term = get_term( $tid, 'listing_region' );
				if ( ! $term || is_wp_error( $term ) ) {
					continue;
				}
				if ( class_exists( 'Lazhem_Utils' ) ) {
					$card = Lazhem_Utils::get_listing_region_card( $term );
				} else {
					$link = get_term_link( $term );
					$desc = isset( $term->description ) ? (string) $term->description : '';
					$card = array(
						'title'     => $term->name,
						'subtitle'  => $desc !== '' ? wp_strip_all_tags( $desc ) : '',
						'image_url' => '',
						'url'       => is_wp_error( $link ) ? '' : (string) $link,
					);
				}
				if ( ! $card ) {
					continue;
				}
				$img = isset( $card['image_url'] ) ? trim( (string) $card['image_url'] ) : '';
				if ( $img === '' ) {
					$img = trailingslashit( get_template_directory_uri() ) . 'assets/images/ayder-yaylasi-hero.png';
				}
				$out[] = array(
					'name'  => isset( $card['title'] ) ? (string) $card['title'] : $term->name,
					'meta'  => isset( $card['subtitle'] ) ? (string) $card['subtitle'] : '',
					'image' => $img,
					'url'   => isset( $card['url'] ) ? (string) $card['url'] : '',
				);
			}
		}
	}

	if ( $out !== array() ) {
		return $out;
	}

	$rows = function_exists( 'ece_general_get' ) ? ece_general_get( 'mega_destinations', array() ) : array();
	if ( ! is_array( $rows ) ) {
		$rows = array();
	}
	foreach ( $rows as $row ) {
		if ( ! is_array( $row ) ) {
			continue;
		}
		$name  = isset( $row['name'] ) ? trim( (string) $row['name'] ) : '';
		$meta  = isset( $row['meta'] ) ? trim( (string) $row['meta'] ) : '';
		$image = isset( $row['image'] ) ? trim( (string) $row['image'] ) : '';
		$url   = isset( $row['url'] ) ? trim( (string) $row['url'] ) : '';
		if ( $name === '' && $image === '' ) {
			continue;
		}
		$out[] = compact( 'name', 'meta', 'image', 'url' );
	}
	if ( $out !== array() ) {
		return $out;
	}
	$t = get_template_directory_uri();
	return array(
		array( 'name' => 'Ayder Yaylası', 'meta' => '1.350m · Rize', 'image' => $t . '/assets/images/ayder-yaylasi-hero.png', 'url' => home_url( '/ayder' ) ),
		array( 'name' => 'Uzungöl', 'meta' => 'Trabzon · Çaykara', 'image' => $t . '/assets/images/uzungol-lake.png', 'url' => home_url( '/uzungol' ) ),
		array( 'name' => 'Çay Bahçeleri', 'meta' => 'Rize · İyidere', 'image' => $t . '/assets/images/rize-tea-plantations.png', 'url' => '#' ),
		array( 'name' => 'Mavigöl', 'meta' => 'Giresun · Dereli', 'image' => $t . '/assets/images/mavigol-mysterious.png', 'url' => home_url( '/mavigol' ) ),
		array( 'name' => 'Pokut Yaylası', 'meta' => '2.100m · Çamlıhemşin', 'image' => $t . '/assets/images/pokut-plateau-aerial.png', 'url' => home_url( '/pokut' ) ),
		array( 'name' => 'Karagöl', 'meta' => 'Borçka · Artvin', 'image' => $t . '/assets/images/karagol-snow.png', 'url' => '#' ),
		array( 'name' => 'Batum', 'meta' => 'Gürcistan', 'image' => $t . '/assets/images/batum-seaside.png', 'url' => home_url( '/batum' ) ),
		array( 'name' => 'Sumela Manastırı', 'meta' => 'Maçka · Trabzon', 'image' => $t . '/assets/images/sumela-monastery.png', 'url' => home_url( '/sumela' ) ),
	);
}

/**
 * @return array<int, array{label:string,url:string}>
 */
function lazhem_nc_legal_links() {
	$rows = function_exists( 'ece_general_get' ) ? ece_general_get( 'legal_links', array() ) : array();
	if ( ! is_array( $rows ) ) {
		$rows = array();
	}
	$out = array();
	foreach ( $rows as $row ) {
		if ( ! is_array( $row ) ) {
			continue;
		}
		$label = isset( $row['label'] ) ? trim( (string) $row['label'] ) : '';
		$url   = isset( $row['url'] ) ? trim( (string) $row['url'] ) : '';
		if ( $label === '' && $url === '' ) {
			continue;
		}
		$out[] = array( 'label' => $label, 'url' => $url );
	}
	if ( $out !== array() ) {
		return $out;
	}
	return array(
		array( 'label' => 'KVKK Aydınlatma Metni', 'url' => lazhem_page_url_by_template( 'template-kvkk.php', '/kvkk-aydinlatma' ) ),
		array( 'label' => 'İptal & İade', 'url' => lazhem_page_url_by_template( 'template-refund.php', '/iptal-iade' ) ),
	);
}


/**
 * Hakkımızda Next Content (eternal_about_*).
 *
 * @param string $key eternal_about_{$key} — örn. ab_hero_eyebrow.
 * @param mixed  $default
 * @return mixed
 */
function lazhem_about( $key, $default = '' ) {
	$k = 'eternal_about_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * İletişim sayfası Next Content (eternal_contact_*).
 *
 * @param string $key eternal_contact_{$key} — örn. ct_hero_eyebrow.
 * @param mixed  $default
 * @return mixed
 */
function lazhem_contact( $key, $default = '' ) {
	$k = 'eternal_contact_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * KVKK Sayfası Next Content (eternal_kvkk_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_kvkk( $key, $default = '' ) {
	$k = 'eternal_kvkk_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * Kullanım Koşulları Sayfası Next Content (eternal_terms_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_terms( $key, $default = '' ) {
	$k = 'eternal_terms_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * Gizlilik Politikası Sayfası Next Content (eternal_privacy_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_privacy( $key, $default = '' ) {
	$k = 'eternal_privacy_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * Çerez Politikası Sayfası Next Content (eternal_cookies_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_cookies( $key, $default = '' ) {
	$k = 'eternal_cookies_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * Mesafeli Satış Sözleşmesi Sayfası Next Content (eternal_sales_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_sales( $key, $default = '' ) {
	$k = 'eternal_sales_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * İptal & İade Sayfası Next Content (eternal_refund_*).
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function lazhem_refund( $key, $default = '' ) {
	$k = 'eternal_refund_' . sanitize_key( $key );
	$v = get_option( $k, '__lazhem_missing__' );
	if ( $v === '__lazhem_missing__' ) {
		return $default;
	}
	if ( is_string( $v ) && trim( $v ) === '' ) {
		return $default;
	}
	return $v;
}

/**
 * @return array<int, array{num:string,title:string,text:string}>
 */
function lazhem_about_philosophy_cards() {
	$defaults = lazhem_about_default_philosophy_cards();
	$saved     = lazhem_about( 'philosophy_cards', null );
	if ( ! is_array( $saved ) || $saved === array() ) {
		return $defaults;
	}
	$saved = array_values( $saved );
	$out   = array();
	$n     = max( count( $saved ), count( $defaults ) );
	for ( $i = 0; $i < $n; $i++ ) {
		$def = isset( $defaults[ $i ] ) ? $defaults[ $i ] : $defaults[0];
		if ( ! isset( $saved[ $i ] ) || ! is_array( $saved[ $i ] ) ) {
			$out[] = $def;
			continue;
		}
		$out[] = array_merge( $def, array_intersect_key( $saved[ $i ], $def ) );
	}
	return $out;
}

/**
 * @return array<int, string>
 */
function lazhem_about_comfort_bullets() {
	$defaults = lazhem_about_default_comfort_bullets();
	$saved    = lazhem_about( 'comfort_bullets', null );
	if ( ! is_array( $saved ) || $saved === array() ) {
		return $defaults;
	}
	$saved = array_values(
		array_filter(
			array_map( 'strval', $saved ),
			static function ( $s ) {
				return trim( $s ) !== '';
			}
		)
	);
	return $saved !== array() ? $saved : $defaults;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nextcore_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on nextcore, use a find and replace
		* to change 'nextcore' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nextcore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nextcore' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nextcore_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nextcore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nextcore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nextcore_content_width', 640 );
}
add_action( 'after_setup_theme', 'nextcore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nextcore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nextcore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nextcore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nextcore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nextcore_scripts() {
	wp_enqueue_style( 'nextcore-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'nextcore-style', 'rtl', 'replace' );

	wp_enqueue_style( 'lazhem-style', get_template_directory_uri() . '/assets/css/lazhem-style.css', array(), time() );
	wp_enqueue_script( 'lazhem-scripts', get_template_directory_uri() . '/assets/js/lazhem-scripts.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'nextcore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nextcore_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Anasayfa tasarım şablonu (template-home.php) kullanılıyor mu?
 * is_page_template bazı önbellek / ön yüz kurulumlarında kaçırılabildiği için page_on_front yedeği var.
 */

/**
 * İlanlar / anasayfa şablonunda #page.site üzerindeki max-width kısıtını CSS ile bypass etmek için.
 *
 * @param string[] $classes
 * @return string[]
 */
function lazhem_listings_body_class( $classes ) {
	if ( is_page_template( 'template-listings.php' ) ) {
		$classes[] = 'lazhem-listings-fullwidth';
	}
	return $classes;
}
add_filter( 'body_class', 'lazhem_listings_body_class' );

