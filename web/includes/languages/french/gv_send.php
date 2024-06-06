<?php
/*
  $Id: gv_send.php,v 1.1.2.1 2003/04/18 17:25:44 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Envoyer un ch&egrave;que cadeau');
define('NAVBAR_TITLE', 'Envoyer un ch&egrave;que cadeau');
define('EMAIL_SUBJECT', 'Envoyez par ' . STORE_NAME);
define('HEADING_TEXT','<br />Remplissez ci-dessous le formulaire pour envoyer un ch&egrave;que cadeau &agrave; un(e) ami(e) ou un membre de la famille. Pour plus d\'information, veuillez consulter notre <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.FAQ.'.</a><br /><br />');
define('ENTRY_NAME', 'Nom du destinataire :');
define('ENTRY_EMAIL', 'Adresse email du destinataire :');
define('ENTRY_MESSAGE', 'Votre Message :');
define('ENTRY_AMOUNT', 'Valeur en ch&egrave;que cadeau :');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Formulaire non remplis ou supérieure à la valeur de votre solde en panier</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Adresse email invalide</span>');
define('MAIN_MESSAGE', 'Vous avez d&eacute;cid&eacute; d\'envoyer un ch&egrave;que cadeau d\'une valeur de <span class="b">%s pour %s</span> &agrave; l\'adresse email <span class="b">%s</span><br /><br /><u>Le texte accompagnant l\'email sera</u> : <br /><br />%s<br /><br />
                        Un ch&egrave;que cadeau d\'une valeur de %s vous a &eacute;t&eacute; envoy&eacute; par %s');

define('PERSONAL_MESSAGE', 'Voici le message de %s :');
define('TEXT_SUCCESS', 'F&eacute;licitations, votre ch&egrave;que cadeau a &eacute;t&eacute; envoy&eacute;');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Félicitations, Vous avez reçu un chèque cadeau d\'une valeur de %s');
define('EMAIL_GV_TEXT_SUBJECT', 'Un cadeau de %s');
define('EMAIL_GV_FROM', 'Ce chèque cadeau vous a été envoyé par %s');
define('EMAIL_GV_MESSAGE', 'Avec le message suivant ');
define('EMAIL_GV_SEND_TO', '%s');
define('EMAIL_GV_REDEEM', 'Pour utiliser ce chèque cadeau, cliquez sur le lien ci-dessous. Notez bien le code du chèque cadeau qui est %s. Dans le cas où vous auriez des problèmes.');
define('EMAIL_GV_LINK', 'Pour utiliser le chèque cadeau. ');
define('EMAIL_GV_VISIT', ' ou visite ');
define('EMAIL_GV_ENTER', ' et entrez le code ');
define('EMAIL_GV_FIXED_FOOTER', 'Si vous avez des problèmes pour utiliser ce chèque Cadeau utilisez le lien ci-dessus.' . "\n" . 
                                'Vous pouvez aussi entrer le code du chèque cadeau pendant le processus du paiement dans notre magasin.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
?>