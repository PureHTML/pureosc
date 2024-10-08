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
class shopping_cart
{
    public $contents;
    public $total;
    public $weight;

    public function __construct()
    {
        $this->reset();
    }

    public function restore_contents()
    {
        global $customer_id;

        if (!$customer_id) {
            return 0;
        }

        // insert current cart contents in database
        if ($this->contents) {
            foreach (array_keys($this->contents) as $products_id) {
                $qty = $this->contents[$products_id]['qty'];
                $product_query = tep_db_query("select products_id from customers_basket where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."'");

                if (!tep_db_num_rows($product_query)) {
                    tep_db_query("insert into customers_basket (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('".(int) $customer_id."', '".tep_db_input($products_id)."', '".tep_db_input($qty)."', '".date('Ymd')."')");

                    if ($this->contents[$products_id]['attributes']) {
                        foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
                            tep_db_query("insert into customers_basket_attributes (customers_id, products_id, products_options_id, products_options_value_id) values ('".(int) $customer_id."', '".tep_db_input($products_id)."', '".(int) $option."', '".(int) $value."')");
                        }
                    }
                } else {
                    tep_db_query("update customers_basket set customers_basket_quantity = '".tep_db_input($qty)."' where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."'");
                }
            }
        }

        // reset per-session cart contents, but not the database contents
        $this->reset(false);

        $products_query = tep_db_query("select products_id, customers_basket_quantity from customers_basket where customers_id = '".(int) $customer_id."'");

        while ($products = tep_db_fetch_array($products_query)) {
            $this->contents[$products['products_id']] = ['qty' => $products['customers_basket_quantity']];
            // attributes
            $attributes_query = tep_db_query("select products_options_id, products_options_value_id from customers_basket_attributes where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products['products_id'])."'");

            while ($attributes = tep_db_fetch_array($attributes_query)) {
                $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
            }
        }

        $this->cleanup();
    }

    public function reset($reset_database = false): void
    {
        global $customer_id;

        $this->contents = [];
        $this->total = 0;

        if ($customer_id && $reset_database) {
            tep_db_query("delete from customers_basket where customers_id = '".(int) $customer_id."'");
            tep_db_query("delete from customers_basket_attributes where customers_id = '".(int) $customer_id."'");
        }
    }

    public function add_cart($products_id, $qty = '', $attributes = ''): void
    {
        global $new_products_id_in_cart, $customer_id;

        $products_id = tep_get_uprid($products_id, $attributes);

        if ($this->in_cart($products_id)) {
            $this->update_quantity($products_id, $qty, $attributes);
        } else {
            if ($qty === '') {
                $qty = '1';
            }

            // if no quantity is supplied, then add '1' to the customers basket

            $this->contents[] = [$products_id];
            $this->contents[$products_id] = ['qty' => $qty];

            // insert into database
            if ($customer_id) {
                tep_db_query("insert into customers_basket (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('".(int) $customer_id."', '".tep_db_input($products_id)."', '".tep_db_input($qty)."', '".date('Ymd')."')");
            }

            if (\is_array($attributes)) {
                foreach ($attributes as $option => $value) {
                    $this->contents[$products_id]['attributes'][$option] = $value;

                    // insert into database
                    if ($customer_id) {
                        tep_db_query("insert into customers_basket_attributes (customers_id, products_id, products_options_id, products_options_value_id) values ('".(int) $customer_id."', '".tep_db_input($products_id)."', '".(int) $option."', '".(int) $value."')");
                    }
                }
            }

            $new_products_id_in_cart = $products_id;
            tep_session_register('new_products_id_in_cart');
        }

        $this->cleanup();
    }

    public function update_quantity($products_id, $quantity = '', $attributes = '')
    {
        global $customer_id;

        if ($quantity === '') {
            return true;
        }

        // nothing needs to be updated if theres no quantity, so we return true..

        $this->contents[$products_id] = ['qty' => $quantity];

        // update database
        if ($customer_id) {
            tep_db_query("update customers_basket set customers_basket_quantity = '".tep_db_input($quantity)."' where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."'");
        }

        if (\is_array($attributes)) {
            foreach ($attributes as $option => $value) {
                $this->contents[$products_id]['attributes'][$option] = $value;

                // update database
                if ($customer_id) {
                    tep_db_query("update customers_basket_attributes set products_options_value_id = '".(int) $value."' where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."' and products_options_id = '".(int) $option."'");
                }
            }
        }
    }

    public function cleanup(): void
    {
        global $customer_id;

        foreach (array_keys($this->contents) as $key) {
            if ($this->contents[$key]['qty'] < 1) {
                unset($this->contents[$key]);

                // remove from database
                if ($customer_id) {
                    tep_db_query("delete from customers_basket where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($key)."'");
                    tep_db_query("delete from customers_basket_attributes where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($key)."'");
                }
            }
        }
    }

    public function count_contents()  // get total number of items in cart
    {
        $total_items = 0;

        if (\is_array($this->contents)) {
            foreach (array_keys($this->contents) as $products_id) {
                $total_items += $this->get_quantity($products_id);
            }
        }

        return $total_items;
    }

    public function get_quantity($products_id)
    {
        if ($this->contents[$products_id]) {
            return $this->contents[$products_id]['qty'];
        }

        return 0;
    }

    public function in_cart($products_id)
    {
        if ($this->contents[$products_id]) {
            return true;
        }

        return false;
    }

    public function remove($products_id): void
    {
        global $customer_id;

        unset($this->contents[$products_id]);

        // remove from database
        if ($customer_id) {
            tep_db_query("delete from customers_basket where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."'");
            tep_db_query("delete from customers_basket_attributes where customers_id = '".(int) $customer_id."' and products_id = '".tep_db_input($products_id)."'");
        }
    }

    public function remove_all(): void
    {
        $this->reset();
    }

    public function get_product_id_list()
    {
        $product_id_list = '';

        if (\is_array($this->contents)) {
            foreach (array_keys($this->contents) as $products_id) {
                $product_id_list .= ', '.$products_id;
            }
        }

        return substr($product_id_list, 2);
    }

    public function calculate()
    {
        $this->total = 0;
        $this->weight = 0;

        if (!\is_array($this->contents)) {
            return 0;
        }

        foreach (array_keys($this->contents) as $products_id) {
            $qty = $this->contents[$products_id]['qty'];

            // products price
            $product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight from products where products_id='".(int) tep_get_prid($products_id)."'");

            if ($product = tep_db_fetch_array($product_query)) {
                $prid = $product['products_id'];
                $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
                $products_price = $product['products_price'];
                $products_weight = $product['products_weight'];

                $specials_query = tep_db_query("select specials_new_products_price from specials where products_id = '".(int) $prid."' and status = '1'");

                if (tep_db_num_rows($specials_query)) {
                    $specials = tep_db_fetch_array($specials_query);
                    $products_price = $specials['specials_new_products_price'];
                }

                $this->total += tep_add_tax($products_price, $products_tax) * $qty;
                $this->weight += ($qty * $products_weight);
            }

            // attributes price
            if (isset($this->contents[$products_id]['attributes'])) {
                foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
                    $attribute_price_query = tep_db_query("select options_values_price, price_prefix from products_attributes where products_id = '".(int) $prid."' and options_id = '".(int) $option."' and options_values_id = '".(int) $value."'");
                    $attribute_price = tep_db_fetch_array($attribute_price_query);

                    if ($attribute_price['price_prefix'] === '+') {
                        $this->total += $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
                    } else {
                        $this->total -= $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
                    }
                }
            }
        }
    }

    public function attributes_price($products_id)
    {
        $attributes_price = 0;

        if (isset($this->contents[$products_id]['attributes'])) {
            foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
                $attribute_price_query = tep_db_query("select options_values_price, price_prefix from products_attributes where products_id = '".(int) $products_id."' and options_id = '".(int) $option."' and options_values_id = '".(int) $value."'");
                $attribute_price = tep_db_fetch_array($attribute_price_query);

                if ($attribute_price['price_prefix'] === '+') {
                    $attributes_price += $attribute_price['options_values_price'];
                } else {
                    $attributes_price -= $attribute_price['options_values_price'];
                }
            }
        }

        return $attributes_price;
    }

    public function get_products()
    {
        global $languages_id;

        if (!\is_array($this->contents)) {
            return 0;
        }

        $products_array = [];

        foreach (array_keys($this->contents) as $products_id) {
            $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_model, p.products_price, p.products_weight, p.products_tax_class_id from products p, products_description pd where p.products_id='".(int) tep_get_prid($products_id)."' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."'");

            if ($products = tep_db_fetch_array($products_query)) {
                $prid = $products['products_id'];
                $products_price = $products['products_price'];

                $specials_query = tep_db_query("select specials_new_products_price from specials where products_id = '".(int) $prid."' and status = '1'");

                if (tep_db_num_rows($specials_query)) {
                    $specials = tep_db_fetch_array($specials_query);
                    $products_price = $specials['specials_new_products_price'];
                }

                $products_array[] = ['id' => $products_id,
                    'name' => $products['products_name'],
                    'model' => $products['products_model'],
                    'price' => $products_price,
                    'quantity' => $this->contents[$products_id]['qty'],
                    'weight' => $products['products_weight'],
                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                    'tax_class_id' => $products['products_tax_class_id'],
                    'attributes' => ($this->contents[$products_id]['attributes'] ?? '')];
            }
        }

        return $products_array;
    }

    public function show_total()
    {
        $this->calculate();

        return $this->total;
    }

    public function show_weight()
    {
        $this->calculate();

        return $this->weight;
    }
}
