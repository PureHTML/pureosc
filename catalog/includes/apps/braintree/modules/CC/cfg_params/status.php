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
class status
{
    public $default = '-1';
    public $title;
    public $description;
    public $sort_order = 100;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_status_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_status_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="statusSelectionLive" name="status" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS === '1' ? ' checked="checked"' : '').'><label for="statusSelectionLive">'.$OSCOM_Braintree->getDef('cfg_cc_status_live').'</label>'.
                 '<input type="radio" id="statusSelectionSandbox" name="status" value="0"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS === '0' ? ' checked="checked"' : '').'><label for="statusSelectionSandbox">'.$OSCOM_Braintree->getDef('cfg_cc_status_sandbox').'</label>'.
                 '<input type="radio" id="statusSelectionDisabled" name="status" value="-1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS === '-1' ? ' checked="checked"' : '').'><label for="statusSelectionDisabled">'.$OSCOM_Braintree->getDef('cfg_cc_status_disabled').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="statusSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#statusSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
