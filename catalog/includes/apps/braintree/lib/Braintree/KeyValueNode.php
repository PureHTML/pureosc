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

class KeyValueNode
{
    public function __construct($name)
    {
        $this->name = $name;
        $this->searchTerm = true;
    }

    public function is($value)
    {
        $this->searchTerm = $value;

        return $this;
    }

    public function toParam()
    {
        return $this->searchTerm;
    }
}
