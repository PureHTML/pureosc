<?php

/*

catalog\includes\languages\english\modules\payment

  $Id: ikobo.php, v .2beta 200/05/15 05:39:27 hpdl Exp $



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



You may use and distribute this software and change anything you wish accept the banners hyperlink.

* 

* Thank you

* John M Update (include payment instructions email footer)

* 

*/



  define('MODULE_PAYMENT_WEST_TEXT_TITLE', 'Western Union');



  define('MODULE_PAYMENT_WEST_TEXT_DESCRIPTION', '<OL><li><P ALIGN="center"><span class="b">INSTRUCTIONS DE PAIEMENT</span></P>

  <p>(Les informations suivantes vous seront aussi envoy�es par e-mail apr�s votre confirmation de commande) <br />

  <br />Western Union    <br />

  </p></li>

  <li><SPAN CLASS="blueboldarial">rendez-vous sur</SPAN> <a href="http://www.westernunion.com/info/selectCountry.asp">WesternUnion.com</a> afin de trouver votre agence Western Union la plus proche de votre domicile 

    <ul>

      <li>Remplissez le document "Envoi d\'argent", et demandez �ventuellement de l\'aide � l\'agent</li>

      <li>Ils vont vous demander de pr�senter une pi�ce d\'identit� valide </li>

      <li>Vous pouvez payer en liquide, avec une carte bancaire ou de cr�dit </li>

      <li>Western Union vous fera payer des frais de transfert</li>

      <li><span class="ColorSpanRed">Envoyez le montant total ci-dessus en Euro</span></li>

    </ul>

  </li>

  <li><br />Fournir les informations suivantes du "Destinataire":  

<ul>

    <li>'. MODULE_PAYMENT_WEST_PAYTO. '</li>

</ul><p>Quand le paiement est envoy�, Veuillez svp envoyer un e-mail � cette adresse: <a href="mailto:'. MODULE_PAYMENT_WEST_EMAIL. '">'. MODULE_PAYMENT_WEST_EMAIL. '</a> Indiquez votre nom et pr�nom, votre num�ro d\'ordre et le num�ro de contr�le du paiement. Merci !</p>

    <p>

    Svp, n\'oubliez pas de cliquer sur le bouton "Confirmer cmde" ci-dessous. </p></li></OL>' );









  define('MODULE_PAYMENT_WEST_TEXT_EMAIL_FOOTER', '

  

  

INSTRUCTIONS DE PAIEMENT

 

Western Union 





1. Rendez-vous chez votre agence Western Union la plus proche de votre domicile 

Remplissez le document "Envoi d\'argent", et demandez eventuellement de l\'aide � l\'agent

Ils vont vous demander de pr�senter une pi�ce d\'identit� valide

Vous pouvez payer en liquide, avec une carte bancaire ou de cr�dit 

Western Union vous fera payer des frais de transfert

Envoyez le montant total ci-dessus en Euro 



2. Vous devez fournir les informations suivantes du "Destinataire" : 



'. MODULE_PAYMENT_WEST_PAYTO. '


Quand le paiement est envoy�, Veuillez svp envoyer un e-mail � cette adresse: '. MODULE_PAYMENT_WEST_EMAIL . '

Indiquez votre nom et pr�nom, votre num�ro d\'ordre et le num�ro de contr�le du paiement. Merci ! 

  

  

' );





?>