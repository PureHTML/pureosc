<?php
/*
  $Id: gv_redeem.php,v 1.1.1.1.2.1 2003/04/18 16:56:03 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Valider un ch&egrave;que cadeau');
define('HEADING_TITLE', 'Valider un ch&egrave;que cadeau');
define('TEXT_INFORMATION', 'Pour valider definitivement votre ch&egrave;que cadeau, veuillez vous connecter sur votre compte ou bien vous enregistrer.<br /><br />Pour avoir plus d\'informations sur l\'utilisation des ch&egrave;ques cadeaux veuillez consulter notre <span class="b"><a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.FAQ.'.</a></span><br /><br />');
define('TEXT_INVALID_GV', 'Le num&eacute;ro du ch&egrave;que cadeau peut &ecirc;tre invalide ou a d&eacute;j&agrave; &eacute;t&eacute; utilis&eacute;. Vous pouvez nous contacter pour avoir plus d\'information');
define('TEXT_VALID_GV', '%s en ch&egrave;que cadeau vous sont attribu&eacute; pour faire vos achats dans notre boutique.');
?>