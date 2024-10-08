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
class cm_cs_product_notifications
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

        $this->title = MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_TITLE;
        $this->description = MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $customer_id, $order_id;

        if (isset($_SESSION['customer_id'])) {
            $global_query = tep_db_query("select global_product_notifications from customers_info where customers_info_id = '".(int) $customer_id."'");
            $global = tep_db_fetch_array($global_query);

            if ($global['global_product_notifications'] !== '1') {
                if (isset($_GET['action']) && ($_GET['action'] === 'update')) {
                    if (isset($_POST['notify']) && \is_array($_POST['notify']) && !empty($_POST['notify'])) {
                        $notify = array_unique($_POST['notify']);

                        foreach ($notify as $n) {
                            if (is_numeric($n) && ($n > 0)) {
                                $check_query = tep_db_query("select products_id from products_notifications where products_id = '".(int) $n."' and customers_id = '".(int) $customer_id."' limit 1");

                                if (!tep_db_num_rows($check_query)) {
                                    tep_db_query("insert into products_notifications (products_id, customers_id, date_added) values ('".(int) $n."', '".(int) $customer_id."', now())");
                                }
                            }
                        }
                    }
                }

                $products_displayed = [];

                $products_query = tep_db_query("select products_id, products_name from orders_products where orders_id = '".(int) $order_id."' order by products_name");

                while ($products = tep_db_fetch_array($products_query)) {
                    if (!isset($products_displayed[$products['products_id']])) {
                        $products_displayed[$products['products_id']] = $products;
                    }
                }

                ob_start();

                include 'includes/modules/content/'.$this->group.'/templates/product_notifications.php';

                $oscTemplate->addContent(ob_get_clean(), $this->group);
            }
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Notifications Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS', 'True', 'Should the product notifications block be shown on the checkout success page?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER'];
    }
}
