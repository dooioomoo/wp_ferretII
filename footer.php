<?php
    /**
     * theme footer
     * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
     * @package _ferret
     */

?>
</div><!-- .container -->
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="site-info">
                    <a href="<?php get_site_url(); ?>" class="copylink">
                        <?php
                            /* translators: %s: CMS name, i.e. WordPress. */
                            printf(esc_html__(date('Y') . ' &copy; %s', '_ferret'), get_bloginfo('name'));
                        ?>
                    </a>
                    <span class="sep"> | </span>
                    <span class="copyright">
                    <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf(esc_html__('All Rights Reserved.', '_ferret'), '');
                    ?>
                    </span>
                </div><!-- .site-info -->
            </div> <!-- .col-md-12 -->
        </div><!-- .row -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<a href="#" id="back-to-top" title="Back to top"><i class="fas fa-chevron-up"></i></a>
</body>
</html>
