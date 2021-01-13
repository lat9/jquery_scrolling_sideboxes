<?php
// -----
// Scrolling best_sellers sidebox, based on the best_sellers.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014-2021, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2005 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$content  = '<div id="best_sellers_scrolling" class="sideBoxContent centeredContent">';
$count = 1;
while (!$best_sellers_scrolling->EOF) {
    $bss_pid = $best_sellers_scrolling->fields['products_id'];
    $bss_pname = $best_sellers_scrolling->fields['products_name'];
    $content .= PHP_EOL . '  <div class="sideBoxContentItem hiddenField bestSellersScroller">';
    $content .= '<a href="' . zen_href_link(zen_get_info_page($bss_pid), "products_id=$bss_pid") . '">' . zen_image(DIR_WS_IMAGES . $best_sellers_scrolling->fields['products_image'], $bss_pname, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $content .= "<br />#$count: $bss_pname</a>";
    $content .= '</div>';
    $count++;
    $best_sellers_scrolling->MoveNext();
}
$content .= '</div><script type="text/javascript">$("div.bestSellersScroller").cycle(10000);</script>' . "\n";