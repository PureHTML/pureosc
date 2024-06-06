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



  define('MODULE_PAYMENT_WEST_TEXT_DESCRIPTION', '<OL><li><P ALIGN="center"><span class="b">Einzahlungsmethoden:</span></P>

  <p>(The following information will also be emailed to you after checkout) <br />

  <br />Western Union    <br />

  </p></li>

  <li><SPAN CLASS="blueboldarial">Western Union Filliale</SPAN> (<a href="http://www.westernunion.com/info/selectCountry.asp">WesternUnion.com</a>) 

    <ul>

      <li>Fuellen Sie , dass notwaendige Formular &quot;Geld senden&quot; aus. Falls Sie hilfe benoetigen, fragen Sie bitte den zustaendigen Western Union Mitarbeiter.

 </li>

      <li>Der WU Mitarbeiter benoetigt eine gueltige ID ( Amtlichen Lichtbildausweis ) </li>

      <li>Sie koennen mit Bargeld, EC Karte oder Kreditkarte einzahlen </li>

      <li>Wester Union erhebt eine Gebuehr fuer den Geldversand </li>

      <li><span class="ColorSpanRed">Fuellen sie bitte den oben angegebenen Betrag in EUR ein </span></li>

    </ul>

  </li>

  <li><br />Benoetigen Sie follgende Empfaenger Info:  

<ul>

    <li>'. MODULE_PAYMENT_WEST_PAYTO. '</li>

</ul><p>Sobald der Betrag verschickt wurde, senden Sie uns ein E-mail an diese Adresse: <a href="mailto:'. MODULE_PAYMENT_WEST_EMAIL. '">'. MODULE_PAYMENT_WEST_EMAIL. '</a> Bitte geben Sie Ihren Vor und Nachnamen, Ihre Belegnummer und die Kontrollnummer an. Vielen Dank</p>

    <p>

    Please don\'t forget to click the &quot;Bestellen&quot; button below. </p></li></OL>' );









  define('MODULE_PAYMENT_WEST_TEXT_EMAIL_FOOTER', '

  

  

Einzahlungsmethoden:

 

Western Union  





1. Western Union Filliale

Fuellen Sie , dass notwaendige Formular "Geld senden" aus. Falls Sie hilfe benoetigen, fragen Sie bitte den zustaendigen Western Union Mitarbeiter.

Der WU Mitarbeiter benoetigt eine gueltige ID ( Amtlichen Lichtbildausweis ) 

Sie koennen mit Bargeld, EC Karte oder Kreditkarte einzahlen

Wester Union erhebt eine Gebuehr fuer den Geldversand

Fuellen sie bitte den oben angegebenen Betrag in EUR ein



2. Benoetigen Sie follgende Empfaenger Info:



'. MODULE_PAYMENT_WEST_PAYTO. '



Sobald der Betrag verschickt wurde, senden Sie uns ein E-mail an diese Adresse: '. MODULE_PAYMENT_WEST_EMAIL . ' Bitte geben Sie Ihren Vor und Nachnamen, Ihre Belegnummer und die Kontrollnummer an. Vielen Dank 

  

  

' );





?>