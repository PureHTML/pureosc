<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class checkout_flow
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 200;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ec_checkout_flow_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ec_checkout_flow_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="checkoutFlowSelectionInContext" name="checkout_flow" value="1"'.(OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '1' ? ' checked="checked"' : '').'><label for="checkoutFlowSelectionInContext">'.$OSCOM_PayPal->getDef('cfg_ec_checkout_flow_in_context').'</label>'.
                 '<input type="radio" id="checkoutFlowSelectionDefault" name="checkout_flow" value="0"'.(OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '0' ? ' checked="checked"' : '').'><label for="checkoutFlowSelectionDefault">'.$OSCOM_PayPal->getDef('cfg_ec_checkout_flow_default').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="checkoutFlowSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#checkoutFlowSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
