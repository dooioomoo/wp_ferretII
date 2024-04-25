<?php
    /**
     * _ferret's enqueue
     * @package _ferret
     */
    
    /**
     * Enqueue scripts and styles.
     */
    
    add_action('wp_enqueue_scripts', '_ferret_scripts');
    
    /**
     * wordpress enqueue script and css  function
     */
    
    function _ferret_scripts() {
        /**
         * css
         */
        wp_enqueue_style('_ferret-style-common', ___ferret_theme_uri__ . '/assets/css/common.min.css');
        wp_enqueue_style('_ferret-style-base', ___ferret_theme_uri__ . '/assets/css/front.css');
        
        //wp_enqueue_style('_ferret-style', get_stylesheet_uri());
        /**
         * scripts
         */
        
        wp_enqueue_script('_ferret-common-js', ___ferret_theme_uri__ . '/assets/js/common.min.js', array (), ___ferret_theme_ver__, TRUE);
        wp_enqueue_script('_ferret-navigation-js', ___ferret_theme_uri__ . '/assets/js/base.min.js', array ('jquery'), ___ferret_theme_ver__, TRUE);
        wp_dequeue_script('jquery');
        wp_deregister_script('jquery');
        
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }


add_filter('style_loader_src', function ($href) {
    if (strpos($href, '/core/') !== false) {
        return false;
    } else {
        return $href;
    }
});
