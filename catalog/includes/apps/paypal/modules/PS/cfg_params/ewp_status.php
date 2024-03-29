<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

class OSCOM_PayPal_PS_Cfg_ewp_status {
  public $default = '-1';
  public $title;
  public $description;
  public $sort_order = 700;

  public function __construct() {
    global $OSCOM_PayPal;

    $this->title = $OSCOM_PayPal->getDef('cfg_ps_ewp_status_title');
    $this->description = $OSCOM_PayPal->getDef('cfg_ps_ewp_status_desc');
  }

  public function getSetField() {
    global $OSCOM_PayPal;

    $input = '<input type="radio" id="ewpStatusSelectionTrue" name="ewp_status" value="1"' . (OSCOM_APP_PAYPAL_PS_EWP_STATUS == '1' ? ' checked="checked"' : '') . '><label for="ewpStatusSelectionTrue">' . $OSCOM_PayPal->getDef('cfg_ps_ewp_status_true') . '</label>' .
             '<input type="radio" id="ewpStatusSelectionFalse" name="ewp_status" value="-1"' . (OSCOM_APP_PAYPAL_PS_EWP_STATUS == '-1' ? ' checked="checked"' : '') . '><label for="ewpStatusSelectionFalse">' . $OSCOM_PayPal->getDef('cfg_ps_ewp_status_false') . '</label>';

    $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="ewpStatusSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#ewpStatusSelection').buttonset();
});
</script>
EOT;

    return $result;
  }
}
