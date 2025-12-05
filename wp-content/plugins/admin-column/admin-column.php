<?php
/*
 * Plugin Name:       Admin Column
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 */

defined(constant_name: 'ABSPATH') or exit;

// Include AdminColumn class
$class_file = plugin_dir_path(__FILE__) . 'includes/admin-column.php';
if (file_exists($class_file)) {
    include_once $class_file;
} else {
    wp_die("Admin Column Plugin Error: includes/admin-column.php NOT found {$class_file}");
}

// Instantiate AdminColumn
if (class_exists('AdminColumn')) {
    $admin_column = new AdminColumn();
    $admin_column->init();
} else {
    wp_die("Admin Column Plugin Error: Class AdminColumn NOT found");
}
