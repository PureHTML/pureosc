<?php
/*
  $Id: admin_members.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Gruppi Admin');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Definisci Gruppi');
} else {
  define('HEADING_TITLE', 'Membri Admin');
}

define('TEXT_COUNT_GROUPS', 'Gruppi: ');

define('TABLE_HEADING_NAME', 'Nome');
define('TABLE_HEADING_EMAIL', 'Indirizzo Email');
define('TABLE_HEADING_PASSWORD', 'Password');
define('TABLE_HEADING_CONFIRM', 'Conferma Password');
define('TABLE_HEADING_GROUPS', 'Groups Level');
define('TABLE_HEADING_CREATED', 'Account Creato');
define('TABLE_HEADING_MODIFIED', 'Account Creato');
define('TABLE_HEADING_LOGDATE', 'Ultimo accesso');
define('TABLE_HEADING_LOGNUM', 'Accesso n.');
define('TABLE_HEADING_LOG_NUM', 'Accesso numero');
define('TABLE_HEADING_ACTION', 'Action');

define('TABLE_HEADING_GROUPS_NAME', 'Nome gruppo');
define('TABLE_HEADING_GROUPS_DEFINE', 'Selezione Boxes e Files');
define('TABLE_HEADING_GROUPS_GROUP', 'Livello');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Permessi Categorie');

define('TEXT_INFO_HEADING_DEFAULT', 'Membro Admin ');
define('TEXT_INFO_HEADING_DELETE', 'Cancella Permessi ');
define('TEXT_INFO_HEADING_EDIT', 'Modifica Categoria / ');
define('TEXT_INFO_HEADING_NEW', 'Nuovo membro Admin ');

define('TEXT_INFO_DEFAULT_INTRO', 'Member group');
define('TEXT_INFO_DELETE_INTRO', 'Rimuovi <div><b>%s</b></div> dai <div>Membri Admin?</div>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Puoi cancellare il<div>%s gruppo!</div>');
define('TEXT_INFO_EDIT_INTRO', 'Setta livello permessi qui: ');

define('TEXT_INFO_FULLNAME', 'Nome: ');
define('TEXT_INFO_FIRSTNAME', 'Nome: ');
define('TEXT_INFO_LASTNAME', 'Cognome: ');
define('TEXT_INFO_EMAIL', 'Indirizzo Email: ');
define('TEXT_INFO_PASSWORD', 'Password: ');
define('TEXT_INFO_CONFIRM', 'Conferma Password: ');
define('TEXT_INFO_CREATED', 'Account Creato: ');
define('TEXT_INFO_MODIFIED', 'Account Modificato: ');
define('TEXT_INFO_LOGDATE', 'Ultimo Accesso: ');
define('TEXT_INFO_LOGNUM', 'Log Numero: ');
define('TEXT_INFO_GROUP', 'Livello Gruppo: ');
define('TEXT_INFO_ERROR', '<font color="#ff0000">Indirizzo Email &egrave; gi&agrave; in uso! Inseriscine uno diverso.</font>');

define('JS_ALERT_FIRSTNAME', '- Richiesto: Nome \n');
define('JS_ALERT_LASTNAME', '- Richiesto: Cognome \n');
define('JS_ALERT_EMAIL', '- Richiesto: Indirizzo Email \n');
define('JS_ALERT_EMAIL_FORMAT', '- Indirizzo Email formato non valido! \n');
define('JS_ALERT_EMAIL_USED', '- Indirizzo Email &egrave; gi&agrave; in uso! \n');
define('JS_ALERT_LEVEL', '- Richiesto: Group Member \n');

define('ADMIN_EMAIL_SUBJECT', 'Nuovo Admin Member');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Puoi accedere all\' con la seguente password. Una volta eseguito l\'accesso, &egrave; consigliabile cambiare la tua password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Grazie!' . "\n" . '%s' . "\n\n" . 'Questa &egrave; una risposta automatica, non rispondere!'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Modifica profilo Admin Member');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hi %s,' . "\n\n" . 'Le tue informazioni personali sono state aggiornate da un amministratore.' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Grazie!' . "\n" . '%s' . "\n\n" . 'Questa e\' una risposta automatica, non rispondere!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Admin Gruppo ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Cancella Gruppo ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE:</b><ul><li><b>modifica:</b> modifica nome gruppo.</li><li><b>cancella:</b> cancella gruppo.</li><li><b>definisci:</b> definisci accesso al gruppo.</li></ul>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Stai per cancellare un membro di questo gruppo. Sei sicuro di voler cancellare <div><b>%s</b> group?</div>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Non puoi cancellare questo gruppo!');
define('TEXT_INFO_GROUPS_INTRO', 'Digita un nome gruppo unico. Clicca su next per conferma.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Digita un nome gruppo unico. Clicca su next per conferma.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Admin Gruppo');
define('TEXT_INFO_HEADING_GROUPS', 'Nuovo Gruppo');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nome Gruppo:</b><br />Digita un nome gruppo unico. Quindi, Clicca su next per conferma.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="#ff0000"><b>ERROR:</b> Il nome del Gruppo deve aver almeno 5 caratteri!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="#ff0000"><b>ERROR:</b> Gruppo gi&agrave; in uso!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Livello Gruppo: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Permessi Boxes:</b><br />Dai accesso ai boxes selezionati.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Includi i files all&#39;interno: ');

define('TEXT_INFO_HEADING_DEFINE', 'Definisci Gruppo');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Non puoi modificare i permessi di questo gruppo.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Cambia i permessi di questo gruppo selezionando o deselezionando i boxes ed i files necessari. Clicca <b>salva</b> per confermare i cambiamenti.<br /><br />');
}


// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','Categorie Access:');
define('TEXT_RIGHTS_CNEW','Crea Categorie');
define('TEXT_RIGHTS_CEDIT','Modifica Categorie');
define('TEXT_RIGHTS_CMOVE','Sposta Categorie');
define('TEXT_RIGHTS_CDELETE','Cancella Categorie');
define('TEXT_RIGHTS_PNEW','Crea Prodotto');
define('TEXT_RIGHTS_PEDIT','modifica Prodotto');
define('TEXT_RIGHTS_PMOVE','Sposta prodotto');
define('TEXT_RIGHTS_PCOPY','Copia Prodotto');
define('TEXT_RIGHTS_PDELETE','Cancella Prodotto');
// EOF: KategorienAdmin / OLISWISS
?>
