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

class incontext_button_shape
{
    public $default = '1';
    public $title;
    public $description;
    public $sort_order = 230;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ec_incontext_button_shape_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ec_incontext_button_shape_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="incontextButtonShapePill" name="incontext_button_shape" value="1"'.(OSCOM_APP_PAYPAL_EC_INCONTEXT_BUTTON_SHAPE === '1' ? ' checked="checked"' : '').'><label for="incontextButtonShapePill">'.$OSCOM_PayPal->getDef('cfg_ec_incontext_button_shape_pill').'</label>'.
                 '<input type="radio" id="incontextButtonShapeRect" name="incontext_button_shape" value="2"'.(OSCOM_APP_PAYPAL_EC_INCONTEXT_BUTTON_SHAPE === '2' ? ' checked="checked"' : '').'><label for="incontextButtonShapeRect">'.$OSCOM_PayPal->getDef('cfg_ec_incontext_button_shape_rect').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="incontextButtonShapeSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#incontextButtonShapeSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
