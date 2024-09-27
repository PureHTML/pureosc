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

class ewp_status
{
    public $default = '-1';
    public $title;
    public $description;
    public $sort_order = 700;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_ewp_status_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_ewp_status_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="ewpStatusSelectionTrue" name="ewp_status" value="1"'.(OSCOM_APP_PAYPAL_PS_EWP_STATUS === '1' ? ' checked="checked"' : '').'><label for="ewpStatusSelectionTrue">'.$OSCOM_PayPal->getDef('cfg_ps_ewp_status_true').'</label>'.
                 '<input type="radio" id="ewpStatusSelectionFalse" name="ewp_status" value="-1"'.(OSCOM_APP_PAYPAL_PS_EWP_STATUS === '-1' ? ' checked="checked"' : '').'><label for="ewpStatusSelectionFalse">'.$OSCOM_PayPal->getDef('cfg_ps_ewp_status_false').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="ewpStatusSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#ewpStatusSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
