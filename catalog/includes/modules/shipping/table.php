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
class table
{
    public $code;
    public $title;
    public $description;
    public $icon;
    public $enabled;

    // class constructor
    public function __construct()
    {
        global $order;

        $this->code = 'table';
        $this->title = MODULE_SHIPPING_TABLE_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_TABLE_TEXT_DESCRIPTION;

        if (\defined('MODULE_SHIPPING_TABLE_STATUS')) {
            $this->sort_order = MODULE_SHIPPING_TABLE_SORT_ORDER;
            $this->icon = '';
            $this->tax_class = MODULE_SHIPPING_TABLE_TAX_CLASS;
            $this->enabled = ((MODULE_SHIPPING_TABLE_STATUS === 'True') ? true : false);
        }

        if (($this->enabled === true) && ((int) MODULE_SHIPPING_TABLE_ZONE > 0)) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '".MODULE_SHIPPING_TABLE_ZONE."' and zone_country_id = '".(int) $order->delivery['country']['id']."' order by zone_id");

            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;

                    break;
                }

                if ($check['zone_id'] === $order->delivery['zone_id']) {
                    $check_flag = true;

                    break;
                }
            }

            if ($check_flag === false) {
                $this->enabled = false;
            }
        }
    }

    // class methods
    public function quote($method = '')
    {
        global $order, $shipping_weight, $shipping_num_boxes;

        if (MODULE_SHIPPING_TABLE_MODE === 'price') {
            $order_total = $this->getShippableTotal();
        } else {
            $order_total = $shipping_weight;
        }

        $table_cost = preg_split('/[:,]/', MODULE_SHIPPING_TABLE_COST);
        $size = \count($table_cost);

        for ($i = 0, $n = $size; $i < $n; $i += 2) {
            if ($order_total <= $table_cost[$i]) {
                $shipping = $table_cost[$i + 1];

                break;
            }
        }

        if (MODULE_SHIPPING_TABLE_MODE === 'weight') {
            $shipping *= $shipping_num_boxes;
        }

        $this->quotes = ['id' => $this->code,
            'module' => MODULE_SHIPPING_TABLE_TEXT_TITLE,
            'methods' => [['id' => $this->code,
                'title' => MODULE_SHIPPING_TABLE_TEXT_WAY,
                'cost' => $shipping + MODULE_SHIPPING_TABLE_HANDLING]]];

        if ($this->tax_class > 0) {
            $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }

        if (!empty($this->icon)) {
            $this->quotes['icon'] = tep_image($this->icon, $this->title);
        }

        return $this->quotes;
    }

    public function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_SHIPPING_TABLE_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Table Method', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Do you want to offer table rate shipping?', '6', '0', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shipping Table', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Table Method', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'The shipping cost is based on the order total or the total weight of the items ordered.', '6', '0', 'tep_cfg_select_option(array(\\'weight\\', \\'price\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handling Fee', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Handling fee for this shipping method.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_SHIPPING_TABLE_STATUS', 'MODULE_SHIPPING_TABLE_COST', 'MODULE_SHIPPING_TABLE_MODE', 'MODULE_SHIPPING_TABLE_HANDLING', 'MODULE_SHIPPING_TABLE_TAX_CLASS', 'MODULE_SHIPPING_TABLE_ZONE', 'MODULE_SHIPPING_TABLE_SORT_ORDER'];
    }

    public function getShippableTotal()
    {
        global $order, $cart, $currencies;

        $order_total = $cart->show_total();

        if ($order->content_type === 'mixed') {
            $order_total = 0;

            for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
                $order_total += $currencies->calculate_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);

                if (isset($order->products[$i]['attributes'])) {
                    foreach ($order->products[$i]['attributes'] as $option => $value) {
                        $virtual_check_query = tep_db_query("select count(*) as total from products_attributes pa, products_attributes_download pad where pa.products_id = '".(int) $order->products[$i]['id']."' and pa.options_values_id = '".(int) $value['value_id']."' and pa.products_attributes_id = pad.products_attributes_id");
                        $virtual_check = tep_db_fetch_array($virtual_check_query);

                        if ($virtual_check['total'] > 0) {
                            $order_total -= $currencies->calculate_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
                        }
                    }
                }
            }
        }

        return $order_total;
    }
}
