<?php
    /**
     * _ferret's helps
     * @package _ferret
     */

    function _ferret_get_logo($desc = TRUE) {
        $description = get_bloginfo('description', 'display');
        $desc_string = "";
        if ($description || is_customize_preview()) :
            $desc_string = '<p class="site-description">' . $description . '</p>';
        endif;
        if (wp_is_mobile()) {
            if ((is_front_page() || is_home()) && get_theme_mod('custom_logo_sp_frontpage')) {
                $logo_id = get_theme_mod('custom_logo_sp_frontpage');
            } else {
                $logo_id = get_theme_mod('custom_logo_sp');
            }
        } else {
            if ((is_front_page() || is_home()) && get_theme_mod('custom_logo_frontpage')) {
                $logo_id = get_theme_mod('custom_logo_frontpage');
            } else {
                $logo_id = get_theme_mod('custom_logo');
            }
        }
        if (!$logo_id) {
            $html = '';
            $html .= '<h1 class="site-title">';
            $html .= '<a href="';
            $html .= esc_url(home_url(''));
            $html .= '" rel="home">';
            $html .= get_bloginfo('name');
            $html .= '</a>';
            $html .= '</h1>';
            $html .= $desc_string;

            return $html;
        } else {
            $custom_logo_attr = array (
                'class' => 'custom-logo custom-logo-sp',
            );
            $image_alt        = get_post_meta($logo_id, '_wp_attachment_image_alt', TRUE);
            if (empty($image_alt)) {
                $custom_logo_attr['alt'] = get_bloginfo('name', 'display');
            }
            $html = sprintf(
                '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
                esc_url(home_url('/')),
                wp_get_attachment_image($logo_id, 'full', FALSE, $custom_logo_attr)
            );
            if ($desc) {
                $html .= $desc_string;
            }

            return $html;
        }
        return;
    }


    /**
     * chekck any sidebar is avtive
     * @return bool
     */
    function _ferret_sidebar_is_active() {
        global $wp_registered_sidebars;

        foreach ($wp_registered_sidebars as $sidebar) {
            if (is_active_sidebar($sidebar['name']) or is_active_sidebar($sidebar['id'])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    function _ferret_get_all_sidebar() {
        global $wp_registered_sidebars;
        $allsidebar         = array ();
        $allsidebar['none'] = __('no sidebar', '_ferret');
        $allsidebar['default'] = __('page setting', '_ferret');
        foreach ($wp_registered_sidebars as $sidebar) {
            $allsidebar[$sidebar['id']] = $sidebar['name'];
        }
        return $allsidebar;

    }

    /**
     * return all post type
     * @return array
     */
    function _ferret_get_all_posttype() {

        $checkgroup = array (
            'post',
            'page'
        );
        $args       = array (
            'public'   => TRUE,
            '_builtin' => FALSE
        );
        $output     = 'names'; // 'names' or 'objects' (default: 'names')
        $operator   = 'and'; // 'and' or 'or' (default: 'and')
        $post_types = get_post_types($args, $output, $operator);
        if ($post_types) { // If there are any custom public post types.
            foreach ($post_types as $post_type) {
                array_push($checkgroup, $post_type);
            }
        }
        return $checkgroup;
    }

    /**
     * Checks to see if we're on the homepage or not.
     */
    function _ferret_is_frontpage() {
        return (is_front_page() && !is_home());
    }

    /**
     * widget helper
     */
    if (!function_exists('_ferret_display_widget')):

        function _ferret_display_widget() {
            global $post;
            $val = (!empty($post->ID) and $val = get_post_meta($post->ID, "_ferret_display_post_sidebar", TRUE)) ? $val : get_theme_mod('_ferret_widget_default_view_' . get_post_type(), 'master-sidebar');
            $global_val= get_theme_mod("_ferret_widget_default_view_".get_post_type(), 'none');
            if ($global_val =='default'){
                if ($val != 'none')
                    dynamic_sidebar($val);
            }else{
                dynamic_sidebar($global_val);
            }


        }
    endif;

    if (!function_exists('_ferret_get_widget_col')):

        function _ferret_get_widget_col() {
            global $post;
            if (!empty($post->ID)):
                $css = get_theme_mod('_ferret_widget_default_order_' . get_post_type(), 'right');
            else:
                $css = get_theme_mod('_ferret_widget_default_order_master', 'right');
            endif;

            if ($css == 'left'):
                $css = 'order-md-3 order-right';
            else:
                $css = '';
            endif;

            return $css;
        }
    endif;

    if (!function_exists('_ferret_check_widget')):

        function _ferret_check_widget() {
            global $post;
            $global_val= get_theme_mod("_ferret_widget_default_view_".get_post_type(), 'none');
            $val = (!empty($post->ID) and $val = get_post_meta($post->ID, "_ferret_display_post_sidebar", TRUE)) ? $val : get_theme_mod('_ferret_widget_default_view_' . get_post_type(), 'master-sidebar');
            if ($val != 'none' and $val != 'default'):
                if ($global_val != 'none'){
                    return TRUE;
                }else{
                    return false;
                }
            else:
                return FALSE;
            endif;

        }
    endif;

    if (!function_exists('money_format')) {
        /*
        That it is an implementation of the function money_format for the
        platforms that do not it bear.

        The function accepts to same string of format accepts for the
        original function of the PHP.

        (Sorry. my writing in English is very bad)

        The function is tested using PHP 5.1.4 in Windows XP
        and Apache WebServer.
        */
        function money_format($floatcurr, $curr = 'EUR') {
            $currencies['ARS'] = array (2, ',', '.');          //  Argentine Peso
            $currencies['AMD'] = array (2, '.', ',');          //  Armenian Dram
            $currencies['AWG'] = array (2, '.', ',');          //  Aruban Guilder
            $currencies['AUD'] = array (2, '.', ' ');          //  Australian Dollar
            $currencies['BSD'] = array (2, '.', ',');          //  Bahamian Dollar
            $currencies['BHD'] = array (3, '.', ',');          //  Bahraini Dinar
            $currencies['BDT'] = array (2, '.', ',');          //  Bangladesh, Taka
            $currencies['BZD'] = array (2, '.', ',');          //  Belize Dollar
            $currencies['BMD'] = array (2, '.', ',');          //  Bermudian Dollar
            $currencies['BOB'] = array (2, '.', ',');          //  Bolivia, Boliviano
            $currencies['BAM'] = array (2, '.', ',');          //  Bosnia and Herzegovina, Convertible Marks
            $currencies['BWP'] = array (2, '.', ',');          //  Botswana, Pula
            $currencies['BRL'] = array (2, ',', '.');          //  Brazilian Real
            $currencies['BND'] = array (2, '.', ',');          //  Brunei Dollar
            $currencies['CAD'] = array (2, '.', ',');          //  Canadian Dollar
            $currencies['KYD'] = array (2, '.', ',');          //  Cayman Islands Dollar
            $currencies['CLP'] = array (0, '', '.');          //  Chilean Peso
            $currencies['CNY'] = array (2, '.', ',');          //  China Yuan Renminbi
            $currencies['COP'] = array (2, ',', '.');          //  Colombian Peso
            $currencies['CRC'] = array (2, ',', '.');          //  Costa Rican Colon
            $currencies['HRK'] = array (2, ',', '.');          //  Croatian Kuna
            $currencies['CUC'] = array (2, '.', ',');          //  Cuban Convertible Peso
            $currencies['CUP'] = array (2, '.', ',');          //  Cuban Peso
            $currencies['CYP'] = array (2, '.', ',');          //  Cyprus Pound
            $currencies['CZK'] = array (2, '.', ',');          //  Czech Koruna
            $currencies['DKK'] = array (2, ',', '.');          //  Danish Krone
            $currencies['DOP'] = array (2, '.', ',');          //  Dominican Peso
            $currencies['XCD'] = array (2, '.', ',');          //  East Caribbean Dollar
            $currencies['EGP'] = array (2, '.', ',');          //  Egyptian Pound
            $currencies['SVC'] = array (2, '.', ',');          //  El Salvador Colon
            $currencies['ATS'] = array (2, ',', '.');          //  Euro
            $currencies['BEF'] = array (2, ',', '.');          //  Euro
            $currencies['DEM'] = array (2, ',', '.');          //  Euro
            $currencies['EEK'] = array (2, ',', '.');          //  Euro
            $currencies['ESP'] = array (2, ',', '.');          //  Euro
            $currencies['EUR'] = array (2, ',', '.');          //  Euro
            $currencies['FIM'] = array (2, ',', '.');          //  Euro
            $currencies['FRF'] = array (2, ',', '.');          //  Euro
            $currencies['GRD'] = array (2, ',', '.');          //  Euro
            $currencies['IEP'] = array (2, ',', '.');          //  Euro
            $currencies['ITL'] = array (2, ',', '.');          //  Euro
            $currencies['LUF'] = array (2, ',', '.');          //  Euro
            $currencies['NLG'] = array (2, ',', '.');          //  Euro
            $currencies['PTE'] = array (2, ',', '.');          //  Euro
            $currencies['GHC'] = array (2, '.', ',');          //  Ghana, Cedi
            $currencies['GIP'] = array (2, '.', ',');          //  Gibraltar Pound
            $currencies['GTQ'] = array (2, '.', ',');          //  Guatemala, Quetzal
            $currencies['HNL'] = array (2, '.', ',');          //  Honduras, Lempira
            $currencies['HKD'] = array (2, '.', ',');          //  Hong Kong Dollar
            $currencies['HUF'] = array (0, '', '.');          //  Hungary, Forint
            $currencies['ISK'] = array (0, '', '.');          //  Iceland Krona
            $currencies['INR'] = array (2, '.', ',');          //  Indian Rupee
            $currencies['IDR'] = array (2, ',', '.');          //  Indonesia, Rupiah
            $currencies['IRR'] = array (2, '.', ',');          //  Iranian Rial
            $currencies['JMD'] = array (2, '.', ',');          //  Jamaican Dollar
            $currencies['JPY'] = array (0, '', ',');          //  Japan, Yen
            $currencies['JOD'] = array (3, '.', ',');          //  Jordanian Dinar
            $currencies['KES'] = array (2, '.', ',');          //  Kenyan Shilling
            $currencies['KWD'] = array (3, '.', ',');          //  Kuwaiti Dinar
            $currencies['LVL'] = array (2, '.', ',');          //  Latvian Lats
            $currencies['LBP'] = array (0, '', ' ');          //  Lebanese Pound
            $currencies['LTL'] = array (2, ',', ' ');          //  Lithuanian Litas
            $currencies['MKD'] = array (2, '.', ',');          //  Macedonia, Denar
            $currencies['MYR'] = array (2, '.', ',');          //  Malaysian Ringgit
            $currencies['MTL'] = array (2, '.', ',');          //  Maltese Lira
            $currencies['MUR'] = array (0, '', ',');          //  Mauritius Rupee
            $currencies['MXN'] = array (2, '.', ',');          //  Mexican Peso
            $currencies['MZM'] = array (2, ',', '.');          //  Mozambique Metical
            $currencies['NPR'] = array (2, '.', ',');          //  Nepalese Rupee
            $currencies['ANG'] = array (2, '.', ',');          //  Netherlands Antillian Guilder
            $currencies['ILS'] = array (2, '.', ',');          //  New Israeli Shekel
            $currencies['TRY'] = array (2, '.', ',');          //  New Turkish Lira
            $currencies['NZD'] = array (2, '.', ',');          //  New Zealand Dollar
            $currencies['NOK'] = array (2, ',', '.');          //  Norwegian Krone
            $currencies['PKR'] = array (2, '.', ',');          //  Pakistan Rupee
            $currencies['PEN'] = array (2, '.', ',');          //  Peru, Nuevo Sol
            $currencies['UYU'] = array (2, ',', '.');          //  Peso Uruguayo
            $currencies['PHP'] = array (2, '.', ',');          //  Philippine Peso
            $currencies['PLN'] = array (2, '.', ' ');          //  Poland, Zloty
            $currencies['GBP'] = array (2, '.', ',');          //  Pound Sterling
            $currencies['OMR'] = array (3, '.', ',');          //  Rial Omani
            $currencies['RON'] = array (2, ',', '.');          //  Romania, New Leu
            $currencies['ROL'] = array (2, ',', '.');          //  Romania, Old Leu
            $currencies['RUB'] = array (2, ',', '.');          //  Russian Ruble
            $currencies['SAR'] = array (2, '.', ',');          //  Saudi Riyal
            $currencies['SGD'] = array (2, '.', ',');          //  Singapore Dollar
            $currencies['SKK'] = array (2, ',', ' ');          //  Slovak Koruna
            $currencies['SIT'] = array (2, ',', '.');          //  Slovenia, Tolar
            $currencies['ZAR'] = array (2, '.', ' ');          //  South Africa, Rand
            $currencies['KRW'] = array (0, '', ',');          //  South Korea, Won
            $currencies['SZL'] = array (2, '.', ', ');         //  Swaziland, Lilangeni
            $currencies['SEK'] = array (2, ',', '.');          //  Swedish Krona
            $currencies['CHF'] = array (2, '.', '\'');         //  Swiss Franc
            $currencies['TZS'] = array (2, '.', ',');          //  Tanzanian Shilling
            $currencies['THB'] = array (2, '.', ',');          //  Thailand, Baht
            $currencies['TOP'] = array (2, '.', ',');          //  Tonga, Paanga
            $currencies['AED'] = array (2, '.', ',');          //  UAE Dirham
            $currencies['UAH'] = array (2, ',', ' ');          //  Ukraine, Hryvnia
            $currencies['USD'] = array (2, '.', ',');          //  US Dollar
            $currencies['VUV'] = array (0, '', ',');          //  Vanuatu, Vatu
            $currencies['VEF'] = array (2, ',', '.');          //  Venezuela Bolivares Fuertes
            $currencies['VEB'] = array (2, ',', '.');          //  Venezuela, Bolivar
            $currencies['VND'] = array (0, '', '.');          //  Viet Nam, Dong
            $currencies['ZWD'] = array (2, '.', ' ');          //  Zimbabwe Dollar
            // custom function to generate: ##,##,###.##
            function formatinr($input) {
                $dec = "";
                $pos = strpos($input, ".");
                if ($pos === FALSE) {
                    //no decimals
                } else {
                    //decimals
                    $dec   = substr(round(substr($input, $pos), 2), 1);
                    $input = substr($input, 0, $pos);
                }
                $num   = substr($input, -3);    // get the last 3 digits
                $input = substr($input, 0, -3); // omit the last 3 digits already stored in $num
                // loop the process - further get digits 2 by 2
                while (strlen($input) > 0) {
                    $num   = substr($input, -2) . "," . $num;
                    $input = substr($input, 0, -2);
                }
                return $num . $dec;
            }

            if ($curr == "INR") {
                return formatinr($floatcurr);
            } else {
                return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
            }
        }
    }
