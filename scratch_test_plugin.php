<?php
define('ABSPATH', true);
define('ECE_PLUGIN_DIR', __DIR__ . '/wp-content/plugins/eternal-content-editor/');
define('ECE_PLUGIN_URL', 'http://localhost/lazhem/wp-content/plugins/eternal-content-editor/');

function plugin_dir_path($file) { return ECE_PLUGIN_DIR; }
function plugin_dir_url($file) { return ECE_PLUGIN_URL; }
function sanitize_key($k) { return $k; }
function get_option($k, $d) { return $d; }
function add_action($a, $b) {}
function is_admin() { return true; }

require_once 'wp-content/plugins/eternal-content-editor/eternal-content-editor.php';
echo "Plugin loaded successfully!\n";
