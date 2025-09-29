<?php
    /**
     * Template Name:  FRONTPAGE TEMPLATE
     *
     * @package _ferret
     */
    
    get_header();
?>
<?php do_action('underscoresme_print_form'); ?>
    <div id="primary" class="content-area">
        <div class="row">
            <?php
                /**
                 * @route /inc/base/add_action
                 * @code <main id="main" class="site-main">
                 */
                do_action('_ferret_get_main_col'); ?>
            
            <?php
                while (have_posts()) :
                    the_post();
                    
                    get_template_part('template-parts/content', get_post_type());
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                
                endwhile; // End of the loop.
            ?>
            
            <?php do_action('_ferret_get_main_col_end'); ?><!-- #main -->
            
            <?php
                /**
                 * @route /inc/base/add_action
                 * @code <div class="sidebar col-md-4">
                 */
                do_action('_ferret_get_sidebar_col'); ?>
        </div>
    </div><!-- #primary -->
<?php
    get_footer();
