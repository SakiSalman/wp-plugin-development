<?php
/*
 * Plugin Name:       Admin Assets
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 */

defined(constant_name: 'ABSPATH') or exit;

define("ADMIN_ASSETS_URL", plugin_dir_url(__FILE__) . 'assets/admin/');
class Admin_Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);
    }

    public function load_admin_assets($hook)
    {
        // if($hook != 'index.php'){
        //     return;
        // }

        $allowed_pages = [
            'index.php'
        ];

        if (in_array($hook, $allowed_pages)!=false) {
            wp_enqueue_style('admin-assets-style-css', ADMIN_ASSETS_URL.'css/style.css', []);
            wp_enqueue_script(
                'admin-assets-main-js',
                ADMIN_ASSETS_URL . 'js/admin.js',
                [],
                '1.0.1',
                true
            );
        }
        
    }
}


new Admin_Assets();