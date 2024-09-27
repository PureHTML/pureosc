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

if ($current_module === 'G') {
    $cut = 'OSCOM_APP_PAYPAL_BRAINTREE_';
} else {
    $cut = 'OSCOM_APP_PAYPAL_BRAINTREE_'.$current_module.'_';
}

$cut_length = \strlen($cut);

foreach ($OSCOM_Braintree->getParameters($current_module) as $key) {
    $p = strtolower(substr($key, $cut_length));

    if (isset($_POST[$p])) {
        $OSCOM_Braintree->saveParameter($key, $_POST[$p]);
    }
}

$OSCOM_Braintree->addAlert($OSCOM_Braintree->getDef('alert_cfg_saved_success'), 'success');

tep_redirect(tep_href_link('braintree.php', 'action=configure&module='.$current_module));
