<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2021 osCommerce

  Released under the GNU General Public License
*/

class OSCOM_Braintree_CC_Cfg_verify_cvv {
  public $default = '1';
  public $title;
  public $description;
  public $sort_order = 300;

  public function __construct() {
    global $OSCOM_Braintree;

    $this->title = $OSCOM_Braintree->getDef('cfg_cc_verify_cvv_title');
    $this->description = $OSCOM_Braintree->getDef('cfg_cc_verify_cvv_desc');
  }

  public function getSetField() {
    global $OSCOM_Braintree;

    $input = '<input type="radio" id="verifyCvvSelectionAll" name="verify_cvv" value="1"' . (OSCOM_APP_PAYPAL_BRAINTREE_CC_VERIFY_CVV == '1' ? ' checked="checked"' : '') . '><label for="verifyCvvSelectionAll">' . $OSCOM_Braintree->getDef('cfg_cc_verify_cvv_all_cards') . '</label>' .
             '<input type="radio" id="verifyCvvSelectionNew" name="verify_cvv" value="2"' . (OSCOM_APP_PAYPAL_BRAINTREE_CC_VERIFY_CVV == '2' ? ' checked="checked"' : '') . '><label for="verifyCvvSelectionNew">' . $OSCOM_Braintree->getDef('cfg_cc_verify_cvv_new_cards') . '</label>' .
             '<input type="radio" id="verifyCvvSelectionDisabled" name="verify_cvv" value="0"' . (OSCOM_APP_PAYPAL_BRAINTREE_CC_VERIFY_CVV == '0' ? ' checked="checked"' : '') . '><label for="verifyCvvSelectionDisabled">' . $OSCOM_Braintree->getDef('cfg_cc_verify_cvv_disabled') . '</label>';

    $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="verifyCvvSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#verifyCvvSelection').buttonset();
});
</script>
EOT;

    return $result;
  }
}
