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
class prepare_order_status_id
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 300;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_hs_prepare_order_status_id_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_hs_prepare_order_status_id_desc');

        if (!\defined('OSCOM_APP_PAYPAL_HS_PREPARE_ORDER_STATUS_ID')) {
            $check_query = tep_db_query("SELECT orders_status_id FROM orders_status WHERE orders_status_name = 'Preparing [PayPal Pro HS]' LIMIT 1");

            if (tep_db_num_rows($check_query) < 1) {
                $status_query = tep_db_query('SELECT MAX(orders_status_id) AS status_id FROM orders_status');
                $status = tep_db_fetch_array($status_query);

                $status_id = $status['status_id'] + 1;

                $languages = tep_get_languages();

                foreach ($languages as $lang) {
                    tep_db_query("insert into orders_status (orders_status_id, language_id, orders_status_name) values ('".$status_id."', '".$lang['id']."', 'Preparing [PayPal Pro HS]')");
                }

                $flags_query = tep_db_query('describe orders_status public_flag');

                if (tep_db_num_rows($flags_query) === 1) {
                    tep_db_query("update orders_status set public_flag = 0 and downloads_flag = 0 where orders_status_id = '".(int) $status_id."'");
                }
            } else {
                $check = tep_db_fetch_array($check_query);

                $status_id = $check['orders_status_id'];
            }
        } else {
            $status_id = OSCOM_APP_PAYPAL_HS_PREPARE_ORDER_STATUS_ID;
        }

        $this->default = $status_id;
    }

    public function getSetField()
    {
        global $OSCOM_PayPal, $languages_id;

        $statuses_array = [['id' => '0', 'text' => $OSCOM_PayPal->getDef('cfg_hs_prepare_order_status_id_default')]];

        $statuses_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' order by orders_status_name");

        while ($statuses = tep_db_fetch_array($statuses_query)) {
            $statuses_array[] = ['id' => $statuses['orders_status_id'],
                'text' => $statuses['orders_status_name']];
        }

        $input = tep_draw_pull_down_menu('prepare_order_status_id', $statuses_array, OSCOM_APP_PAYPAL_HS_PREPARE_ORDER_STATUS_ID, 'id="inputHsPrepareOrderStatusId"');

        $result = <<<EOT
<div>
  <p>
    <label for="inputHsPrepareOrderStatusId">{$this->title}</label>

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
