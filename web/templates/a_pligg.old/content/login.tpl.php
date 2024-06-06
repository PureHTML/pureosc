<?php //jsp:error rewrite zakomentovana moznost funguje taky
//echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));
echo '<form action="login.php?action=process" method="post" name="login">';
?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_login.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<div class="AlignLeft">
<?php
  if ($messageStack->size('login') > 0) {
?>
  <?php echo $messageStack->output('login'); ?>
<?php
  }
  if ($cart->count_contents() > 0) {
 echo TEXT_VISITORS_CART . '<a class="ColorSpan" href="' . tep_href_link(FILENAME_INFO_SHOPPING_CART, '') . '">' . TEXT_VISITORS_CART2 . '</a><br />' ;
  }
?>
  <h2 class="b"> <?php echo HEADING_RETURNING_CUSTOMER; ?> </h2> 
  <p class="InfoBoxContenent2MA">
    <?php echo tep_draw_input_field_label(ENTRY_EMAIL_ADDRESS, true, 'email_address', ENTRY_EMAIL_ADDRESS); ?> <br />
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD, false, 'password'); ?> <br />
    <?php echo '<a class="ColorSpan" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?> <br /><br />
    <?php echo tep_image_submit('button_login.png', IMAGE_BUTTON_LOGIN, 'id="login_button"'); ?>
  </p>

  <h2 class="b"> <?php echo HEADING_NEW_CUSTOMER; ?> </h2> 
  <p class="InfoBoxContenent2MA">
    <?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?><br /><br />
    <?php echo '<a class="n" href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_REGISTER) . '</a>'; ?>
  </p>
</div>
  </form>