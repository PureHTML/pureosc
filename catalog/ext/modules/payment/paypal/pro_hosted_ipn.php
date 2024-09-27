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
