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

\define('NAVBAR_TITLE_1', ' Přihlášení');
\define('NAVBAR_TITLE_2', 'Heslo Zapomněli');

\define('HEADING_TITLE', 'Zapomněl jsem své heslo !');

\define('TEXT_MAIN', 'Pokud jste zapomněli své heslo , zadejte níže svou e - mailovou adresu a my vám bude posílat instrukce, jak bezpečně změnit heslo .');

\define('TEXT_PASSWORD_RESET_INITIATED', 'Zkontrolujte prosím Váš e -mail pro instrukce o tom, jak změnit heslo . Pokyny obsahují odkaz, který je platný pouze po dobu 24 hodin nebo dokud heslo bylo aktualizováno.');

\define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Chyba :E - mailová adresa nebyla nalezena v našich záznamech , zkuste to prosím znovu .');

\define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME.' -  Nové heslo');
\define('EMAIL_PASSWORD_RESET_BODY', 'Bylo požádánoo nové heslo pro váš účet na '.STORE_NAME.".\n\nProsím, postupujte podle tohoto osobního odkaz bezpečně změnit heslo:\n\n%s\n\nTento odkaz bude automaticky vyřazeny po 24 hodinách nebo po provedení změny hesla.\n\nPro pomoc s některou z našich on-line služeb, napište store-majitel: ".STORE_OWNER_EMAIL_ADDRESS.".\n\n");

\define('ERROR_ACTION_RECORDER', 'Chyba: link Password Reset již byla odeslána. Zkuste to prosím znovu za %s minut.');
