<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'cz_CS'
// on FreeBSD try 'cz_CZ.windows-1250'
// on Windows try 'cz', or 'Czech'
// @setlocale(LC_TIME, 'cz_CS.windows-1250');
@setlocale(\LC_ALL, 'cs_CZ.UTF-8');

\define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
\define('DATE_FORMAT_LONG', '%d. %m. %Y'); // this is used for strftime()
\define('DATE_FORMAT', 'd. m. Y'); // this is used for date()
\define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT.' %H:%M:%S');

// //
// Return date in raw format
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false)
{
    if ($reverse) {
        return substr($date, 3, 2).substr($date, 0, 2).substr($date, 6, 4);
    }

    return substr($date, 6, 4).substr($date, 0, 2).substr($date, 3, 2);
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
\define('LANGUAGE_CURRENCY', 'CZK');

// Global entries for the <html> tag
\define('HTML_PARAMS', 'dir="LTR" lang="cs"');

// charset for web pages and emails
\define('CHARSET', 'UTF-8');

// page title
\define('TITLE', STORE_NAME);

// header text in includes/header.php
\define('HEADER_TITLE_CREATE_ACCOUNT', 'Vytvořit účet');
\define('HEADER_TITLE_MY_ACCOUNT', 'Můj účet');
\define('HEADER_TITLE_CART_CONTENTS', 'Obsah košíku');
\define('HEADER_TITLE_CHECKOUT', 'Pokladna');
\define('HEADER_TITLE_TOP', 'E-shop');
\define('HEADER_TITLE_CATALOG', 'Katalog');
\define('HEADER_TITLE_LOGOFF', 'Odhlásit');
\define('HEADER_TITLE_LOGIN', 'Přihlásit');

// footer text in includes/footer.php
\define('FOOTER_TEXT_REQUESTS_SINCE', 'přístupů od');

// text for gender
\define('MALE', 'Muž');
\define('FEMALE', 'žena');
\define('MALE_ADDRESS', 'Pan');
\define('FEMALE_ADDRESS', 'Paní');

// text for date of birth example
\define('DOB_FORMAT_STRING', 'dd/mm/yyyy');
/*
// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorie');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Výrobci');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Ná tip');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Rychlé hledání');
define('BOX_SEARCH_TEXT', 'Zadejte klíčové slovo(a) pro vyhledání produktu.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Rozířené hledání');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Akce');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Hodnocení');
define('BOX_REVIEWS_WRITE_REVIEW', 'Ohodnote tento produkt:');
define('BOX_REVIEWS_NO_REVIEWS', 'Zatím není ádný produkt ohodnocen');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s z 5 hvězdiček!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Koík');
define('BOX_SHOPPING_CART_EMPTY', '0 poloek');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Historie objednávek');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Nejprodávanějí');
define('BOX_HEADING_BESTSELLERS_IN', 'Nejprodávanějí v<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Upozoròování');
define('BOX_NOTIFICATIONS_NOTIFY', 'Zařaïte:<br> "<b>%s</b>" <br> - do Informačních listů.');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Vyřaïte:<br> "<b>%s</b>" <br> - z Informačních listů.');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Informace o výrobci');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s domovská stránka');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Jiné produkty');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Jazyky');
define('BOX_LANGUAGES_ENGLISH', 'English');
define('BOX_LANGUAGES_DEUTSCH', 'Deutsch');
define('BOX_LANGUAGES_ESPANOL', 'Español');
define('BOX_LANGUAGES_SLOVAK', 'Sloventina');
define('BOX_LANGUAGES_POLISH', 'Polski');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Měny');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informace');
define('BOX_INFORMATION_PRIVACY', 'Ochrana údajů');
define('BOX_INFORMATION_CONDITIONS', 'Jak nakupovat');
define('BOX_INFORMATION_SHIPPING', 'Odeslání a vrácení');
define('BOX_INFORMATION_CONTACT', 'Kontakt');
define('BOX_INFORMATION_BOOK', 'Kniha návtěv');
define('BOX_INFORMATION_VYBAVA', 'Výbavička');
define('BOX_INFORMATION_VELIKOSTI', 'Velikostní tabulka');
define('BOX_INFORMATION_PODPORA', 'Nae banery');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Informujte přátele');
define('BOX_TELL_A_FRIEND_TEXT', 'Øekněte přátelům o tomto produktu.');
 */
// checkout procedure text
\define('CHECKOUT_BAR_DELIVERY', 'Informace o dodání');
\define('CHECKOUT_BAR_PAYMENT', 'Platební informace');
\define('CHECKOUT_BAR_CONFIRMATION', 'Potvrzení');
\define('CHECKOUT_BAR_FINISHED', 'Dokončeno!');

// pull down default text
\define('PULL_DOWN_DEFAULT', 'Prosím, vyberte');
\define('TYPE_BELOW', 'Zadejte níže');

// javascript messages
\define('JS_ERROR', 'Chyby se vyskytly během procesu formuláře.!\nProsíme, proveïte následující opravy:\n\n');

\define('JS_REVIEW_TEXT', '* \'Review Text\' musí mít alespoò '.REVIEW_TEXT_MIN_LENGTH.' znaků.\n');
\define('JS_REVIEW_RATING', '* Musíte oznámkovat produkt pro hodnocení.\n');

\define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Vyberte si způsob platby za Vaši objednávku.\n');
\define('JS_ERROR_SUBMITTED', <<<'EOD'
Tato forma již byla předložena. prosím, stiskněte
  Ok, a čekat na tento proces musí být dokončen.
EOD);
\define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Prosím, vyberte platební metodu pro vaši objednávku.');

\define('CATEGORY_COMPANY', 'Firemní údaje');
\define('CATEGORY_PERSONAL', 'Osobní údaje');
\define('CATEGORY_ADDRESS', 'Vaše adresa');
\define('CATEGORY_CONTACT', 'Kontaktní údaje');
\define('CATEGORY_OPTIONS', '@-novinky MIMIX.cz');
\define('CATEGORY_PASSWORD', 'Vaše heslo');

\define('ENTRY_COMPANY', 'Název společnosti:');
\define('ENTRY_COMPANY_ERROR', '');
\define('ENTRY_COMPANY_TEXT', '');
\define('ENTRY_GENDER', 'Pohlaví:');
\define('ENTRY_GENDER_ERROR', 'Vyberte prosím své pohlaví.');
\define('ENTRY_GENDER_TEXT', '*');
\define('ENTRY_FIRST_NAME', 'Křestní jméno:');
\define('ENTRY_FIRST_NAME_ERROR', 'Jméno musí mít min. '.ENTRY_FIRST_NAME_MIN_LENGTH.' znaků.');
\define('ENTRY_FIRST_NAME_TEXT', '*');
\define('ENTRY_LAST_NAME', 'Příjmení:');
\define('ENTRY_LAST_NAME_ERROR', 'Příjmení musí mít min. '.ENTRY_LAST_NAME_MIN_LENGTH.' znaků.');
\define('ENTRY_LAST_NAME_TEXT', '*');
\define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
\define('ENTRY_DATE_OF_BIRTH_ERROR', 'Datum narození musí mít formát: den/měsíc/rok (např. 05/12/1970)');
\define('ENTRY_DATE_OF_BIRTH_TEXT', '* (např. 05/12/1970)');
\define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
\define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Mail musí mít min. '.ENTRY_EMAIL_ADDRESS_MIN_LENGTH.' znaků.');
\define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Váš e-mail se nezdá být skutečným.');
\define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Tuto e-mailovou adresu již někdo při registraci pouil!');
\define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
\define('ENTRY_STREET_ADDRESS', 'Ulice:');
\define('ENTRY_STREET_ADDRESS_ERROR', 'Ulice musí mít min. '.ENTRY_STREET_ADDRESS_MIN_LENGTH.' znaků.');
\define('ENTRY_STREET_ADDRESS_TEXT', '*');
\define('ENTRY_SUBURB', 'Městská část:');
// define('ENTRY_SUBURB_ERROR', '');
\define('ENTRY_SUBURB_TEXT', '');
\define('ENTRY_POST_CODE', 'PSÈ:');
\define('ENTRY_POST_CODE_ERROR', 'PSÈ musí mít min. '.ENTRY_POSTCODE_MIN_LENGTH.' číslic.');
\define('ENTRY_POST_CODE_TEXT', '*');
\define('ENTRY_CITY', 'Město:');
\define('ENTRY_CITY_ERROR', 'Město musí mít min. '.ENTRY_CITY_MIN_LENGTH.' znaků.');
\define('ENTRY_CITY_TEXT', '*');
\define('ENTRY_STATE', 'Kraj:');
\define('ENTRY_STATE_ERROR', 'Vyber prosím kraj.');
\define('ENTRY_STATE_ERROR_SELECT', 'Vyber prosím kraj.');
\define('ENTRY_STATE_TEXT', '*');
\define('ENTRY_COUNTRY', 'Stát:');
\define('ENTRY_COUNTRY_ERROR', 'Vyber prosím stát.');
\define('ENTRY_COUNTRY_TEXT', '*');
\define('ENTRY_TELEPHONE_NUMBER', 'Telefonní/mobilní číslo:');
\define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefonní/mobilní číslo musí mít min. '.ENTRY_TELEPHONE_MIN_LENGTH.' číslic.');
\define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
\define('ENTRY_FAX_NUMBER', 'Fax:');
// define('ENTRY_FAX_NUMBER_ERROR', '');
\define('ENTRY_FAX_NUMBER_TEXT', '');
\define('ENTRY_NEWSLETTER', 'Zasílání novinek:');
\define('ENTRY_NEWSLETTER_TEXT', '');
\define('ENTRY_NEWSLETTER_YES', 'Přihlášen');
\define('ENTRY_NEWSLETTER_NO', 'Odhlášen');
// define('ENTRY_NEWSLETTER_ERROR', '');
\define('ENTRY_PASSWORD', 'Heslo:');
\define('ENTRY_PASSWORD_ERROR', 'Heslo musí mít min.'.ENTRY_PASSWORD_MIN_LENGTH.' znaků.');
\define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.');
\define('ENTRY_PASSWORD_TEXT', '*');
\define('ENTRY_PASSWORD_CONFIRMATION', 'Potvrzení hesla:');
\define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
\define('ENTRY_PASSWORD_CURRENT', 'Staré heslo:');
\define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
\define('ENTRY_PASSWORD_CURRENT_ERROR', 'Heslo musí mít min.'.ENTRY_PASSWORD_MIN_LENGTH.' znaků.');
\define('ENTRY_PASSWORD_NEW', 'Nové heslo:');
\define('ENTRY_PASSWORD_NEW_TEXT', '*');
\define('ENTRY_PASSWORD_NEW_ERROR', 'Heslo musí mít min.'.ENTRY_PASSWORD_MIN_LENGTH.' znaků.');
\define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.');
\define('PASSWORD_HIDDEN', '--SKRYTO--');

\define('FORM_REQUIRED_INFORMATION', '* Povinné údaje');

// constants for use in tep_prev_next_display function
\define('TEXT_RESULT_PAGE', 'Výsledek:');
\define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazuji <b>%d</b> do <b>%d</b> (z <b>%d</b> produktů)');
\define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazuji <b>%d</b> do <b>%d</b> (z <b>%d</b> objednávek)');
\define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazuji <b>%d</b> do <b>%d</b> (z <b>%d</b> hodnocení)');
\define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zobrazuji <b>%d</b> do <b>%d</b> (z <b>%d</b> nových produktů)');
\define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazuji <b>%d</b> do <b>%d</b> (z <b>%d</b> speciálních nabídek)');

\define('PREVNEXT_TITLE_FIRST_PAGE', 'První stránka');
\define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Předchozí stránka');
\define('PREVNEXT_TITLE_NEXT_PAGE', 'Další stránka');
\define('PREVNEXT_TITLE_LAST_PAGE', 'Poslední stránka');
\define('PREVNEXT_TITLE_PAGE_NO', 'Stránka %d');
\define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Předchozí sada ze %d stran');
\define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Další sada ze %d stránek');
\define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;První');
\define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Předchozí]');
\define('PREVNEXT_BUTTON_NEXT', '[Další&nbsp;&gt;&gt;]');
\define('PREVNEXT_BUTTON_LAST', 'Poslední&gt;&gt;');

\define('IMAGE_BUTTON_ADD_ADDRESS', 'Přidat adresu');
\define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresář');
\define('IMAGE_BUTTON_BACK', 'Zpět');
\define('IMAGE_BUTTON_BUY_NOW', 'Zakupte nyní');
\define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Změnit adresu');
\define('IMAGE_BUTTON_CHECKOUT', 'Dokončit');
\define('IMAGE_BUTTON_CONFIRM_ORDER', 'Potvrdit objednávku');
\define('IMAGE_BUTTON_CONTINUE', 'Pokračovat');
\define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Pokračovat v nákupu');
\define('IMAGE_BUTTON_DELETE', 'Smazat');
\define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Upravit účet');
\define('IMAGE_BUTTON_HISTORY', 'Historie objednávek');
\define('IMAGE_BUTTON_LOGIN', 'Přihlásit');
\define('IMAGE_BUTTON_IN_CART', 'Vložit do košíku');
\define('IMAGE_BUTTON_NOTIFICATIONS', 'Informování');
\define('IMAGE_BUTTON_QUICK_FIND', 'Rychlé hledání');
\define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Zrušit informování');
\define('IMAGE_BUTTON_REVIEWS', 'Hodnocení');
\define('IMAGE_BUTTON_SEARCH', 'Hledat');
\define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Volby dodání');
\define('IMAGE_BUTTON_TELL_A_FRIEND', 'Informovat přátele');
\define('IMAGE_BUTTON_UPDATE', 'Aktualizovat');
\define('IMAGE_BUTTON_UPDATE_CART', 'Aktualizovat košík');
\define('IMAGE_BUTTON_WRITE_REVIEW', 'Napsat hodnocení');

\define('SMALL_IMAGE_BUTTON_DELETE', 'Vymazat');
\define('SMALL_IMAGE_BUTTON_EDIT', 'Změnit');
\define('SMALL_IMAGE_BUTTON_VIEW', 'Zobrazit');

\define('ICON_ARROW_RIGHT', 'Více');
\define('ICON_CART', 'V košíku');
\define('ICON_ERROR', 'Chyba');
\define('ICON_SUCCESS', 'Úspěšnost');
\define('ICON_WARNING', 'Varování');

\define('TEXT_GREETING_PERSONAL', 'Jste přihlášen(a) jako <span class="greetUser">%s.</span> Pokud se chcete podívat na naše zboží, klikněte <a href="%s"><u>sem</u></a>.');
\define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Pokud nejste %s, prosím, <a href="%s"><u>přihlašte se</u></a> s vaším jménem a heslem.</small>');
\define('TEXT_GREETING_GUEST', 'Jste zde jako <span class="greetUser">nepřihlášený zákazník.</span> Pokud jste přihlášen(á), <a href="%s"><u>přihlašte se</u></a>, prosím. Pokud nejste zatím přihlášen(á), můžete se přihlasit jako nový zákazník : <a href="%s"><u>zde</u></a>.');

\define('TEXT_SORT_PRODUCTS', 'Třídit produkty ');
\define('TEXT_DESCENDINGLY', 'sestupně');
\define('TEXT_ASCENDINGLY', 'vzestupně');
\define('TEXT_BY', ' dle ');

\define('TEXT_REVIEW_BY', 'dle %s');
\define('TEXT_REVIEW_WORD_COUNT', '%s slov');
\define('TEXT_REVIEW_RATING', 'hodnocení: %s [%s]');
\define('TEXT_REVIEW_DATE_ADDED', 'datu přidání: %s');
\define('TEXT_NO_REVIEWS', 'Není zatím hodnocen žádný produkt.');

\define('TEXT_NO_NEW_PRODUCTS', 'V systému není zatím žádný produkt.');

\define('TEXT_UNKNOWN_TAX_RATE', 'Neznámá sazba daně');

\define('TEXT_REQUIRED', 'Povinný údaj');

\define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#333366"><b><small>CHYBA:</small> Nemůžu odeslat e-mail přes zadaný SMTP server. Prosím, zkontrolujte nastavení v php.ini a opravte nastavení SMTP serveru pokud je to nutné.</b></font>');

\define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Expirační datum vložené pro tuto kreditní kartu je chybné.<br>Prosím, zkontrolujte datum a zkuste to znovu.');
\define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Vložené číslo kreditní karty je chybné.<br>Prosím, zkontrolujte ho a zkuste to znovu.');
\define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'První čtyři zadaná čísla kreditní karty jsou: %s<br>Pokud jsou tato čísla správně, nepřijímáme tento typ kreditní (platební) karty .<br>Pokud je špatné, prosím opravte ho a zkuste to znovu.');

\define('FOOTER_TEXT_BODY', 'Copyright &copy; '.date('Y').' <a href="/">'.STORE_NAME.'</a>');

\define('ENTRY_LEGAL_AGREEMENTS_ERROR', 'Musíte souhlasit s právními podmínkami.');

\define('ENTRY_LEGAL_AGREEMENTS', 'Přečetl(a) jsem si a souhlasím s <a href="%s" target="_blank"><u>Obchodními podmínkami</u></a> a <a href="%s" target="_blank"><u>Zásadami ochrany osobních údajů</u></a>');
\define('ENTRY_LEGAL_AGREEMENTS_TEXT', '');
