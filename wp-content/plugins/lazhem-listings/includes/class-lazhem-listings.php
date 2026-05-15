<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lazhem_Listings {
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->includes();
		$this->hooks();
	}

	private function includes() {
		require_once LAZHEM_LISTINGS_PATH . 'includes/helpers/class-lazhem-utils.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/cpt/class-lazhem-cpt.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/meta/class-lazhem-meta-boxes.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/meta/class-lazhem-taxonomy-meta.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/data/class-lazhem-region-seeder.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/admin/class-lazhem-settings.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/frontend/class-lazhem-frontend.php';
		require_once LAZHEM_LISTINGS_PATH . 'includes/shortcodes/class-lazhem-shortcodes.php';
	}

	private function hooks() {
		register_activation_hook( LAZHEM_LISTINGS_PATH . 'lazhem-listings.php', array( $this, 'activate' ) );
		register_deactivation_hook( LAZHEM_LISTINGS_PATH . 'lazhem-listings.php', array( $this, 'deactivate' ) );

		add_action( 'init', array( 'Lazhem_CPT', 'register_all' ) );
		add_action( 'init', array( 'Lazhem_Taxonomy_Meta', 'init' ), 20 );
		add_action( 'init', array( 'Lazhem_Region_Seeder', 'maybe_flatten_parents' ), 90 );
		add_action( 'init', array( 'Lazhem_Region_Seeder', 'maybe_seed' ), 120 );
		add_action( 'init', array( 'Lazhem_Shortcodes', 'register' ) );
		add_action( 'init', array( 'Lazhem_Frontend', 'register_handlers' ) );
		add_action( 'admin_menu', array( 'Lazhem_Settings', 'register_menu' ) );
		add_action( 'admin_init', array( 'Lazhem_Settings', 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'maybe_flush_rules' ) );
		add_action( 'add_meta_boxes', array( 'Lazhem_Meta_Boxes', 'register' ) );
		add_action( 'save_post', array( 'Lazhem_Meta_Boxes', 'save' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( 'Lazhem_Frontend', 'enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( 'Lazhem_Meta_Boxes', 'enqueue_admin_assets' ) );
		add_filter( 'template_include', array( 'Lazhem_Frontend', 'template_include' ) );
	}

	public function activate() {
		Lazhem_CPT::register_all();
		flush_rewrite_rules();
		update_option( 'lazhem_flush_needed', '1' );
	}

	public function deactivate() {
		flush_rewrite_rules();
		delete_option( 'lazhem_flush_needed' );
	}

	public function maybe_flush_rules() {
		if ( '1' === get_option( 'lazhem_flush_needed' ) ) {
			flush_rewrite_rules();
			delete_option( 'lazhem_flush_needed' );
		}
	}
}
