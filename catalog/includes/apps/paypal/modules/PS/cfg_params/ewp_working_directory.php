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
class ewp_working_directory
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 1200;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_ewp_working_directory_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_ewp_working_directory_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('ewp_working_directory', OSCOM_APP_PAYPAL_PS_EWP_WORKING_DIRECTORY, 'id="inputPsEwpWorkingDirectory"');

        return <<<EOT
<div>
  <p>
    <label for="inputPsEwpWorkingDirectory">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
