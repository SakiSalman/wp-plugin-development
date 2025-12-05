<?php
/*
 * Plugin Name:       Admin Panel Demo
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       admin-panel-plugin
 */


/**
 * Register a custom menu page.
 */
function registerAdminPanelMenu()
{
    add_menu_page(
        __('Admin Panel', 'textdomain'),
        __('Admin Panel', 'textdomain'),
        'manage_options',
        'admin-panel',
        'apd_render_admin_panel',
        'dashicons-admin-site-alt2',
        6
    );
}
add_action('admin_menu', 'registerAdminPanelMenu');



add_action('admin_enqueue_scripts', 'regisdter_plugins_assets');


function regisdter_plugins_assets($hook)
{
    if ($hook != 'toplevel_page_admin-panel') {
        return;
    }
    wp_enqueue_style('admin-panel', plugin_dir_url(__FILE__) . 'pages/admin.css', [], '1.0', 'all');
    // If you have a JS file to include in the future, uncomment below:
    wp_enqueue_script('admin-panel-js', plugin_dir_url(__FILE__) . 'pages/admin.js', [], '1.0', true);
}
;

function apd_render_admin_panel()
{
    include plugin_dir_path(__FILE__) . 'pages/admin.html';
}
