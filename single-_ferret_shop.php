<?php
    /**
     * The template for displaying all single posts
     *
     * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
     *
     * @package _ferret
     */
    
    get_header();
?>

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
                    
                    get_template_part('template-parts/content', '_ferret_shop_content');
                    
                    // the_post_navigation();
                    // If comments are open or we have at least one comment, load up the comment template.
                    // if ( comments_open() || get_comments_number() ) :
                    //     comments_template();
                    // endif;
                
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
