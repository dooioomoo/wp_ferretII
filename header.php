<?php
    /**
     * theme header
     * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
     * @package _ferret
     */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php _ferret_create_title_tag(); ?>
    <?php _ferret_create_seo_meta(); ?>
    
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php _ferret_page_loader(); ?>


<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part('template-parts/header/header', 'image'); ?>
    </header><!-- #masthead -->
    <div id="content" class="site-content">
        <div class="container">
