<?php
//ICW ADDED FOR ORDER_TOTAL CREDIT SYSTEM - Start Addition
  $gv_query=tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id='".$customer_id."'");
  if ($gv_result=tep_db_fetch_array($gv_query)) {
    if ($gv_result['amount'] > 0) {
?>
    <?php echo GV_HAS_VOUCHERA; echo tep_href_link(FILENAME_GV_SEND); echo GV_HAS_VOUCHERB; ?>
<?php
}}
//ICW ADDED FOR ORDER_TOTAL CREDIT SYSTEM - End Addition
?>