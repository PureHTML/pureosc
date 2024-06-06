<?PHP

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POLLBOOTH);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_ADMIN; ?>">
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
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
      <tr>


<?php
if ($HTTP_GET_VARS['warn']) {
?>
          <tr class="headerError">
            <td class="headerError"><?echo (_WARNING);$warn=$HTTP_GET_VARS['warn'];eval("\$temp=$warn;");echo($temp);?></td>
          </tr>
<?php
}
?>
     <tr>
       <td>
       <table width="100%">
<?php
if (!isset($HTTP_GET_VARS['op'])) {
        $HTTP_GET_VARS['op']="list";
        }
switch ($HTTP_GET_VARS['op']) {
        case "results":
                if (isset($HTTP_GET_VARS['pollid'])) {
                        $pollid=$HTTP_GET_VARS['pollid'];
                } else {
                $pollid=1;
                }
                      $poll_query = tep_db_query("SELECT pollid, timeStamp FROM phesis_poll_desc WHERE pollid='".$pollid."'");
                      $polls = tep_db_fetch_array($poll_query);
                      $title_query = tep_db_query("SELect optionText from phesis_poll_data where pollid='".$pollid."' and voteid='0' and language_id = '" . $languages_id . "'");
                      $title = tep_db_fetch_array($title_query);
?>
                <tr><td colspan="2" align="center"><b><br><br><?echo $title['optionText']?></b></td></tr>
                <tr><td>&nbsp;</td></tr>
<?php
                        $query="SELECT SUM(optionCount) AS sum FROM phesis_poll_data WHERE pollid='".$pollid."'";
                        $result=tep_db_query($query);
                        $polls=tep_db_fetch_array($result);
                        $sum=$polls['sum'];
                        for($i = 1; $i <= 12; $i++) {
                                $query = "SELECT pollid, optiontext, optioncount, voteid FROM phesis_poll_data WHERE (language_id = '" . $languages_id . "') and (pollid='".$pollid."') AND (voteid='".$i."')";
                                $result=tep_db_query($query);$polls=tep_db_fetch_array($result);
                                $optiontext=$polls['optiontext'];
                                $optioncount=$polls['optioncount'];
                                if ($optiontext) {
?>
                                        <tr><td align="right">
                                        <?php echo $optiontext?></td>
<?php
                                        if ($sum) {
                                                $percent = 100 * $optioncount / $sum;
                                                } else {
                                                $percent = 0;
                                                }
?>
                                        <td align="left">
<?php
                                        $percentInt = (int)$percent * 4 * 1;
                                        $percent2 = (int)$percent;
                                        if ($percent > 0) {
?>
                                                   <img src="images/leftbar.gif" height="15" width="7" Alt="<?echo $percent2?> %"><img src="images/mainbar.gif" height="15" width="<?echo $percentInt?>" Alt="<?echo $percent2?> %"><img src="images/rightbar.gif" height="15" width="7" Alt="<?echo $percent2?> %">
<?php

                                                } else {
?>
                                                    <img src="images/leftbar.gif" height="15" width="7" Alt="<? echo $percent2?> %"><img src="images/mainbar.gif" height="15" width="3" Alt="<? echo $percent2?> %"><img src="images/rightbar.gif" height="15" width="7" Alt="<? echo $percent2?> %">
<?php
                                                }
                                        printf(" %.2f%% (%d)", $percent, $optioncount);
?>
                                        </td></tr>
<?php
                                        }
                                }

                        $comments_query_raw = "select * from phesis_comments where pollid = '" . $pollid . "' and language_id = '" . $languages_id . "'";

//                      $comments_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_NEW_COMMENTS, $comments_query_raw, $comments_numrows);
                        $comments_query = tep_db_query($comments_query_raw);
  if ($comments_numrows > 0) {
?>

        <tr><td colspan="2">&nbsp;</td></tr>

        <tr><td class="pageheading" colspan="2"><?php echo _COMMENTS_POSTED; ?></td></tr>

        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

<?php

}

  if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {

?>

      <tr>

        <td colspan="2"><br><table border="0" width="100%" cellspacing="0" cellpadding="2">

          <tr>

            <td class="smallText"><?php echo $comments_split->display_count($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>

            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $comments_split->display_links($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>

          </tr>

        </table></td>

      </tr>

<?php

  }

                        while ($comments = tep_db_fetch_array($comments_query)) {

  if ($comments['customer_id'] != '0') {

    $name_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '". $comments['customer_id'] . "'");

    $name = tep_db_fetch_array($name_query);

    $comment_name = $name['customers_firstname'] . " " . $name['customers_lastname'];

  } else {

    $comment_name = $comments['name'];

  }



   $post_details = _COMMENTS_BY . $comment_name . '['. $comments['host_name'] . ']' . _COMMENTS_ON . $comments['date'] . '<br># ' . $comments['comment']; 

?>



  <tr><td class="main" colspan="2"><b><?php echo $post_details; ?></b></td></tr>

        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>

  <tr><td class="main" colspan="2"><?php echo htmlspecialchars($comments['COMMENT']); ?></td></tr>

        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>


<?php
}
  if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td colspan="2"><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $comments_split->display_count($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $comments_split->display_links($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
                        <tr><td colspan="2" align="center">&nbsp;</td></tr>
                        <tr><td colspan="2" align="center" class="main"><? echo _TOTALVOTES?> = <? echo $sum?></td></tr>
                        <tr><td colspan="2" align="center" class="main">[ <a href="<?php echo tep_href_link('pollbooth.php','pollid='.$pollid.'&op=comment','NONSSL')?>"><? echo _ADD_COMMENTS?></a> | <a href="<?php echo tep_href_link('pollbooth.php','pollid='.$pollid.'&op=vote','NONSSL')?>"><? echo _VOTING?></a> | <a href="<? echo tep_href_link('pollbooth.php','op=list','NONSSL')?>"><?echo _OTHERPOLLS?></a> ]</td></tr>
<?php
                        break;
                case 'comment':
                if (isset($HTTP_GET_VARS['pollid'])) {
                        $pollid=$HTTP_GET_VARS['pollid'];
                } else {
                $pollid=1;
                }
                      $poll_query = tep_db_query("SELECT pollid, timeStamp FROM phesis_poll_desc WHERE pollid='".$pollid."'");
                      $polls = tep_db_fetch_array($poll_query);
                      $title_query = tep_db_query("select optionText from phesis_poll_data where pollid='".$pollid."' and voteid='0' and language_id = '" . $languages_id . "'");
                      $title = tep_db_fetch_array($title_query);
?>
                <?php echo tep_draw_form('poll_comment', tep_href_link('pollbooth.php', 'action=do_comment&pollid=' . $pollid), 'post'); ?>
                <tr><td colspan="2" align="center"><b><br><br><?echo $title['optionText']?></b></td></tr>
                <tr><td colspan="2">&nbsp;</td></tr>
<?php
  if (!$customer_id) {
?>
                <tr><td><?php echo tep_draw_input_field('comment_name',''); ?>&nbsp;<?php echo _YOURNAME; ?></td></tr>
<?php
  }
?>
                <tr><td><?php echo tep_draw_textarea_field('comment', 'soft', '30', '4', ''); ?></td></tr>
                <tr><td><?php echo tep_image_submit('button_continue.gif','TEXT_CONTINUE'); ?></td></tr>
                <form>
<?php
                $nolink = true;
                break;
                case 'list':
?>
                <tr><td colspan="3">&nbsp;</td></tr>
<?php
                $result=tep_db_query("SELECT pollid, timestamp, voters, poll_type, poll_open FROM phesis_poll_desc ORDER BY timestamp desc");
                $row=0;
                while ($polls=tep_db_fetch_array($result)) {
                        $row++;
                        $id=$polls['pollid'];
                        if (($row / 2) == floor($row / 2)) {
?>
                        <tr class="Payment-even">
<?php
                } else {
?>
                        <tr class="Payment-odd">
<?php
                }
                        $title_query = tep_db_query("SELect optionText from phesis_poll_data where pollid='".$id."' and voteid='0' and language_id = '" . $languages_id . "'");
                        $title = tep_db_fetch_array($title_query);
                $fullresults="<a href=\"".tep_href_link('pollbooth.php','op=results&pollid='.$id,'NONSSL')."\">"._POLLRESULTS."</a>";
                $result1 = tep_db_query("SELECT SUM(optioncount) AS sum FROM phesis_poll_data WHERE pollid='".$id."'");
                $poll_sum=tep_db_fetch_array($result1);
                $sum=$poll_sum['sum'];
                $query1=tep_db_query("select count(pollid) as comments from phesis_comments where pollid='".$id."' and language_id='".$languages_id."'");
                $result1 = tep_db_fetch_array($query1);
                $comments = $result1['comments'];
                echo("<td class=\"main\">".$title['optionText']."</td><td class=\"main\">".$sum." "._VOTES."</td><td class=\"main\">".$comments." "._COMMENTS."</td><td class=\"main\">".$fullresults."</td>");
                if ($polls['poll_type']=='0') {
                        echo ("<td class=\"main\">"._PUBLIC."</td>");
                          } else {
                        echo ("<td class=\"main\">"._PRIVATE."</td>");
                        }
                if ($polls['poll_open']=='0') {
                        echo ("<td class=\"main\">"._POLLOPEN."</td>");
                          } else {
                        echo ("<td class=\"main\">"._POLLCLOSED."</td>");
                        }

                echo("</tr>\n");
        }
        break;
        case "vote":
if (isset($HTTP_GET_VARS['pollid'])) {
$pollid=$HTTP_GET_VARS['pollid'];
} else {
$pollid=1;
}
                $poll_query=tep_db_query("select voters from phesis_poll_desc where pollid='".$pollid."'");
                $poll_details=tep_db_fetch_array($poll_query);
                $title_query = tep_db_query("SElect optionText from phesis_poll_data where pollid='".$pollid."' and voteid='0' and language_id = '" . $languages_id . "'");
                $title = tep_db_fetch_array($title_query);
?>
                <tr>
                <td align="center"><b><?echo $title['optionText']?></b><td>
                </tr>
<?php
                $url = tep_href_link('pollbooth.php','op=results&pollid='.$pollid,'NONSSL');
                 $content =  "<input type=\"hidden\" name=\"pollid\" value=\"".$pollid."\">\n";
                  $content .=  "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">\n";
                for ($i=1;$i<=12;$i++) {
                      $query=tep_db_query("select pollid, optiontext, optioncount, voteid from phesis_poll_data where (pollid='".$pollid."') and (voteid=$i) and (language_id='".$languages_id."')");
                      if ($result=tep_db_fetch_array($query)) {
                                      if ($result['optiontext']) {
                               $content.= "<input type=\"radio\" name=\"voteid\" value=\"".$i."\">".$result['optiontext']."<br>\n";
                               }
                            }
                }
                $content .= "<br><center><input type=\"submit\" value=\""._VOTE."\"></center><br>\n";
                $query=tep_db_query("select sum(optioncount) as sum from phesis_poll_data where pollid='".$pollid."'");
                if ($result=tep_db_fetch_array($query)) {
                        $sum=$result['sum'];
                }
                $content .= "<center>[ <a href=\"".tep_href_link('pollbooth.php','op=results&pollid='.$pollid,'NONSSL')."\">"._RESULTS."</a> | <a href=\"".tep_href_link('pollbooth.php','op=list','NONSSL')."\">"._OTHERPOLLS."</a> ]";
                  $content .= "</br><center>" . $sum . " "._VOTES."</center>\n";
                echo '<tr><td align="center"><form name="poll" method="post" action="pollcollect.php">';
                echo $content;
                echo '<form>';
?>
                </td>
                </tr>
<?php
        break;
                }
?>
     </table>
      </tr>
<?php
  if (!$nolink) {
?>
      <tr>
        <td align="right" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_POLLS, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', 'CONTINUE') . '</a>'; ?></td>
      </tr>
<?php
}
?>
    </table></td>
<!-- body_text_eof //-->

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