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

require_once __DIR__.\DIRECTORY_SEPARATOR.'autoload.php';

/*
 * if (version_compare(PHP_VERSION, '7.2.0', '<')) {
    throw new Braintree\Exception('PHP version >= 7.2.0 required');
}

class Braintree {
    public static function requireDependencies() {
        $requiredExtensions = ['xmlwriter', 'openssl', 'dom', 'hash', 'curl'];
        foreach ($requiredExtensions AS $ext) {
            if (!extension_loaded($ext)) {
                throw new Braintree\Exception('The Braintree library requires the ' . $ext . ' extension.');
            }
        }
    }
}

Braintree::requireDependencies();
 */
