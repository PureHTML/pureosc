<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
class ewp_private_key
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 800;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_ewp_private_key_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_ewp_private_key_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('ewp_private_key', OSCOM_APP_PAYPAL_PS_EWP_PRIVATE_KEY, 'id="inputPsEwpPrivateKey"');

        return <<<EOT
<div>
  <p>
    <label for="inputPsEwpPrivateKey">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
