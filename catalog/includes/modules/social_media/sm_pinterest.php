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

class sm_pinterest
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $icon = 'pinterest.svg';
    public $enabled = false;

    public function __construct()
    {
        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = MODULE_SOCIAL_MEDIA_PINTEREST_TITLE;
        $this->description = MODULE_SOCIAL_MEDIA_PINTEREST_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_SOCIAL_MEDIA_PINTEREST_SORT_ORDER;
            $this->enabled = (MODULE_SOCIAL_MEDIA_PINTEREST_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        return '<a href="http://pinterest.com/'.tep_output_string_protected(MODULE_SOCIAL_MEDIA_PINTEREST_PROFILE_ID).'"><img src="images/icons/social_media/'.$this->icon.'" style="width: 2rem; height: 2rem;" title="'.tep_output_string_protected($this->title).'"></a>';
    }

    public function isEnabled()
    {
        if (!empty(MODULE_SOCIAL_MEDIA_PINTEREST_PROFILE_ID)) {
            return $this->enabled;
        }

        return false;
    }

    public function check()
    {
        return \defined('MODULE_SOCIAL_MEDIA_PINTEREST_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_SOCIAL_MEDIA_PINTEREST_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Profile ID', 'MODULE_SOCIAL_MEDIA_PINTEREST_PROFILE_ID', '', 'Profile ID.', '6', '0', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_SOCIAL_MEDIA_PINTEREST_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_SOCIAL_MEDIA_PINTEREST_STATUS', 'MODULE_SOCIAL_MEDIA_PINTEREST_PROFILE_ID', 'MODULE_SOCIAL_MEDIA_PINTEREST_SORT_ORDER'];
    }
}
