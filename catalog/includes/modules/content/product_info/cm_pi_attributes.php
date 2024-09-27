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

class cm_pi_attributes
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

        $this->title = MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_TITLE;
        $this->description = MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_DESCRIPTION;

        if ($this->check()) {
            $this->sort_order = MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_STATUS === 'True');
        }
    }

    public function execute(): void
    {
        global $oscTemplate, $product_info, $languages_id, $currencies, $cart, $wishlist;

        $products_attributes_array = [];

        $products_attributes_query = tep_db_query("select count(*) as total from products_options popt, products_attributes patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $languages_id."'");
        $products_attributes = tep_db_fetch_array($products_attributes_query);

        if ($products_attributes['total'] > 0) {
            $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from products_options popt, products_attributes patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $languages_id."' order by popt.products_options_name");

            while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
                $products_options_array = [];
                $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from products_attributes pa, products_options_values pov where pa.products_id = '".(int) $_GET['products_id']."' and pa.options_id = '".(int) $products_options_name['products_options_id']."' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '".(int) $languages_id."'");

                while ($products_options = tep_db_fetch_array($products_options_query)) {
                    $products_options_array[] = ['id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']];

                    if ($products_options['options_values_price'] !== '0') {
                        $products_options_array[\count($products_options_array) - 1]['text'] .= ' ('.$products_options['price_prefix'].$currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])).') ';
                    }
                }

                $selected_attribute = false;

                if (\is_string($_GET['products_id'])) {
                    if (isset($cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
                        $selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
                    } elseif (isset($wishlist->list[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
                        $selected_attribute = $wishlist->list[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
                    }
                }

                $products_attributes_array[] = ['id' => $products_options_name['products_options_id'],
                    'name' => $products_options_name['products_options_name'],
                    'array' => $products_options_array,
                    'selected_attribute' => $selected_attribute];
            }

            ob_start();

            include 'includes/modules/content/'.$this->group.'/templates/attributes.php';

            $oscTemplate->addContent(ob_get_clean(), 'product_info_form');
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_STATUS');
    }

    public function install(): void
    {
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Module', 'MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_SORT_ORDER', '1', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_STATUS', 'MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_SORT_ORDER'];
    }
}
