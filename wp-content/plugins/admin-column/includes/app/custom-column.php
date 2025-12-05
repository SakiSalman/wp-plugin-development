<?php
defined('ABSPATH') or exit;

class CustomColumn
{
    public function __construct()
    {
        // Add new column to the posts list
        add_filter('manage_posts_columns', [$this, 'add_custom_post_columns']);
        
        // Populate the custom column
        add_action('manage_posts_custom_column', [$this, 'render_column_value'], 10, 2);

        add_filter('manage_edit-post_sortable_columns', [$this, 'sortableColums'], 10, 1);

        add_action('pre_get_posts', [$this, 'query_posts_by_price']);
    }

    public function add_custom_post_columns($columns)
    {
        $columns['price'] = 'Price';
        return $columns;
    }

    public function render_column_value($column, $post_id)
    {
        // $screen = get_current_screen();
        // var_dump($screen->id);
        if ($column === 'price') {
            $price = get_field('price', $post_id); 
            echo $price ? esc_html($price) : '-';
        }
    }

    public function sortableColums($col){
        $columns['price'] = 'price';
        return $columns;
    }

    public function query_posts_by_price ($query) {
            if ($query->get('orderby') === 'price') {
                $query->set('meta_key', 'price');
                $query->set('orderby', 'meta_value_num');
            }
    }
}

