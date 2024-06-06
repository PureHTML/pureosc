<?php
/*
  $Id: advanced_search.php,v 1.15 2003/07/08 16:45:35 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

define('NAVBAR_TITLE_1', 'Recherche avanc&eacute;e');
define('NAVBAR_TITLE_2', 'R&eacute;sultats de recherche');

define('HEADING_TITLE_1', 'Recherche avanc&eacute;e');
define('HEADING_TITLE_2', 'Produits r&eacute;pondant aux crit&egrave;res de recherche');

define('HEADING_SEARCH_CRITERIA', 'Crit&egrave;res de recherche');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Chercher dans les descriptions de produits');
define('ENTRY_CATEGORIES', 'Cat&eacute;gories:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Inclure les sous-cat&eacute;gories');
define('ENTRY_MANUFACTURERS', 'Fabricants :');
define('ENTRY_PRICE_FROM', 'Prix &agrave; partir de :');
define('ENTRY_PRICE_TO', 'Prix jusqu\'&agrave; :');
define('ENTRY_DATE_FROM', 'Depuis la date :');
define('ENTRY_DATE_TO', 'Jusqu\'&agrave; la date :');

define('TEXT_SEARCH_HELP_LINK', '<span class="ColorSpan">Aide &agrave; la recherche</span> [?]');

define('TEXT_ALL_CATEGORIES', 'Toutes cat&eacute;gories');
define('TEXT_ALL_MANUFACTURERS', 'Tous fabricants');

define('HEADING_SEARCH_HELP', 'Aide &agrave; la recherche');
define('TEXT_SEARCH_HELP', 'Vous pouvez s&eacute;parer les mots cl&eacute;s par les op&eacute;rateurs logiques AND et OR. Par exemple, vous pouvez entrer <span class="ColorSpan">Microsoft AND souris</span>. Cette recherche vous affichera les r&eacute;sultats qui r&eacute;pondent simultan&eacute;ment aux deux crit&egrave;res. Toutefois, si vous tapez <span class="ColorSpan">souris OR clavier</span>, seront list&eacute;s les articles qui ont au moins l\'un des deux mots dans les champs s&eacute;lectionn&eacute;s. Si aucun op&eacute;rateur n\'est pr&eacute;cis&eacute;, la recherche s\'effectuera avec l\'op&eacute;rateur AND.<br /><br />Vous pouvez &eacute;galement faire une recherche sur une chaine en l\'encadrant de guillements. Par exemple, une recherche sur  <span class="ColorSpan">"ordinateur portable"</span> vous affichera la liste de tous les articles ayant exactement cette chaine dans leur description.<br /><br />Les parenth&egrave;ses peuvent &ecirc;tre utilis&eacute;es pour contr&ocirc;ler l\'ordre de traitement des op&eacute;rateurs logiques. Par exemple entrez <span class="ColorSpan">Microsoft and (clavier or souris or "visual basic")</span>.');
define('TEXT_CLOSE_WINDOW', '<span class="ColorSpan">Fermer la fen&ecirc;tre</span> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_PRODUCTS', 'Nom du produit');
define('TABLE_HEADING_MANUFACTURER', 'Fabricant');
define('TABLE_HEADING_QUANTITY', 'Quantit&eacute;');
define('TABLE_HEADING_PRICE', 'Prix');
define('TABLE_HEADING_WEIGHT', 'Poids');
define('TABLE_HEADING_BUY_NOW', 'Acheter maintenant');

define('TEXT_NO_PRODUCTS', 'Il n\'y a aucun produit correspondant &agrave; vos crit&egrave;res de recherche.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Au moins un crit&egrave;re de recherche doit &ecirc;tre rempli.');
define('ERROR_INVALID_FROM_DATE', 'Date du champ "Depuis la date" invalide.');
define('ERROR_INVALID_TO_DATE', 'Date du champ "Jusqu\'&agrave; la date"  invalide.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'La date du champ "Jusqu\'&agrave; la date" doit &ecirc;tre sup&eacute;rieure ou &eacute;gale &agrave; la date du champ "Depuis la date"');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Le prix du champ "Prix &agrave; partir de" ne doit contenir que des chiffres.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Le prix du champ "Prix jusqu\'&agrave;" ne doit contenir que des chiffres.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Le prix du champ "Prix jusqu\'&agrave;" doit &ecirc;tre sup&eacute;rieure ou &eacute;gale au prix du champ "Prix &agrave; partir de".');
define('ERROR_INVALID_KEYWORDS', 'Mots-cl&eacute;s invalides.');
?>