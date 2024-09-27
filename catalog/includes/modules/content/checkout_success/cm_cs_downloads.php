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

class cm_cs_downloads
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

        $this->title = MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_TITLE;
        $this->description = MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_DESCRIPTION;

        if (\defined('MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS')) {
            $this->sort_order = MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        if (DOWNLOAD_ENABLED === 'true') {
            ob_start();
            extract($GLOBALS, \EXTR_SKIP);

            include 'includes/modules/downloads.php';
            $template = ob_get_clean();

            $oscTemplate->addContent($template, $this->group);
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Downloads Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS', 'True', 'Should ordered product download links be shown on the checkout success page?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER'];
    }
}
