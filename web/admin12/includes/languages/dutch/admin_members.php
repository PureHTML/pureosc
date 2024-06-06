<?php
/*
  $Id: admin_members.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Admin Groepen');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Groepen samenstellen');
} else {
  define('HEADING_TITLE', 'Admin leden');
}

define('TEXT_COUNT_GROUPS', 'Groepen: ');

define('TABLE_HEADING_NAME', 'Naam');
define('TABLE_HEADING_EMAIL', 'Email-Adres');
define('TABLE_HEADING_PASSWORD', 'Wachtwoord');
define('TABLE_HEADING_CONFIRM', 'Bevestig wachtwoord');
define('TABLE_HEADING_GROUPS', 'Groep levels');
define('TABLE_HEADING_CREATED', 'Account gemaakt');
define('TABLE_HEADING_MODIFIED', 'Account gemaakt');
define('TABLE_HEADING_LOGDATE', 'Laatste toegang');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Log Nummer');
define('TABLE_HEADING_ACTION', 'Action');

define('TABLE_HEADING_GROUPS_NAME', 'Groepnaam');
define('TABLE_HEADING_GROUPS_DEFINE', 'Onderdelen en bestanden selectie');
define('TABLE_HEADING_GROUPS_GROUP', 'Level');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Categorie toegang');

define('TEXT_INFO_HEADING_DEFAULT', 'Admin lid ');
define('TEXT_INFO_HEADING_DELETE', 'Verwijder permisies ');
define('TEXT_INFO_HEADING_EDIT', 'Wijzig categorie / ');
define('TEXT_INFO_HEADING_NEW', 'Nieuw Admin lid toevoegen ');

define('TEXT_INFO_DEFAULT_INTRO', 'Ledengroep');
define('TEXT_INFO_DELETE_INTRO', 'Verwijder <nobr><b>%s</b></nobr> van <nobr>Admin leden?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Je kan  <nobr>%s groep niet verwijderen!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Stel permisie level in: ');

define('TEXT_INFO_FULLNAME', 'Naam: ');
define('TEXT_INFO_FIRSTNAME', 'voornaam: ');
define('TEXT_INFO_LASTNAME', 'Achternaam: ');
define('TEXT_INFO_EMAIL', 'Email-adres: ');
define('TEXT_INFO_PASSWORD', 'Wachtwoord: ');
define('TEXT_INFO_CONFIRM', 'Bevestig wachtwoord: ');
define('TEXT_INFO_CREATED', 'Account gemaakt: ');
define('TEXT_INFO_MODIFIED', 'Account gewijzigd: ');
define('TEXT_INFO_LOGDATE', 'Laatste toegang: ');
define('TEXT_INFO_LOGNUM', 'Log Nummer: ');
define('TEXT_INFO_GROUP', 'Groep Level: ');
define('TEXT_INFO_ERROR', '<font color="red">Email-adres is al eens gebruikt! Probeer opnieuw.</font>');

define('JS_ALERT_FIRSTNAME', '- Verplicht: Voornaam \n');
define('JS_ALERT_LASTNAME', '- Verplicht: Achternaam \n');
define('JS_ALERT_EMAIL', '- Verplicht: Email-adres \n');
define('JS_ALERT_EMAIL_FORMAT', '- Email-adres formaat is onjuist! \n');
define('JS_ALERT_EMAIL_USED', '- Email-adres is al eens gebruikt! \n');
define('JS_ALERT_LEVEL', '- Required: Groep lid \n');

define('ADMIN_EMAIL_SUBJECT', 'Nieuw Admin lid');
define('ADMIN_EMAIL_TEXT', 'Hoi %s,' . "\n\n" . 'Je kan het Adminpaneel benaderen met het onderstaande wachtwoord. Eenmaal ingelogd is het raadzaam om het wachtwoord te veranderen!' . "\n\n" . 'Website : %s' . "\n" . 'Loginnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Bedankt!' . "\n" . '%s' . "\n\n" . 'Dit is een automagisch gemaakt bericht, het is niet nodig om een reply te sturen!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Admin Member Profile Edit');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hoi %s,' . "\n\n" . 'Je persoonlijke informatie is aangepast door een administrator.' . "\n\n" . 'Website : %s' . "\n" . 'Loginnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Bedankt!' . "\n" . '%s' . "\n\n" . 'Dit is een automagisch gemaakt bericht, het is niet nodig om een reply te sturen!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Admin Groep ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Verwijder Groep ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>Attentie:</b><li><b>edit:</b> Wijzig groepnaam.</li><li><b>Verwijder:</b> Verwijder groep.</li><li><b>Stel in:</b> Stel de groep toegang in.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Dit verwijderd ook alle leden van deze groep, weet je zeker dat je de groep  <nobr><b>%s</b> wilt verwijderen?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Je kan deze groep niet verwijderen!');
define('TEXT_INFO_GROUPS_INTRO', 'Verzin een unieke groepnaam. Klik volgende om de wijziging door te voeren.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Verzin een unieke groepnaam. Klik volgende om de wijziging door te voeren.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Admin Groep');
define('TEXT_INFO_HEADING_GROUPS', 'Nieuwe Groep');
define('TEXT_INFO_GROUPS_NAME', ' <b>Groepnaam:</b><br />Verzin een unieke groepnaamname. Klik volgende om de wijziging door te voeren.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERROR:</b> De groepnaam moet meer dan 5 letters bevatten!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERROR:</b> Deze groepnaam is al aanwezig!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Groep Level: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Onderdelen permisies:</b><br />Geef toegang tot de volgende onderdelen.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Inclusief opgeslagen bestanden: ');

define('TEXT_INFO_HEADING_DEFINE', 'Maak groep');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />je kan de bestandspermisies niet wijzigen van deze groep.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Wijzig de permisies van deze groep door onderdelen te selecteren of de-selecteren en bestanden. Klik <b>Opslaan</b> om de wijzigingen door te voeren.<br /><br />');
}


// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','Categorie Access:');
define('TEXT_RIGHTS_CNEW','create Categorie');
define('TEXT_RIGHTS_CEDIT','edit Categorie');
define('TEXT_RIGHTS_CMOVE','move Categorie');
define('TEXT_RIGHTS_CDELETE','delete Categorie');
define('TEXT_RIGHTS_PNEW','create Product');
define('TEXT_RIGHTS_PEDIT','edit product');
define('TEXT_RIGHTS_PMOVE','move Product');
define('TEXT_RIGHTS_PCOPY','copy Product');
define('TEXT_RIGHTS_PDELETE','delete Product');
// EOF: KategorienAdmin / OLISWISS
?>