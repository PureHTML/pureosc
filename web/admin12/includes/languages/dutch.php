<?php
/*
  $Id: english.php,v 1.106 2003/06/20 00:18:31 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('BOX_REPORTS_MARGIN_REPORT', 'Margin Report');

define('BOX_HEADING_INFORMATION', 'Informatie');
// START - Admin Notes
define('BOX_TOOLS_ADMIN_NOTES', 'Admin Notes');
// END - Admin Notes

define('BOX_OSWAI_UPDATE', 'OSWAI Update version');

// seo assistant start
define('BOX_TOOLS_SEO_ASSISTANT', 'SEO Assistant');
//seo assistant end
 
//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Groups');
define('BOX_MANUDISCOUNT', 'Manu Discount');
//TotalB2B end

// point
define('BOX_CUSTOMERS_POINTS', 'Customers Points');// Points/Rewards Module V2.00
define('BOX_CUSTOMERS_POINTS_PENDING', 'Pending Points');// Points/Rewards Module V2.00
define('BOX_CUSTOMERS_POINTS_REFERRAL', 'Referral Points');// Points/Rewards Module V2.00
//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'Mijn account');
define('HEADER_TITLE_LOGOFF', 'Uitloggen');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mijn account');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Leden groep');
define('BOX_ADMINISTRATOR_MEMBER', 'Leden');
define('BOX_ADMINISTRATOR_BOXES', 'Bestandstoegang');

// images
define('IMAGE_FILE_PERMISSION', 'Bestandsrechten');
define('IMAGE_GROUPS', 'Groeplijst');
define('IMAGE_INSERT_FILE', 'Bestand toevoegen');
define('IMAGE_MEMBERS', 'Ledenlijst');
define('IMAGE_NEW_GROUP', 'Nieuwe groep');
define('IMAGE_NEW_MEMBER', 'Nieuw lid');
define('IMAGE_NEXT', 'Volgende');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Toon <b>%d</b> tot <b>%d</b> (van <b>%d</b> bestanden)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Toon <b>%d</b> tot <b>%d</b> (van <b>%d</b> leden)');
// EOE Access with Level Account (v. 2.2a) for the Admin Area of osCommerce (MS2) 1 of 1

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'de_DE'
// on FreeBSD 4.0 I use 'de_DE.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
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
define('HTML_PARAMS','dir="ltr" lang="nl"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administratie');
define('HEADER_TITLE_SUPPORT_SITE', 'Support Website');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Catalogus');
define('HEADER_TITLE_ADMINISTRATION', 'Administratie');

// text for gender
define('MALE', 'Man');
define('FEMALE', 'Vrouw');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuratie');
define('BOX_CONFIGURATION_MYSTORE', 'Mijn Winkel');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Betaling');
define('BOX_MODULES_SHIPPING', 'Verzenden');
define('BOX_MODULES_ORDER_TOTAL', 'Totaal Bestelling');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalogus');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorieen / Artikelen');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Artikelopties');
define('BOX_CATALOG_MANUFACTURERS', 'Fabrikanten');
define('BOX_CATALOG_REVIEWS', 'Recensies');
define('BOX_CATALOG_SPECIALS', 'Speciale Aanbiedingen');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Verwachte Producten');
define('BOX_CATALOG_UPLOAD_FILE', 'Upload free file');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Klanten');
define('BOX_CUSTOMERS_CUSTOMERS', 'Klanten');
define('BOX_CUSTOMERS_ORDERS', 'Orders');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locatie / BTW');
define('BOX_TAXES_COUNTRIES', 'Landen');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Zones');
define('BOX_TAXES_TAX_CLASSES', 'BTW tariefgroepen');
define('BOX_TAXES_TAX_RATES', 'BTW tarieven');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Rapporten');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Bekeken Artikelen');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Gekochte Artikelen');
define('BOX_REPORTS_ORDERS_TOTAL', 'Totaalbedrag Klantenorders');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Gereedschap');
define('BOX_TOOLS_BACKUP', 'Database Backup Manager');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
define('BOX_TOOLS_CACHE', 'Cache Manager');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Talen Manager');
define('BOX_TOOLS_FILE_MANAGER', 'File Manager');
define('BOX_TOOLS_MAIL', 'Stuur Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Nieuwsbrief Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wie Is Er Online?');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalisatie');
define('BOX_LOCALIZATION_CURRENCIES', 'Valuta');
define('BOX_LOCALIZATION_LANGUAGES', 'Talen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Order Status');

// javascript messages
define('JS_ERROR', 'Er zijn fouten opgetreden tijdens het verwerken van uw formulier!\nBreng de volgende wijzigingen aan:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* U dient het nieuwe artikel een prijs te geven\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* U dient de nieuwe artikelprijs een voorvoegsel te geven\n');

define('JS_PRODUCTS_NAME', '* Voer een artikelnaam in\n');
define('JS_PRODUCTS_DESCRIPTION', '* Voer een artikelomschrijving in\n');
define('JS_PRODUCTS_PRICE', '* Voer een prijs in\n');
define('JS_PRODUCTS_WEIGHT', '* Voer een gewicht in\n');
define('JS_PRODUCTS_QUANTITY', '* Voer een aantal in\n');
define('JS_PRODUCTS_MODEL', '* Voer een model in\n');
define('JS_PRODUCTS_IMAGE', '* Voer een afbeelding in\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Er dient een nieuwe prijs voor dit artikel te worden ingevoerd\n');

define('JS_GENDER', '* Het \'Geslacht\' dient te worden gekozen.\n');
define('JS_FIRST_NAME', '* De  \'Voornaam\' dient minstens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' tekenss te bevatten.\n');
define('JS_LAST_NAME', '* De \'Achternaam\' dient minstens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_DOB', '* De  \'Geboortedatum\' dient in het volgende formaat te zijn: xx/xx/xxxx (dag/maand/jaar).\n');
define('JS_EMAIL_ADDRESS', '* Het \'Emailadres\' dient minstens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_ADDRESS', '* Het \'Adres\' dient minstens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_POST_CODE', '* De \'Postcode\' dient minstens ' . ENTRY_POSTCODE_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_CITY', '* De \'Plaats\' dient minstens ' . ENTRY_CITY_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_STATE', '* De \'Provincie\' dient geselecteerd te zijn\n');
define('JS_STATE_SELECT', '-- Selecteer --');
define('JS_ZONE', '* De \'Provincie\' dient geselecteerd te zijn.');
define('JS_COUNTRY', '* Het \'Land\' dient geselecteerd te zijn.\n');
define('JS_TELEPHONE', '* Het \'Telefoonnummer\' dient minstens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' tekens te bevatten.\n');
define('JS_PASSWORD', '* De velden \'Wachtwoord\' en \'Bevestiging\' moeten exact gelijk zijn en minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' tekens bevatten.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Bestelnummer %s komt niet voor in de database!');

define('CATEGORY_PERSONAL', 'Persoonlijk');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'Contactpersoon');
define('CATEGORY_COMPANY', 'Bedrijfsnaam');
define('CATEGORY_OPTIONS', 'Opties');

define('ENTRY_GENDER', 'Geslacht:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">verplicht</span>');
define('ENTRY_FIRST_NAME', 'Voornaam:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' tekens</span>');
define('ENTRY_LAST_NAME', 'Achternaam:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' tekens</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geboortedatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(bijv. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Emailadres:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' tekens</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Het emailadres lijkt ongeldig te zijn!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Dit emailadres bestaat al!</span>');
define('ENTRY_COMPANY', 'Bedrijfsnaam');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' tekens</span>');
define('ENTRY_SUBURB', 'Wijk:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postcode:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' tekens</span>');
define('ENTRY_CITY', 'Plaats:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' tekens</span>');
define('ENTRY_STATE', 'Provincie:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">verplicht</span>');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefoonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' tekens</span>');
define('ENTRY_FAX_NUMBER', 'Faxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Nieuwsbrief:');
define('ENTRY_NEWSLETTER_YES', '<b>Wel</b> Geabonneerd');
define('ENTRY_NEWSLETTER_NO', '<b>Niet</b> Geabonneerd');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Email wordt verzonden');
define('IMAGE_BACK', 'Terug');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Annuleer');
define('IMAGE_CONFIRM', 'Bevestig');
define('IMAGE_COPY', 'Kopieer');
define('IMAGE_COPY_TO', 'Kopieer naar');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Verwijder');
define('IMAGE_EDIT', 'Wijzigen');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Actief');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activeren');
define('IMAGE_ICON_STATUS_RED', 'Niet Actief');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deactiveren');
define('IMAGE_ICON_INFO', 'Informatie');
define('IMAGE_INSERT', 'Invoegen');
define('IMAGE_LOCK', 'Vastzetten');
define('IMAGE_MODULE_INSTALL', 'Module Installeren');
define('IMAGE_MODULE_REMOVE', 'Module Verwijderen');
define('IMAGE_MOVE', 'Verplaatsen');
define('IMAGE_NEW_BANNER', 'Nieuwe Banner');
define('IMAGE_NEW_CATEGORY', 'Nieuwe categorie');
define('IMAGE_NEW_COUNTRY', 'Nieuw land');
define('IMAGE_NEW_CURRENCY', 'Nieuwe Valuta');
define('IMAGE_NEW_FILE', 'Nieuw Bestand');
define('IMAGE_NEW_FOLDER', 'Nieuwe Directorie');
define('IMAGE_NEW_LANGUAGE', 'Nieuwe taal');
define('IMAGE_NEW_NEWSLETTER', 'Nieuwe Nieuwsbrief');
define('IMAGE_NEW_PRODUCT', 'Nieuw Artikel');
define('IMAGE_NEW_TAX_CLASS', 'Nieuwe BTW Tariefgroep');
define('IMAGE_NEW_TAX_RATE', 'Nieuw BTW Tarief');
define('IMAGE_NEW_TAX_ZONE', 'Nieuwe BTW Tariefzone');
define('IMAGE_NEW_ZONE', 'Nieuwe Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Factuur');
define('IMAGE_ORDERS_PACKINGSLIP', 'Pakbon');
define('IMAGE_PREVIEW', 'Voorbeeld');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Opslaan');
define('IMAGE_SEARCH', 'Zoeken');
define('IMAGE_SELECT', 'Selecteer');
define('IMAGE_SEND', 'Verstuur');
define('IMAGE_SEND_EMAIL', 'Stuur Email');
define('IMAGE_UNLOCK', 'Vrijgeven');
define('IMAGE_UPDATE', 'Bijwerken');
define('IMAGE_UPDATE_CURRENCIES', 'Wisselkoersen Bijwerken');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'Niet Waar');
define('ICON_CURRENT_FOLDER', 'Huidige Directorie');
define('ICON_DELETE', 'Verwijder');
define('ICON_ERROR', 'Fout');
define('ICON_FILE', 'Bestand');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Directorie');
define('ICON_LOCKED', 'Vastgezet');
define('ICON_PREVIOUS_LEVEL', 'Vorige Directorie');
define('ICON_PREVIEW', 'Voorbeeld');
define('ICON_STATISTICS', 'Statistieken');
define('ICON_SUCCESS', 'Succes');
define('ICON_TICK', 'Waar');
define('ICON_UNLOCKED', 'Vrijgegeven');
define('ICON_WARNING', 'Waarschuwing');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina %s van %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> landen)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> klanten)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> valuta)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> talen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> fabrikanten)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> nieuwsbrieven)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> bestellingen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> order statussen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> artikelen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> verwachte producten)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Vertoont <b>%d</b> tot <b>%d</b> (vanf <b>%d</b> artikelrecensies)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> speciale aanbiedingen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> BTW tariefgroepen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> BTW tariefzones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> BTW tarieven)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'standaard');
define('TEXT_SET_DEFAULT', 'Als standaard defini&euml;ren');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Verplicht</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fout: Er is geen standaard valuta aanwezig. Definieer deze s.v.p.: Administratie gereedschap -&gt; Lokalisatie -&gt; Valuta');

define('TEXT_CACHE_CATEGORIES', 'Categori&euml;n Box');
define('TEXT_CACHE_MANUFACTURERS', 'Fabrikanten Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Eveneens Gekocht Module');

define('TEXT_NONE', '--geen--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

// Easy polulate
define('BOX_CATALOG_IMP_EXP', 'Utility Import Export');
// END
define('BOX_CUSTOMERS_BIRTHDAY', 'birthday');

// stat v3
  define('BOX_HEADING_STORE_STATISTICS','Store statistics');
  define('BOX_TOOLS_STORE_STATISTICS','Store statistics');
  define('BOX_TOOLS_ORDERS_STATISTICS','Orders statistics');
  define('BOX_TOOLS_PRODUCTS_STATISTICS','Products statistics');
// end

define('IMAGE_EXCLUDE', 'Exclude');
define('BOX_TOOLS_SITEMAP', 'Sitemap');

// Google SiteMap BEGIN
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
// Google SiteMap END

define('BOX_TOOLS_PAGE_MANAGER', 'Extra info Pages Manager');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Pages)');

require(DIR_WS_LANGUAGES . 'add_ccgvdc_dutch.php');  // ICW CREDIT CLASS Gift Voucher Addittion

define('BOX_REPORTS_MISSING_PICS', 'Missing Pictures');

// easy price
define('BOX_CATALOG_PRODUCTS_UPDATE', 'Update Prices/Stock');

//PIVACF start
define('ENTRY_PIVA', 'VAT Number:');
define('ENTRY_CF', 'Tax Identification Number:');
define('JS_PIVA', 'VAT Number Required');
define('JS_CF', 'Tax Identification Number Required');
//PIVACF end

        /* Optional Related Products (ORP) */
        define('BOX_CATALOG_CATEGORIES_RELATED_PRODUCTS', 'Related Products');
        define('IMAGE_BUTTON_NEW_INSTALL_SQL', 'Install SQL for New Install of Related Products, Version 4.0');
        define('IMAGE_BUTTON_UPGRADE_SQL', 'Update SQL for Upgrade Install of Related Products, Version 4.0');
        define('IMAGE_BUTTON_REMOVE_SQL', 'Remove SQL for all versions of Related Products');
        /***********************************/

define('WARNING_ADMIN_NOTES_TIME', '<b>Warning:</b> A notice exceeded its reminder datetime!');

?>