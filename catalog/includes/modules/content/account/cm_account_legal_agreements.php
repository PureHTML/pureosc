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
class cm_account_legal_agreements
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

        $this->title = MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_TITLE;
        $this->description = MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_STATUS === 'True');

            if (!\defined('ACCOUNT_LEGAL_AGREEMENTS') || ACCOUNT_LEGAL_AGREEMENTS === 'false') {
                $this->enabled = false;

                $this->description = '<div class="secWarning">'.MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_ERROR_CONFIGURATION.'<br /><br />'.MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_ENABLE_CONFIGURATION.'</div>'.$this->description;
            }
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        $oscTemplate->_data[$this->group]['privacy_settings']['title'] = PRIVACY_SETTINGS_TITLE;
        $oscTemplate->_data[$this->group]['privacy_settings']['links']['legal_agreements'] = ['title' => MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_LINK_TITLE,
            'link' => tep_href_link('ext/modules/content/account/legal_agreements.php'),
            'icon' => 'plus'];
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', NOW())");
    }

    public function remove(): void
    {
        tep_db_query("DELETE FROM configuration WHERE configuration_key IN ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_STATUS', 'MODULE_CONTENT_ACCOUNT_LEGAL_AGREEMENTS_SORT_ORDER'];
    }
}
