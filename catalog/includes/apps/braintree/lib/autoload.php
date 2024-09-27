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

spl_autoload_register(function ($className): void {
    if (strpos($className, 'Braintree') !== 0) {
        return;
    }

    $fileName = \dirname(__DIR__).'/lib/';

    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName .= str_replace('\\', \DIRECTORY_SEPARATOR, $namespace).\DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', \DIRECTORY_SEPARATOR, $className).'.php';

    if (is_file($fileName)) {
        require_once $fileName;
    }
});
