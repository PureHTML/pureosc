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

class MultipleValueOrTextNode extends MultipleValueNode
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->textNode = new TextNode($name);
    }

    public function contains($value)
    {
        $this->textNode->contains($value);

        return $this;
    }

    public function endsWith($value)
    {
        $this->textNode->endsWith($value);

        return $this;
    }

    public function is($value)
    {
        $this->textNode->is($value);

        return $this;
    }

    public function isNot($value)
    {
        $this->textNode->isNot($value);

        return $this;
    }

    public function startsWith($value)
    {
        $this->textNode->startsWith($value);

        return $this;
    }

    public function toParam()
    {
        return array_merge(parent::toParam(), $this->textNode->toParam());
    }
}
