<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

//themes
define('BOX_HEADING_THEMES', 'Themes');

//TotalB2B start
define('PRICES_LOGGED_IN_TEXT', 'Bisogna fare il login per i prezzi!');
//TotalB2B end

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'it_IT.ISO8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
} 

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="it" xml:lang="it"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crea account');
define('HEADER_TITLE_MY_ACCOUNT', 'Il mio account');
define('HEADER_TITLE_CART_CONTENTS', 'Cosa c\'&egrave; nel carrello');
define('HEADER_TITLE_CHECKOUT', 'Acquista');
define('HEADER_TITLE_TOP', 'Home Page');
define('HEADER_TITLE_CATALOG', 'Catalogo');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'visite da');

// text for gender
define('MALE', 'Uomo');
define('FEMALE', 'Donna');
define('MALE_ADDRESS', 'Sig.');
define('FEMALE_ADDRESS', 'Sig.ra');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorie');
define('BOX_HEADING_PRICE_LIST', 'Listino prezzi');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Produttori');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novit&agrave;');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Ricerca');
define('BOX_SEARCH_TEXT', 'Usa parole chiave per trovare il prodotto');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Ricerca avanzata');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Offerte');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Recensioni');
define('BOX_REVIEWS_WRITE_REVIEW', 'Scrivi una recensione su questo prodotto!');
define('BOX_REVIEWS_NO_REVIEWS', 'In questo momento non ci sono recensioni disponibili');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s su 5 Stelle!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Carrello');
define('BOX_SHOPPING_CART_EMPTY', '0 prodotti ...&egrave; vuoto');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'I miei acquisti');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Pi&ugrave; venduti');
define('BOX_HEADING_BESTSELLERS_IN', 'Pi&ugrave; venduti fra(in)<br />&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Comunicati');
define('BOX_NOTIFICATIONS_NOTIFY', 'Comunica gli aggiornamenti di <span class="b">%s</span>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Non comunicare gli aggiornamenti di <span class="b">%s</span>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Info produttore');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Altri prodotti');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Lingue');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Valute');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informazioni');
define('BOX_INFORMATION_PRIVACY', 'Privacy');
define('BOX_INFORMATION_CONDITIONS', 'Condizioni d&#39;uso');
define('BOX_INFORMATION_SHIPPING', 'Spedizioni  e Consegna');
define('BOX_INFORMATION_CONTACT', 'Contattaci');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Dillo ad un amico');
define('BOX_TELL_A_FRIEND_TEXT', 'Invia questa pagina ad un amico.');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Invio Informazioni');
define('CHECKOUT_BAR_PAYMENT', 'Metodo di pagamento');
define('CHECKOUT_BAR_CONFIRMATION', 'Conferma');
define('CHECKOUT_BAR_FINISHED', 'Fine!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selezionare');
define('TYPE_BELOW', 'Inserire qui');

// javascript messages
define('JS_ERROR', 'Ci sono stati degli errori nella compilazione del modulo!\nEseguire le seguenti modifiche:\n\n');

define('JS_REVIEW_TEXT', '* Il testo delle Recensioni deve essere di almeno ' . REVIEW_TEXT_MIN_LENGTH . ' caratteri.\n');
define('JS_REVIEW_RATING', '* Devi votare il prodotto per recensirlo.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Seleziona un tipo di pagamento per il tuo acquisto.\n');

define('JS_ERROR_SUBMITTED', 'Questo modulo &egrave; gi&agrave; stato inviato. Premi ok e aspetta che termini il processo.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Seleziona un tipo di pagamento per il tuo acquisto.');

define('CATEGORY_COMPANY', 'Azienda');
define('CATEGORY_PERSONAL', 'Dettagli personali');
define('CATEGORY_ADDRESS', 'Indirizzo');
define('CATEGORY_CONTACT', 'Contatti');
define('CATEGORY_OPTIONS', 'Opzioni');
define('CATEGORY_PASSWORD', 'Password');

define('ENTRY_COMPANY', 'Nome dell\' azienda:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sesso:');
define('ENTRY_GENDER_ERROR', 'Campo Sesso Richiesto.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', 'Il campo Nome deve contentere minimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Cognome:');
define('ENTRY_LAST_NAME_ERROR', 'Il campo Cognome deve contenere minimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data di nascita:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'La Data di nascita deve essere inserita seguendo il formato DD/MM/YYYY (eg. 21/05/1970).');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (es. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Indirizzo E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Il campo Indirizzo E-Mail deve contentere minimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Indirizzo email non valido - accertarsi e correggere.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Indirizzo email gi&agrave; contenuto nel nostro database - accedere con questo indirizzo oppure creare un account con un indirizzo differente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Indirizzo:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Il campo Indirizzo deve contentere minimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Frazione:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CAP:');
define('ENTRY_POST_CODE_ERROR', 'Il campo CAP deve contentere minimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caratteri.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Provincia :');
define('ENTRY_CITY_ERROR', 'Il campo Provincia : deve contentere minimo ' . ENTRY_CITY_MIN_LENGTH . ' caratteri.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Citt&agrave; :');
define('ENTRY_STATE_ERROR', 'Il campo Citt&agrave; deve contentere minimo ' . ENTRY_STATE_MIN_LENGTH . ' caratteri.');
define('ENTRY_STATE_ERROR_SELECT', 'Seleziona una Citt&agrave; del men&ugrave; a scorrimento.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Nazione:');
define('ENTRY_COUNTRY_ERROR', 'Seleziona una Nazione del menu a scorrimento.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Numero di telefono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Il campo Numero di telefono deve contentere minimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caratteri.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Mi iscrivo');
define('ENTRY_NEWSLETTER_NO', 'Non mi iscrivo');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PRIVACY', 'Ho letto le - <a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a> - e le - <a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a> - ');
define('ENTRY_PRIVACY_TEXT', '*');
define('ENTRY_PRIVACY_ERROR', 'Non hai letto le ' . BOX_INFORMATION_PRIVACY . ' e le ' . BOX_INFORMATION_CONDITIONS);
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_ERROR', 'Il campo Password deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le Password Password e Conferma password inserite non corrispondono.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Conferma Password:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Password Attuale:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Il campo Password Attuale deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW', 'Nuova Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Il campo Nuova Password deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Le Password Password Attuale e Nuova Password inserite non corrispondono .');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Campi Richiesti');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina dei risultati:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Visualizzati <span class="b">%d</span> su <span class="b">%d</span> (di <span class="b">%d</span> prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Visualizzati <span class="b">%d</span> su <span class="b">%d</span> (di <span class="b">%d</span> acquisti)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Visualizzati <span class="b">%d</span> su <span class="b">%d</span> (di <span class="b">%d</span> recensioni)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Visualizzati <span class="b">%d</span> su <span class="b">%d</span> (di <span class="b">%d</span> nuovi prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Visualizzati <span class="b">%d</span> su <span class="b">%d</span> (di <span class="b">%d</span> offerte)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Prima pagina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Pagina precedente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pagina successiva');
define('PREVNEXT_TITLE_LAST_PAGE', 'Ultima pagina');
define('PREVNEXT_TITLE_PAGE_NO', 'Pagina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Precedenti  %d pagine');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Successive %d pagine');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRIMO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Precedente]');
define('PREVNEXT_BUTTON_NEXT', '[Successivo&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'ULTIMO&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Aggiungi indirizzo');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Indirizzo');
define('IMAGE_BUTTON_BACK', 'Indietro');
define('IMAGE_BUTTON_BUY_NOW', 'Compra&nbsp;Ora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambia indirizzo');
define('IMAGE_BUTTON_CHECKOUT', 'Acquista');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Conferma acquisto');
define('IMAGE_BUTTON_CONTINUE', 'Continua');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continua gli acquisti');
define('IMAGE_BUTTON_DELETE', 'Cancella');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Modifica account');
define('IMAGE_BUTTON_HISTORY', 'I miei acquisti');
define('IMAGE_BUTTON_LOGIN', 'Login');
define('IMAGE_BUTTON_IN_CART', 'Aggiungi al carrello');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Comunicazioni');
define('IMAGE_BUTTON_QUICK_FIND', 'Ricerca veloce');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Cancella comunicazioni');
define('IMAGE_BUTTON_REVIEWS', 'Recensioni');
define('IMAGE_BUTTON_SEARCH', 'Cerca');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Scegli spedizione');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dillo ad un amico');
define('IMAGE_BUTTON_UPDATE', 'Aggiorna');
define('IMAGE_BUTTON_UPDATE_CART', 'Aggiorna il carrello');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Scrivi una recensione');

define('SMALL_IMAGE_BUTTON_DELETE', 'Cancella');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modifica');
define('SMALL_IMAGE_BUTTON_VIEW', 'Visualizza');

define('ICON_ARROW_RIGHT', 'Altro');
define('ICON_CART', 'Nel carrello');
define('ICON_ERROR', 'Errore');
define('ICON_SUCCESS', 'Successo');
define('ICON_WARNING', 'Attenzione');

define('TEXT_GREETING_PERSONAL', 'Bentornato <span class="greetUser">%s!</span> Vuoi vedere i <a href="%s"><span class="ColorSpan">nuovi prodotti</span></a> che sono disponibili?');
define('TEXT_GREETING_PERSONAL_RELOGON', 'Se tu non sei %s, <a href="%s"><span class="ColorSpan">effettua il log-in</span></a> con i dati del tuo accout.');
define('TEXT_GREETING_GUEST', 'Benvenuto <span class="greetUser">Visitatore !</span>, Puoi effettuare qui <a href="%s"><span class="ColorSpan">il log-in</span></a>; Oppure puoi creare qui <a href="%s"><span class="ColorSpan">il tuo account</span></a>.<br />');

define('TEXT_SORT_PRODUCTS', 'Tipi di prodotti');
define('TEXT_DESCENDINGLY', ' in modo discendente');
define('TEXT_ASCENDINGLY', ' in modo ascendente');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'da %s');
define('TEXT_REVIEW_WORD_COUNT', '%s vocaboli');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data di inserimento: %s');
define('TEXT_NO_REVIEWS', 'Non ci sono recensioni per questo prodotto.');

define('TEXT_NO_NEW_PRODUCTS', 'Non ci sono prodotti.');

define('TEXT_UNKNOWN_TAX_RATE', 'Tassa sconosciuta');

define('TEXT_REQUIRED', '<span class="ColorRed">Richiesto</span>');

define('ERROR_TEP_MAIL', '<span class="ColorSpanRed2"><span class="b">ERRORE TEP: Non &egrave; possibile inviare email, non &egrave; stato specificato SMTP server. Cerca php.ini e configura SMTP server.</span></span>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Attenzione: La directory di installazione esiste in : ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. Rimuovila per ragioni di sicurezza.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Attenzione: E\' possibile scrivere sul file di configurazione: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Questo &egrave; un rischio - configura tale file in sola lettura.');
define('WARNING_CONFIG_FILE_WRITEABLE_ADMIN', 'Attenzione: E\' possibile scrivere sul file di configurazione: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/admin/includes/configure.php. Questo &egrave; un rischio - configura tale file in sola lettura.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Attenzione: La directory che contiene la sessione non esiste: ' . tep_session_save_path() . '. La sessione non funzioner&agrave; finche non si corregge questo errore.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Attenzione: Non &egrave; possibile scrivere-lavorare sulla directory che contiene la sessione: ' . tep_session_save_path() . '. LA sessione non funzioner&agrave; finche non verr&agrave; corretto questo errore.');
define('WARNING_SESSION_AUTO_START', 'Attenzione: session.auto_start &egrave; abilitata - disabilitala nel file  php.ini e riavvia il web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Attenzione: La directory che contiene i download non esiste: ' . DIR_FS_DOWNLOAD . '. I download non funzioneranno finche non verr&agrave; corretto questo errore.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La data di scadenza della carta di credito non &egrave; corretta. Controlla la data e riprova.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Il numero della carta di credito immesso non &egrave; valido. Controlla il numero e riprova.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'I primi quattro numeri digitati sono: %s Se questi numeri sono corretti, noi accettiamo la carta di credito. Se non sono giusti, riprova.');

/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br />Powered by <a href="http://www.oscommerce.com/index.php" >osCommerce Team</a><br />WAI-A optimized <a href="http://www.magnino.net/index.php" >Maury2ma &amp; VitForLinux</a>');

 define('BOX_INFORMATION_DYNAMIC_SITEMAP', 'Mappa del Sito');

// CATALOG_PRODUCTS
  define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Stampa Listino');

define('BOX_INFORMATION_MY_POINTS_HELP', 'Point Program FAQ');//Points/Rewards Module V2.00
#### Points/Rewards Module V2.00 BOF ####
define('REDEEM_SYSTEM_ERROR_POINTS_NOT', 'Non avete abbastanza PUNTI per pagare tutti gli articoli, selezionate un metodo di pagamento alternativo per saldare la differenza.');
define('REDEEM_SYSTEM_ERROR_POINTS_OVER', 'REDEEM POINTS ERROR ! Points value can not be over the total value. Please Re enter points');
define('REFERRAL_ERROR_SELF', 'Sorry you can not refer yourself.');
define('REFERRAL_ERROR_NOT_FOUND', 'The referral email address you entered was not found.');
define('TEXT_POINTS_BALANCE', 'Your Points Info.');
define('TEXT_POINTS', 'Punti :');
define('TEXT_VALUE', 'Valore:');
define('REVIEW_HELP_LINK', ' Scrivi una Recensione e riceverai <span class="b">' .  $currencies->format(USE_POINTS_FOR_REVIEWS * REDEEM_POINT_VALUE) . '</span> come valore in Punti.<br />Siete pregati di leggere <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP,'faq_item=13', 'NONSSL') . '" title="Reward Point Program FAQ">Il Regolamento</a> Point Program FAQ per maggiori informazioni.');
#### Points/Rewards Module V2.00 EOF ####

require(DIR_WS_LANGUAGES . 'add_ccgvdc_italian.php');  // ICW CREDIT CLASS Gift Voucher Addittion
define('FILENAME_STATS_CREDITS', 'stats_credits.php');
 
//BOF ask a question
define('IMAGE_BUTTON_ASK_QUESTION','Invia una richiesta d\'informazioni riguardo questo articolo');
define('BOX_HEADING_ASK_QUESTION','Info articolo');
//EOF ask a question
 
// JUST SPIFFY Category Descriptions
  define('TEXT_CAT_DESCRIPT', 'Descrizione Categoria');
// END JUST SPIFFY Category Descriptions

// for image to QTY
 define('TEXT_NOT_AVAIBLE', 'Non Disponibile');
 define('TEXT_FEW_QTY', 'Disponibilit&agrave; Normale');
 define('TEXT_BIG_QTY', 'Ottima Disponibilit&agrave;');

// Who's online
define('BOX_HEADING_WHOS_ONLINE', 'Clienti online ?');
define('BOX_WHOS_ONLINE_THEREIS', 'Adesso c\'&egrave; un');
define('BOX_WHOS_ONLINE_THEREARE', 'Adesso ci sono');
define('BOX_WHOS_ONLINE_GUEST', 'ospite');
define('BOX_WHOS_ONLINE_GUESTS', 'ospiti');
define('BOX_WHOS_ONLINE_AND', 'e');
define('BOX_WHOS_ONLINE_MEMBER', 'membro');
define('BOX_WHOS_ONLINE_MEMBERS', 'membri');

//PIVACF start
define('ENTRY_PIVA', 'Partita Iva:');
define('ENTRY_PIVA_ERROR', 'Numero di Partita Iva scorretto.');
define('ENTRY_PIVA_TEXT', '*');
define('ENTRY_CF', 'Codice Fiscale:');
define('ENTRY_CF_TEXT', '* solo per i residenti in Italia');
define('ENTRY_CF_ERROR', 'Codice Fiscale scorretto.');
//PIVACF end

// text for label
define('TEXT_LABEL_INPUT', 'Inserisci qu&igrave; - ');
define('TEXT_QTA', 'Qta');
// text fo label

// text for help HANDICAP
define('EMAIL_TITLE_HANDICAP', 'Richiesta registrazione assistita per non vedenti');
define('EMAIL_BODY_HANDICAP', 'Prego inserite tutti i vostri dati, per potervi aiutare nella registrazione del nostro negozio');
// text for help

	define('BOX_INFORMATION_RSS', 'Catalog Feed');
  define('IMAGE_BUTTON_MORE_INFO', 'Maggiori Informazioni');
?>