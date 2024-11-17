<?php 
/*
Plugin Name: Spintax Post Creator
Plugin URI: https://robercrea.com/plugins-wordpress/spintax-post-creator/
Description: Create posts and pages using your spintax text
Author: Rober Crea
Author URI: https://robercrea.com/
Version: 1.0
License: GPL2 or later
Text Domain: rc-spintax-post-creator
Domain Path: /languages
*/

// If this file is called directly, exit.
defined('ABSPATH') || exit;

// Set plugin version constant.
if(!function_exists('get_plugin_data')){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$plugin_data = get_plugin_data(__FILE__);

if(!defined('RC_SPC_VERSION')){
    define('RC_SPC_VERSION', $plugin_data['Version']);
}

// Set plugin uri constant.
if(!defined('RC_SPC_URI'))
    define('RC_SPC_URI', $plugin_data['PluginURI']);

// Set plugin url constant.
if(!defined('RC_SPC_URL'))
    define('RC_SPC_URL', plugin_dir_url(__FILE__));

// Load admin files
require_once plugin_dir_path(__FILE__) . 'admin/admin.php';

class RC_SPC {

    function __construct(){
        add_action('plugins_loaded', array($this, 'load_i18n'));
    }

    // Load internationalization.
    function load_i18n(){
        load_plugin_textdomain('rc-spintax-post-creator', false, basename(dirname(__FILE__)).'/languages/');
    }
}

new RC_SPC();