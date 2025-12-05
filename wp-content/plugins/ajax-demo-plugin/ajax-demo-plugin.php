<?php

/*
 * Plugin Name:       Ajax Demo Plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 */

defined('ABSPATH') or exit;

define("ADMP_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("ADMP_PLUGIN_URL", plugin_dir_url(__FILE__));

class Ajax_demo_plugin
{
    function __construct()
    {
        $this->include_resources();
        $this->init();
        // Correct timing
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
        add_action('admin_enqueue_scripts', [$this, 'load_assets']);
    }

    function include_resources()
    {
        include_once(ADMP_PLUGIN_PATH . 'includes/class-shortcode-button.php');
        include_once(ADMP_PLUGIN_PATH . 'includes/class-demo-widget.php');
        include_once(ADMP_PLUGIN_PATH . 'includes/class-contact-form.php');
    }

    function init()
    {
        new Shortcode_button_demo();
        new DEMO_WiDGET();
        new ADMP_CONTACT_FORM();
    }

    function load_assets()
    {
        wp_enqueue_script('admp-js', ADMP_PLUGIN_URL . "assets/js/ajax-demo.js", [], time(), true);

        // Nonce must be created AFTER WP loads — now it is safe
        $contactNonce = wp_create_nonce('admp_submit_contact_form');

        wp_localize_script('admp-js', 'admp_ajax_object', [
            'ajax_url'       => admin_url('admin-ajax.php'),
            'contact_nonce'  => $contactNonce,
        ]);
    }
}

new Ajax_demo_plugin();
