<?php
defined('ABSPATH') or exit;

class Basic_Shortcode {

    public function __construct() {
        add_shortcode('myshortcode', [$this, 'basic_shortcode']);
    }

    public function basic_shortcode($attr) {
        $default =[
            'color'=>'red'
        ];
        $attributes = shortcode_atts($default, $attr);
        $color = esc_attr($attributes['color']);
        $html = "<h2 style='color:{$color}'>Hello World</h2>";

        return $html;
    }
}
