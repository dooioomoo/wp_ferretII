<?php
    /**
     * _ferret's functions
     * @package _ferret
     */
    
    /**
     * theme init
     */
    add_action('after_setup_theme', '_ferret_setup');
    add_action('after_setup_theme', '_ferret_content_width', 0);
    add_action('after_setup_theme', '_ferret_custom_header_setup');
    
    /**
     * include widget settings
     */
    require_once(___ferret_theme_path__ . '/inc/customize.php');
    
    require_once(___ferret_theme_path__ . '/inc/base/add_action.php');
    require_once(___ferret_theme_path__ . '/inc/base/helper.php');
    require_once(___ferret_theme_path__ . '/inc/base/widget.php');
    require_once(___ferret_theme_path__ . '/inc/base/enqueue.php');
    require_once(___ferret_theme_path__ . '/inc/base/icon-functions.php');
    
    require_once(___ferret_theme_path__ . '/inc/template/template.php');
    require_once(___ferret_theme_path__ . '/inc/template/template-customize.php');
    require_once(___ferret_theme_path__ . '/inc/template/template-tags.php');
    require_once(___ferret_theme_path__ . '/inc/template/loader.php');

//    require_once(___ferret_theme_path__ . '/inc/woocommerce/_ferret_shop.php');
    
    if (class_exists('WooCommerce')) {
        require_once(___ferret_theme_path__ . '/inc/woocommerce/woocommerce.php');
    }
    
    /**
     * theme init functions
     */
    if (!function_exists('_ferret_setup')) :
        function _ferret_setup() {
            load_theme_textdomain('_ferret', ___ferret_theme_path__ . '/languages');

//        add_theme_support( 'automatic-feed-links' );
//        add_theme_support( 'title-tag' );
            add_theme_support('post-thumbnails');
            add_theme_support('customize-selective-refresh-widgets');
            
            register_nav_menus(array (
                'PrimaryMenu' => esc_html__('Primary', '_ferret'),
            ));
            
            add_theme_support('html5', array (
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ));
            
            add_theme_support('custom-background', apply_filters('_ferret_custom_background_args', array (
                'default-color' => 'ffffff',
                'default-image' => '',
            )));
            
            //add_theme_support('custom-logo', array(
            //    'height' => 250,
            //    'width' => 250,
            //    'flex-width' => true,
            //    'flex-height' => true,
            //));
        }
    endif;
    
    if (!function_exists('_ferret_content_width')):
        function _ferret_content_width() {
            $GLOBALS['content_width'] = apply_filters('_ferret_content_width', 640);
        }
    endif;
    
    if (!function_exists('_ferret_custom_header_setup')):
        function _ferret_custom_header_setup() {
            add_theme_support('custom-header', apply_filters('_ferret_custom_header_args', array (
//                'default-image'      => ___ferret_theme_uri__ . '/assets/images/header.jpg',
                'default-text-color' => '000000',
                'width'              => 1920,
                'height'             => 300,
                'flex-height'        => TRUE,
            )));
        }
    endif;
