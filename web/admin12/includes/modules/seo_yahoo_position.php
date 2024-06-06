<?php
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  08.03.2004
  Originally Created by: Jack York
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
*/ 
	if(!$firstpass && !empty($searchquery) && !empty($searchurl))
  {	 
    $conditions = "<em class=yschurl>(.*)</em>";
  	$hits_per_page = 100;
    $siteName = 'Yahoo';

    require(DIR_WS_MODULES . 'seo_position.php');
 
    $found_yahoo = $found;
    $siteresults_yahoo = $siteresults;

  	if($found_yahoo)
  	{
  		$result_yahoo = "The site $searchurl is at position $found_yahoo ".
  			  "( $real_position ) for the term <b>$searchquery</b>" . " on " . "$siteName";
                          
      $edited_searchquery = str_replace("'", "''", $searchquery);
                                                                 		 		
      $yahoo_prev_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_YAHOO . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;
      $yahoo_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_YAHOO . " where search_url = '$searchurl'" . " AND search_term = '$edited_searchquery'" . " AND rank != 99999" . " ORDER BY date ASC") or die("Query failed");;

			if (mysql_num_rows($yahoo_query) < $maxEntries) 
			{
			  tep_db_query("insert into " . TABLE_SEO_YAHOO . "(date, search_url, search_term, rank, sites_searched ) values	(now(), '". $searchurl ."', '" . $edited_searchquery . "', '". $found_yahoo ."', '". $searchtotal ."' )      ");
			} 
			else 
			{	
			   $whichRow = 0;
				$maxRow = 1;
				$latestDate = '';
				$nextDate = '';
				$firstDate = '';
					
        while ($yahoo = tep_db_fetch_array($yahoo_query)) 
			  {
	    		if (empty($firstDate))
 				     $firstDate = $yahoo['date'];
						 
	  		   if (strcmp($latestDate, $yahoo['date']) < 0 ) 
					{
					   $latestDate = $yahoo['date'];	 
						 $whichRow =$maxRow;	
			      }		
					elseif (empty($nextDate))
					{
					   $nextDate = $yahoo['date'];
					}
			      $maxRow++;	  				 		
			  }
	
			  $latestDate = ($whichRow == mysql_num_rows($yahoo_query)) ? $firstDate : $nextDate;			
	      tep_db_query("update " . TABLE_SEO_YAHOO . " set search_url = '" . $searchurl . "', search_term = '" . $searchquery . "', rank = " . $found_yahoo . ", sites_searched = " . (int)$searchtotal . ", date = now()" . " where search_url = '" . $searchurl . "' and search_term = '" . $searchquery . "' and date = '" . $latestDate ."'");
			}
	 	}
  	else
  	{
  		$result_yahoo = "The site $searchurl is not in the top $searchtotal ".
  			             "for the term <b>$searchquery</b>" . " on " . "$siteName";
  	}
  }
?>