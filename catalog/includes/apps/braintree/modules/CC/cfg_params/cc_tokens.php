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

class cc_tokens
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 200;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_cc_tokens_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_cc_tokens_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree;

        $input = '<input type="radio" id="ccTokensSelectionAlways" name="cc_tokens" value="2"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_CC_TOKENS === '2' ? ' checked="checked"' : '').'><label for="ccTokensSelectionAlways">'.$OSCOM_Braintree->getDef('cfg_cc_cc_tokens_always').'</label>'.
                 '<input type="radio" id="ccTokensSelectionOptional" name="cc_tokens" value="1"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_CC_TOKENS === '1' ? ' checked="checked"' : '').'><label for="ccTokensSelectionOptional">'.$OSCOM_Braintree->getDef('cfg_cc_cc_tokens_optional').'</label>'.
                 '<input type="radio" id="ccTokensSelectionDisabled" name="cc_tokens" value="0"'.(OSCOM_APP_PAYPAL_BRAINTREE_CC_CC_TOKENS === '0' ? ' checked="checked"' : '').'><label for="ccTokensSelectionDisabled">'.$OSCOM_Braintree->getDef('cfg_cc_cc_tokens_disabled').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="ccTokensSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#ccTokensSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
