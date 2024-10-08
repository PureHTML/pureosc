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
class paypal_button_size
{
    public $default = '2';
    public $title;
    public $description;
    public $sort_order = 161;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_paypal_button_size_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_paypal_button_size_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="paypalButtonSizeSelectionSmall" name="paypal_button_size" value="2"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SIZE === '2' ? ' checked="checked"' : '').'><label for="paypalButtonSizeSelectionSmall">'.$OSCOM_Braintree->getDef('cfg_cc_paypal_button_size_small').'</label>'.
                 '<input type="radio" id="paypalButtonSizeSelectionTiny" name="paypal_button_size" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SIZE === '1' ? ' checked="checked"' : '').'><label for="paypalButtonSizeSelectionTiny">'.$OSCOM_Braintree->getDef('cfg_cc_paypal_button_size_tiny').'</label>'.
                 '<input type="radio" id="paypalButtonSizeSelectionMedium" name="paypal_button_size" value="3"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SIZE === '3' ? ' checked="checked"' : '').'><label for="paypalButtonSizeSelectionMedium">'.$OSCOM_Braintree->getDef('cfg_cc_paypal_button_size_medium').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="paypalButtonSizeSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#paypalButtonSizeSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
