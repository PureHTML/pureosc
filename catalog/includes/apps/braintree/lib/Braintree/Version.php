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

namespace Braintree;

/**
 * Braintree Library Version
 * stores version information about the Braintree library.
 */
class Version
{
    /**
     * class constants.
     */
    public const MAJOR = 5;
    public const MINOR = 5;
    public const TINY = 0;

    /**
     * @ignore
     */
    protected function __construct()
    {
    }

    /**
     * @return string the current library version
     */
    public static function get()
    {
        return self::MAJOR.'.'.self::MINOR.'.'.self::TINY;
    }
}
