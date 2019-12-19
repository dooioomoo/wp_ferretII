<?php
    
    function _ferret_page_loader() {
        $pageloader = get_theme_mod('_ferret_theme_options_loader_settings', 'none');
        if ($pageloader == 'none') return;
        $style = get_theme_mod('_ferret_theme_options_loader_style_settings', 'default');
        echo "<div class='page-loader-wrap' data-movestyle='{$pageloader}'>";
        echo "    <div class='page-loader-mask'>";
        echo "    </div>";
        echo "    <div class='page-loader-container'>";
        echo "        <div class='page-loader-style page-loader-{$style}'>";
        echo "            <div class='loader'>";
        echo "            </div>";
        echo "        </div>";
        echo "    </div>";
        echo "</div>";
    }