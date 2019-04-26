<?php
// -----
// Scrolling "what's new" sidebox, based on the whats_new.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014-2019, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2011 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$content = '<div class="sideBoxContent centeredContent">';
while (!$whats_new_scrolling->EOF) {
    $wns_pid = $whats_new_scrolling->fields['products_id'];
    $wns_pname = $whats_new_scrolling->fields['products_name'];
    $whats_new_price = zen_get_products_display_price($wns_pid);
    $content .= "\n" . '  <div class="sideBoxContentItem hiddenField whatsNewScroller">';
    $content .= '<a href="' . zen_href_link(zen_get_info_page($wns_pid), 'cPath=' . zen_get_generated_category_path_rev($whats_new_scrolling->fields['master_categories_id']) . "&products_id=$wns_pid") . '">' . zen_image(DIR_WS_IMAGES . $whats_new_scrolling->fields['products_image'], $wns_pname, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $content .= '<br />' . $wns_pname . '</a>';
    $content .= '<div>' . $whats_new_price . '</div>';
    $content .= '</div>';
    $whats_new_scrolling->MoveNextRandom();
}
$content .= '</div><script type="text/javascript">$("div.whatsNewScroller").cycle(10000);</script>' . "\n";
