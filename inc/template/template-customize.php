<?php
    /**
     * nishifunabashihotel's template customize
     * @package nishifunabashihotel
     */
    
    add_action('customize_register', 'nishifunabashihotel_template_customize_register');
    add_action('customize_register', 'nishifunabashihotel_logo_uploader');
    add_filter('comment_form_defaults', 'nishifunabashihotel_comment_form_change');
    
    if (!function_exists('nishifunabashihotel_template_customize_register')):
        function nishifunabashihotel_template_customize_register($wp_customize) {
            /**
             * add default view for widget
             */
            
            $wp_customize->add_panel('nishifunabashihotel_theme_options', array (
                'priority'       => 500,
                'theme_supports' => '',
                'title'          => __('Theme Options', 'nishifunabashihotel'),
                'description'    => __('set something for the theme.', 'nishifunabashihotel'),
            ));
            
            $wp_customize->add_section('nishifunabashihotel_theme_options_widget_section', array (
                'title'       => __('Widget', 'nishifunabashihotel'),
                'description' => __('custom theme widget options in here'),
                'panel'       => 'nishifunabashihotel_theme_options', // Not typically needed.
            ));
            
            $wp_customize->add_section('nishifunabashihotel_theme_options_loader_section', array (
                'title'       => __('Loader', 'nishifunabashihotel'),
                'description' => __('set your page loader in here'),
                'panel'       => 'nishifunabashihotel_theme_options', // Not typically needed.
            ));
            
            nishifunabashihotel_custom_default_view_by_posttype($wp_customize);
            
        }
    endif;
    
    /**
     * create default sidebar view by post type
     *
     * @param $wp_customize
     */
    function nishifunabashihotel_custom_default_view_by_posttype($wp_customize) {
        
        /***
         * WIDGET
         */
        $wp_customize->add_setting(
            'nishifunabashihotel_widget_default_order_master', array (
                'default'   => 'right',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'nishifunabashihotel_widget_default_order_master',
                array (
                    'label'    => __('Default sidebar for master', 'nishifunabashihotel'),
                    'section'  => 'nishifunabashihotel_theme_options_widget_section',
                    'settings' => 'nishifunabashihotel_widget_default_order_master',
                    'type'     => 'select',
                    'choices'  => array (
                        'right' => __('right'),
                        'left'  => __('left'),
                    )
                )
            )
        );
        $post_type = nishifunabashihotel_get_all_posttype();
        foreach ($post_type as $index => $type) {
            $wp_customize->add_setting(
                'nishifunabashihotel_widget_default_view_' . $type, array (
                    'default'   => 'none',
                    'transport' => 'postMessage',
                )
            );
            $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize,
                    'nishifunabashihotel_widget_default_view_' . $type,
                    array (
                        'label'    => __('Default sidebar for', 'nishifunabashihotel') . ' \'' . $type . '\'',
                        'section'  => 'nishifunabashihotel_theme_options_widget_section',
                        'settings' => 'nishifunabashihotel_widget_default_view_' . $type,
                        'type'     => 'select',
                        'choices'  => nishifunabashihotel_get_all_sidebar()
                    )
                )
            );
            $wp_customize->add_setting(
                'nishifunabashihotel_widget_default_order_' . $type, array (
                    'default'   => 'right',
                    'transport' => 'postMessage',
                )
            );
            $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize,
                    'nishifunabashihotel_widget_default_order_' . $type,
                    array (
                        'section'  => 'nishifunabashihotel_theme_options_widget_section',
                        'settings' => 'nishifunabashihotel_widget_default_order_' . $type,
                        'type'     => 'select',
                        'choices'  => array (
                            'right' => __('right'),
                            'left'  => __('left'),
                        )
                    )
                )
            );
        }
        
        
        /***
         * loader
         */
        
        $wp_customize->add_setting(
            'nishifunabashihotel_theme_options_loader_settings', array (
                'default'   => 'none',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'nishifunabashihotel_loader_default_order_master',
                array (
                    'label'    => __('add a loader element', 'nishifunabashihotel'),
                    'section'  => 'nishifunabashihotel_theme_options_loader_section',
                    'settings' => 'nishifunabashihotel_theme_options_loader_settings',
                    'type'     => 'select',
                    'choices'  => array (
                        'none'         => __(''),
                        'random'       => __('random'),
                        'flash_left'   => __('left'),
                        'flash_right'  => __('right'),
                        'flash_top'    => __('top'),
                        'flash_bottom' => __('bottom'),
                        'fadeOut'      => __('fadeOut'),
                    )
                )
            )
        );
        $wp_customize->add_setting(
            'nishifunabashihotel_theme_options_loader_style_settings', array (
                'default'   => 'default',
                'transport' => 'postMessage',
            )
        );
        $style_option = array (
            'default' => __('default', 'nishifunabashihotel'),
        );
        for ($i = 1; $i <= 9; $i++) {
            $style_option[$i] = __('style-' . $i);
        }
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'nishifunabashihotel_loader_style',
                array (
                    'label'    => __('choice loader style', 'nishifunabashihotel'),
                    'section'  => 'nishifunabashihotel_theme_options_loader_section',
                    'settings' => 'nishifunabashihotel_theme_options_loader_style_settings',
                    'type'     => 'select',
                    'choices'  => $style_option
                )
            )
        );
    }
    
    function nishifunabashihotel_comment_form_change($form) {
        global $user_identity, $post_id;
        $form['logged_in_as'] = '<p class="logged-in-as">' . sprintf(
            /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                __('<a href="%1$s" aria-label="%2$s" class="btn btn-primary btn-lg">Logged in as %3$s</a>&nbsp;&nbsp;<a href="%4$s" class="btn btn-info btn-lg">Log out?</a>', 'nishifunabashihotel'),
                get_edit_user_link(),
                /* translators: %s: user name */
                esc_attr(sprintf(__('Logged in as %s. Edit your profile.', 'nishifunabashihotel'), $user_identity)),
                $user_identity,
                wp_logout_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
            ) . '</p>';
        
        return $form;
    }
    
    function nishifunabashihotel_logo_uploader($wp_customize) {
        
        $wp_customize->add_section('nishifunabashihotel_upload_custom_logo', array (
            'title'       => 'Logo',
            'description' => 'Set up a logo for your website',
            'priority'    => 25,
        ));
        
        $wp_customize->add_setting('custom_logo_frontpage', array (
            'default' => '',
        ));
        
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo_frontpage', array (
            'label'    => 'FrontPage Logo',
            'section'  => 'nishifunabashihotel_upload_custom_logo', // put the name of whatever section you want to add your settings
            'settings' => 'custom_logo_frontpage',
        )));
        
        $wp_customize->add_setting('custom_logo', array (
            'default' => '',
        ));
        
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo', array (
            'label'    => 'Primary Logo',
            'section'  => 'nishifunabashihotel_upload_custom_logo',
            'settings' => 'custom_logo',
        )));
        
        $wp_customize->add_setting('custom_logo_sp_frontpage', array (
            'default' => '',
        ));
    
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo_sp_frontpage', array (
            'label'    => 'SmartPhone Frontpage Logo',
            'section'  => 'nishifunabashihotel_upload_custom_logo', // put the name of whatever section you want to add your settings
            'settings' => 'custom_logo_sp_frontpage',
        )));
        
        $wp_customize->add_setting('custom_logo_sp', array (
            'default' => '',
        ));
        
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo_sp', array (
            'label'    => 'SmartPhone Logo',
            'section'  => 'nishifunabashihotel_upload_custom_logo', // put the name of whatever section you want to add your settings
            'settings' => 'custom_logo_sp',
        )));
        
    }
