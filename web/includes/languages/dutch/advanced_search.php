<?php
/*
  $Id: advanced_search.php,v 1.13 2002/05/27 13:57:38 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Geavanceerd Zoeken');
define('NAVBAR_TITLE_2', 'Search Results');

define('HEADING_TITLE_1', 'Geavanceerd Zoeken');
define('HEADING_TITLE_2', 'Products meeting the search criteria');

define('HEADING_SEARCH_CRITERIA', 'Zoek Criteria');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Zoek In Product Omschrijvingen');
define('ENTRY_CATEGORIES', 'Categorieën:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Inclusief Subcategorieën');
define('ENTRY_MANUFACTURERS', 'Fabrikanten:');
define('ENTRY_PRICE_FROM', 'Prijs Vanaf:');
define('ENTRY_PRICE_TO', 'Prijs Tot:');
define('ENTRY_DATE_FROM', 'Vanaf Datum:');
define('ENTRY_DATE_TO', 'Tot Datum:');

define('TEXT_SEARCH_HELP_LINK', '<span class="ColorSpan">Hulp met Zoeken</span> [?]');

define('TEXT_ALL_CATEGORIES', 'Alle Categorieën');
define('TEXT_ALL_MANUFACTURERS', 'Alle Fabrikanten');

define('HEADING_SEARCH_HELP', 'Hulp met Zoeken');
define('TEXT_SEARCH_HELP', 'Sleutelwoorden mogen gescheiden worden met AND en/of OR statements om meer controle te krijgen over het zoek resultaat.<br /><br />Bijvoorbeeld, <span class="ColorSpan">Linux AND Redhat</span> zal een resultaat geven waar beide woorden in voorkomen. Maar, voor <span class="ColorSpan">Muis OR Toetsenbord</span>, zal het resultaat terugkomen met beide woorden of een van de twee woorden.<br /><br />Om op een exacte regel of serie woorden te zoeken kunt u de woorden tussen dubbel quotes plaatsen.<br /><br />Bijvoorbeeld, <span class="ColorSpan">"AMD 2400+ Processor"</span> zal het resultaat generen waar deze excate zin is terug te vinden.<br /><br />Haken kunnen ook nog gebruikt worden om verder controle te krijgen over de zoekopdracht.<br /><br />Bijvoorbeeld, <span class="ColorSpan">Linux and (Redhat or Suse or "Mandrake 9.0")</span>.');
define('TEXT_CLOSE_WINDOW', '<span class="ColorSpan">Sluit Venster</span> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product&nbsp;Name ');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_QUANTITY', 'Quantity');
define('TABLE_HEADING_PRICE', 'Price  ');
define('TABLE_HEADING_WEIGHT', 'Weight');
define('TABLE_HEADING_BUY_NOW', 'Buy Now');

define('TEXT_NO_PRODUCTS', 'There is no product that matches the search criteria.');

define('ERROR_AT_LEAST_ONE_INPUT', 'At least one of the fields in the search form must be entered.');
define('ERROR_INVALID_FROM_DATE', 'Invalid From Date.');
define('ERROR_INVALID_TO_DATE', 'Invalid To Date.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'To Date must be greater than or equal to From Date.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Price From must be a number.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Price To must be a number.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Price To must be greater than or equal to Price From.');
define('ERROR_INVALID_KEYWORDS', 'Invalid keywords.');
?>
