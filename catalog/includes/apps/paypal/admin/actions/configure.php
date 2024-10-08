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

$content = 'configure.php';

$modules = $OSCOM_PayPal->getModules();
$modules[] = 'G';

$default_module = 'G';

foreach ($modules as $m) {
    if ($OSCOM_PayPal->isInstalled($m)) {
        $default_module = $m;

        break;
    }
}

$current_module = (isset($_GET['module']) && \in_array($_GET['module'], $modules, true)) ? $_GET['module'] : $default_module;

if (!\defined('OSCOM_APP_PAYPAL_TRANSACTIONS_ORDER_STATUS_ID')) {
    $check_query = tep_db_query("SELECT orders_status_id FROM orders_status WHERE orders_status_name = 'PayPal [Transactions]' LIMIT 1");

    if (tep_db_num_rows($check_query) < 1) {
        $status_query = tep_db_query('SELECT MAX(orders_status_id) AS status_id FROM orders_status');
        $status = tep_db_fetch_array($status_query);

        $status_id = $status['status_id'] + 1;

        $languages = tep_get_languages();

        foreach ($languages as $lang) {
            tep_db_query("insert into orders_status (orders_status_id, language_id, orders_status_name) values ('".$status_id."', '".$lang['id']."', 'PayPal [Transactions]')");
        }

        $flags_query = tep_db_query('describe orders_status public_flag');

        if (tep_db_num_rows($flags_query) === 1) {
            tep_db_query("update orders_status set public_flag = 0 and downloads_flag = 0 where orders_status_id = '".(int) $status_id."'");
        }
    } else {
        $check = tep_db_fetch_array($check_query);

        $status_id = $check['orders_status_id'];
    }

    $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_TRANSACTIONS_ORDER_STATUS_ID', $status_id);
}

if (!\defined('OSCOM_APP_PAYPAL_VERIFY_SSL')) {
    $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_VERIFY_SSL', '1');
}

if (!\defined('OSCOM_APP_PAYPAL_PROXY')) {
    $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_PROXY', '');
}

if (!\defined('OSCOM_APP_PAYPAL_GATEWAY')) {
    $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_GATEWAY', '1');
}

if (!\defined('OSCOM_APP_PAYPAL_LOG_TRANSACTIONS')) {
    $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOG_TRANSACTIONS', '1');
}
