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

class PartialMatchNode extends EqualityNode
{
    public function startsWith($value)
    {
        $this->searchTerms['starts_with'] = (string) $value;

        return $this;
    }

    public function endsWith($value)
    {
        $this->searchTerms['ends_with'] = (string) $value;

        return $this;
    }
}
