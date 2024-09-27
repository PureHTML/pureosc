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

$content = 'credentials.php';

$modules = ['PP', 'PF'];
$current_module = (isset($_GET['module']) && \in_array($_GET['module'], $modules, true) ? $_GET['module'] : $modules[0]);

$data = ['OSCOM_APP_PAYPAL_LIVE_SELLER_EMAIL',
    'OSCOM_APP_PAYPAL_LIVE_SELLER_EMAIL_PRIMARY',
    'OSCOM_APP_PAYPAL_LIVE_API_USERNAME',
    'OSCOM_APP_PAYPAL_LIVE_API_PASSWORD',
    'OSCOM_APP_PAYPAL_LIVE_API_SIGNATURE',
    'OSCOM_APP_PAYPAL_LIVE_MERCHANT_ID',
    'OSCOM_APP_PAYPAL_SANDBOX_SELLER_EMAIL',
    'OSCOM_APP_PAYPAL_SANDBOX_SELLER_EMAIL_PRIMARY',
    'OSCOM_APP_PAYPAL_SANDBOX_API_USERNAME',
    'OSCOM_APP_PAYPAL_SANDBOX_API_PASSWORD',
    'OSCOM_APP_PAYPAL_SANDBOX_API_SIGNATURE',
    'OSCOM_APP_PAYPAL_SANDBOX_MERCHANT_ID',
    'OSCOM_APP_PAYPAL_PF_LIVE_PARTNER',
    'OSCOM_APP_PAYPAL_PF_LIVE_VENDOR',
    'OSCOM_APP_PAYPAL_PF_LIVE_USER',
    'OSCOM_APP_PAYPAL_PF_LIVE_PASSWORD',
    'OSCOM_APP_PAYPAL_PF_SANDBOX_PARTNER',
    'OSCOM_APP_PAYPAL_PF_SANDBOX_VENDOR',
    'OSCOM_APP_PAYPAL_PF_SANDBOX_USER',
    'OSCOM_APP_PAYPAL_PF_SANDBOX_PASSWORD'];

foreach ($data as $key) {
    if (!\defined($key)) {
        $OSCOM_PayPal->saveParameter($key, '');
    }
}
