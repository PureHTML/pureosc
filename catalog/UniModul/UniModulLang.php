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

$dict['cs']['unsupportedCurrency'] = 'Nelze platit v';
$dict['en']['unsupportedCurrency'] = 'Unsupported currency';
$dict['sk']['unsupportedCurrency'] = 'Nie je možné platiť v';
$dict['ru']['unsupportedCurrency'] = 'Не поддерживается валюта';
$dict['pl']['unsupportedCurrency'] = 'Płatność niemożliwa w';   // Płatność w ...? niemożliwa
$dict['de']['unsupportedCurrency'] = 'Es ist nicht möglich zahlen in';   // Płatność w ...? niemożliwa
$dict['es']['unsupportedCurrency'] = 'Moneda no admitida';
$dict['hu']['unsupportedCurrency'] = 'Nem támogatott valuta';
$dict['ro']['unsupportedCurrency'] = 'Monedă neacceptată';

$dict['cs']['forexMessageTemplate'] = 'Vaše platba bude převedena na {newtotalstr} {newcur} s kurzem 1 {actcur} = {ratestr} {newcur}';
$dict['en']['forexMessageTemplate'] = 'Your payment will be converted to {newtotalstr} {newcur} at exchange rate 1 {actcur} = {ratestr} {newcur}';
$dict['sk']['forexMessageTemplate'] = 'Vaša platba bude prevedená na {newtotalstr} {newcur} s kurzom 1 {actcur} = {ratestr} {newcur}';
$dict['pl']['forexMessageTemplate'] = 'Twoja płatność zostanie przewalutowana na {newtotalstr} {newcur} według kursu 1 {actcur} = {ratestr} {newcur}';
$dict['ru']['forexMessageTemplate'] = 'Ваш платеж будет преобразован в {newtotalstr} {newcur} по курсу 1 {actcur} = {ratestr} {newcur}';
$dict['de']['forexMessageTemplate'] = 'Ihre Zahlung wird umgerechnet auf {newtotalstr} {newcur} mit dem Kurz 1 {actcur} = {ratestr} {newcur}';
$dict['es']['forexMessageTemplate'] = 'Se convertirá tu pago a {newtotalstr} {newcur} al tipo de cambio 1 {actcur} = {ratestr} {newcur}';
$dict['hu']['forexMessageTemplate'] = 'a kifizetés át lesz adva {newtotalstr} {newcur} a tanfolyamon 1 {actcur} = {ratestr} {newcur}';
$dict['ro']['forexMessageTemplate'] = 'Plata dvs. va fi convertită la {newtotalstr} {newcur} la cursul de schimb 1 {actcur} = {ratestr} {newcur}';

$dict['cs']['forexNoteLabel'] = 'Převedena měna';
$dict['en']['forexNoteLabel'] = 'Currency converted';
$dict['sk']['forexNoteLabel'] = 'Prevedená mena';
$dict['pl']['forexNoteLabel'] = 'Waluta po przewalutowaniu';
$dict['ru']['forexNoteLabel'] = 'Валюта конвертируется';
$dict['de']['forexNoteLabel'] = 'Währung umgerechnet.';
$dict['es']['forexNoteLabel'] = 'Moneda convertida';
$dict['hu']['forexNoteLabel'] = 'átutalt pénznem';
$dict['ro']['forexNoteLabel'] = 'Moneda convertită';

$dict['cs']['nullOrderStatus'] = '(žádný)';
$dict['en']['nullOrderStatus'] = '(none)';
$dict['sk']['nullOrderStatus'] = '(žiadny)';
$dict['de']['nullOrderStatus'] = '(keiner)';
$dict['hu']['nullOrderStatus'] = '(egyik sem)';
$dict['ro']['nullOrderStatus'] = '(nici unul)';

$dict['cs']['infoBoxPlatitiLinkText'] = 'Modul {modulname} pro {shopname} od platiti.cz';
$dict['en']['infoBoxPlatitiLinkText'] = 'Module {modulname} for {shopname} by platiti.cz';
$dict['sk']['infoBoxPlatitiLinkText'] = 'Modul {modulname} pre {shopname} od platiti.cz';
$dict['pl']['infoBoxPlatitiLinkText'] = 'Płatność {modulname} w sklepie {shopname} za pomocą systemu platiti.cz';
$dict['ru']['infoBoxPlatitiLinkText'] = 'Модуль {modulname} от {shopname} platiti.cz';
$dict['de']['infoBoxPlatitiLinkText'] = 'Modul {modulname} für {shopname} von platiti.cz';
$dict['es']['infoBoxPlatitiLinkText'] = 'Módulo {modulname} para {shopname} por platiti.cz';
$dict['hu']['infoBoxPlatitiLinkText'] = 'Modul {modulname} mert {shopname} által platiti.cz';
$dict['ro']['infoBoxPlatitiLinkText'] = 'Modulul {modulname} pentru {shopname} de către platiti.cz';

// config

// std ciselniky

$dict['cs']['yes'] = 'ano';
$dict['en']['yes'] = 'yes';
$dict['sk']['yes'] = 'áno';
$dict['ru']['yes'] = 'да';
$dict['es']['yes'] = 'sí';
$dict['hu']['yes'] = 'igen';
$dict['de']['yes'] = 'ja';
$dict['ro']['yes'] = 'da';

$dict['cs']['no'] = 'ne';
$dict['en']['no'] = 'no';
$dict['sk']['no'] = 'nie';
$dict['ru']['no'] = 'нет';
$dict['es']['no'] = 'no';
$dict['hu']['no'] = 'nem';
$dict['de']['no'] = 'nein';
$dict['ro']['no'] = 'nu';

// std ke stavum obj

$dict['cs']['orderStatusSuccessfull'] = 'Stav objednávky po úspěšném zaplacení';
$dict['en']['orderStatusSuccessfull'] = 'Order state after successful payment';
$dict['sk']['orderStatusSuccessfull'] = 'Stav objednávky po úspešnom zaplatení';
$dict['ru']['orderStatusSuccessfull'] = 'Состояние заказа после успешной оплаты';
$dict['es']['orderStatusSuccessfull'] = 'Estado del pedido después del pago aceptado';
$dict['hu']['orderStatusSuccessfull'] = 'Megrendelés sikeres kifizetés után';
$dict['de']['orderStatusSuccessfull'] = 'Bestellstatus nach erfolgreicher Zahlung';
$dict['ro']['orderStatusSuccessfull'] = 'Starea comenzii după plata cu succes';

$dict['cs']['orderStatusPending'] = 'Stav objednávky při čekání na převod prostředků';
$dict['en']['orderStatusPending'] = 'Order state when waiting for bank transfer';
$dict['sk']['orderStatusPending'] = 'Stav objednávky pri čakaní na prevod prostriedkov';
$dict['ru']['orderStatusPending'] = 'Состояние заказа при ожидании банковским переводом';
$dict['es']['orderStatusPending'] = 'Estado del pedido a la espera de la transferencia bancaria';
$dict['hu']['orderStatusPending'] = 'Rendelés állapota banki átutalás esetén';
$dict['de']['orderStatusPending'] = 'Bestellstatus beim Warten auf die Zahlung';
$dict['ro']['orderStatusPending'] = 'Starea comenzii atunci când așteptați transferul bancar';

$dict['cs']['orderStatusFailed'] = 'Stav objednávky při selhání pokusu o platbu';
$dict['en']['orderStatusFailed'] = 'Order state if payment failed';
$dict['sk']['orderStatusFailed'] = 'Stav objednávky pri zlyhaní pokusu o platbu';
$dict['ru']['orderStatusFailed'] = 'Состояние заказа, если платеж не прошел';
$dict['es']['orderStatusFailed'] = 'Estado del pedido si el pago falla';
$dict['hu']['orderStatusFailed'] = 'Rendelés állapota, ha a fizetés sikertelen';
$dict['de']['orderStatusFailed'] = 'Bestellstatus nach fehlgeschlagener Zahlung';
$dict['ro']['orderStatusFailed'] = 'Starea comenzii dacă plata nu a reușit';

$dict['cs']['supportedCurrencies'] = 'Podporované měny (3-písmené ISO kódy oddělené mezerou, např. "CZK EUR")';
$dict['en']['supportedCurrencies'] = 'Supported currencies (3-letter ISO codes separated by space, e.g. "CZK EUR")';
$dict['sk']['supportedCurrencies'] = 'Podporované meny (3-písmená ISO kódy oddelené medzerou, napr. "EUR CZK")';
$dict['ru']['supportedCurrencies'] = 'Поддерживаемые валюты (коды 3 ISO через пробел, например, "CZK EUR")';
$dict['es']['supportedCurrencies'] = 'Monedas admitidas (códigos ISO de 3 letras separados por espacio, ejemplo: "CZK EUR")';
$dict['hu']['supportedCurrencies'] = 'Támogatott pénznemek (3-betűs ISO kódok térközzel elválasztva, például "HUF EUR")';
$dict['de']['supportedCurrencies'] = 'Unterstützte Währungen (durch Leerzeichen getrennte 3-Buchstaben-ISO-Codes, z. B. "CZK EUR")';
$dict['ro']['supportedCurrencies'] = 'Monede acceptate (coduri ISO de 3 litere separate prin spațiu, de ex. "CZK EUR")';

$dict['cs']['convertToCurrencyIfUnsupported'] = 'Měna pro pro převod, pokud platební metoda měnu košíku nepodporuje, prázdné = nepřevádět';
$dict['en']['convertToCurrencyIfUnsupported'] = 'Currency for conversion if the cart currency is not supported by payment method, empty = do not convert';
$dict['sk']['convertToCurrencyIfUnsupported'] = 'Mena pre prevod, ak platobná metóda menu košíka nepodporuje, prázdne = neuskutočniť prevod';
$dict['ru']['convertToCurrencyIfUnsupported'] = 'Курсы для преобразования, если корзина валют не поддерживается способа оплаты, empty = do not convert';
$dict['es']['convertToCurrencyIfUnsupported'] = 'Moneda para la conversión si el método de pago no admite el método de compra, vacío = no convertir';
$dict['hu']['convertToCurrencyIfUnsupported'] = 'konverziós pénznem, ha a kosár pénzneme nem támogatott fizetési móddal, üres = nem konvertál';
$dict['de']['convertToCurrencyIfUnsupported'] = 'Umrechnungswährung Wenn die Warenkorbwährung nicht von der Zahlungsmethode unterstützt wird, leer = nicht umrechnen';
$dict['ro']['convertToCurrencyIfUnsupported'] = 'Monedă pentru conversie dacă moneda coșului nu este acceptată de metoda de plată, goală = nu convertiți';

$dict['cs']['subMethodsSelection'] = 'Povolené platební metody';
$dict['en']['subMethodsSelection'] = 'Enabled payment methods';
$dict['sk']['subMethodsSelection'] = 'Povolené platobné metody';
$dict['ru']['subMethodsSelection'] = 'Включено способы оплаты';
$dict['es']['subMethodsSelection'] = 'Métodos de pago habilitados';
$dict['hu']['subMethodsSelection'] = 'Engedélyezett fizetési módok';
$dict['de']['subMethodsSelection'] = 'Aktivierte Zahlungsmethoden';
$dict['ro']['subMethodsSelection'] = 'Metode de plată activate';

$dict['cs']['activationKey'] = 'Aktivační klíč';
$dict['en']['activationKey'] = 'Activation key';
$dict['sk']['activationKey'] = 'Aktivačný kľúč';
$dict['es']['activationKey'] = 'Clave de activación';
$dict['hu']['activationKey'] = 'aktivációs kulcs';
$dict['de']['activationKey'] = 'Aktivierungsschlüssel';
$dict['ro']['activationKey'] = 'Cheie de activare';

$dict['cs']['gwOrderNumberOffset'] = 'Číslo první platby na platební bráně (nastavit na 1000 a pak už neměnit)';
$dict['en']['gwOrderNumberOffset'] = 'Gateway order number offset (recommended value 1000, do not change after it is once set)';
$dict['sk']['gwOrderNumberOffset'] = 'Číslo prvej platby na platebnej bráne (nastaviť na 1000 a potom už nemeniť)';
$dict['ru']['gwOrderNumberOffset'] = 'Шлюз номер заказа смещение (рекомендуемое значение 1000, не изменяются после однократного установить)';
$dict['es']['gwOrderNumberOffset'] = 'Offset del número de pedido de plataforma (valor recomendado 1000, no cambiar después de configurado)';
$dict['de']['gwOrderNumberOffset'] = 'Erste Zahlungsnummer des Zahlungs-Gateways (auf 1000 eingestellt und nicht mehr ändern)';
$dict['ro']['gwOrderNumberOffset'] = 'Decalajul numărului comenzii gateway (valoarea recomandată 1000, nu se modifică după ce este setată odată)';

$dict['cs']['cronSecret'] = 'Heslo pro CRON';
$dict['sk']['cronSecret'] = 'Heslo pre CRON';
$dict['en']['cronSecret'] = 'Password for CRON';
$dict['de']['cronSecret'] = 'Passwort für Cron';
$dict['hu']['cronSecret'] = 'Jelszó a CRON számára';
$dict['ro']['cronSecret'] = 'Parola pentru CRON';
