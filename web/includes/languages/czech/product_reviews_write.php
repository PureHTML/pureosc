<?php
/*
  $Id: product_reviews_write.php,v 1.7 2003/06/05 23:23:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Hodnocení');

define('SUB_TITLE_FROM', 'Od:');
define('SUB_TITLE_REVIEW', 'Vaše hodnocení:');
define('SUB_TITLE_RATING', 'Hodnota:');

define('TEXT_NO_HTML', '<span class="ColorSpanRed"><span class="b">Poznámka:</span></span>&nbsp;HTML není interpretováno!');
define('TEXT_BAD', '<span class="ColorSpanRed"><span class="b">špatné</span></span>');
define('TEXT_GOOD', '<span class="ColorSpanRed"><span class="b">dobré</span></span>');

define('TEXT_CLICK_TO_ENLARGE', 'Klikněte pro větší obrázek');

//*** <Reviews Mod>
define('ADMIN_EMAIL_SUBJECT', 'Hodnocení tohoto zboží bylo schváleno');
define('ADMIN_EMAIL_MESSAGE', 'Hodnocení čekající na potvrzení, klikněte pro zobrazení tohoto hodnocení: <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '">' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '</a>');
define('ADMIN_EMAIL_FROM_NAME', 'Hodnocení tohoto zboží');
define('SUB_TITLE_EXPLAIN', '
<hr />
<h2>Hodnocení - zásady</h2>
<h3>Potřebujeme Vaše hodnocení!</h3>
<p>Opravdu nás zajímá co si myslíte o tomto zboží. Můžeme Vaše hodnocení přijmout, odmítnout nebo upravit; pokud se nám bude jevit jako obsahově nevhodné.</p>
<ul>
<li>Prosíme <strong>postupujte takto:</strong>
<ul>
<li>napište 50-300 slov o zboží</li>
<li>comment on the product�s value and effectiveness</li>
<li>sdělte co se Vám na tomto zboží líbí a co se Vám nelíbí a proč <strong>why</strong> líbí nebo nelíbí</li>
<li>mention related products and how this one rates by comparison</li>
</ul>
</li>
<li>Tohle <strong>nedělejte:</strong>
<ul>
<li>nepište nesmysly a vulgárnosti</li>
<li>nepište žádná tel. čísla, adresy, URL</li>
<li>také nepište poznámky k ceně, dodání a placení</li>
</ul>
</li>
</ul>
<hr />
');
//*** </Reviews Mod>

?>