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

class cm_pi_buy_button
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

        $this->title = MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_TITLE;
        $this->description = MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $product_info, $currencies;

        ob_start();

        include 'includes/modules/content/'.$this->group.'/templates/buy_button.php';

        $oscTemplate->addContent(ob_get_clean(), 'product_info_form');
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Module', 'MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_SORT_ORDER', '2', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_STATUS', 'MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_SORT_ORDER'];
    }
}
