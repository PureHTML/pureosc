<?php
/*
  $Id: product_reviews_write.php,v 1.10 2003/07/08 16:45:36 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Comentarios');

define('SUB_TITLE_FROM', 'De:');
define('SUB_TITLE_REVIEW', 'Comentario:');
define('SUB_TITLE_RATING', 'Evaluaci&oacute;n:');

define('TEXT_NO_HTML', '<span class="ColorSpanRed"><span class="b">NOTA:</span></span>&nbsp;No se traducir&aacute; el codigo HTML!');
define('TEXT_BAD', '<span class="ColorSpanRed"><span class="b">MALO</span></span>');
define('TEXT_GOOD', '<span class="ColorSpanRed"><span class="b">BUENO</span></span>');

define('TEXT_CLICK_TO_ENLARGE', 'Haga Click para agrandar');

//*** <Reviews Mod>
define('ADMIN_EMAIL_SUBJECT', 'Product Review - Approval Required');
define('ADMIN_EMAIL_MESSAGE', 'There is a new product review awaiting approval from your online store, please click this link to view this review: <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '">' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '</a>');
define('ADMIN_EMAIL_FROM_NAME', 'Product Reviews');
define('SUB_TITLE_EXPLAIN', '
<hr />
<h2>Review Guidelines</h2>
<h3>We want your comments!</h3>
<p>We�re interested in your opinion of this product. Let us and other customers know how you feel by filling in the comment field below. We reserve the right to accept, reject, or edit product reviews; therefore, your review may not appear immediately.</p>
<ul>
<li>Please <strong>do:</strong>
<ul>
<li>write 50-300 words for the product</li>
<li>comment on the product�s value and effectiveness</li>
<li>tell us if you like the product, but most importantly explain <strong>why</strong> you like or dislike it</li>
<li>mention related products and how this one rates by comparison</li>
</ul>
</li>
<li>Please <strong>do not:</strong>
<ul>
<li>use profanity, obscenities, or make spiteful remarks</li>
<li>type phone numbers, mail addresses, or URLs</li>
<li>make note of availability, price, or alternative ordering/shipping information</li>
</ul>
</li>
</ul>
<hr />
');
//*** </Reviews Mod>

?>