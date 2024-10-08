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
class cm_pi_social_bookmarks
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

        $this->title = MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_TITLE;
        $this->description = MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $product_info, $language;

        $sbm_array = explode(';', MODULE_SOCIAL_BOOKMARKS_INSTALLED);

        $social_bookmarks = [];

        foreach ($sbm_array as $sbm) {
            $class = substr($sbm, 0, strrpos($sbm, '.'));

            if (!class_exists($class)) {
                include 'includes/languages/'.$language.'/modules/social_bookmarks/'.$sbm;

                include 'includes/modules/social_bookmarks/'.$class.'.php';
            }

            $sb = new $class();

            if ($sb->isEnabled()) {
                $social_bookmarks[] = $sb->getOutput();
            }
        }

        if (!empty($social_bookmarks)) {
            ob_start();

            include 'includes/modules/content/'.$this->group.'/templates/social_bookmarks.php';

            switch (MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_BLOCK_PLACEMENT) {
                case 'Left':
                    $this->group = 'product_info_left';

                    break;
                case 'Top':
                    $this->group = 'product_info_right';

                    break;
                case 'Bottom':
                    $this->group = 'product_info_form';

                    break;
            }

            $oscTemplate->addContent(ob_get_clean(), $this->group);
        }
    }

    public function isEnabled()
    {
        global $product_info;

        if (isset($product_info['products_id']) && \defined('MODULE_SOCIAL_BOOKMARKS_INSTALLED') && !empty(MODULE_SOCIAL_BOOKMARKS_INSTALLED)) {
            return $this->enabled;
        }

        return false;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Block Placement', 'MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_BLOCK_PLACEMENT', 'Left', 'Place the social bookmarks icons block on the right, top or bottom?', '6', '1', 'tep_cfg_select_option(array(\\'Left\\', \\'Top\\', \\'Bottom\\'), ', NOW())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', '6', '0', NOW())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_STATUS', 'MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_BLOCK_PLACEMENT', 'MODULE_CONTENT_PRODUCT_INFO_SOCIAL_BOOKMARKS_SORT_ORDER'];
    }
}
