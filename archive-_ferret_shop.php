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
            <div class="row">
                <?php
                    $paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
                    $args  = array (
                        'post_type' => array ('posts', '_ferret_shop'),
                        'paged'     => $paged,
                    );
                    //                    $args = array('post_type'=>array('posts', 'jharrison_watch'));
                    query_posts($args);
                ?>
                <?php if (have_posts()) : ?>

                    <header class="page-header">
                        <?php
                            // the_archive_title('<h1 class="page-title">', '</h1>');
                            // the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        
                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', '_ferret_shop');
                    
                    endwhile;
                    
                    the_posts_navigation();
                
                else :
                    
                    get_template_part('template-parts/content', 'none');
                
                endif;
                ?>
                <div class="page-navigation">
                    <div class="pagination">
                        <?php echo paginate_links(array ('format'            => '?page=%#%', 'before_page_number' => '<span class="page-item">',
                                                         'after_page_number' => '</span>')); ?>
                    </div>
                </div>
            </div>
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
