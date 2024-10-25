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

function muzo_CreateOrder(// funkce presmeruje browser s pozadavkem na server Muzo
    $urlMuzoCreateOrder,      // adresa kam posilat pozadavek do Muzo
    $replyUrl,                // adresa kam ma Muzo presmerovat odpoved
    $privateKeyFile,          // soubor s privatnim klicem
    $privateKeyPass,          // heslo privatniho klice
    $merchantNumber,          // cislo obchodnika
    $orderNumber,             // cislo objednavky
    $amount,                  // hodnota objednavky v halerich
    $currency,                // kod meny, CZK..203, EUR..978, GBP..826, USD..840, povolene meny zalezi na smlouve s bankou
    $depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
    $merOrderNum,             // identifikace objednavky pro obchodnika
    $description,             // popis nakupu, pouze ASCII
    $md,                      // data obchodnika, pouze ASCII
    $lang = null,               // jazyk na brane dle ISO 639-1 (cs, en, de, sk, ...), pokud null, zobrazi se jazyk dle jazykoveho nastaveni prohlizece
    $email = null,              // E-mail držitele karty, použije se pro notifikaci výsledku platby a v antifraud systémech
    $recurrent = false,       // priznak zda pozadovat opakovanou platbu
    $referenceNumber = null
) {// Interní ID u obchodníka
    $getfs = muzo_CreateOrderExt($urlMuzoCreateOrder, $replyUrl, $privateKeyFile, $privateKeyPass, $merchantNumber, $orderNumber, $amount, $currency, $depositFlag, $merOrderNum, $description, $md, $lang, $email, $recurrent, $referenceNumber);
    header("Location: {$getfs}");

    return $getfs; // vracene url muze byt pouzito napriklad pro logovani
}

function muzo_ReceiveReply(// funkce zpracuje a overi zpetne presmerovani z Muzo
    $muzoPublicKeyFile,         // soubor s verejnym klicem Muzo
    &$orderNumber,              // cislo objednavky
    &$merOrderNum,              // identifikace objednavky pro obchodnika
    &$md,                       // data obchodnika, pouze ASCII
    &$prCode,                   // primarni kod
    &$srCode,                   // sekundarni kod
    &$resultText,               // slovni popis chyby
    $merchantNumber = null,       // cislo obchodnika, pro komaptibilitu s puvodni verzi brany muze byt null, ale to je na ukor bezpecnosti
    &$addInfo = null
) {
    // Pozor! platba probehla uspesne pouze pokud funkce vrati true a zaroven je $prCode i $srCode rovne 0

    parse_str($_SERVER['QUERY_STRING'], $getvars); // parsujeme vlastnim zpusobem protoze trida JURI aktivovana z povolenehi JoomSEFu provede dvojnasobne URL decode GET promenych

    if (!isset($getvars['ORDERNUMBER'])) {          // ale kdyz tam neni ocekavana polozka, tak to asi zkazil nejaky plugin v opencartu, takze pouzijeme klasiku
        $getvars = $_REQUEST;
    }

    $orderNumber = $getvars['ORDERNUMBER'];
    $merOrderNum = $getvars['MERORDERNUM'];
    $md = $getvars['MD'];
    $prCode = $getvars['PRCODE'];
    $srCode = $getvars['SRCODE'];

    if (isset($getvars['RESULTTEXT'])) {
        $resultText = $getvars['RESULTTEXT'];
    } else {
        $resultText = '';
    }

    if (isset($getvars['ADDINFO'])) {
        $addInfo = $getvars['ADDINFO'];
    }

    $signHash = 'CREATE_ORDER';
    $singedKeys = ['ORDERNUMBER', 'MERORDERNUM', 'MD', 'PRCODE', 'SRCODE', 'RESULTTEXT', 'USERPARAM1', 'ADDINFO', 'TOKEN', 'EXPIRY', 'ACSRES', 'ACCODE', 'PANPATTERN', 'DAYTOCAPTURE', 'TOKENREGSTATUS', 'ACRC', 'RRN', 'PAR', 'TRACEID'];

    foreach ($singedKeys as $k) {
        if (isset($getvars[$k])) {
            $signHash .= '|'.$getvars[$k];
        }
    }

    $digest = $getvars['DIGEST'];
    $digest1 = $getvars['DIGEST1'];

    if (strpos($digest, ' ') !== false || (strpos($digest1, ' ') !== false)) {
        $digest = str_replace(' ', '+', $digest);
        $digest1 = str_replace(' ', '+', $digest1);
        muzo_writeLog('GPWebPay DIGEST UrlDecoded! Zkousim to opravit');
    }

    $digok = muzo_Verify($signHash, $digest, $muzoPublicKeyFile);

    if (null !== $merchantNumber) {
        $digok = $digok && muzo_Verify($signHash.'|'.$merchantNumber, $digest1, $muzoPublicKeyFile);
    }

    return $digok;  // urcuje zda byl podpis verohodny, stav provedeni platby je vsak urcen vracenym argumenten prCode!
}

// vnitrni funkce

function muzo_CreateOrderExt(// pomocna, funkce pripravi url pro presmerovani na Muzo
    $urlMuzoCreateOrder,      // adresa kam posilat pozadavek do Muzo
    $replyUrl,                // adresa kam ma Muzo presmerovat odpoved
    $privateKeyFile,          // soubor s privatnim klicem
    $privateKeyPass,          // heslo privatniho klice
    $merchantNumber,          // cislo obchodnika
    $orderNumber,             // cislo objednavky
    $amount,                  // hodnota objednavky v halerich
    $currency,                // kod meny, CZK..203, EUR..978, GBP..826, USD..840, povolene meny zalezi na smlouve s bankou
    $depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
    $merOrderNum,             // identifikace objednavky pro obchodnika
    $description,             // popis nakupu, pouze ASCII
    $md,                      // data obchodnika, pouze ASCII
    $lang = null,               // jazyk na brane dle ISO 639-1 (cs, en, de, sk, ...), pokud null, zobrazi se jazyk dle jazykoveho nastaveni prohlizece
    $email = null,              // E-mail držitele karty, použije se pro notifikaci výsledku platby a v antifraud systémech
    $recurrent = false,       // priznak zda pozadovat opakovanou platbu
    $referenceNumber = null,   // Interní ID u obchodníka
    $payMethod = null,
    $addInfo = null
) {
    return $urlMuzoCreateOrder.'?'.http_build_query(muzo_createRedirParams($replyUrl, $privateKeyFile, $privateKeyPass, $merchantNumber, $orderNumber, $amount, $currency, $depositFlag, $merOrderNum, $description, $md, $lang, $email, $recurrent, $referenceNumber, $payMethod, $addInfo), null, '&');
    // vracene url pro presmerovani na gpwebpay
}

function muzo_CreateOrderPostForm(// pomocna, funkce pripravi url pro presmerovani na Muzo
    $urlMuzoCreateOrder,      // adresa kam posilat pozadavek do Muzo
    $replyUrl,                // adresa kam ma Muzo presmerovat odpoved
    $privateKeyFile,          // soubor s privatnim klicem
    $privateKeyPass,          // heslo privatniho klice
    $merchantNumber,          // cislo obchodnika
    $orderNumber,             // cislo objednavky
    $amount,                  // hodnota objednavky v halerich
    $currency,                // kod meny, CZK..203, EUR..978, GBP..826, USD..840, povolene meny zalezi na smlouve s bankou
    $depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
    $merOrderNum,             // identifikace objednavky pro obchodnika
    $description,             // popis nakupu, pouze ASCII
    $md,                      // data obchodnika, pouze ASCII
    $lang = null,               // jazyk na brane dle ISO 639-1 (cs, en, de, sk, ...), pokud null, zobrazi se jazyk dle jazykoveho nastaveni prohlizece
    $email = null,              // E-mail držitele karty, použije se pro notifikaci výsledku platby a v antifraud systémech
    $recurrent = false,       // priznak zda pozadovat opakovanou platbu
    $referenceNumber = null,   // Interní ID u obchodníka
    $payMethod = null,
    $addInfo = null
) {
    $pars = muzo_createRedirParams($replyUrl, $privateKeyFile, $privateKeyPass, $merchantNumber, $orderNumber, $amount, $currency, $depositFlag, $merOrderNum, $description, $md, $lang, $email, $recurrent, $referenceNumber, $payMethod, $addInfo);

    $getfs = "<form id='form' method='post' action='".$urlMuzoCreateOrder."' accept-charset='UTF-8' enctype='application/x-www-form-urlencoded'>\n";

    foreach ($pars as $n => $v) {
        $getfs .= "<input type='hidden' name='{$n}' value='".htmlspecialchars($v, \ENT_QUOTES)."'>\n";
    }

    $getfs .= '</form>';
    $getfs .= '<script>document.getElementById("form").submit();</script>';

    return $getfs;
}

function muzo_createRedirParams(// pomocna, funkce pripravi url pro presmerovani na Muzo
    $replyUrl,                // adresa kam ma Muzo presmerovat odpoved
    $privateKeyFile,          // soubor s privatnim klicem
    $privateKeyPass,          // heslo privatniho klice
    $merchantNumber,          // cislo obchodnika
    $orderNumber,             // cislo objednavky
    $amount,                  // hodnota objednavky v halerich
    $currency,                // kod meny, CZK..203, EUR..978, GBP..826, USD..840, povolene meny zalezi na smlouve s bankou
    $depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
    $merOrderNum,             // identifikace objednavky pro obchodnika
    $description,             // popis nakupu, pouze ASCII
    $md,                      // data obchodnika, pouze ASCII
    $lang = null,               // jazyk na brane dle ISO 639-1 (cs, en, de, sk, ...), pokud null, zobrazi se jazyk dle jazykoveho nastaveni prohlizece
    $email = null,              // E-mail držitele karty, použije se pro notifikaci výsledku platby a v antifraud systémech
    $recurrent = false,       // priznak zda pozadovat opakovanou platbu
    $referenceNumber = null,  // Interní ID u obchodníka
    $payMethod = null,
    $addInfo = null
) {
    // nasledujici data musi byt bez mezer na konci, jinak selze podpis. V dokumentaci neuvedeno.
    $description = trim($description);
    $md = trim($md);

    if ($payMethod === null) {
        $payMethod = null;
    }

    $addInfo = ($addInfo === null) ? null : muzo_removeCrLfTabTrim($addInfo);

    $operation = 'CREATE_ORDER';
    $digest = muzo_Digest($privateKeyFile, $privateKeyPass, $replyUrl, $operation, $merchantNumber, $orderNumber, $amount, $currency, $depositFlag, $merOrderNum, $description, $md, $email, $recurrent, $referenceNumber, $payMethod, $addInfo);

    $pars = [];
    $pars['MERCHANTNUMBER'] = $merchantNumber;
    $pars['OPERATION'] = $operation;
    $pars['ORDERNUMBER'] = $orderNumber;
    $pars['AMOUNT'] = $amount;
    $pars['CURRENCY'] = $currency;
    $pars['DEPOSITFLAG'] = $depositFlag;
    $pars['MERORDERNUM'] = $merOrderNum;
    $pars['URL'] = $replyUrl;
    $pars['DESCRIPTION'] = $description;
    $pars['MD'] = $md;
    $pars['DIGEST'] = $digest;

    if ($lang !== null) {
        $pars['LANG'] = $lang;
    }

    if ($email !== null) {
        $pars['EMAIL'] = $email;
    }

    if ($recurrent) {
        $pars['USERPARAM1'] = 'R';
    }

    if ($referenceNumber !== null) {
        $pars['REFERENCENUMBER'] = $referenceNumber;
    }

    if ($payMethod !== null) {
        $pars['PAYMETHOD'] = $payMethod;
    }

    if ($addInfo !== null) {
        $pars['ADDINFO'] = $addInfo;
    }

    return $pars;
}

function muzo_Digest(// funkce vrati podepsany digest pozadavku
    $privateKeyFile,          // soubor s privatnim klicem
    $privateKeyPass,          // heslo privatniho klice
    $replyUrl,                // adresa kam ma Muzo presmerovat odpoved
    $operation,               // pouze CREATE_ORDER
    $merchantNumber,          // cislo obchodnika
    $orderNumber,             // cislo objednavky
    $amount,                  // hodnota objednavky v halerich
    $currency,                // kod meny (pro ceske PayMuzo funguje pouze kod 203, coz je CZK)
    $depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
    $merOrderNum,             // identifikace objednavky pro obchodnika
    $description,             // popis nakupu, pouze ASCII
    $md,                      // data obchodnika, pouze ASCII
    $email = null,              // E-mail držitele karty, použije se pro notifikaci výsledku platby a v antifraud systémech
    $recurrent = false,       // priznak zda pozadovat opakovanou platbu
    $referenceNumber = null,  // Interní ID u obchodníka
    $payMethod = null,
    $addInfo = null
) {
    $digestSrc = $merchantNumber.'|'.$operation.'|'.$orderNumber.'|'.$amount.'|'.$currency.'|'.$depositFlag.'|'.$merOrderNum.'|'.$replyUrl.'|'.$description.'|'.$md;

    if ($recurrent) {
        $digestSrc .= '|R';
    }

    if ($payMethod !== null) {
        $digestSrc .= '|'.$payMethod;
    }

    if ($email !== null) {
        $digestSrc .= '|'.$email;
    }

    if ($referenceNumber !== null) {
        $digestSrc .= '|'.$referenceNumber;
    }

    if ($digestSrc[\strlen($digestSrc) - 1] === '|') {
        $digestSrc = substr($digestSrc, 0, \strlen($digestSrc) - 1);   // korekce chyby v implementaci GPE
    }

    if ($addInfo !== null) {
        $digestSrc .= '|'.$addInfo;
    }

    return muzo_Sign($digestSrc, $privateKeyFile, $privateKeyPass);
    // muzo_writeLog("gpwp_digestSrc='".$digestSrc."'");
}

function muzo_removeCrLfTabTrim($s)
{
    return trim(str_replace("\t", ' ', str_replace("\r", '', str_replace("\n", ' ', $s))));
}

function muzo_writeLog($s): void
{
    $log = fopen(__DIR__.'/logs/UniModul.log', 'ab');
    fwrite($log, '+++ '.date('r').' '.$s."\n");
    fclose($log);
}

function muzo_Sign($text, $keyFile, $password)
{
    $fp = fopen($keyFile, 'rb');
    $privatni = fread($fp, filesize($keyFile));
    fclose($fp);
    $pkeyid = openssl_pkey_get_private($privatni, $password);
    openssl_sign($text, $signature, $pkeyid);

    return base64_encode($signature);
}

function muzo_Verify($text, $sigb64, $keyFile)
{
    $fp = fopen($keyFile, 'rb');
    $verejny = fread($fp, filesize($keyFile));
    fclose($fp);
    $pubkeyid = openssl_pkey_get_public($verejny);
    $signature = base64_decode($sigb64, true);
    $vysledek = openssl_verify($text, $signature, $pubkeyid);

    if (!empty($GLOBALS['UniGPWebPay_DebugSignature'])) {
        muzo_writeLog("muzo_Verify vysledek: '{$vysledek}', text:'{$text}',\n sigb64:'{$sigb64}',\n keyFile:'{$keyFile}', verejny:'{$verejny}'");
    }

    return ($vysledek === 1) ? true : false;
}
