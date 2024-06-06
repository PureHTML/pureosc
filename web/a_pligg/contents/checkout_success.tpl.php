<?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_man_on_board.png'), HEADING_TITLE);
  echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">
  <?php echo TEXT_SUCCESS; ?><br /><br />
<?php
/*
  if ($global['global_product_notifications'] != '1') {
    echo '<br /><p class="productsNotifications">';

    $products_displayed = array();
    for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
      if (!in_array($products_array[$i]['id'], $products_displayed)) {
        echo tep_draw_checkbox_field_label(TEXT_NOTIFY_PRODUCTS, 'notify_news_' . $products_array[$i]['id'], 'notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br />';
        $products_displayed[] = $products_array[$i]['id'];
      }
    }

    echo '</p>';
  } else {
*/
    echo TEXT_SEE_ORDERS . '<br /><br />' . TEXT_CONTACT_STORE_OWNER;
//  }
?>
  <h2><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h2> <br />

<?php // ###### Added CCGV Contribution #########
 require('add_checkout_success.php'); //ICW CREDIT CLASS/GV SYSTEM 
// ###### Added CCGV Contribution #########
?>

<br /><br />
    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
</div>
  <br />
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <span class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?> &nbsp;
  <?php echo CHECKOUT_BAR_PAYMENT; ?> &nbsp;
  <?php echo CHECKOUT_BAR_CONFIRMATION; ?> &nbsp; </span>
  <span class="checkoutBarCurrent">
  <?php echo tep_image_2ma(DIR_WS_IMAGES . 'checkout_bullet.png'); ?>
   &nbsp; <?php echo CHECKOUT_BAR_FINISHED; ?> </span>
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <br />
  <?php if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); ?>
  </form>