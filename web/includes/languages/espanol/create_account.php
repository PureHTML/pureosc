<?php
/*
  $Id: create_account.php,v 1.12 2003/07/08 16:56:04 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B start
define('EMAIL_VALIDATE_SUBJECT', 'New customer at '. STORE_NAME);
define('EMAIL_VALIDATE', 'A new customer registered at '. STORE_NAME);
define('EMAIL_VALIDATE_PROFILE', 'To see customer profile click here:');
define('EMAIL_VALIDATE_ACTIVATE', 'To activate customer click here:');
//TotalB2B end

// Points/Rewards system V2.00 BOF
define('EMAIL_WELCOME_POINTS', '<li><span class="b">Reward Point Program</span> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE', 'Crear una Cuenta');
define('NAVBAR_TITLE_1', 'Crear una Cuenta');
define('NAVBAR_TITLE_2', 'Proceso');
define('HEADING_TITLE', 'Datos de Mi Cuenta');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">NOTA:</span></span> Si ya ha pasado por este proceso y tiene una cuenta, por favor <a href="%s"><span class="ColorSpan">entre</span></a> en ella.');

define('EMAIL_SUBJECT', 'Bienvenido a ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Estimado ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Estimado ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Le damos la bienvenida a <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'Ahora puede disfrutar de los <span class="b">servicios</span> que le ofrecemos. Algunos de estos servicios son:' . "\n\n" . '<li><span class="b">Carrito Permanente</span> - Cualquier producto añadido a su carrito permanecera en el hasta que lo elimine, o hasta que realice la compra.' . "\n" . '<li><span class="b">Libro de Direcciones</span> - Podemos enviar sus productos a otras direcciones aparte de la suya! Esto es perfecto para enviar regalos de cumpleaños directamente a la persona que cumple años.' . "\n" . '<li><span class="b">Historia de Pedidos</span> - Vea la relacion de compras que ha realizado con nosotros.' . "\n" . '<li><span class="b">Comentarios</span> - Comparta su opinion sobre los productos con otros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Para cualquier consulta sobre nuestros servicios, por favor escriba a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">Nota:</span> Esta direccion fue suministrada por uno de nuestros clientes. Si usted no se ha suscrito como socio, por favor comuniquelo a ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

/* ICW Credit class gift voucher begin */
define('EMAIL_GV_INCENTIVE_HEADER', 'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for is %s, you can enter the redeem code when checking out, after making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulation, to make your first visit to our online shop a more rewarding experience' . "\n" .
                                        '  below are details of a Discount Coupon created just for you' . "\n\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout, ' . "\n" .
                               'after making a purchase');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' You are too young, you need to be at least ' . MIN_AGE . ' years of age!');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' You are too old !');
//###################################### avs ########################################

?>
