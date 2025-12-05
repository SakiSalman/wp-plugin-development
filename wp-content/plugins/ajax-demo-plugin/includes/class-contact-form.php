<?php



class ADMP_CONTACT_FORM
{
    function __construct()
    {
        add_shortcode('admp_contact_form', [$this, 'render_contact_form']);
        add_action('wp_ajax_admp_submit_contact_form', [$this, 'handle_contact_form_submission']);
        add_action('wp_ajax_nopriv_admp_submit_contact_form', [$this, 'handle_contact_form_submission']);
        add_action('manage_supports_posts_columns', [$this, 'add_supports_columns']);
        add_action('manage_supports_posts_custom_column', [$this, 'render_supports_custom_column'], 10, 2);
      add_filter('manage_edit-supports_sortable_columns', [$this, 'set_custom_supports_sortable_columns']);
    }

    function render_contact_form()
    {
        ob_start();
        ?>
        <div>
            <form id="admp-contact-form" style="max-width: 400px; margin: 20px 0;">
                <label for="admp-name" style="display: block; margin-bottom: 8px; font-weight: bold;">Name:</label>
                <input type="text" id="admp-name" name="name" required
                    style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px;">
                <label for="admp-email" style="display: block; margin-bottom: 8px; font-weight: bold;">Email:</label>
                <input type="email" id="admp-email" name="email" required
                    style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px;">
                <label for="admp-message" style="display: block; margin-bottom: 8px; font-weight: bold;">Message:</label>
                <textarea id="admp-message" name="message" required
                    style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                <button type="submit"
                    style="padding: 10px 20px; background-color: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">Submit</button>
                <div id="admp-form-response" style="margin-top: 12px; font-size: 14px;"></div>
            </form>
            <div id="ajax-demo-contact-result"></div>
        </div>
        <?php
        return ob_get_clean();
    }
    function handle_contact_form_submission()
    {
        $name = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $message = sanitize_textarea_field($_POST['message'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error('All fields are required.');
        }
        // $to = get_option('admin_email');
        // $subject = 'Contact Form Submission from ' . $name;
        // $body = "Name: $name\nEmail: $email\nMessage: $message";
        // $headers = ['Content-Type: text/plain; charset=UTF-8'];
        // if (wp_mail($to, $subject, $body, $headers)) {
        //     wp_send_json_success('Message Sent Successfully');
        // } else {
        //     wp_send_json_error('Failed');
        // }

        $post_data = [
            'post_title' => wp_strip_all_tags('Contact Form Submission from -' . $name),
            // 'post_content' => $message,
            'post_status' => 'private',
            'post_type' => 'supports',
            'meta_input' => [
                'email' => $email,
                'message' => $message,
                'name' => $name,
            ],
        ];
        $post_id = wp_insert_post($post_data);
        if (is_wp_error($post_id)) {
            wp_send_json_error('Failed to save submission.'.$post_id);
        } else {
            wp_send_json_success('Message Sent Successfully');
        }


    }

    function add_supports_columns($columns)
    {
        $columns['email'] = 'Email';
        $columns['message'] = 'Message';
        return $columns;
    }

    function render_supports_custom_column($column, $post_id)
    {
        if ($column === 'email') {
            $email = get_post_meta($post_id, 'email', true);
            echo esc_html($email);
        } elseif ($column === 'message') {
            $message = get_post_meta($post_id, 'message', true);
            echo esc_html($message);
        }
    }

    function set_custom_supports_sortable_columns($columns)
    {
        $columns['email'] = 'email';
        $columns['message'] = 'message';
        return $columns;
    }

}