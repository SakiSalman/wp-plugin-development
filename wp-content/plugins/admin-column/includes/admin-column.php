<?php
defined('ABSPATH') or exit;

class AdminColumn
{
    public function init()
    {
        $this->define_constants();
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    private function define_constants()
    {
        define("ADMIN_COLUMN_VERSION", '1.0.1');
        define("ADMIN_COLUMN_PATH", plugin_dir_path(__DIR__));
        define("ADMIN_COLUMN_URL", plugin_dir_url(__DIR__));
    }

    public function init_plugin()
    {
        $this->includes();
        $this->init_hooks();
    }

    private function includes()
    {
        $file = plugin_dir_path(__FILE__) . 'app/custom-column.php';
        if (file_exists($file)) {
            include_once $file;
            // Instantiate the CustomColumn class
            if (class_exists('CustomColumn')) {
                new CustomColumn();
            }
        }
    }

    private function init_hooks()
    {
        load_plugin_textdomain("admin-column", false, dirname(plugin_basename(__FILE__)) . '/i18n/');
    }
}
