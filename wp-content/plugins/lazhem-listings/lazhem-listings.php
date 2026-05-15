<?php
/**
 * Plugin Name: Lazhem Listings
 * Description: Lazhem Turizm icin turizm ilan, paket ve lead toplama altyapisi.
 * Version: 1.1.4
 * Author: Lazhem Turizm
 * Text Domain: lazhem-listings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LAZHEM_LISTINGS_VERSION', '1.1.4' );
define( 'LAZHEM_LISTINGS_PATH', plugin_dir_path( __FILE__ ) );
define( 'LAZHEM_LISTINGS_URL', plugin_dir_url( __FILE__ ) );

require_once LAZHEM_LISTINGS_PATH . 'includes/class-lazhem-listings.php';

function lazhem_listings_bootstrap() {
	return Lazhem_Listings::instance();
}

lazhem_listings_bootstrap();
