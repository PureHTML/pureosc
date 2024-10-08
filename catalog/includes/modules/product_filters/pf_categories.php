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
class pf_categories
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_PRODUCT_FILTERS_CATEGORIES_TITLE;
        $this->description = MODULE_PRODUCT_FILTERS_CATEGORIES_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_PRODUCT_FILTERS_CATEGORIES_SORT_ORDER;
            $this->enabled = (MODULE_PRODUCT_FILTERS_CATEGORIES_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        global $current_category_id;

        if (tep_has_category_subcategories($current_category_id) === true) {
            $subcategories_array = [];
            tep_get_subcategories($subcategories_array, $current_category_id);

            $categories_array = [];

            for ($i = 0, $n = \count($subcategories_array); $i < $n; ++$i) {
                $categories_array[] = tep_get_path($subcategories_array[$i]);
            }

            ob_start();

            include 'includes/modules/'.$this->group.'/templates/categories.php';

            return ob_get_clean();
        }
    }

    public function select()
    {
        return null;
    }

    public function from()
    {
        return null;
    }

    public function where()
    {
        return null;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_PRODUCT_FILTERS_CATEGORIES_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Module', 'MODULE_PRODUCT_FILTERS_CATEGORIES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_PRODUCT_FILTERS_CATEGORIES_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_PRODUCT_FILTERS_CATEGORIES_STATUS', 'MODULE_PRODUCT_FILTERS_CATEGORIES_SORT_ORDER'];
    }
}
