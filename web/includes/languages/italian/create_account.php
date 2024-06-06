<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

//TotalB2B start
define('EMAIL_VALIDATE_SUBJECT', 'Un nuovo cliente per '. STORE_NAME);
define('EMAIL_VALIDATE', 'Un nuovo cliente registrato a '. STORE_NAME);
define('EMAIL_VALIDATE_PROFILE', 'Per vedere il profilo del clente clik cqui  :');
define('EMAIL_VALIDATE_ACTIVATE', 'Per attivare il nuovo cliente click  qui:');
//TotalB2B end

// Points/Rewards system V2.00 BOF
define('EMAIL_WELCOME_POINTS', '<li><span class="b">Reward Point Program</span> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE', 'Crea un Account');

define('HEADING_TITLE', 'Informazioni account');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">NOTA:</span></span> Se tu hai gia un account, vai alla pagina <a href="%s"><span class="ColorSpan">login</span></a>.');

define('EMAIL_SUBJECT', 'Benvenuto in ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Caro Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Cara Ms. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Caro %s' . "\n\n");
define('EMAIL_WELCOME', 'Ti diamo il benvenuto in <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'Adesso puoi usufruire dei <span class="b">molti servizi</span> che ti offriamo. Alcuni fra questi sono:' . "\n\n" . '<li><span class="b">Carrello acquisti</span> - Qualsiasi prodotto aggiunto al tuo carrello vi rimarrà fino a che non lo rimuoverete o lo acquistarete.' . "\n" . '<li><span class="b">Rubrica personale</span> - Ora possiamo spedirvi prodotti ad indirizzi differenti da quello con cui avete creato l\'account. Questa soluzione &egrave; perfetta per spedire regali di compleanno direttamente al festeggiato.' . "\n" . '<li><span class="b">Storico ordini</span> - Visualizza la cronologia degli acquisti che hai fatto.' . "\n" . '<li><span class="b">Recensioni prodotti</span> - Condividi le tue opinioni riguardo a prodotti con altri nostri clienti.' . "\n\n");
define('EMAIL_CONTACT', 'Per ricevere aiuto riguardo qualsiasi dei servizi da noi offerti, manda una email a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">Note:</span> Questo indirizzo email &egrave; stato utilizzato da un nostro cliente. Se non hai scelto tu di iscriverti, per piacere contattaci all\'indirizzo ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
/* ICW Credit class gift voucher begin */
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' Spiacenti, siete troppo giovane, dovete avere almeno ' . MIN_AGE . ' anni per poter registrarvi !');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' Spiacenti, siete troppo vecchi. <br />Magari avete sbagliato ad inserire la data di nascita.');
//###################################### avs ########################################

?>