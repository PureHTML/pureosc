<?php if (!isset($_GET['delete'])) echo tep_draw_form('addressbook', tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return check_form(addressbook);"'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_address_book.png'), (isset($_GET['edit']) ? HEADING_TITLE_MODIFY_ENTRY : HEADING_TITLE_ADD_ENTRY), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php if (isset($_GET['edit'])) { echo HEADING_TITLE_MODIFY_ENTRY; } elseif (isset($_GET['delete'])) { echo HEADING_TITLE_DELETE_ENTRY; } else { echo HEADING_TITLE_ADD_ENTRY; } ?>
</h1> <br />
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
  <?php echo $messageStack->output('addressbook'); ?>
<?php
  }
?> 
<div class="AlignLeft"> 
<?php
  if (isset($_GET['delete'])) {
?>

  <h2 class="b"><?php echo DELETE_ADDRESS_TITLE; ?></h2>
  <div class="InfoBoxContenet2MA">
    <?php echo DELETE_ADDRESS_DESCRIPTION; ?> <br />
    <span class="b"><?php echo SELECTED_ADDRESS; ?></span><br />
    <?php echo tep_image_2ma(bts_select(images, 'arrow_south_east.png')); ?> <br />
    <?php echo tep_address_label($customer_id, $_GET['delete'], true, ' ', '<br />'); ?> <br />
  </div><br />
  
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . SEPARATOR_LINK . 'action=deleteconfirm', 'SSL') . '">' . tep_image_button('button_delete.png', IMAGE_BUTTON_DELETE) . '</a>'; ?>
</div>
  
<?php
  } else {
?>
   <br /> <?php include(DIR_WS_MODULES . 'address_book_details.php'); ?>
<?php
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
?>

<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_draw_hidden_field('action', 'update') . tep_draw_hidden_field('edit', $_GET['edit']) . tep_image_submit('button_update.png', IMAGE_BUTTON_UPDATE, 'id="update"'); ?>
</div>

<?php
    } else {
      if (sizeof($navigation->snapshot) > 0) {
        $back_link = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
      } else {
        $back_link = tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL');
      }
?>

<div class="CinquantaL">
    <?php echo '<a href="' . $back_link . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_draw_hidden_field('action', 'process') . tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>

<?php
    }
  }
?>
</div>
  <?php if (!isset($_GET['delete'])) echo '</form>'; ?>