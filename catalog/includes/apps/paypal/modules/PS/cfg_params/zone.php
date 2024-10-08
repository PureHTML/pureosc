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
class zone
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 600;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_ps_zone_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_ps_zone_desc');
    }

    public function getSetField()
    {
        global $OSCOM_PayPal;

        $zone_class_array = [['id' => '0', 'text' => $OSCOM_PayPal->getDef('cfg_ps_zone_global')]];

        $zone_class_query = tep_db_query('SELECT geo_zone_id, geo_zone_name FROM geo_zones ORDER BY geo_zone_name');

        while ($zone_class = tep_db_fetch_array($zone_class_query)) {
            $zone_class_array[] = ['id' => $zone_class['geo_zone_id'],
                'text' => $zone_class['geo_zone_name']];
        }

        $input = tep_draw_pull_down_menu('zone', $zone_class_array, OSCOM_APP_PAYPAL_PS_ZONE, 'id="inputPsZone"');

        $result = <<<EOT
<div>
  <p>
    <label for="inputPsZone">{$this->title}</label>

    {$this->description}
  </p>

  <div>
    {$input}
  </div>
</div>
EOT;

        return $result;
    }
}
