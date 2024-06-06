<?php
/*
  $Id: header.php,v 1.19 2002/04/13 16:11:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

// START Admin-Notes Warning
	$admin_notes_query = tep_db_query("select status, last_update from " . TABLE_ADMIN_NOTES);
	$admin_notes = tep_db_num_rows($admin_notes_query);
	while ($admin_notes = tep_db_fetch_array($admin_notes_query)) {

	$today_time = time();
	$notes_time = ($today_time - strtotime($admin_notes['last_update']) );

	if (($admin_notes['status'] == 0) || ($admin_notes['status'] == 2)) {
	if ($notes_time > 1) {
    $messageStack->add(WARNING_ADMIN_NOTES_TIME, 'warning');
   }
  }
 }
// END Admin-Notes Warning

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td height=10><img src=images/logo_admin.gif></td>
    
<?php
//echo '<td>' . tep_admin_files_boxes(FILENAME_ADMIN_NOTES, tep_image(DIR_WS_IMAGES . 'postit2.png', BOX_TOOLS_ADMIN_NOTES, '35', '35') ) . '</td>';    
?>

  </tr>
  <tr class="headerBar">
    <td class="headerBarContent">&nbsp;&nbsp;<?php
//Admin begin
//  echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_TOP . '</a>'; 
  if (tep_session_is_registered('login_id')) {
    echo '<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_LOGOFF . '</a>';
  } else {
    echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_TOP . '</a>';
  }
//Admin end
    ?></td>
    <?php 
    //echo '<td class="headerBarContent" align="left"><a href="http://www.oscommerce.com" class="headerLink">' . HEADER_TITLE_SUPPORT_SITE . '</a></td>';
    echo '<td class="headerBarContent" align="left"><a href="' . tep_catalog_href_link() . '" class="headerLink">' . HEADER_TITLE_ONLINE_CATALOG . '</a></td><td class="headerBarContent" align="left"><a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_ADMINISTRATION . '</a></td>'; 
    
//echo '<td class="headerBarContent" align="left">' . tep_admin_files_boxes(FILENAME_ADMIN_NOTES, BOX_TOOLS_ADMIN_NOTES ) . '</td>';
    
    ?>
  </tr>
</table>