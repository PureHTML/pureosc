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
class hm_information
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

        $this->title = MODULE_HEADER_INFORMATION_TITLE;
        $this->description = MODULE_HEADER_INFORMATION_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_HEADER_INFORMATION_SORT_ORDER;
            $this->enabled = (MODULE_HEADER_INFORMATION_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $languages_id;

        $information_array = [];

        $information_query = tep_db_query("select ip.pages_id, ipc.pages_name from information_pages ip, information_pages_content ipc where ip.pages_status = '1' and ip.pages_id = ipc.pages_id and ipc.language_id = '".(int) $languages_id."' order by ip.sort_order");

        while ($information = tep_db_fetch_array($information_query)) {
            $information_array[] = $information;
        }

        ob_start();

        include 'includes/modules/'.$this->group.'/templates/information.php';

        $oscTemplate->addBlock(ob_get_clean(), 'header_top');
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_HEADER_INFORMATION_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_HEADER_INFORMATION_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_HEADER_INFORMATION_SORT_ORDER', '9', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_HEADER_INFORMATION_STATUS', 'MODULE_HEADER_INFORMATION_SORT_ORDER'];
    }
}
