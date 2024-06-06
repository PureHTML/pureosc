<?php 
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  08.03.2004
  Originally Created by: Jack_mcs
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
*/
	if(!$firstpass && !empty($searchquery) && !empty($searchurl))
  {	 
    $conditions = "<li class=\"first\">(.*)</li>";
   	$hits_per_page = 20;
    $siteName = 'msn';
    
    require(DIR_WS_MODULES . 'seo_position.php');
    
    $found_msn = $found;
    $siteresults_msn = $siteresults;
     
  	if($found_msn)
  	{
  		$result_msn = "The site $searchurl is at position $found_msn ".
  			  "( $real_position ) for the term <b>$searchquery</b>" . " on " . "$siteName";
				
      $edited_searchquery = str_replace("'", "''", $searchquery);
  
	    $msn_prev_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_MSN . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;
      $msn_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_MSN . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;

			if (mysql_num_rows($msn_query) < $maxEntries) 
			{
			  tep_db_query("insert into " . TABLE_SEO_MSN . "(date, search_url, search_term, rank, sites_searched ) values	(now(), '". $searchurl ."', '" . $edited_searchquery . "', '". $found_msn ."', '". $searchtotal ."' )      ");
			} 
			else 
			{	
			   $whichRow = 0;
				$maxRow = 1;
				$latestDate = '';
				$nextDate = '';
				$firstDate = '';
					
        while ($msn = tep_db_fetch_array($msn_query)) 
			  {
				   if (empty($firstDate))
				    $firstDate = $msn['date'];
					
	  		   if (strcmp($latestDate, $msn['date']) < 0 ) 
					{
					   $latestDate = $msn['date'];	 
					   $whichRow =$maxRow;	
			      }		
					elseif (empty($nextDate))
					{
					   $nextDate = $msn['date'];
					}
			      $maxRow++;	  				 		
			  }
	
			  $latestDate = ($whichRow == mysql_num_rows($msn_query)) ? $firstDate : $nextDate;			
			  tep_db_query("update " . TABLE_SEO_MSN . " set search_url = '" . $searchurl . "', search_term = '" . $searchquery . "', rank = " . $found_msn . ", sites_searched = " . (int)$searchtotal . ", date = now()" . " where search_url = '" . $searchurl . "' and search_term = '" . $searchquery . "' and date = '" . $latestDate ."'");
			}
	 	}
  	else
  	{
  		$result_msn = "The site $searchurl is not in the top $searchtotal ".
  			           "for the term <b>$searchquery</b>" . " on " . "$siteName";
  	}
  }
?>