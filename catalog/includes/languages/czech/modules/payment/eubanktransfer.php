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

\define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_TITLE', 'EU bankovní převod');
\define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_DESCRIPTION', ''.
'Převeďte celkovou částku na uvedený bankovní účet. Nezapomeňte uvést své jméno a číslo objednávky jako odesílatele.<br />'.
'<br />účet: '.MODULE_PAYMENT_EU_ACCOUNT_HOLDER.
'<br />Účet IBAN: '.MODULE_PAYMENT_EU_IBAN.
'<br />BIC/SWIFT-kod: '.MODULE_PAYMENT_EU_BIC.
'<br />Banka: '.MODULE_PAYMENT_EU_BANKNAME.
'<br /><br /><b>Notera:</b> Rozhodli jste se zaplatit bankovním převodem, ujistěte se, že platba je v náš bankovní účet do 7 dnů, jinak bude vaše objednávka vymazány.<br />Máme loď, pokud platba byla zapsána v náš bankovní účet!<br />');

\define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_EMAIL_FOOTER', "Převeďte celkovou částku na uvedený bankovní účet. Zadejte své jméno a číslo objednávky jako odesílatele.\n".
'účet: '.MODULE_PAYMENT_EU_ACCOUNT_HOLDER."\n".
'Účet IBAN: '.MODULE_PAYMENT_EU_IBAN."\n".
'BIC/SWIFT-kod: '.MODULE_PAYMENT_EU_BIC."\n".
'Banka: '.MODULE_PAYMENT_EU_BANKNAME."\n\n".
"Poznámka: Rozhodli jste se zaplatit bankovním převodem, ujistěte se, že platba je v náš bankovní účet do 7 dnů, jinak bude vaše objednávka vymazány.\n".
'Máme loď, pokud platba byla zapsána v náš bankovní účet!');
