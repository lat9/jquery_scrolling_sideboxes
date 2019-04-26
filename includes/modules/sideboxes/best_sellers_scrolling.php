<?php
// -----
// Scrolling best_sellers sidebox, based on the best_sellers.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2011 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$show_best_sellers_scrolling = false;
if (!isset($_GET['products_id'])) {
    $show_best_sellers_scrolling = true;
} elseif (isset($_SESSION['customer_id'])) {
    $check = $db->Execute(
        "SELECT global_product_notifications 
           FROM " . TABLE_CUSTOMERS_INFO . " 
          WHERE customers_info_id = " . (int)$_SESSION['customer_id'] . " 
            AND global_product_notifications = 1 
          LIMIT 1"
    );
    $show_best_sellers_scrolling = !$check->EOF;
}

// -----
// Quick return if we're not displaying the sidebox.
//
if (!$show_best_sellers_scrolling) {
    return;
}

$bestsellers_scrolling_list = array();

if (isset($current_category_id) && $current_category_id > 0) {
    $best_sellers_scrolling_query = 
        "SELECT DISTINCT p.products_id, pd.products_name, p.products_ordered, p.products_image
           FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_ordered > 0
            AND p.products_id = pd.products_id
            AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND '" . (int)$current_category_id . "' IN (c.categories_id, c.parent_id)
       ORDER BY p.products_ordered desc, pd.products_name";

} else {
    $best_sellers_scrolling_query = 
        "SELECT DISTINCT p.products_id, pd.products_name, p.products_ordered, p.products_image
           FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
           WHERE p.products_status = 1
            AND p.products_ordered > 0
            AND p.products_id = pd.products_id
            AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
       ORDER BY p.products_ordered desc, pd.products_name";
}
$limit = (trim(MAX_DISPLAY_BESTSELLERS) == '') ? '' : (" LIMIT " . (int)MAX_DISPLAY_BESTSELLERS);
$best_sellers_scrolling = $db->Execute($best_sellers_scrolling_query . $limit);
if ($best_sellers_scrolling->RecordCount() >= (int)MIN_DISPLAY_BESTSELLERS) {
    $title =  BOX_HEADING_BESTSELLERS_SCROLLING;
    $title_link = false;
    require $template->get_template_dir('tpl_best_sellers_scrolling.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_best_sellers_scrolling.php';
    require $template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default;
}
