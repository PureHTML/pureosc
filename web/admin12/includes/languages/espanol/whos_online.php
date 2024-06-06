<?php
/*
  $Id: whos_online.php,v 1.6 2003/07/06 20:33:02 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Note:</b> N/A = IP non available'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Last refresh at'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Empty'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'My IP adresss '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Country'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Usuarios Conectados');
define('TABLE_HEADING_ONLINE', 'Conectado');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nombre');
define('TABLE_HEADING_IP_ADDRESS', 'Direccion IP');
define('TABLE_HEADING_ENTRY_TIME', 'Hora Entrada');
define('TABLE_HEADING_LAST_CLICK', 'Ultimo Click');
define('TABLE_HEADING_LAST_PAGE_URL', 'Ultimo URL');
define('TABLE_HEADING_ACTION', 'Acci&oacute;n');
define('TABLE_HEADING_SHOPPING_CART', 'Cesta del Usuario');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotal');
define('TEXT_NUMBER_OF_CUSTOMERS', '%s &nbsp;Clientes en l&igrave;nea');
define('TABLE_HEADING_HTTP_REFERER', 'Referer?');
define('TEXT_HTTP_REFERER_URL', 'HTTP Referer URL');
define('TEXT_HTTP_REFERER_FOUND', 'Si');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'N/D');
define('TEXT_STATUS_ACTIVE_CART', 'Activo con Carro');
define('TEXT_STATUS_ACTIVE_NOCART', 'Activo sin Carro');
define('TEXT_STATUS_INACTIVE_CART', 'Inactivo con Carro');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inactivo sin Carro');
define('TEXT_STATUS_NO_SESSION_BOT', 'Robot sin Sesion?');
define('TEXT_STATUS_INACTIVE_BOT', 'Robot con Sesion Inactiva?');
define('TEXT_STATUS_ACTIVE_BOT', 'Robot con Sesion Activa?');
define('TABLE_HEADING_COUNTRY', 'Pais');
define('TABLE_HEADING_USER_SESSION', 'Sesion?');
define('TEXT_IN_SESSION', 'Si');
define('TEXT_NO_SESSION', 'No');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Desplegar Perfil');
define('TEXT_USER_AGENT', 'Agente del Usuario');
define('TEXT_ERROR', 'Error!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'IPs Duplicados');
define('TEXT_BOTS', 'Bots');
define('TEXT_ME', 'Yo!');
define('TEXT_ALL', 'Todo');
define('TEXT_REAL_CUSTOMERS', 'Clientes Reales');
define('TEXT_ACTIVE_CUSTOMERS', ' are active.');

define('TEXT_YOUR_IP_ADDRESS', 'Tu Protocolo IP');
define('TEXT_SET_REFRESH_RATE', 'Tiempo para refrescar la pagina');
define('TEXT_NONE_', 'Ningun');
define('TEXT_CUSTOMERS', 'Clientes');
define('TEXT_SHOW_BOTS', 'Show Bots');
?>