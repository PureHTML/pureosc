<?php
/*
  $Id: categories.php,v 1.26 2003/07/11 14:40:28 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 define('TEXT_PRODUCTS_COST_INFO', 'Cost: ');
 define('TEXT_PRODUCTS_PROFIT_INFO', 'Profit:');
 define('TEXT_PRODUCTS_PRICE_COST', 'Products Price (Cost):');
//
define('ENTRY_PRODUCTS_PRICE', 'Product Price #');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'disabled');
//

// multi images
define('TEXT_PRODUCTS_IMAGE_EXTRA', 'Products Extra Image #');
define('TEXT_DELETE_IMAGE', 'Delete image');

define('HEADING_TITLE', 'Categorie&euml;n / Artikelen');
define('HEADING_TITLE_SEARCH', 'Zoeken:');
define('HEADING_TITLE_GOTO', 'Ga naar:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorie&euml;n / Artikelen');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Nieuw Artikel ');
define('TEXT_CATEGORIES', 'Categorie&euml;n:');
define('TEXT_SUBCATEGORIES', 'Subcategorie&euml;n:');
define('TEXT_PRODUCTS', 'Producten:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Prijs:');
define('TEXT_PRODUCTS_TAX_CLASS', 'BTW Tariefgroep:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Gemiddelde Waarde:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Hoeveelheid:');
define('TEXT_DATE_ADDED', 'Datum Toegevoegd:');
define('TEXT_DATE_AVAILABLE', 'Wordt Verwacht:');
define('TEXT_LAST_MODIFIED', 'Laatst Gewijzigd:');
define('TEXT_IMAGE_NONEXISTENT', 'PLAATJE BESTAAT NIET');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Gelieve een nieuw Artikel of nieuwe Categorie toe te voegen in<br />&nbsp;<br /><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Voor meer informatie, ga naar dit artikel <a href="http://%s" target="blank"><u>webpagina</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dit artikel is toegevoegd aan onze catalogus %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dit artikel zal op %s in voorraad zijn.');

define('TEXT_EDIT_INTRO', 'Gelieve de nodige aanpassingen te doen');
define('TEXT_EDIT_CATEGORIES_ID', 'Categorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Categorie Naam:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Categorie Plaatje:');
define('TEXT_EDIT_SORT_ORDER', 'Sorteervolgorde:');

define('TEXT_INFO_COPY_TO_INTRO', 'Kies een categorie waar je het product naartoe wil kopie&euml;ren');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Huidige categorie&euml;n:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nieuwe Categorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Wijzig Categorie');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Verwijder Categorie');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Verplaats Categorie');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Verwijder Artikel');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Verplaats Artikel');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopie&euml;r naar');

define('TEXT_DELETE_CATEGORY_INTRO', 'Weet je zeker dat je deze categorie wil verwijderen?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Weet je zeker dat je dit product wil verwijderen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WAARSCHUWING:</b> Er zijn %s (afgeleide ?) categorie&euml;n gelinked aan deze categorie!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WAARSCHUWING:</b> Er zijn %s producten gelinked aan deze categorie!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Gelieve de categorie te selecteren waar je <b>%s</b> naar wil verplaatsen');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Gelieve de categorie te selecteren waar je <b>%s</b> naar wil verplaatsen');
define('TEXT_MOVE', 'Verplaats <b>%s</b> Naar:');

define('TEXT_NEW_CATEGORY_INTRO', 'Gelieve de volgende informatie in te vullen voor de nieuwe categorie');
define('TEXT_CATEGORIES_NAME', 'Categorie Naam:');
define('TEXT_CATEGORIES_IMAGE', 'Categorie Plaatje');
define('TEXT_SORT_ORDER', 'Sorteervolgorde:');

define('TEXT_PRODUCTS_STATUS', 'Product Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Verwacht op:');
define('TEXT_PRODUCT_AVAILABLE', 'Op Voorraad');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Niet op Voorraad');
define('TEXT_PRODUCTS_MANUFACTURER', 'Artikel Fabrikant:');
define('TEXT_PRODUCTS_NAME', 'Artikel Naam:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikel Beschrijving:');
define('TEXT_PRODUCTS_QUANTITY', 'Artikel Hoeveelheid:');
define('TEXT_PRODUCTS_MODEL', 'Artikel Model:');
define('TEXT_PRODUCTS_IMAGE', 'Artikel Plaatje:');
define('TEXT_PRODUCTS_URL', 'Artikel URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(zonder http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Artikel Prijs (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Artikel Prijs (Bruto):');
define('TEXT_PRODUCTS_WEIGHT', 'Artikel Gewicht:');

define('EMPTY_CATEGORY', 'Lege Categorie');

define('TEXT_HOW_TO_COPY', 'Kopie&euml;r Methode:');
define('TEXT_COPY_AS_LINK', 'Link Artikel');
define('TEXT_COPY_AS_DUPLICATE', 'Kloon Artikel');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fout: Kan producten in dezelfde categorie niet linken.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fout: Catalogus images directory niet schrijfbaar: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fout: Catalogus images directory bestaat niet: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fout: Categorie kan niet worden verplaatst naar een afgeleide categorie.');
define('TEXT_EDIT_STATUS', 'Status Category');
define('TEXT_CAT_DESCRIPT', 'Description category');

  define('TEXT_PRODUCTS_HEIGHT', 'Height:');
  define('TEXT_PRODUCTS_LENGTH', 'Length:');
  define('TEXT_PRODUCTS_WIDTH', 'Width:');
  define('TEXT_PRODUCTS_READY_TO_SHIP', 'Ready to ship:');
  define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'Product can be shipped in its own container.');
  define('TEXT_PRODUCTS_CODEBAR', 'CODE-BAR:');

	define('TEXT_PRODUCTS_RSS', 'Add this product to the RSS feed:');
?>