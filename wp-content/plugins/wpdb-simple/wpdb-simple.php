<?php

/*
 * Plugin Name:      WPDB Simple Plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Author:            John Smith
 */

defined('ABSPATH') or exit;
class WPDB_SIMPLE
{

    private $table_name;

    function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'simple_table';

        register_activation_hook(__FILE__, [$this, 'activate']);
    }

    function activate()
    {
        $this->create_table();
        $this->insert_data();
    }

    private function create_table()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE ($this->table_name) (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            title varchar(100) NOT NULL,
            description text NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    function insert_data()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'simple_table';

        $data = [
            'title' => 'Sample Title',
            'description' => 'This is a sample description.',
        ];

        $wpdb->insert($table_name, $data);
    }
}

new WPDB_SIMPLE();
