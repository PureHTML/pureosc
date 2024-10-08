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
class verify_ssl
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 300;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_verify_ssl_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_verify_ssl_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="verifySslSelectionTrue" name="verify_ssl" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_VERIFY_SSL === '1' ? ' checked="checked"' : '').'><label for="verifySslSelectionTrue">'.$OSCOM_Braintree->getDef('cfg_verify_ssl_true').'</label>'.
                 '<input type="radio" id="verifySslSelectionFalse" name="verify_ssl" value="0"'.(OSCOM_APP_PAYPAL_BRAINTREE_VERIFY_SSL === '0' ? ' checked="checked"' : '').'><label for="verifySslSelectionFalse">'.$OSCOM_Braintree->getDef('cfg_verify_ssl_false').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="verifySslSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#verifySslSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
