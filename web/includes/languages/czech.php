<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//themes
define('BOX_HEADING_THEMES', 'Šablony');

//TotalB2B start
define('PRICES_LOGGED_IN_TEXT','Pro zobrazení cen se musíte přihlásit!');
//TotalB2B end

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server. shop2.0brain: pozor, fakt vyzkouset, nastaveni spatne dela prusery
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
//@setlocale(LC_TIME, 'en_US.ISO_8859-1'); //shop2.0brain:bug kdyz se nastavi spravne ceske trideni, posere se objednavka
//setlocale(LC_ALL, 'cs_CZ.utf-8'); 
setlocale(LC_TIME, 'en_US.ISO_8859-1'); 

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
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
define('LANGUAGE_CURRENCY', 'CZK');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="cs" xml:lang="cs"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'vytvořit účet');
define('HEADER_TITLE_MY_ACCOUNT', 'můj účet');
define('HEADER_TITLE_CART_CONTENTS', 'košík');
define('HEADER_TITLE_CHECKOUT', 'pokladna');
define('HEADER_TITLE_TOP', 'Top Site');
define('HEADER_TITLE_CATALOG', 'homepage');
define('HEADER_TITLE_LOGOFF', 'odhlásit');
define('HEADER_TITLE_LOGIN', 'přihlášení');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'x shlédnuto od :');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');
define('MALE_ADDRESS', 'Pan');
define('FEMALE_ADDRESS', 'Paní');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');	

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', ''); //jsp:conf prazdne 
//define('BOX_HEADING_CATEGORIES', 'kategorie'); //jsp:conf plne:
define('BOX_HEADING_PRICE_LIST', 'Ceník');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Autoři');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'novinky');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'rychlé hledání');
define('BOX_SEARCH_TEXT', '');
define('BOX_SEARCH_ADVANCED_SEARCH', 'pokročilé vyhledávání');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Zlevněné zboží');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'hodnocení');
define('BOX_REVIEWS_WRITE_REVIEW', 'Přidejte své hodnocení');
define('BOX_REVIEWS_NO_REVIEWS', 'Zatím nikdo nehodnotil');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s z 5 Hvězdiček!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'nákupní košík');
define('BOX_SHOPPING_CART_EMPTY', '..prázdný');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'historie objednávek');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'nejprodávanější');
define('BOX_HEADING_BESTSELLERS_IN', 'bestsellery v<br />&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'oblíbené');
define('BOX_NOTIFICATIONS_NOTIFY', 'přidat do seznamu oblíbených výrobků<span class="b">%s</span>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'odstranit ze seznamu oblíbených výrobků<span class="b">%s</span>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'informace o autorovi');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage autora');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Jiné produkty');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Jazyk');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'měna');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'informace');
define('BOX_INFORMATION_PRIVACY', 'ochrana dat');
define('BOX_INFORMATION_CONDITIONS', 'Dodací podmínky');
define('BOX_INFORMATION_SHIPPING', 'Platba a dodání');
define('BOX_INFORMATION_CONTACT', 'Vaše připomínky');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Upozornit přátele');
define('BOX_TELL_A_FRIEND_TEXT', 'Info na email');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Podmínky dodání');
define('CHECKOUT_BAR_PAYMENT', 'Informace o platbě');
define('CHECKOUT_BAR_CONFIRMATION', 'Potvrdit');
define('CHECKOUT_BAR_FINISHED', 'Hotovo!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Všechno');
define('TYPE_BELOW', 'Napiš níže');

// javascript messages
define('JS_ERROR', 'Ve vypnění formuláře byla nalezena chyba!\nProveďte prosím následující opravy:\n\n');

define('JS_REVIEW_TEXT', '* Text \'Hodnocení\' musí mít nejméně ' . REVIEW_TEXT_MIN_LENGTH . ' znaků.\n');
define('JS_REVIEW_RATING', '* přepočítat zboží\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Prosím vyberte typ platby.\n');

define('JS_ERROR_SUBMITTED', 'Tento formulář je připraven k odeslání. Stiskněte Ok a vyčkejte až se dokončí tento proces.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Prosím vyberte typ platby.');

define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_PERSONAL', 'Osobní');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_OPTIONS', 'Nastavení');
define('CATEGORY_PASSWORD', 'Heslo');

define('ENTRY_COMPANY', 'Firma:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'pohlaví:');
define('ENTRY_GENDER_ERROR', 'výběr pohlaví');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', 'JMÉNO musí mít nejméně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Příjmení');
define('ENTRY_LAST_NAME_ERROR', 'PŘÍJMENÍ musí mít nejméně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'DATUM NAROZENÍ musí mít tento tvar: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (např. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-MAIL musí mít nejméně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-MAIL je v neplatném tvaru');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'E-MAIL již existuje v databázi');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Ulice');
define('ENTRY_STREET_ADDRESS_ERROR', 'ULICE musí mít nejméně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Číslo:');
define('ENTRY_SUBURB_ERROR', 'Zadej číslo');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', 'PSČ musí mít nejméně ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', 'MĚSTO musí mít nejméně ' . ENTRY_CITY_MIN_LENGTH . ' znaků.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Stát:');
define('ENTRY_STATE_ERROR', 'STÁT musí mít nejméně ' . ENTRY_STATE_MIN_LENGTH . ' znaků.');
define('ENTRY_STATE_ERROR_SELECT', 'Prosím vyber níže.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Země	:');
define('ENTRY_COUNTRY_ERROR', 'Vyberte zemi v menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslo:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'TELEFONNÍ ČÍSLO musí mít nejméně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Novinky:');
define('ENTRY_NEWSLETTER_TEXT', 'Zasílat novinky');
define('ENTRY_NEWSLETTER_YES', 'Přihlásit k zasílání');
define('ENTRY_NEWSLETTER_NO', 'Odhlásit zasílání');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PRIVACY', 'Četl jsem - <a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a> - <a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a> - ');
define('ENTRY_PRIVACY_TEXT', '*');
define('ENTRY_PRIVACY_ERROR', 'Nečetl jsem ' . BOX_INFORMATION_PRIVACY . '  ' . BOX_INFORMATION_CONDITIONS);
define('ENTRY_PASSWORD', 'Heslo:');
define('ENTRY_PASSWORD_ERROR', 'HESLO musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Obě hesla nejsou shodná.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Heslo znovu:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Původní heslo:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'HESLO musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.');
define('ENTRY_PASSWORD_NEW', 'Nové heslo:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'NOVÉ HESLO musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Obě hesla musí být shodná.');
define('PASSWORD_HIDDEN', '--Skryté--');

define('FORM_REQUIRED_INFORMATION', '* Povinné údaje');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Celkem stran:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazeno <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> produktů)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazeno <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazeno <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> hodnocení)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zobrazeno <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> novinek)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazeno <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> slev)');
    
define('PREVNEXT_TITLE_FIRST_PAGE', 'První strana');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Předchozí strana');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Další strana');
define('PREVNEXT_TITLE_LAST_PAGE', 'Poslední strana');
define('PREVNEXT_TITLE_PAGE_NO', 'Strana %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Předcházejících %d stran');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Dalších %d stran');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;První');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Předchozí]');
define('PREVNEXT_BUTTON_NEXT', '[Další&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'Poslední&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Přidat adresu');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresář');
define('IMAGE_BUTTON_BACK', 'Zpět');
define('IMAGE_BUTTON_BUY_NOW', 'koupit');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Změnit adresu');
define('IMAGE_BUTTON_CHECKOUT', 'dokončit objednávku - zaplatit');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Potvrdit objednávku');
define('IMAGE_BUTTON_CONTINUE', 'pokračovat');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'objednat další zboží');
define('IMAGE_BUTTON_DELETE', 'Smazat');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'upravit účet');
define('IMAGE_BUTTON_HISTORY', 'historie objednávek');
define('IMAGE_BUTTON_LOGIN', 'přihlásit se');
define('IMAGE_BUTTON_IN_CART', 'přidat do košíku');
define('IMAGE_BUTTON_NOTIFICATIONS', 'zpráva');
define('IMAGE_BUTTON_QUICK_FIND', 'rychlé hledání');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'smazat zprávu');
define('IMAGE_BUTTON_REVIEWS', 'hodnocení');
define('IMAGE_BUTTON_SEARCH', 'hledat');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'doprava');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'oznam příteli');
define('IMAGE_BUTTON_UPDATE', 'obnovit');
define('IMAGE_BUTTON_UPDATE_CART', 'obnovit košík');
define('IMAGE_BUTTON_WRITE_REVIEW', 'zapsat hodnocení');

define('SMALL_IMAGE_BUTTON_DELETE', 'smazat');
define('SMALL_IMAGE_BUTTON_EDIT', 'upravit');
define('SMALL_IMAGE_BUTTON_VIEW', 'zobrazit');

define('ICON_ARROW_RIGHT', 'více');
define('ICON_CART', 'v košíku');
define('ICON_ERROR', 'chyba');
define('ICON_SUCCESS', 'úspěšně');
define('ICON_WARNING', 'pozor');

define('TEXT_GREETING_PERSONAL', 'Vítejte u nás zpět <span class="greetUser">%s!</span> Čtěte zde <a href="%s"><span class="ColorSpan">nové zboží</span></a> je připraveno pro Vás.');
define('TEXT_GREETING_PERSONAL_RELOGON', 'If you are not %s, please <a href="%s"><span class="ColorSpan">log yourself in</span></a> s informací o Vašem účtu.');
define('TEXT_GREETING_GUEST', 'Vítejte <span class="greetUser">Neznámý!</span> chcete se <a href="%s"><span class="ColorSpan">přihlásit</span></a>? nebo teprve <a href="%s"><span class="ColorSpan">zaregistrovat</span></a>?');

define('TEXT_SORT_PRODUCTS', 'Seřadit ');
define('TEXT_DESCENDINGLY', 'sestupně');
define('TEXT_ASCENDINGLY', 'vzestupně');
define('TEXT_BY', ' podle ');

define('TEXT_REVIEW_BY', 'na %s');
define('TEXT_REVIEW_WORD_COUNT', '%s slov');
define('TEXT_REVIEW_RATING', 'Hodnocení: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Přidáno: %s');
define('TEXT_NO_REVIEWS', 'Zatím není žádné hodnocení.');

define('TEXT_NO_NEW_PRODUCTS', 'Není vybráno žádné zboží.');

define('TEXT_UNKNOWN_TAX_RATE', 'neznámá hodnota daně');

define('TEXT_REQUIRED', '<span class="ColorRed">Je nutno</span>');

define('ERROR_TEP_MAIL', '<span class="ColorSpanRed2"><span class="b">TEP ERROR: Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</span></span>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Pozor: Installation directory exists at: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. Please remove this directory for security reasons.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Pozor: I am able to write to the configuration file: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_CONFIG_FILE_WRITEABLE_ADMIN', 'Pozor: I am able to write to the configuration file: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/admin/includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Pozor: The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Pozor: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SESSION_AUTO_START', 'Pozor: session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Pozor: The downloadable products directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable products will not work until this directory is valid.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br /><a href="http://www.studioiq.cz" >webdesign studioIQ</a>');

 define('BOX_INFORMATION_DYNAMIC_SITEMAP', 'Site Map');
 
 // CATALOG_PRODUCTS_WITH
  define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Katalog k vytištění');
 
 define('BOX_INFORMATION_MY_POINTS_HELP', 'Bonusové body - často kladené dotazy');//Points/Rewards Module V2.00
#### Points/Rewards Module V2.00 BOF ####
define('REDEEM_SYSTEM_ERROR_POINTS_NOT', 'Bodová hodnota není   v ceně Vašeho nákupu. Vyberte jiný způsob placení.');
define('REDEEM_SYSTEM_ERROR_POINTS_OVER', 'REDEEM POINTS ERROR ! Body nedosahují celkové hodnoty. Znovu vložte body');
define('REFERRAL_ERROR_SELF', 'Omlouváme se, nemůžete přiřadit sám sobě.');
define('REFERRAL_ERROR_NOT_FOUND', 'Emailová adresa, kterou jste uvedl neexistuje.');
define('TEXT_POINTS_BALANCE', 'Vaše bonusové body');
define('TEXT_POINTS', 'Bodů :');
define('TEXT_VALUE', 'Hodnota:');
define('REVIEW_HELP_LINK', ' Napište hodnocení <span class="b">' .  $currencies->format(USE_POINTS_FOR_REVIEWS * REDEEM_POINT_VALUE) . '</span> worth of points.<br />Please check the <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP,'faq_item=13', 'NONSSL') . '" title="program bonusový bodů - často kladené dotazy">Reward</a> pro další informace.');
#### Points/Rewards Module V2.00 EOF ####
 
require(DIR_WS_LANGUAGES . 'add_ccgvdc_english.php');  // ICW CREDIT CLASS Gift Voucher Addittion
define('FILENAME_STATS_CREDITS', 'stats_credits.php');
 
//BOF ask a question
define('IMAGE_BUTTON_ASK_QUESTION','Poslat dotaz na tento produkt');
define('BOX_HEADING_ASK_QUESTION','Produkt - dotaz');
//EOF ask a question
 
// JUST SPIFFY Category Descriptions
  define('TEXT_CAT_DESCRIPT', 'Popis kategorie');
// END JUST SPIFFY Category Descriptions

// for image to QTY //skladem
 define('TEXT_NOT_AVAIBLE', '<b>rozebráno</b>');
 define('TEXT_FEW_QTY', '<b>na skladě je malé množství</b>');
 define('TEXT_BIG_QTY', '<b>na skladě</b>');

// Who's online
define('BOX_HEADING_WHOS_ONLINE', 'Kdo je online?');
define('BOX_WHOS_ONLINE_THEREIS', 'právě přihlášen');
define('BOX_WHOS_ONLINE_THEREARE', 'právě přihlášených');
define('BOX_WHOS_ONLINE_GUEST', 'neznámý');
define('BOX_WHOS_ONLINE_GUESTS', 'neznámých');
define('BOX_WHOS_ONLINE_AND', 'a');
define('BOX_WHOS_ONLINE_MEMBER', 'přihlášen');
define('BOX_WHOS_ONLINE_MEMBERS', 'přihlášených');

//PIVACF start
define('ENTRY_PIVA', 'DIČ:');
define('ENTRY_PIVA_ERROR', 'nekorektní DIČ.');
define('ENTRY_PIVA_TEXT', '*');
define('ENTRY_CF', 'IČO:');
define('ENTRY_CF_TEXT', '*');
define('ENTRY_CF_ERROR', 'nekorektní IČO.');
//PIVACF end

// text for label
define('TEXT_LABEL_INPUT', 'vložit - ');
define('TEXT_QTA', 'ks');
// text fo label

// text for help HANDICAP
define('EMAIL_TITLE_HANDICAP', 'registrace pro nevidomé');
define('EMAIL_BODY_HANDICAP', 'vložte prosím všechny údaje vhodné pro registraci');
// text for help

define('BOX_INFORMATION_RSS', 'RSS kanály');
define('IMAGE_BUTTON_MORE_INFO', 'Další informace');
define('BOX_HEADING_ARTICLES','Články');
define('BOX_HEADING_AUTHORS','Autoři');
define('TEXT_MORE','<u>celý text</u>');

//podrobny popis
define('TEXT_PRODUCTS_DESCRIPTION_LONG','podrobný popis');
define('TEXT_ALL_PRODUCTS_DESCRIPTION_LONG','všechny ukázky');
define('BUTTON_PRODUCTS_DESCRIPTION_LONG','');
define('TEXT_PRODUCTS_DESCRIPTION_LONG2','');

//dotisk
define('TEXT_PRODUCTS_DESCRIPTION_DOTISK','dotisk');
define('BOX_HEADING_DOTISK','');

//shop2.0brain:new email warning login
define('EMAIL_TEXT_WARNING_LOGIN','POZOR: před kliknutim na odkaz se musíte neprve přihlásit');

//extra email footer
define('EMAIL_ORDER_EXTRA_FOOTER','Vaše objednávka byla předána k vyřízení internetovému knihkupectví Kosmas.cz. Jakmile bude zařazena do jeho objednávkového systému, obdržíte na svou e-mailovou adresu potvrzení s číslem objednávky, pod kterým bude vedena. Pokud jste zvolil(a) jako formu platby bankovní převod, budou součástí potvrzení také všechny informace potřebné k provedení platby. Jakmile bude zásilka s objednaným zbožím odeslána, obdržíte od knihkupectví Kosmas.cz zprávu o expedici s podacím číslem zásilky.');
//paticka
define('TEXT_FOOTER','&copy; Antitrust 2009, 
 &copy; 2009  <a href="http://www.studioiq.cz">web design studioIQ.cz</a> powered by <a href="http://oscommerce.com">osCommerce</a>');
//registrace
define('IMAGE_BUTTON_REGISTER','zaregistrovat se');
//by = autor atd
define('TEXT_BYX','autor');
//interni mail na objednavky osobni odber
define('MAIL_INTERNI','lukesova@e-garamond.cz');
//define('MAIL_INTERNI','kratky@jeansolpartre.com');
//jsp:new: zlevnene knihy casove omezene expires_date>0
define('BOX_HEADING_SPECIALS_TIMED', 'Akční slevy');


//pro jistotu email objednavka
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', ''); //Pokud platíte bankovním převodem, uhraďte částku na účet číslo 177022379/0600 pod variabilnim symbolem uvedeným v záhlaví objednávky.
define('CLAIM','Právo<br>hospodářské soutěže<br>v proměnách doby');

//top menu international
define('MENU_ABOUT_US','o nás');
define('MENU_HELP','jak nakupovat');
define('CATEGORY_ADMIN','Admin kategorie: výpis článků');
define('ADMIN_NEW_PRODUCT_IN_CATEGORY','nový článek v kategorii');
define('ADMIN_CURRENT_CATEGORY','administrace aktuální kategorie');

// Poll Box Text //jsp:new:ankety
define('_RESULTS', 'výsledky ankety');
define('_POLLS','Ankety');
define('_VOTE', 'Hlasovat');
define('_VOTES', 'počet hlasů');
define('_NOPOLLS','Anketa není k dispozici');
define('_COMMENTS','komentářů');
define('_NOPOLLSCONTENT','Anketa není k dispozici, ale můžete se podívat na starší výsledky<br><br><a href="pollbooth.php">['._POLLS.']');

//jsp:new:events_calendar
define('BOX_TOOLS_EVENTS_MANAGER', 'Events Manager');
define('IMAGE_NEW_EVENT', 'New Event');
define('HP_AKTUALITY','aktuality');
define('TOPMENU_CONTACT', 'kontakt');
define('MENU_DEVELOPPERS','pro developery');
define('MENU_REFERENCE','reference');
define('LM_TITLE','<b>užitečné odkazy</b>');
