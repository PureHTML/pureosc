<?php
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

  <tr><td class="main" colspan="2"><a href='poll_delete.php?comment=<?php echo $comments['commentid']; ?>&pollid=<?PHP echo $pollid; ?>'><?php echo htmlspecialchars($comments['COMMENT']) . "Delete Comment"; ?></a></td></tr>

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
                        <tr><td colspan="2" align="center" class="main">[ <a href="<?php echo tep_href_link('pollbooth.php','pollid='.$pollid.'&op=comment','NONSSL')?>"><? echo _ADD_COMMENTS?></a> | <a href="<?php echo tep_href_link('pollbooth.php','pollid='.$pollid.'&op=vote','NONSSL')?>"><? echo _VOTING?></a> | <a href="<? echo tep_href_link('pollbooth.php','op=list','NONSSL')?>"><?PHP echo _OTHERPOLLS ?></a> ]</td></tr>
						
