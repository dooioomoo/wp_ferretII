<?php
    /**
     * _ferret's template setting
     * @package _ferret
     */
    
    add_filter('body_class', '_ferret_body_classes');
    add_action('add_meta_boxes', '_ferret_add_options_to_all_post_type');
    add_action('save_post', '_ferret_add_options_to_all_post_type_save');
    /**
     * @param $classes
     *
     * @return array
     */
    if (!function_exists('_ferret_body_classes')):
        function _ferret_body_classes($classes) {
            
            if (!is_singular()) {
                
                $classes[] = 'non-singular';
            }
            if (!_ferret_sidebar_is_active()) {
                $classes[] = 'no-sidebar';
            } else {
                $classes[] = 'has-sidebar';
            }
            
            return $classes;
        }
    endif;
    
    /**
     * add options box to all post type
     */
    
    function _ferret_add_options_to_all_post_type() {
        $all_posttype = _ferret_get_all_posttype();
        foreach ($all_posttype as $_ferret_posttype) {
            add_meta_box(
                '_ferret_options',
                __('Options', '_ferret'),
                '_ferret_add_options_to_all_post_type_callback',
                $_ferret_posttype,
                'side'
            );
        }
    }
    
    function _ferret_add_options_to_all_post_type_callback($post) {
        // Use nonce for verification
        wp_nonce_field(plugin_basename(__FILE__), '_ferret_options_nonce');
        // add sidebar choice to options
        _ferret_add_options_sidebar_choice($post);
    }
    
    function _ferret_add_options_sidebar_choice($post) {
        global $wp_registered_sidebars;
        $val = ($val = get_post_meta($post->ID, "_ferret_display_post_sidebar", TRUE)) ? $val : get_theme_mod('_ferret_widget_default_view_' . get_post_type(), 'master-sidebar');
        // The actual fields for data entry
        $output = '<p><label for="_ferret_display_post_sidebar">' . __("Choose a sidebar to display", '_ferret') . '</label></p>';
        $output .= "<select name='_ferret_display_post_sidebar' id='_ferret_display_post_sidebar'>";
        
        // Add a default option
        $output .= "<option";
        if ($val == "default")
            $output .= " selected='selected'";
        $output .= " value='default'>" . __('no sidebar') . "</option>";
        
        // Fill the select element with all registered sidebars
        foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
            $output .= "<option";
            if ($sidebar_id == $val)
                $output .= " selected='selected'";
            $output .= " value='" . $sidebar_id . "'>" . $sidebar['name'] . "</option>";
        }
        
        $output .= "</select>";
        echo $output;
    }
    
    function _ferret_add_options_to_all_post_type_save($post_id) {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        
        // verify this came from our screen and with proper authorization,
        // because save_post can be triggered at other times
        
        if (!wp_verify_nonce(@$_POST['_ferret_options_nonce'], plugin_basename(__FILE__)))
            return;
        
        if (!current_user_can('edit_page', $post_id))
            return;
        
        $data = $_POST['_ferret_display_post_sidebar'];
        
        update_post_meta($post_id, "_ferret_display_post_sidebar", $data);
    }