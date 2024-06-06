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
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
     <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
         <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
           <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_specials.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
        </table>
       <table width="100%">
<?php 
if (!isset($HTTP_GET_VARS['op'])) {
        $HTTP_GET_VARS['op']="list";
        }
switch ($HTTP_GET_VARS['op']) {
     case "results":
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_results.php");
        echo("</tr></table>\n");
        break;

     case 'comment':
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_comment.php");
        echo("</tr></table>\n");
        break;

     case 'list':
     echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_list.php");
        echo("</tr></table>\n");
        break;

     case "vote":
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_vote.php");
        echo("</tr></table>\n");
        break;
}
if (!$nolink) {
?>
<br><center><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>' . "</center>"; ?>
<?php
}
?>

<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2"></td><tr><td>
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
   </td> </tr></table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
