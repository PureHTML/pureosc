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

$btUpdateLogResult = ['rpcStatus' => -1];

if (isset($_GET['v']) && is_numeric($_GET['v']) && file_exists(DIR_FS_CATALOG.'includes/apps/braintree/work/update_log-'.basename($_GET['v']).'.php')) {
    $btUpdateLogResult['rpcStatus'] = 1;
    $btUpdateLogResult['log'] = file_get_contents(DIR_FS_CATALOG.'includes/apps/braintree/work/update_log-'.basename($_GET['v']).'.php');
}

echo json_encode($btUpdateLogResult);

exit;
