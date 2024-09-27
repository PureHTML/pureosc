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

class d_orders
{
    public $code = 'd_orders';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_ADMIN_DASHBOARD_ORDERS_TITLE;
        $this->description = MODULE_ADMIN_DASHBOARD_ORDERS_DESCRIPTION;

        if (\defined('MODULE_ADMIN_DASHBOARD_ORDERS_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER;
            $this->enabled = (MODULE_ADMIN_DASHBOARD_ORDERS_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        global $languages_id;

        $output = '<table border="0" width="100%" cellspacing="0" cellpadding="4">'.
                  '  <tr class="dataTableHeadingRow">'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_ORDERS_TITLE.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_ORDERS_TOTAL.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_ORDERS_DATE.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_ORDERS_ORDER_STATUS.'</td>'.
                  '  </tr>';

        $orders_query = tep_db_query("select o.orders_id, o.customers_name, greatest(o.date_purchased, ifnull(o.last_modified, 0)) as date_last_modified, s.orders_status_name, ot.text as order_total from orders o, orders_total ot, orders_status s where o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '".(int) $languages_id."' order by date_last_modified desc limit 6");

        while ($orders = tep_db_fetch_array($orders_query)) {
            $output .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">'.
                       '    <td class="dataTableContent"><a href="'.tep_href_link('orders.php', 'oID='.(int) $orders['orders_id'].'&action=edit').'">'.tep_output_string_protected($orders['customers_name']).'</a></td>'.
                       '    <td class="dataTableContent">'.strip_tags($orders['order_total']).'</td>'.
                       '    <td class="dataTableContent">'.tep_date_short($orders['date_last_modified']).'</td>'.
                       '    <td class="dataTableContent">'.$orders['orders_status_name'].'</td>'.
                       '  </tr>';
        }

        $output .= '</table>';

        return $output;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_ADMIN_DASHBOARD_ORDERS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Orders Module', 'MODULE_ADMIN_DASHBOARD_ORDERS_STATUS', 'True', 'Do you want to show the latest orders on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ADMIN_DASHBOARD_ORDERS_STATUS', 'MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER'];
    }
}
