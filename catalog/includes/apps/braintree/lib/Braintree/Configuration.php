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
 * Configuration registry.
 */
class Configuration
{
    /**
     * Braintree API version to use.
     */
    public const API_VERSION = 6;
    public const GRAPHQL_API_VERSION = '2018-09-10';
    public static $global;
    private $_environment;
    private $_merchantId;
    private $_publicKey;
    private $_privateKey;
    private $_clientId;
    private $_clientSecret;
    private $_accessToken;
    private $_proxyHost;
    private $_proxyPort;
    private $_proxyType;
    private $_proxyUser;
    private $_proxyPassword;
    private $_timeout = 60;
    private $_sslVersion;
    private $_acceptGzipEncoding = true;

    public function __construct($attribs = [])
    {
        foreach ($attribs as $kind => $value) {
            if ($kind === 'environment') {
                CredentialsParser::assertValidEnvironment($value);
                $this->_environment = $value;
            }

            if ($kind === 'merchantId') {
                $this->_merchantId = $value;
            }

            if ($kind === 'publicKey') {
                $this->_publicKey = $value;
            }

            if ($kind === 'privateKey') {
                $this->_privateKey = $value;
            }

            if ($kind === 'proxyHost') {
                $this->_proxyHost = $value;
            }

            if ($kind === 'proxyPort') {
                $this->_proxyPort = $value;
            }

            if ($kind === 'proxyType') {
                $this->_proxyType = $value;
            }

            if ($kind === 'proxyUser') {
                $this->_proxyUser = $value;
            }

            if ($kind === 'proxyPassword') {
                $this->_proxyPassword = $value;
            }

            if ($kind === 'timeout') {
                $this->_timeout = $value;
            }

            if ($kind === 'sslVersion') {
                $this->_sslVersion = $value;
            }

            if ($kind === 'acceptGzipEncoding') {
                $this->_acceptGzipEncoding = $value;
            }
        }

        if (isset($attribs['clientId']) || isset($attribs['accessToken'])) {
            if (isset($attribs['environment']) || isset($attribs['merchantId']) || isset($attribs['publicKey']) || isset($attribs['privateKey'])) {
                throw new Exception\Configuration('Cannot mix OAuth credentials (clientId, clientSecret, accessToken) with key credentials (publicKey, privateKey, environment, merchantId).');
            }

            $parsedCredentials = new CredentialsParser($attribs);

            $this->_environment = $parsedCredentials->getEnvironment();
            $this->_merchantId = $parsedCredentials->getMerchantId();
            $this->_clientId = $parsedCredentials->getClientId();
            $this->_clientSecret = $parsedCredentials->getClientSecret();
            $this->_accessToken = $parsedCredentials->getAccessToken();
        }
    }

    /**
     * resets configuration to default.
     */
    public static function reset(): void
    {
        self::$global = new self();
    }

    public static function gateway()
    {
        return new Gateway(self::$global);
    }

    public static function environment($value = null)
    {
        if (empty($value)) {
            return self::$global->getEnvironment();
        }

        CredentialsParser::assertValidEnvironment($value);
        self::$global->setEnvironment($value);
    }

    public static function merchantId($value = null)
    {
        if (empty($value)) {
            return self::$global->getMerchantId();
        }

        self::$global->setMerchantId($value);
    }

    public static function publicKey($value = null)
    {
        if (empty($value)) {
            return self::$global->getPublicKey();
        }

        self::$global->setPublicKey($value);
    }

    public static function privateKey($value = null)
    {
        if (empty($value)) {
            return self::$global->getPrivateKey();
        }

        self::$global->setPrivateKey($value);
    }

    /**
     * Sets or gets the read timeout to use for making requests.
     *
     * @param int $value If provided, sets the read timeout
     *
     * @return int The read timeout used for connecting to Braintree
     */
    public static function timeout($value = null)
    {
        if (empty($value)) {
            return self::$global->getTimeout();
        }

        self::$global->setTimeout($value);
    }

    /**
     * Sets or gets the SSL version to use for making requests. See
     * https://php.net/manual/en/function.curl-setopt.php for possible
     * CURLOPT_SSLVERSION values.
     *
     * @param int $value If provided, sets the SSL version
     *
     * @return int The SSL version used for connecting to Braintree
     */
    public static function sslVersion($value = null)
    {
        if (empty($value)) {
            return self::$global->getSslVersion();
        }

        self::$global->setSslVersion($value);
    }

    /**
     * Sets or gets the proxy host to use for connecting to Braintree.
     *
     * @param string $value If provided, sets the proxy host
     *
     * @return string The proxy host used for connecting to Braintree
     */
    public static function proxyHost($value = null)
    {
        if (empty($value)) {
            return self::$global->getProxyHost();
        }

        self::$global->setProxyHost($value);
    }

    /**
     * Sets or gets the port of the proxy to use for connecting to Braintree.
     *
     * @param string $value If provided, sets the port of the proxy
     *
     * @return string The port of the proxy used for connecting to Braintree
     */
    public static function proxyPort($value = null)
    {
        if (empty($value)) {
            return self::$global->getProxyPort();
        }

        self::$global->setProxyPort($value);
    }

    /**
     * Sets or gets the proxy type to use for connecting to Braintree. This value
     * can be any of the CURLOPT_PROXYTYPE options in PHP cURL.
     *
     * @param string $value If provided, sets the proxy type
     *
     * @return string The proxy type used for connecting to Braintree
     */
    public static function proxyType($value = null)
    {
        if (empty($value)) {
            return self::$global->getProxyType();
        }

        self::$global->setProxyType($value);
    }

    /**
     * @deprecated Use isUsingInstanceProxy instead.
     * Specifies whether or not a proxy is properly configured
     *
     * @return bool true if a proxy is configured properly, false if not
     */
    public static function isUsingProxy()
    {
        // NEXT_MAJOR_VERSION Remove this method and rename isUsingInstanceProxy to isUsingProxy
        trigger_error('DEPRECATED: Use isUsingInstanceProxy instead.', \E_USER_DEPRECATED);
        $proxyHost = self::$global->getProxyHost();
        $proxyPort = self::$global->getProxyPort();

        return !empty($proxyHost) && !empty($proxyPort);
    }

    public static function proxyUser($value = null)
    {
        if (empty($value)) {
            return self::$global->getProxyUser();
        }

        self::$global->setProxyUser($value);
    }

    public static function proxyPassword($value = null)
    {
        if (empty($value)) {
            return self::$global->getProxyPassword();
        }

        self::$global->setProxyPassword($value);
    }

    /**
     * @deprecated Use isAuthenticatedInstanceProxy instead.
     * Specified whether or not a username and password have been provided for
     * use with an authenticated proxy
     *
     * @return bool true if both proxyUser and proxyPassword are present
     */
    public static function isAuthenticatedProxy()
    {
        // NEXT_MAJOR_VERSION Remove this method and rename isAuthenticatedInstanceProxy to isAuthenticatedProxy
        trigger_error('DEPRECATED: Use isAuthenticatedInstanceProxy instead.', \E_USER_DEPRECATED);
        $proxyUser = self::$global->getProxyUser();
        $proxyPwd = self::$global->getProxyPassword();

        return !empty($proxyUser) && !empty($proxyPwd);
    }

    /**
     * Specify if the HTTP client is able to decode gzipped responses.
     *
     * @param bool $value If true, will send an Accept-Encoding header with a gzip value. If false, will not send an Accept-Encoding header with a gzip value.
     *
     * @return bool true if an Accept-Encoding header with a gzip value will be sent, false if not
     */
    public static function acceptGzipEncoding($value = null)
    {
        if (null === $value) {
            return self::$global->getAcceptGzipEncoding();
        }

        self::$global->setAcceptGzipEncoding($value);
    }

    public static function assertGlobalHasAccessTokenOrKeys(): void
    {
        self::$global->assertHasAccessTokenOrKeys();
    }

    public function assertHasAccessTokenOrKeys(): void
    {
        if (empty($this->_accessToken)) {
            if (empty($this->_merchantId)) {
                throw new Exception\Configuration('Braintree\\Configuration::merchantId needs to be set (or accessToken needs to be passed to Braintree\\Gateway).');
            }

            if (empty($this->_environment)) {
                throw new Exception\Configuration('Braintree\\Configuration::environment needs to be set.');
            }

            if (empty($this->_publicKey)) {
                throw new Exception\Configuration('Braintree\\Configuration::publicKey needs to be set.');
            }

            if (empty($this->_privateKey)) {
                throw new Exception\Configuration('Braintree\\Configuration::privateKey needs to be set.');
            }
        }
    }

    public function assertHasClientCredentials(): void
    {
        $this->assertHasClientId();
        $this->assertHasClientSecret();
    }

    public function assertHasClientId(): void
    {
        if (empty($this->_clientId)) {
            throw new Exception\Configuration('clientId needs to be passed to Braintree\\Gateway.');
        }
    }

    public function assertHasClientSecret(): void
    {
        if (empty($this->_clientSecret)) {
            throw new Exception\Configuration('clientSecret needs to be passed to Braintree\\Gateway.');
        }
    }

    public function getEnvironment()
    {
        return $this->_environment;
    }

    /**
     * Do not use this method directly. Pass in the environment to the constructor.
     *
     * @param mixed $value
     */
    public function setEnvironment($value): void
    {
        $this->_environment = $value;
    }

    public function getMerchantId()
    {
        return $this->_merchantId;
    }

    /**
     * Do not use this method directly. Pass in the merchantId to the constructor.
     *
     * @param mixed $value
     */
    public function setMerchantId($value): void
    {
        $this->_merchantId = $value;
    }

    public function getPublicKey()
    {
        return $this->_publicKey;
    }

    public function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * Do not use this method directly. Pass in the publicKey to the constructor.
     *
     * @param mixed $value
     */
    public function setPublicKey($value): void
    {
        $this->_publicKey = $value;
    }

    public function getPrivateKey()
    {
        return $this->_privateKey;
    }

    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

    /**
     * Do not use this method directly. Pass in the privateKey to the constructor.
     *
     * @param mixed $value
     */
    public function setPrivateKey($value): void
    {
        $this->_privateKey = $value;
    }

    public function getProxyHost()
    {
        return $this->_proxyHost;
    }

    public function getProxyPort()
    {
        return $this->_proxyPort;
    }

    public function getProxyType()
    {
        return $this->_proxyType;
    }

    public function getProxyUser()
    {
        return $this->_proxyUser;
    }

    public function getProxyPassword()
    {
        return $this->_proxyPassword;
    }

    public function getTimeout()
    {
        return $this->_timeout;
    }

    public function getSslVersion()
    {
        return $this->_sslVersion;
    }

    public function getAcceptGzipEncoding()
    {
        return $this->_acceptGzipEncoding;
    }

    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    public function isAccessToken()
    {
        return !empty($this->_accessToken);
    }

    public function isClientCredentials()
    {
        return !empty($this->_clientId);
    }
    /**
     * returns the base braintree gateway URL based on config values.
     *
     * @param none
     *
     * @return string braintree gateway URL
     */
    public function baseUrl()
    {
        return sprintf('%s://%s:%d', $this->protocol(), $this->serverName(), $this->portNumber());
    }

    /**
     * returns the base URL for Braintree's GraphQL endpoint based on config values.
     *
     * @param none
     *
     * @return string Braintree GraphQL URL
     */
    public function graphQLBaseUrl()
    {
        return sprintf('%s://%s:%d/graphql', $this->protocol(), $this->graphQLServerName(), $this->graphQLPortNumber());
    }

    /**
     * sets the merchant path based on merchant ID.
     *
     * @param none
     *
     * @return string merchant path uri
     */
    public function merchantPath()
    {
        return '/merchants/'.$this->_merchantId;
    }

    /**
     * sets the physical path for the location of the CA certs.
     *
     * @param null|mixed $sslPath
     * @param none
     *
     * @return string filepath
     */
    public function caFile($sslPath = null)
    {
        $sslPath = $sslPath ?: \DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.
                   'ssl'.\DIRECTORY_SEPARATOR;
        $caPath = __DIR__.$sslPath.'api_braintreegateway_com.ca.crt';

        if (!file_exists($caPath)) {
            throw new Exception\SSLCaFileNotFound();
        }

        return $caPath;
    }

    /**
     * returns the port number depending on environment.
     *
     * @param none
     *
     * @return int portnumber
     */
    public function portNumber()
    {
        if ($this->sslOn()) {
            return 443;
        }

        return getenv('GATEWAY_PORT') ? getenv('GATEWAY_PORT') : 3000;
    }

    /**
     * returns the graphql port number depending on environment.
     *
     * @param none
     *
     * @return int graphql portnumber
     */
    public function graphQLPortNumber()
    {
        if ($this->sslOn()) {
            return 443;
        }

        return getenv('GRAPHQL_PORT') ?: 8080;
    }

    public function isUsingInstanceProxy()
    {
        $proxyHost = $this->getProxyHost();
        $proxyPort = $this->getProxyPort();

        return !empty($proxyHost) && !empty($proxyPort);
    }

    public function isAuthenticatedInstanceProxy()
    {
        $proxyUser = $this->getProxyUser();
        $proxyPwd = $this->getProxyPassword();

        return !empty($proxyUser) && !empty($proxyPwd);
    }

    /**
     * returns http protocol depending on environment.
     *
     * @param none
     *
     * @return string http || https
     */
    public function protocol()
    {
        return $this->sslOn() ? 'https' : 'http';
    }

    /**
     * returns gateway server name depending on environment.
     *
     * @param none
     *
     * @return string server domain name
     */
    public function serverName()
    {
        switch ($this->_environment) {
            case 'production':
                $serverName = 'api.braintreegateway.com';

                break;
            case 'qa':
                $serverName = 'gateway.qa.braintreepayments.com';

                break;
            case 'sandbox':
                $serverName = 'api.sandbox.braintreegateway.com';

                break;
            case 'development':
            case 'integration':
            default:
                $serverName = 'localhost';

                break;
        }

        return $serverName;
    }

    /**
     * returns Braintree GraphQL server name depending on environment.
     *
     * @param none
     *
     * @return string graphql domain name
     */
    public function graphQLServerName()
    {
        switch ($this->_environment) {
            case 'production':
                $graphQLServerName = 'payments.braintree-api.com';

                break;
            case 'qa':
                $graphQLServerName = 'payments-qa.dev.braintree-api.com';

                break;
            case 'sandbox':
                $graphQLServerName = 'payments.sandbox.braintree-api.com';

                break;
            case 'development':
            case 'integration':
            default:
                $graphQLServerName = 'graphql.bt.local';

                break;
        }

        return $graphQLServerName;
    }

    /**
     * returns boolean indicating SSL is on or off for this session,
     * depending on environment.
     *
     * @param none
     *
     * @return bool
     */
    public function sslOn()
    {
        switch ($this->_environment) {
            case 'integration':
            case 'development':
                $ssl = false;

                break;
            case 'production':
            case 'qa':
            case 'sandbox':
            default:
                $ssl = true;

                break;
        }

        return $ssl;
    }

    /**
     * log message to default logger.
     *
     * @param string $message
     */
    public function logMessage($message): void
    {
        error_log('[Braintree] '.$message);
    }

    private function setProxyHost($value): void
    {
        $this->_proxyHost = $value;
    }

    private function setProxyPort($value): void
    {
        $this->_proxyPort = $value;
    }

    private function setProxyType($value): void
    {
        $this->_proxyType = $value;
    }

    private function setProxyUser($value): void
    {
        $this->_proxyUser = $value;
    }

    private function setProxyPassword($value): void
    {
        $this->_proxyPassword = $value;
    }

    private function setTimeout($value): void
    {
        $this->_timeout = $value;
    }

    private function setSslVersion($value): void
    {
        $this->_sslVersion = $value;
    }

    private function setAcceptGzipEncoding($value): void
    {
        $this->_acceptGzipEncoding = $value;
    }
}
Configuration::reset();
