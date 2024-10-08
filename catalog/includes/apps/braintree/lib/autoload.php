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
