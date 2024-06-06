<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

//themes
define('BOX_HEADING_THEMES', 'Themes');

//TotalB2B start
define('PRICES_LOGGED_IN_TEXT','Must be logged in for prices!');
//TotalB2B end

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'fr_FR.ISO_8859-1');

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
define('HTML_PARAMS','dir="ltr" lang="fr" xml:lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Cr&eacute;er un compte');
define('HEADER_TITLE_MY_ACCOUNT', 'Mon compte');
define('HEADER_TITLE_CART_CONTENTS', 'Voir panier');
define('HEADER_TITLE_CHECKOUT', 'Commander');
define('HEADER_TITLE_TOP', 'Accueil');
define('HEADER_TITLE_CATALOG', 'Catalogue');
define('HEADER_TITLE_LOGOFF', 'Fermeture de session');
define('HEADER_TITLE_LOGIN', 'Ouverture de session');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'requ&ecirc;tes depuis le');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Mme.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'jj/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Cat&eacute;gories');
define('BOX_HEADING_PRICE_LIST', 'Price List');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricants');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Nouveaut&eacute;s ?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Recherche rapide');
define('BOX_SEARCH_TEXT', 'Utilisez des mots-cl&eacute;s pour trouver le produit que vous recherchez.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Recherche avanc&eacute;e');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Promotions');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Critiques');
define('BOX_REVIEWS_WRITE_REVIEW', 'Ecrire une critique pour ce produit !');
define('BOX_REVIEWS_NO_REVIEWS', 'Il n\'y a actuellement aucune critique pour ce produit');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s sur 5 &eacute;toiles !');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Panier');
define('BOX_SHOPPING_CART_EMPTY', 'vide');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Historique commandes');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Meilleures ventes');
define('BOX_HEADING_BESTSELLERS_IN', 'Meilleures ventes dans<br />&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notifications');
define('BOX_NOTIFICATIONS_NOTIFY', 'Me pr&eacute;venir des mises &agrave; jour de <span class="b">%s</span>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Ne plus me pr&eacute;venir des mises &agrave; jour de <span class="b">%s</span>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Information fabricant');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Page d\'accueil de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Autres articles');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Langues');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Devises');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informations');
define('BOX_INFORMATION_PRIVACY', 'Vie priv&eacute;');
define('BOX_INFORMATION_CONDITIONS', 'Conditions d\'utilisation');
define('BOX_INFORMATION_SHIPPING', 'Exp&eacute;dition &amp; retours');
define('BOX_INFORMATION_CONTACT', 'Contactez-nous');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Faire conna&icirc;tre');
define('BOX_TELL_A_FRIEND_TEXT', 'Envoyer cet article &agrave; un ami(e).');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Information livraison');
define('CHECKOUT_BAR_PAYMENT', 'Information paiement');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Fini !');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Choisissez');
define('TYPE_BELOW', 'Tapez ci-dessous');

// javascript messages
define('JS_ERROR', 'Des erreurs sont survenues durant le traitement de votre formulaire.\n\nVeuillez effectuer les corrections suivantes :\n\n');

define('JS_REVIEW_TEXT', '* Le commentaire que vous avez rentr&eacute; doit avoir au moins ' . REVIEW_TEXT_MIN_LENGTH . ' caract&egrave;res');
define('JS_REVIEW_RATING', '* Vous devez mettre une appr&eacute;ciation pour cet article.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Veuillez choisir une m&eacute;thode de paiement pour votre commande.\n');

define('JS_ERROR_SUBMITTED', 'Ce formulaire a &eacute;t&eacute; d&eacute;j&agrave; soumis. Veuillez appuyer sur Ok et attendez jusqu\'&agrave; ce que le traitement soit fini.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Veuillez choisir une m&eacute;thode de paiement pour votre commande.');

define('CATEGORY_COMPANY', 'D&eacute;tails soci&eacute;t&eacute;s');
define('CATEGORY_PERSONAL', 'Vos d&eacute;tails personnels');
define('CATEGORY_ADDRESS', 'Votre adresse');
define('CATEGORY_CONTACT', 'Votre adresse');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Votre mot de passe');

define('ENTRY_COMPANY', 'Nom de la soci&eacute;t&eacute; :');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Civilit&Eacute; :');
define('ENTRY_GENDER_ERROR', 'Veuillez choisir votre genre.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Pr&eacute;nom :');
define('ENTRY_FIRST_NAME_ERROR', 'Votre pr&eacute;nom doit contenir un minimum de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nom :');
define('ENTRY_LAST_NAME_ERROR', 'Votre nom doit contenir un minimum de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance :');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Votre date de naissance doit avoir ce format : JJ/MM/AAAA (ex. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (ex. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Adresse email:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Votre adresse email doit contenir un minimum de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Votre adresse email ne semble pas &ecirc;tre valide - veuillez effectuer toutes les corrections n&eacute;cessaires.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Votre adresse email est d&eacute;j&agrave; enregistr&eacute;e sur notre site - Veuillez ouvrir une session avec cette adresse email ou cr&eacute;ez un compte avec une adresse diff&eacute;rente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adresse :');
define('ENTRY_STREET_ADDRESS_ERROR', 'Votre adresse doit contenir un minimum de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Compl&eacute;ment d\'adresse :');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Code postal :');
define('ENTRY_POST_CODE_ERROR', 'Votre code postal doit contenir un minimum de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ville :');
define('ENTRY_CITY_ERROR', 'Votre ville doit contenir un minimum de ' . ENTRY_CITY_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Etat/D&eacute;partement :');
define('ENTRY_STATE_ERROR', 'Votre &eacute;tat doit contenir un minimum de ' . ENTRY_STATE_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_STATE_ERROR_SELECT', 'Veuillez choisir un &eacute;tat &agrave; partir de la liste d&eacute;roulante.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Pays :');
define('ENTRY_COUNTRY_ERROR', 'Veuillez choisir un pays &agrave; partir de la liste d&eacute;roulante.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Num&eacute;ro de t&eacute;l&eacute;phone :');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Votre num&eacute;ro de t&eacute;l&eacute;phone doit contenir un minimum de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Num&eacute;ro de fax :');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Bulletin d\'information :');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'S\'abonner');
define('ENTRY_NEWSLETTER_NO', 'Ne pas s\'abonner');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PRIVACY', 'Ho letto le - <a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a> - e le - <a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a> - ');
define('ENTRY_PRIVACY_TEXT', '*');
define('ENTRY_PRIVACY_ERROR', 'Non hai letto le ' . BOX_INFORMATION_PRIVACY . ' e le ' . BOX_INFORMATION_CONDITIONS);
define('ENTRY_PASSWORD', 'Mot de passe :');
define('ENTRY_PASSWORD_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre mot de passe.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Mot de passe de confirmation :');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Mot de passe actuel :');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_NEW', 'Nouveau mot de passe :');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Votre nouveau mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre nouveau mot de passe.');
define('PASSWORD_HIDDEN', '--CACHE--');

define('FORM_REQUIRED_INFORMATION', '* Information requise');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pages de r&eacute;sultat :');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Afficher <span class="b">%d</span> &agrave; <span class="b">%d</span> (sur <span class="b">%d</span> produits)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Afficher <span class="b">%d</span> &agrave; <span class="b">%d</span> (sur <span class="b">%d</span> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Afficher <span class="b">%d</span> &agrave; <span class="b">%d</span> (sur <span class="b">%d</span> critiques)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Afficher <span class="b">%d</span> &agrave; <span class="b">%d</span> (sur <span class="b">%d</span> nouveaux produits)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Afficher <span class="b">%d</span> &agrave; <span class="b">%d</span> (sur <span class="b">%d</span> promotions)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Premi&egrave;re page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Page pr&eacute;c&eacute;dente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Page suivante');
define('PREVNEXT_TITLE_LAST_PAGE', 'Derni&egrave;re page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Ensemble pr&eacute;c&eacute;dent de %d pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Ensemble suivant de %d pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PREMIER');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Pr&eacute;c]');
define('PREVNEXT_BUTTON_NEXT', '[Suiv&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'DERNIER&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Ajouter adresse');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Carnet d\'adresses');
define('IMAGE_BUTTON_BACK', 'Retour');
define('IMAGE_BUTTON_BUY_NOW', 'Acheter&nbsp;maintenant');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Changez l\'adresse');
define('IMAGE_BUTTON_CHECKOUT', 'Commander');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmer la commande');
define('IMAGE_BUTTON_CONTINUE', 'Continuer');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continuer vos achats');
define('IMAGE_BUTTON_DELETE', 'Supprimer');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editez le compte');
define('IMAGE_BUTTON_HISTORY', 'Historique des commandes');
define('IMAGE_BUTTON_LOGIN', 'Valider');
define('IMAGE_BUTTON_IN_CART', 'Ajouter au panier');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications');
define('IMAGE_BUTTON_QUICK_FIND', 'Recherche rapide');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Supprimer les notifications');
define('IMAGE_BUTTON_REVIEWS', 'Critiques');
define('IMAGE_BUTTON_SEARCH', 'Rechercher');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Options d\'exp&eacute;dition');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Envoyer &agrave; un ami');
define('IMAGE_BUTTON_UPDATE', 'Mise &agrave; jour');
define('IMAGE_BUTTON_UPDATE_CART', 'Mise &agrave; jour panier');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Ecrire une critique');

define('SMALL_IMAGE_BUTTON_DELETE', 'Supprimer');
define('SMALL_IMAGE_BUTTON_EDIT', 'Editer');
define('SMALL_IMAGE_BUTTON_VIEW', 'Afficher');

define('ICON_ARROW_RIGHT', 'plus');
define('ICON_CART', 'Dans le panier');
define('ICON_ERROR', 'Erreur');
define('ICON_SUCCESS', 'R&eacute;ussi');
define('ICON_WARNING', 'Attention');

define('TEXT_GREETING_PERSONAL', 'Bienvenue <span class="greetUser">%s!</span> Voudriez vous voir quels <a href="%s"><span class="ColorSpan">nouveaux produits</span></a> sont disponibles &agrave; la vente?');
define('TEXT_GREETING_PERSONAL_RELOGON', 'Si vous n\'&ecirc;tes pas %s, merci de vous <a href="%s"><span class="ColorSpan">reconnecter in</span></a> avec votre compte.');
define('TEXT_GREETING_GUEST', 'Bienvenue <span class="greetUser">visiteur!</span> Voulez vous <a href="%s"><span class="ColorSpan">ouvrir une session</span></a>? Ou pr&eacute;f&eacute;rez vous <a href="%s"><span class="ColorSpan">cr&eacute;er un compte</span></a>?');

define('TEXT_SORT_PRODUCTS', 'Trier produits ');
define('TEXT_DESCENDINGLY', 'd&eacute;croissant');
define('TEXT_ASCENDINGLY', 'croissant');
define('TEXT_BY', ' par ');

define('TEXT_REVIEW_BY', 'par %s');
define('TEXT_REVIEW_WORD_COUNT', '%s mots');
define('TEXT_REVIEW_RATING', 'Classement : %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date d\'ajout : %s');
define('TEXT_NO_REVIEWS', 'Il n\'y a pour le moment aucune critique sur ce produit.');

define('TEXT_NO_NEW_PRODUCTS', 'Il n\'y a pour le moment aucun produits.');

define('TEXT_UNKNOWN_TAX_RATE', 'Taux de taxation inconnu');

define('TEXT_REQUIRED', '<span class="ColorRed">Requis</span>');

define('ERROR_TEP_MAIL', '<span class="ColorSpanRed2"><span class="b">TEP ERROR: Impossible d\'envoyer l\'email par le serveur SMTP sp&eacute;cifi&eacute;. V&eacute;rifiez le fichier PHP.INI et corrigez le nom du serveur SMTP si n&eacute;cessaire.</span></span>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Attention : le r&eacute;pertoire d\'installation existe &agrave; : ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. Veuillez supprimer ce r&eacute;pertoire pour des raisons de s&eacute;curit&eacute;.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Attention : Il est possible d\'&eacute;crire sur le fichier de configuration : ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Ceci est un risque potentiel - Mettez les bonnes permissions sur ce fichier.');
define('WARNING_CONFIG_FILE_WRITEABLE_ADMIN', 'Attention : Il est possible d\'&eacute;crire sur le fichier de configuration : ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/admin/includes/configure.php. Ceci est un risque potentiel - Mettez les bonnes permissions sur ce fichier.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Attention : Le r&eacute;pertoire de session n\'existe pas : ' . tep_session_save_path() . '. Les sessions ne fonctionneront pas tant que ce r&eacute;pertoire n\'aura pas &eacute;t&eacute; cr&eacute;&eacute;.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Attention : Il est impossible d\'&eacute;crire dans le r&eacute;pertoire de sessions ' . tep_session_save_path() . '. Les sessions ne fonctionneront pas tant que les permissions n\'auront pas &eacute;t&eacute; corrig&eacute;es.');
define('WARNING_SESSION_AUTO_START', 'Attention : session.auto_start is enabled - d&eacute;sactiver cette fonctionnalit&eacute; dans php.ini et red&eacute;marrer le serveur http.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Attention : Le r&eacute;pertoire de t&eacute;l&eacute;chargement n\'existe pas : ' . DIR_FS_DOWNLOAD . '. Le t&eacute;l&eacute;chargement de produits ne fonctionnera qu\'avec un r&eacute;pertoire valide.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La date d\'expiration entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide. Veuillez v&eacute;rifier la date et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Le num&eacute;mero entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide. Veuillez v&eacute;rifier le num&eacute;ro et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Le code &agrave; 4 chiffres que vous avez entr&eacute; est : %s. Si ce code est correct, nous n\'acceptons pas ce type de carte cr&eacute;dit. S\'il est erron&eacute; veuillez r&eacute;essayer.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br />Powered by <a href="http://www.oscommerce.com/index.php" >osCommerce Team</a><br />WAI-A optimized <a href="http://www.magnino.net/index.php" >Maury2ma &amp; VitForLinux</a>');

 define('BOX_INFORMATION_DYNAMIC_SITEMAP', 'Site Map');

// CATALOG_PRODUCTS_WITH
  define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Catalog Imprimable');

define('BOX_INFORMATION_MY_POINTS_HELP', 'Point Program FAQ');//Points/Rewards Module V2.00
#### Points/Rewards Module V2.00 BOF ####
define('REDEEM_SYSTEM_ERROR_POINTS_NOT', 'Points value are not enough to cover the cost of your purchase. Please select another payment method');
define('REDEEM_SYSTEM_ERROR_POINTS_OVER', 'REDEEM POINTS ERROR ! Points value can not be over the total value. Please Re enter points');
define('REFERRAL_ERROR_SELF', 'Sorry you can not refer yourself.');
define('REFERRAL_ERROR_NOT_FOUND', 'The referral email address you entered was not found.');
define('TEXT_POINTS_BALANCE', 'Your Points Info.');
define('TEXT_POINTS', 'Points :');
define('TEXT_VALUE', 'Value:');
define('REVIEW_HELP_LINK', ' Write a Review and earn <span class="b">' .  $currencies->format(USE_POINTS_FOR_REVIEWS * REDEEM_POINT_VALUE) . '</span> worth of points.<br />Please check the <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP,'faq_item=13', 'NONSSL') . '" title="Reward Point Program FAQ">Reward</a> Point Program FAQ for more information.');
#### Points/Rewards Module V2.00 EOF ####

require(DIR_WS_LANGUAGES . 'add_ccgvdc_french.php');  // ICW CREDIT CLASS Gift Voucher Addittion
define('FILENAME_STATS_CREDITS', 'stats_credits.php');

//BOF ask a question
define('IMAGE_BUTTON_ASK_QUESTION','Envoyez-nous une question au sujet de ce produit');
define('BOX_HEADING_ASK_QUESTION','Produit Question');
//EOF ask a question

// JUST SPIFFY Category Descriptions
  define('TEXT_CAT_DESCRIPT', 'Category Descriptions');
// END JUST SPIFFY Category Descriptions

// for image to QTY
 define('TEXT_NOT_AVAIBLE', 'Not avaible');
 define('TEXT_FEW_QTY', 'Few quantity');
 define('TEXT_BIG_QTY', 'Avaible');

// Who's online
define('BOX_HEADING_WHOS_ONLINE', 'Who\'s online?');
define('BOX_WHOS_ONLINE_THEREIS', 'Il y a actuellement');
define('BOX_WHOS_ONLINE_THEREARE', 'Il y a actuellement');
define('BOX_WHOS_ONLINE_GUEST', 'invit&eacute;');
define('BOX_WHOS_ONLINE_GUESTS', 'invit&eacute;s');
define('BOX_WHOS_ONLINE_AND', 'et');
define('BOX_WHOS_ONLINE_MEMBER', 'membre');
define('BOX_WHOS_ONLINE_MEMBERS', 'membres');

//PIVACF start
define('ENTRY_PIVA', 'VAT Number:');
define('ENTRY_PIVA_ERROR', 'Incorrect VAT Number.');
define('ENTRY_PIVA_TEXT', '*');
define('ENTRY_CF', 'Tax Identification Number:');
define('ENTRY_CF_TEXT', '*');
define('ENTRY_CF_ERROR', 'Incorrect Tax Identification Number.');
//PIVACF end

// text for label
define('TEXT_LABEL_INPUT', 'Insert - ');
define('TEXT_QTA', 'Qta');
// text fo label

// text for help HANDICAP
define('EMAIL_TITLE_HANDICAP', 'Richiesta registrazione assistita per non vedenti');
define('EMAIL_BODY_HANDICAP', 'Prego inserite tutti i vostri dati, per potervi aiutare nella registrazione del nostro negozio');
// text for help

	define('BOX_INFORMATION_RSS', 'Catalog Feed');
  define('IMAGE_BUTTON_MORE_INFO', 'More information');
?>