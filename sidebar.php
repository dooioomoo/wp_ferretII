<?php
    /**
     * The sidebar containing the main widget area
     *
     * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
     *
     * @package _ferret
     */
    
    if (!is_active_sidebar('master-sidebar')) {
        return;
    }
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('master-sidebar'); ?>
</aside><!-- #secondary -->
