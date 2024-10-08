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
class sb_facebook_like
{
    public $code = 'sb_facebook_like';
    public $title;
    public $description;
    public $sort_order;
    public $icon = 'facebook.png';
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_TITLE;
        $this->public_title = MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_PUBLIC_TITLE;
        $this->description = MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_DESCRIPTION;

        if (\defined('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS')) {
            $this->sort_order = MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SORT_ORDER;
            $this->enabled = (MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        $style = (MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STYLE === 'Standard') ? 'standard' : 'button_count';
        $faces = (MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_FACES === 'True') ? 'true' : 'false';
        $width = MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_WIDTH;
        $action = (MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_VERB === 'Like') ? 'like' : 'recommend';
        $scheme = (MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SCHEME === 'Light') ? 'light' : 'dark';

        return '<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(tep_href_link('product_info.php', 'products_id='.$_GET['products_id'], 'SSL', false)).'&amp;layout='.$style.'&amp;show_faces='.$faces.'&amp;width='.$width.'&amp;action='.$action.'&amp;colorscheme='.$scheme.'&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:35px;" allowTransparency="true"></iframe>';
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
        return \defined('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Facebook Like Module', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS', 'True', 'Do you want to allow products to be shared through Facebook Like?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Layout Style', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STYLE', 'Standard', 'Determines the size and amount of social context next to the button.', '6', '1', 'tep_cfg_select_option(array(\\'Standard\\', \\'Button Count\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Show Faces', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_FACES', 'False', 'Show profile pictures below the button?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Width', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_WIDTH', '125', 'The width of the iframe in pixels.', '6', '0', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Verb to Display', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_VERB', 'Like', 'The verb to display in the button.', '6', '1', 'tep_cfg_select_option(array(\\'Like\\', \\'Recommend\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Color Scheme', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SCHEME', 'Light', 'The color scheme of the button.', '6', '1', 'tep_cfg_select_option(array(\\'Light\\', \\'Dark\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STYLE', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_FACES', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_WIDTH', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_VERB', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SCHEME', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SORT_ORDER'];
    }
}
