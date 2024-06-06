<tr><td><table border='1' align='center' bordercolor="#ff9933" cellpadding="1" cellspacing="0">
 <?php
                $result=tep_db_query("SELECT pollid, timestamp, voters, poll_type, poll_open FROM phesis_poll_desc ORDER BY timestamp desc");
                $row=0;
                while ($polls=tep_db_fetch_array($result)) {
                        $row++;
                        $idpoll=$polls['pollid'];
                        if (($row / 2) == floor($row / 2)) {
?>
                        <tr class="Payment-even">
<?php
                } else {
?>
                        <tr class="Payment-odd">
<?php
                }
                        $title_query = tep_db_query("SELect optionText from phesis_poll_data where pollid='".$idpoll."' and voteid='0' and language_id = '" . $languages_id . "'");
                        $title = tep_db_fetch_array($title_query);
                $fullresults="<a href=\"".tep_href_link('pollbooth.php','op=results&pollid='.$idpoll,'NONSSL')."\"><u>"._POLLRESULTS."</u></a>";
                $result1 = tep_db_query("SELECT SUM(optioncount) AS sum FROM phesis_poll_data WHERE pollid='".$idpoll."'");
                $poll_sum=tep_db_fetch_array($result1);
                $sum=$poll_sum['sum'];
                $query1=tep_db_query("select count(pollid) as comments from phesis_comments where pollid='".$idpoll."' and language_id='".$languages_id."'");
                $result1 = tep_db_fetch_array($query1);
                $comments = $result1['comments'];
                echo("<td class=\"main\" align=\"center\">&nbsp;<b>".$title['optionText']."&nbsp;</b></td><td class=\"main\" align=\"center\">".$sum." "._VOTES."</td><td class=\"main\" align=\"center\">".$comments." "._COMMENTS."</td><td class=\"main\" align=\"center\">".$fullresults."</td>");
                if ($polls['poll_type']=='0') {
                        echo ("<td class=\"main\" align=\"center\">"._PUBLIC."</td>");
                          } else {
                        echo ("<td class=\"main\" align=\"center\">"._PRIVATE."</td>");
                        }
                if ($polls['poll_open']=='0') {
                        echo ("<td class=\"main\" align=\"center\">"._POLLOPEN."</td>");
                          } else {
                        echo ("<td class=\"main\" align=\"center\">"._POLLCLOSED."</td>");
             }
        }
?>
</table></td></tr>

