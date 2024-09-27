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

class log_transactions
{
    public $default = '1';
    public $sort_order = 500;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_log_transactions_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_log_transactions_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="logTransactionsSelectionAll" name="log_transactions" value="1"'.(OSCOM_APP_PAYPAL_LOG_TRANSACTIONS === '1' ? ' checked="checked"' : '').'><label for="logTransactionsSelectionAll">'.$OSCOM_PayPal->getDef('cfg_log_transactions_all').'</label>'.
                 '<input type="radio" id="logTransactionsSelectionErrors" name="log_transactions" value="0"'.(OSCOM_APP_PAYPAL_LOG_TRANSACTIONS === '0' ? ' checked="checked"' : '').'><label for="logTransactionsSelectionErrors">'.$OSCOM_PayPal->getDef('cfg_log_transactions_errors').'</label>'.
                 '<input type="radio" id="logTransactionsSelectionDisabled" name="log_transactions" value="-1"'.(OSCOM_APP_PAYPAL_LOG_TRANSACTIONS === '-1' ? ' checked="checked"' : '').'><label for="logTransactionsSelectionDisabled">'.$OSCOM_PayPal->getDef('cfg_log_transactions_disabled').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="logSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#logSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
