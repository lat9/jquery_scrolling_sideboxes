<?php
// -----
// Scrolling "specials" sidebox, based on the specials.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014-2019, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2007 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
if (!isset($_GET['products_id'])) {
    $scrolling_specials_sql = 
        "SELECT p.products_id, pd.products_name, p.products_image, p.master_categories_id
           FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s
          WHERE p.products_status = 1
            AND p.products_id = s.products_id
            AND s.status = 1
            AND pd.products_id = s.products_id
            AND pd.language_id = " . (int)$_SESSION['languages_id'];
    $scrolling_specials = $db->ExecuteRandomMulti($scrolling_specials_sql, (int)MAX_RANDOM_SELECT_SPECIALS);

    if (!$scrolling_specials->EOF)  {
        require $template->get_template_dir('tpl_specials_scrolling.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_specials_scrolling.php';
        $title =  BOX_HEADING_SPECIALS_SCROLLING;
        $title_link = FILENAME_SPECIALS;
        require $template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default;
    }
}
