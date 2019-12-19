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
                <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
                    <?php
                        echo _ferret_get_svg(array ('icon' => 'bars'));
                        echo _ferret_get_svg(array ('icon' => 'close'));
                    ?>
                </button>
                <?php wp_nav_menu(array (
                    'theme_location' => 'PrimaryMenu',
                    'menu_id'        => 'primary-menu',
                )); ?>
            </div>
        </div>
    </div>
</div><!-- #site-navigation -->