<?php
/*
  $Id: customers_points_pending.php, v 1.60 2005/NOV/03 15:17:12 dgw_ Exp $
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('MOD_VER', '2.00');

define('HEADING_TITLE', 'Punti clienti in attesa');
define('HEADING_RATE', 'Cambio : ');
define('HEADING_AWARDS', 'Premi : ');
define('HEADING_REDEEM', 'Riscatto : ');
define('HEADING_POINT', 'punto');
define('HEADING_POINTS', 'punti');
define('HEADING_TITLE_SEARCH', 'Cerca ID Ordine:');

define('TABLE_HEADING_CUSTOMERS', 'Clienti');
define('TABLE_HEADING_ORDER_TOTAL', 'Totale ordine');
define('TABLE_HEADING_ORDERS_STATUS', 'Stato Ordini');
define('TABLE_HEADING_POINTS_STATUS', 'Stato Punti');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_POINTS', 'Punti');
define('TABLE_HEADING_POINTS_VALUE', 'Valore');

define('TABLE_HEADING_SORT', 'Ordina colonna per');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C From Top');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 From Top');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X From Top');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 From Top');

define('TEXT_DEFAULT_COMMENT', 'Shopping Points');
define('TEXT_DEFAULT_REDEEMED', 'Punti riscattati');

define('TEXT_POINTS_PENDING', 'In sospeso');
define('TEXT_POINTS_PROCESSING', 'Da processare');
define('TEXT_POINTS_CONFIRMED', 'Confermati');
define('TEXT_POINTS_CANCELLED', 'Cancellati');
define('TEXT_POINTS_REDEEMED', 'Riscattati');

define('TEXT_SHOW_ALL', 'Vedi tutto');

define('TEXT_INFO_POINTS_COMMENT', 'Commento sui punti : ');
define('TEXT_INFO_PAYMENT_METHOD', 'Metodo di pagamento: ');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Adjust Pending Points.');
define('TEXT_INFO_HEADING_DELETE_RECORD', 'Cancella record');
define('TEXT_INFO_HEADING_PENDING_NO', 'Punti in sospeso per l&#39;ordine n.');
define('TEXT_CONFIRM_POINTS', 'Confermare i punti in sospeso al cliente?');
define('TEXT_CONFIRM_POINTS_LONG', 'You can confirm points to customer with/without queuing points table.<br />confirming points without queuing will remove this line from table else, the Current points status will replaced with "Confirmed" .');
define('TEXT_CANCEL_POINTS', 'Cancel Customer Pending Points?');
define('TEXT_CANCEL_POINTS_LONG', 'You can cancel points to customer with/without queuing points table.<br />Cancelling points without queuing will remove this line from table else, pending points status will show "Cancelled" and default comment will be replaced with your Cancellation Reason.');
define('TEXT_CANCELLATION_REASON', 'Motivo della cancellazione:');
define('TEXT_ADJUST_INTRO', 'This option enable you to adjust the total amount of pending points before confirming them.<br />Note that this will replace the current pending points amount and can not be undone.');
define('TEXT_DELETE_INTRO', 'Sei sicuro di voler cancellare questo record ?<br />Cancellera\' definitivamente questo record dal database.');
define('TEXT_POINTS_TO_ADJUST', 'Inporto dei nuovi punti:');
define('TEXT_ROLL_POINTS', 'Riduzione dei punti.');
define('TEXT_ROLL_POINTS_LONG', 'This option enable you to rollback confirmed points to pending status.<br />Points will be deducted from customer account and status will show default pending status.');
define('TEXT_ROLL_REASON', 'Motivo della riduzione:');

define('TEXT_QUEUE_POINTS_TABLE', 'Queue customers points table');
define('TEXT_NOTIFY_CUSTOMER', 'Notifica al cliente');
define('TEXT_SET_EXPIRE', 'Setta la nuova data di scadenza');

define('BUTTON_TEXT_ADJUST_POINTS', 'Adjust the current pending points amount');
define('BUTTON_TEXT_CANCEL_PENDING_POINTS', 'Cancella i punti cliente');
define('BUTTON_TEXT_CONFIRM_PENDING_POINTS', 'Conferma i punti del cliente');
define('BUTTON_TEXT_REMOVE_RECORD', 'Cancella questo record dal database');
define('BUTTON_TEXT_ROLL_POINTS', 'Riduci i punti in sospeso');
define('ICON_PREVIEW_EDIT', 'Vedi dettaglio ordine o modifica stato');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Aggiornamento punti.');
define('EMAIL_GREET_MR', 'Spett. Sig. %s,');
define('EMAIL_GREET_MS', 'Spett. Sig.ra %s,');
define('EMAIL_GREET_NONE', 'Caro %s');
define('EMAIL_TEXT_ORDER_NUMBER', 'Ordine n.:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data ordine:');
define('EMAIL_TEXT_ORDER_STAUTS', 'Stato ordine:');
define('EMAIL_TEXT_INTRO', 'Ti informiamo che i punti del tuo account sono stati aggiornati.');
define('EMAIL_TEXT_BALANCE_CANCELLED', 'Spiacenti, ma abbiamo cancellato i tuoi punti per l\'ordine seguente.');
define('EMAIL_TEXT_BALANCE_CONFIRMED', 'Punti confermati per l\'ordine seguente.');
define('EMAIL_TEXT_BALANCE_ROLL_BACK', 'I Punti confermati per l\'ordine seguente sono ritornati allo stato precedente.');
define('EMAIL_TEXT_ROLL_COMMENT', 'Commenti :');
define('EMAIL_TEXT_BALANCE', 'L\'importo dei tuoi punti e\': %s punti stimati %s .');
define('EMAIL_TEXT_EXPIRE', 'I punti scadranno il : %s .');
define('EMAIL_TEXT_POINTS_URL', 'Per tua comodita\' di seguito trovi il link la tuo Shopping Points Account . %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'Our store Reward Point Program FAQ page located here . %s');
define('EMAIL_TEXT_COMMENT', 'Motivi della cancellazione :');
define('EMAIL_TEXT_SUCCESS_POINTS', 'I punti sono disponibili nel tuo account, li potrai utilizzare in fase di conferma del tuo ordine. '. "\n" .'Grazie per aver fatto shopping su ' . STORE_NAME . ' vieni a trovarci presto.');
define('EMAIL_CONTACT', 'Se hai qualche domanda o hai bisogno d\'aiuto non esitare a contattarci : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Questa e\' una risposta automatica, non replicare!');
//Auto Remainder bof
define('EMAIL_EXPIRE_SUBJECT', 'I punti scadranno tra' . POINTS_EXPIRES_REMIND.' giorni');
define('EMAIL_EXPIRE_INTRO', 'Questo e\' un promemoria automatico ' . POINTS_EXPIRES_REMIND.' sui giorni della scadenza.');
define('EMAIL_EXPIRE_DET', 'Il totale dei tuoi punti e\' %s , scadranno il %s .');
define('EMAIL_EXPIRE_TEXT', 'Dopo questa data, tutti i tuoi punti saranno azzerati e dovrai ricominciare da accumularli.');
//Auto Remainder eof
define('SUCCESS_POINTS_UPDATED', 'Successo: I punti sono stati aggiornati con successo.');
define('SUCCESS_DATABASE_UPDATED', 'Queue Success: Il Database e\' stato aggiornato con successo ed i punti settati come ' . TEXT_POINTS_CANCELLED . '  con questo commento " '. $comment_cancel . ' ".');
define('NOTICE_EMAIL_SENT_TO', 'Avviso: Email inviata a: %s');
define('NOTICE_RECORED_REMOVED', 'Avviso: The points record row no. ' . $uID . ' sono stati cancellati dal database.');
define('WARNING_DATABASE_NOT_UPDATED', 'Attenzione: Campi vuoti, nulla da modificare. il database non e\' stato aggiornato.');
define('POINTS_ENTER_JS_ERROR', 'Valore invalido! \n Accettati solo numeri!');

define('TEXT_LINK_CREDIT', 'Clicca qui per caricare <a href="customers_points_credit.php"><u>Auto Credit</u></a> o <a href="customers_points_expire.php"><u>Auto Expire</u></a> script manualmente.');
?>
