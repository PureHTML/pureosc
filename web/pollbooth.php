<?
//function to check that there is no HTML in the comment field.

function screenForm($field_value){
	$stripped = strip_tags($field_value);
	if($field_value!=$stripped) { // something in the field value was HTML
	return false;
	}
	else return true;
} 

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/pollbooth.php');
  $location = ' : <a href="' . tep_href_link('pollbooth.php', 'op=results', 'NONSSL') . '" class="headerNavigation"> ' . NAVBAR_TITLE_1 . '</a>';
  DEFINE('MAX_DISPLAY_NEW_COMMENTS', '5');
if (($HTTP_GET_VARS['action']=='do_comment')&& (screenForm($HTTP_POST_VARS['comment']))) {
   $comment_query_raw = "insert into phesis_comments (pollid, customer_id, name, date, host_name, comment,language_id) values ('" . $HTTP_GET_VARS['pollid'] . "', '" . $customer_id . "', '" . addslashes($HTTP_POST_VARS['comment_name']) . "', now(),'" . $REMOTE_ADDR . "','" . addslashes($HTTP_POST_VARS['comment']) . "','" . $languages_id . "')";
   $comment_query = tep_db_query($comment_query_raw);
  $HTTP_GET_VARS['action'] = '';
   $HTTP_GET_VARS['op'] = 'results';
}

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_POLLBOTH));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
