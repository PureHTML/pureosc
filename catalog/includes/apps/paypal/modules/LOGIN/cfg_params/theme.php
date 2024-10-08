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
class theme
{
    public $default = 'Blue';
    public $title;
    public $description;
    public $sort_order = 600;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_login_theme_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_login_theme_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $input = '<input type="radio" id="themeSelectionBlue" name="theme" value="Blue"'.(OSCOM_APP_PAYPAL_LOGIN_THEME === 'Blue' ? ' checked="checked"' : '').'><label for="themeSelectionBlue">'.$OSCOM_PayPal->getDef('cfg_login_theme_blue').'</label>'.
                 '<input type="radio" id="themeSelectionNeutral" name="theme" value="Neutral"'.(OSCOM_APP_PAYPAL_LOGIN_THEME === 'Neutral' ? ' checked="checked"' : '').'><label for="themeSelectionNeutral">'.$OSCOM_PayPal->getDef('cfg_login_theme_neutral').'</label>';

        $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}
  </p>

  <div id="themeSelection">
    {$input}
  </div>
</div>

<script>
$(function() {
  $('#themeSelection').buttonset();
});
</script>
EOT;

        return $result;
    }
}
