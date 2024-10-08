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

require DIR_FS_ADMIN.'includes/classes/currencies.php';
$currencies = new currencies();

$ppBalanceResult = ['rpcStatus' => -1];

if (isset($_GET['type']) && \in_array($_GET['type'], ['live', 'sandbox'], true)) {
    $ppBalanceResponse = $OSCOM_PayPal->getApiResult('APP', 'GetBalance', null, $_GET['type']);

    if (\is_array($ppBalanceResponse) && isset($ppBalanceResponse['ACK']) && ($ppBalanceResponse['ACK'] === 'Success')) {
        $ppBalanceResult['rpcStatus'] = 1;

        $counter = 0;

        while (true) {
            if (isset($ppBalanceResponse['L_AMT'.$counter], $ppBalanceResponse['L_CURRENCYCODE'.$counter])) {
                $balance = $ppBalanceResponse['L_AMT'.$counter];

                if (isset($currencies->currencies[$ppBalanceResponse['L_CURRENCYCODE'.$counter]])) {
                    $balance = $currencies->format($balance, false, $ppBalanceResponse['L_CURRENCYCODE'.$counter]);
                }

                $ppBalanceResult['balance'][$ppBalanceResponse['L_CURRENCYCODE'.$counter]] = $balance;

                ++$counter;
            } else {
                break;
            }
        }
    }
}

if (\function_exists('json_encode')) {
    echo json_encode($ppBalanceResult);
} else {
    $ppBalanceResultCompat = 'rpcStatus='.$ppBalanceResult['rpcStatus']."\n";

    if (isset($ppBalanceResult['balance'])) {
        foreach ($ppBalanceResult['balance'] as $key => $value) {
            $ppBalanceResultCompat .= $key.'='.$value."\n";
        }
    }

    echo trim($ppBalanceResultCompat);
}

exit;
