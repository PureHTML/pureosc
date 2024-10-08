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

class WebhookNotificationGateway
{
    public function __construct($gateway)
    {
        $this->config = $gateway->config;
        $this->config->assertHasAccessTokenOrKeys();
    }

    public function parse($signature, $payload)
    {
        if (null === $signature) {
            throw new Exception\InvalidSignature('signature cannot be null');
        }

        if (null === $payload) {
            throw new Exception\InvalidSignature('payload cannot be null');
        }

        if (preg_match("/[^A-Za-z0-9+=\\/\n]/", $payload) === 1) {
            throw new Exception\InvalidSignature('payload contains illegal characters');
        }

        self::_validateSignature($signature, $payload);

        $xml = base64_decode($payload, true);
        $attributes = Xml::buildArrayFromXml($xml);

        return WebhookNotification::factory($attributes['notification']);
    }

    public function verify($challenge)
    {
        if (!preg_match('/^[a-f0-9]{20,32}$/', $challenge)) {
            throw new Exception\InvalidChallenge('challenge contains non-hex characters');
        }

        $publicKey = $this->config->getPublicKey();
        $digest = Digest::hexDigestSha1($this->config->getPrivateKey(), $challenge);

        return "{$publicKey}|{$digest}";
    }

    private function _payloadMatches($signature, $payload)
    {
        $payloadSignature = Digest::hexDigestSha1($this->config->getPrivateKey(), $payload);

        return Digest::secureCompare($signature, $payloadSignature);
    }

    private function _validateSignature($signatureString, $payload): void
    {
        $signaturePairs = preg_split('/&/', $signatureString);
        $signature = self::_matchingSignature($signaturePairs);

        if (!$signature) {
            throw new Exception\InvalidSignature('no matching public key');
        }

        if (!(self::_payloadMatches($signature, $payload) || self::_payloadMatches($signature, $payload."\n"))) {
            throw new Exception\InvalidSignature('signature does not match payload - one has been modified');
        }
    }

    private function _matchingSignature($signaturePairs)
    {
        foreach ($signaturePairs as $pair) {
            $components = preg_split('/\\|/', $pair);

            if ($components[0] === $this->config->getPublicKey()) {
                return $components[1];
            }
        }

        return null;
    }
}
