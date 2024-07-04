<?php
/*
Plugin Name: History Plugin
Description: A plugin to manage a history site.
Version: 1.0
Author: Svyatoslav Kachmar
*/

add_action('add_meta_boxes', 'history_add_custom_box');

function history_add_custom_box() {
    add_meta_box(
        'history_custom_box_id',         
        'History',            
        'history_box_html',       
        'post'                      
    );
}

function history_box_html($post) {
    $timestamp = get_post_meta($post->ID, '_timestamp', true);
    $importance = get_post_meta($post->ID, '_importance', true);
    ?>
    <label for="cf_field1">Timestamp:</label>
    <input type="text" id="timestamp" name="timestamp" value="<?php echo esc_attr($timestamp); ?>">
    
    <label for="cf_field2">Importance:</label>
    <input type="text" id="importance" name="importance" value="<?php echo esc_attr($importance); ?>">
    <?php
}

add_action('save_post', 'history_save_postdata');

function history_save_postdata($post_id) {
    if (array_key_exists('timestamp', $_POST)) {
        update_post_meta(
            $post_id,
            '_timestamp',
            sanitize_text_field($_POST['timestamp'])
        );
    }
    if (array_key_exists('importance', $_POST)) {
        update_post_meta(
            $post_id,
            '_importance',
            sanitize_text_field($_POST['importance'])
        );
    }
}

function register_custom_page_template( $templates ) {
    $templates['page-template.php'] = 'Custom Template';
    return $templates;
}
add_filter( 'theme_page_templates', 'register_custom_page_template' );

function load_custom_page_template( $template ) {
    if ( is_page_template( 'page-template.php' ) ) {
        $plugin_dir = plugin_dir_path( __FILE__ );
        $template = $plugin_dir . 'page-template.php';
    }
    return $template;
}
add_filter( 'template_include', 'load_custom_page_template' );

function add_cors_http_header() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
}

add_action('init', 'add_cors_http_header');




