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
class proxy
{
    public $default = '';
    public $title;
    public $description;
    public $sort_order = 400;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_proxy_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_proxy_desc');
    }

    public function getSetField()
    {
        $input = tep_draw_input_field('proxy', OSCOM_APP_PAYPAL_BRAINTREE_PROXY, 'id="inputProxy"');

        return <<<EOT
<div>
  <p>
    <label for="inputProxy">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;
    }
}
