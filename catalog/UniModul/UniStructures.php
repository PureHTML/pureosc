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

class CheckNonexistentFields
{
    public function __set($name, $value): void
    {
        trigger_error('Assigning nonexistent field '.\get_class($this).'::'.$name);
        $this->{$name} = $value;
    }
}

class CheckNonexistentFieldsLogOnly
{
    public function __set($name, $value): void
    {
        UniWriteErrLog('CheckNonexistentFieldsLogOnly', 'Assigning nonexistent field '.\get_class($this).'::'.$name, null, null, 2);
        $this->{$name} = $value;
    }
}

class OrderToPayInfo extends CheckNonexistentFieldsLogOnly
{
    public $shopOrderNumber;  // pouze pokud je to znamo dopredu, jinak null
    public $shopPairingInfo;
    public $uniAdapterData;        // serialized to blob, sessions atp
    public $amount;
    public $currency;      // ciselnik CZK, EUR, USD, GBP
    public $ccBrand;       // ciselnik dle CS pro CS, Tato polozka se jiz nepouziva
    public $customerData;   // type CustomerData
    public $language;  // ciselnik  cz, sk, en, de, pl   // ISO-639 http:www.ics.uci.edu/pub/ietf/http/related/iso639.txt (currently cs, en)
    public $description;
    public $replyUrl;
    public $notifyUrl;
    public $uniModulDirUrl;  // url adresare UniModul v rootu eshopu,    TODO: Nove uz by se melo brat jen z $this->baseConfig->uniModulDirUrl
    public $currencyRates; // array(ISO=>rate)
    public $subMethod; // nazev vybrane submetody, prazdne pro defaultni metodu
    public $adapterProperties; // Deprecated - aktualne se nevyuziva, asoc pole vlastnosti/pozadavku Adapteru
    public $recurrenceType; // RecurrenceType
    public $recurrenceParentShopOrderNumber; // pro recurrenceType::child je to prislusny ShopOrderNumber s recurrenceType::parent
    public $recurrenceDateTo; // YYYY-MM-DD
    public $cartItems; // array of CartItem
}

class CustomerData extends CheckNonexistentFieldsLogOnly
{
    public $email;
    public $first_name;
    public $last_name;
    public $street;
    public $houseNumber;
    public $city;
    public $post_code;
    public $state;  // iso AZ, TX, ...http://en.wikipedia.org/wiki/ISO_3166-2:US
    public $country; // iso CZ, US, ...https://cs.wikipedia.org/wiki/ISO_3166-1
    public $phone;
    public $identifier; // identifikator zakaznika v ramci eshopu
}

class UniCartItem extends CheckNonexistentFields
{
    public $name;
    public $unitPrice;   // s dani
    public $quantity;
    public $taxRate; // v procentech
    public $unitTaxAmount;   // samotna dan, dodana pozdeji, nektere adaptery ji nemusi doplnovat
    public $type; // UniCartItemType, u starsich adapteru nemusi byt dosazovana
    public $productId; // u starsich adapteru nemusi byt dosazovane
}

abstract class UniCartItemType
{
    public const commodity = 1;
    public const delivery = 2;
    public const discount = 3;
}

class TransactionRecord extends CheckNonexistentFieldsLogOnly
{
    public $transactionPK;
    public $uniModulName;
    public $gwOrderNumber;
    public $gwPairingInfo; // druhe cislo transakce na platebni brane, typicky to, co je znamo az po vytvoreni transakce branou
    public $shopOrderNumber;
    public $shopPairingInfo;
    public $uniAdapterData;
    public $uniModulData;
    public $forexNote;
    public $orderStatus;
    public $dateCreated;
    public $dateModified;
}

// {{{ Konfigurace

class ConfigSetting extends CheckNonexistentFieldsLogOnly
{
    public $uniModulConfig; // UniModulConfig
    public $configData; // array (n=>v)
}

class ConfigInfo extends CheckNonexistentFieldsLogOnly
{
    public $configFields; // Array of ConfigField
}

class ConfigField extends CheckNonexistentFieldsLogOnly
{
    public $name;
    public $type; // ConfigFieldType
    public $choiceItems; // array(v=>l)
    public $label;
    public $comment;
}

class ConfigFieldType extends CheckNonexistentFieldsLogOnly
{
    public static $text = 1;
    public static $choice = 2;
    public static $orderStatus = 3;
    public static $subMethodsSelection = 4;
    public static $orderStatusMultiple = 5;
}

class RecurrenceType extends CheckNonexistentFieldsLogOnly
{
    public const none = 0;
    public const parent = 1;
    public const child = 2;
}

// }}} Konfigurace

class PrePayGWInfo extends CheckNonexistentFieldsLogOnly
{
    public $paymentMethodName;
    public $paymentMethodDescription;
    public $paymentMethodIconUrl;
    public $isPossible; // bool
    public $selectCsPayBrand; // bool, vyber brandu pro CS
    public $selectCsPayBrandTitle; // text pro nadpis ke kart�m
    public $forexMessage; // string, info o automatickem prevodu
    public $convertToCurrency;     // pro konverzi
    public $convertToCurrencyAmount;
    public $subMethods;  // submetody pouzitelne pro platbu   - pokud null, tak jen hlavni modul, pokud jich je vice tak prazdny retezec znamena hlavni modul
}

class FormChoice extends CheckNonexistentFieldsLogOnly
{
    public $formTitle;
    public $formKey;
    public $formItems; // Array of (value=>text)
}

class OrderReplyStatus extends CheckNonexistentFieldsLogOnly
{
    public $shopOrderNumber;  // melo by stacit jen to pairing info, asi toto odstranit
    public $shopPairingInfo;
    public $gwOrderNumber;
    public $gwPairingInfo; // druhe cislo transakce na platebni brane, typicky to, co je znamo az po vytvoreni transakce branou
    public $orderStatus; // typ OrderStatus
    public $resultText; // pouziva se pri neuspechu pro predani detailni chybove hlasky
    public $successHtml; // pouziva se pri ok nebo pendingu pro zobrazeni instrukci k offile platbe, zobrazi se na strane s podekovanim za platbu
    public $forexNote;
    public $uniAdapterData;        // serialized from blob
}

class OrderStatus extends CheckNonexistentFieldsLogOnly
{
    public static $initiated = 0;
    public static $successful = 1;
    public static $pending = 2;
    public static $failedRetriable = 3;
    public static $failedFinal = 4;
    public static $invalidReply = 5;  // muze byt pouzito i pro nic nerikajici stavy, aby se nezpracovali, napr PayU stav 1.
    public static $gwUnpaired = 6;
}

class RedirectAction extends CheckNonexistentFieldsLogOnly
{
    // bude zadne z nasledujicich tri, nebo vyplneno redirectUrl nebo redirectForm nebo inlineForm, pokud inlineForm tak totez i v redirectForm pro zpetnou kompatibilitu
    public $redirectUrl;
    public $redirectForm;
    public $inlineForm;
    public $orderReplyStatus;  // vysledek hned, obvykle kdyz nelze provest platbu, nebo kdyz je nutno vytvorit objednavku soucasne s presmerovanim na branu
}

class InfoBoxData extends CheckNonexistentFieldsLogOnly
{
    public $title;
    public $image;
    public $link;
    public $platitiLink;
    public $platitiLinkText;
}
