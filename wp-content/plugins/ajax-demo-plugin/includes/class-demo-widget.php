<?php


class DEMO_WiDGET
{
    function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'register_widget']);
        add_action('wp_ajax_fetch_daily_rates', [$this, 'handle_fetch_daily_rates']);
    }

    public function register_widget()
    {
        wp_add_dashboard_widget(
            'demo-widget',
            'Demo Widget',
            [$this, 'render']
        );
    }

    public function render()
    {
        ?>
        <div class="demo-widget-wrap" style="font-family: Arial, sans-serif;">
            <h2 style="margin:0 0 8px; font-size:16px;">Daily Rates</h2>
            <p style="margin:0 0 12px; color:#555;">Click the button to fetch today's rates (demo).</p>
            <button id="daily-rates-button"
                style="padding:8px 14px; background:#007cba; color:#fff; border:0; border-radius:4px; cursor:pointer; font-weight:600;">Daily
                Rates</button>
            <div id="daily-rates-result" style="margin-top:12px; font-size:14px; color:#333;"></div>
        </div>
        <?php
    }

    function handle_fetch_daily_rates()
    {
        $api_url = 'https://api.exchangerate-api.com/v4/latest/BDT';
        $response = wp_remote_get($api_url);
        if (is_wp_error($response)) {
            wp_send_json_error('Failed to fetch rates.');
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, associative: true);
            $result =[
                "BDT" => number_format($data['rates']['BDT'], 2 ),
                "USD" =>number_format( $data['rates']['USD'], 2 ),
                "EUR" => number_format( $data['rates']['EUR'], 2 ),
            ];
            wp_send_json_success($result);
        }
    }
}