<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
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
define('NAVBAR_TITLE', 'Cr&eacute;er un compte');

define('HEADING_TITLE', 'Information de mon compte');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">REMARQUE:</span></span> Si vous avez d&eacute;j&agrave; un compte chez nous, veuillez vous connecter &agrave; la page d\'<a href="%s"><span class="ColorSpan">ouverture de session</span></a>.');

define('EMAIL_SUBJECT', 'Bienvenue sur ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Cher Mme. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher %s' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous accueillons sur <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez maintenant participer aux <span class="b">divers services<span class="b"> que nous devons vous offrir. Certains de ces services incluent:' . "\n\n" . '<li><span class="b">Panier permanent</span> - N\'importe quels produits ajout&eacute;s &agrave; votre panier en ligne restent l&agrave; jusqu\'&agrave; ce que vous les supprimiez, ou les consultiez. ' . "\n" . '<li><span class="b">Carnet d\'adresses </span> - Nous pouvons maintenant livrer vos produits &agrave; une adresse diff&eacute;rente de la v&ocirc;tre! C\'est parfait pour envoyer des cadeaux d\'anniversaire adressez &agrave; l\'intention d\'autres personnes.' . "\n" . '<li><span class="b">Historique de commande</span> - Voir vos historiques d\'achats que vous avez effectu&eacute;s chez nous.' . "\n" . '<li><span class="b">Critiques de produits</span> - Partagez vos avis sur des produits avec nos autres clients. ' . "\n\n");
define('EMAIL_CONTACT', 'Pour obtenir de l\'aide sur n\'importe quel de nos services en ligne, envoyez s\'il vous pla&icirc;t un courrier &eacute;lectronique au propri&eacute;taire du magasin: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">REMARQUE:</span> Si cette adresse &eacute;lectronique vous a &eacute;t&eacute; donn&eacute; par un de nos clients. Si vous n\'&ecirc;tes pas un membre, envoyez s\'il vous pla&icirc;t un courrier &eacute;lectronique à ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

/* CCGV Contribution */
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Pour votre bienvenue comme nouveaux clients, nous vous avons envoyé un chèque cadeaux d\'une valeur de %s');
define('EMAIL_GV_REDEEM', 'Le code de ce chèque cadeau est : %s, vous pouvez entrer ce code au moment de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', "\n\n" .'Félicitations, pour votre première visite à notre magasin en ligne, pour vous remerciez nous vous envoyons une remise par coupon.' . "\n" .
                                        ' Ci-dessous les détails du Coupon de Remise créé juste pour vous.' . "\n");
define('EMAIL_COUPON_REDEEM', 'Utiliser le coupon %s au moment de votre commande');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' You are too young, you need to be at least ' . MIN_AGE . ' years of age!');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' You are too old !');
//###################################### avs ########################################

?>