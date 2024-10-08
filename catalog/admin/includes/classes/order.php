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
class order
{
    public $info;
    public $totals;
    public $products;
    public $customer;
    public $delivery;

    public function __construct($order_id)
    {
        $this->info = [];
        $this->totals = [];
        $this->products = [];
        $this->customer = [];
        $this->delivery = [];

        $this->query($order_id);
    }

    public function query($order_id): void
    {
        global $languages_id;

        $order_query = tep_db_query("select o.*, s.orders_status_name from orders o, orders_status s where o.orders_id = '".(int) $order_id."' and o.orders_status = s.orders_status_id and s.language_id = '".(int) $languages_id."'");
        $order = tep_db_fetch_array($order_query);

        $totals_query = tep_db_query("select title, text, class from orders_total where orders_id = '".(int) $order_id."' order by sort_order");

        while ($totals = tep_db_fetch_array($totals_query)) {
            $this->totals[] = ['title' => $totals['title'],
                'text' => $totals['text'],
                'class' => $totals['class']];
        }

        $this->info = ['total' => null,
            'currency' => $order['currency'],
            'currency_value' => $order['currency_value'],
            'payment_method' => $order['payment_method'],
            'cc_type' => $order['cc_type'],
            'cc_owner' => $order['cc_owner'],
            'cc_number' => $order['cc_number'],
            'cc_expires' => $order['cc_expires'],
            'date_purchased' => $order['date_purchased'],
            'status' => $order['orders_status_name'],
            'orders_status' => $order['orders_status'],
            'last_modified' => $order['last_modified']];

        foreach ($this->totals as $t) {
            if ($t['class'] === 'ot_total') {
                $this->info['total'] = $t['text'];

                break;
            }
        }

        $this->customer = ['name' => $order['customers_name'],
            'company' => $order['customers_company'],
            'street_address' => $order['customers_street_address'],
            'suburb' => $order['customers_suburb'],
            'city' => $order['customers_city'],
            'postcode' => $order['customers_postcode'],
            'state' => $order['customers_state'],
            'country' => $order['customers_country'],
            'format_id' => $order['customers_address_format_id'],
            'telephone' => $order['customers_telephone'],
            'email_address' => $order['customers_email_address']];

        $this->delivery = ['name' => $order['delivery_name'],
            'company' => $order['delivery_company'],
            'street_address' => $order['delivery_street_address'],
            'suburb' => $order['delivery_suburb'],
            'city' => $order['delivery_city'],
            'postcode' => $order['delivery_postcode'],
            'state' => $order['delivery_state'],
            'country' => $order['delivery_country'],
            'format_id' => $order['delivery_address_format_id']];

        $this->billing = ['name' => $order['billing_name'],
            'company' => $order['billing_company'],
            'street_address' => $order['billing_street_address'],
            'suburb' => $order['billing_suburb'],
            'city' => $order['billing_city'],
            'postcode' => $order['billing_postcode'],
            'state' => $order['billing_state'],
            'country' => $order['billing_country'],
            'format_id' => $order['billing_address_format_id']];

        $index = 0;
        $orders_products_query = tep_db_query("select orders_products_id, products_name, products_model, products_price, products_tax, products_quantity, final_price from orders_products where orders_id = '".(int) $order_id."'");

        while ($orders_products = tep_db_fetch_array($orders_products_query)) {
            $this->products[$index] = ['qty' => $orders_products['products_quantity'],
                'name' => $orders_products['products_name'],
                'model' => $orders_products['products_model'],
                'tax' => $orders_products['products_tax'],
                'price' => $orders_products['products_price'],
                'final_price' => $orders_products['final_price']];

            $subindex = 0;
            $attributes_query = tep_db_query("select products_options, products_options_values, options_values_price, price_prefix from orders_products_attributes where orders_id = '".(int) $order_id."' and orders_products_id = '".(int) $orders_products['orders_products_id']."'");

            if (tep_db_num_rows($attributes_query)) {
                while ($attributes = tep_db_fetch_array($attributes_query)) {
                    $this->products[$index]['attributes'][$subindex] = ['option' => $attributes['products_options'],
                        'value' => $attributes['products_options_values'],
                        'prefix' => $attributes['price_prefix'],
                        'price' => $attributes['options_values_price']];

                    ++$subindex;
                }
            }

            ++$index;
        }
    }
}
