<?php
/*
  $Id: login.php,v 1.1 2005/05/04 20:07:31 tropic Exp $
  translation by mathsosc 2005/07/13
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Login');
  define('HEADING_TITLE', 'Bienvenue, veuillez vous identifier.');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Panneau d\'ouverture :');
define('HEADING_PASSWORD_FORGOTTEN', 'Mot de passe oublié :');
define('TEXT_RETURNING_ADMIN', 'Personnel seulement !');
define('ENTRY_EMAIL_ADDRESS', 'Adresse Email :');
define('ENTRY_PASSWORD', 'Mot de passe :');
define('ENTRY_FIRSTNAME', 'Pr&eacute;nom :');
define('IMAGE_BUTTON_LOGIN', 'Confirmer');

define('TEXT_PASSWORD_FORGOTTEN', 'Mot de passe oubli&eacute; ?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERREUR :</b></font> Mauvais email ou mot de passe !');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERREUR :</b></font> Probl&egrave;me de pr&eacute;nom ou de mot de passe !');
define('TEXT_FORGOTTEN_FAIL', 'Vous avez que 3 essais pour des raisons de s&eacute;curit&eacute;, contactez SVP votre administrateur pour obtenir un nouveau mot de passe.<br />&nbsp;<br />&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Le nouveau mot de passe va &ecirc;tre envoy&eacute; &agrave; votre adresse email. Veuillez v&eacute;rifier votre email et essayer de nouveau une ouverture.<br />&nbsp;<br />&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nouveau mot de passe'); 
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'Vous pouvez accéder au panneau d\'administration avec le mot de passe suivant. Une fois que vous accédez à l\'administration, changez svp votre mot de passe ! ' . "\n\n" . 'Site Web : %s' . "\n" . 'Nom d\'utilisateur : %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci !' . "\n" . '%s' . "\n\n" . 'Ceci est un message automatisé, veuillez ne pas repondre !'); 
?>
