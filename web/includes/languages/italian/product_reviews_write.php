<?php
/*
  $Id: product_reviews_write.php,v 1.7 2003/06/05 23:23:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE', 'Recensioni');

define('SUB_TITLE_FROM', 'Da:');
define('SUB_TITLE_REVIEW', 'Recensione:');
define('SUB_TITLE_RATING', 'Votazione:');

define('TEXT_NO_HTML', '<span class="ColorSpanRed"><span class="b">NOTE:</span></span>&nbsp;il codice HTML non &egrave; supportato!');
define('TEXT_BAD', '<span class="ColorSpanRed"><span class="b">PESSIMO</span></span>');
define('TEXT_GOOD', '<span class="ColorSpanRed"><span class="b">OTTIMO</span></span>');

define('TEXT_CLICK_TO_ENLARGE', 'Clicca per ingrandire');

//*** <Reviews Mod>
define('ADMIN_EMAIL_SUBJECT', 'Recensione Articoli - Richiesta Approvazione');
define('ADMIN_EMAIL_MESSAGE', 'C\'&egrave; una recensione su un nuovo prodotto da approvare, clicca su questo link per vederla: <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '">' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '</a>');
define('ADMIN_EMAIL_FROM_NAME', 'Recensione prodottto');
define('SUB_TITLE_EXPLAIN', '
<hr />
<h2>Guida per Recensione</h2>
<h3>Vogliamo i tuoi commenti!</h3>
<p>Siamo interessati alla tua opinione su questo prodotto. Riserviamo il diritto di accettare,respingere o modificare ogni recensione; pertanto, la tua recensione non comparir&agrave; immediatamente.</p>
<ul>
<li>Per favore <strong>puoi:</strong>
<ul>
<li>scrivere 50-300 parole per il prodotto</li>
<li>commentre il valore effettivo del prodotto</li>
<li>scrivici se sei interessato al prodotto, ma, cosa ancor pi&ugrave; importante <strong>perch&egrave;</strong> ti piace o meno il prodotto</li>
</ul>
</li>
<li>Per favore <strong>non puoi:</strong>
<ul>
<li>usare termini inappropriati, osceni, o pornografici</li>
<li>indicare il n. de telefono, l&#39;email, o URLs</li>
<li>prendere nota della disponibilit&agrave;, prezzo, o informazioni sull&#39;ordine e sulle modalit&agrave; di pagamento/trasporto</li>
</ul>
</li>
</ul>
<hr />
');
//*** </Reviews Mod>

?>