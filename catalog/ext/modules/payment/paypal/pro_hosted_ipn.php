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

if (!\defined('OSCOM_APP_PAYPAL_HS_STATUS') || !\in_array(OSCOM_APP_PAYPAL_HS_STATUS, ['1', '0'], true)) {
    exit;
}

require 'includes/modules/payment/paypal_pro_hs.php';

$result = false;

if (isset($_POST['txn_id']) && !empty($_POST['txn_id'])) {
    $paypal_pro_hs = new paypal_pro_hs();

    $result = $paypal_pro_hs->_app->getApiResult('APP', 'GetTransactionDetails', ['TRANSACTIONID' => $_POST['txn_id']], (OSCOM_APP_PAYPAL_HS_STATUS === '1') ? 'live' : 'sandbox', true);
}

if (\is_array($result) && isset($result['ACK']) && (($result['ACK'] === 'Success') || ($result['ACK'] === 'SuccessWithWarning'))) {
    $pphs_result = $result;

    $paypal_pro_hs->verifyTransaction(true);
}

require 'includes/application_bottom.php';
