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
class ar_admin_login
{
    public $code = 'ar_admin_login';
    public $title;
    public $description;
    public $sort_order = 0;
    public $minutes = 5;
    public $attempts = 3;
    public $identifier;

    public function __construct()
    {
        $this->title = MODULE_ACTION_RECORDER_ADMIN_LOGIN_TITLE;
        $this->description = MODULE_ACTION_RECORDER_ADMIN_LOGIN_DESCRIPTION;

        if ($this->check()) {
            $this->minutes = (int) MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES;
            $this->attempts = (int) MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS;
        }
    }

    public function setIdentifier(): void
    {
        $this->identifier = tep_get_ip_address();
    }

    public function canPerform($user_id, $user_name)
    {
        $check_query = tep_db_query("select id from action_recorder where module = '".tep_db_input($this->code)."' and (".(!empty($user_name) ? "user_name = '".tep_db_input($user_name)."' or " : '')." identifier = '".tep_db_input($this->identifier)."') and date_added >= date_sub(now(), interval ".(int) $this->minutes.' minute) and success = 0 order by date_added desc limit '.(int) $this->attempts);

        if (tep_db_num_rows($check_query) === $this->attempts) {
            return false;
        }

        return true;
    }

    public function expireEntries()
    {
        tep_db_query("delete from action_recorder where module = '".tep_db_input($this->code)."' and date_added < date_sub(now(), interval ".(int) $this->minutes.' minute)');

        return tep_db_affected_rows();
    }

    public function check()
    {
        return \defined('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Minutes', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', '5', 'Number of minutes to allow login attempts to occur.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Attempts', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS', '3', 'Number of login attempts to allow within the specified period.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS'];
    }
}
