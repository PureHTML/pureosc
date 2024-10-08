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

\define('NAVBAR_TITLE', 'Napište přátelům');

\define('HEADING_TITLE', 'Řekněte přátelům o \'%s\'');

\define('FORM_TITLE_CUSTOMER_DETAILS', 'Vaše údaje');
\define('FORM_TITLE_FRIEND_DETAILS', 'Váš Kamarádi Podrobnosti ');
\define('FORM_TITLE_FRIEND_MESSAGE', 'Vaše zpráva');

\define('FORM_FIELD_CUSTOMER_NAME', 'Vaše jméno:');
\define('FORM_FIELD_CUSTOMER_EMAIL', 'Vaše e-mailová adresa:');
\define('FORM_FIELD_FRIEND_NAME', 'Vaše Jméno přítele:');
\define('FORM_FIELD_FRIEND_EMAIL', 'Vaši přátelé E-mailová adresa:');

\define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Váš e-mail o <strong>%s</strong> byl úspěšně odeslán  <strong>%s</strong>.');

\define('TEXT_EMAIL_SUBJECT', 'Váš přítel %s doporučila tento skvělý produkt od %s');
\define('TEXT_EMAIL_INTRO', "Ahoj %s!\n\nTvůj přítel, %s, si myslel, že byste měli zájem %s od %s.");
\define('TEXT_EMAIL_LINK', "Chcete-li zobrazit produktu, klikněte na odkaz níže nebo zkopírovat a vložit odkaz do vašeho webového prohlížeče:\n\n%s");
\define('TEXT_EMAIL_SIGNATURE', "S pozdravem,\n\n%s");

\define('ERROR_TO_NAME', 'Chyba: Vaše jméno přátelé nesmí být prázdný.');
\define('ERROR_TO_ADDRESS', 'Chyba: Vaše přátele e-mailová adresa musí být platná e-mailová adresa.');
\define('ERROR_FROM_NAME', 'Chyba: Vaše jméno nesmí být prázdné.');
\define('ERROR_FROM_ADDRESS', 'Chyba: Vaše e-mailová adresa musí být platná e-mailová adresa.');
\define('ERROR_ACTION_RECORDER', 'Chyba: E-mail již byla odeslána. Zkuste to prosím znovu za %s minut.');
