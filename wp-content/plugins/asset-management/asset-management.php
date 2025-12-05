<?php
/*
 * Plugin Name:       Asset Management
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



defined('ABSPATH') or die();

if (!defined('ASSET_URL')) {
    define('ASSET_URL', plugin_dir_url(__FILE__) . "assets/");
}
if (!defined('DEFINED_ASSET_VERSION')) {
    define('DEFINED_ASSET_VERSION', '1.0.0');
}

class assets_management_demo
{
    function __construct()
    {
        // add_action('wp_head', [$this, 'head_scripts']);
        // add_action('wp_footer', [$this, 'head_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
    }


    function load_assets(){
        wp_enqueue_script('amd-main-js', ASSET_URL.'js/script.js', [],DEFINED_ASSET_VERSION, [
            'in_footer'=>true
        ] );
    }
    // function head_scripts()
    // {
    //     $url = plugin_dir_url(__FILE__);
    //     echo "<script>console.log('" . ASSET_URL . "');</script>";
    // }
}

new assets_management_demo();