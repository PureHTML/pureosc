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
class d_customers
{
    public $code = 'd_customers';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_ADMIN_DASHBOARD_CUSTOMERS_TITLE;
        $this->description = MODULE_ADMIN_DASHBOARD_CUSTOMERS_DESCRIPTION;

        if (\defined('MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER;
            $this->enabled = (MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        $output = '<table border="0" width="100%" cellspacing="0" cellpadding="4">'.
                  '  <tr class="dataTableHeadingRow">'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_CUSTOMERS_TITLE.'</td>'.
                  '    <td class="dataTableHeadingContent" align="right">'.MODULE_ADMIN_DASHBOARD_CUSTOMERS_DATE.'</td>'.
                  '  </tr>';

        $customers_query = tep_db_query('select c.customers_id, c.customers_lastname, c.customers_firstname, ci.customers_info_date_account_created from customers c, customers_info ci where c.customers_id = ci.customers_info_id order by ci.customers_info_date_account_created desc limit 6');

        while ($customers = tep_db_fetch_array($customers_query)) {
            $output .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">'.
                       '    <td class="dataTableContent"><a href="'.tep_href_link('customers.php', 'cID='.(int) $customers['customers_id'].'&action=edit').'">'.tep_output_string_protected($customers['customers_firstname'].' '.$customers['customers_lastname']).'</a></td>'.
                       '    <td class="dataTableContent" align="right">'.tep_date_short($customers['customers_info_date_account_created']).'</td>'.
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
        return \defined('MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Customers Module', 'MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS', 'True', 'Do you want to show the newest customers on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS', 'MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER'];
    }
}
