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

$ppUpdateDownloadResult = ['rpcStatus' => -1];

if (isset($_GET['v']) && is_numeric($_GET['v']) && ($_GET['v'] > $OSCOM_PayPal->getVersion())) {
    if ($OSCOM_PayPal->isWritable(DIR_FS_CATALOG.'includes/apps/paypal/work')) {
        if (!file_exists(DIR_FS_CATALOG.'includes/apps/paypal/work')) {
            mkdir(DIR_FS_CATALOG.'includes/apps/paypal/work', 0777, true);
        }

        $filepath = DIR_FS_CATALOG.'includes/apps/paypal/work/update.zip';

        if (file_exists($filepath) && is_writable($filepath)) {
            unlink($filepath);
        }

        $ppUpdateDownloadFile = $OSCOM_PayPal->makeApiCall('https://apps.oscommerce.com/index.php?Download&paypal&app&2_300&'.str_replace('.', '_', $_GET['v']).'&update');

        $save_result = @file_put_contents($filepath, $ppUpdateDownloadFile);

        if (($save_result !== false) && ($save_result > 0)) {
            $ppUpdateDownloadResult['rpcStatus'] = 1;
        } else {
            $ppUpdateDownloadResult['error'] = $OSCOM_PayPal->getDef('error_saving_download', ['filepath' => $OSCOM_PayPal->displayPath($filepath)]);
        }
    } else {
        $ppUpdateDownloadResult['error'] = $OSCOM_PayPal->getDef('error_download_directory_permissions', ['filepath' => $OSCOM_PayPal->displayPath(DIR_FS_CATALOG.'includes/apps/paypal/work')]);
    }
}

echo json_encode($ppUpdateDownloadResult);

exit;
