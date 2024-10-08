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

use Braintree\HttpHelpers\Curl;
use Braintree\HttpHelpers\CurlRequest;

/**
 * Braintree HTTP Client
 * processes Http requests using curl.
 */
class Http
{
    protected $_config;
    private $_useClientCredentials = false;

    public function __construct($config)
    {
        $this->_config = $config;
    }

    public function delete($path, $params = null)
    {
        $response = $this->_doRequest('DELETE', $path, $this->_buildXml($params));
        $responseCode = $response['status'];

        if ($responseCode === 200 || $responseCode === 204) {
            return true;
        }

        if ($responseCode === 422) {
            return Xml::buildArrayFromXml($response['body']);
        }

        Util::throwStatusCodeException($response['status']);
    }

    public function get($path)
    {
        $response = $this->_doRequest('GET', $path);

        if ($response['status'] === 200) {
            return Xml::buildArrayFromXml($response['body']);
        }

        Util::throwStatusCodeException($response['status']);
    }

    public function post($path, $params = null)
    {
        $response = $this->_doRequest('POST', $path, $this->_buildXml($params));
        $responseCode = $response['status'];

        if ($responseCode === 200 || $responseCode === 201 || $responseCode === 422 || $responseCode === 400) {
            return Xml::buildArrayFromXml($response['body']);
        }

        Util::throwStatusCodeException($responseCode);
    }

    public function postMultipart($path, $params, $file)
    {
        $headers = [
            'User-Agent: Braintree PHP Library '.Version::get(),
            'X-ApiVersion: '.Configuration::API_VERSION,
        ];
        $response = $this->_doRequest('POST', $path, $params, $file, $headers);
        $responseCode = $response['status'];

        if ($responseCode === 200 || $responseCode === 201 || $responseCode === 422 || $responseCode === 400) {
            return Xml::buildArrayFromXml($response['body']);
        }

        Util::throwStatusCodeException($responseCode);
    }

    public function put($path, $params = null)
    {
        $response = $this->_doRequest('PUT', $path, $this->_buildXml($params));
        $responseCode = $response['status'];

        if ($responseCode === 200 || $responseCode === 201 || $responseCode === 422 || $responseCode === 400) {
            return Xml::buildArrayFromXml($response['body']);
        }

        Util::throwStatusCodeException($responseCode);
    }

    public function useClientCredentials(): void
    {
        $this->_useClientCredentials = true;
    }

    public function _doUrlRequest($httpVerb, $url, $requestBody = null, $file = null, $customHeaders = null)
    {
        $curlRequest = new CurlRequest($url);

        return Curl::makeRequest($httpVerb, $url, $this->_config, $curlRequest, $requestBody, $file, $customHeaders, $this->_useClientCredentials);
    }

    private function _buildXml($params)
    {
        return empty($params) ? null : Xml::buildXmlFromArray($params);
    }

    private function _doRequest($httpVerb, $path, $requestBody = null, $file = null, $headers = null)
    {
        return $this->_doUrlRequest($httpVerb, $this->_config->baseUrl().$path, $requestBody, $file, $headers);
    }
}
