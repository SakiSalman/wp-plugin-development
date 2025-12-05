<?php



class Shortcode_button_demo
{
    function __construct()
    {
        add_shortcode('ajax-demo-button', [$this, 'render_demo_button']);

        add_action('wp_ajax_demo_button', [$this, 'handle_demo_button_action']);
    }

    function render_demo_button()
    {
        return '<button id="ajax-demo-button" style="padding: 10px 20px; background-color: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">Demo Button</button>';
    }

    function handle_demo_button_action()
    {
        // Handle the AJAX request here
        wp_send_json_success(['message' => 'AJAX request handled successfully!']);
    }
}