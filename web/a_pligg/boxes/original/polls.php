<!-- polls //-->
<?php
require(DIR_WS_LANGUAGES . $language . '/pollbooth.php');
  $hide = tep_hide_session_id();

	function pollnewest() {
        global $customer_id, $HTTP_GET_VARS;
        if (DISPLAY_POLL_HOW==3) {
                $extra_query=" and pollID='" . DISPLAY_POLL_ID . "'";
                }
        if (!isset($customer_id)) {
                $extra_query.=" and poll_type='0' ";
                }
        if (DISPLAY_POLL_HOW==2) {
                $order = 'voters DESC';
                 } else {
                $order = 'timestamp DESC';
                }
        $query= tep_db_query("select pollid, catID FROM phesis_poll_desc where poll_open='0'".$extra_query."and catID != 0 order by ".$order);
        $count=tep_db_num_rows($query);
        $result = tep_db_fetch_array($query);
        $pollid = false;
        if ($count>0) {
           if ($HTTP_GET_VARS['cPath']) $mypath = $HTTP_GET_VARS['cPath'];
           if ($HTTP_GET_VARS['products_id'])$mypath = tep_get_product_path($HTTP_GET_VARS['products_id']);
           if ($mypath) {
             $sub_cat_ids = split("[_]", $mypath);
             for ($i = 0; $i < count($sub_cat_ids); $i++) {
               if ($sub_cat_ids[$i] == $result['catID']) $pollid = $result['pollid'];
             }
           }
        }
		if(empty($HTTP_GET_VARS['cPath'])){
		$catid=0;
		}
		if($HTTP_GET_VARS['cPath']) {
		$mypath = $HTTP_GET_VARS['cPath'];
		list($catid, $subcatid)=split("[_]", $mypath);
		//echo $catid;
		}

		$query= tep_db_query("select pollid, catID FROM phesis_poll_desc where poll_open='0'".$extra_query." and catID = ".$catid ." order by ".$order);

        $count=tep_db_num_rows($query);
               if ((!DISPLAY_POLL_HOW==0 || $count==1) && !$pollid) {
                if ($result=tep_db_fetch_array($query)) {
                        $pollid = $result['pollid'];
                }
        } elseif (!$pollid) {
                mt_srand((double) microtime() * 1000000);
                $rand = mt_rand(1,$count);
                for($i=0;$i<$rand;$i++) {
                        $result=tep_db_fetch_array($query);
                        $pollid = $result['pollid'];
                        }
        }
        return $pollid;
}
if (basename($PHP_SELF) !='pollbooth.php') {
$pollid=pollnewest();
if ($pollid) {
?>
<?php
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
        $content = "<table><tr><td colspan=\"2\" class=\"main\"><h4>" . $title['optionText'] . "</h4></td></tr>";
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
        $content .= "<tr class=\"pollFooter\"><td colspan=\"2\"><center><input class=\"cssbutton\" type=\"submit\" value=\""._VOTE."\"></center>\n</td></tr>";
        $query=tep_db_query("select sum(optioncount) as sum from phesis_poll_data where pollid=$pollid");
        $query1=tep_db_query("select count(pollid) as comments from phesis_comments where pollid=$pollid and language_id=$languages_id");
        $result1 = tep_db_fetch_array($query1);
        $comments1  = $result1['comments'];
        if ($result=tep_db_fetch_array($query)) {
                $sum=$result['sum'];
        }
        $content .= "<tr class=\"pollFooter\"><td colspan=\"2\" class=\"pollBoxText\"><center>[ <a href=\"pollbooth.php?op=results&pollid=$pollid\"><u>"._RESULTS."</u></a> ]</td></tr>";
        $content .= "<tr class=\"pollFooter\"><td class=\"pollBoxText\"><center>" . _VOTES . ": " . $sum . "</center>";
//jsp:stop:ankety
//        $content .= "\n</td><td class=\"pollBoxText\"><center>" . $comments1  . " "._COMMENTS."</center>\n</td>";
        $content .= "</tr></table>";
$info_box_contents = array();
$info_box_contents[] = array('form' => '<form name="poll" method="post" action="'. tep_href_link('pollcollect.php') .'">',
                               'align' => 'left',
                               'text'  =>   $content
                              );
 new infoBox($info_box_contents);
?>
        </td>
  </tr>
<?php
} elseif (SHOW_NOPOLL==1) {
?>
  <tr>
        <td>
<?php
$info_box_contents = array();
$info_box_contents[] = array('align' => 'center',
                               'text'  => _NOPOLLS
                            );
new infoBoxHeading($info_box_contents, false, false);
$info_box_contents = array();
$info_box_contents[] = array('align' => 'center',
                              'text'  => _NOPOLLSCONTENT
                             );
new infoBox($info_box_contents);
?>
        </td>
<?php
}
}
?>
<!-- polls-eof //-->