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

class MultipleValueNode
{
    public function __construct($name, $allowedValues = [])
    {
        $this->name = $name;
        $this->items = [];
        $this->allowedValues = $allowedValues;
    }

    public function in($values)
    {
        $bad_values = array_diff($values, $this->allowedValues);

        if (\count($this->allowedValues) > 0 && \count($bad_values) > 0) {
            $message = 'Invalid argument(s) for '.$this->name.':';

            foreach ($bad_values as $bad_value) {
                $message .= ' '.$bad_value;
            }

            throw new \InvalidArgumentException($message);
        }

        $this->items = $values;

        return $this;
    }

    public function is($value)
    {
        return $this->in([$value]);
    }

    public function toParam()
    {
        return $this->items;
    }
}
