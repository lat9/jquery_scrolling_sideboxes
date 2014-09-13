<?php
// -----
// Scrolling "what's new" sidebox, based on the whats_new.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2010 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$display_limit = zen_get_new_date_range();
$whats_new_scrolling_sql = "SELECT p.products_id, p.products_image, p.products_tax_class_id, p.products_price, pd.products_name, p.master_categories_id
                              FROM (" . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             WHERE p.products_id = pd.products_id
                               AND pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                               AND p.products_status = 1 " . $display_limit;

$whats_new_scrolling = $db->ExecuteRandomMulti ($whats_new_scrolling_sql, MAX_RANDOM_SELECT_NEW);

if (!$whats_new_scrolling->EOF) {
  require ($template->get_template_dir('tpl_whats_new_scrolling.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_whats_new_scrolling.php');
  $title =  BOX_HEADING_WHATS_NEW_SCROLLING;
  $title_link = FILENAME_PRODUCTS_NEW;
  require ($template->get_template_dir ($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
  
}