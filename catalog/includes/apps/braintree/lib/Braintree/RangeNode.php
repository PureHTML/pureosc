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

class RangeNode
{
    public function __construct($name)
    {
        $this->name = $name;
        $this->searchTerms = [];
    }

    public function greaterThanOrEqualTo($value)
    {
        $this->searchTerms['min'] = $value;

        return $this;
    }

    public function lessThanOrEqualTo($value)
    {
        $this->searchTerms['max'] = $value;

        return $this;
    }

    public function is($value)
    {
        $this->searchTerms['is'] = $value;

        return $this;
    }

    public function between($min, $max)
    {
        return $this->greaterThanOrEqualTo($min)->lessThanOrEqualTo($max);
    }

    public function toParam()
    {
        return $this->searchTerms;
    }
}
