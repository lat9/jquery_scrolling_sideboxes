<?php
// -----
// Scrolling best_sellers sidebox, based on the best_sellers.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2005 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$content  = '<div id="best_sellers_scrolling" class="sideBoxContent centeredContent">';
$count = 1;
while (!$best_sellers_scrolling->EOF) {
  $content .= "\n" . '  <div class="sideBoxContentItem hiddenField bestSellersScroller">';
  $content .= '<a href="' . zen_href_link (zen_get_info_page ($best_sellers_scrolling->fields['products_id']), 'products_id=' . $best_sellers_scrolling->fields['products_id']) . '">' . zen_image (DIR_WS_IMAGES . $best_sellers_scrolling->fields['products_image'], $best_sellers_scrolling->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
  $content .= "<br />#$count: " . $best_sellers_scrolling->fields['products_name'] . '</a>';
  $content .= '</div>';
  $count++;
  $best_sellers_scrolling->MoveNext ();
  
}
$content .= '</div><script type="text/javascript">$("div.bestSellersScroller").cycle(10000);</script>' . "\n";