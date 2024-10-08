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
class order_status_id
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 500;

    public function __construct()
    {
        global $OSCOM_Braintree;

        $this->title = $OSCOM_Braintree->getDef('cfg_cc_order_status_id_title');
        $this->description = $OSCOM_Braintree->getDef('cfg_cc_order_status_id_desc');
    }

    public function getSetField()
    {
        global $OSCOM_Braintree, $languages_id;

        $statuses_array = [['id' => '0', 'text' => $OSCOM_Braintree->getDef('cfg_cc_order_status_id_default')]];

        $statuses_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' order by orders_status_name");

        while ($statuses = tep_db_fetch_array($statuses_query)) {
            $statuses_array[] = ['id' => $statuses['orders_status_id'],
                'text' => $statuses['orders_status_name']];
        }

        $input = tep_draw_pull_down_menu('order_status_id', $statuses_array, OSCOM_APP_PAYPAL_BRAINTREE_CC_ORDER_STATUS_ID, 'id="inputCcOrderStatusId"');

        $result = <<<EOT
<div>
  <p>
    <label for="inputCcOrderStatusId">{$this->title}</label>

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
