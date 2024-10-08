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
class entry_form
{
    public $default = '3';
    public $title;
    public $description;
    public $sort_order = 130;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_entry_form_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_entry_form_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="entryFormSelectionHostedFields" name="entry_form" value="3"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_ENTRY_FORM === '3' ? ' checked="checked"' : '').'><label for="entryFormSelectionHostedFields">'.$OSCOM_Braintree->getDef('cfg_cc_entry_form_hosted_fields').'</label>'.
                 '<input type="radio" id="entryFormSelectionDropIn" name="entry_form" value="2"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_ENTRY_FORM === '2' ? ' checked="checked"' : '').'><label for="entryFormSelectionDropIn">'.$OSCOM_Braintree->getDef('cfg_cc_entry_form_dropin').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="entryFormSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#entryFormSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
