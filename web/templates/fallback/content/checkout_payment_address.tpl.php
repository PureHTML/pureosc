<?php echo tep_draw_form('checkout_address', tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_payment.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<div class="AlignLeft">
<?php
  if ($messageStack->size('checkout_address') > 0) {
?>
  <?php echo $messageStack->output('checkout_address'); ?> <br />
<?php
  }
  if ($process == false) {
?> 
  <h2 class="b"><?php echo TABLE_HEADING_PAYMENT_ADDRESS; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php echo TEXT_SELECTED_PAYMENT_DESTINATION; ?> <br />
  <?php echo '<span class="b">' . TITLE_PAYMENT_ADDRESS . '</span><br />' . tep_image_2ma(bts_select(images, 'arrow_south_east.png')); ?>
  <?php echo tep_address_label($customer_id, $billto, true, ' ', ' - '); ?> <br />
  </div> <br />
<?php
    if ($addresses_count > 1) {
?>
  <h2 class="b"><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></h2><br />
  <div class="InfoBoxContenent2MA">
  <?php echo TEXT_SELECT_OTHER_PAYMENT_DESTINATION; ?> <br />
  <div class="AlignLeft">
  <?php echo '<span class="b">' . TITLE_PLEASE_SELECT . '</span>' . tep_image_2ma(bts_select(images, 'arrow_east_south.png')); ?> <br />
<?php
      $radio_buttons = 0;
      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $customer_id . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);
?>
<?php
       if ($addresses['address_book_id'] == $billto) {
          echo '<span id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        } else {
          echo '<span class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        }
?>
   <?php echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $billto)); ?>
   <span class="b"><?php echo $addresses['firstname'] . ' ' . $addresses['lastname']; ?></span>  &nbsp;-&nbsp; 
                  </span> 
   <?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?> <br />
<?php
        $radio_buttons++;
      }
?>
  </div></div>
<?php
    }
  }
  if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
?>
  <h2 class="b"><?php echo TABLE_HEADING_NEW_PAYMENT_ADDRESS; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php require(DIR_WS_MODULES . 'checkout_new_address.php'); ?>
</div>  
<?php
  }
?>  

<?php echo '<br /><span class="b">' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . ' ' . TEXT_CONTINUE_CHECKOUT_PROCEDURE . '</span><br /><br />'; ?>
<div class="CinquantaL">
  <?php echo tep_draw_hidden_field('action', 'submit') . tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
<?php
  if ($process == true) {
?>
<div class="CinquantaR">
  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?> 
</div>
<?php
  }
?>

  </div><br />
  <br />
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_DELIVERY . '</a>  -  '; ?>
  <span class="checkoutBarCurrent">
  <?php echo tep_image_2ma(DIR_WS_IMAGES . 'checkout_bullet.png') . ' '; ?>
  <?php echo CHECKOUT_BAR_PAYMENT . '  -  '; ?>
  </span>  
  <span class="checkoutBarTo">    
  <?php echo CHECKOUT_BAR_CONFIRMATION . '  -  '; ?> &nbsp;
  <?php echo CHECKOUT_BAR_FINISHED; ?> 
  </span>
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <br />  
</form>
