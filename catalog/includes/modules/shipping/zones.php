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
class zones
{
    public $code;
    public $title;
    public $description;
    public $enabled;
    public $num_zones;

    // class constructor
    public function __construct()
    {
        $this->code = 'zones';
        $this->title = MODULE_SHIPPING_ZONES_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION;

        if (\defined('MODULE_SHIPPING_ZONES_STATUS')) {
            $this->sort_order = MODULE_SHIPPING_ZONES_SORT_ORDER;
            $this->icon = '';
            $this->tax_class = MODULE_SHIPPING_ZONES_TAX_CLASS;
            $this->enabled = ((MODULE_SHIPPING_ZONES_STATUS === 'True') ? true : false);
        }

        // CUSTOMIZE THIS SETTING FOR THE NUMBER OF ZONES NEEDED
        $this->num_zones = 1;
    }

    // class methods
    public function quote($method = '')
    {
        global $order, $shipping_weight, $shipping_num_boxes;

        $dest_country = $order->delivery['country']['iso_code_2'];
        $dest_zone = 0;
        $error = false;

        for ($i = 1; $i <= $this->num_zones; ++$i) {
            $countries_table = \constant('MODULE_SHIPPING_ZONES_COUNTRIES_'.$i);
            $country_zones = preg_split('/[,]/', $countries_table);

            if (\in_array($dest_country, $country_zones, true)) {
                $dest_zone = $i;

                break;
            }
        }

        if ($dest_zone === 0) {
            $error = true;
        } else {
            $shipping = -1;
            $zones_cost = \constant('MODULE_SHIPPING_ZONES_COST_'.$dest_zone);

            $zones_table = preg_split('/[:,]/', $zones_cost);
            $size = \count($zones_table);

            for ($i = 0; $i < $size; $i += 2) {
                if ($shipping_weight <= $zones_table[$i]) {
                    $shipping = $zones_table[$i + 1];
                    $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY.' '.$dest_country.' : '.$shipping_weight.' '.MODULE_SHIPPING_ZONES_TEXT_UNITS;

                    break;
                }
            }

            if ($shipping === -1) {
                $shipping_cost = 0;
                $shipping_method = MODULE_SHIPPING_ZONES_UNDEFINED_RATE;
            } else {
                $shipping_cost = ($shipping * $shipping_num_boxes) + \constant('MODULE_SHIPPING_ZONES_HANDLING_'.$dest_zone);
            }
        }

        $this->quotes = ['id' => $this->code,
            'module' => MODULE_SHIPPING_ZONES_TEXT_TITLE,
            'methods' => [['id' => $this->code,
                'title' => $shipping_method ?? '',
                'cost' => $shipping_cost ?? 0]]];

        if ($this->tax_class > 0) {
            $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }

        if (!empty($this->icon)) {
            $this->quotes['icon'] = tep_image($this->icon, $this->title);
        }

        if ($error === true) {
            $this->quotes['error'] = MODULE_SHIPPING_ZONES_INVALID_ZONE;
        }

        return $this->quotes;
    }

    public function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_SHIPPING_ZONES_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Zones Method', 'MODULE_SHIPPING_ZONES_STATUS', 'True', 'Do you want to offer zone rate shipping?', '6', '0', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_ZONES_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_ZONES_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");

        for ($i = 1; $i <= $this->num_zones; ++$i) {
            $default_countries = '';

            if ($i === 1) {
                $default_countries = 'US,CA';
            }

            tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zone ".$i." Countries', 'MODULE_SHIPPING_ZONES_COUNTRIES_".$i."', '".$default_countries."', 'Comma separated list of two character ISO country codes that are part of Zone ".$i.".', '6', '0', now())");
            tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zone ".$i." Shipping Table', 'MODULE_SHIPPING_ZONES_COST_".$i."', '3:8.50,7:10.50,99:20.00', 'Shipping rates to Zone ".$i.' destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone '.$i." destinations.', '6', '0', now())");
            tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zone ".$i." Handling Fee', 'MODULE_SHIPPING_ZONES_HANDLING_".$i."', '0', 'Handling Fee for this shipping zone', '6', '0', now())");
        }
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        $keys = ['MODULE_SHIPPING_ZONES_STATUS', 'MODULE_SHIPPING_ZONES_TAX_CLASS', 'MODULE_SHIPPING_ZONES_SORT_ORDER'];

        for ($i = 1; $i <= $this->num_zones; ++$i) {
            $keys[] = 'MODULE_SHIPPING_ZONES_COUNTRIES_'.$i;
            $keys[] = 'MODULE_SHIPPING_ZONES_COST_'.$i;
            $keys[] = 'MODULE_SHIPPING_ZONES_HANDLING_'.$i;
        }

        return $keys;
    }
}
