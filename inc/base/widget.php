<?php
    /**
     * _ferret's widget setting
     * @package _ferret
     */
    add_filter('widget_text', 'do_shortcode');
    add_action('widgets_init', '_ferret_widgets_init');
    add_filter('widget_title', '_ferret_html_widget_title');
    /**
     * widget function
     */
    function _ferret_widgets_init() {
        register_sidebar(array (
            'name'          => esc_html__('Sidebar', '_ferret'),
            'id'            => 'master-sidebar',
            'description'   => esc_html__('Add widgets here.', '_ferret'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        
        register_sidebar(array (
            'name'          => esc_html__('Header Sidebar', '_ferret'),
            'id'            => 'header-sidebar',
            'description'   => esc_html__('Add widgets here.', '_ferret'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        
        register_sidebar(array (
            'name'          => esc_html__('Footer Sidebar', '_ferret'),
            'id'            => 'footer-sidebar',
            'description'   => esc_html__('Add widgets here.', '_ferret'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
    
    /**
     * @param $title
     * @return mixed
     * use [small] [/small] conver to <small> </small>
     */
    function _ferret_html_widget_title($title) {
        //HTML tag opening/closing brackets
        $title = str_replace('[', '<', $title);
        $title = str_replace('[/', '</', $title);
        $title = str_replace(']', '>', $title);
        return $title;
    }
