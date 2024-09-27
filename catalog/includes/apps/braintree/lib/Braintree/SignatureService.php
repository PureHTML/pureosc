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
