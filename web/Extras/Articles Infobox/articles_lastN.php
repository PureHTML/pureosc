<tr>
   <td>
<?php
/* // quickly put together by George Chorny
// all cudos to the maker(s) of the original Article Manager v1.0

// displays the last n number of articles, specifically the titles and a short
// description. Note: this is to be saved as an infobox (includes/boxes) and 
// called via <? require(DIR_WS_BOXES . 'articles_lastN.php'); ?>

// and now some variables */
$theN = "3"; // grab this many latest articles
$wrapLimit = "120"; // limit the short desc to this num of chars

// -- do not modify below unless you know what you're doing!!! --
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_ARTICLES);

  //new InformationBoxHeading($info_box_contents, true, true);
  new infoBoxHeading($info_box_contents, false, false);  
  $info_box_contents = array();
  $row = 0;
  $articles_lastN = array();
  $articles_lastN_sql = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, ad.language_id
  	from articles a, articles_description ad 
	where a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "'
	order by a.articles_date_added desc, ad.articles_name 
	limit " . (int)$theN . " ";
  $articles_lastN_query = tep_db_query($articles_lastN_sql);
        while ($articles_lastN = tep_db_fetch_array($articles_lastN_query)) {
	      $row++;
	      $lastN .= '<a href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $articles_lastN['articles_id']) . '">' . $articles_lastN['articles_name'] . '</a>';
	      $lastN .= '<br />';
	      	$articles_head_desc_tag = preg_split("/\n/", wordwrap($articles_lastN['articles_head_desc_tag'],$wrapLimit));
	      $lastN .= '&nbsp;&nbsp;&nbsp;' . $articles_head_desc_tag[0] . '...';
	      //$lastN .= '&nbsp;&nbsp;&nbsp;' .wordwrap($articles_lastN['articles_head_desc_tag'],50);
	      $lastN .= '<br /><br />';
	}
$lastN .= '</td></tr><tr><td align="right"><a href="' . tep_href_link(FILENAME_ARTICLES, '','NONSSL') . '">' . BOX_ALL_ARTICLES . '</a>';
$info_box_contents[] = array('text' => $lastN);
//new InformationBox($info_box_contents);
new infoBox($info_box_contents);
?>
   </td>
</tr>