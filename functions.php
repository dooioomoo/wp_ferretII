<?php
    /**
     * _ferret's functions and definitions
     * @link https://developer.wordpress.org/themes/basics/theme-functions/
     * @package _ferret
     * @since _ferret 1.0
     */
    
    define('___ferret_theme_ver__', '1.0');
    define('___ferret_theme_uri__', get_template_directory_uri());
    define('___ferret_theme_path__', get_template_directory());
    require_once(___ferret_theme_path__ . '/inc/init.php');

add_action( 'admin_menu', 'my_remove_menu_pages', 9999 );
function my_remove_menu_pages() {

  global $user_ID,$menu;
  
  //var_dump($menu);

  if ( $user_ID != 1 ) { //your user id

   //remove_menu_page('edit.php'); // Posts
   //remove_menu_page('upload.php'); // Media
   remove_menu_page('link-manager.php'); // Links
   remove_menu_page('edit-comments.php'); // Comments
   //remove_menu_page('edit.php?post_type=page'); // Pages
   remove_menu_page('plugins.php'); // Plugins
   remove_menu_page('themes.php'); // Appearance
   remove_menu_page('users.php'); // Users
   remove_menu_page('tools.php'); // Tools
   remove_menu_page('options-general.php'); // Settings
   //remove_menu_page('edit.php'); // Posts
   remove_menu_page('clayball-settings'); // Media
   remove_menu_page('revslider');
   remove_menu_page('vc-general');
   remove_menu_page('responsive-menu');
   remove_menu_page('hb_menu');
   remove_menu_page('ai1wm_export');
  }
}
