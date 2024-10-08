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

if ($current_module === 'G') {
    $cut = 'OSCOM_APP_PAYPAL_';
} else {
    $cut = 'OSCOM_APP_PAYPAL_'.$current_module.'_';
}

$cut_length = \strlen($cut);

foreach ($OSCOM_PayPal->getParameters($current_module) as $key) {
    $p = strtolower(substr($key, $cut_length));

    if (isset($_POST[$p])) {
        $OSCOM_PayPal->saveParameter($key, $_POST[$p]);
    }
}

$OSCOM_PayPal->addAlert($OSCOM_PayPal->getDef('alert_cfg_saved_success'), 'success');

tep_redirect(tep_href_link('paypal.php', 'action=configure&module='.$current_module));
