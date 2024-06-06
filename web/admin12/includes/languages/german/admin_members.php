<?php
/*
  $Id: admin_members.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Schließt Beitrag Ein:
  Zugang mit waagerecht ausgerichtetem Konto (v. 2.2a) für den Admin Bereich des osCommerce (MS2)

	Diese Akte kann gelöscht werden, wenn man den oben genannten Beitrag entfernt
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Administrator-Gruppen');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Gruppe definieren');
} else {
  define('HEADING_TITLE', 'Administrator-Mitglieder');
}

define('TEXT_COUNT_GROUPS', 'Gruppen: ');

define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_EMAIL', 'Email-Addresse');
define('TABLE_HEADING_PASSWORD', 'Kennwort');
define('TABLE_HEADING_CONFIRM', 'Best&auml;tigen Sie das Kennwort');
define('TABLE_HEADING_GROUPS', 'Gruppen-Ebne');
define('TABLE_HEADING_CREATED', 'Konto erzeugt');
define('TABLE_HEADING_MODIFIED', 'Konto bearbeitet');
define('TABLE_HEADING_LOGDATE', 'Letzte Anmeldung');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Anzahl Anmeldungen:');
define('TABLE_HEADING_ACTION', 'T&auml;tigkeit');

define('TABLE_HEADING_GROUPS_NAME', 'Gruppenname');
define('TABLE_HEADING_GROUPS_DEFINE', 'Wahl der Ordner und Dateien');
define('TABLE_HEADING_GROUPS_GROUP', 'Level');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Kategorien-Rechte');

define('TEXT_INFO_HEADING_DEFAULT', 'Administrator-Mitglied ');
define('TEXT_INFO_HEADING_DELETE', 'L&ouml;sch-Recht ');
define('TEXT_INFO_HEADING_EDIT', 'Kategorie bearbeiten / ');
define('TEXT_INFO_HEADING_NEW', 'Neues Administrator-Mitglied ');

define('TEXT_INFO_DEFAULT_INTRO', 'Mitgliedsgruppe');
define('TEXT_INFO_DELETE_INTRO', 'Entfernen Sie <nobr><b>%s</b></nobr> von den <nobr>Administrator-Gruppe?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Sie k&ouml;nnen nicht <nobr>%s Gruppe l&ouml;schen!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Zugriffsrechte hier definieren: ');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Vorname: ');
define('TEXT_INFO_LASTNAME', 'Nachname: ');
define('TEXT_INFO_EMAIL', 'Email-Addresse: ');
define('TEXT_INFO_PASSWORD', 'Kennwort: ');
define('TEXT_INFO_CONFIRM', 'Kennwort best&auml;tigen: ');
define('TEXT_INFO_CREATED', 'Konto erstellt: ');
define('TEXT_INFO_MODIFIED', 'Konto ge&auml;ndert: ');
define('TEXT_INFO_LOGDATE', 'Letzter Login: ');
define('TEXT_INFO_LOGNUM', 'Anzahl angemeldet: ');
define('TEXT_INFO_GROUP', 'Gruppe: ');
define('TEXT_INFO_ERROR', '<font color="red">Email Addresse ist bereits vergeben! Bitte erneut versuchen!</font>');

define('JS_ALERT_FIRSTNAME', '- Erforderlich: Vorname \n');
define('JS_ALERT_LASTNAME', '- Erforderlich: Nachname \n');
define('JS_ALERT_EMAIL', '- Erforderlich: Email-Addresse \n');
define('JS_ALERT_EMAIL_FORMAT', '- Format der Email-Addresse ist unzulässig! \n');
define('JS_ALERT_EMAIL_USED', '- Email-Addresse ist bereits vergeben! \n');
define('JS_ALERT_LEVEL', '- Erfordert: Gruppe \n');

define('ADMIN_EMAIL_SUBJECT', 'Neues Administrator Mitglied');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Sie können das Administrator-Pannel mit dem folgenden Kennwort öffnen. Bitte das Passwort sofort ändern!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Profil des Administrator wurde bearbeitet');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre persönlichen Informationen sind von einem Administrator aktualisiert worden.' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatissche Nachricht, bitte nicht antworten!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Administrator-Gruppe ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Gruppe l&ouml;schen ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>ANMERKUNG:</b><li><b>Bearbeiten:</b> Bearbeitung von Gruppennamen.</li><li><b>L&ouml;schen:</b> Gruppe l&ouml;schen.</li><li><b>Definieren:</b> Gruppenzugang definieren.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Das l&ouml;scht alle Mitglieder der Gruppe. Sind Sie sicher, dass Sie <nobr><b>%s</b> l&ouml;schen m&ouml;chten?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Gruppe kann nicht gel&ouml;scht werden!');
define('TEXT_INFO_GROUPS_INTRO', 'Gruppennamen eingeben.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Gruppennamen eingeben.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Administrator-Gruppe');
define('TEXT_INFO_HEADING_GROUPS', 'Neue Gruppe');
define('TEXT_INFO_GROUPS_NAME', ' <b>Gruppenname:</b><br />Gruppennnamen eingeben.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>Achtung:</b> Der Gruppenname muß mehr als 5 Buchstaben haben!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>Achtung:</b> Der Gruppenname existiert bereits!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Gruppe: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Ordner-Zugriff:</b><br />Zugang zu ausgew&auml;hlten Ordnern definieren.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Dateien im Ordner einbeziehen: ');

define('TEXT_INFO_HEADING_DEFINE', 'Gruppe definieren');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Sie k&ouml;nnen den Datei-Zugriff dieses Ordners nicht &auml;ndern.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Zugriffsrechte &auml;ndern, indem Dateien und Ordner markiert werden.<br /><br />');
}

// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','Kategoriezugriff:');
define('TEXT_RIGHTS_CNEW','Kategorie erstellen');
define('TEXT_RIGHTS_CEDIT','Kategorie bearbeiten');
define('TEXT_RIGHTS_CMOVE','Kategorie verschieben');
define('TEXT_RIGHTS_CDELETE','Kategorie löschen');
define('TEXT_RIGHTS_PNEW','Produkt erstellen');
define('TEXT_RIGHTS_PEDIT','Produkt bearbeiten');
define('TEXT_RIGHTS_PMOVE','Produkt verschieben');
define('TEXT_RIGHTS_PCOPY','Produkt kopieren');
define('TEXT_RIGHTS_PDELETE','Produkt löschen');
// EOF: KategorienAdmin / OLISWISS
?>
