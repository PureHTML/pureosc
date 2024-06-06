<?php
/*
  $Id: create_account_success.php,v 1.8 2003/07/08 16:45:36 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B
define('TEXT_ACCOUNT_CREATED_ENABLE', '<br /><br /><b><u>Your account is active.</u></b>');
define('TEXT_ACCOUNT_CREATED_DISABLE', '<br /><br /><b><u>Your account must be activated by us, before you can use it.</u></b>');
//TotalB2B

// Points/Rewards system V2.00 BOF
define('TEXT_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your  <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">Shopping Points Accout</a>  with a total of %s Shopping Points worth %s');
define('TEXT_WELCOME_POINTS_LINK', 'Please refer to the  <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">Reward Point Program FAQ</a> as conditions may apply.');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE_1', 'Crear una Cuenta');
define('NAVBAR_TITLE_2', 'Exito');
define('HEADING_TITLE', 'Su cuenta ha sido creada!');
define('TEXT_ACCOUNT_CREATED', 'Enhorabuena! Su cuenta ha sido creada con &eacute;xito! Ahora puede disfrutar de las ventajas de disponer de una cuenta para mejorar su navegaci&oacute;n en nuestro catalogo. Si tiene <span class="b">CUALQUIER</span> pregunta sobre el funcionamiento del catalogo, por favor comuniquela al <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">encargado</a>.<br /><br />Se ha enviado una confirmaci&oacute;n a la direcci&oacute;n de correo que nos ha proporcionado. Si no lo ha recibido en 1 hora pongase en contacto con <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">nosotros</a>.');
?>