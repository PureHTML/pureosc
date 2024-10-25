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
// #Ver:PRV089-22-g45d1515b:2021-09-02#

require_once __DIR__.'/UniModul.php';

require_once __DIR__.'/muzo.php';

require_once __DIR__.'/MuzoWebServices.php';

class UniGPWebPayConfig
{
    public $isTest;
    public $publicKeyFile;
    public $privateKeyFile;
    public $privateKeyPass;
    public $merchantNumber;
    public $depositFlag;
    public $gwOrderNumberOffset;
    public $cronSecret;
    public $provider;
    public $convertToCurrencyIfUnsupported; // jedna mena
    public $subMethodsSelection; // array submetod
}

class UniGPWebPay extends UniModul
{
    public $uniModulProperties = ['HonorsShopOrderNumberIsAlpha' => true];
    protected $subMethods = ['GooglePay' => 'GPAY', 'ApplePay' => 'APAY'];

    public function __construct($configSetting, $subMethod, $name = 'GPWebPay')
    {
        $this->versionStr = '#Ver:PRV089-22-g45d1515b:2021-09-02#';
        parent::__construct($name, $configSetting, $subMethod);
        $this->setConfigFromData($configSetting);
    }

    public function setConfigFromData($configSetting): void
    {
        $this->config = new UniGPWebPayConfig();

        if ($configSetting !== null && $configSetting->configData !== null) {
            $configData = $configSetting->configData;
            $this->config->isTest = $configData['isTest'];
            $this->config->publicKeyFile = __DIR__.'/certs/'.($this->config->isTest ? 'gpe.signing_test.pem' : 'gpe.signing_prod.pem');
            $this->config->privateKeyFile = __DIR__.'/certs/'.$configData['privateKeyFile'];
            $this->config->privateKeyPass = $configData['privateKeyPass'];
            $this->config->merchantNumber = $configData['merchantNumber'];
            $this->config->depositFlag = $configData['depositFlag'];
            $this->config->gwOrderNumberOffset = $configData['gwOrderNumberOffset'];
            $this->config->supportedCurrencies = $configData['supportedCurrencies'];
            $this->config->convertToCurrencyIfUnsupported = $configData['convertToCurrencyIfUnsupported'] ?? null;
            $this->config->provider = $configData['provider'] ?? null;
            $this->config->cronSecret = $configData['cronSecret'] ?? null;
            $this->config->subMethodsSelection = explode(' ', $configSetting->configData['subMethodsSelection']);
        }
    }

    public function getConfigInfo($language = 'en')
    {
        $d = $this->dictionary;
        $d->setDefaultLanguage($language);

        $configInfo = new ConfigInfo();

        $configFields = [];

        $configFields[] = create_initialize_object('ConfigField', ['name' => 'isTest', 'label' => $d->get('isTest'), 'type' => ConfigFieldType::$choice, 'choiceItems' => [1 => $d->get('yes'), 0 => $d->get('no')]]);

        $configField = new ConfigField();
        $configField->name = 'merchantNumber';
        $configField->label = $d->get('merchantNumber');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'privateKeyFile';
        $configField->label = $d->get('privateKeyFile');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'privateKeyPass';
        $configField->label = $d->get('privateKeyPass');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'depositFlag';
        $configField->label = $d->get('depositFlag');
        $configField->type = ConfigFieldType::$choice;
        $configField->choiceItems = [1 => $d->get('deposit_1'), 0 => $d->get('deposit_0')];
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'provider';
        $configField->label = $d->get('provider');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'cronSecret';
        $configField->label = $d->get('cronSecret');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'gwOrderNumberOffset';
        $configField->label = $d->get('gwOrderNumberOffset');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'supportedCurrencies';
        $configField->label = $d->get('supportedCurrencies');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'convertToCurrencyIfUnsupported';
        $configField->label = $d->get('convertToCurrencyIfUnsupported');
        $configField->type = ConfigFieldType::$text;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'orderStatusSuccessfull';
        $configField->label = $d->get('orderStatusSuccessfull');
        $configField->type = ConfigFieldType::$orderStatus;
        $configFields[] = $configField;

        $configField = new ConfigField();
        $configField->name = 'subMethodsSelection';
        $configField->label = $d->get('subMethodsSelection');
        $configField->type = ConfigFieldType::$subMethodsSelection;
        $configField->choiceItems = ['main' => ''];  // povolime obecnou submetodu
        $configFields[] = $configField;

        $configInfo->configFields = $configFields;

        return $configInfo;
    }
    public function getSubMethods()
    {
        return array_keys($this->subMethods);
    }

    public function queryPrePayGWInfo($orderToPayInfo)
    {
        if ($orderToPayInfo->subMethod === null) {  // fix pro subModuly
            $orderToPayInfo->subMethod = $this->subMethod;
        }

        [$isPossible, $newcur, $newtotal, $forexMessage, $forexNote, $orderReplyStatusFail] = $this->fixCurrency($orderToPayInfo);

        $prePayGWInfo = new PrePayGWInfo();
        $methodNameKey = ($orderToPayInfo->subMethod === '') ? 'payment_method_name' : 'submethod_name_'.$orderToPayInfo->subMethod;
        $prePayGWInfo->paymentMethodName = $this->dictionary->get($methodNameKey, $orderToPayInfo->language);
        $prePayGWInfo->isPossible = $isPossible;
        $prePayGWInfo->forexMessage = $forexMessage;

        if ($orderToPayInfo->subMethod !== null) {
            $prePayGWInfo->subMethods = [$orderToPayInfo->subMethod];
        } else {
            $prePayGWInfo->subMethods = $this->config->subMethodsSelection;
        }

        $isSafari = strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false;

        if (!$isSafari) {
            $prePayGWInfo->subMethods = array_filter($prePayGWInfo->subMethods, static function ($v) {
                return $v !== 'ApplePay';
            });
        }

        if (empty($prePayGWInfo->subMethods)) {
            $prePayGWInfo->isPossible = false;
        }

        return $prePayGWInfo;
    }

    public function gatewayOrderRedirectAction($orderToPayInfo)
    {
        if ($orderToPayInfo->subMethod === null) {  // fix pro subModuly
            $orderToPayInfo->subMethod = $this->subMethod;
        }

        [$isPossible, $newcur, $newtotal, $forexMessage, $forexNote, $orderReplyStatusFail] = $this->fixCurrency($orderToPayInfo);

        if (!$isPossible) {
            $transactionPK = $this->writeOrderToDb($orderToPayInfo->shopOrderNumber, $orderToPayInfo->shopPairingInfo, null, $forexNote, $orderReplyStatusFail->orderStatus, $orderToPayInfo->uniAdapterData);
            $this->logger->writeLog('CANNOT SEND ORDER '.print_r($orderToPayInfo, true).'   resultText:'.$orderReplyStatusFail->resultText);

            $redirectActionFail = new RedirectAction();
            $redirectActionFail->orderReplyStatus = $orderReplyStatusFail;

            return $redirectActionFail;
        }

        $amount = round($newtotal * 100);

        $currencyCodes = ['AED' => '784', 'AFN' => '971', 'ALL' => '008', 'AMD' => '051', 'ANG' => '532', 'AOA' => '973', 'ARS' => '032', 'AUD' => '036', 'AWG' => '533', 'AZN' => '944', 'BAM' => '977', 'BBD' => '052', 'BDT' => '050', 'BGN' => '975', 'BHD' => '048', 'BIF' => '108', 'BMD' => '060', 'BND' => '096', 'BOB' => '068', 'BOV' => '984', 'BRL' => '986', 'BSD' => '044', 'BTN' => '064', 'BWP' => '072', 'BYN' => '933', 'BZD' => '084', 'CAD' => '124', 'CDF' => '976', 'CHE' => '947', 'CHF' => '756', 'CHW' => '948', 'CLF' => '990', 'CLP' => '152', 'CNY' => '156', 'COP' => '170', 'COU' => '970', 'CRC' => '188', 'CUC' => '931', 'CUP' => '192', 'CVE' => '132', 'CZK' => '203', 'DJF' => '262', 'DKK' => '208', 'DOP' => '214', 'DZD' => '012', 'EGP' => '818', 'ERN' => '232', 'ETB' => '230', 'EUR' => '978', 'FJD' => '242', 'FKP' => '238', 'GBP' => '826', 'GEL' => '981', 'GHS' => '936', 'GIP' => '292', 'GMD' => '270', 'GNF' => '324', 'GTQ' => '320', 'GYD' => '328', 'HKD' => '344', 'HNL' => '340', 'HRK' => '191', 'HTG' => '332', 'HUF' => '348', 'IDR' => '360', 'ILS' => '376', 'INR' => '356', 'IQD' => '368', 'IRR' => '364', 'ISK' => '352', 'JMD' => '388', 'JOD' => '400', 'JPY' => '392', 'KES' => '404', 'KGS' => '417', 'KHR' => '116', 'KMF' => '174', 'KPW' => '408', 'KRW' => '410', 'KWD' => '414', 'KYD' => '136', 'KZT' => '398', 'LAK' => '418', 'LBP' => '422', 'LKR' => '144', 'LRD' => '430', 'LSL' => '426', 'LYD' => '434', 'MAD' => '504', 'MDL' => '498', 'MGA' => '969', 'MKD' => '807', 'MMK' => '104', 'MNT' => '496', 'MOP' => '446', 'MRU' => '929', 'MUR' => '480', 'MVR' => '462', 'MWK' => '454', 'MXN' => '484', 'MXV' => '979', 'MYR' => '458', 'MZN' => '943', 'NAD' => '516', 'NGN' => '566', 'NIO' => '558', 'NOK' => '578', 'NPR' => '524', 'NZD' => '554', 'OMR' => '512', 'PAB' => '590', 'PEN' => '604', 'PGK' => '598', 'PHP' => '608', 'PKR' => '586', 'PLN' => '985', 'PYG' => '600', 'QAR' => '634', 'RON' => '946', 'RSD' => '941', 'RUB' => '643', 'RWF' => '646', 'SAR' => '682', 'SBD' => '090', 'SCR' => '690', 'SDG' => '938', 'SEK' => '752', 'SGD' => '702', 'SHP' => '654', 'SLL' => '694', 'SOS' => '706', 'SRD' => '968', 'SSP' => '728', 'STN' => '930', 'SVC' => '222', 'SYP' => '760', 'SZL' => '748', 'THB' => '764', 'TJS' => '972', 'TMT' => '934', 'TND' => '788', 'TOP' => '776', 'TRY' => '949', 'TTD' => '780', 'TWD' => '901', 'TZS' => '834', 'UAH' => '980', 'UGX' => '800', 'USD' => '840', 'USN' => '997', 'UYI' => '940', 'UYU' => '858', 'UYW' => '927', 'UZS' => '860', 'VES' => '928', 'VND' => '704', 'VUV' => '548', 'WST' => '882', 'XAF' => '950', 'XAG' => '961', 'XAU' => '959', 'XBA' => '955', 'XBB' => '956', 'XBC' => '957', 'XBD' => '958', 'XCD' => '951', 'XDR' => '960', 'XOF' => '952', 'XPD' => '964', 'XPF' => '953', 'XPT' => '962', 'XSU' => '994', 'XTS' => '963', 'XUA' => '965', 'XXX' => '999', 'YER' => '886', 'ZAR' => '710', 'ZMW' => '967', 'ZWL' => '932'];
        $currency = $currencyCodes[$newcur];
        $merchantNumber = $this->config->merchantNumber;

        $transactionPK = $this->writeOrderToDb($orderToPayInfo->shopOrderNumber, $orderToPayInfo->shopPairingInfo, null, $forexNote, null, $orderToPayInfo->uniAdapterData);
        $gwOrderNumber = $transactionPK + $this->config->gwOrderNumberOffset;
        $this->updateGwOrderNumber($transactionPK, $gwOrderNumber);

        $isNumericShopOrderNumber = preg_match('/^[0-9]+$/', $orderToPayInfo->shopOrderNumber);
        $merOrderNum = $isNumericShopOrderNumber ? $orderToPayInfo->shopOrderNumber : $gwOrderNumber;
        $referenceNumber = preg_match('~^[ #$*+,-./0-9:;=@A-Z^_a-z]+$~', $orderToPayInfo->shopOrderNumber) ? $orderToPayInfo->shopOrderNumber : $gwOrderNumber;

        $description = '';

        if (!$isNumericShopOrderNumber && $orderToPayInfo->shopOrderNumber !== '') {
            $description .= '(Ord.No.:'.$orderToPayInfo->shopOrderNumber.') ';
        }

        $description .= $orderToPayInfo->description;

        require_once 'toascii.php';
        $description = toASCII($description);
        $description = substr($description, 0, 255);

        if ($orderToPayInfo->recurrenceType === RecurrenceType::child) {
            $this->logger->writeLog('Vytvarim child platbu pro parent order '.$orderToPayInfo->recurrenceParentShopOrderNumber);
            $parentTransaction = $this->getOrderTransactionRecordFromDbLast($orderToPayInfo->recurrenceParentShopOrderNumber);

            if ($parentTransaction === null) {
                $redirectAction = $this->getImmediateReplyStatusRedirectAction($orderToPayInfo, OrderStatus::$failedFinal);
                $this->logger->writeLog('ERROR: parent order '.$orderToPayInfo->recurrenceParentShopOrderNumber.' not found.');
            } else {
                $masterPaymentNumber = $parentTransaction->gwOrderNumber;
                $srv = $this->createWebService();

                try {
                    $srv->processUsageBasedSubscriptionPayment(
                        $gwOrderNumber, // messageId
                        $masterPaymentNumber,
                        $gwOrderNumber,
                        $merOrderNum,
                        $amount,
                        $currency,
                        $this->config->depositFlag,
                        $res,
                    );
                    // pokud bez vyjimky, tak ok
                    $redirectAction = $this->getImmediateReplyStatusRedirectAction($orderToPayInfo, OrderStatus::$successful);
                } catch (SoapFault $e) {
                    $redirectAction = $this->getImmediateReplyStatusRedirectAction($orderToPayInfo, OrderStatus::$failedFinal);

                    if (false && $e->detail->paymentServiceException->primaryReturnCode === 15) {
                    } else {
                        $this->logger->writeLogNoNewLines('GPWebPay Webservice exception '.$e->getMessage().' PRCODE:'.$e->detail->paymentServiceException->primaryReturnCode.' SRCODE:'.$e->detail->paymentServiceException->secondaryReturnCode);
                    }
                }
            }
        } else { // normalni ne-child transakce
            $urlMuzoCreateOrder = $this->config->isTest ? 'https://test.3dsecure.gpwebpay.com/pgw/order.do' : 'https://3dsecure.gpwebpay.com/pgw/order.do';
            $xaddInfo = $this->createAddinfo($orderToPayInfo);
            $redirectHtml = muzo_CreateOrderPostForm(
                $urlMuzoCreateOrder, // adresa kam posilat pozadavek do Muzo
                $orderToPayInfo->replyUrl, // adresa kam ma Muzo presmerovat odpoved
                $this->config->privateKeyFile, // soubor s privatnim klicem
                $this->config->privateKeyPass, // heslo privatniho klice
                $merchantNumber, // cislo obchodnika
                $gwOrderNumber, // cislo objednavky
                $amount, // hodnota objednavky v halerich
                $currency, // kod meny, CZK..203, EUR..978, GBP..826, USD..840, povolene meny zalezi na smlouve s bankou
                $this->config->depositFlag, // uhrada okamzite "1", nebo uhrada az z admin rozhrani
                $merOrderNum, // identifikace objednavky pro obchodnika
                $description, // popis nakupu, pouze ASCII
                'X', // data obchodnika, pouze ASCII
                $orderToPayInfo->language,
                $orderToPayInfo->customerData->email,
                $orderToPayInfo->recurrenceType === RecurrenceType::parent,
                $referenceNumber,
                empty($orderToPayInfo->subMethod) ? null : $this->subMethods[$orderToPayInfo->subMethod],
                $xaddInfo,
            );
            $this->logger->writeLogNoNewLines('MAKING_ORDER_FORM '.$redirectHtml.'   '.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI']);

            $redirectAction = new RedirectAction();
            $redirectAction->redirectForm = $redirectHtml;
        }

        return $redirectAction;
    }

    public function gatewayReceiveReply($language = 'en')
    {
        $sigValid = muzo_ReceiveReply($this->config->publicKeyFile, $gwOrderNumber, $merOrderNum, $md, $prCode, $srCode, $resultText, $this->config->merchantNumber);
        $paymentOk = ($sigValid && $prCode === 0 && $srCode === 0);

        $this->logger->writeLog('REPLY Signature result='.($paymentOk ? 'OK' : 'NOK').' signature: '.($sigValid ? 'VALID' : 'INVALID').'  '.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI']);

        if ($paymentOk) {
            $errMsg = null;
        } else {
            $errClass = classify_error($sigValid, $prCode, $srCode);
            $errMsgMap = [GPWP_E_3DSECURE => 'GPWP_E_3DSECURE', GPWP_E_BLOCKED => 'GPWP_E_BLOCKED', GPWP_E_LIMIT => 'GPWP_E_LIMIT', GPWP_E_TECHNICAL => 'GPWP_E_TECHNICAL', GPWP_E_CANCELED => 'GPWP_E_CANCELED'];
            $errMsg = $this->dictionary->get($errMsgMap[$errClass], $language);  // kde tady vzit jazyk?
        }

        $transactionRecord = $this->getOrderTransactionRecordFromDbUnique($gwOrderNumber);
        $orderReplyStatus = new OrderReplyStatus();
        $orderReplyStatus->orderStatus = ($paymentOk ? OrderStatus::$successful : OrderStatus::$failedRetriable);
        $orderReplyStatus->resultText = $errMsg;
        $orderReplyStatus->gwOrderNumber = $gwOrderNumber;
        $orderReplyStatus->shopOrderNumber = $transactionRecord->shopOrderNumber;
        $orderReplyStatus->shopPairingInfo = $transactionRecord->shopPairingInfo;
        $orderReplyStatus->forexNote = $transactionRecord->forexNote;
        $orderReplyStatus->uniAdapterData = $transactionRecord->uniAdapterData;
        $this->updateOrderReplyStatusGwOrdNumInDb($orderReplyStatus);

        $this->logger->writeLog('orderReplyStatus='.$orderReplyStatus->orderStatus);

        return $orderReplyStatus;
    }

    public function processCallbackRequest($callbackName, $arguments): void
    {
        if ($callbackName === 'checkOrderStatuses') {
            $this->checkOrderStatuses();
        } else {
            parent::processCallbackRequest($callbackName, $arguments);
        }
    }

    public function checkOrderStatuses(): void
    {
        $this->logger->writeLogNoNewLines('GPWebPay checkOrderStatuses started');

        if ($_GET['cronSecret'] !== $this->config->cronSecret && !empty($this->config->cronSecret)) {
            $this->logger->writeLogNoNewLines('GPWebPay checkOrderStatuses wrong cronSecret');

            exit('GPWebPay wrong cronSecret');
        }

        $pendingTrans = $this->getAllPendingOrderTransactionRecords([OrderStatus::$initiated, OrderStatus::$pending], new DateTime('3 days ago'));

        $srv = $this->createWebService();

        foreach ($pendingTrans as $shopTrans) {
            $this->logger->writeLogNoNewLines('GPWebPay open transaction '.print_r($shopTrans, true));

            if (is_numeric($shopTrans->uniModulData)) { // kompat s predchozi verzi s vice moznymi merchatny, a kdy zde bylo ulozeno konkretni merchantNumber
                $srv->MerchantNumber = $shopTrans->uniModulData;
            }

            try {
                $res = $srv->getPaymentDetail($shopTrans->gwOrderNumber);

                if (\in_array($res->status, ['PENDING_CAPTURE', 'PENDING_SETTLEMENT', 'PROCESSED', 'CAPTURED', 'PENDING_ADJUSTMENT', 'PARTIAL_PAYMENT', 'VALID'], true)) {
                    $newStatus = OrderStatus::$successful;
                } elseif (
                    \in_array($res->status, ['PENDING_AUTHORIZATION', 'CREATED'], true)
                        || ($res->status === 'UNPAID' && \in_array($res->subStatus, ['PGW_PAGE', '3DS_REDIRECT', '3DS_SUBMIT', 'PAYMENT_REDIRECT', 'MPS_SCH_REDIRECT', 'MPS_SCH_SUBMIT', 'MPS_SCH_CANCEL', 'DEFERRED_SUBMIT', 'PGW_ORDER'], true))
                ) {
                    $newStatus = null;
                } elseif (
                    \in_array($res->status, ['EXPIRED', 'CANCELED', 'BLOCKED', 'REVERSED', 'REFUNDED', 'CANCELED_BY_MERCHANT', 'CANCELED_BY_ISSUER', 'CANCELED_BY_CARDHOLDER', 'EXPIRED_CARD', 'EXPIRED_NO_PAYMENT'], true)
                        || ($res->status === 'UNPAID' && \in_array($res->subStatus, ['CANCELED', 'TECHNICAL_PROBLEM', 'FRAUD', 'DECLINED'], true))
                ) {
                    $newStatus = OrderStatus::$failedFinal;
                } else {
                    $newStatus = null;
                    $this->logger->writeLog('GPWebPay unknown transaction status: '.$res->status.', subStatus: '.$res->subStatus);
                }
            } catch (SoapFault $e) {
                if ($e->detail->serviceException->primaryReturnCode === 15) {
                    $newStatus = OrderStatus::$failedFinal;
                } else {
                    $newStatus = null;
                    $this->logger->writeLogNoNewLines('GPWebPay Webservice exception '.$e->getMessage().' PRCODE:'.$e->detail->serviceException->primaryReturnCode.' SRCODE:'.$e->detail->serviceException->secondaryReturnCode);
                }
            }

            $this->logger->writeLogNoNewLines('GPWebPay Webservice request '.$srv->mws->__getLastRequest());
            $this->logger->writeLogNoNewLines('GPWebPay Webservice response '.$srv->mws->__getLastResponse());

            $this->logger->writeLogNoNewLines('GPWebPay Updating gwOrderNumber '.$shopTrans->gwOrderNumber.' to state '.($newStatus === null ? '(no change, still awaiting authorization)' : $newStatus));

            if ($newStatus !== null) {
                $orderReplyStatus = new OrderReplyStatus();
                $orderReplyStatus->gwOrderNumber = $shopTrans->gwOrderNumber;
                $orderReplyStatus->shopOrderNumber = $shopTrans->shopOrderNumber;
                $orderReplyStatus->shopPairingInfo = $shopTrans->shopPairingInfo;
                $orderReplyStatus->uniAdapterData = $shopTrans->uniAdapterData;
                $orderReplyStatus->orderStatus = $newStatus;
                $this->updateOrderReplyStatusGwOrdNumInDb($orderReplyStatus, $shopTrans->transactionPK);
                $orderReplyStatus->orderStatus = $newStatus;
                ($this->baseConfig->funcProcessReplyStatus)($orderReplyStatus);
            }
        }

        $this->logger->writeLogNoNewLines('GPWebPay checkOrderStatuses finished');
    }

    public function getInfoBoxData($uniAdapterName, $language)
    {
        $infoBoxData = parent::getInfoBoxData($uniAdapterName, $language);
        $infoBoxData->title = $this->dictionary->get('infoBoxTitle', $language);
        $infoBoxData->link = null;
        $infoBoxData->image = 'visamastersecure.png';

        return $infoBoxData;
    }

    private function createAddinfo($orderToPayInfo)
    {
        $isoCountryToNum = ['AF' => '004', 'AX' => '248', 'AL' => '008', 'DZ' => '012', 'AS' => '016', 'AD' => '020', 'AO' => '024', 'AI' => '660', 'AQ' => '010', 'AG' => '028', 'AR' => '032', 'AM' => '051', 'AW' => '533', 'AU' => '036', 'AT' => '040', 'AZ' => '031', 'BS' => '044', 'BH' => '048', 'BD' => '050', 'BB' => '052', 'BY' => '112', 'BE' => '056', 'BZ' => '084', 'BJ' => '204', 'BM' => '060', 'BT' => '064', 'BO' => '068', 'BQ' => '535', 'BA' => '070', 'BW' => '072', 'BV' => '074', 'BR' => '076', 'IO' => '086', 'BN' => '096', 'BG' => '100', 'BF' => '854', 'BI' => '108', 'CV' => '132', 'KH' => '116', 'CM' => '120', 'CA' => '124', 'KY' => '136', 'CF' => '140', 'TD' => '148', 'CL' => '152', 'CN' => '156', 'CX' => '162', 'CC' => '166', 'CO' => '170', 'KM' => '174', 'CG' => '178', 'CD' => '180', 'CK' => '184', 'CR' => '188', 'CI' => '384', 'HR' => '191', 'CU' => '192', 'CW' => '531', 'CY' => '196', 'CZ' => '203', 'DK' => '208', 'DJ' => '262', 'DM' => '212', 'DO' => '214', 'EC' => '218', 'EG' => '818', 'SV' => '222', 'GQ' => '226', 'ER' => '232', 'EE' => '233', 'SZ' => '748', 'ET' => '231', 'FK' => '238', 'FO' => '234', 'FJ' => '242', 'FI' => '246', 'FR' => '250', 'GF' => '254', 'PF' => '258', 'TF' => '260', 'GA' => '266', 'GM' => '270', 'GE' => '268', 'DE' => '276', 'GH' => '288', 'GI' => '292', 'GR' => '300', 'GL' => '304', 'GD' => '308', 'GP' => '312', 'GU' => '316', 'GT' => '320', 'GG' => '831', 'GN' => '324', 'GW' => '624', 'GY' => '328', 'HT' => '332', 'HM' => '334', 'VA' => '336', 'HN' => '340', 'HK' => '344', 'HU' => '348', 'IS' => '352', 'IN' => '356', 'ID' => '360', 'IR' => '364', 'IQ' => '368', 'IE' => '372', 'IM' => '833', 'IL' => '376', 'IT' => '380', 'JM' => '388', 'JP' => '392', 'JE' => '832', 'JO' => '400', 'KZ' => '398', 'KE' => '404', 'KI' => '296', 'KP' => '408', 'KR' => '410', 'KW' => '414', 'KG' => '417', 'LA' => '418', 'LV' => '428', 'LB' => '422', 'LS' => '426', 'LR' => '430', 'LY' => '434', 'LI' => '438', 'LT' => '440', 'LU' => '442', 'MO' => '446', 'MG' => '450', 'MW' => '454', 'MY' => '458', 'MV' => '462', 'ML' => '466', 'MT' => '470', 'MH' => '584', 'MQ' => '474', 'MR' => '478', 'MU' => '480', 'YT' => '175', 'MX' => '484', 'FM' => '583', 'MD' => '498', 'MC' => '492', 'MN' => '496', 'ME' => '499', 'MS' => '500', 'MA' => '504', 'MZ' => '508', 'MM' => '104', 'NA' => '516', 'NR' => '520', 'NP' => '524', 'NL' => '528', 'NC' => '540', 'NZ' => '554', 'NI' => '558', 'NE' => '562', 'NG' => '566', 'NU' => '570', 'NF' => '574', 'MK' => '807', 'MP' => '580', 'NO' => '578', 'OM' => '512', 'PK' => '586', 'PW' => '585', 'PS' => '275', 'PA' => '591', 'PG' => '598', 'PY' => '600', 'PE' => '604', 'PH' => '608', 'PN' => '612', 'PL' => '616', 'PT' => '620', 'PR' => '630', 'QA' => '634', 'RE' => '638', 'RO' => '642', 'RU' => '643', 'RW' => '646', 'BL' => '652', 'SH' => '654', 'KN' => '659', 'LC' => '662', 'MF' => '663', 'PM' => '666', 'VC' => '670', 'WS' => '882', 'SM' => '674', 'ST' => '678', 'SA' => '682', 'SN' => '686', 'RS' => '688', 'SC' => '690', 'SL' => '694', 'SG' => '702', 'SX' => '534', 'SK' => '703', 'SI' => '705', 'SB' => '090', 'SO' => '706', 'ZA' => '710', 'GS' => '239', 'SS' => '728', 'ES' => '724', 'LK' => '144', 'SD' => '729', 'SR' => '740', 'SJ' => '744', 'SE' => '752', 'CH' => '756', 'SY' => '760', 'TW' => '158', 'TJ' => '762', 'TZ' => '834', 'TH' => '764', 'TL' => '626', 'TG' => '768', 'TK' => '772', 'TO' => '776', 'TT' => '780', 'TN' => '788', 'TR' => '792', 'TM' => '795', 'TC' => '796', 'TV' => '798', 'UG' => '800', 'UA' => '804', 'AE' => '784', 'GB' => '826', 'US' => '840', 'UM' => '581', 'UY' => '858', 'UZ' => '860', 'VU' => '548', 'VE' => '862', 'VN' => '704', 'VG' => '092', 'VI' => '850', 'WF' => '876', 'EH' => '732', 'YE' => '887', 'ZM' => '894', 'ZW' => '716'];

        $xaddInfo = <<<'EOD'
<?xml version="1.0" encoding="UTF-8"?>
			<additionalInfoRequest xmlns="http://gpe.cz/gpwebpay/additionalInfo/request" version="4.0">
			  <cardholderInfo>
				<cardholderDetails/>
				<billingDetails/>
				<shippingDetails/>
			  </cardholderInfo>
			</additionalInfoRequest>

EOD;

        $name = $orderToPayInfo->customerData->first_name.' '.$orderToPayInfo->customerData->last_name;
        $name = mb_substr($name, 0, 45);

        if (\strlen($name) < 2) {
            $name += ' ';
        }

        $address = mb_substr($orderToPayInfo->customerData->street.' '.$orderToPayInfo->customerData->houseNumber, 0, 50);
        $city = mb_substr($orderToPayInfo->customerData->city, 0, 50);
        $postalCode = mb_substr($orderToPayInfo->customerData->post_code, 0, 16);
        $country = $isoCountryToNum[$orderToPayInfo->customerData->country];

        $xml = simplexml_load_string($xaddInfo);
        $xml->cardholderInfo->cardholderDetails->addChild('name', $name);
        $xml->cardholderInfo->cardholderDetails->addChild('email', $orderToPayInfo->customerData->email);

        $xml->cardholderInfo->billingDetails->addChild('name', $name);
        $xml->cardholderInfo->billingDetails->addChild('address1', $address);
        $xml->cardholderInfo->billingDetails->addChild('city', $city);
        $xml->cardholderInfo->billingDetails->addChild('postalCode', $postalCode);
        $xml->cardholderInfo->billingDetails->addChild('country', $country);

        $xml->cardholderInfo->shippingDetails->addChild('name', $name);
        $xml->cardholderInfo->shippingDetails->addChild('address1', $address);
        $xml->cardholderInfo->shippingDetails->addChild('city', $city);
        $xml->cardholderInfo->shippingDetails->addChild('postalCode', $postalCode);
        $xml->cardholderInfo->shippingDetails->addChild('country', $country);

        return $xml->asXML();
    }

    private function createWebService()
    {
        $serviceUrl = $this->config->isTest ? 'https://test.3dsecure.gpwebpay.com/pay-ws/v1/PaymentService' : 'https://3dsecure.gpwebpay.com/pay-ws/v1/PaymentService';

        return new MuzoWebServices(__DIR__.'/cws_v1.wsdl', $serviceUrl, $this->config->provider, $this->config->merchantNumber, $this->config->publicKeyFile, $this->config->privateKeyFile, $this->config->privateKeyPass, $this->logger);
    }
}

\define('GPWP_E_OK', 0);
\define('GPWP_E_3DSECURE', 1);
\define('GPWP_E_BLOCKED', 2);
\define('GPWP_E_LIMIT', 3);
\define('GPWP_E_TECHNICAL', 4);
\define('GPWP_E_CANCELED', 5);

function classify_error($valid, $prCode, $srCode)
{
    if ($valid && $prCode === 0 && $srCode === 0) {
        return GPWP_E_OK;
    }

    if (!$valid) {
        return GPWP_E_TECHNICAL;
    }

    if ($prCode === 28 && false !== array_search($srCode, [3000, 3002, 3004, 3005, 3008], true)) {
        return GPWP_E_3DSECURE;
    }

    if ($prCode === 30 && false !== array_search($srCode, [1001, 1002], true)) {
        return GPWP_E_BLOCKED;
    }

    if ($prCode === 30 && false !== array_search($srCode, [1003, 1005], true)) {
        return GPWP_E_LIMIT;
    }

    if ($prCode === 50) {
        return GPWP_E_CANCELED;
    }

    return GPWP_E_TECHNICAL;
}
