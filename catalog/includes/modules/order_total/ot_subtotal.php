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
class ot_subtotal
{
    public $title;
    public $output;

    public function __construct()
    {
        $this->code = 'ot_subtotal';
        $this->title = MODULE_ORDER_TOTAL_SUBTOTAL_TITLE;
        $this->description = MODULE_ORDER_TOTAL_SUBTOTAL_DESCRIPTION;
        $this->enabled = \defined('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS') && MODULE_ORDER_TOTAL_SUBTOTAL_STATUS === 'true' ? true : false;
        $this->sort_order = \defined('MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER') ? MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER : 0;

        $this->output = [];
    }

    public function process(): void
    {
        global $order, $currencies;

        $this->output[] = ['title' => $this->title.':',
            'text' => $currencies->format($order->info['subtotal'], true, $order->info['currency'], $order->info['currency_value']),
            'value' => $order->info['subtotal']];
    }

    public function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    public function keys()
    {
        return ['MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER'];
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', '6', '1','tep_cfg_select_option(array(\\'true\\', \\'false\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', '6', '2', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }
}
