<div class="AlignLeft">
<?php
// v5.13: security flaw fixed in query
//  $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cID'] . "'");
  $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . intval($_GET['cID']) . "'");
  $coupon = tep_db_fetch_array($coupon_query);
  $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cID'] . "' and language_id = '" . $languages_id . "'");
  $coupon_desc = tep_db_fetch_array($coupon_desc_query);
  $text_coupon_help = TEXT_COUPON_HELP_HEADER;
  $text_coupon_help .= sprintf(TEXT_COUPON_HELP_NAME, $coupon_desc['coupon_name']);
  if (tep_not_null($coupon_desc['coupon_description'])) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DESC, $coupon_desc['coupon_description']);
  $coupon_amount = $coupon['coupon_amount'];
  switch ($coupon['coupon_type']) {
    case 'F':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, $currencies->format($coupon['coupon_amount']));
    break;
    case 'P':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, number_format($coupon['coupon_amount'],2). '%');
    break;
    case 'S':
    $text_coupon_help .= TEXT_COUPON_HELP_FREESHIP;
    break;
    default:
  }
  if ($coupon['coupon_minimum_order'] > 0 ) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_MINORDER, $currencies->format($coupon['coupon_minimum_order']));
  $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DATE, tep_date_short($coupon['coupon_start_date']),tep_date_short($coupon['coupon_expire_date']));
  $text_coupon_help .= '<span class="b">' . TEXT_COUPON_HELP_RESTRICT . '</span>';
  $text_coupon_help .= '<br /><br />' .  TEXT_COUPON_HELP_CATEGORIES;
  $coupon_get=tep_db_query("select restrict_to_categories from " . TABLE_COUPONS . " where coupon_id='".$_GET['cID']."'");
  $get_result=tep_db_fetch_array($coupon_get);

  $cat_ids = split("[,]", $get_result['restrict_to_categories']);
  for ($i = 0; $i < count($cat_ids); $i++) {
    $result = tep_db_query("SELECT * FROM " . TABLE_CATEGORIES . ", " . TABLE_CATEGORIES_DESCRIPTION . " WHERE " . TABLE_CATEGORIES . ".categories_id = " . TABLE_CATEGORIES_DESCRIPTION . ".categories_id and " . TABLE_CATEGORIES_DESCRIPTION . ".language_id = '" . $languages_id . "' and " . TABLE_CATEGORIES . ".categories_id='" . $cat_ids[$i] . "'");
    if ($row = tep_db_fetch_array($result)) {
    $cats .= '<br />' . $row["categories_name"];
    }
  }
  if ($cats=='') $cats = '<br />NONE';
  $text_coupon_help .= $cats;
  $text_coupon_help .= '<br /><br />' .  TEXT_COUPON_HELP_PRODUCTS;
  $coupon_get=tep_db_query("select restrict_to_products from " . TABLE_COUPONS . "  where coupon_id='".$_GET['cID']."'");
  $get_result=tep_db_fetch_array($coupon_get);

  $pr_ids = split("[,]", $get_result['restrict_to_products']);
  for ($i = 0; $i < count($pr_ids); $i++) {
    $result = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS . ", " . TABLE_PRODUCTS_DESCRIPTION . " WHERE " . TABLE_PRODUCTS . ".products_id = " . TABLE_PRODUCTS_DESCRIPTION . ".products_id and " . TABLE_PRODUCTS_DESCRIPTION . ".language_id = '" . $languages_id . "'and " . TABLE_PRODUCTS . ".products_id = '" . $pr_ids[$i] . "'");
    if ($row = tep_db_fetch_array($result)) {
      $prods .= '<br />' . $row["products_name"];
    }
  }
  if ($prods=='') $prods = '<br />NONE';
  $text_coupon_help .= $prods;


  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_COUPON_HELP);


  new infoBoxHeading($info_box_contents, true, true);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => $text_coupon_help);

  new infoBox($info_box_contents);
?>
<br />
<?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
</div>