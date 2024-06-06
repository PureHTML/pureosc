<?php echo tep_draw_form('account_notifications', tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<div class="AlignLeft">
  <h2 class="b"><?php echo MY_NOTIFICATIONS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo MY_NOTIFICATIONS_DESCRIPTION; ?> <br />
      </div> <br />
    <h2 class="b"><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
     <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('product_global')">
        <br /> <span class="b">
        <?php echo tep_draw_checkbox_field_label(GLOBAL_NOTIFICATIONS_TITLE, 'global_news', 'product_global', '1', (($global['global_product_notifications'] == '1') ? true : false), 'onclick="checkBox(\'product_global\')"'); ?> 
        </span> <br /><br />
     </div>
     <?php echo GLOBAL_NOTIFICATIONS_DESCRIPTION; ?> <br />
  </div> <br />
<?php
  if ($global['global_product_notifications'] != '1') {
?>
   <h2 class="b"><?php echo NOTIFICATIONS_TITLE; ?></h2>
   <div class="InfoBoxContenent2MA">
<?php
    $products_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "'");
    $products_check = tep_db_fetch_array($products_check_query);
    if ($products_check['total'] > 0) {
?>
      <?php echo NOTIFICATIONS_DESCRIPTION; ?> <br />
<?php
      $counter = 0;
      $products_query = tep_db_query("select pd.products_id, pd.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where pn.customers_id = '" . (int)$customer_id . "' and pn.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name");
      while ($products = tep_db_fetch_array($products_query)) {
?>
    <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('products[<?php echo $counter; ?>]')">
    <br />
    <?php echo tep_draw_checkbox_field_label($products['products_name'], 'id_n_' . $products['products_id'], 'products[' . $counter . ']', $products['products_id'], true, 'onclick="checkBox(\'products[' . $counter . ']\')"'); ?> <br />
    <br />
    </div>
<?php
        $counter++;
      }
    } else {
?>
   <?php echo NOTIFICATIONS_NON_EXISTING; ?> <br />
<?php
    }
?>
   </div> <br />
<?php
  }
?>
</div>

<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
  </form>