<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Adresář relace neexistuje: ' . tep_session_save_path() . '. Sessions nebude fungovat, dokud nebude tento adresář vytvořen.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Nejsem schopen zapisovat do adresáře relace: ' . tep_session_save_path() . '. Sessions nebude fungovat, dokud nebude nastaveno správné uživatelské oprávnění.');
?>
