<?php echo tep_draw_form('checkout_address', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_delivery.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br /> 
<div class="AlignLeft">
  <h2 class="b"><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php echo TEXT_CHOOSE_SHIPPING_DESTINATION . '<br /><br /><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.png', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a> <br />'; ?>
  <br /> <?php echo '<span class="b">' . TITLE_SHIPPING_ADDRESS . '</span><br />' . tep_image_2ma(bts_select(images, 'arrow_south_east.png')); ?>
  <?php echo tep_address_label($customer_id, $sendto, true, ' ', ' - '); ?>
  </div> <br />
<?php
  if (tep_count_shipping_modules() > 0) {
?>
  <h2 class="b"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
                <?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?> <br />
                <?php echo '<span class="b">' . TITLE_PLEASE_SELECT . '</span>' . tep_image_2ma(bts_select(images, 'arrow_east_south.png')); ?> <br />
<?php
    } elseif ($free_shipping == false) {
?>
                <?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?> <br />
<?php
    }

    if ($free_shipping == true) {
?>
                <span class="b"><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;</span><?php echo $quotes[$i]['icon']; ?> <br />
                <span id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, 0)">
                  <?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?> <br />
                </span>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
                    <span class="b"><?php echo $quotes[$i]['module']; ?>&nbsp;</span><?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?> <br />
<?php
        if (isset($quotes[$i]['error'])) {
?>
                    <?php echo $quotes[$i]['error']; ?> <br />
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '                  <span id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            } else {
              echo '                  <span class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            }
?>
                    <?php echo $quotes[$i]['methods'][$j]['title']; ?> <br />
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
                    <?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?> 
                    <?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?> <br />
<?php
            } else {
?>
                    <?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?> <br />
<?php
            }
?>
                  </span>
<?php
            $radio_buttons++;
          }
        }
?>
<?php
      }
    }
?>
  </div>
<?php
  }
?>
  <h2 class="b"><?php echo TABLE_HEADING_COMMENTS; ?></h2> 
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_textarea_field('comments', '60', '5'); ?>
  </div><br />
  <?php echo '<span class="b">' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . ' ' . TEXT_CONTINUE_CHECKOUT_PROCEDURE . '</span>'; ?>
<br /><br />
     <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
<br />
</div>  
  <br />
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <span class="checkoutBarCurrent">
  <?php echo tep_image_2ma(DIR_WS_IMAGES . 'checkout_bullet.png') . ' '; ?>
  <?php echo CHECKOUT_BAR_DELIVERY . '  -  '; ?></span>
  <span class="checkoutBarTo">  
  <?php echo CHECKOUT_BAR_PAYMENT . '  -  '; ?>
  <?php echo CHECKOUT_BAR_CONFIRMATION . '  -  '; ?>
  <?php echo CHECKOUT_BAR_FINISHED; ?> </span>
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); 
?></form>