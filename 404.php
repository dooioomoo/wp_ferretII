<?php
    /**
     * The template for displaying 404 pages (not found)
     *
     * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
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

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', '_ferret'); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_ferret'); ?></p>
                    
                    <?php
                        get_search_form();
                        
                        the_widget('WP_Widget_Recent_Posts');
                    ?>

                    <div class="widget widget_categories">
                        <h2 class="widget-title"><?php esc_html_e('Most Used Categories', '_ferret'); ?></h2>
                        <ul>
                            <?php
                                wp_list_categories(array (
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ));
                            ?>
                        </ul>
                    </div><!-- .widget -->
                    
                    <?php
                        /* translators: %1$s: smiley */
                        $_ferret_archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', '_ferret'), convert_smilies(':)')) . '</p>';
                        the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$_ferret_archive_content");
                        
                        the_widget('WP_Widget_Tag_Cloud');
                    ?>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->
            
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
