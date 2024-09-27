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

class ewp_openssl
{
    public $default = '/usr/bin/openssl';
    public $title;
    public $description;
    public $sort_order = 1300;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_ewp_openssl_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_ewp_openssl_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('ewp_openssl', OSCOM_APP_PAYPAL_PS_EWP_OPENSSL, 'id="inputPsEwpOpenSsl"');

        return <<<EOT
<div>
  <p>
    <label for="inputPsEwpOpenSsl">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
