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



  define('MODULE_PAYMENT_WEST_TEXT_DESCRIPTION', '<OL><li><P ALIGN="center"><span class="b">ISTRUZIONI DI PAGAMENTO</span></P>

  <p>(Le seguenti informazioni ti saranno spedite anche via e-mail dopo il checkout) <br />

  <br />Western Union    <br />

  </p></li>

  <li><SPAN CLASS="blueboldarial">Si rechi all\'agenzia Western Union pi� vicina. <br />

L\'elenco completo delle agenzie in Italia � disponibile cliccando qui:</SPAN> (<a href="http://www.westernunion.com/info/selectCountry.asp">Western Union</a>) 

    <ul>

      <li>Compili il modulo di trasferimento &quot;Send Money&quot; , potr� chiedere assistenza in agenzia </li>

      <li>Le sar� richiesto un documento d\'identit� valido</li>

      <li>Il pagamento dell\'importo dovr� essere effettuato in contanti </li>

      <li>Western Union applicher� una commissione per l\'operazione</li>

      <li><span class="ColorSpanRed">Invii l\'importo totale in Euro</span></li>

    </ul>

  </li>

 <li> <br />La preghiamo di inserire le seguenti informazioni per il beneficiario:  

<ul>

    <li>'. MODULE_PAYMENT_WEST_PAYTO. '</li>

</ul><p>Quando il pagamento � stato effettuato la preghiamo d\'inviare una email al seguente indirizzo: <a href="mailto:'. MODULE_PAYMENT_WEST_EMAIL. '">'. MODULE_PAYMENT_WEST_EMAIL. '</a> Includa il suo nome e cognome, il suo numero d\'ordine ed il Numero di controllo del trasferimento (MTCN).

Grazie!</p>

    <p>

    Non dimenticarti di cliccare il pulsante &quot;Conferma ordine&quot; in basso. </p></li></OL>' );









  define('MODULE_PAYMENT_WEST_TEXT_EMAIL_FOOTER', '

  

  

ISTRUZIONI DI PAGAMENTO

 

Western Union 





1. Si rechi all\'agenzia Western Union pi� vicina.

Compili il modulo di trasferimento "Send Money", potr� chiedere assistenza in agenzia 

Le sar� richiesto un documento d\'identit� valido 

Il pagamento dell\'importo dovr� essere effettuato in contanti 

Western Union applicher� una commissione per l\'operazione 

Invii l\'importo totale in EUR 



2. La preghiamo di inserire le seguenti informazioni per il beneficiario: 



'. MODULE_PAYMENT_WEST_PAYTO . '



Quando il pagamento � stato effettuato la preghiamo d\'inviare una email al seguente indirizzo: '. MODULE_PAYMENT_WEST_EMAIL . ' Includa il suo nome e cognome, il suo numero d\'ordine ed il Numero di controllo del trasferimento (MTCN).

Grazie! 

  

  

' );





?>