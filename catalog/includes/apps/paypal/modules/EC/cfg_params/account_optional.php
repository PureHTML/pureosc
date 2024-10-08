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
class account_optional
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 300;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ec_account_optional_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ec_account_optional_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="accountOptionalSelectionTrue" name="account_optional" value="1"'.(OSCOM_APP_PAYPAL_EC_ACCOUNT_OPTIONAL === '1' ? ' checked="checked"' : '').'><label for="accountOptionalSelectionTrue">'.$OSCOM_PayPal->getDef('cfg_ec_account_optional_true').'</label>'.
                 '<input type="radio" id="accountOptionalSelectionFalse" name="account_optional" value="0"'.(OSCOM_APP_PAYPAL_EC_ACCOUNT_OPTIONAL === '0' ? ' checked="checked"' : '').'><label for="accountOptionalSelectionFalse">'.$OSCOM_PayPal->getDef('cfg_ec_account_optional_false').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="accountOptionalSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#accountOptionalSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
