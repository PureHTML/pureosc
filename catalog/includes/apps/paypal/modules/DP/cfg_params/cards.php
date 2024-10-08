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
class cards
{
    public $default = 'visa;mastercard;discover;amex;maestro';
    public $title;
    public $description;
    public $sort_order = 200;
    public $cards = ['visa' => 'Visa', 'mastercard' => 'MasterCard', 'discover' => 'Discover Card', 'amex' => 'American Express', 'maestro' => 'Maestro'];

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_dp_cards_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_dp_cards_desc');
    }

    public function getSetField()
    {
        $active = explode(';', OSCOM_APP_PAYPAL_DP_CARDS);

        $input = '';

        foreach ($this->cards as $key => $value) {
            $input .= '<input type="checkbox" id="cardsSelection'.ucfirst($key).'" name="card_types[]" value="'.$key.'"'.(\in_array($key, $active, true) ? ' checked="checked"' : '').'><label for="cardsSelection'.ucfirst($key).'">'.$value.'</label>';
        }

        return <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="cardsSelection">
    {$input}
    <input type="hidden" name="cards" value="" />
  </div>
</div>

<script>
$(function() {
  $('#cardsSelection').buttonset();

  $('form[name="paypalConfigure"]').submit(function() {
    $('input[name="cards"]').val($('input[name="card_types[]"]:checked').map(function() {
      return this.value;
    }).get().join(';'));
  });
});
</script>
EOT;
    }
}
