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
class checkout_image
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 500;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ec_checkout_image_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ec_checkout_image_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="checkoutImageSelectionStatic" name="checkout_image" value="0"'.(OSCOM_APP_PAYPAL_EC_CHECKOUT_IMAGE === '0' ? ' checked="checked"' : '').'><label for="checkoutImageSelectionStatic">'.$OSCOM_PayPal->getDef('cfg_ec_checkout_image_static').'</label>'.
                 '<input type="radio" id="checkoutImageSelectionDynamic" name="checkout_image" value="1"'.(OSCOM_APP_PAYPAL_EC_CHECKOUT_IMAGE === '1' ? ' checked="checked"' : '').'><label for="checkoutImageSelectionDynamic">'.$OSCOM_PayPal->getDef('cfg_ec_checkout_image_dynamic').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="checkoutImageSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#checkoutImageSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
