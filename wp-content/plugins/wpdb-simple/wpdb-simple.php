<?php
/*
 * Plugin Name:      WPDB Simple Plugin
 * Description:      Handle the basics with this plugin.
 * Version:          1.0
 * Author:           John Smith
 */
defined('ABSPATH') or exit;

class WPDB_Simple_Plugin
{
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'simple_table';
        register_activation_hook(__FILE__, [$this, 'activation']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_post_delete_entry', [$this, 'handle_post_deletion']);
        add_action('admin_post_update_entry', [$this, 'handle_post_update']);
    }

    public function handle_post_deletion()
    {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized user');
        }

        if (!wp_verify_nonce($_GET['_wpnonce'], 'delete_entry')) {
            wp_die('Nonce verification failed');
        }

        $id = $_GET['id'] ?? 0;

        if (isset($id)) {
            if ($id > 0) {
                global $wpdb;
                $id = intval($_GET['id']);
                $wpdb->delete($this->table_name, ['id' => $id]);
            }
            wp_redirect(admin_url('admin.php?page=wpdb-simple-plugin'));
            exit;
        } else {
            wp_die('your id is not set');
        }


    }

    public function handle_post_update()
    {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized user');
        }

        if (!wp_verify_nonce($_GET['_wpnonce'], 'update_entry')) {
            wp_die('Nonce verification failed');
        }

        $id = $_GET['id'] ?? 0;

        if (isset($id)) {
            if ($id > 0) {
                global $wpdb;
                $id = intval($_GET['id']);
                $sql = $wpdb->prepare("SELECT * FROM $this->table_name WHERE id = %d", $id);
                $row = $wpdb->get_row($sql);
                $row->title = strtoupper($row->title);
                $wpdb->update(
                    table: $this->table_name,
                    data: ['title' => $row->title],
                    where: ['id' => $id]
                );
            }
            wp_redirect(admin_url('admin.php?page=wpdb-simple-plugin'));
            exit;
        } else {
            wp_die('your id is not set');
        }
    }

    public function add_admin_menu()
    {
        add_menu_page(
            'WPDB Simple Plugin',
            'WPDB Simple',
            'manage_options',
            'wpdb-simple-plugin',
            [$this, 'render_admin_page'],
            'dashicons-database',
            20
        );
    }

    public function render_admin_page()
    {
        global $wpdb;
        $sql = $wpdb->prepare("SELECT * FROM $this->table_name");
        $results = $wpdb->get_results($sql);

        if (empty($results)) {
            echo '<div class="wrap"><h1>WPDB Simple Plugin Data</h1><p>No data found.</p></div>';
            return;
        } else {
            ?>
            <div class="wrap">
                <h1>WPDB Simple Plugin Data</h1>
                <table class="widefat fixed" cellspacing="0">
                    <thead>
                        <tr>
                            <th id="id" class="manage-column column-id" scope="col">ID</th>
                            <th id="title" class="manage-column column-title" scope="col">Title</th>
                            <th id="description" class="manage-column column-description" scope="col">Description</th>
                            <th id="action" class="manage-column column-action" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row):

                            $delete_url = wp_nonce_url(
                                admin_url('admin-post.php?action=delete_entry&id=' . $row->id),
                                'delete_entry'
                            );

                            $update_url = wp_nonce_url(
                                admin_url('admin-post.php?action=update_entry&id=' . $row->id),
                                'update_entry'
                            );

                            ?>
                            <tr>
                                <td class="column-id"><?php echo esc_html($row->id); ?></td>
                                <td class="column-title"><?php echo esc_html($row->title); ?></td>
                                <td class="column-description"><?php echo esc_html($row->description); ?></td>
                                <td class="column-delete">
                                    <a href="<?php echo esc_url($delete_url); ?>"
                                        onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                                    <a href="<?php echo esc_url($update_url); ?>">Update</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
        }

    }

    public function activation()
    {
        $this->create_table();
        $this->insert_sample_data();
    }

    private function create_table()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE `$this->table_name` (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      title varchar(100) NOT NULL,
      description text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    private function insert_sample_data()
    {
        global $wpdb;
        $wpdb->insert(
            $this->table_name,
            [
                'title' => 'Sample Title',
                'description' => 'This is a sample description.'
            ]
        );
    }
}


new WPDB_Simple_Plugin();