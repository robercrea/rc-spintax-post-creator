<?php if (!defined('ABSPATH')) exit;

// Load creator
require_once plugin_dir_path(__FILE__) . 'lib/creator.php';

// Load menu files
require_once plugin_dir_path(__FILE__) . 'menu/register.php';

class RC_SPC_Admin {
    function __construct(){
        if(is_admin())
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    // Enqueue admin css and js files
    function enqueue_scripts(){
        $admin_css = plugins_url('/css/admin.css', __FILE__);
        $admin_js = plugins_url('/js/admin.js', __FILE__);
        $i18n_path = RC_SPC_URL . '/languages';
    
        // Load admin css
        wp_enqueue_style('rc_spc_style', $admin_css, array(), RC_SPC_VERSION);

        // Load admin js with ajax and localization
        wp_enqueue_script('rc_spc_script', $admin_js, array('jquery', 'wp-i18n'), RC_SPC_VERSION, true);
        wp_localize_script('rc_spc_script', 'rc_spc_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
        wp_set_script_translations( 'rc_scp_script', 'rc-spintax-post-creator', $i18n_path );        
    }
}

new RC_SPC_Admin();