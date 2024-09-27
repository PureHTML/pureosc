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

$btUpdateDownloadResult = ['rpcStatus' => -1];

if (isset($_GET['v']) && is_numeric($_GET['v']) && ($_GET['v'] > $OSCOM_Braintree->getVersion())) {
    if ($OSCOM_Braintree->isWritable(DIR_FS_CATALOG.'includes/apps/braintree/work')) {
        if (!file_exists(DIR_FS_CATALOG.'includes/apps/braintree/work')) {
            mkdir(DIR_FS_CATALOG.'includes/apps/braintree/work', 0777, true);
        }

        $filepath = DIR_FS_CATALOG.'includes/apps/braintree/work/update.zip';

        if (file_exists($filepath) && is_writable($filepath)) {
            unlink($filepath);
        }

        $btUpdateDownloadFile = $OSCOM_Braintree->makeApiCall('https://apps.oscommerce.com/index.php?Download&braintree&app&2_300&'.str_replace('.', '_', $_GET['v']).'&update');

        $save_result = @file_put_contents($filepath, $btUpdateDownloadFile);

        if (($save_result !== false) && ($save_result > 0)) {
            $btUpdateDownloadResult['rpcStatus'] = 1;
        } else {
            $btUpdateDownloadResult['error'] = $OSCOM_Braintree->getDef('error_saving_download', ['filepath' => $OSCOM_Braintree->displayPath($filepath)]);
        }
    } else {
        $btUpdateDownloadResult['error'] = $OSCOM_Braintree->getDef('error_download_directory_permissions', ['filepath' => $OSCOM_Braintree->displayPath(DIR_FS_CATALOG.'includes/apps/braintree/work')]);
    }
}

echo json_encode($btUpdateDownloadResult);

exit;
