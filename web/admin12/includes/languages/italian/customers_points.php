<?php
/*
  $Id: customers_points.php, v 1.60 2005/NOV/03 15:17:12 dgw_ Exp $
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('MOD_VER', '2.00');

define('HEADING_TITLE', 'Customers Qualified Points');
define('HEADING_RATE', 'Importo del cambio: ');
define('HEADING_AWARDS', 'Premi : ');
define('HEADING_REDEEM', 'Riscuoti : ');
define('HEADING_POINT', 'Punto');
define('HEADING_POINTS', 'Punti');
define('HEADING_TITLE_SEARCH', 'Cerca id, nome o Mese scadenza(es: Maggio=05)');

define('TABLE_HEADING_FIRSTNAME', 'Nome');
define('TABLE_HEADING_LASTNAME', 'Cognome');
define('TABLE_HEADING_DOB', 'Data di nascita');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_POINTS', 'Punti');
define('TABLE_HEADING_POINTS_VALUE', 'Valore');
define('TABLE_HEADING_POINTS_EXPIRES', 'Scadenza');

define('TABLE_HEADING_SORT', 'Ordina questa colonna per');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C From Top');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 From Top');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X From Top');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 From Top');

define('TEXT_SHOW_ALL', 'Vedi tutto');
define('TEXT_SORT_CUSTOMERS', 'Vedi Utenti');
define('TEXT_SORT_POINTS', 'Con punti');
define('TEXT_SORT_NO_POINTS', 'Senza punti');
define('TEXT_SORT_BIRTH', 'Compleanno questo mese');
define('TEXT_SORT_BIRTH_NEXT', 'Compleanno mese prossimo');
define('TEXT_SORT_EXPIRE', 'Scadenza questo mese');
define('TEXT_SORT_EXPIRE_NEXT', 'Scadenza mese prossimo');
define('TEXT_SORT_EXPIRE_WIN', 'Scadenza entro 1 mese');


define('TEXT_DATE_ACCOUNT_CREATED', 'Account Creato:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ultima modifica:');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Sistema punti utente.');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Orders Total :');
define('TEXT_INFO_NUMBER_OF_PENDING', 'Totale punti in corso:');

define('TEXT_ADD_POINTS', 'Aggiungi punti.');
define('TEXT_ADD_POINTS_LONG', 'You can add points to customer with/without queuing points table.<br />Queuing will add a line to table with your comment else, points account updated only(if customer notify your comment will be added to the email) .');
define('TEXT_ADJUST_INTRO', 'Questa opzione ti premette di modificare velocemente il valore totale dei punti.<br />Questa sostituira\' il valore dei punti senza alcuna notifica al cliente.');
define('TEXT_DELETE_POINTS', 'Cancella punti.');
define('TEXT_DELETE_POINTS_LONG', 'You can remove points to customer with/without queuing points table.<br />Queuing will add a line to table with your comment else, points account updated only(if customer notify your comment will be added to the email) .');
define('TEXT_POINTS_TO_ADD', 'Punti da aggiungere :');
define('TEXT_POINTS_TO_ADJUST', 'Nuovo valore dei punti :');
define('TEXT_POINTS_TO_DELETE', 'Punti da cancellare :');
define('TEXT_COMMENT', 'Commenti :');

define('TEXT_QUEUE_POINTS_TABLE', 'Queue customers points table?');
define('TEXT_NOTIFY_CUSTOMER', 'Notifica utente');
define('TEXT_SET_EXPIRE', 'Imposta la nuova data di scadenza');

define('BUTTON_TEXT_ADD_POINTS', 'Aggiungi punti');
define('BUTTON_TEXT_DELETE_POINTS', 'Rimuovi punti');
define('BUTTON_TEXT_ADJUST_POINTS', 'Aggiusta il valore corrente dei punti');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Points Account Update .');
define('EMAIL_GREET_MR', '<b>Spett. Sig. %s,</b>');
define('EMAIL_GREET_MS', 'Spett. Sig.ra %s,');
define('EMAIL_GREET_NONE', 'Caro %s');
define('EMAIL_TEXT_INTRO', 'Ti informiamo che i tuoi Punti sono stati aggiornati.');
define('EMAIL_TEXT_BALANCE_ADD', 'Congratulazione! ' . "\n" . 'We have credited your account with total of %s points valued at %s');
define('EMAIL_TEXT_BALANCE_DEL', 'We are sorry but your Shopping Point account had been deducted with total of %s points valued at %s .');
define('EMAIL_TEXT_BALANCE', 'Your current Shopping Points balance is: %s points valued at %s .');
define('EMAIL_TEXT_EXPIRE', 'Scadenza dei punti: %s .');
define('EMAIL_TEXT_POINTS_URL', 'Per praticit&agrave; ti indichiamo il link per visualizzare l&#39; ammontare dei tuoi punti. %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'La FAQ del nostro programma a Punti la trovi qui. %s');
define('EMAIL_TEXT_COMMENT', 'Commenti: %s');
define('EMAIL_TEXT_SUCCESS_POINTS', 'I punti sono disponibili nel tuo account, durante la fase di pagamento sarai abilitato ad utilizzare i punti accumulati. '. "\n" .'Grazie per aver fatto acquisti su ' . STORE_NAME . ' con la speranza di rivederci presto.');
define('EMAIL_CONTACT', 'Se hai qualche domanda da farci o hai bisogno d\'aiuto scrivici a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Questa e\' una risposta automatica, si prega di non replicare!');

define('SUCCESS_POINTS_UPDATED', 'Successo: Punti aggiornati con successo.');
define('SUCCESS_DATABASE_UPDATED', 'Queue Success: Database has been successfully updated with this comment " '. $comment . ' ".');
define('NOTICE_EMAIL_SENT_TO', 'Avviso: Email inviata a: %s');
define('WARNING_DATABASE_NOT_UPDATED', 'Attenzione: Campi vuoti, nessuna modifica. Il Database non ha subito modifiche.');
define('POINTS_ENTER_JS_ERROR', 'Inserimento non valido! \n Accettati solo numeri!');

define('TEXT_LINK_CREDIT', 'Clicca qui per eseguire <a href="customers_points_credit.php"><u>Auto Credit</u></a> o <a href="customers_points_expire.php"><u>Auto Expire</u></a> script manualmente.');
?>
