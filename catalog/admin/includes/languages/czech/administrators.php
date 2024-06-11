<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrátoři');

define('TABLE_HEADING_ADMINISTRATORS', 'Správci');
define('TABLE_HEADING_HTPASSWD', 'Chráněno htpasswd');
define('TABLE_HEADING_ACTION', 'Akční');

define('TEXT_INFO_INSERT_INTRO', 'Prosím, zadejte nový správce s jeho související údaje');
define('TEXT_INFO_EDIT_INTRO', 'Prosím proveďte potřebné změny');
define('TEXT_INFO_DELETE_INTRO', 'Jste si jisti, že chcete smazat tento správce?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Nový správce');
define('TEXT_INFO_USERNAME', 'Uživatelské jméno:');
define('TEXT_INFO_NEW_PASSWORD', 'Nové heslo:');
define('TEXT_INFO_PASSWORD', 'Heslo:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Chraňte S htaccess / htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Chyba: Administrator již existuje.');

define('HTPASSWD_INFO', '<strong>Dodatečná ochrana s htaccess / htpasswd</strong><p>Tato instalace osCommerce Online Merchant Administration Tool není dále zajištěna pomocí htaccess / htpasswd znamená.</p><p>Povolení bezpečnostní vrstvu htaccess / htpasswd se automaticky uloží uživatelské jméno a heslo správce v souboru htpasswd při aktualizaci hesla správce záznamů .</p><p><strong>Vezměte prosím na vědomí</strong>, , Pokud je tato dodatečná vrstva zabezpečení a můžete již přístup na nástroje pro správu , proveďte následující změny a obraťte se na svého poskytovatele hostingu k tomu, aby ochranu htaccess / htpasswd :</p><p><u><strong>1 . Editovat tento soubor:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Odstraňte následující řádky , pokud existují :</p><p><i>%s</i></p><p><u><strong>2 . Smazat tento soubor:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>Dodatečná ochrana s htaccess / htpasswd</strong><p>Tato instalace osCommerce Online Merchant Administration Tool je dodatečně zajištěna pomocí htaccess / htpasswd prostředky .</p>');
define('HTPASSWD_PERMISSIONS', '<strong>Dodatečná ochrana s htaccess / htpasswd
</strong><p>Tato instalace osCommerce Online Merchant Administration Tool není dále zajištěna pomocí htaccess / htpasswd prostředky.</p><p>Následující soubory musí být zapisovatelný webovým serverem k tomu, aby htaccess / bezpečnostní htpasswd vrstvy:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>Aktualizuj tuto stránku pro potvrzení, zda byly nastaveny správná oprávnění souborů.</p>');
?>
