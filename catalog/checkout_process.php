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

include 'includes/application_top.php';

// if the customer is not logged on, redirect them to the login page
if (!isset($_SESSION['customer_id'])) {
    $navigation->set_snapshot(['mode' => 'SSL', 'page' => 'checkout_payment.php']);
    tep_redirect(tep_href_link('login.php'));
}

// if there is nothing in the customers cart, redirect them to the shopping cart page
if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link('shopping_cart.php'));
}

// if no shipping method has been selected, redirect the customer to the shipping method selection page
if (!isset($_SESSION['shipping']) || !isset($_SESSION['sendto'])) {
    tep_redirect(tep_href_link('checkout_shipping.php'));
}

if ((!empty(MODULE_PAYMENT_INSTALLED)) && (!isset($_SESSION['payment']))) {
    tep_redirect(tep_href_link('checkout_payment.php'));
}

// avoid hack attempts during the checkout procedure by checking the internal cartID
if (isset($cart->cartID, $_SESSION['cartID'])) {
    if ($cart->cartID !== $cartID) {
        tep_redirect(tep_href_link('checkout_shipping.php'));
    }
}

include 'includes/languages/'.$language.'/checkout_process.php';

// load selected payment module
require 'includes/classes/payment.php';
$payment_modules = new payment($payment);

// load the selected shipping module
require 'includes/classes/shipping.php';
$shipping_modules = new shipping($shipping);

require 'includes/classes/order.php';
$order = new order();

// Stock Check
$any_out_of_stock = false;

if (STOCK_CHECK === 'true') {
    for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
        if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
            $any_out_of_stock = true;
        }
    }

    // Out of Stock
    if ((STOCK_ALLOW_CHECKOUT !== 'true') && ($any_out_of_stock === true)) {
        tep_redirect(tep_href_link('shopping_cart.php'));
    }
}

$payment_modules->update_status();

if (($payment_modules->selected_module !== $payment) || (\is_array($payment_modules->modules) && (\count($payment_modules->modules) > 1) && !\is_object(${$payment})) || (\is_object(${$payment}) && (${$payment}->enabled === false))) {
    tep_redirect(tep_href_link('checkout_payment.php', 'error_message='.urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED)));
}

require 'includes/classes/order_total.php';
$order_total_modules = new order_total();

$order_totals = $order_total_modules->process();

// load the before_process function from the payment modules
$payment_modules->before_process();

$sql_data_array = ['customers_id' => $customer_id,
    'customers_name' => $order->customer['firstname'].' '.$order->customer['lastname'],
    'customers_company' => $order->customer['company'],
    'customers_street_address' => $order->customer['street_address'],
    'customers_suburb' => $order->customer['suburb'],
    'customers_city' => $order->customer['city'],
    'customers_postcode' => $order->customer['postcode'],
    'customers_state' => $order->customer['state'],
    'customers_country' => $order->customer['country']['title'],
    'customers_telephone' => $order->customer['telephone'],
    'customers_email_address' => $order->customer['email_address'],
    'customers_address_format_id' => $order->customer['format_id'],
    'delivery_name' => trim($order->delivery['firstname'].' '.$order->delivery['lastname']),
    'delivery_company' => $order->delivery['company'],
    'delivery_street_address' => $order->delivery['street_address'],
    'delivery_suburb' => $order->delivery['suburb'],
    'delivery_city' => $order->delivery['city'],
    'delivery_postcode' => $order->delivery['postcode'],
    'delivery_state' => $order->delivery['state'],
    'delivery_country' => $order->delivery['country']['title'],
    'delivery_address_format_id' => $order->delivery['format_id'],
    'billing_name' => $order->billing['firstname'].' '.$order->billing['lastname'],
    'billing_company' => $order->billing['company'],
    'billing_street_address' => $order->billing['street_address'],
    'billing_suburb' => $order->billing['suburb'],
    'billing_city' => $order->billing['city'],
    'billing_postcode' => $order->billing['postcode'],
    'billing_state' => $order->billing['state'],
    'billing_country' => $order->billing['country']['title'],
    'billing_address_format_id' => $order->billing['format_id'],
    'payment_method' => $order->info['payment_method'],
    'cc_type' => $order->info['cc_type'],
    'cc_owner' => $order->info['cc_owner'],
    'cc_number' => $order->info['cc_number'],
    'cc_expires' => $order->info['cc_expires'],
    'date_purchased' => 'now()',
    'orders_status' => $order->info['order_status'],
    'currency' => $order->info['currency'],
    'currency_value' => $order->info['currency_value']];
tep_db_perform('orders', $sql_data_array);
$insert_id = tep_db_insert_id();

for ($i = 0, $n = \count($order_totals); $i < $n; ++$i) {
    $sql_data_array = ['orders_id' => $insert_id,
        'title' => $order_totals[$i]['title'],
        'text' => $order_totals[$i]['text'],
        'value' => $order_totals[$i]['value'],
        'class' => $order_totals[$i]['code'],
        'sort_order' => $order_totals[$i]['sort_order']];
    tep_db_perform('orders_total', $sql_data_array);
}

$customer_notification = (SEND_EMAILS === 'true') ? '1' : '0';
$sql_data_array = ['orders_id' => $insert_id,
    'orders_status_id' => $order->info['order_status'],
    'date_added' => 'now()',
    'customer_notified' => $customer_notification,
    'comments' => $order->info['comments']];
tep_db_perform('orders_status_history', $sql_data_array);

// initialized for the email confirmation
$products_ordered = '';

for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
    // Stock Update - Joao Correia
    if (STOCK_LIMITED === 'true') {
        if (DOWNLOAD_ENABLED === 'true') {
            $stock_query_raw = "select products_quantity, pad.products_attributes_filename from products p left join products_attributes pa on p.products_id = pa.products_id left join products_attributes_download pad on pa.products_attributes_id = pad.products_attributes_id where p.products_id = '".tep_get_prid($order->products[$i]['id'])."'";
            // Will work with only one option for downloadable products
            // otherwise, we have to build the query dynamically with a loop
            $products_attributes = (isset($order->products[$i]['attributes'])) ? $order->products[$i]['attributes'] : '';

            if (\is_array($products_attributes)) {
                $stock_query_raw .= " AND pa.options_id = '".(int) $products_attributes[0]['option_id']."' AND pa.options_values_id = '".(int) $products_attributes[0]['value_id']."'";
            }

            $stock_query = tep_db_query($stock_query_raw);
        } else {
            $stock_query = tep_db_query("select products_quantity from products where products_id = '".tep_get_prid($order->products[$i]['id'])."'");
        }

        if (tep_db_num_rows($stock_query) > 0) {
            $stock_values = tep_db_fetch_array($stock_query);

            // do not decrement quantities if products_attributes_filename exists
            if ((DOWNLOAD_ENABLED !== 'true') || (!$stock_values['products_attributes_filename'])) {
                $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
            } else {
                $stock_left = $stock_values['products_quantity'];
            }

            tep_db_query("update products set products_quantity = '".(int) $stock_left."' where products_id = '".tep_get_prid($order->products[$i]['id'])."'");

            if (($stock_left < 1) && (STOCK_ALLOW_CHECKOUT === 'false')) {
                tep_db_query("update products set products_status = '0' where products_id = '".tep_get_prid($order->products[$i]['id'])."'");
            }
        }
    }

    // Update products_ordered (for bestsellers list)
    tep_db_query('update products set products_ordered = products_ordered + '.sprintf('%d', $order->products[$i]['qty'])." where products_id = '".tep_get_prid($order->products[$i]['id'])."'");

    $sql_data_array = ['orders_id' => $insert_id,
        'products_id' => tep_get_prid($order->products[$i]['id']),
        'products_model' => $order->products[$i]['model'],
        'products_name' => $order->products[$i]['name'],
        'products_price' => $order->products[$i]['price'],
        'final_price' => $order->products[$i]['final_price'],
        'products_tax' => $order->products[$i]['tax'],
        'products_quantity' => $order->products[$i]['qty']];
    tep_db_perform('orders_products', $sql_data_array);
    $order_products_id = tep_db_insert_id();

    // ------insert customer choosen option to order--------
    $attributes_exist = '0';
    $products_ordered_attributes = '';

    if (isset($order->products[$i]['attributes'])) {
        $attributes_exist = '1';

        for ($j = 0, $n2 = \count($order->products[$i]['attributes']); $j < $n2; ++$j) {
            if (DOWNLOAD_ENABLED === 'true') {
                $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount, pad.products_attributes_filename from products_options popt, products_options_values poval, products_attributes pa left join products_attributes_download pad on pa.products_attributes_id = pad.products_attributes_id where pa.products_id = '".(int) $order->products[$i]['id']."' and pa.options_id = '".(int) $order->products[$i]['attributes'][$j]['option_id']."' and pa.options_id = popt.products_options_id and pa.options_values_id = '".(int) $order->products[$i]['attributes'][$j]['value_id']."' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '".(int) $languages_id."' and poval.language_id = '".(int) $languages_id."'";
                $attributes = tep_db_query($attributes_query);
            } else {
                $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from products_options popt, products_options_values poval, products_attributes pa where pa.products_id = '".(int) $order->products[$i]['id']."' and pa.options_id = '".(int) $order->products[$i]['attributes'][$j]['option_id']."' and pa.options_id = popt.products_options_id and pa.options_values_id = '".(int) $order->products[$i]['attributes'][$j]['value_id']."' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '".(int) $languages_id."' and poval.language_id = '".(int) $languages_id."'");
            }

            $attributes_values = tep_db_fetch_array($attributes);

            $sql_data_array = ['orders_id' => $insert_id,
                'orders_products_id' => $order_products_id,
                'products_options' => $attributes_values['products_options_name'],
                'products_options_values' => $attributes_values['products_options_values_name'],
                'options_values_price' => $attributes_values['options_values_price'],
                'price_prefix' => $attributes_values['price_prefix']];
            tep_db_perform('orders_products_attributes', $sql_data_array);

            if ((DOWNLOAD_ENABLED === 'true') && isset($attributes_values['products_attributes_filename']) && !empty($attributes_values['products_attributes_filename'])) {
                $sql_data_array = ['orders_id' => $insert_id,
                    'orders_products_id' => $order_products_id,
                    'orders_products_filename' => $attributes_values['products_attributes_filename'],
                    'download_maxdays' => $attributes_values['products_attributes_maxdays'],
                    'download_count' => $attributes_values['products_attributes_maxcount']];
                tep_db_perform('orders_products_download', $sql_data_array);
            }

            $products_ordered_attributes .= "\n\t".$attributes_values['products_options_name'].' '.$attributes_values['products_options_values_name'];
        }
    }

    // ------insert customer choosen option eof ----
    $products_ordered .= $order->products[$i]['qty'].' x '.$order->products[$i]['name'].' ('.$order->products[$i]['model'].') = '.$currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']).$products_ordered_attributes."\n";
}

// lets start with the email confirmation
$email_order = STORE_NAME."\n".
               EMAIL_SEPARATOR."\n".
               EMAIL_TEXT_ORDER_NUMBER.' '.$insert_id."\n".
               EMAIL_TEXT_INVOICE_URL.' '.tep_href_link('account_history_info.php', 'order_id='.$insert_id, 'SSL', false)."\n".
               EMAIL_TEXT_DATE_ORDERED.' '.strftime(DATE_FORMAT_LONG)."\n\n";

if ($order->info['comments']) {
    $email_order .= tep_db_output($order->info['comments'])."\n\n";
}

$email_order .= EMAIL_TEXT_PRODUCTS."\n".
                EMAIL_SEPARATOR."\n".
                $products_ordered.
                EMAIL_SEPARATOR."\n";

for ($i = 0, $n = \count($order_totals); $i < $n; ++$i) {
    $email_order .= strip_tags($order_totals[$i]['title']).' '.strip_tags($order_totals[$i]['text'])."\n";
}

if ($order->content_type !== 'virtual') {
    $email_order .= "\n".EMAIL_TEXT_DELIVERY_ADDRESS."\n".
                    EMAIL_SEPARATOR."\n".
                    tep_address_label($customer_id, $sendto, 0, '', "\n")."\n";
}

$email_order .= "\n".EMAIL_TEXT_BILLING_ADDRESS."\n".
                EMAIL_SEPARATOR."\n".
                tep_address_label($customer_id, $billto, 0, '', "\n")."\n\n";

if (\is_object(${$payment})) {
    $email_order .= EMAIL_TEXT_PAYMENT_METHOD."\n".
                    EMAIL_SEPARATOR."\n";
    $payment_class = ${$payment};
    $email_order .= $order->info['payment_method']."\n\n";

    if (isset($payment_class->email_footer)) {
        $email_order .= $payment_class->email_footer."\n\n";
    }
}

tep_mail($order->customer['firstname'].' '.$order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// send emails to other people
if (!empty(SEND_EXTRA_ORDER_EMAILS_TO)) {
    tep_mail(tep_extra_emails_array(SEND_EXTRA_ORDER_EMAILS_TO), null, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
}

// load the after_process function from the payment modules
$payment_modules->after_process();

$cart->reset(true);

// unregister session variables used during checkout
unset($_SESSION['sendto'], $_SESSION['billto'], $_SESSION['shipping'], $_SESSION['payment'], $_SESSION['comments']);

tep_redirect(tep_href_link('checkout_success.php'));

require 'includes/application_bottom.php';
