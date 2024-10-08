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
class sandbox_client_id
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 400;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_login_sandbox_client_id_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_login_sandbox_client_id_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('sandbox_client_id', OSCOM_APP_PAYPAL_LOGIN_SANDBOX_CLIENT_ID, 'id="inputLogInSandboxClientId"');

        return <<<EOT
<div>
  <p>
    <label for="inputLogInSandboxClientId">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
