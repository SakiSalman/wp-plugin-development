<?php
defined(constant_name: 'ABSPATH') or exit;
class Basic_widget
{
    public function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'register_basic_widget']);
    }

    public function register_basic_widget()
    {
        wp_add_dashboard_widget(
            'wd-basic-widget',
            'DW basic widget',
            [$this, "render"]
        );
    }

    public function render()
    {
        ?>
        <div style="
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        ">
            <h2 style="
                font-size: 20px;
                margin: 0 0 15px 0;
                padding-bottom: 10px;
                border-bottom: 1px solid #edf2f7;
                color: #1a202c;
            ">
                👋 Welcome to Your Dashboard
            </h2>
    
            <p style="font-size: 14px; color: #4a5568; line-height: 1.6;">
                This is your custom dashboard widget.  
                You can add quick stats, shortcuts, or helpful messages here.
            </p>
    
            <div style="
                margin-top: 15px;
                display: flex;
                gap: 10px;
            ">
                <a href="#" style="
                    padding: 8px 14px;
                    background: #4c6fff;
                    color: #fff;
                    font-size: 14px;
                    border-radius: 6px;
                    text-decoration: none;
                ">Primary Action</a>
    
                <a href="#" style="
                    padding: 8px 14px;
                    background: #e2e8f0;
                    color: #1a202c;
                    font-size: 14px;
                    border-radius: 6px;
                    text-decoration: none;
                ">Secondary</a>
            </div>
        </div>
        <?php
    }
    
}