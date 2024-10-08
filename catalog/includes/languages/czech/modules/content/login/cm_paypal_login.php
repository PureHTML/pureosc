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

\define('MODULE_CONTENT_PAYPAL_LOGIN_TITLE', 'Přihlásit se přes PayPal');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DESCRIPTION', 'Povolení se přihlásit pomocí PayPal s bezproblémovou Checkout PayPal Express Checkout plateb<br /><br /><img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&paypal&oscom23&log_in" target="_blank" style="text-decoration: underline; font-weight: bold;">Zobrazit online dokumentace</a><br /><br /><img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.paypal.com" target="_blank" style="text-decoration: underline; font-weight: bold;">Navštívit PayPal web</a>');

\define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_TITLE', 'Přihlásit se přes PayPal');
\define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_CONTENT', 'Máte účet PayPal? Bezpečně se přihlásit pomocí PayPal nakupovat ještě rychleji!');
\define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_SANDBOX', 'Testovací režim: Sandbox Server je aktuálně vybrán.');

\define('MODULE_CONTENT_PAYPAL_LOGIN_ERROR_ADMIN_CURL', 'Tento modul vyžaduje cURL, aby bylo možno v PHP a nenačte, dokud to bylo povoleno na tomto webovém serveru.');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ERROR_ADMIN_CONFIGURATION', 'Tento modul nenačte, dokud byly nakonfigurovány ID klienta a tajné parametry. Prosím, upravovat a konfigurovat nastavení tohoto modulu.');

\define('MODULE_CONTENT_PAYPAL_LOGIN_LANGUAGE_LOCALE', 'en_US');

\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_personal', 'osobní údaje');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_address', 'adresa Informace');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_account', 'Informace o účtu');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_checkout', 'Pokladna Express');

\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_full_name', 'Jméno a příjmení');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_date_of_birth', 'Datum narození');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_age_range', 'věkové rozpětí');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_gender', 'Pohlaví');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_email_address', 'E-mailová adresa');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_street_address', 'Ulice');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_city', 'Město');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_state', 'stát');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_country', 'Země');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_zip_code', 'PSČ');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_phone', 'Telefon');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_status', 'Stav účtu (ověření)');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_type', 'Typ účtu');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_creation_date', 'Vytvoření účtu Datum');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_time_zone', 'Časové pásmo');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_locale', 'Národní');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_language', 'Jazyk');
\define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_seamless_checkout', <<<'EOD'
Bezešvé Pokladna

EOD);

\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_LINK_TITLE', 'Test API Server Connection');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_TITLE', 'API Connection Server Test');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_GENERAL_TEXT', 'Testování připojení k serveru ..');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_BUTTON_CLOSE', 'Zavřete');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_TIME', 'Časový limit připojení:');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_SUCCESS', 'Úspěch!');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_FAILED', 'Nepodařilo! Přečtěte si prosím Zkontrolujte nastavení SSL certifikát a zkuste to znovu.');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_ERROR', 'Došlo k chybě. Prosím aktualizujte stránku, zkontrolujte nastavení a zkuste to znovu.');

\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_LINK_TITLE', 'Zobrazit PayPal aplikací URL');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_TITLE', 'PayPal použití adresy URL');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_RETURN_TEXT', 'Přesměrování / Return URL:');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_PRIVACY_TEXT', 'Ochrana osobních údajů URL:');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_TERMS_TEXT', 'Pravidla pro uživatele URL:');
\define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_BUTTON_CLOSE', 'Zavřete');
