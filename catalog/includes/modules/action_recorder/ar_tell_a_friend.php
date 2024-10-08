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
class ar_tell_a_friend
{
    public $code = 'ar_tell_a_friend';
    public $title;
    public $description;
    public $sort_order = 0;
    public $minutes = 15;
    public $identifier;

    public function __construct()
    {
        $this->title = MODULE_ACTION_RECORDER_TELL_A_FRIEND_TITLE;
        $this->description = MODULE_ACTION_RECORDER_TELL_A_FRIEND_DESCRIPTION;

        if ($this->check()) {
            $this->minutes = (int) MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES;
        }
    }

    public function setIdentifier(): void
    {
        $this->identifier = tep_get_ip_address();
    }

    public function canPerform($user_id, $user_name)
    {
        $check_query = tep_db_query("select date_added from action_recorder where module = '".tep_db_input($this->code)."' and (".(!empty($user_id) ? "user_id = '".(int) $user_id."' or " : '')." identifier = '".tep_db_input($this->identifier)."') and date_added >= date_sub(now(), interval ".(int) $this->minutes.' minute) and success = 1 order by date_added desc limit 1');

        if (tep_db_num_rows($check_query)) {
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
        return \defined('MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Minimum Minutes Per E-Mail', 'MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES', '15', 'Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES'];
    }
}
