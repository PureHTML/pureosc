<?php
/*
  $Id: orders.php,v 1.25 2003/06/20 00:28:44 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('ENTRY_CUSTOMER_NOTES', 'Note sul Cliente : ');

######## Points/Rewards Module V2.00 BOF ##################
define('ENTRY_NOTIFY_POINTS', 'Confirm Pending Points:');
define('ENTRY_QUE_POINTS', 'and Que');
define('ENTRY_QUE_DEL_POINTS', 'and Delete:');
define('ENTRY_CONFIRMED_POINTS', 'Points Confirmed.  ');
######## Points/Rewards Module V2.00 EOF ##################
define('HEADING_TITLE', 'Ordini');
define('HEADING_TITLE_SEARCH', 'ID Ordine:');
define('HEADING_TITLE_STATUS', 'Stato:');

define('TABLE_HEADING_COMMENTS', 'Commenti');
define('TABLE_HEADING_CUSTOMERS', 'Clienti');
define('TABLE_HEADING_ORDER_TOTAL', 'Totale Ordine');
define('TABLE_HEADING_DATE_PURCHASED', 'Data di acquisto');
define('TABLE_HEADING_STATUS', 'Stato');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modello');
define('TABLE_HEADING_PRODUCTS', 'Prodotti');
define('TABLE_HEADING_TAX', 'Tassa');
define('TABLE_HEADING_TOTAL', 'Totale');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prezzo (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prezzo (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Totale (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Totale (inc)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Notifica Cliente');
define('TABLE_HEADING_DATE_ADDED', 'Data di inserimento');

define('ENTRY_CUSTOMER', 'Cliente:');
define('ENTRY_SOLD_TO', 'VENDUTO A:');
define('ENTRY_DELIVERY_TO', 'Consegnato a:');
define('ENTRY_SHIP_TO', 'Spedito a:');
define('ENTRY_SHIPPING_ADDRESS', 'Indirizzo per la Spedizione:');
define('ENTRY_BILLING_ADDRESS', 'Indirizzo per la Fattura:');
define('ENTRY_PAYMENT_METHOD', 'Metodo di Pagamento:');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo Carta di Credito:');
define('ENTRY_CREDIT_CARD_OWNER', 'Proprietario Carta di Credito:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Numero Carta di Credito:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Scadenza Carta di Credito:');
define('ENTRY_SUB_TOTAL', 'Sub-Totale:');
define('ENTRY_TAX', 'Tassa:');
define('ENTRY_SHIPPING', 'Spedizione:');
define('ENTRY_TOTAL', 'Totale:');
define('ENTRY_DATE_PURCHASED', 'Data di Acquisto:');
define('ENTRY_STATUS', 'Stato:');
define('ENTRY_DATE_LAST_UPDATED', 'Data ultimo aggiornamento:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notifica Cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Aggiungi Commenti:');
define('ENTRY_PRINTABLE', 'Stampa Fattura');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Cancella Ordine');
define('TEXT_INFO_DELETE_INTRO', 'Sicuro di voler cancellare questo ordine?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Ristabilisci la quantit&agrave; del Prodotto');
define('TEXT_DATE_ORDER_CREATED', 'Data di creazione:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Ultima modifica:');
define('TEXT_INFO_PAYMENT_METHOD', 'Metodo di Pagamento:');

define('TEXT_ALL_ORDERS', 'Tutti gli Ordini');
define('TEXT_NO_ORDER_HISTORY', 'Nessuna Cronologia Ordini disponibile');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Ordine aggiornato');
define('EMAIL_TEXT_ORDER_NUMBER', 'Numero di Ordine:');
define('EMAIL_TEXT_INVOICE_URL', 'Dettagli Fattura:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data di Ordine:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Il tuo ordine e\' stato aggiornato al seguente stato.' . "\n\n" . 'Nuovo stato: %s' . "\n\n" . 'Rispondi a questa E-mail in caso di problemi.' ."\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'I commenti per il tuo ordine sono' . "\n\n" . '%s' . "\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Errore: Ordine inesistente.');
define('SUCCESS_ORDER_UPDATED', 'Operazione Riuscita: Ordine aggiornato con successo.');
define('WARNING_ORDER_NOT_UPDATED', 'Attenzione: Nessun cambiamento. L\'ordine on &egrave; stato aggiornato.');
?>
