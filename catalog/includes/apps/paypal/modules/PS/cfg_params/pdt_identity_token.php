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

class pdt_identity_token
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 650;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_pdt_identity_token_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_pdt_identity_token_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('pdt_identity_token', OSCOM_APP_PAYPAL_PS_PDT_IDENTITY_TOKEN, 'id="inputPsPdtIdentityToken"');

        return <<<EOT
<div>
  <p>
    <label for="inputPsPdtIdentityToken">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
