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
class d_reviews
{
    public $code = 'd_reviews';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_ADMIN_DASHBOARD_REVIEWS_TITLE;
        $this->description = MODULE_ADMIN_DASHBOARD_REVIEWS_DESCRIPTION;

        if (\defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER;
            $this->enabled = (MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        global $languages_id;

        $output = '<table border="0" width="100%" cellspacing="0" cellpadding="4">'.
                  '  <tr class="dataTableHeadingRow">'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_REVIEWS_TITLE.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_REVIEWS_DATE.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_REVIEWS_REVIEWER.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_REVIEWS_RATING.'</td>'.
                  '    <td class="dataTableHeadingContent">'.MODULE_ADMIN_DASHBOARD_REVIEWS_REVIEW_STATUS.'</td>'.
                  '  </tr>';

        $reviews_query = tep_db_query("select r.reviews_id, r.date_added, pd.products_name, r.customers_name, r.reviews_rating, r.reviews_status from reviews r, products_description pd where pd.products_id = r.products_id and pd.language_id = '".(int) $languages_id."' order by r.date_added desc limit 6");

        while ($reviews = tep_db_fetch_array($reviews_query)) {
            $status_icon = ($reviews['reviews_status'] === '1') ? tep_image('images/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) : tep_image('images/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
            $output .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">'.
                       '    <td class="dataTableContent"><a href="'.tep_href_link('reviews.php', 'rID='.(int) $reviews['reviews_id'].'&action=edit').'">'.$reviews['products_name'].'</a></td>'.
                       '    <td class="dataTableContent">'.tep_date_short($reviews['date_added']).'</td>'.
                       '    <td class="dataTableContent">'.tep_output_string_protected($reviews['customers_name']).'</td>'.
                       '    <td class="dataTableContent">'.tep_info_image('stars_'.$reviews['reviews_rating'].'.png').'</td>'.
                       '    <td class="dataTableContent">'.$status_icon.'</td>'.
                       '  </tr>';
        }

        $output .= '</table>';

        return $output;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Reviews Module', 'MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'True', 'Do you want to show the latest reviews on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER'];
    }
}
