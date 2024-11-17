<?php if (!defined('ABSPATH')) exit;

class RC_SPC_Register {

    private $slug = "rc-spc-menu"; //Default plugin menu slug

    function __construct(){
        if(is_admin()){
            add_action('admin_menu', array($this, 'register'));
        }
    }

    // Register admin menu pages
    function register(){
        
        // Register parent Menu
        add_menu_page(__('Spintax creator', 'rc-spintax-post-creator'), 
        __('Spintax', 'rc-spintax-post-creator'),
        'manage_options',
        $this->slug, 
        array($this, 'main_page'), 
        'dashicons-admin-page', 
        100);

        // Register menu subpage        
        add_submenu_page(
            $this->slug,
            __('Spintax', 'rc-spintax-post-creator'),
            __('Spintax', 'rc-spintax-post-creator'),
            "manage_options",
            $this->slug,
            array($this, "main_page"),
            1
        );
    }

    // Main page
    function main_page(){
        require_once plugin_dir_path(__FILE__) . 'pages/main.php';
    }

}

new RC_SPC_Register();