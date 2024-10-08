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

\define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_TITLE', 'PayPal platby Standardní');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PUBLIC_TITLE', 'PayPal (včetně kreditních a debetních karet)');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_DESCRIPTION', '<img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&paypal&oscom23&payments_standard" target="_blank" style="text-decoration: underline; font-weight: bold;">Zobrazit online dokumentace</a><br /><br /><img src="images/icon_popup.gif" border="0" />&nbsp;<a href="https://www.paypal.com" target="_blank" style="text-decoration: underline; font-weight: bold;">Navštívit PayPal web</a>');

\define('MODULE_PAYMENT_PAYPAL_STANDARD_ERROR_ADMIN_CURL', 'Tento modul vyžaduje cURL, aby bylo možno v PHP a nenačte, dokud to bylo povoleno na tomto webovém serveru.');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_ERROR_ADMIN_CONFIGURATION', 'Tento modul nenačte, dokud není konfigurován parametr Adresa E-mail prodávajícího. Prosím, upravovat a konfigurovat nastavení tohoto modulu.');

\define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PAYPAL_RETURN_BUTTON', 'Zpět na '.STORE_NAME); // Maximum length 60 characters, otherwise it is ignored.
\define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_INVALID_TRANSACTION', 'Nelze ověřit transakce PayPal. Zkuste to prosím znovu.');

\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_LINK_TITLE', 'Test API Server Connection');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_TITLE', 'API Connection Server Test');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_GENERAL_TEXT', 'Testování připojení k serveru ..');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_BUTTON_CLOSE', 'Zavřete');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_TIME', 'Časový limit připojení:');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_SUCCESS', 'Úspěch!');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_FAILED', 'Nepodařilo! Přečtěte si prosím Zkontrolujte nastavení SSL certifikát a zkuste to znovu.');
\define('MODULE_PAYMENT_PAYPAL_STANDARD_DIALOG_CONNECTION_ERROR', 'Došlo k chybě. Prosím aktualizujte stránku, zkontrolujte nastavení a zkuste to znovu.');
