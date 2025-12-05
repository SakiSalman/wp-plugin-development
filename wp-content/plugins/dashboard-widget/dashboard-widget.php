<?php
/*
 * Plugin Name:       Dashboard Widgets
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 */

defined(constant_name: 'ABSPATH') or exit;

define("ADMIN_ASSETS_URL", plugin_dir_url(__FILE__) . 'assets/admin/');
define("ADMIN_ASSETS_PATH", plugin_dir_path(__FILE__));


class Dashboard_widget
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);
        $this->load_dependencies();
        $this->initialization();
    }

    public function load_admin_assets()
    {

    }
    function load_dependencies()
    {
        require_once(ADMIN_ASSETS_PATH . 'widgets/basic-widget.php');
        require_once(ADMIN_ASSETS_PATH . 'shortcodes/class-basic-shortcode.php');
    }
    function initialization()
    {
        new Basic_widget();
        new Basic_Shortcode();
    }
}


add_action('plugins_loaded', function () {
    new Dashboard_widget();
});