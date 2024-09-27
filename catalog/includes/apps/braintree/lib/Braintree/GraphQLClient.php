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
 * Braintree GraphQL Client
 * process GraphQL requests using curl.
 */
class GraphQLClient
{
    public function __construct($config)
    {
        $this->_service = new GraphQL($config);
    }

    public function query($definition, $variables = null)
    {
        return $this->_service->request($definition, $variables);
    }
}
