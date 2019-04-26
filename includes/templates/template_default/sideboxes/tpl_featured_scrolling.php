<?php
// -----
// Scrolling "featured" sidebox, based on the featured.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014-2019, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2011 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$content = '<div class="sideBoxContent centeredContent">';
while (!$scrolling_featured->EOF) {
    $featured_box_price = zen_get_products_display_price($scrolling_featured->fields['products_id']);
    $fs_pid = $scrolling_featured->fields['products_id'];
    $fs_pname = $scrolling_featured->fields['products_name'];
    $content .= PHP_EOL . '  <div class="sideBoxContentItem hiddenField featuredScroller">';
    $content .=  '<a href="' . zen_href_link (zen_get_info_page($fs_pid), 'cPath=' . zen_get_generated_category_path_rev($scrolling_featured->fields["master_categories_id"]) . "&products_id=$fs_pid") . '">' . zen_image(DIR_WS_IMAGES . $scrolling_featured->fields['products_image'], $fs_pname, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $content .= '<br />' . $fs_pname . '</a>';
    $content .= '<div>' . $featured_box_price . '</div>';
    $content .= '</div>';
    $scrolling_featured->MoveNextRandom();
}
$content .= '</div><script type="text/javascript">$("div.featuredScroller").cycle(10000);</script>' . "\n";
