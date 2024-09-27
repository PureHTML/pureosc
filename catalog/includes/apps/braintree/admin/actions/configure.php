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

$content = 'configure.php';

$modules = $OSCOM_Braintree->getModules();
$modules[] = 'G';

if (!$OSCOM_Braintree->isInstalled('CC')) {
    $OSCOM_Braintree->install('CC');
}

$default_module = 'G';

foreach ($modules as $m) {
    if ($OSCOM_Braintree->isInstalled($m)) {
        $default_module = $m;

        break;
    }
}

$current_module = (isset($_GET['module']) && \in_array($_GET['module'], $modules, true)) ? $_GET['module'] : $default_module;

if (!\defined('OSCOM_APP_PAYPAL_BRAINTREE_VERIFY_SSL')) {
    $OSCOM_Braintree->saveParameter('OSCOM_APP_PAYPAL_BRAINTREE_VERIFY_SSL', '1');
}

if (!\defined('OSCOM_APP_PAYPAL_BRAINTREE_PROXY')) {
    $OSCOM_Braintree->saveParameter('OSCOM_APP_PAYPAL_BRAINTREE_PROXY', '');
}
