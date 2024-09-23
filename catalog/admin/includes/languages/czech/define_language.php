<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Definice jazyka');
define('TABLE_HEADING_FILES', 'Souboru');
define('TABLE_HEADING_WRITABLE', 'Pro zápis');
define('TABLE_HEADING_LAST_MODIFIED', 'Poslední změna');

define('TEXT_EDIT_NOTE', '<strong>Editace Definice</strong><br /><br />Každá definice je nastaven jazyk pomocí PHP<a href="http://www.php.net/define"target="_blank">define()</a> Funkce v následujícím způsobem:<br /><br /><nobr>define(\'TEXT_MAIN\', \'<span style="background-color: #FFFF99;">Tento text lze editovat. Je to opravdu snadné!</span>\');</nobr><br /><br />Zvýrazněný text lze editovat. Protože tato definice je pomocí apostrofů obsahovat text, nějaké jednoduché uvozovky v rámci definice textu musí být unikl zpětné lomítko (například, McDonald\\\'s).');

define('TEXT_FILE_DOES_NOT_EXIST', 'Neexistuje');

define('ERROR_FILE_NOT_WRITEABLE', 'Chyba: Nemohu zapisovat do tohoto souboru. Prosím nastavte správné uživatelské oprávnění na: %s');
?>