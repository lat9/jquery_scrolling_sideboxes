<?php
// -----
// Scrolling "featured" sidebox, based on the featured.php sidebox that's built into Zen Cart!
//
// Copyright (c) 2014, Vinos de Frutas Tropicales (lat9)
// Copyright 2003-2011 Zen Cart Development Team
// Copyright 2003 osCommerce
// License: http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
$content = '<div class="sideBoxContent centeredContent">';
while (!$scrolling_specials->EOF) {
  $specials_box_price = zen_get_products_display_price ($scrolling_specials->fields['products_id']);
  $content .= "\n" . '  <div class="sideBoxContentItem hiddenField specialsScroller">';
  $content .= '<a href="' . zen_href_link (zen_get_info_page ($scrolling_specials->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev ($scrolling_specials->fields["master_categories_id"]) . '&products_id=' . $scrolling_specials->fields["products_id"]) . '">' . zen_image (DIR_WS_IMAGES . $scrolling_specials->fields['products_image'], $scrolling_specials->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
  $content .= '<br />' . $scrolling_specials->fields['products_name'] . '</a>';
  $content .= '<div>' . $specials_box_price . '</div>';
  $content .= '</div>';
  $scrolling_specials->MoveNextRandom();
}
$content .= '</div><script type="text/javascript">$("div.specialsScroller").cycle(10000);</script>' . "\n";
