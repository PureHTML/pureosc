<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_specials.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<?php
  if ($_GET['action'] == 'process') {
?>
 <?php echo tep_image_2ma_template(bts_select(images, 'table_background_man_on_board.png'), HEADING_TITLE, '0', '0', '') . '<br /><br />' . TEXT_SUCCESS; ?><br /><br /><?php echo 'GV CODE : - '.$id1 . ' -' ; ?>
<br /><br />
<div class="CinquantaL">
<a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE); ?></a>
</div>
<?php
  }  
  if ($_GET['action'] == 'send' && !$error) {
    // validate entries
      $gv_amount = (double) $gv_amount;
      $gv_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
      $gv_result = tep_db_fetch_array($gv_query);
      $send_name = $gv_result['customers_firstname'] . ' ' . $gv_result['customers_lastname'];
?>
    <form action="<?php echo tep_href_link(FILENAME_GV_SEND, 'action=process', 'NONSSL'); ?>" method="post">
    <?php echo sprintf(MAIN_MESSAGE, $currencies->format($_POST['amount']), stripslashes($_POST['to_name']), $_POST['email'], stripslashes($_POST['to_name']), $currencies->format($_POST['amount']), $send_name); ?>
<?php
      if ($_POST['message']) {
?>
    <?php echo sprintf(PERSONAL_MESSAGE, $gv_result['customers_firstname']); ?>
    <?php echo stripslashes($_POST['message']); ?>
<?php
      }
      echo tep_draw_hidden_field('send_name', $send_name) . tep_draw_hidden_field('to_name', stripslashes($_POST['to_name'])) . tep_draw_hidden_field('email', $_POST['email']) . tep_draw_hidden_field('amount', $gv_amount) . tep_draw_hidden_field('message', stripslashes($_POST['message']));
?>
<br />

<div class="CinquantaL">
    <?php echo tep_image_submit('button_back.png', IMAGE_BUTTON_BACK, 'name=back') ; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_send.png', IMAGE_BUTTON_CONTINUE); ?>
</div>
</form>
<?php
  } elseif ($_GET['action']=='' || $error) {
?>

    <p><?php echo HEADING_TEXT; ?></p>
    <form action="<?php echo tep_href_link(FILENAME_GV_SEND, 'action=send', 'NONSSL'); ?>" method="post">
<div class="InfoBoxContenent2MA">    
    <div class="AlignLeft"> 
    <?php echo tep_draw_input_field_label(ENTRY_NAME, false, 'to_name', stripslashes($_POST['to_name']));?>
    <br />
    <?php echo tep_draw_input_field_label(ENTRY_EMAIL, false, 'email', $_POST['email']); if (($error) && tep_not_null($error_email)) echo '<span class="ColorRed">' . $error_email . '</span>'; ?> 
    <br />
    <?php echo tep_draw_input_field_label(ENTRY_AMOUNT . ' ' . $currencies->format(0), false, 'amount', $_POST['amount'], '', '', false); if (($error) && tep_not_null($error_amount)) echo '<span class="ColorRed">' . $error_amount . '</span>'; ?> 
    <br />
    <?php echo ENTRY_MESSAGE; ?><br /><?php echo tep_draw_textarea_field('message', 'soft', '10', stripslashes($_POST['message'])); ?> <br />
</div>
<?php
    $back = sizeof($navigation->path)-2;
?>
</div><br />
<div class="CinquantaL">
    <?php echo tep_image_submit('button_back.png', IMAGE_BUTTON_BACK, 'name=back') ; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_send.png', IMAGE_BUTTON_CONTINUE); ?>
</div>
</form>
<?php
  }
?>