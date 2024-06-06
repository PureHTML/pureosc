<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2021 osCommerce

  Released under the GNU General Public License
*/

class OSCOM_Braintree_CC_Cfg_sort_order {
  public $default = '0';
  public $title;
  public $description;
  public $app_configured = false;

  public function __construct() {
    global $OSCOM_Braintree;

    $this->title = $OSCOM_Braintree->getDef('cfg_cc_sort_order_title');
    $this->description = $OSCOM_Braintree->getDef('cfg_cc_sort_order_desc');
  }

  public function getSetField() {
    $input = tep_draw_input_field('sort_order', OSCOM_APP_PAYPAL_BRAINTREE_CC_SORT_ORDER, 'id="inputCcSortOrder"');

    $result = <<<EOT
<div>
  <p>
    <label for="inputCcSortOrder">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;

    return $result;
  }
}
