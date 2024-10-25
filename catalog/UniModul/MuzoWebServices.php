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

// Pouzivani bez souhlasu autora neni povoleno
// $Id: MuzoWebServices.php,v 1.6 2011/01/11 06:52:08 mira Exp $

require_once 'muzo.php';

class MuzoWebServices
{
    public $MerchantNumber;
    public $MuzoPublicKeyFile;
    public $PrivateKeyFile;
    public $PrivateKeyPass;
    public $mws;
    public $provider;
    public $logger;

    public function __construct(
        $wsdl,                    // soubor popisu webservice
        $serviceUrl,              // url webservice
        $provider,                // provider, typicky kod banky
        $merchantNumber,          // cislo obchodnika
        $muzoPublicKeyFile,       // soubor s verejnym klicem Muzo
        $privateKeyFile,          // soubor s privatnim klicem
        $privateKeyPass,          // heslo privatniho klice
        $logger
    ) {
        $this->logger = $logger;
        $this->MerchantNumber = $merchantNumber;
        $this->MuzoPublicKeyFile = $muzoPublicKeyFile;
        $this->PrivateKeyFile = $privateKeyFile;
        $this->PrivateKeyPass = $privateKeyPass;
        $this->provider = $provider;
        $this->mws = new SoapClient($wsdl, ['cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true, 'exceptions' => true, 'location' => $serviceUrl]);
    }

    // nasleduji jednotlive funkce poskytovane pres Muzo Webservices
    // navratova hodnota urcuje zda byl podpis muzo ok (true, false)
    // posledni argument $res je pole obsahujici navratove hodnoty funkce WebServices
    // popis jednotlivych funkci je uveden v souboru "PayMuzo - Web Services.pdf" dokumentace dodane od Muzo
    // chybu pri komunikaci se WebServices lze zjistit volanim funkce GetError, ktera pri chybe vrati neprazdny retezec s popisem chyby

    public function getPaymentStatus($orderNumber)
    {
        return $this->callServiceSig('getPaymentStatus', 'paymentStatus', ['paymentNumber' => $orderNumber]);
    }

    public function getPaymentDetail($orderNumber)
    {
        return $this->callServiceSig('getPaymentDetail', 'paymentDetail', ['paymentNumber' => $orderNumber]);
    }

    public function processRecurringPayment(
        $paymentNumber, // orderNumberarray
        $masterPaymentNumber,
        $orderNumber, // merOrdNumarray
        $referenceNumber, // md
        $amount,
        $currencyCode,
        $captureFlag,
        &$res
    ) {
        return $this->callServiceSig('processRecurringPayment', 'recurringPayment', [
            'paymentNumber' => $paymentNumber,
            'masterPaymentNumber' => $masterPaymentNumber,
            'orderNumber' => $orderNumber,
            'referenceNumber' => $referenceNumber,
            'amount' => $amount,
            'currencyCode' => $currencyCode,
            'captureFlag' => $captureFlag,
        ]);
    }

    public function processUsageBasedSubscriptionPayment(
        $paymentNumber, // orderNumberarray
        $masterPaymentNumber,
        $orderNumber, // merOrdNumarray
        $referenceNumber, // md
        $amount,
        $currencyCode,
        $captureFlag,
        &$res
    ) {
        return $this->callServiceSig('processUsageBasedSubscriptionPayment', 'usageBasedSubscriptionPayment', [
            'paymentNumber' => $paymentNumber,
            'masterPaymentNumber' => $masterPaymentNumber,
            'orderNumber' => $orderNumber,
            'referenceNumber' => $referenceNumber,
            'amount' => $amount,
            'currencyCode' => $currencyCode,
            'captureFlag' => $captureFlag,
        ]);
    }

    public function callServiceSig($funcName, $parNameBase, $params)
    {
        $messageId = uniqid('xxxxx');
        $params = ['messageId' => $messageId, 'provider' => $this->provider, 'merchantNumber' => $this->MerchantNumber] + $params;
        $sigstr = implode('|', $params);
        $sig = muzo_Sign($sigstr, $this->PrivateKeyFile, $this->PrivateKeyPass);
        $params['signature'] = base64_decode($sig, true);
        $params = [$parNameBase.'Request' => $params];

        try {
            $paramsLog = $params;
            unset($paramsLog[$parNameBase.'Request']['signature']);
            $this->logger->writeLogNoNewLines('GPWP SOAP request: '.$funcName.' '.print_r($paramsLog, true));
            $res = \call_user_func([$this->mws, $funcName], $params);
        } catch (Exception $e) {
            $eLog = unserialize(serialize($e));
            unset($eLog->detail->paymentServiceException->signature, $eLog->detail->serviceException->signature);

            $this->logger->writeLogNoNewLines('GPWP SOAP exception: '.print_r($eLog->detail, true));

            throw $e;
        }

        $eRes = unserialize(serialize($res));
        unset($eRes->{$parNameBase.'Response'}->signature);
        $this->logger->writeLogNoNewLines('GPWP SOAP response: '.$funcName.' '.print_r($eRes, true));
        $res = $res->{$parNameBase.'Response'};
        $sigr = $res->signature;
        $resar = get_object_vars($res);
        unset($resar['signature']);
        $sigrstr = implode('|', $resar);

        if (!($messageId && muzo_Verify($sigrstr, base64_encode($sigr), $this->MuzoPublicKeyFile))) {
            $this->logger->writeLogNoNewLines('GPWP SOAP response validation error: neplatny podpis nebo messageId');

            throw new Exception('GPWP SOAP response validation error: neplatny podpis nebo messageId');
        }

        return $res;
    }
}
