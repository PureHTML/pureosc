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
 * CredentialsParser registry.
 */
class CredentialsParser
{
    private $_clientId;
    private $_clientSecret;
    private $_accessToken;
    private $_environment;
    private $_merchantId;

    /**
     * @static
     *
     * @var array valid environments, used for validation
     */
    private static array $_validEnvironments = [
        'development',
        'integration',
        'sandbox',
        'production',
        'qa',
    ];

    public function __construct($attribs)
    {
        foreach ($attribs as $kind => $value) {
            if ($kind === 'clientId') {
                $this->_clientId = $value;
            }

            if ($kind === 'clientSecret') {
                $this->_clientSecret = $value;
            }

            if ($kind === 'accessToken') {
                $this->_accessToken = $value;
            }
        }

        $this->parse();
    }

    public function parse(): void
    {
        $environments = [];

        if (!empty($this->_clientId)) {
            $environments[] = ['clientId', $this->_parseClientCredential('clientId', $this->_clientId, 'client_id')];
        }

        if (!empty($this->_clientSecret)) {
            $environments[] = ['clientSecret', $this->_parseClientCredential('clientSecret', $this->_clientSecret, 'client_secret')];
        }

        if (!empty($this->_accessToken)) {
            $environments[] = ['accessToken', $this->_parseAccessToken()];
        }

        $checkEnv = $environments[0];

        foreach ($environments as $env) {
            if ($env[1] !== $checkEnv[1]) {
                throw new Exception\Configuration(
                    'Mismatched credential environments: '.$checkEnv[0].' environment is '.$checkEnv[1].
                    ' and '.$env[0].' environment is '.$env[1],
                );
            }
        }

        self::assertValidEnvironment($checkEnv[1]);
        $this->_environment = $checkEnv[1];
    }

    public static function assertValidEnvironment($environment): void
    {
        if (!\in_array($environment, self::$_validEnvironments, true)) {
            throw new Exception\Configuration('"'.
                                    $environment.'" is not a valid environment.');
        }
    }

    public function getClientId()
    {
        return $this->_clientId;
    }

    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    public function getEnvironment()
    {
        return $this->_environment;
    }

    public function getMerchantId()
    {
        return $this->_merchantId;
    }

    private function _parseClientCredential($credentialType, $value, $expectedValuePrefix)
    {
        $explodedCredential = explode('$', $value);

        if (\count($explodedCredential) !== 3) {
            throw new Exception\Configuration('Incorrect '.$credentialType.' format. Expected: type$environment$token');
        }

        $gotValuePrefix = $explodedCredential[0];
        $environment = $explodedCredential[1];
        $token = $explodedCredential[2];

        if ($gotValuePrefix !== $expectedValuePrefix) {
            throw new Exception\Configuration('Value passed for '.$credentialType.' is not a '.$credentialType);
        }

        return $environment;
    }

    private function _parseAccessToken()
    {
        $accessTokenExploded = explode('$', $this->_accessToken);

        if (\count($accessTokenExploded) !== 4) {
            throw new Exception\Configuration('Incorrect accessToken syntax. Expected: type$environment$merchant_id$token');
        }

        $gotValuePrefix = $accessTokenExploded[0];
        $environment = $accessTokenExploded[1];
        $merchantId = $accessTokenExploded[2];
        $token = $accessTokenExploded[3];

        if ($gotValuePrefix !== 'access_token') {
            throw new Exception\Configuration('Value passed for accessToken is not an accessToken');
        }

        $this->_merchantId = $merchantId;

        return $environment;
    }
}
