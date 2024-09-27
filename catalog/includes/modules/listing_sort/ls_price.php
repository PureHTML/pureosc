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

class ls_price
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;
    public $param = 'price';

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_LISTING_SORT_PRICE_TITLE;
        $this->description = MODULE_LISTING_SORT_PRICE_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_LISTING_SORT_PRICE_SORT_ORDER;
            $this->enabled = (MODULE_LISTING_SORT_PRICE_STATUS === 'True');
        }
    }

    public function sort()
    {
        return [['id' => 'price_asc',
            'text' => MODULE_LISTING_SORT_PRICE_TEXT_PRICE_ASC],
            ['id' => 'price_desc',
                'text' => MODULE_LISTING_SORT_PRICE_TEXT_PRICE_DESC]];
    }

    public function order()
    {
        return ' order by final_price '.(isset($_GET['sort']) && $_GET['sort'] === 'price_desc' ? 'desc' : '').', pd.products_name';
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_LISTING_SORT_PRICE_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_LISTING_SORT_PRICE_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_LISTING_SORT_PRICE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_LISTING_SORT_PRICE_STATUS', 'MODULE_LISTING_SORT_PRICE_SORT_ORDER'];
    }
}
