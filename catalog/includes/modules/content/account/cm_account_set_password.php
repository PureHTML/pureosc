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
class cm_account_set_password
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

        $this->title = MODULE_CONTENT_ACCOUNT_SET_PASSWORD_TITLE;
        $this->description = MODULE_CONTENT_ACCOUNT_SET_PASSWORD_DESCRIPTION;

        if (\defined('MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS')) {
            $this->sort_order = MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $customer_id, $oscTemplate;

        if (isset($_SESSION['customer_id'])) {
            $check_query = tep_db_query("select customers_password from customers where customers_id = '".(int) $customer_id."'");
            $check = tep_db_fetch_array($check_query);

            if (empty($check['customers_password'])) {
                $counter = 0;

                foreach (array_keys($oscTemplate->_data['account']['account']['links']) as $key) {
                    if ($key === 'password') {
                        break;
                    }

                    ++$counter;
                }

                $before_eight = \array_slice($oscTemplate->_data['account']['account']['links'], 0, $counter, true);
                $after_eight = \array_slice($oscTemplate->_data['account']['account']['links'], $counter + 1, null, true);

                $oscTemplate->_data['account']['account']['links'] = $before_eight;

                if (MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD === 'True') {
                    $oscTemplate->_data['account']['account']['links'] += ['set_password' => ['title' => MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SET_PASSWORD_LINK_TITLE,
                        'link' => tep_href_link('ext/modules/content/account/set_password.php'),
                        'icon' => 'key']];
                }

                $oscTemplate->_data['account']['account']['links'] += $after_eight;
            }
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Set Account Password', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS', 'True', 'Do you want to enable the Set Account Password module?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Local Passwords', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD', 'True', 'Allow local account passwords to be set.', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER'];
    }
}
