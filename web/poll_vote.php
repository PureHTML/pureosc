<?
if (isset($HTTP_GET_VARS['pollid'])) {
$pollid=$HTTP_GET_VARS['pollid'];
} else {
$pollid=1;
}

        $poll_query=tep_db_query("select voters from phesis_poll_desc where pollid=$pollid and poll_open='0'");
        $poll_details=tep_db_fetch_array($poll_query);
        $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'");
        $title = tep_db_fetch_array($title_query);
        $info_box_contents = array();
          $info_box_contents[] = array('align' => 'center',
                               'text'  => _POLLS
                              );
          new infoBoxHeading($info_box_contents, false, false);
          $url = tep_href_link('pollbooth.php', 'op=results&pollid='.$pollid);
        $content = "<tr><td colspan=\"2\" class=\"main\">" . $title['optionText'] . "</td></tr>";
         $content .=  "<input type=\"hidden\" name=\"pollid\" value=\"".$pollid."\">\n";
          $content .=  "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">\n";
        for ($i=1;$i<=8;$i++) {
              $query=tep_db_query("select pollid, optiontext, optioncount, voteid from phesis_poll_data where (pollid=$pollid) and (voteid=$i) and (language_id=$languages_id)");
              if ($result=tep_db_fetch_array($query)) {
                              if ($result['optiontext']) {
                       $content.= "<tr class=\"pollOptRow\"><td class=\"pollBoxRow\"><input type=\"radio\" name=\"voteid\" value=\"".$i."\" class=\"radio\"></td><td class=\"pollBoxRow\">".$result['optiontext']."</td></tr>";
                       }
                    }
        }
        $content .= "<tr class=\"pollFooter\"><td colspan=\"2\"><center><input type=\"submit\" value=\""._VOTE."\"></center>\n</td></tr>";
        $query=tep_db_query("select sum(optioncount) as sum from phesis_poll_data where pollid=$pollid");
        $query1=tep_db_query("select count(pollid) as comments from phesis_comments where pollid=$pollid and language_id=$languages_id");
        $result1 = tep_db_fetch_array($query1);
        $comments1  = $result1['comments'];
        if ($result=tep_db_fetch_array($query)) {
                $sum=$result['sum'];
        }
        $content .= "<tr class=\"pollFooter\"><td colspan=\"2\" class=\"pollBoxText\"><center>[ <a href=\"" . tep_href_link('pollbooth.php', 'op=results&pollid=' .$pollid, 'NONSSL')."\">"._RESULTS."</a> | <a href=\"" .tep_href_link('pollbooth.php', 'op=list')."\">"._POLLS."</a> ]</td></tr>";
        $content .= "<tr class=\"pollFooter\"><td class=\"pollBoxText\"><center>" . $sum . " "._VOTES."</center>\n</td><td class=\"pollBoxText\"><center>" . $comments1  . " "._COMMENTS."</center>\n</td></tr>";
$info_box_contents = array();
$info_box_contents[] = array('form' => '<form name="poll" method="post" action="'. tep_href_link('pollcollect.php') .'">',
                               'align' => 'left',
                               'text'  =>   $content
                              );
 new infoBox($info_box_contents);
?>
