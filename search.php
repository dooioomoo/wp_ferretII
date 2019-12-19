<?php
    /**
     * The template for displaying archive pages
     *
     * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
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
            
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                            /* translators: %s: search query. */
                            printf(esc_html__('Search Results for: %s', '_ferret'), '<span>' . get_search_query() . '</span>');
                        ?>
                    </h1>
                </header><!-- .page-header -->
                
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    
                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'search');
                
                endwhile;
                
                the_posts_navigation();
            
            else :
                
                get_template_part('template-parts/content', 'none');
            
            endif;
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
