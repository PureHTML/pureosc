<?php
/*
  $Id: wp.php,v 1.2 2006/10/26 12:26:32 Exp $

  Wordpress Latest News Contribution by shindakun (steve at shindakun.net)
  *Released With No Guaranteed Support Or Warranty*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

/**********************************************
BEGIN CONFIG SECTION
**********************************************/
$category = '3';
$use_nicenick = true;
/**********************************************
END CONFIG SECTION
**********************************************/

function convert_datetime($datestamp, $format) {
    if ($datestamp!=0) {
        list($date, $time)=split(" ", $datestamp);
        list($year, $month, $day)=split("-", $date);
        list($hour, $minute, $second)=split(":", $time);
        $stampeddate=mktime($hour,$minute,$second,$month,$day,$year);
        $datestamp=date($format,$stampeddate);
        return $datestamp;
    }
}
$wp_term_relationships_query = tep_db_query("select c.object_id from wp_terms a, wp_term_taxonomy b, wp_term_relationships c, wp_posts d where a.term_id = '$category' and a.term_id=b.term_id and b.term_taxonomy_id=c.term_taxonomy_id and c.object_id=d.id and d.post_status='publish' order by object_id desc limit 1");
$wp_term_relationships = tep_db_fetch_array($wp_term_relationships_query);
$getpost =  $wp_term_relationships['object_id'];
$wp_post_query = tep_db_query("select * from wp_posts WHERE id = '$getpost' limit 1");
$wp_post = tep_db_fetch_array($wp_post_query);
$getauthor =  $wp_post['post_author'];

$char=array("Â");
$charto=array("");
$oscpost=rtrim(str_replace($char, $charto, $wp_post['post_content']));

if ($use_nicenick == true) {
	$wp_author_query = tep_db_query("select * from wp_users WHERE id = '$getauthor' limit 1");
	$wp_author = tep_db_fetch_array($wp_author_query);
	$wp_email_query = tep_db_query("select * from wp_users WHERE id = '$getauthor' limit 1");
	$wp_email = tep_db_fetch_array($wp_email_query);
} else { 
	$wp_author_query = tep_db_query("select * from wp_usermeta WHERE user_id = '$getauthor' AND meta_key = 'first_name' limit 1");
	$wp_author = tep_db_fetch_array($wp_author_query);
	$wp_email_query = tep_db_query("select * from wp_users WHERE id = '$getauthor' limit 1");
	$wp_email = tep_db_fetch_array($wp_email_query);
}

$post_date = convert_datetime($wp_post['post_date'], "F j, Y  g:ia");

  $info_box_contents = array();
  $info_box_contents[] = array('text' => $wp_post['post_title']." (". $post_date . ")");

?>
<!-- / wordpress contrib by shindakun / !-->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
<td><?php  new infoBoxHeading($info_box_contents, false, true, $wp_post['guid']);?></td>
  </tr>
</table>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
  <tr>
    <td class="smallText" valign="top"><?php echo $oscpost;?></td>
  </tr>
  <tr>
    <td class="infoBoxHeading" valign="top"><div align="right">blogged by <a href="mailto:<?php echo $wp_email['user_email'];?>"><?php if ($use_nicenick == true) {echo $wp_author['user_nicename'];} else {echo $wp_author['meta_value'];}?></a></div></td>
  </tr>
</table>