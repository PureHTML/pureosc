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
    $conditions = "<span class=a>(.*)</span><nobr>";
    
  	$hits_per_page = 10;
    $siteName = 'Google'; 
    
    require(DIR_WS_MODULES . 'seo_position.php');
 
    $found_google = $found;
    $siteresults_google = $siteresults;

  	if($found_google)
  	{
  		$result_google = "The site $searchurl is at position $found_google ".
  			  "( $real_position ) for the term <b>$searchquery</b>" . " on " . "$siteName";
      $edited_searchquery = str_replace("'", "''", $searchquery);
				
	    $google_prev_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_GOOGLE . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;
        $google_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_GOOGLE . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;

			if (mysql_num_rows($google_query) < $maxEntries) 
			{
			  tep_db_query("insert into " . TABLE_SEO_GOOGLE . "(date, search_url, search_term, rank, sites_searched ) values	(now(), '". $searchurl ."', '" . $edited_searchquery . "', '". $found_google ."', '". $searchtotal ."' )      ");
			} 
			else 
			{	
			   $whichRow = 0;
				$maxRow = 1;
				$latestDate = '';
				$nextDate = '';
				$firstDate = '';
					
        while ($google = tep_db_fetch_array($google_query)) 
			  {
				   if (empty($firstDate))
				    $firstDate = $google['date'];
					
	  		   if (strcmp($latestDate, $google['date']) < 0 ) 
					{
					   $latestDate = $google['date'];	 
					 $whichRow =$maxRow;	
			      }		
					elseif (empty($nextDate))
					{
					   $nextDate = $google['date'];
					}
			      $maxRow++;	  				 		
			  }
	
			  $latestDate = ($whichRow == mysql_num_rows($google_query)) ? $firstDate : $nextDate;			
			  tep_db_query("update " . TABLE_SEO_GOOGLE . " set search_url = '" . $searchurl . "', search_term = '" . $searchquery . "', rank = " . $found_google . ", sites_searched = " . (int)$searchtotal . ", date = now()" . " where search_url = '" . $searchurl . "' and search_term = '" . $searchquery . "' and date = '" . $latestDate ."'");
			}
	 	}
  	else
  	{
  		$result_google = "The site $searchurl is not in the top $searchtotal ".
  			              "for the term <b>$searchquery</b>" . " on " . "$siteName";
  	}
  }
?>