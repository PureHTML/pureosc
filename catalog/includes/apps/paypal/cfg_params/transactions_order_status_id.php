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
class transactions_order_status_id
{
    public $default = '0';
    public $title;
    public $description;
    public $sort_order = 200;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->title = $OSCOM_PayPal->getDef('cfg_transactions_order_status_id_title');
        $this->description = $OSCOM_PayPal->getDef('cfg_transactions_order_status_id_desc');
    }

    public function getSetField()
    {
        global $languages_id;

        $statuses_array = [];

        $flags_query = tep_db_query('describe orders_status public_flag');

        if (tep_db_num_rows($flags_query) === 1) {
            $statuses_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' and public_flag = '0' order by orders_status_name");
        } else {
            $statuses_query = tep_db_query("select orders_status_id, orders_status_name from orders_status where language_id = '".(int) $languages_id."' order by orders_status_name");
        }

        while ($statuses = tep_db_fetch_array($statuses_query)) {
            $statuses_array[] = ['id' => $statuses['orders_status_id'],
                'text' => $statuses['orders_status_name']];
        }

        $input = tep_draw_pull_down_menu('transactions_order_status_id', $statuses_array, OSCOM_APP_PAYPAL_TRANSACTIONS_ORDER_STATUS_ID, 'id="inputTransactionsOrderStatusId"');

        $result = <<<EOT
<div>
  <p>
    <label for="inputTransactionsOrderStatusId">{$this->title}</label>

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
