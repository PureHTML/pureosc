<?php
/*
  $Id: header_tags_popup_help.php,v 1.0 2005/09/22 
   
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce
  
  Released under the GNU General Public License
*/
?>
<style type="text/css">
.popupText {color: #000; font-size: 12px; } 
</style>
<table border="0" cellpadding="0" cellspacing="0" class="popupText">
 <tr>
  <td style="font-size: 1.5em;">HTTP Return Codes</td>
 </tr>
 <tr>  
  <td>Inserire un codice corretto in una pagina web &egrave; molto importante. Se il codice di ritorno 
  non &egrave; del suo tipo, i motori di ricerca vedranno il sito come duplicato. Il tuo sito sar&agrave; bannato.
  <span style="color: red;"> Se il tuo sito non restituisce 200 ma 301 sar&agrave; rimosso permanentemente</span>, 
  you may  want to take a closer look at how it is setup. 
  </td>
 </tr>
 <tr><td height="10">&nbsp;</td></tr>
  <tr>
   <td>
  <b>HTTP Status Code - 200 OK</b>
  <p class="main">La richiesta ha avuto successo. The information returned with the 
  response is dependent on the method used in the request.</p>
  <b>HTTP Status Code - 301 Spostato permanentemente</b>
  <p class="main">The requested resource has been assigned a new permanent URI 
  and any future references to this resource SHOULD use one of the returned URIs.</p>
  <b>HTTP Status Code - 302 Trovato</b>
  <p class="main">The requested resource resides temporarily under a different 
  URI. Since the redirection might be altered on occasion, the client SHOULD 
  continue to use the Request-URI for future requests.</p>
  <b>HTTP Status Code - 304 Non modificato</b>
  <p class="main">If the client has performed a conditional GET request and 
  access is allowed, but the document has not been modified, the server SHOULD 
  respond with this status code. The 304 response MUST NOT contain a 
  message-body, and thus is always terminated by the first empty line after the 
  header fields.</p>
  <b>HTTP Status Code - 307 Redirect Temporaneo</b>
  <p class="main">The requested resource resides temporarily under a different 
  URI. Since the redirection MAY be altered on occasion, the client SHOULD 
  continue to use the Request-URI for future requests. This response is only 
  cacheable if indicated by a Cache-Control or Expires header field.</p>
  <b>HTTP Status Code - 400 Richiesta errata</b>
  <p class="main">The request could not be understood by the server due to 
  malformed syntax. The client SHOULD NOT repeat the request without 
  modifications.</p>
  <b>HTTP Status Code - 401 Non autorizzato</b>
  <p class="main">The request requires user authentication. The response MUST 
  include a WWW-Authenticate header field containing a challenge applicable to 
  the requested resource.</p>
  <b>HTTP Status Code - 403 Proibito</b>
  <p class="main">The server understood the request, but is refusing to fulfill 
  it. Authorization will not help and the request SHOULD NOT be repeated.</p>
  <b>HTTP Status Code - 404 Non trovato</b>
  <p class="main">The server has not found anything matching the Request-URI. No 
  indication is given of whether the condition is temporary or permanent.</p>
  <b>HTTP Status Code - 410 Gone</b>
  <p class="main">The requested resource is no longer available at the server and 
  no forwarding address is known. This condition is expected to be considered 
  permanent. Clients with link editing capabilities SHOULD delete references to 
  the Request-URI after user approval.</p>
  <p class="main">If the server does not know, or has no facility to determine, 
  whether or not the condition is permanent, the status code 404 Not Found 
  SHOULD be used instead. This response is cacheable unless indicated otherwise.</p>
  <b>HTTP Status Code - 500 Errore interno del Server</b>
  <p class="main">The server encountered an unexpected condition which prevented 
  it from fulfilling the request.</p>
  <b>HTTP Status Code - 501 Not Implemented</b>
  <p class="main">The server does not support the functionality required to 
  fulfill the request. This is the appropriate response when the server does not 
  recognize the request method and is not capable of supporting it for any 
  resource. 
<p>&nbsp;</p>

  </td>
 </tr> 
</table>
