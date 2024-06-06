<?php
/*
catalog\includes\languages\english\modules\payment
  $Id: ikobo.php, v .2beta 2004/07/10 05:39:27 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

You may use and distribute this software and change anything you wish accept the banners hyperlink.
* 
* Thank you
* Eugene
* 
*/

  define('MODULE_PAYMENT_WEST_TEXT_TITLE', 'Western Union Wired Payment');

  define('MODULE_PAYMENT_WEST_TEXT_DESCRIPTION', '<OL><li><span class="ColorSpan"><span class="b">PAYMENT INSTRUCTIONS</span></span>
  <p>(The following information will also be emailed to you after checkout) <br />
  You have two options when using Western Union    <br />
  </p></li>
  <li><span CLASS="blueboldarial">Visit <a href="http://www.westernunion.com/info/selectCountry.asp">WesternUnion.com</a> </span>  
  <ul>
    <li>Select the &quot;Money Transfer&quot; Option and follow the on screen directions </li>
    <li>You can pay with a bank debit card or credit card</li>
    <li>Western Union will charge you a money transfer fee </li>
    <li><span class="ColorSpanRed">Send the amount of the total shown above in US dollars</span></li>
  </ul></li>
  <li><span CLASS="blueboldarial">Visit a local Western Union agency</span> (<a href="http://www.westernunion.com/info/selectCountry.asp">find nearest location</a>) 
    <ul>
      <li>Fill out the necesarry &quot;Send Money&quot; form, ask agent if you need assistance </li>
      <li>They will require a valid ID</li>
      <li>You can pay with cash, a bank debit card or credit card </li>
      <li>Western Union will charge you a money transfer fee</li>
      <li><span class="ColorSpanRed">Send the amount of the total shown above in US dollars</span></li>
    </ul>
  </li>
  <li>Using either method, provide the following &quot;Receiver&quot; information:  
<ul>
    <li>'. MODULE_PAYMENT_WEST_PAYTO. '</li>
</ul></li>
<li><p>Once payment has been sent, please send an email to this this address: <a href="mailto:'. MODULE_PAYMENT_WEST_EMAIL. '">'. MODULE_PAYMENT_WEST_EMAIL. '</a> Include your first and last name, your order number and the Money Transfer control number. Thanks!</p>
    <p>
    Please don\'t forget to click the &quot;Confirm Order&quot; button below. </p></li></OL>' );




  define('MODULE_PAYMENT_WEST_TEXT_EMAIL_FOOTER', '

  

  

ISTRUZIONI DI PAGAMENTO

 

Western Union 





1. Si rechi all\'agenzia Western Union più vicina.

Compili il modulo di trasferimento "Send Money", potrà chiedere assistenza in agenzia 

Le sarà richiesto un documento d\'identità valido 

Il pagamento dell\'importo dovrà essere effettuato in contanti 

Western Union applicherà una commissione per l\'operazione 

Invii l\'importo totale in EUR 



2. La preghiamo di inserire le seguenti informazioni per il beneficiario: 



'. MODULE_PAYMENT_WEST_PAYTO. '



Quando il pagamento è stato effettuato la preghiamo d\'inviare una email al seguente indirizzo: '. MODULE_PAYMENT_WEST_EMAIL . ' Includa il suo nome e cognome, il suo numero d\'ordine ed il Numero di controllo del trasferimento (MTCN).

Grazie! 

  

  

' );


?>