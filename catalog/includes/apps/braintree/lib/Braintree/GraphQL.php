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
 * Braintree GraphQL service
 * process GraphQL requests using curl.
 */
class GraphQL extends Http
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function graphQLHeaders()
    {
        return [
            'Accept: application/json',
            'Braintree-Version: '.Configuration::GRAPHQL_API_VERSION,
            'Content-Type: application/json',
            'User-Agent: Braintree PHP Library '.Version::get(),
            'X-ApiVersion: '.Configuration::API_VERSION,
        ];
    }

    public function request($definition, $variables = null)
    {
        $graphQLRequest = ['query' => $definition];

        if ($variables) {
            $graphQLRequest['variables'] = $variables;
        }

        $response = $this->_doUrlRequest('POST', $this->_config->graphQLBaseUrl(), json_encode($graphQLRequest), null, $this->graphQLHeaders());

        $result = json_decode($response['body'], true);
        Util::throwGraphQLResponseException($result);

        return $result;
    }
}
