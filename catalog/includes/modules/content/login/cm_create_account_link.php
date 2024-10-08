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
class cm_create_account_link
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

        $this->title = MODULE_CONTENT_CREATE_ACCOUNT_LINK_TITLE;
        $this->description = MODULE_CONTENT_CREATE_ACCOUNT_LINK_DESCRIPTION;

        if (\defined('MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS')) {
            $this->sort_order = MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        ob_start();

        include 'includes/modules/content/'.$this->group.'/templates/create_account_link.php';
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable New User Module', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'True', 'Do you want to enable the new user module?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER', '2', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER'];
    }
}
