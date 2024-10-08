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
class pf_attributes
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;
    public $attributes = [];

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_PRODUCT_FILTERS_ATTRIBUTES_TITLE;
        $this->description = MODULE_PRODUCT_FILTERS_ATTRIBUTES_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_PRODUCT_FILTERS_ATTRIBUTES_SORT_ORDER;
            $this->enabled = (MODULE_PRODUCT_FILTERS_ATTRIBUTES_STATUS === 'True');
        }

        $this->getAttributes();
    }

    public function getOutput()
    {
        global $current_category_id, $languages_id;

        $products_attributes_array = [];

        $products_options_name_query = tep_db_query("select distinct po.* from products_options po, products_attributes pa, products_to_categories p2c, products p where pa.products_id = p2c.products_id  and p.products_id = p2c.products_id and p.products_status = '1' and po.products_options_id = pa.options_id and p2c.categories_id = '".(int) $current_category_id."' and po.language_id = '".(int) $languages_id."' order by po.products_options_id");

        if (tep_db_num_rows($products_options_name_query)) {
            while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
                $products_attributes_array[$products_options_name['products_options_id']] = ['options_id' => $products_options_name['products_options_id'],
                    'options_name' => $products_options_name['products_options_name']];

                $products_options_query = tep_db_query("select distinct pov.* from products_options_values pov,  products_attributes pa, products_to_categories p2c, products p where pa.options_id = '".(int) $products_options_name['products_options_id']."' and pa.options_values_id = pov.products_options_values_id and pa.products_id = p2c.products_id and p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_id = '".(int) $current_category_id."' and pov.language_id = '".(int) $languages_id."' order by products_options_values_id");

                while ($products_options = tep_db_fetch_array($products_options_query)) {
                    $products_attributes_array[$products_options_name['products_options_id']]['options_array'][] = $products_options;
                }
            }

            if (!empty($products_attributes_array)) {
                ob_start();

                include 'includes/modules/'.$this->group.'/templates/attributes.php';

                return ob_get_clean();
            }
        }

        return null;
    }

    public function from()
    {
        if (!empty($this->attributes)) {
            return ' left join products_attributes pa on p.products_id = pa.products_id';
        }

        return null;
    }

    public function where()
    {
        if (!empty($this->attributes)) {
            $values_array = [];

            foreach ($this->attributes as $options_values_id) {
                $values_array += $options_values_id;
            }

            return " and pa.options_id in ('".implode("', '", array_keys($this->attributes))."') and pa.options_values_id in ('".implode("', '", $values_array)."') ";
        }

        return null;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_PRODUCT_FILTERS_ATTRIBUTES_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_PRODUCT_FILTERS_ATTRIBUTES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_PRODUCT_FILTERS_ATTRIBUTES_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_PRODUCT_FILTERS_ATTRIBUTES_STATUS', 'MODULE_PRODUCT_FILTERS_ATTRIBUTES_SORT_ORDER'];
    }

    public function getAttributes()
    {
        foreach ($_GET as $key => $value) {
            if (preg_match('/attrib_([0-9]+)/', $key, $matches)) {
                if (isset($_GET[$matches[0]])) {
                    $this->attributes[tep_db_prepare_input($matches[1])] = tep_db_prepare_input($value);
                }
            }
        }

        return $this->attributes;
    }
}
