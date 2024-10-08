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
class cm_index_category_images
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

        $this->title = MODULE_CONTENT_INDEX_CATEGORY_IMAGES_TITLE;
        $this->description = MODULE_CONTENT_INDEX_CATEGORY_IMAGES_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_INDEX_CATEGORY_IMAGES_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_INDEX_CATEGORY_IMAGES_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $current_category_id, $languages_id;

        $categories_query = tep_db_query("select c.*, cd.* from categories c, categories_description cd where c.parent_id = '".(int) $current_category_id."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' order by c.sort_order, cd.categories_name");

        if (tep_db_num_rows($categories_query) > 0) {
            $categories_array = [];

            while ($categories = tep_db_fetch_array($categories_query)) {
                if (!empty($categories['categories_image'])) {
                    $categories_array[$categories['categories_id']] = $categories;
                    $categories_array[$categories['categories_id']]['cPath'] = tep_get_path($categories['categories_id']);
                }
            }

            if (!empty($categories_array)) {
                ob_start();

                include 'includes/modules/content/'.$this->group.'/templates/category_images.php';

                $oscTemplate->addContent(ob_get_clean(), $this->group);
            }
        }
    }

    public function isEnabled()
    {
        global $category_depth, $current_category_id;

        if ($category_depth === 'nested' && !empty($current_category_id)) {
            return $this->enabled;
        }

        return false;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_INDEX_CATEGORY_IMAGES_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_CONTENT_INDEX_CATEGORY_IMAGES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_CONTENT_INDEX_CATEGORY_IMAGES_SORT_ORDER', '31', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_INDEX_CATEGORY_IMAGES_STATUS', 'MODULE_CONTENT_INDEX_CATEGORY_IMAGES_SORT_ORDER'];
    }
}
