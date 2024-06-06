<?php
/*
  $Id: admin_members.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin Account');

define('TABLE_HEADING_ACCOUNT', 'Mijn Account');

define('TEXT_INFO_FULLNAME', '<b>Naam: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Voornam: </b>');
define('TEXT_INFO_LASTNAME', '<b>Achternaam: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Adres: </b>');
define('TEXT_INFO_PASSWORD', '<b>Wachtwoord: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Hidden-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Bevestig wachtwoord: </b>');
define('TEXT_INFO_CREATED', '<b>Account aangemaakt: </b>');
define('TEXT_INFO_LOGDATE', '<b>Laatste login: </b>');
define('TEXT_INFO_LOGNUM', '<b>Lognummer: </b>');
define('TEXT_INFO_GROUP', '<b>Groep level: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Dit Emailadres is al gebruikt! Probeer opnieuw.</font>');
define('TEXT_INFO_MODIFIED', 'Aangepast: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Wijzig Account ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Wachtwoord bevestiging ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Wachtwoord:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>ERROR:</b> Verkeeerd wachtwoord!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Klik de <b>Wijzig knop</b> hieronder om je account te wijzigen.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>Let op:</b><br />Hallo <b>%s</b>, Je bent hier voor de eerste keer, het raadzaam om het je wachtwoord te veranderen!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>Let op:</b><br />Hallo <b>%s</b>, Het is raadzaam om je Email te veranderen (<font color="red">admin@localhost</font>) en je wachtwoord!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alle velden zijn verplicht. Klik Opslaan om te wijzigen door te voeren.');

define('JS_ALERT_FIRSTNAME',        '- Verplicht: Voornaam \n');
define('JS_ALERT_LASTNAME',         '- Verplicht: Achternaam \n');
define('JS_ALERT_EMAIL',            '- Verplicht: Email-adres \n');
define('JS_ALERT_PASSWORD',         '- Verplicht: wachtwoord \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Voornaam lengte moet over');
define('JS_ALERT_LASTNAME_LENGTH',  '- Achternaam lengte moet over ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Wachtwoord lengte moet over ');
define('JS_ALERT_EMAIL_FORMAT',     '- Email-adres is verkeerd! \n');
define('JS_ALERT_EMAIL_USED',       '- Email-adres is al een keer gebruikt! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Wachtwoord is anders, probeer opnieuw! \n');

define('ADMIN_EMAIL_SUBJECT', 'Wijzig persoonlijke gegevens');
define('ADMIN_EMAIL_TEXT', 'Hoi %s,' . "\n\n" . 'Je persoonlijke gegeven zijn aangepast (misschien ook je wachtwoord) Als dit gebeurd is zonder jouw medeweten, neem dan onmiddelijk contact op met de administrator!' . "\n\n" . 'Website : %s' . "\n" . 'Loginnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Bedankt!' . "\n" . '%s' . "\n\n" . 'Dit is een automagische beantwoorder, stuur dus geen reply!');
?>