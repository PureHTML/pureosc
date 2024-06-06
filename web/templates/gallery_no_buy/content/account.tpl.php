 <h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?> </h1><br />
<div class="AlignLeft">  
<?php
  if ($messageStack->size('account') > 0) {
?>
  <?php echo $messageStack->output('account'); ?><br />
<?php
  }
?>

  <h2 class="b">
  <?php echo tep_image_2ma(bts_select(images, 'account_personal.png')); ?>
  <?php echo MY_ACCOUNT_TITLE; ?></h2><br />
    <div class="InfoBoxContenent2MA">
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?> <br />
            <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '?subject= ' . EMAIL_ACCOUNT_DELETE . '&body= ' . EMAIL_ACCOUNT_DELETE_BODY . '">' . MY_ACCOUNT_DELETE . '</a>'; ?> <br />
    </div><br />
  <h2 class="b">
  <?php echo tep_image_2ma(bts_select(images, 'account_notifications.png')); ?>
  <?php echo EMAIL_NOTIFICATIONS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?>
  </div>
</div>