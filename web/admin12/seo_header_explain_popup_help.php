<?php
/*
  $Id: header_tags_popup_help.php,v 1.0 2005/09/22 13:45:11 devosc Exp $
  produced by Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 
  require("includes/application_top.php");
  require(DIR_WS_LANGUAGES . $language . '/seo_header_explain_popup_help.php');
 
  define('TEXT_CLOSE_WINDOW', 'Close Window [x]'); 
?> 
<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>
