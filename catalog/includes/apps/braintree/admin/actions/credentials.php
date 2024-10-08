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

$content = 'credentials.php';

$data = ['OSCOM_APP_PAYPAL_BRAINTREE_MERCHANT_ID',
    'OSCOM_APP_PAYPAL_BRAINTREE_PRIVATE_KEY',
    'OSCOM_APP_PAYPAL_BRAINTREE_PUBLIC_KEY',
    'OSCOM_APP_PAYPAL_BRAINTREE_CURRENCIES_MA',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_MERCHANT_ID',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_PRIVATE_KEY',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_PUBLIC_KEY',
    'OSCOM_APP_PAYPAL_BRAINTREE_SANDBOX_CURRENCIES_MA'];

foreach ($data as $key) {
    if (!\defined($key)) {
        $OSCOM_Braintree->saveParameter($key, '');
    }
}
