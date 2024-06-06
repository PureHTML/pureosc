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

define('HEADING_TITLE', 'Referral- Review Pending Points');
define('HEADING_RATE', 'Exchange Rates : ');
define('HEADING_AWARDS', 'Premi : ');
define('HEADING_REDEEM', 'Riscatto : ');
define('HEADING_POINT', 'punto');
define('HEADING_POINTS', 'punti');
define('HEADING_TITLE_SEARCH', 'Cerca ID cliente:');

define('TABLE_HEADING_CUSTOMERS', 'Clienti');
define('TABLE_HEADING_POINTS_TYPE', 'Tipo punti');
define('TABLE_HEADING_DATE_ADDED', 'Aggiunti il');
define('TABLE_HEADING_POINTS_STATUS', 'Stato dei punti');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_POINTS', 'Punti');
define('TABLE_HEADING_POINTS_VALUE', 'Valore');

define('TABLE_HEADING_SORT', 'Ordina colonna per ');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C From Top');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 From Top');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X From Top');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 From Top');

define('TEXT_DEFAULT_REFERRAL', 'Referral Points');
define('TEXT_DEFAULT_REVIEWS', 'Review Points');
define('TEXT_TYPE_REFERRAL', 'Referral');
define('TEXT_TYPE_REVIEW', 'Review');

define('TEXT_POINTS_PENDING', 'In sospeso');
define('TEXT_POINTS_CONFIRMED', 'Confermati');
define('TEXT_POINTS_CANCELLED', 'Cancellati');
define('TEXT_SHOW_ALL', 'Vedi tutto');

define('TEXT_INFO_POINTS_COMMENT', 'Commento punti : ');
define('TEXT_INFO_ORDER_ID', 'Ordine Id:');
define('TEXT_INFO_ORDER_TOTAL', 'Totale ordine:');
define('TEXT_INFO_ORDER_STATUS', 'Stato ordine:');
define('TEXT_INFO_PRODUCT_ID', 'Prodotto Id:');
define('TEXT_INFO_REVIEW_ID', 'Review Id:');
define('TEXT_INFO_PRODUCT_NAME', 'Nome prodotto:');
define('TEXT_INFO_REFERRED', 'Referred:');
define('TEXT_INFO_PAYMENT_METHOD', 'Metodo di pagamento:');
define('TEXT_INFO_CURRENT_BALANCE', 'Totale punti:');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Adjust Pending Points.');
define('TEXT_INFO_HEADING_DELETE_RECORD', 'Cancella record');
define('TEXT_INFO_HEADING_PENDING_NO', 'Punti in sospeso per ordine n.');
define('TEXT_CONFIRM_POINTS', 'Conferma punti in sospeso per il cliente?');
define('TEXT_CONFIRM_POINTS_LONG', 'You can confirm points to customer with/without queuing points table.<br />confirming points without queuing will remove this line from table else, the Current points status will replaced with "Confirmed" .');
define('TEXT_CANCEL_POINTS', 'Cancella punti in sospeso?');
define('TEXT_CANCEL_POINTS_LONG', 'You can cancel points to customer with/without queuing points table.<br />Cancelling points without queuing will remove this line from table else, pending points status will show "Cancelled" and default comment will be replaced with your Cancellation Reason.');
define('TEXT_CANCELLATION_REASON', 'Motivo della cancellazione :');
define('TEXT_ADJUST_INTRO', 'This option enable you to adjust the total amount of pending points before confirming them.<br />Note that this will replace the current pending points amount and can not be undone.');
define('TEXT_DELETE_INTRO', 'Sei sicuro di voler cancellare questo record ?<br />Questo canceller&agrave; i dati dal database.');
define('TEXT_POINTS_TO_ADJUST', 'Importo dei nuovi punti :');
define('TEXT_ROLL_POINTS', 'Riduzione punti.');
define('TEXT_ROLL_POINTS_LONG', 'Questa opzione abilita la riduzione dei punti confermati in punti sospesi.<br />I punti saranno sottratti dal totale punti cliente e sospesi di default.');
define('TEXT_ROLL_REASON', 'Motivi della riduzione :');

define('TEXT_QUEUE_POINTS_TABLE', 'Queue customers points table');
define('TEXT_NOTIFY_CUSTOMER', 'Notifica al cliente');
define('TEXT_SET_EXPIRE', 'Setta la nuova data di scadenza');

define('BUTTON_TEXT_ADJUST_POINTS', 'Sistema l&#39;importo dei punti sospesi');
define('BUTTON_TEXT_CANCEL_PENDING_POINTS', 'Cancella i punti del cliente');
define('BUTTON_TEXT_CONFIRM_PENDING_POINTS', 'Conferma i punti del cliente');
define('BUTTON_TEXT_REMOVE_RECORD', 'Cancella questo record dal database');
define('BUTTON_TEXT_ROLL_POINTS', 'Riduci i punti sospesi');
define('ICON_PREVIEW_EDIT', 'Vedi dettaglio ordine o modifica lo stato');
define('ICON_REVIEWS_EDIT', 'Vedi o modifica Review contains');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Punti aggiornati .');
define('EMAIL_GREET_MR', 'Spett. Sig. %s,');
define('EMAIL_GREET_MS', 'Spett. Sig.ra %s,');
define('EMAIL_GREET_NONE', 'Caro %s');
define('EMAIL_TEXT_ORDER_NUMBER', 'Ordine N.:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data Ordine:');
define('EMAIL_TEXT_ORDER_STAUTS', 'Stato ordine:');
define('EMAIL_TEXT_INTRO', 'Ti informiamo che i tuoi Punti sono stati aggiornati.');
define('EMAIL_TEXT_BALANCE_CANCELLED', 'Spiacente, abbiamo cancellato i punti.');
define('EMAIL_TEXT_BALANCE_CONFIRMED', 'Punti confermati.');
define('EMAIL_TEXT_BALANCE_ROLL_BACK', 'I punti confermati sono ritornati nello stato precedente.');
define('EMAIL_TEXT_ROLL_COMMENT', 'Commenti :');
define('EMAIL_TEXT_BALANCE', 'Your current Shopping Points balance is: %s points valued at %s .');
define('EMAIL_TEXT_EXPIRE', 'Scadenza dei punti : %s .');
define('EMAIL_TEXT_POINTS_URL', 'Per praticita\' ti indichiamo il link per visualizzare l\' ammontare dei tuoi punti. %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'Our store Reward Point Program FAQ page located here . %s');
define('EMAIL_TEXT_COMMENT', 'Motivi della cancellazione :');
define('EMAIL_TEXT_SUCCESS_POINTS', 'I punti sono disponibili nel tuo account, durante la fase di pagamento sarai abilitato ad utilizzare i punti accumulati.'. "\n" .'Grazie per aver fatto acquisti su ' . STORE_NAME . ' con la speranza di rivederci presto.');
define('EMAIL_CONTACT', 'Se hai qualche domanda da farci o hai bisogno d\'aiuto scrivici a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Questa e\' una risposta automatica, si prega di non replicare!');

define('SUCCESS_POINTS_UPDATED', 'Successo: Punti aggiornati con successo.');
define('SUCCESS_DATABASE_UPDATED', 'Queue Success: Database has been successfully updated and points status set to  ' . TEXT_POINTS_CANCELLED . '  with this comment " '. $comment_cancel . ' ".');
define('NOTICE_EMAIL_SENT_TO', 'Avviso: Email inviata a: %s');
define('NOTICE_RECORED_REMOVED', 'Notice: The points record row no. ' . $uID . ' sono stati cancellati dal database.');
define('WARNING_DATABASE_NOT_UPDATED', 'Attenzione: Campi vuoti, nessuna modifica. Il Database non ha subito modifiche.');
define('POINTS_ENTER_JS_ERROR', 'Invalida entry! \n Accettati solo numeri!');

define('TEXT_LINK_CREDIT', 'Clicca qui per eseguire <a href="customers_points_credit.php"><u>Auto Credit</u></a> o <a href="customers_points_expire.php"><u>Auto Expire</u></a> script manualmente.');
?>
