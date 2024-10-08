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
class sb_twitter_button
{
    public $code = 'sb_twitter_button';
    public $title;
    public $description;
    public $sort_order;
    public $icon = 'twitter.png';
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_TITLE;
        $this->public_title = MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_PUBLIC_TITLE;
        $this->description = MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_DESCRIPTION;

        if (\defined('MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_STATUS')) {
            $this->sort_order = MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_SORT_ORDER;
            $this->enabled = (MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        $params = ['url='.urlencode(tep_href_link('product_info.php', 'products_id='.$_GET['products_id'], 'SSL', false))];

        if (MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_ACCOUNT !== '') {
            $params[] = 'via='.urlencode(MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_ACCOUNT);
        }

        if (MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT !== '') {
            $params[] = 'related='.urlencode(MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT).((MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT_DESC !== '') ? ':'.urlencode(MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT_DESC) : '');
        }

        if (MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_COUNT_POSITION === 'Vertical') {
            $params[] = 'count=vertical';
        } elseif (MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_COUNT_POSITION === 'None') {
            $params[] = 'count=none';
        }

        $params = implode('&', $params);

        return '<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script><a href="http://twitter.com/share?'.$params.'" target="_blank" class="twitter-share-button">'.tep_output_string_protected($this->public_title).'</a>';
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getPublicTitle()
    {
        return $this->public_title;
    }

    public function check()
    {
        return \defined('MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Twitter Button Module', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_STATUS', 'True', 'Do you want to allow products to be shared through Twitter Button?', '6', '0', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shop Owner Twitter Account', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_ACCOUNT', '', 'The Twitter account to attribute the tweet to and is recommended to the user to follow.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Related Twitter Account', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT', '', 'A related Twitter account that is also recommended to the user to follow.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Related Twitter Account Description', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT_DESC', '', 'A description for the related Twitter account.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Count Position', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_COUNT_POSITION', 'Horizontal', 'The position of the counter.', '6', '0', 'tep_cfg_select_option(array(\\'Horizontal\\', \\'Vertical\\', \\'None\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_STATUS', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_ACCOUNT', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_RELATED_ACCOUNT_DESC', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_COUNT_POSITION', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_BUTTON_SORT_ORDER'];
    }
}
