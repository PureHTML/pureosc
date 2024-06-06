<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_man_on_board.png'), HEADING_TITLE); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br /> 
<div class="AlignLeft">
<?php echo TEXT_ACCOUNT_CREATED; 
      $customersenable_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'NEW_CUSTOMERS_ENABLED'");
      $customersenable = tep_db_fetch_array($customersenable_query); 
      if ($customersenable['configuration_value']=='true') {
        echo TEXT_ACCOUNT_CREATED_ENABLE;
      } else {
        echo TEXT_ACCOUNT_CREATED_DISABLE;
      }$cust_status = 0;
?> <br /> <br />

  
<!-- Points/Rewards Module V2.00 bof-->
<?php if (NEW_SIGNUP_POINT_AMOUNT > 0) {
?>
    <?php echo sprintf(TEXT_WELCOME_POINTS_TITLE, number_format(NEW_SIGNUP_POINT_AMOUNT,POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(NEW_SIGNUP_POINT_AMOUNT))); ?>.
    <?php echo TEXT_WELCOME_POINTS_LINK; ?>
<?php
   }
?>               
<!-- Points/Rewards Module V2.00 eof-->
<br />
    <?php echo '<a href="' . $origin_href . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
</div>