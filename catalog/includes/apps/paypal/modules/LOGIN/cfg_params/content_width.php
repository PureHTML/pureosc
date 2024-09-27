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

class content_width
{
    public $default = 'Full';
    public $title;
    public $description;
    public $app_configured = false;
    public $set_func = 'tep_cfg_select_option(array(\'Full\', \'Half\'), ';

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_login_content_width_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_login_content_width_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="contentWidthSelectionHalf" name="content_width" value="Half"'.(OSCOM_APP_PAYPAL_LOGIN_CONTENT_WIDTH === 'Half' ? ' checked="checked"' : '').'><label for="contentWidthSelectionHalf">'.$OSCOM_PayPal->getDef('cfg_login_content_width_half').'</label>'.
                 '<input type="radio" id="contentWidthSelectionFull" name="content_width" value="Full"'.(OSCOM_APP_PAYPAL_LOGIN_CONTENT_WIDTH === 'Full' ? ' checked="checked"' : '').'><label for="contentWidthSelectionFull">'.$OSCOM_PayPal->getDef('cfg_login_content_width_full').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="contentWidthSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#contentWidthSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
