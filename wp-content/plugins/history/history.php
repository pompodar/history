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

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/articles_by_cat', array(
        'methods'  => 'GET',
        'callback' => 'get_all_posts_by_cat',
        'permission_callback' => '__return_true' 

    ));

    register_rest_route('custom/v1', '/categories', array(
        'methods'  => 'GET',
        'callback' => 'get_all_categories',
        'permission_callback' => '__return_true'

    ));

    register_rest_route('custom/v1', '/media', array(
        'methods'  => 'GET',
        'callback' => 'get_all_media',
        'permission_callback' => '__return_true'

    ));
});

/**
 * Get all posts callback function
 *
 * @return WP_REST_Response
 */
function get_all_posts_by_cat($request) {
    $cat_id = $request->get_param('cat') ?: ''; 
    $paged = $request->get_param('page') ?: 1; 
    $posts_per_page = $request->get_param('per_page') ?: 3;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'cat'  => $cat_id,
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
    );

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return new WP_REST_Response([], 200);
    }

    $posts = array();
    while ($query->have_posts()) {
        $query->the_post();
        $categories = get_the_category();
        
        $category_data = array_map(function($cat) {
            $ancestors = get_ancestors($cat->term_id, 'category');
            $ancestor_data = array_map(function($ancestor_id) {
                $ancestor = get_category($ancestor_id);
                return array(
                    'id'   => $ancestor->term_id,
                    'name' => $ancestor->name,
                );
            }, $ancestors);
            
            $descendants = get_term_children($cat->term_id, 'category');
            $descendant_data = array_map(function($descendant_id) {
                $descendant = get_category($descendant_id);
                return array(
                    'id'   => $descendant->term_id,
                    'name' => $descendant->name,
                );
            }, $descendants);

            return array(
                'id'        => $cat->term_id,
                'name'      => $cat->name,
                'ancestors' => $ancestor_data,
                'descendants' => $descendant_data,
            );
        }, $categories);

        $posts[] = array(
            'id'         => get_the_ID(),
            'title'      => get_the_title(),
            'content'    => get_the_content(),
            'excerpt'    => get_the_excerpt(),
            'categories' => $category_data,
            'date'       => get_the_date(),
            'link'       => get_permalink(),
            'total_posts' => $query->found_posts,
            'total_pages'   => $query->max_num_pages,
        );

    }

    wp_reset_postdata();

    // Prepare response with pagination headers
    $response = new WP_REST_Response($posts, 200);

    return $response;
}

/**
 * Get all categories callback function
 *
 * @return WP_REST_Response
 */
function get_all_categories() {
    $categories = get_categories(array(
        'hide_empty' => false,
    ));

    if (empty($categories)) {
        return new WP_REST_Response([], 200);
    }

    $cats = array();
    foreach ($categories as $category) {
        $cat = array(
            'id'    => $category->term_id,
            'name'  => $category->name,
            'slug'  => $category->slug,
            'count' => $category->count,
        );

        // Check if the category has parent
        if ($category->parent === 0) {
            // It's a top-level category, add it directly
            $cat['parent_id'] = null;
        } else {
            // Get parent category information
            $parent_category = get_category($category->parent);
            $cat['parent_id'] = $parent_category->term_id;
            $cat['parent_name'] = $parent_category->name;
            $cat['parent_slug'] = $parent_category->slug;
        }

        // Get children categories recursively
        $children = get_categories(array(
            'hide_empty' => false,
            'parent'     => $category->term_id,
        ));

        if (!empty($children)) {
            $cat['children'] = array();
            foreach ($children as $child) {
                $cat['children'][] = array(
                    'id'    => $child->term_id,
                    'name'  => $child->name,
                    'slug'  => $child->slug,
                    'count' => $child->count,
                );
            }
        }

        $cats[] = $cat;
    }

    return new WP_REST_Response($cats, 200);
}

function initCors($value) {
    $origin_url = 'http://writer.test';
    header('Access-Control-Allow-Origin: ' . $origin_url);
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization');
    return $value;
}

add_action('rest_api_init', function() {
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
    add_filter('rest_pre_serve_request', 'initCors');
}, 15);

function create_media_categories() {
    register_taxonomy(
        'media_category',
        'attachment',
        array(
            'label' => __('Media Categories'),
            'rewrite' => array('slug' => 'media-category'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'create_media_categories');

function add_media_categories_metabox() {
    register_taxonomy_for_object_type('media_category', 'attachment');
}
add_action('admin_init', 'add_media_categories_metabox');

function restrict_media_by_category() {
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'attachment') {
        $selected = isset($_GET['media_category']) ? $_GET['media_category'] : '';
        wp_dropdown_categories(array(
            'show_option_all' => __('Show All Media Categories'),
            'taxonomy' => 'media_category',
            'name' => 'media_category',
            'orderby' => 'name',
            'selected' => $selected,
            'hierarchical' => true,
            'depth' => 3,
            'show_count' => true,
            'hide_empty' => true,
        ));
    }
}
add_action('restrict_manage_posts', 'restrict_media_by_category');

function get_all_media($request) {
    $category_slug = $request->get_param('category_slug') ?: ''; 

    $args = array(
        'post_type' => 'attachment',
        'tax_query' => array(
            array(
                'taxonomy' => 'media_category',
                'field' => 'slug',
                'terms' => $category_slug,
            ),
        ),
        'posts_per_page' => -1,
    );

    $media_items = array();

    $attachments = get_posts($args);
    if ($attachments) {
        foreach ($attachments as $post) {
            $media_items[] = array(
                'ID' => $post->ID,
                'title' => $post->post_title,
                'url' => wp_get_attachment_url($post->ID),
            );
        }
    }

    if (empty($media_items)) {
        return new WP_Error('no_media', 'No media found for this category', array('status' => 404));
    }

    return new WP_REST_Response($media_items, 200);
}

add_action('rest_api_init', function () {
    register_rest_route('media-categories/v1', '/media', array(
        'methods' => 'GET',
        'callback' => 'get_all_media',
    ));
});





