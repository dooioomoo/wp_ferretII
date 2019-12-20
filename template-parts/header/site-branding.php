<?php
    /**
     * Displays header site branding
     *
     * @subpackage _ferret
     */

?>
<div class="site-branding">
    <div class="wrap container">
        <div class="row">
            <div class="site-logo col-md-4">
                <?php echo _ferret_get_logo(true); ?>
            </div>
            <div class="col-md-8">
                <div class="site-branding-text">
                    <?php if (is_active_sidebar('header-sidebar')): ?>
                    <?php dynamic_sidebar('header-sidebar');?>
                    <?php endif; ?>
                </div><!-- .site-branding-text -->
            </div>
        </div>
    </div><!-- .wrap -->
    <button id="primary-navi-mobile-button" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
        <?php
            echo _ferret_get_svg(array ('icon' => 'bars'));
            echo _ferret_get_svg(array ('icon' => 'close'));
        ?>
    </button>
    <?php get_template_part('template-parts/navigation/navigation', 'header'); ?>
</div><!-- .site-branding -->
