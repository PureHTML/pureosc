<?php
/*
  $Id: coupon_admin.php,v 1.1.2.5 2003/05/13 23:28:30 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_COUPON_REDEEMED', 'Buoni Riscossi');
define('REDEEM_DATE_LAST', 'Data Ultima Riscossione');
define('TOP_BAR_TITLE', 'Statistiche');
define('HEADING_TITLE', 'Discount Buoni Regalo/Omaggio');
define('HEADING_TITLE_STATUS', 'Stato : ');
define('TEXT_CUSTOMER', 'Clienti:');
define('TEXT_COUPON', 'Nome Buono');
define('TEXT_COUPON_ALL', 'Tutti i Buoni');
define('TEXT_COUPON_ACTIVE', 'Buoni Attivi');
define('TEXT_COUPON_INACTIVE', 'Buoni Inattivi');
define('TEXT_SUBJECT', 'Soggetto:');
define('TEXT_FROM', 'Da:');
define('TEXT_FREE_SHIPPING', 'Trasporto Gratuito');
define('TEXT_MESSAGE', 'Messaggio:');
define('TEXT_SELECT_CUSTOMER', 'Seleziona Cliente');
define('TEXT_ALL_CUSTOMERS', 'Tutti i Clienti');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Manda a Tutti gli Abbonati alle Newsletter');
define('TEXT_CONFIRM_DELETE', 'Sei sicuro di voler Cancellate questo Buono ?');

define('TEXT_TO_REDEEM', 'Puoi riscattare il buono durante l\'acquisto. Digita il codice nel box e clicca sul bottone riscatta.');
define('TEXT_IN_CASE', ' qualora ci siano problemi. ');
define('TEXT_VOUCHER_IS', 'Il codice del buono e\' : ');
define('TEXT_REMEMBER', 'Non perdere il codice del buono, conservalo in luogo sicuro, beneficia della speciale offerta!');
define('TEXT_VISIT', 'quando visiti ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' ed inserisci il codice ');

define('TABLE_HEADING_ACTION', 'Azione');

define('CUSTOMER_ID', 'ID Utente');
define('CUSTOMER_NAME', 'Nome utente');
define('REDEEM_DATE', 'Data riscatto');
define('IP_ADDRESS', 'Indirizzo IP');

define('TEXT_REDEMPTIONS', 'Redemptions');
define('TEXT_REDEMPTIONS_TOTAL', 'In Totale');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Per questo utente');
define('TEXT_NO_FREE_SHIPPING', 'Nessun trasporto gratis');

define('NOTICE_EMAIL_SENT_TO', 'Avviso: Email inviata a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Errore: nessun utente selezionato.');
define('COUPON_NAME', 'Nome Buono');
//define('COUPON_VALUE', 'Valore buono');
define('COUPON_AMOUNT', 'Importo buono');
define('COUPON_CODE', 'Codice buono');
define('COUPON_STARTDATE', 'Data inizio');
define('COUPON_FINISHDATE', 'Data fine');
define('COUPON_FREE_SHIP', 'Trasporto gratis');
define('COUPON_DESC', 'Descrizione Buono');
define('COUPON_MIN_ORDER', 'Coupon Minimum Order');
define('COUPON_USES_COUPON', 'Usi max del buono');
define('COUPON_USES_USER', 'Usi max dagli utenti');
define('COUPON_PRODUCTS', 'Valido per questi prodotti');
define('COUPON_CATEGORIES', 'Valido per queste categorie');
define('VOUCHER_NUMBER_USED', 'Numbero di utilizzi');
define('DATE_CREATED', 'Data di creazione');
define('DATE_MODIFIED', 'Data di modifica');
define('TEXT_HEADING_NEW_COUPON', 'Crea nuovo Buono');
define('TEXT_NEW_INTRO', 'Compila le seguenti informazioni per un nuovo buono.<br />');


define('COUPON_NAME_HELP', 'Un breve nome per il buono');
define('COUPON_AMOUNT_HELP', 'Il valore del Buono, oppure aggiungete % per avere un Buono sconto in percentuale.');
define('COUPON_CODE_HELP', 'Puoi inserire qui il codice del buono, o lasciare vuoto per generarlo automaticamente.');
define('COUPON_STARTDATE_HELP', 'Valido dal');
define('COUPON_FINISHDATE_HELP', 'Valido fino al');
define('COUPON_FREE_SHIP_HELP', 'Il buono offre il trasporto gratuito. Note: Questo esclude l&#39;importo del buono ma rispetta il valore del minimo d&#39;ordine');
define('COUPON_DESC_HELP', 'Descrizione del buono per utente');
define('COUPON_MIN_ORDER_HELP', 'Minimo d&#39;ordine prima che sia valido il buono');
define('COUPON_USES_COUPON_HELP', 'Numero massimo di utilizzo del buono, lasciare vuoto per uso illimitato.');
define('COUPON_USES_USER_HELP', 'Numero massimo di utilizzo del buono per utente, lasciare vuoto per uso illimitato.');
define('COUPON_PRODUCTS_HELP', 'Una virgola separa l&#39;elenco dei prodotti per cui &egrave; possibile utilizzare il buono, lasciare vuoto per nessuna restrizione.');
define('COUPON_CATEGORIES_HELP', 'Una virgola separa l&#39;elenco delle categorie per cui &egrave; possibile utilizzare il buono, lasciare vuoto per nessuna restrizione.');
define('ERROR_NO_COUPON_AMOUNT', 'Errore: Nessun importo del buono inserito. Inserire un importo o selezionare Trasporto gratis.');
define('ERROR_COUPON_EXISTS', 'Errore: Un buono con lo stesso nome &egrave; gi&agrave; esistente.');
define('COUPON_BUTTON_EMAIL_VOUCHER', 'Email Voucher');
define('COUPON_BUTTON_EDIT_VOUCHER', 'Modifica Voucher');
define('COUPON_BUTTON_DELETE_VOUCHER', 'Cancella Voucher');
define('COUPON_BUTTON_VOUCHER_REPORT', 'Voucher Report');
define('COUPON_STATUS', 'Stato');
define('COUPON_STATUS_HELP', 'Setta su ' . IMAGE_ICON_STATUS_RED . ' per disabilitare gli utenti\' abilita per usare il buono.');
?>