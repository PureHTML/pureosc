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
class ht_mailchimp_360
{
    public $code = 'ht_mailchimp_360';
    public $group = 'header_tags';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_HEADER_TAGS_MAILCHIMP_360_TITLE;
        $this->description = MODULE_HEADER_TAGS_MAILCHIMP_360_DESCRIPTION;

        if (\defined('MODULE_HEADER_TAGS_MAILCHIMP_360_STATUS')) {
            $this->sort_order = MODULE_HEADER_TAGS_MAILCHIMP_360_SORT_ORDER;
            $this->enabled = (MODULE_HEADER_TAGS_MAILCHIMP_360_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $PHP_SELF;

        include 'includes/modules/header_tags/ht_mailchimp_360/MCAPI.class.php';

        include 'includes/modules/header_tags/ht_mailchimp_360/mc360.php';

        $mc360 = new mc360();
        $mc360->set_cookies();

        if (basename($PHP_SELF) === 'checkout_success.php') {
            $mc360->process();
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_HEADER_TAGS_MAILCHIMP_360_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable MailChimp 360 Module', 'MODULE_HEADER_TAGS_MAILCHIMP_360_STATUS', 'True', 'Do you want to activate this module in your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Key', 'MODULE_HEADER_TAGS_MAILCHIMP_360_API_KEY', '', 'An API Key assigned to your MailChimp account', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Debug E-Mail', 'MODULE_HEADER_TAGS_MAILCHIMP_360_DEBUG_EMAIL', '', 'If an e-mail address is entered, debug data will be sent to it', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_MAILCHIMP_360_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");

        // Internal parameters
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MailChimp Store ID', 'MODULE_HEADER_TAGS_MAILCHIMP_360_STORE_ID', '', 'Do not edit. Store ID value.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MailChimp Key Valid', 'MODULE_HEADER_TAGS_MAILCHIMP_360_KEY_VALID', '', 'Do not edit. Key Value value.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");

        // Internal parameters
        tep_db_query("delete from configuration where configuration_key in ('MODULE_HEADER_TAGS_MAILCHIMP_360_STORE_ID', 'MODULE_HEADER_TAGS_MAILCHIMP_360_KEY_VALID')");
    }

    public function keys()
    {
        return ['MODULE_HEADER_TAGS_MAILCHIMP_360_STATUS', 'MODULE_HEADER_TAGS_MAILCHIMP_360_API_KEY', 'MODULE_HEADER_TAGS_MAILCHIMP_360_DEBUG_EMAIL', 'MODULE_HEADER_TAGS_MAILCHIMP_360_SORT_ORDER'];
    }
}
