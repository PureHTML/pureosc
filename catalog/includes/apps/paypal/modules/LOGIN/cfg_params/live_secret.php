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

class live_secret
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 300;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_login_live_secret_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_login_live_secret_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('live_secret', OSCOM_APP_PAYPAL_LOGIN_LIVE_SECRET, 'id="inputLogInLiveSecret"');

        return <<<EOT
<div>
  <p>
    <label for="inputLogInLiveSecret">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
