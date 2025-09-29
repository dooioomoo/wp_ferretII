<?php
    /**
     * _ferret's action
     * @package _ferret
     */
    /**
     * main page col
     */
    add_action('_ferret_get_main_col', '_ferret_get_main_col');
    add_action('_ferret_get_main_col_end', '_ferret_get_main_col_end');
    add_action('_ferret_get_sidebar_col', '_ferret_get_sidebar_col');
    add_filter('sanitize_file_name', '_ferret_custom_upload_name', 5, 1);
    add_filter('wpcf7_autop_or_not', '__return_false');
    add_filter('wpcf7_form_elements', function ($content) {
        $content = preg_replace('/<label><input type="(checkbox|radio)" name="(.*?)" value="(.*?)" \/><span class="wpcf7-list-item-label">/i', '<label class="custom-control custom-\1 custom-control-inline"><input type="\1" name="\2" value="\3" class="custom-control-input"><span class="wpcf7-list-item-label custom-control-label">', $content);
        return $content;
    });
    add_filter('wpcf7_form_elements', function($content) {
        $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
        return $content;
    });
    /**
     * action's function
     */
    
    if (!function_exists('_ferret_get_main_col')):
        
        function _ferret_get_main_col() {
            if (_ferret_check_widget()):
                $col = 'main-has-sidebar col-md-8 order-1' . ' ' . _ferret_get_widget_col();
            else:
                $col = 'col-md-12';
            endif;
            echo '<main id="main" class="site-main ' . $col . '">';
            echo '<section class="site-main-wrap">';
        }
    
    endif;
    
    if (!function_exists('_ferret_get_main_col_end')):
        function _ferret_get_main_col_end() {
            echo '</section>';
            echo '</main>';
        }
    endif;
    
    
    if (!function_exists('_ferret_get_sidebar_col')):
        function _ferret_get_sidebar_col() {
            if (_ferret_check_widget()):
                echo '<section class="sidebar col-md-4 order-2">';
                print_r('<div class="sidebar-wrap">');
                _ferret_display_widget();
                print_r('</div>');
                echo '</section>';
            endif;
        }
    endif;
    
    if (!function_exists('_ferret_custom_upload_name')):
        function _ferret_custom_upload_name($file) {
            $info = pathinfo($file);
            $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
            $name = basename($file, $ext);
            $file = date("YmdHis") . rand(00, 99) . $ext;//截取前20位MD5长度，加上两位随机
            return $file;
        }
    endif;
    
    add_filter('get_the_archive_title', function ($title) {
        if (is_category()) {
            $title = single_cat_title('', FALSE);
        } elseif (is_tag()) {
            $title = single_tag_title('', FALSE);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_tax()) { //for custom post types
            $title = sprintf(__('%1$s'), single_term_title('', FALSE));
        }
        return $title;
    });
    
    
    add_filter('wpcf7_form_elements', function ($form) {
        $form = do_shortcode($form);
        return $form;
    });
    
    