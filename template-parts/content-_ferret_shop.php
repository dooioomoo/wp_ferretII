<?php
    /**
     * Template part for displaying page content in page.php
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package _ferret
     */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-xs-6 col-md-4'); ?>>
    <div class="content_wrap">
        <?php if (!is_front_page()): ?>
            <?php _ferret_post_thumbnail(); ?>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title text-truncate" data-toggle="tooltip" data-placement="top" title="' . get_the_title() . '"><a href="' . get_permalink() . '" alt="' . get_the_title() . '">', '</a></h1>'); ?>
            </header><!-- .entry-header -->
            <hr>
        
        <?php endif; ?>
        <div class="entry-content">
            <div class="shop_info">
                <span class="label"><?php _e('数量', '_ferret'); ?>：</span><span
                        class="stocknum text-right"><?php echo _ferret_shop_info_get_meta('_ferret_shop_info__ferret_shop_stock'); ?></span>
            </div>
            <div class="price">
                <?php echo money_format(intval(shihaku_shop_info_get_meta('shihaku_shop_info_shihaku_shop_price')), 'JPY'); ?>
            </div>

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
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
