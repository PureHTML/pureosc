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

class paypal_button_shape
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 162;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_paypal_button_shape_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_paypal_button_shape_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="paypalButtonShapeSelectionPill" name="paypal_button_shape" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SHAPE === '1' ? ' checked="checked"' : '').'><label for="paypalButtonShapeSelectionPill">'.$OSCOM_Braintree->getDef('cfg_cc_paypal_button_shape_pill').'</label>'.
                 '<input type="radio" id="paypalButtonShapeSelectionRect" name="paypal_button_shape" value="2"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SHAPE === '2' ? ' checked="checked"' : '').'><label for="paypalButtonShapeSelectionRect">'.$OSCOM_Braintree->getDef('cfg_cc_paypal_button_shape_rect').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="paypalButtonShapeSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#paypalButtonShapeSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
