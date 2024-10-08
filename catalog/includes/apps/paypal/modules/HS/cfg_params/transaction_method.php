<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class transaction_method
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 200;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_hs_transaction_method_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_hs_transaction_method_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="transactionMethodSelectionAuthorize" name="transaction_method" value="0"'.(OSCOM_APP_PAYPAL_HS_TRANSACTION_METHOD === '0' ? ' checked="checked"' : '').'><label for="transactionMethodSelectionAuthorize">'.$OSCOM_PayPal->getDef('cfg_hs_transaction_method_authorize').'</label>'.
                 '<input type="radio" id="transactionMethodSelectionSale" name="transaction_method" value="1"'.(OSCOM_APP_PAYPAL_HS_TRANSACTION_METHOD === '1' ? ' checked="checked"' : '').'><label for="transactionMethodSelectionSale">'.$OSCOM_PayPal->getDef('cfg_hs_transaction_method_sale').'</label>';

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
