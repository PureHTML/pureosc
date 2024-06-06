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
define('PRICES_LOGGED_IN_TEXT','Must be logged in for prices!');
//TotalB2B end

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'nl_NL');

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
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="nl" xml:lang="nl"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Account Aanmaken');
define('HEADER_TITLE_MY_ACCOUNT', 'Mijn Account');
define('HEADER_TITLE_CART_CONTENTS', 'Inhoud Winkelwagen');
define('HEADER_TITLE_CHECKOUT', 'Afrekenen');
define('HEADER_TITLE_TOP', 'Hoofdpagina');
define('HEADER_TITLE_CATALOG', 'Winkel');
define('HEADER_TITLE_LOGOFF', 'Uitloggen');
define('HEADER_TITLE_LOGIN', 'Inloggen');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'Aanroepen sinds');

// text for gender
define('MALE', 'Man');
define('FEMALE', 'Vrouw');
define('MALE_ADDRESS', 'Dhr.');
define('FEMALE_ADDRESS', 'Mevr.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorie&euml;n');
define('BOX_HEADING_PRICE_LIST', 'Price List');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabrikanten');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Nieuwe Producten');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Snel Zoeken');
define('BOX_SEARCH_TEXT', 'Gebruik sleutelworden om het product te vinden.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Geavanceerd Zoeken');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Aanbiedingen');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Reviews');
define('BOX_REVIEWS_WRITE_REVIEW', 'Schrijf een review over dit product!');
define('BOX_REVIEWS_NO_REVIEWS', 'Er zijn geen reviews over dit product. Wees de eerste!');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s van 5 Sterren!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Winkelwagen');
define('BOX_SHOPPING_CART_EMPTY', '0 voorwerpen');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestel Geschiedenis');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestsellers');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestsellers in<br />&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificaties');
define('BOX_NOTIFICATIONS_NOTIFY', 'Hou mij op de hoogte van updates voor <span class="b">%s</span>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Hou mij <span class="b">niet</span> op de hoogte van updates voor <span class="b">%s</span>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabrikant Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Website');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Andere producten');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Talen');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Valuta');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informatie');
define('BOX_INFORMATION_PRIVACY', 'Privacy Policy');
define('BOX_INFORMATION_CONDITIONS', 'Algemene Voorwaarden');
define('BOX_INFORMATION_SHIPPING', 'Verzend Info');
define('BOX_INFORMATION_CONTACT', 'Contact');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Vertel een vriend');
define('BOX_TELL_A_FRIEND_TEXT', 'Vertel iemand die je kent over dit product.');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Verzend Informatie');
define('CHECKOUT_BAR_PAYMENT', 'Betaal Informatie');
define('CHECKOUT_BAR_CONFIRMATION', 'Bevestigen');
define('CHECKOUT_BAR_FINISHED', 'Gereed!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selecteer');
define('TYPE_BELOW', 'Type hieronder');

// javascript messages
define('JS_ERROR', 'Fouten hebben zich voorgedaan tijdens het verwerken van het formulier!\nMaak de volgende aanpassingen:\n\n');

define('JS_REVIEW_TEXT', '* De \'Review Tekst\' Moet minimaal ' . REVIEW_TEXT_MIN_LENGTH . ' karakters zijn.\n');
define('JS_REVIEW_RATING', '* Je moet het product een waardering geven voor de review.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Selecteer de wijze van betaling voor uw order.\n');

define('JS_ERROR_SUBMITTED', 'Dit formulier is al verstuurd. Klik op OK en wacht tot de verwerking van deze order gedaan is.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Selecteer de wijze van betaling voor uw bestelling.');

define('CATEGORY_COMPANY', 'Bedrijfs gegevens');
define('CATEGORY_PERSONAL', 'Persoonlijke gegevens');
define('CATEGORY_ADDRESS', 'Uw Adres');
define('CATEGORY_CONTACT', 'Contact Informatie');
define('CATEGORY_OPTIONS', 'Opties');
define('CATEGORY_PASSWORD', 'Het wachtwoord');

define('ENTRY_COMPANY', 'Bedrijfsnaam:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Geslacht:');
define('ENTRY_GENDER_ERROR', '&nbsp;verplicht');
define('ENTRY_GENDER_TEXT', '&nbsp;verplicht');
define('ENTRY_FIRST_NAME', 'Voornaam:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakters');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;required');
define('ENTRY_LAST_NAME', 'Achternaam:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakters');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;verplicht');
define('ENTRY_DATE_OF_BIRTH', 'Geboortedatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;(bv. 12/24/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;(bv. 12/24/1970) verplicht');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adres:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakters');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;Geef a.u.b. een bestaand e-mail adres!');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;Het e-mail adres bestaat al!');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;verplicht');
define('ENTRY_STREET_ADDRESS', 'Straatnaam:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakters');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;verplicht');
define('ENTRY_SUBURB', 'Wijk:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postcode:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;min ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakters');
define('ENTRY_POST_CODE_TEXT', '&nbsp;verplicht');
define('ENTRY_CITY', 'Plaats:');
define('ENTRY_CITY_ERROR', '&nbsp;min ' . ENTRY_CITY_MIN_LENGTH . ' karakters');
define('ENTRY_CITY_TEXT', '&nbsp;verplicht');
define('ENTRY_STATE', 'Provincie:');
define('ENTRY_STATE_ERROR', '&nbsp;<verplicht');
define('ENTRY_STATE_TEXT', '&nbsp;verplicht');
define('ENTRY_STATE_ERROR_SELECT', 'Selecteer a.u.b. een provincie uit het pull down menu.');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;verplicht');
define('ENTRY_TELEPHONE_NUMBER', 'Telefoonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakters');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;verplicht');
define('ENTRY_FAX_NUMBER', 'Faxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Nieuwsbrief:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'ingeschrijven');
define('ENTRY_NEWSLETTER_NO', 'uitschrijven');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PRIVACY', 'Ho letto le - <a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a> - e le - <a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a> - ');
define('ENTRY_PRIVACY_TEXT', '*');
define('ENTRY_PRIVACY_ERROR', 'Non hai letto le ' . BOX_INFORMATION_PRIVACY . ' e le ' . BOX_INFORMATION_CONDITIONS);
define('ENTRY_PASSWORD', 'Wachtwoord:');
define('ENTRY_PASSWORD_ERROR', '&nbsp;min ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakters');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.');
define('ENTRY_PASSWORD_TEXT', '&nbsp;verplicht');
define('ENTRY_PASSWORD_CONFIRMATION', 'Wachtwoord Bevestigen:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;verplicht');
define('ENTRY_PASSWORD_CURRENT', 'Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Verplicht veld ');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Porduct <span class="b">%d</span> tot <span class="b">%d</span> (van <span class="b">%d</span> producten)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Bestelling <span class="b">%d</span> tot <span class="b">%d</span> (van <span class="b">%d</span> bestellingen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Review <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Nieuw product <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> nieuwe producten)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Aanbieding <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> aanbieding)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Eerste Pagina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorige Pagina');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Volgende Pagina');
define('PREVNEXT_TITLE_LAST_PAGE', 'Laatste Pagina');
define('PREVNEXT_TITLE_PAGE_NO', 'Pagina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorige Set van %d Pagina\'s');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Volgende Set van %d Pagina\'s');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;Eerste');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Vorige]');
define('PREVNEXT_BUTTON_NEXT', '[Volgende&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'Laatste&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Adres Toevoegen');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresboek');
define('IMAGE_BUTTON_BACK', 'Terug');
define('IMAGE_BUTTON_BUY_NOW', 'Buy&nbsp;Now');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adres vernaderen');
define('IMAGE_BUTTON_CHECKOUT', 'Afrekenen');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bevestigen');
define('IMAGE_BUTTON_CONTINUE', 'Ga verder');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Winkel verder');
define('IMAGE_BUTTON_DELETE', 'Verwijderen');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Bewerk Account');
define('IMAGE_BUTTON_HISTORY', 'Bestel Geschiedenis');
define('IMAGE_BUTTON_LOGIN', 'Inloggen');
define('IMAGE_BUTTON_IN_CART', 'In de Winkelwagen');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaties');
define('IMAGE_BUTTON_QUICK_FIND', 'Snel Zoeken');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Verwijder Notificaties');
define('IMAGE_BUTTON_REVIEWS', 'Reviews');
define('IMAGE_BUTTON_SEARCH', 'Zoeken');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Verzend Opties');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Vertel een vriend');
define('IMAGE_BUTTON_UPDATE', 'Update');
define('IMAGE_BUTTON_UPDATE_CART', 'Update Winkelwagen');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Schrijf Review');

define('SMALL_IMAGE_BUTTON_DELETE', 'Delete');
define('SMALL_IMAGE_BUTTON_EDIT', 'Edit');
define('SMALL_IMAGE_BUTTON_VIEW', 'View');

define('ICON_ARROW_RIGHT', 'meer');
define('ICON_CART', 'In de Winkelwagen');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Waarschuwing');

define('TEXT_GREETING_PERSONAL', 'Welkom terug <span class="greetUser">%s!</span> Wil je de <a href="%s"><span class="ColorSpan">nieuwe producten</span></a> zien?');
define('TEXT_GREETING_PERSONAL_RELOGON', 'Als u niet %s bent, <a href="%s"><span class="ColorSpan">log uzelf in</span></a> met u account informatie.');
define('TEXT_GREETING_GUEST', 'Welkom <span class="greetUser">Gast!</span> Wilt u <a href="%s"><span class="ColorSpan">inloggen</span></a>? Of wilt u een nieuw account <a href="%s"><span class="ColorSpan">aanmaken</span></a>? Alleen met een account kunt u dingen bestellen.');

define('TEXT_SORT_PRODUCTS', 'Sorteer producten ');
define('TEXT_DESCENDINGLY', 'aflopend');
define('TEXT_ASCENDINGLY', 'oplopend');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'bij %s');
define('TEXT_REVIEW_WORD_COUNT', '%s woorden');
define('TEXT_REVIEW_RATING', 'Waardering: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Datum Toegevoegd: %s');
define('TEXT_NO_REVIEWS', 'Er zijn geen product reviews.');

define('TEXT_NO_NEW_PRODUCTS', 'Er zijn geen nieuwe products.');

define('TEXT_UNKNOWN_TAX_RATE', 'Onbekend belastingstarief');

define('TEXT_REQUIRED', '<span class="ColorRed">Required</span>');

define('ERROR_TEP_MAIL', '<span class="ColorSpanRed2"><span class="b">TEP ERROR: Kan de email niet via de opgegeven SMTP server versturen. Controleer de php.ini instellingen en maak eventueel de nodige aanpassingen.</span></span>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Waarschuwing: Installatie directory bestaat nog: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. Verwijder deze directory voor veiligheids overwegingen.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warning: Ik kan het configuratie bstand: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php beschrijven. Dit is een potentieel risico - Stel de user permissies goed in.');
define('WARNING_CONFIG_FILE_WRITEABLE_ADMIN', 'Warning: Ik kan het configuratie bstand: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/admin/includes/configure.php beschrijven. Dit is een potentieel risico - Stel de user permissies goed in.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Waarschuwing: De sessies directory bestaat niet: ' . tep_session_save_path() . '. Sessies zullen niet werken totdat de directory is aangemaakt.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Waarschuwing: Ik kan niet naar de sessies directory schrijven: ' . tep_session_save_path() . '. Sessies zullen niet werken totdat de user permissies goed zijn gezet.');
define('WARNING_SESSION_AUTO_START', 'Waarschuwing: session.auto_start staat aan - zet deze uit in php.ini en hetstart de web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Waarschuwing: De download producten directory bestaat niet: ' . DIR_FS_DOWNLOAD . '. Download producten zal niet werken totdat deze directory is aangemaakt.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'De verloop datum ingevult voor de credit card is ongeldig. Controleer de datum en probeer opnieuw.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Het credit card nummer ingevult is ongeldig. Controleer het nummer en probeer opnieuw.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'De eerste vier ingevulde nummer van de credit card zijn: %s. Als dit correct is, dan accepteren wij dit type credit card niet.Als het niet klopt, probeer het opnieuw.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br />Powered by <a href="http://www.oscommerce.com/index.php" >osCommerce Team</a><br />WAI-A optimized <a href="http://www.magnino.net/index.php" >Maury2ma &amp; VitForLinux</a>');

 define('BOX_INFORMATION_DYNAMIC_SITEMAP', 'Site Map');

// CATALOG_PRODUCTS_WITH
  define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Printable Catalog');

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

require(DIR_WS_LANGUAGES . 'add_ccgvdc_dutch.php');  // ICW CREDIT CLASS Gift Voucher Addittion
define('FILENAME_STATS_CREDITS', 'stats_credits.php');
 
//BOF ask a question
define('IMAGE_BUTTON_ASK_QUESTION','Send us a question about this Product');
define('BOX_HEADING_ASK_QUESTION','Product Question');
//EOF ask a question
 
// JUST SPIFFY Category Descriptions
  define('TEXT_CAT_DESCRIPT', 'Category Descriptions');
// END JUST SPIFFY Category Descriptions
 
// for image to QTY
 define('TEXT_NOT_AVAIBLE', 'Not avaible');
 define('TEXT_FEW_QTY', 'Few quantity');
 define('TEXT_BIG_QTY', 'Avaible');

// Who's online
define('BOX_HEADING_WHOS_ONLINE', 'Wie is er online?');
define('BOX_WHOS_ONLINE_THEREIS', 'Momenteel is er');
define('BOX_WHOS_ONLINE_THEREARE', 'Momenteel zijn er');
define('BOX_WHOS_ONLINE_GUEST', 'gast');
define('BOX_WHOS_ONLINE_GUESTS', 'gasten');
define('BOX_WHOS_ONLINE_AND', 'en');
define('BOX_WHOS_ONLINE_MEMBER', 'lid');
define('BOX_WHOS_ONLINE_MEMBERS', 'leden');

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
define('MENU_ABOUT_US','verlager');

?>