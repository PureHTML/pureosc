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

$data = ['OSCOM_APP_PAYPAL_BRAINTREE_MERCHANT_ID' => isset($_POST['live_merchant_id']) ? tep_db_prepare_input($_POST['live_merchant_id']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_PRIVATE_KEY' => isset($_POST['live_private_key']) ? tep_db_prepare_input($_POST['live_private_key']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_PUBLIC_KEY' => isset($_POST['live_public_key']) ? tep_db_prepare_input($_POST['live_public_key']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_CURRENCIES_MA' => isset($_POST['live_currencies_ma']) ? tep_db_prepare_input($_POST['live_currencies_ma']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_MERCHANT_ID' => isset($_POST['sandbox_merchant_id']) ? tep_db_prepare_input($_POST['sandbox_merchant_id']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_PRIVATE_KEY' => isset($_POST['sandbox_private_key']) ? tep_db_prepare_input($_POST['sandbox_private_key']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_PUBLIC_KEY' => isset($_POST['sandbox_public_key']) ? tep_db_prepare_input($_POST['sandbox_public_key']) : '',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_CURRENCIES_MA' => isset($_POST['sandbox_currencies_ma']) ? tep_db_prepare_input($_POST['sandbox_currencies_ma']) : ''];

foreach ($data as $key => $value) {
    $OSCOM_Braintree->saveParameter($key, $value);
}

$OSCOM_Braintree->addAlert($OSCOM_Braintree->getDef('alert_credentials_saved_success'), 'success');

tep_redirect(tep_href_link('braintree.php', 'action=credentials'));
