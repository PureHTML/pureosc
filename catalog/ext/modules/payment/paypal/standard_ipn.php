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

chdir('../../../../');

require 'includes/application_top.php';

if (!\defined('OSCOM_APP_PAYPAL_PS_STATUS') || !\in_array(OSCOM_APP_PAYPAL_PS_STATUS, ['1', '0'], true)) {
    exit;
}

require 'includes/modules/payment/paypal_standard.php';

$paypal_standard = new paypal_standard();

require DIR_FS_CATALOG.'includes/languages/'.$language.'/checkout_process.php';

$result = false;

$seller_accounts = [$paypal_standard->_app->getCredentials('PS', 'email')];

if (!empty($paypal_standard->_app->getCredentials('PS', 'email_primary'))) {
    $seller_accounts[] = $paypal_standard->_app->getCredentials('PS', 'email_primary');
}

if ((isset($_POST['receiver_email']) && \in_array($_POST['receiver_email'], $seller_accounts, true)) || (isset($_POST['business']) && \in_array($_POST['business'], $seller_accounts, true))) {
    $parameters = 'cmd=_notify-validate&';

    foreach ($_POST as $key => $value) {
        if ($key !== 'cmd') {
            $parameters .= $key.'='.urlencode(stripslashes($value)).'&';
        }
    }

    $parameters = substr($parameters, 0, -1);

    $result = $paypal_standard->_app->makeApiCall($paypal_standard->form_action_url, $parameters);
}

$log_params = [];

foreach ($_POST as $key => $value) {
    $log_params[$key] = stripslashes($value);
}

foreach ($_GET as $key => $value) {
    $log_params['GET '.$key] = stripslashes($value);
}

$paypal_standard->_app->log('PS', '_notify-validate', ($result === 'VERIFIED') ? 1 : -1, $log_params, $result, (OSCOM_APP_PAYPAL_PS_STATUS === '1') ? 'live' : 'sandbox', true);

if ($result === 'VERIFIED') {
    $paypal_standard->verifyTransaction($_POST, true);

    $order_id = (int) $_POST['invoice'];
    $customer_id = (int) $_POST['custom'];

    $check_query = tep_db_query("select orders_status from orders where orders_id = '".(int) $order_id."' and customers_id = '".(int) $customer_id."'");

    if (tep_db_num_rows($check_query)) {
        $check = tep_db_fetch_array($check_query);

        if ($check['orders_status'] === OSCOM_APP_PAYPAL_PS_PREPARE_ORDER_STATUS_ID) {
            $new_order_status = DEFAULT_ORDERS_STATUS_ID;

            if (OSCOM_APP_PAYPAL_PS_ORDER_STATUS_ID > 0) {
                $new_order_status = OSCOM_APP_PAYPAL_PS_ORDER_STATUS_ID;
            }

            tep_db_query("update orders set orders_status = '".(int) $new_order_status."', last_modified = now() where orders_id = '".(int) $order_id."'");

            $sql_data_array = ['orders_id' => $order_id,
                'orders_status_id' => (int) $new_order_status,
                'date_added' => 'now()',
                'customer_notified' => (SEND_EMAILS === 'true') ? '1' : '0',
                'comments' => ''];

            tep_db_perform('orders_status_history', $sql_data_array);

            include DIR_FS_CATALOG.'includes/classes/order.php';
            $order = new order($order_id);

            if (DOWNLOAD_ENABLED === 'true') {
                for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
                    $downloads_query = tep_db_query("select opd.orders_products_filename from orders o, orders_products op, orders_products_download opd where o.orders_id = '".(int) $order_id."' and o.customers_id = '".(int) $customer_id."' and o.orders_id = op.orders_id and op.orders_products_id = opd.orders_products_id and opd.orders_products_filename != ''");

                    if (tep_db_num_rows($downloads_query)) {
                        if ($order->content_type === 'physical') {
                            $order->content_type = 'mixed';

                            break;
                        }

                        $order->content_type = 'virtual';
                    } else {
                        if ($order->content_type === 'virtual') {
                            $order->content_type = 'mixed';

                            break;
                        }

                        $order->content_type = 'physical';
                    }
                }
            } else {
                $order->content_type = 'physical';
            }

            // initialized for the email confirmation
            $products_ordered = '';

            for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
                if (STOCK_LIMITED === 'true') {
                    $stock_query = tep_db_query("select products_quantity from products where products_id = '".tep_get_prid($order->products[$i]['id'])."'");
                    $stock_values = tep_db_fetch_array($stock_query);

                    $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];

                    if (DOWNLOAD_ENABLED === 'true') {
                        $downloads_query = tep_db_query("select opd.orders_products_filename from orders o, orders_products op, orders_products_download opd where o.orders_id = '".(int) $order_id."' and o.customers_id = '".(int) $customer_id."' and o.orders_id = op.orders_id and op.orders_products_id = opd.orders_products_id and opd.orders_products_filename != ''");
                        $downloads_values = tep_db_fetch_array($downloads_query);

                        if (tep_db_num_rows($downloads_query)) {
                            $stock_left = $stock_values['products_quantity'];
                        }
                    }

                    if ($stock_values['products_quantity'] !== $stock_left) {
                        tep_db_query("update products set products_quantity = '".(int) $stock_left."' where products_id = '".tep_get_prid($order->products[$i]['id'])."'");

                        if (($stock_left < 1) && (STOCK_ALLOW_CHECKOUT === 'false')) {
                            tep_db_query("update products set products_status = '0' where products_id = '".tep_get_prid($order->products[$i]['id'])."'");
                        }
                    }
                }

                // Update products_ordered (for bestsellers list)
                tep_db_query('update products set products_ordered = products_ordered + '.sprintf('%d', $order->products[$i]['qty'])." where products_id = '".tep_get_prid($order->products[$i]['id'])."'");

                if (isset($order->products[$i]['attributes'])) {
                    for ($j = 0, $n2 = \count($order->products[$i]['attributes']); $j < $n2; ++$j) {
                        $products_ordered_attributes .= "\n\t".$order->products[$i]['attributes'][$j]['option'].' '.$order->products[$i]['attributes'][$j]['value'];
                    }
                }

                // ------insert customer choosen option eof ----
                $products_ordered .= $order->products[$i]['qty'].' x '.$order->products[$i]['name'].' ('.$order->products[$i]['model'].') = '.$currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']).$products_ordered_attributes."\n";
            }

            // lets start with the email confirmation
            $email_order = STORE_NAME."\n".
                           EMAIL_SEPARATOR."\n".
                           EMAIL_TEXT_ORDER_NUMBER.' '.$order_id."\n".
                           EMAIL_TEXT_INVOICE_URL.' '.tep_href_link('account_history_info.php', 'order_id='.$order_id, 'SSL', false)."\n".
                           EMAIL_TEXT_DATE_ORDERED.' '.strftime(DATE_FORMAT_LONG)."\n\n";

            if ($order->info['comments']) {
                $email_order .= tep_db_output($order->info['comments'])."\n\n";
            }

            $email_order .= EMAIL_TEXT_PRODUCTS."\n".
                            EMAIL_SEPARATOR."\n".
                            $products_ordered.
                            EMAIL_SEPARATOR."\n";

            for ($i = 0, $n = \count($order->totals); $i < $n; ++$i) {
                $email_order .= strip_tags($order->totals[$i]['title']).' '.strip_tags($order->totals[$i]['text'])."\n";
            }

            if ($order->content_type !== 'virtual') {
                $email_order .= "\n".EMAIL_TEXT_DELIVERY_ADDRESS."\n".
                                EMAIL_SEPARATOR."\n".
                                tep_address_format($order->delivery['format_id'], $order->delivery, false, '', "\n")."\n";
            }

            $email_order .= "\n".EMAIL_TEXT_BILLING_ADDRESS."\n".
                            EMAIL_SEPARATOR."\n".
                            tep_address_format($order->billing['format_id'], $order->billing, false, '', "\n")."\n\n";

            $email_order .= EMAIL_TEXT_PAYMENT_METHOD."\n".
                            EMAIL_SEPARATOR."\n".
                            $paypal_standard->title."\n\n";

            if ($paypal_standard->email_footer) {
                $email_order .= $paypal_standard->email_footer."\n\n";
            }

            tep_mail($order->customer['name'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

            // send emails to other people
            if (!empty(SEND_EXTRA_ORDER_EMAILS_TO)) {
                tep_mail(tep_extra_emails_array(SEND_EXTRA_ORDER_EMAILS_TO), null, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            }

            tep_db_query("delete from customers_basket where customers_id = '".(int) $customer_id."'");
            tep_db_query("delete from customers_basket_attributes where customers_id = '".(int) $customer_id."'");
        }
    }
}

tep_session_destroy();

require 'includes/application_bottom.php';
