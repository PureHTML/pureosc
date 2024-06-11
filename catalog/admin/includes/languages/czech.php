<?php
/*
Czech Text for oscommerce-2.2ms2
Update: 01/01/2004
Author(s): Jaroslav Němec, Jan Hrabec and Martine Dragon 
(jarnemec@jarnemec.com)    -> http;//design.jarnemec.com

Update Mon 01 Nov 2021 02:37:49 AM CET for 2.3.4 version
Šimon Formánek 
mailto: f@simonformanek.cz 
https://purehtml.cz

Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// this may not work under win32 environments..
@setlocale (LC_ALL, 'cs_CZ.UTF-8');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%d. %m. %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd. m. Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// the CURRENCY_* constants will be used to format the currency to the selected locale..
// this is used with the tep_currency_format() function..
define('CURRENCY_VALUE', 'CZK'); // currency value for exchange rate

////
// Return date in raw format
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="cs"');

// charset for web pages and emails
//define('CHARSET', 'windows-1250');
define('CHARSET', 'utf-8');

// page title
define('TITLE', STORE_NAME . ' Administrace');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrátor');
define('HEADER_TITLE_SUPPORT_SITE', '');
define('HEADER_TITLE_ONLINE_CATALOG', STORE_NAME);
define('HEADER_TITLE_ADMINISTRATION', 'Administrace');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurace');
define('BOX_CONFIGURATION_MYSTORE', 'Můj obchod');
define('BOX_CONFIGURATION_LOGGING', 'Logování');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrátoři');
define('BOX_CONFIGURATION_STORE_LOGO', 'Obchod Logo');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Zboží');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Vlastnosti zboží');
define('BOX_CATALOG_MANUFACTURERS', 'Výrobci-značky');
define('BOX_CATALOG_REVIEWS', 'Hodnocení');
define('BOX_CATALOG_SPECIALS', 'Slevy');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Očekávané zboží');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Zákazníci');
define('BOX_CUSTOMERS_CUSTOMERS', 'Zákazníci');
//define('BOX_CUSTOMERS_ORDERS', 'Objednávky');
 define('BOX_HEADING_ORDERS', 'Objednávky'); 
 define('BOX_ORDERS_ORDERS', 'Objednávky'); 

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Daně a oblasti');
define('BOX_TAXES_COUNTRIES', 'Země');
define('BOX_TAXES_ZONES', 'Kraje');
define('BOX_TAXES_GEO_ZONES', 'Daňové oblasti');
define('BOX_TAXES_TAX_CLASSES', 'Skupiny daní');
define('BOX_TAXES_TAX_RATES', 'Hodnoty daní');


// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Zprávy');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Nejprohlíženější zboží');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Nejprodávanější zboží');
define('BOX_REPORTS_ORDERS_TOTAL', 'Nejlepší objednávky');


// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Pomůcky');
define('BOX_TOOLS_ACTION_RECORDER', 'Záznamník akcí');
define('BOX_TOOLS_BACKUP', 'Zálohování');
define('BOX_TOOLS_BANNER_MANAGER', 'Správa banerů');
define('BOX_TOOLS_CACHE', 'Správa Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definice jazyka');
define('BOX_TOOLS_MAIL', 'Zaslat E-Mail');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Správa @-novinek');
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Bezpečnost Oprávnění pro adresář');
define('BOX_TOOLS_SERVER_INFO', 'Informace o serveru');
define('BOX_TOOLS_VERSION_CHECK', 'Version Checker');
define('BOX_TOOLS_WHOS_ONLINE', 'Kdo je Online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizace');
define('BOX_LOCALIZATION_CURRENCIES', 'Měny');
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyky');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Ostatní');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* Nové zboí nemá název.\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* Nové zboí nemá uvedenou cenu.\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* Nové zboí nemá uvedené mnoství.\n');
define('JS_PRODUCTS_MODEL', '* Nové zboí nemá zadaný typ-model.\n');
define('JS_PRODUCTS_IMAGE', '* Nový produkt potřebuje hodnotu obrazu\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Nová cena tohoto produktu je nutné nastavit\n');

define('JS_GENDER', '* \'Gender\' vyberte z variant.\n');
define('JS_FIRST_NAME', '* \'First Name\' musí mít minimálně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' písmen.\n');
define('JS_LAST_NAME', '* \'Last Name\' musí mít minimálně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' písmen.\n');
define('JS_DOB', '* \'Date of Birth\' musí mít formát: xx/xx/xxxx (den/měsíc/rok).\n');
define('JS_EMAIL_ADDRESS', '* \'E-Mail Address\' musí mít minimálně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_ADDRESS', '* \'Street Address\' musí mít minimálně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_POST_CODE', '* \'Post Code\' musí mít minimálně ' . ENTRY_POSTCODE_MIN_LENGTH . ' číslic.\n');
define('JS_CITY', '* \'City\' musí mít minimálně ' . ENTRY_CITY_MIN_LENGTH . ' znaků.\n');
define('JS_STATE', '* \'State\' musíte vybrat.\n');
define('JS_STATE_SELECT', '-- Vybrat--');
define('JS_ZONE', '* \'State\' entry must be selected from the list for this country.');
define('JS_COUNTRY', '* \'Country\' musíte vybrat.\n');
define('JS_TELEPHONE', '* \'Telephone Number\' musí mít minimálně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' číslic.\n');
define('JS_PASSWORD', '* \'Password\' a \'Confirmation\' musí mít minimálně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

define('CATEGORY_PERSONAL', '<b>[ Osobní ]</b>');
define('CATEGORY_ADDRESS', '<b>[ Adresa ]</b>');
define('CATEGORY_CONTACT', '<b>[ Kontakt ]</b>');
define('CATEGORY_COMPANY', '<b>[ Firma ]</b>');
define('CATEGORY_OPTIONS', '<b>[ Nastavení ]</b>');

define('ENTRY_GENDER', 'Pohlaví:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">nutné</font></small>');
define('ENTRY_FIRST_NAME', 'Křestní jméno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(např. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail adresa:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Tato e-mailová adresa se nezdá skutečná!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Tento e-mail již existuje!</span>');
define('ENTRY_COMPANY', 'Název firmy:');
define('ENTRY_STREET_ADDRESS', 'Ulice, číslo:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znaků</span>');
define('ENTRY_STATE', 'Kraj:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">nutné</span>');
define('ENTRY_COUNTRY', 'Země:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon / mobil:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_NEWSLETTER', '@-novinka:');
define('ENTRY_NEWSLETTER_YES', 'Souhlasím');
define('ENTRY_NEWSLETTER_NO', 'Nesouhlasím');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Zasílání E-mailu');
define('IMAGE_BACK', 'Zpět');
define('IMAGE_BACKUP', 'Vpřed');
define('IMAGE_CANCEL', 'Zruit');
define('IMAGE_CONFIRM', 'Potvrď');
define('IMAGE_COPY', 'Kopírovat');
define('IMAGE_COPY_TO', 'Kopírovat do');
define('IMAGE_DETAILS', 'Podrobnosti');
define('IMAGE_DELETE', 'Vyma');
define('IMAGE_EDIT', 'Upravit');
define('IMAGE_EMAIL', 'E-mail');
define('IMAGE_EXPORT', 'Export');
define('IMAGE_ICON_STATUS_GREEN', 'Aktivní');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktivovat');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Informace');
define('IMAGE_INSERT', 'Vloit');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Instalace modulu');
define('IMAGE_MODULE_REMOVE', 'Odinstalování modulu');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'Nový baner');
define('IMAGE_NEW_CATEGORY', 'Nová kategorie');
define('IMAGE_NEW_COUNTRY', 'Nová země');
define('IMAGE_NEW_CURRENCY', 'Nová měna');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk');
define('IMAGE_NEW_NEWSLETTER', 'Nový dopis');
define('IMAGE_NEW_PRODUCT', 'Nové zboí');
define('IMAGE_NEW_TAX_CLASS', 'Nová skupina DPH');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová oblast');
define('IMAGE_NEW_ZONE', 'Nová oblast');
define('IMAGE_ORDERS', 'Objednávky');
define('IMAGE_ORDERS_INVOICE', 'Objednací list');
define('IMAGE_ORDERS_PACKINGSLIP', 'Přehled objednaného zboí');
define('IMAGE_PREVIEW', 'Zobrazit');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Nahrát');
define('IMAGE_SEARCH', 'Hledej');
define('IMAGE_SELECT', 'Vybrat');
define('IMAGE_SEND', 'Zaslat');
define('IMAGE_SEND_EMAIL', 'Zaslat E-Mail');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Změnit');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'Vypnuto');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Smazat');
define('ICON_ERROR', 'Chyba');
define('ICON_FILE', 'Soubor');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Sloka');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Zobrazit');
define('ICON_STATISTICS', 'Statistika');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'Zapnuto');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Upozornění');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Stránka %s z %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> banerů)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zemí)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zákazníku)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> měn)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> jazyků)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> výrobců)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> @-novinek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> stavů objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží v akci)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových skupin)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových oblastí)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daní)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zón)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'výchozí');
define('TEXT_SET_DEFAULT', 'Vyber jako výchozí');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Nutné</span>');

define('TEXT_CACHE_CATEGORIES', 'Kategorie');
define('TEXT_CACHE_MANUFACTURERS', 'Výrobci');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--nic--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Chyba: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Varování: No file uploaded.');
?>
