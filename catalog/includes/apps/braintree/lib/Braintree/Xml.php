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

namespace Braintree;

/**
 * Braintree Xml parser and generator
 * superclass for Braintree XML parsing and generation.
 */
class Xml
{
    /**
     * @ignore
     */
    protected function __construct()
    {
    }

    /**
     * @param string $xml
     *
     * @return array
     */
    public static function buildArrayFromXml($xml)
    {
        return Xml\Parser::arrayFromXml($xml);
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public static function buildXmlFromArray($array)
    {
        return Xml\Generator::arrayToXml($array);
    }
}
