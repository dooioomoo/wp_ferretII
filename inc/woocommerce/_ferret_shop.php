<?php
// Register Custom Post Type
    flush_rewrite_rules();
    
    function _ferret_shop() {
        
        $labels = array (
            'name'                  => _x('SHOP', 'Post Type General Name', '_ferret'),
            'singular_name'         => _x('_ferret_shop', 'Post Type Singular Name', '_ferret'),
            'menu_name'             => __('SHOP', '_ferret'),
            'name_admin_bar'        => __('SHOP', '_ferret'),
            'archives'              => __('Item Archives', '_ferret'),
            'attributes'            => __('Item Attributes', '_ferret'),
            'parent_item_colon'     => __('Parent Item:', '_ferret'),
            'all_items'             => __('All Items', '_ferret'),
            'add_new_item'          => __('Add New Product', '_ferret'),
            'add_new'               => __('Add New Product', '_ferret'),
            'new_item'              => __('New Item', '_ferret'),
            'edit_item'             => __('Edit Item', '_ferret'),
            'update_item'           => __('Update Item', '_ferret'),
            'view_item'             => __('View Item', '_ferret'),
            'view_items'            => __('View Items', '_ferret'),
            'search_items'          => __('Search Item', '_ferret'),
            'not_found'             => __('Not found', '_ferret'),
            'not_found_in_trash'    => __('Not found in Trash', '_ferret'),
            'featured_image'        => __('Featured Image', '_ferret'),
            'set_featured_image'    => __('Set featured image', '_ferret'),
            'remove_featured_image' => __('Remove featured image', '_ferret'),
            'use_featured_image'    => __('Use as featured image', '_ferret'),
            'insert_into_item'      => __('Insert into item', '_ferret'),
            'uploaded_to_this_item' => __('Uploaded to this item', '_ferret'),
            'items_list'            => __('Items list', '_ferret'),
            'items_list_navigation' => __('Items list navigation', '_ferret'),
            'filter_items_list'     => __('Filter items list', '_ferret'),
        );
        $args   = array (
            'label'               => __('_ferret_shop', '_ferret'),
            'labels'              => $labels,
            'supports'            => array ('title', 'editor', 'post-formats', 'thumbnail'),
            'taxonomies'          => array ('_ferret_shop_categories', 'post_tag'),
            'hierarchical'        => FALSE,
            'public'              => TRUE,
            'show_ui'             => TRUE,
            'show_in_menu'        => TRUE,
            'query_var'           => TRUE,
            'menu_position'       => 1,
            'show_in_admin_bar'   => TRUE,
            'show_in_nav_menus'   => TRUE,
            'can_export'          => TRUE,
            'has_archive'         => TRUE,
            'exclude_from_search' => TRUE,
            'publicly_queryable'  => TRUE,
            'capability_type'     => 'post',
            'rewrite'             => TRUE
        );
        register_post_type('_ferret_shop', $args);
        
    }
    
    add_action('init', '_ferret_shop', 0);
    
    
    function _ferret_shop_info_get_meta($value) {
        global $post;
        
        $field = get_post_meta($post->ID, $value, TRUE);
        if (!empty($field)) {
            return is_array($field) ? stripslashes_deep($field) : stripslashes(wp_kses_decode_entities($field));
        } else {
            return FALSE;
        }
    }
    
    add_action('add_meta_boxes', '_ferret_shop_info_add_meta_box');
    
    function _ferret_shop_info_add_meta_box() {
        add_meta_box(
            '_ferret_shop_info-_ferret_shop-info',
            __('商品基本情報', '_ferret'),
            '_ferret_shop_info_html',
            '_ferret_shop',
            'advanced',
            'high'
        );
    }
    
    add_action('edit_form_after_title', '_ferret_shop_move_metabox_after_title');
    
    function _ferret_shop_move_metabox_after_title() {
        global $post, $wp_meta_boxes;
        do_meta_boxes(get_current_screen(), 'advanced', $post);
        unset($wp_meta_boxes[get_post_type($post)]['advanced']);
    }
    
    
    function _ferret_shop_info_html($post) {
        wp_nonce_field('__ferret_shop_info_nonce', '_ferret_shop_info_nonce'); ?>
        <div style="display:flex;align-items: center;justify-content: flex-start;">
            <p style="margin-right:20px;">
                <label for="_ferret_shop_info__ferret_shop_price"><?php _e('販売価格', '_ferret'); ?></label><br>
                <input type="text" name="_ferret_shop_info__ferret_shop_price" id="_ferret_shop_info__ferret_shop_price"
                       value="<?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_price'); ?>">
            </p>
            <p style="margin-right:20px;">
                <label for="_ferret_shop_info__ferret_shop_stock"><?php _e('数量', '_ferret'); ?></label><br>
                <input type="text" name="_ferret_shop_info__ferret_shop_stock" id="_ferret_shop_info__ferret_shop_stock"
                       value="<?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_stock'); ?>">
            </p>
            <p style="margin-right:20px;">
                <label for="_ferret_shop_info__ferret_shop_number"><?php _e('商品番号', '_ferret'); ?></label><br>
                <input type="text" name="_ferret_shop_info__ferret_shop_number"
                       id="_ferret_shop_info__ferret_shop_number"
                       value="<?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_number'); ?>">
            </p>
            <p style="margin-right:20px;">
                <label for="_ferret_shop_info__ferret_shop_jancode"><?php _e('ＪＡＮコード', '_ferret'); ?></label><br>
                <input type="text" name="_ferret_shop_info__ferret_shop_jancode"
                       id="_ferret_shop_info__ferret_shop_jancode"
                       value="<?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_jancode'); ?>">
            </p>
            <p style="margin-right:20px;">
                <label for="_ferret_shop_info__ferret_shop_strong"><?php _e('強化', '_ferret'); ?></label><br>
                <input type="checkbox" name="_ferret_shop_info__ferret_shop_strong"
                       id="_ferret_shop_info__ferret_shop_strong"
                       value="yes" <?php echo((_ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_strong') == 'yes') ? 'checked="checked"' : ''); ?>/>
            </p>
        </div>
        <?php
    }
    
    function _ferret_shop_info_save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['_ferret_shop_info_nonce']) || !wp_verify_nonce($_POST['_ferret_shop_info_nonce'], '__ferret_shop_info_nonce')) return;
        if (!current_user_can('edit_post', $post_id)) return;
        
        if (isset($_POST['_ferret_shop_info__ferret_shop_price']))
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_price', esc_attr($_POST['_ferret_shop_info__ferret_shop_price']));
        if (isset($_POST['_ferret_shop_info__ferret_shop_stock']))
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_stock', esc_attr($_POST['_ferret_shop_info__ferret_shop_stock']));
        
        if (isset($_POST['_ferret_shop_info__ferret_shop_number']))
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_number', esc_attr($_POST['_ferret_shop_info__ferret_shop_number']));
        if (isset($_POST['_ferret_shop_info__ferret_shop_jancode']))
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_jancode', esc_attr($_POST['_ferret_shop_info__ferret_shop_jancode']));
        if (isset($_POST['_ferret_shop_info__ferret_shop_strong']) && $_POST['_ferret_shop_info__ferret_shop_strong'] == 'yes'):
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_strong', esc_attr($_POST['_ferret_shop_info__ferret_shop_strong']));
        else:
            update_post_meta($post_id, '_ferret_shop_info__ferret_shop_strong', NULL);
        endif;
        
    }
    
    add_action('save_post', '_ferret_shop_info_save');
    
    /*
        Usage: _ferret_shop_info_get_meta( '_ferret_shop_info__ferret_shop_price' )
        Usage: _ferret_shop_info_get_meta( '_ferret_shop_info__ferret_shop_stock' )
    */
    function _ferret_shop_create_portfolio_taxonomies() {
        $labels = array (
            'name'              => _x('Categorys', '_ferret'),
            'singular_name'     => _x('Category', '_ferret'),
            'search_items'      => __('Search Categories'),
            'all_items'         => __('All Categories'),
            'parent_item'       => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
            'menu_name'         => __('Category'),
        );
        
        $args = array (
            'hierarchical'      => TRUE, // Set this to 'false' for non-hierarchical taxonomy (like tags)
            'labels'            => $labels,
            'show_ui'           => TRUE,
            'show_admin_column' => TRUE,
            'show_in_nav_menus' => TRUE,
            'query_var'         => TRUE,
            'rewrite'           => array ('slug' => 'ShopCategory'),
        );
        
        register_taxonomy('_ferret_shop_categories', array ('_ferret_shop'), $args);
    }
    
    add_action('init', '_ferret_shop_create_portfolio_taxonomies', 0);
    
    
    function _ferret_shop_cpt_generating_rule($wp_rewrite) {
        $rules = array ();
        $terms = get_terms(array (
            'taxonomy'   => '_ferret_shop_categories',
            'hide_empty' => FALSE,
        ));
        
        $post_type = '_ferret_shop';
        foreach ($terms as $term) {
            
            $rules['ShopCategory/' . $term->slug . '/([^/]*)$'] = 'index.php?post_type=' . $post_type . '&' . $post_type . '=$matches[1]&name=$matches[1]';
            
        }
        // merge with global rules
        $wp_rewrite->rules = $rules + $wp_rewrite->rules;
    }
    
    add_filter('generate_rewrite_rules', '_ferret_shop_cpt_generating_rule');
    
    
    function _ferret_shop_change_link($permalink, $post) {
        
        if ($post->post_type == '_ferret_shop') {
            $resource_terms = get_the_terms($post, '_ferret_shop_categories');
            $term_slug      = '';
            if (!empty($resource_terms)) {
                foreach ($resource_terms as $term) {
                    // The featured resource will have another category which is the main one
                    if ($term->slug == 'featured') {
                        continue;
                    }
                    $term_slug = $term->slug;
                    break;
                }
            }
            $permalink = get_home_url() . "/ShopCategory/" . $term_slug . '/' . $post->post_name;
        }
        return $permalink;
    }
    
    add_filter('post_type_link', "_ferret_shop_change_link", 10, 2);
    
    /**
     * Add the custom columns to the book post type:
     */
    
    add_filter('manage__ferret_shop_posts_columns', '_ferret_shop_set_custom_edit_columns');
    
    function _ferret_shop_set_custom_edit_columns($columns) {
        
        unset($columns['author']);
        unset($columns['tags']);
        
        $columns['post_thumbs'] = __('Featured Image');
        $columns['post_mark']   = __('強化', '_ferret');
        $columns['post_price']  = __('価格', '_ferret');
        
        $new_columns = array ();
        $order       = array (
            'cb',
            'post_thumbs',
            'title',
            'post_mark',
            'post_price',
            'taxonomy-_ferret_shop_categories',
            'date'
        );
        foreach ($order as $key) {
            $new_columns[$key] = $columns[$key];
        }
        return $new_columns;
    }

// Add the data to the custom columns for the book post type:
    add_action('manage__ferret_shop_posts_custom_column', '_ferret_shop_custom__ferret_shop_column', 10, 2);
    function _ferret_shop_custom__ferret_shop_column($column, $post_id) {
        ?>
        
        <?php
        switch ($column) {
            
            case 'post_thumbs' :
                echo the_post_thumbnail('featured-thumbnail');
                break;
            
            case 'post_mark' :
                if (get_post_meta($post_id, '_ferret_shop_info__ferret_shop_strong', TRUE) == 'yes'):
                    echo '<span id="_ferret_shop_strong_data-' . $post_id . '" data-check="yes" style="display:inline-block;background:orange;color:#fff;font-size:9pt;padding:3px 5px;border-radius:3px;">' . __('強化', '_ferret') . '</span>';
                endif;
                break;
            
            case 'post_price' :
                echo get_post_meta($post_id, '_ferret_shop_info__ferret_shop_price', TRUE);
                break;
            
        }
    }
    
    add_action('quick_edit_custom_box', '_ferret_shop_add_quick_edit', 10, 2);
    
    function _ferret_shop_add_quick_edit($column_name, $post_type) {
        if ($column_name != 'post_mark') return;
        wp_nonce_field('__ferret_shop_info_nonce', '_ferret_shop_info_nonce');
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label class="inline-edit-tags" style="text-align: left;line-height:35px;">
                    <input type="checkbox" name="_ferret_shop_info__ferret_shop_strong"
                           id="_ferret_shop_info__ferret_shop_strong"
                           value="yes"/>
                    <span class="title"><?php _e('強化', '_ferret'); ?></span>
                </label>
            </div>
        </fieldset>
        <?php
    }
    
    add_action('admin_head', '_ferret_shop_quick_edit_style');
    function _ferret_shop_quick_edit_style() {
        global $current_screen;
        
        if ('_ferret_shop' != $current_screen->post_type) {
            return;
        }
        ?>
        <style>
            .column-post_thumbs {
                max-width: 120px;
                display: table-cell;
                width: 120px;
                text-align: center;
                vertical-align: middle !important;
            }

            .column-post_thumbs img {
                width: 100px;
                height: auto;
                border-radius: 50%;
            }

            .manage-column, .manage-column a {
                text-align: center !important;
                display: table-cell;
                vertical-align: middle !important;
            }

            .manage-column a {
                display: inline-block !important;
            }

            #the-list td {
                vertical-align: middle !important;
                text-align: center !important;
            }
        </style>
        <?php
    }
    
    add_action('admin_footer', '_ferret_shop_quick_edit_javascript');
    function _ferret_shop_quick_edit_javascript() {
        global $current_screen;
        
        if ('_ferret_shop' != $current_screen->post_type || $current_screen->base != 'edit') {
            return;
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var $wp_inline_edit = inlineEditPost.edit;

                inlineEditPost.edit = function (id) {
                    $wp_inline_edit.apply(this, arguments);
                    var $post_id = 0;
                    if (typeof (id) == 'object')
                        $post_id = parseInt(this.getId(id));
                    if ($post_id > 0) {
                        var $edit_row = $('#edit-' + $post_id);
                        var $data_row = $('#_ferret_shop_strong_data-' + $post_id);
                        if ($data_row.data('check') === 'yes') {
                            $edit_row.find('input[name="_ferret_shop_info__ferret_shop_strong"]').attr("checked", true);
                        } else {
                            $edit_row.find('input[name="_ferret_shop_info__ferret_shop_strong"]').attr("checked", false);
                        }
                    }
                };
            });
        </script>
        <?php
    }