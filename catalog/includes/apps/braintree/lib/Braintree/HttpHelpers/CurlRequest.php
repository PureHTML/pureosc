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

namespace Braintree\HttpHelpers;

class CurlRequest implements HttpRequest
{
    private $_handle;

    public function __construct($url)
    {
        $this->_handle = curl_init($url);
    }

    public function setOption($name, $value): void
    {
        curl_setopt($this->_handle, $name, $value);
    }

    public function execute()
    {
        return curl_exec($this->_handle);
    }

    public function getInfo($name)
    {
        return curl_getinfo($this->_handle, $name);
    }

    public function getErrorCode()
    {
        return curl_errno($this->_handle);
    }

    public function getError()
    {
        return curl_error($this->_handle);
    }

    public function close(): void
    {
        curl_close($this->_handle);
    }
}
