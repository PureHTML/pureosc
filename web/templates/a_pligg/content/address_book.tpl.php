<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_address_book.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
  <?php echo $messageStack->output('addressbook'); ?> <br />
<?php
  }
?>
<div class="AlignLeft">
  <h2 class="b"><?php echo PRIMARY_ADDRESS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo PRIMARY_ADDRESS_DESCRIPTION; ?> <br />
    <h3 class="b"><?php echo PRIMARY_ADDRESS_TITLE; ?></h3>
    <?php 
    echo tep_image_2ma(bts_select(images, 'arrow_south_east.png'));
    echo tep_address_label($customer_id, $customer_default_address_id, true, ' ', ' - '); 
    ?>
  </div>
  <h2 class="b"><?php echo ADDRESS_BOOK_TITLE; ?></h2>

<?php  //PIVACF start
// $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company,                                     entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname");
   $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_piva as piva, entry_cf as cf, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname");
  //PIVACF end
  
  while ($addresses = tep_db_fetch_array($addresses_query)) {
    $format_id = tep_get_address_format_id($addresses['country_id']);
?>
  <div class="InfoBoxContenent2MA">
  <span class="b"><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></span><?php if ($addresses['address_book_id'] == $customer_default_address_id) echo '&nbsp;' . PRIMARY_ADDRESS; ?> 
  <?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_edit.png', SMALL_IMAGE_BUTTON_EDIT) . '</a> - <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_delete.png', SMALL_IMAGE_BUTTON_DELETE) . '</a>'; ?> <br />
  <?php echo tep_address_format($format_id, $addresses, true, ' ', ' - '); ?>
  </div><br />
<?php
  }
?>
</div> 

<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>
<?php
  if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
?>
<div class="CinquantaR">
    <?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . tep_image_button('button_add_address.png', IMAGE_BUTTON_ADD_ADDRESS) . '</a>'; ?>
</div>
<?php
  }
?>  
    <?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); 
    ?>