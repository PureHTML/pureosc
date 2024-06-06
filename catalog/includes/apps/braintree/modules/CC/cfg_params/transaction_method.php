<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2021 osCommerce

  Released under the GNU General Public License
*/

class OSCOM_Braintree_CC_Cfg_transaction_method {
  public $default = '1';
  public $title;
  public $description;
  public $sort_order = 400;

  public function __construct() {
    global $OSCOM_Braintree;

    $this->title = $OSCOM_Braintree->getDef('cfg_cc_transaction_method_title');
    $this->description = $OSCOM_Braintree->getDef('cfg_cc_transaction_method_desc');
  }

  public function getSetField() {
    global $OSCOM_Braintree;

    $input = '<input type="radio" id="transactionMethodSelectionAuthorize" name="transaction_method" value="0"' . (OSCOM_APP_PAYPAL_BRAINTREE_CC_TRANSACTION_METHOD == '0' ? ' checked="checked"' : '') . '><label for="transactionMethodSelectionAuthorize">' . $OSCOM_Braintree->getDef('cfg_cc_transaction_method_authorize') . '</label>' .
             '<input type="radio" id="transactionMethodSelectionPayment" name="transaction_method" value="1"' . (OSCOM_APP_PAYPAL_BRAINTREE_CC_TRANSACTION_METHOD == '1' ? ' checked="checked"' : '') . '><label for="transactionMethodSelectionPayment">' . $OSCOM_Braintree->getDef('cfg_cc_transaction_method_payment') . '</label>';

    $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="transactionMethodSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#transactionMethodSelection').buttonset();
});
</script>
EOT;

    return $result;
  }
}
