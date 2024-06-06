<?php
/*
Cesky preklad a uprava pro "osCommerce 2.2 Milestone 2 Release Notes"
Last Update: 13/03/2003
Author: MrPedro (MrPedro@sverma.com)
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
//setlocale(LC_TIME, 'cs_CZ.iso8859-2');
setlocale(LC_TIME, 'cs_CZ.utf8');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
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

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'utf-8');
//define('CHARSET', 'windows-1250');
// page title
define('TITLE', 'ShopAdmin');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrace');
define('HEADER_TITLE_SUPPORT_SITE', 'Podpora');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Shop');
define('HEADER_TITLE_ADMINISTRATION', 'Administrace');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/rrrr');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurace');
define('BOX_CONFIGURATION_MYSTORE', 'Můj obchod');
define('BOX_CONFIGURATION_LOGGING', 'Přihlášení');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly');
define('BOX_MODULES_PAYMENT', 'Platby');
define('BOX_MODULES_SHIPPING', 'Doprava');
define('BOX_MODULES_ORDER_TOTAL', 'Objednávky');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Produkty');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Podrobnosti produktů');
define('BOX_CATALOG_MANUFACTURERS', 'Výrobce');
define('BOX_CATALOG_REVIEWS', 'Hodnocení');
define('BOX_CATALOG_SPECIALS', 'Slevy');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produkty - fronta');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Uživatelé');
define('BOX_CUSTOMERS_CUSTOMERS', 'Uživatelé');
define('BOX_CUSTOMERS_ORDERS', 'Objednávky');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Lokace/Daně');
define('BOX_TAXES_COUNTRIES', 'Země');
define('BOX_TAXES_ZONES', 'Zóny');
define('BOX_TAXES_GEO_ZONES', 'Daňové zóny');
define('BOX_TAXES_TAX_CLASSES', 'Nastavení daně');
define('BOX_TAXES_TAX_RATES', 'Výše daně');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Výsledky');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Shlédnutí produktů');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Prodej produktů');
define('BOX_REPORTS_ORDERS_TOTAL', 'Uživatelský nákup');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Nástroje');
define('BOX_TOOLS_BACKUP', 'Záloha databáze');
define('BOX_TOOLS_BANNER_MANAGER', 'Reklama - nastavení');
define('BOX_TOOLS_CACHE', 'Kontrola Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Nastavení jazyků');
define('BOX_TOOLS_FILE_MANAGER', 'Souborový manažer');
define('BOX_TOOLS_MAIL', 'Poslat e-mail');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Manaer novinek');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Kdo je online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizace');
define('BOX_LOCALIZATION_CURRENCIES', 'Měna');
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyk');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Stav objednávek');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry is must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Objednávka č. %s neexistuje!');

define('CATEGORY_PERSONAL', 'Osobní');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_OPTIONS', 'Options');

define('ENTRY_GENDER', 'Pohlaví:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">poadováno</span>');
define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(např. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">E-MAIL je v neplatném tvaru!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">E-MAIL jiistuje v databázi!</span>');
define('ENTRY_COMPANY', 'Společnost:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Ulice:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_SUBURB', 'Číslo:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znaků</span>');
define('ENTRY_STATE', 'Stát:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">poadováno</span>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslor:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Novinky:');
define('ENTRY_NEWSLETTER_YES', 'Přihlásit k zasílání');
define('ENTRY_NEWSLETTER_NO', 'Odhlásit zasílání');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Odeslat E-Mail');
define('IMAGE_BACK', 'Zpět');
define('IMAGE_BACKUP', 'Záloha');
define('IMAGE_CANCEL', 'Zrušit');
define('IMAGE_CONFIRM', 'Potvrdit');
define('IMAGE_COPY', 'Kopírovat');
define('IMAGE_COPY_TO', 'Kopírovat do');
define('IMAGE_DETAILS', 'Detaily');
define('IMAGE_DELETE', 'Smazat');
define('IMAGE_EDIT', 'Upravit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Manažer souborů');
define('IMAGE_ICON_STATUS_GREEN', 'Aktivní');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Nastavit akt.');
define('IMAGE_ICON_STATUS_RED', 'Neaktivní');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Nastavit neakt.');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Vloit');
define('IMAGE_LOCK', 'Zámek');
define('IMAGE_MODULE_INSTALL', 'Instalovat Modul');
define('IMAGE_MODULE_REMOVE', 'Odebrat Modul');
define('IMAGE_MOVE', 'Přesunout');
define('IMAGE_NEW_BANNER', 'Nový Banner');
define('IMAGE_NEW_CATEGORY', 'Nová Kategorie');
define('IMAGE_NEW_COUNTRY', 'Nové Country');
define('IMAGE_NEW_CURRENCY', 'Nová měna');
define('IMAGE_NEW_FILE', 'Nový soubor');
define('IMAGE_NEW_FOLDER', 'Nový adresář');
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk');
define('IMAGE_NEW_NEWSLETTER', 'Novinka');
define('IMAGE_NEW_PRODUCT', 'Nový produkt');
define('IMAGE_NEW_TAX_CLASS', 'Nastavit daně');
define('IMAGE_NEW_TAX_RATE', 'Jiná daň');
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová zóna');
define('IMAGE_NEW_ZONE', 'Nová zóna');
define('IMAGE_ORDERS', 'Objednávky');
define('IMAGE_ORDERS_INVOICE', 'Faktura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Průvodka');
define('IMAGE_PREVIEW', 'Zobrazit');
define('IMAGE_RESTORE', 'Obnovit');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Uloit');
define('IMAGE_SEARCH', 'Hledat');
define('IMAGE_SELECT', 'Vybrat');
define('IMAGE_SEND', 'Odeslat');
define('IMAGE_SEND_EMAIL', 'Poslat Email');
define('IMAGE_UNLOCK', 'Odemknout');
define('IMAGE_UPDATE', 'Obnovit');
define('IMAGE_UPDATE_CURRENCIES', 'Aktualizovat kurz');
define('IMAGE_UPLOAD', 'Nahrát');

define('ICON_CROSS', 'špatně');
define('ICON_CURRENT_FOLDER', 'Vybrat adresář');
define('ICON_DELETE', 'Smazat');
define('ICON_ERROR', 'Chyba');
define('ICON_FILE', 'Soubor');
define('ICON_FILE_DOWNLOAD', 'Stáhnout');
define('ICON_FOLDER', 'Adresář');
define('ICON_LOCKED', 'Zámek');
define('ICON_PREVIOUS_LEVEL', 'Předchozí úroveň');
define('ICON_PREVIEW', 'Zobrazit');
define('ICON_STATISTICS', 'Statistika');
define('ICON_SUCCESS', 'Úspěšně');
define('ICON_TICK', 'Ano');
define('ICON_UNLOCKED', 'Odemknout');
define('ICON_WARNING', 'Pozor!');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Strana %s z %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> bannerů)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> country)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> uživatelů)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> měn)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> jazyků)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> výrobců)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> novinek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> stavů objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> produktů)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> očekávaných produktů)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> hodnocených produktů)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> produktů ve slevě)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> daňových tříd)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> daňových zón)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> daní)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazeno <b>%d</b> až <b>%d</b> (z <b>%d</b> zón)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Nastavit jako default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* poadováno</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Chyba: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: do cíle nezlze zapisovat.');
define('ERROR_FILE_NOT_SAVED', 'Chyba: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

//JSP:keywords.searchlog add:
    define('BOX_REPORTS_KEYWORDS','Statistika vyhledávání');
    define('IMAGE_SEARCHED_KEYWORDS','zobrazit pouze neúspěšné vyhledávací fráze');  //Keywords are not Products in the Store
    define('IMAGE_SHOW_SEARCH_RESULT','Zobrazit počet výskytů pro keyword'); //Show Search Result For Keyword
    define('TEXT_DISPLAY_NUMBER_OF_KEYWORDS', 'zobrazuji <b>%d</b> až <b>%d</b> (z <b>%d</b> výrazů)');
    define('KEYWORDS_HEADING_TITLE', 'Statistika vyhledávacích frází');
    define('TABLE_HEADING_NUMBER', 'Pořadí');
    define('TABLE_HEADING_KEYWORDS', 'vyhledávací fráze');
    define('TABLE_HEADING_TIMES_USED', 'Počet vyhedávání');
    define('TABLE_HEADING_PRODUCTS_FOUND', 'Nalezeno');
//    define('', '');

//shop2:new
define('BOX_CATALOG_CSV_IMPORT', 'CSV import');
define('BOX_CATALOG_MASS_IMPORT', 'Hromadný import');

//jsp:new:ico
define('JS_ICO', '* POZOR: Chybný formát IČO. Nutno vyplnit min.   '. ENTRY_ICO_MIN_LENGTH . ' znaků. \n');
define('ENTRY_ICO', 'IČO');
define('ENTRY_ICO_ERROR','Chyba: IČO');
define('JS_DIC', '* POZOR: Chybný formát DIČ. Nutno vyplnit min. '. ENTRY_DIC_MIN_LENGTH . ' znaků. \n');
define('ENTRY_DIC', 'DIČ');
define('ENTRY_DIC_ERROR', 'Chyba: DIČ');
/*** Begin Header Tags SEO ***/
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'Header Tags SEO');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'Page Control');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Fill Tags');
/*** End Header Tags SEO ***/
//articles
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_REVIEWS', 'Reviews');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');
?>
