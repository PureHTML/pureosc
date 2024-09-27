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

class instant_update
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 400;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ec_instant_update_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ec_instant_update_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="instantUpdateSelectionEnabled" name="instant_update" value="1"'.(OSCOM_APP_PAYPAL_EC_INSTANT_UPDATE === '1' ? ' checked="checked"' : '').'><label for="instantUpdateSelectionEnabled">'.$OSCOM_PayPal->getDef('cfg_ec_instant_update_enabled').'</label>'.
                 '<input type="radio" id="instantUpdateSelectionDisabled" name="instant_update" value="0"'.(OSCOM_APP_PAYPAL_EC_INSTANT_UPDATE === '0' ? ' checked="checked"' : '').'><label for="instantUpdateSelectionDisabled">'.$OSCOM_PayPal->getDef('cfg_ec_instant_update_disabled').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="instantUpdateSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#instantUpdateSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
