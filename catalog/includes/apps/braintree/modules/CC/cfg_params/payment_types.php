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

class payment_types
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 140;
    public $types;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_payment_types_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_payment_types_desc');

        $this->types = [
            'paypal' => 'PayPal',
        ];
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $active = explode(';', OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYMENT_TYPES);

        $input = '';

        foreach ($this->types as $key => $value) {
            $input .= '<input type="checkbox" id="paymentTypesFormSelection'.$key.'" name="payment_types_cb" value="'.$key.'"'.(\in_array($key, $active, true) ? ' checked="checked"' : '').'><label for="paymentTypesFormSelection'.$key.'">'.$value.'</label>';
        }

        $input .= '<input type="hidden" name="payment_types" value="">';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="paymentTypesFormSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#paymentTypesFormSelection').buttonset();

  $('#paymentTypesFormSelection input').closest('form').submit(function() {
    $('#paymentTypesFormSelection input[name="payment_types"]').val($('input[name="payment_types_cb"]:checked').map(function() {
      return this.value;
    }).get().join(';'));
  });
});
</script>
EOT;

        return $result;
    }
}
