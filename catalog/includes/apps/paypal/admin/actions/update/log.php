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

$ppUpdateLogResult = ['rpcStatus' => -1];

if (isset($_GET['v']) && is_numeric($_GET['v']) && file_exists(DIR_FS_CATALOG.'includes/apps/paypal/work/update_log-'.basename($_GET['v']).'.php')) {
    $ppUpdateLogResult['rpcStatus'] = 1;
    $ppUpdateLogResult['log'] = file_get_contents(DIR_FS_CATALOG.'includes/apps/paypal/work/update_log-'.basename($_GET['v']).'.php');
}

echo json_encode($ppUpdateLogResult);

exit;
