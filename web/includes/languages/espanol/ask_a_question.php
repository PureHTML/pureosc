<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  
  Edit only lines 26 & 27.
*/

define('NAVBAR_TITLE', 'Pregunta de Producto');

define('HEADING_TITLE', 'Tengo una pregunta sobre:<br />%s');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Tu mensaje');
define('FORM_TITLE_FRIEND_MESSAGE', 'Tu pregunta');

define('FORM_FIELD_CUSTOMER_NAME', 'Tu nombre:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Tu direccion e-Mail:');


define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Tu pregunta sobre <span class="b">%s</span> ha enviado con &egrave;xito...');

define('TEXT_EMAIL_SUBJECT', 'Tengo una pregunta de %s');
define('TEXT_EMAIL_INTRO', '%s' . "\n\n" . 'Un cliente, %s, tiene una pregunta sobre: %s - %s.');
define('TEXT_EMAIL_LINK', 'Aqui la direccion del producto:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Un saludo,' . "\n\n" . '%s');

define('ERROR_FROM_NAME', 'Error: Tu nombre no deberia de ser vacio.');
define('ERROR_FROM_ADDRESS', 'Error: Tu direccion e-Mail debe ser valido.');
?>