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

class transaction_method
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 400;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_transaction_method_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_transaction_method_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="transactionMethodSelectionAuthorize" name="transaction_method" value="0"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_TRANSACTION_METHOD === '0' ? ' checked="checked"' : '').'><label for="transactionMethodSelectionAuthorize">'.$OSCOM_Braintree->getDef('cfg_cc_transaction_method_authorize').'</label>'.
                 '<input type="radio" id="transactionMethodSelectionPayment" name="transaction_method" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_TRANSACTION_METHOD === '1' ? ' checked="checked"' : '').'><label for="transactionMethodSelectionPayment">'.$OSCOM_Braintree->getDef('cfg_cc_transaction_method_payment').'</label>';

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
