<?php
    /**
     * Template part for displaying page content in page.php
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package _ferret
     */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('item_list_wrap'); ?>>
    <div class="row justify-content-between">
        <div class="item_gallery col-sm-5"><?php
                if (function_exists('clayball_create_custom_gallery_xzoom')) {
                    clayball_create_custom_gallery_xzoom();
                }
            ?>
            <script>
                jQuery(document).ready(function ($) {
                    $(".xzoom, .xzoom-gallery").xzoom({
                        tint: '#000',
                        tintOpacity: .6,
                        Xoffset: 15,
                        lens: '#0cf',
                        lensOpacity: 0.1
                    });
                });
            </script>
        </div>
        <div class="item_baseinfo col-sm-7">
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header><!-- .entry-header -->
            <div class="item_status">
                <div class="shop_info">
                    <span class="label"><?php _e('在庫', '_ferret'); ?>：</span><span
                            class="stocknum text-right"><?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_stock'); ?></span>
                </div>
                <div class="price">
                    <?php echo money_format(intval(shihaku_shop_info_get_meta('shihaku_shop_info_shihaku_shop_price')), 'JPY'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <?php
            the_content();
            
            wp_link_pages(array (
                'before' => '<div class="page-links">' . esc_html__('Pages:', '_ferret'),
                'after'  => '</div>',
            ));
        ?>
    </div><!-- .entry-content -->
    
    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', '_ferret'),
                            array (
                                'span' => array (
                                    'class' => array (),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
