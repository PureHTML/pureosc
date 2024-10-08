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
class sort_order
{
    public $default = '0';
    public $title;
    public $description;
    public $app_configured = false;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_login_sort_order_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_login_sort_order_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('sort_order', OSCOM_APP_PAYPAL_LOGIN_SORT_ORDER, 'id="inputLogInSortOrder"');

        return <<<EOT
<div>
  <p>
    <label for="inputLogInSortOrder">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
