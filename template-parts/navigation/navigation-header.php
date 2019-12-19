<?php
    /**
     * _ferret' navigation
     * @package _ferret
     */
?>
<div id="site-navigation" class="main-navigation" role="navigation"
     aria-label="<?php esc_attr_e('Top Menu', '_ferret'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php wp_nav_menu(array (
                    'theme_location' => 'PrimaryMenu',
                    'menu_id'        => 'primary-menu',
                )); ?>
            </div>
        </div>
    </div>
</div><!-- #site-navigation -->