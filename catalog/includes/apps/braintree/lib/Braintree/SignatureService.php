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

namespace Braintree;

class SignatureService
{
    public function __construct($key, $digest)
    {
        $this->key = $key;
        $this->digest = $digest;
    }

    public function sign($payload)
    {
        return $this->hash($payload).'|'.$payload;
    }

    public function hash($data)
    {
        return \call_user_func($this->digest, $this->key, $data);
    }
}
