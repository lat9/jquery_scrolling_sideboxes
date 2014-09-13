<?php
// -----
// Scrolling "featured" sidebox, based on the featured.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2007 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$scrolling_featured_sql = "SELECT p.products_id, p.products_image, pd.products_name, p.master_categories_id
                             FROM (" . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_FEATURED . " f on p.products_id = f.products_id LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                            WHERE p.products_id = f.products_id
                              AND p.products_id = pd.products_id
                              AND p.products_status = 1
                              AND f.status = 1
                              AND pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

$scrolling_featured = $db->ExecuteRandomMulti ($scrolling_featured_sql, MAX_RANDOM_SELECT_FEATURED_PRODUCTS);

if (!$scrolling_featured->EOF)  {
  require ($template->get_template_dir ('tpl_featured_scrolling.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_featured_scrolling.php');
  $title =  BOX_HEADING_FEATURED_SCROLLING;
  $title_link = FILENAME_FEATURED_PRODUCTS;
  require ($template->get_template_dir ($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
  
}
