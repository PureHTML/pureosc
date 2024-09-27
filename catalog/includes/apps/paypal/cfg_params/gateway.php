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

class gateway
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 100;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_gateway_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_gateway_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="gatewaySelectionPayPal" name="gateway" value="1"'.(OSCOM_APP_PAYPAL_GATEWAY === '1' ? ' checked="checked"' : '').'><label for="gatewaySelectionPayPal">'.$OSCOM_PayPal->getDef('cfg_gateway_paypal').'</label>'.
                 '<input type="radio" id="gatewaySelectionPayflow" name="gateway" value="0"'.(OSCOM_APP_PAYPAL_GATEWAY === '0' ? ' checked="checked"' : '').'><label for="gatewaySelectionPayflow">'.$OSCOM_PayPal->getDef('cfg_gateway_payflow').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="gatewaySelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#gatewaySelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
