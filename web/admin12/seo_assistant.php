<?php
/*
  $Id: SEO_Assistant.php,v 1.7 07/08/2004 - 12/17/2006
  SEO Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 
  require('includes/application_top.php');
  require(DIR_WS_FUNCTIONS . FILENAME_SEO_ASSISTANT);


  if( ! ((bool)ini_get('safe_mode')) )
    set_time_limit(0); 
  
  $maxEntries = '10';
  $google_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_GOOGLE ) or die("Query failed");;
  $google = tep_db_fetch_array($google_query);
	
  $searchurl = tep_db_prepare_input($_POST['search_url_google']);
 	if (empty($searchurl)) {
	  $firstpass = true;
    $searchurl = $google['search_url'];
	}
	else 
	  $firstpass = false;
		
  $searchquery = tep_db_prepare_input($_POST['search_term_google']);
  if (empty($searchquery))
    $searchquery = $google['search_term'];

  $searchtotal = tep_db_prepare_input($_POST['search_total_google']);
  if (empty($searchtotal))
    $searchtotal = $google['sites_searched'];

  $search_google = ($_POST['searchGoogle'] == 'on') ? 1 : 0;
  $search_msn = ($_POST['searchMsn'] == 'on') ? 1 : 0;
  $search_yahoo = ($_POST['searchYahoo'] == 'on') ? 1 : 0;
  $showlinks = ($_POST['show_links'] == 'on') ? 1 : 0;
  $showhistory = ($_POST['show_history'] == 'on') ? 1 : 0;

  // SIDS SECTION  
  $searchSids_google = ($_POST['searchsidsGoogle'] == 'on') ? 1 : 0;
  $searchSids_msn = ($_POST['searchsidsMsn'] == 'on') ? 1 : 0;
  $searchSids_yahoo = ($_POST['searchsidsYahoo'] == 'on') ? 1 : 0;
  $showsidlinks = ($_POST['show_sid_links'] == 'on') ? 1 : 0;
    
  $showsupplementalLinks = ($_POST['show_supplemental_links'] == 'on') ? 1 : 0;
    
	$yahoo_query = tep_db_query("select search_url, search_term, rank, sites_searched, date from " . TABLE_SEO_YAHOO ) or die("Query failed");;
  $yahoo = tep_db_fetch_array($yahoo_query);
	 		
	$action_google = (isset($_POST['search_url_google']) ? $_POST['search_url_google'] : '');
  $action_rank = (isset($_POST['rank_url']) ? $_POST['rank_url'] : '');
  $action_linkpop = (isset($_POST['linkpop_url']) ? $_POST['linkpop_url'] : '');
  $action_kwdensity = (isset($_POST['density_url']) ? $_POST['density_url'] : '');
  $action_check_links = (isset($_POST['check_page']) ? $_POST['check_page'] : '');
  $action_header = (isset($_POST['header_url']) ? $_POST['header_url'] : '');
  $action_check_sids = (isset($_POST['check_sids']) ? $_POST['check_sids'] : '');
  $action_supplemental = (isset($_POST['supplementalURL']) ? $_POST['supplementalURL'] : '');

  /************* Get spiders setting for Check SID's section ****************/ 
  $configuration_query = tep_db_query("select configuration_id, configuration_title, configuration_value, use_function from " . TABLE_CONFIGURATION . " where configuration_title like 'Prevent Spider Sessions'");
  $configuration = tep_db_fetch_array($configuration_query);      
  $spidersOption = $configuration['configuration_value'];

  /********* POSITION SEARCH *********/
	if (tep_not_null($action_google)) {
    $searchurl = GetSearchURL($searchurl);
    if ($search_google) require(DIR_WS_MODULES . 'seo_google_position.php');
    if ($search_msn)    require(DIR_WS_MODULES . 'seo_msn_position.php');
    if ($search_yahoo)  require(DIR_WS_MODULES . 'seo_yahoo_position.php');
            
  /********* PAGE RANL *********/    
	}	elseif (tep_not_null($action_rank))	{
	  $rank_url = GetSearchURL(tep_db_prepare_input($_POST['rank_url']));

 	  if (! empty($rank_url)) {
	    if (! ($pageRank = getPR($rank_url))) {
		   $error = 'Failed to read url: '.$rank_url;
	     $messageStack->add($error);
	    }
	    $prRating = array("Very poor","Poor","Below average","Average","Above Average","Good","Good","Very Good","Very Good","Excellent","> Excellent");
	 	} 
	  else
	    $pageRank ='';
      
  /********* LINK POPULARITY *********/      
	}	elseif (tep_not_null($action_linkpop)) { 
	 require(DIR_WS_FUNCTIONS . 'seo_link_popularity.php');
	 $link_1_url = GetSearchURL(tep_db_prepare_input($_POST['linkpop_url']));
   $link_2_url = GetSearchURL(tep_db_prepare_input($_POST['linkpop_2_url']));
   
   if (empty($link_2_url)) {
	  $link_url = $link_1_url; 
		$show_second_link = false; 
	 } else {
 	  $link_url = $link_2_url;
		$show_second_link = true; 
	 }	 
	 
	 $total = 0;
	 $results = array();	 
   if ( ! ($results = get_link_popularity($link_url))) {
	  $error = 'Failed to read url: '.$rank_url;
	  $messageStack->add($error);
	 }
	
	 if (! empty($link_2_url)) {
	 	 $results_2 = $results;
	   $total_2 = $total;
	   reset($results);
	   $total = 0;
	   $link_url = $link_1_url;
	    
     if ( ! ($results = get_link_popularity($link_url))) {
	    $error = 'Failed to read url: '.$rank_url;
	    $messageStack->add($error);
	   }
	 } 
	}
  
  /********* KEYWORD DENSITY *********/  
	elseif (tep_not_null($action_kwdensity)) {
	 $density_url = GetSearchURL(tep_db_prepare_input($_POST['density_url']));
	 $use_meta_tags = tep_db_prepare_input($_POST['use_meta_tags']);
   $use_partial_total = tep_db_prepare_input($_POST['use_partial_total']);
	 require(DIR_WS_FUNCTIONS . 'seo_density.php');
	 $ttl_words = 0;	
	 if (! empty($density_url)) {
	   if (! ($dens = kda($density_url, $ttl_words, $use_meta_tags, $use_partial_total))) {
	     $error = 'Failed to read url: '.$density_url;
	     $messageStack->add($error);
	   }
	 }
	}
  
  /********* LINK CHECK *********/  
  elseif (tep_not_null($action_check_links)) {
   $badLinks = array();
   $idx = 0;
   $totalLinks = 0;
  
   $url = tep_db_prepare_input($_POST['check_page']);
   if (FALSE === strpos($url, 'http://'))
      $link = 'http://'.$url;  
   CheckLinks($link, $idx);
   
   /*
   $files = ListFiles();
   for($i=0; $i<count($files); $i++)  
   { 
      if (FALSE === strpos($files[$i], '.php')  || FALSE !== strpos($files[$i], 'search') ||
          FALSE !== strpos($files[$i], 'login') || FALSE !== strpos($files[$i], 'checkout_') )
         continue; 
   //   echo $files[$i].'<br />';  
    $link = $url . $files[$i];
   
    break;       
   } 
   */
  }
  
  /********* HEADER STATUS *********/    
	elseif (tep_not_null($action_header))	{
    $headerInfo = array();
	  $header_url = tep_db_prepare_input($_POST['header_url']);
    include(DIR_WS_MODULES . 'seo_header.php');
  }
  
  /********* CHECK SIDS *********/    
	elseif (tep_not_null($action_check_sids))	{
    $checksidstotal = tep_db_prepare_input($_POST['searchcount_check_sids']);
   
    if (! empty($checksidstotal))
    {
	    $searchurl = tep_db_prepare_input($_POST['check_sids']);
      $searchurl = GetSearchURL($searchurl);
      
      if ($searchSids_google) { $siteName = 'Google'; 
                                $foundSID_Google = 0;
                                $hits_per_page = 10;  
                                $sidURL_Google = array();
                                $totalLinks_Google = 0;
                                include(DIR_WS_MODULES . 'seo_check_sids.php'); 
                              }
      if ($searchSids_msn)    { $siteName = 'msn';    
                                $foundSID_Msn = 0;
                                $hits_per_page = 20;  
                                $sidURL_Msn = array();
                                $totalLinks_Msn = 0;
                                include(DIR_WS_MODULES . 'seo_check_sids.php'); 
                              }
      if ($searchSids_yahoo)  { $siteName = 'Yahoo';  
                                $foundSID_Yahoo = 0;
                                $hits_per_page = 100; 
                                $sidURL_Yahoo = array();
                                $totalLinks_Yahoo = 0;
                                include(DIR_WS_MODULES . 'seo_check_sids.php'); 
                              }

    }  
  }
  
  /********* CHECK SUPPLEMENTAL *********/    
	elseif (tep_not_null($action_supplemental))	{
    $supplementaltotal = tep_db_prepare_input($_POST['searchcount_supplemental']);
   
    if (! empty($supplementaltotal))
    {
	    $searchurl = tep_db_prepare_input($_POST['supplementalURL']);
      $searchurl = GetSearchURL($searchurl);
        
      $foundSupplemental_Google = 0;
      $hits_per_page = 10;  
      $supplementalURL_Google = array();
      $totalSupplementalLinks_Google = 0;
      include(DIR_WS_MODULES . 'seo_check_supplemental.php');
    }
  }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<style type="text/css">
td.seoHead, a.seoHead, a.seoHead:hover {font-family: Verdana, Arial, sans-serif; font-size: 22px;  font-weight: bold;  color: sienna; text-decoration: none;}
td.seo_subHead {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px; font-weight: bold; } 
td.seo_section {font-family: Verdana, Arial, sans-serif; font-size: 11px; line-height: 1.5; }

#seo_ul {
 font-family: Verdana, Arial, sans-serif;
 font-size: 11px;  
 float: left;
 padding-left: 20;  
 border: 0;
 margin: 0;
}
#seo_ul a {
 font-family: Tahoma, Verdana, Arial, sans-serif;
 font-size: 11px;  
 color: sienna;
 text-decoration: none;
 padding: 0;	
 border: 0;
 margin: 0;
}
#seo_ul a:hover {
 color: #ff0000;
 text-decoration: underline;
}
</style>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
  		 <!-- BEGIN GOOGLE CODE --> 
		   <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="seoHead"><?php echo HEADING_TITLE; ?></td>
          </tr>		
          <tr>
           <td class="seo_section"><?php echo HEADING_TITLE_SUB; ?></td>
          </tr>  
		      <tr> 
		       <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
          </tr>				          
          <tr>
           <td align="center"><table border="0" width="100%" cellpadding="2" cellspacing="2">
            <tr>
             <td>
              <ul id="seo_ul">
               <li><a title="Index Position" href="<?php echo PageLink('index'); ?>"> Index Position</a></li>
               <li><a title="Page Rank" href="<?php echo PageLink('pagerank'); ?>"> Page Rank</a></li>
              </ul>   
             </td>
             <td>
              <ul id="seo_ul">
               <li><a title="Link Popularity" href="<?php echo PageLink('linkpop'); ?>"> Link Popularity</a></li>
               <li><a title="Keyword Density" href="<?php echo PageLink('density'); ?>"> Keyword Density</a></li>
              </ul>  
             </td>
             <td>
              <ul id="seo_ul">
               <li><a title="Check Links" href="<?php echo PageLink('checklinks'); ?>"> Check Links</a></li>
               <li><a title="Header Status" href="<?php echo PageLink('headerstatus'); ?>"> Header Status</a></li>
              </ul>  
             </td>      
             <td>
              <ul id="seo_ul">
               <li><a title="Check Sids" href="<?php echo PageLink('checksids'); ?>"> Check SIDS</a></li>
               <li><a title="Supplemental" href="<?php echo PageLink('supplemental'); ?>"> Supplemental Links</a></li>
              </ul>  
             </td>                        
            </tr>
           </table><td>
          </tr>           		                     
   			 <tr>
  			  <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr> 
             <td>&nbsp;</td>
             <td align="right"> <?php echo tep_draw_form('google', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action')) . 'action=' . $form_action, 'post' ); ?></td>
	          </tr>             
  		  	   <tr>
             <td><?php echo tep_black_line(); ?></td>
            </tr>          
             <td class="seo_subHead"><?php echo HEADING_TITLE_INDEX; ?></td>
            </tr>	
            <tr>
             <td class="seo_section"><?php echo TEXT_POSITION; ?></td>
            </tr>    
			      <tr> 
		    	    <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
            </tr>                         
			      <tr class="infoBoxContents">
             <td><table border="0" cellspacing="2" cellpadding="2">
				     <tr>
			         <td class="seo_section"><p><?php echo TEXT_TOTAL_SEARCHES; ?></p></td>
               <td><?php echo tep_draw_input_field('search_total_google', tep_not_null($searchtotal) ? $searchtotal : '100', 'maxlength="255"', false); ?> </td>
              </tr>
			        <tr>
		           <td class="seo_section"><p><?php echo TEXT_SEARCH_TERM; ?></p></td>
               <td><?php echo tep_draw_input_field('search_term_google', tep_not_null($searchquery) ? $searchquery : 'search word', 'maxlength="255"', false); ?> </td>
              </tr>
              <tr> 
				       <td class="seo_section"><?php echo TEXT_SEARCH_URL; ?></td>
               <td><?php echo tep_draw_input_field('search_url_google', tep_not_null($searchurl) ? $searchurl : 'http://', 'maxlength="255" size="40"',   false); ?> </td>
    	        </tr>
             </table></td>
            </tr>
			      <tr> 
			       <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
            </tr>						
 			      <tr class="infoBoxContents">
             <td><table border="0" cellspacing="2" cellpadding="2">
              <tr> 
			  		   <td class="seo_section"><?php echo TEXT_SEARCH; ?></td>
               <td><?php echo tep_draw_checkbox_field('searchGoogle', '', false, ''); ?> </td>
	 					<td class="seo_section"><?php echo TEXT_GOOGLE; ?>&nbsp;</td>
               <td><?php echo tep_draw_checkbox_field('searchMsn', '', false, ''); ?> </td>
	 					<td class="seo_section"><?php echo TEXT_MSN; ?>&nbsp;</td>
               <td><?php echo tep_draw_checkbox_field('searchYahoo', '', false, ''); ?> </td>
	 					<td class="seo_section"><?php echo TEXT_YAHOO; ?>&nbsp;</td>
              </tr>
             </table></td>
            </tr>
             
				   <tr class="infoBoxContents">
             <td><table border="0" cellspacing="2" cellpadding="2">
              <tr> 
			  		   <td class="seo_section"><?php echo TEXT_SHOW_RESULTS; ?></td>
               <td ><?php echo tep_draw_checkbox_field('show_links', '', false, ''); ?> </td>
	 					<td>&nbsp;</td>
						<td class="seo_section"><?php echo TEXT_SHOW_HISTORY; ?></td>
               <td ><?php echo tep_draw_checkbox_field('show_history', '', false, ''); ?> </td>
	 					<td>&nbsp;</td>
						<td ><?php echo (tep_image_submit('button_search_google.png', IMAGE_SEARCH) ); ?></td>
              </tr>
             </table></td>             
            </tr>		
					 <?php if (tep_not_null($action_google) && $search_google) { ?>	
					<tr> 
			       <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
            </tr>	
					<tr>
            <td class="seo_section"><b><?php echo TEXT_GOOGLE; ?></b></td>
            </tr>
					<tr> 
             <td class="smallText" colspan="3"><?php print($result_google);?></td>
            </tr>
					<tr> 
				    <td>&nbsp;</td>
		        </tr>					 	
						<?php if ($found_google && $show_history && mysql_num_rows($google_prev_query)) {	?>	
						<tr>
						 <td><table border="1" cellpadding="3" width="100%">
               <tr>      
                <th class="smallText" align="center" width="20%"><?php echo "DATE"; ?></th>
          	    <th class="smallText" align="center" width="30%"><?php echo "URL"; ?></th>     
                <th class="smallText" align="center" width="5%"><?php echo "RANK"; ?></th> 
          		  <th class="smallText" align="center" width="45%"><?php echo "WORD(S)"; ?></th>    
               </tr>
						  </table></td>
						</tr> 
						<?php while ($google = tep_db_fetch_array($google_prev_query)) { ?>
	   				 <tr>
						  <td><table border="1" cellpadding="3" width="100%">                
			         <tr>
				       <td class="smallText" align="center" width="20%"><?php echo $google['date']; ?></td>
			          <td class="smallText" align="left" width="30%"><?php echo $google['search_url']; ?></td>
			          <td class="smallText" align="center" width="5%"><?php echo $google['rank']; ?></td>
			          <td class="smallText" align="left" width="45%"><?php echo $google['search_term']; ?></td>
		           </tr>	
							</table></td>
						 </tr>
			       <?php  } } 		
			       if ($showlinks) {
    			    for ($i = 0; $i<$searchtotal; $i++) { 	
						   $j = $i + 1;
					      if (empty($siteresults_google[$i]))
						     break;						 
			       ?>			
			       <tr>
						  <td><table>
               <tr>
						    <?php if (substr($siteresults_google[$i], 'https')) { ?> 
					  	   <td class="seo_section"><?php echo $j. ' ' .'<a   href="' . $siteresults_google[$i] . '" target="_blank">' . $siteresults_google[$i] . '</a>'; ?></td>
                <?php } else { ?>
		  	         <td class="seo_section"><?php echo $j. ' ' .'<a   href="' .'http://' . $siteresults_google[$i] . '" target="_blank">' . $siteresults_google[$i] . '</a>'; ?></td>
                <?php } ?>	
		           </tr>
              </table></td>
             </tr>		 
             <?php } } } ?>
						</form>
					 </table></td>	
					</tr>			

					<!-- BEGIN MSN CODE --> 
            </tr>		
 						<?php if (tep_not_null($action_google) && $search_msn) {	?>		
					<tr>
            <td class="seo_section"><b><?php echo TEXT_MSN; ?></b></td>
            </tr>
						<tr> 
             <td class="smallText" colspan="3"><?php print($result_msn);?></td>
            </tr>
						<tr> 
				     <td>&nbsp;</td>
		        </tr>				
						<?php if ($found_msn && $show_history && mysql_num_rows($msn_prev_query)) {	?>							 
						<tr>
						 <td><table border="1" cellpadding="3" width="100%">
              <tr>      
               <th class="smallText" align="center" width="20%"><?php echo "DATE"; ?></th>
          	   <th class="smallText" align="center" width="30%"><?php echo "URL"; ?></th>     
               <th class="smallText" align="center" width="5%"><?php echo "RANK"; ?></th> 
          	   <th class="smallText" align="center" width="45%"><?php echo "WORD(S)"; ?></th>    
              </tr>
						 </table></td>
						</tr>
						<?php while ($msn = tep_db_fetch_array($msn_prev_query)) { ?>
	   				<tr>
						 <td><table border="1" cellpadding="3" width="100%">                
			        <tr>
				       <td class="smallText" align="center" width="20%"><?php echo $msn['date']; ?></td>
			         <td class="smallText" align="left" width="30%"><?php echo $msn['search_url']; ?></td>
			         <td class="smallText" align="center" width="5%"><?php echo $msn['rank']; ?></td>
			         <td class="smallText" align="left" width="45%"><?php echo $msn['search_term']; ?></td>
		          </tr>	
						 </table></td>
						</tr>
			      <?php  } } 		
			      if ($showlinks) {
    			   for ($i = 0; $i<$searchtotal; $i++) { 	
						  $j = $i + 1;
				      if (empty($siteresults_msn[$i]))
						    break;						 
			      ?>			
			      <tr>
					   <td><table>
              <tr>
						   <?php if (substr($siteresults_msn[$i], 'https')) { ?> 
					      <td class="seo_section"><?php echo $j. ' ' .'<a   href="' . $siteresults_msn[$i] . '" target="_blank">' . $siteresults_msn[$i] . '</a>'; ?></td>
               <?php } else { ?>
		  	        <td class="seo_section"><?php echo $j. ' ' .'<a   href="' .'http://' . $siteresults_msn[$i] . '" target="_blank">' . $siteresults_msn[$i] . '</a>'; ?></td>
               <?php } ?>	
		          </tr>
             </table></td>
            </tr>		 
            <?php } } } ?>		
            					
					<!-- BEGIN YAHOO CODE --> 
            </tr>		
 						<?php if (tep_not_null($action_google) && $search_yahoo) {	?>		
					<tr>
            <td class="seo_section"><b><?php echo TEXT_YAHOO; ?></b></td>
            </tr>
					<tr> 
             <td class="smallText" colspan="3"><?php print($result_yahoo);?></td>
            </tr>
					<tr> 
				     <td>&nbsp;</td>
		        </tr>				
						<?php if ($found_yahoo && $show_history && mysql_num_rows($yahoo_prev_query)) {	?>							 
						<tr>
						 <td><table border="1" cellpadding="3" width="100%">
              <tr>      
               <th class="smallText" align="center" width="20%"><?php echo "DATE"; ?></th>
          	   <th class="smallText" align="center" width="30%"><?php echo "URL"; ?></th>     
               <th class="smallText" align="center" width="5%"><?php echo "RANK"; ?></th> 
          	   <th class="smallText" align="center" width="45%"><?php echo "WORD(S)"; ?></th>    
              </tr>
						 </table></td>
						</tr>
						<?php while ($yahoo = tep_db_fetch_array($yahoo_prev_query)) { ?>
	   				<tr>
						 <td><table border="1" cellpadding="3" width="100%">                
			        <tr>
				       <td class="smallText" align="center" width="20%"><?php echo $yahoo['date']; ?></td>
			         <td class="smallText" align="left" width="30%"><?php echo $yahoo['search_url']; ?></td>
			         <td class="smallText" align="center" width="5%"><?php echo $yahoo['rank']; ?></td>
			         <td class="smallText" align="left" width="45%"><?php echo $yahoo['search_term']; ?></td>
		          </tr>	
						 </table></td>
						</tr>
			      <?php  } } 		
			      if ($showlinks) {
    			   for ($i = 0; $i<$searchtotal; $i++) { 	
						  $j = $i + 1;
				      if (empty($siteresults_yahoo[$i]))
						    break;						 
			      ?>			
			      <tr>
					   <td><table>
              <tr>
						   <?php if (substr($siteresults_yahoo[$i], 'https')) { ?> 
					      <td class="seo_section"><?php echo $j. ' ' .'<a   href="' . $siteresults_yahoo[$i] . '" target="_blank">' . $siteresults_yahoo[$i] . '</a>'; ?></td>
               <?php } else { ?>
		  	        <td class="seo_section"><?php echo $j. ' ' .'<a   href="' .'http://' . $siteresults_yahoo[$i] . '" target="_blank">' . $siteresults_yahoo[$i] . '</a>'; ?></td>
               <?php } ?>	
		          </tr>
             </table></td>
            </tr>		 
            <?php } } } ?>				
         <tr>
          <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
 			 </tr>		  

        <!-- BEGIN RANK CODE --> 			
				<tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>	
				<tr>
         <td><?php echo tep_black_line(); ?></td>
        </tr>
				<tr>
				 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="seo_subHead"><?php echo HEADING_TITLE_RANK; ?></td>
          </tr>			
           <tr>
            <td class="seo_section"><?php echo TEXT_RANK; ?></td>
          </tr>		 
        </table></td>
				</tr>				
				<tr>
			   <td align="right" > <?php echo tep_draw_form('seotips', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action2')) . 'action2=' . $form_action, 'post' ); ?></td>
        </tr>          
			  <tr> 
			   <td width="10"><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
				<tr class="infoBoxContents">
         <td><table border="0" cellspacing="2" cellpadding="2">
          <tr> 
			  	 <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
           <td><?php echo tep_draw_input_field('rank_url', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	     <td ><?php echo (tep_image_submit('button_admin_get_page_rank.png', IMAGE_GET_PAGE_RANK) ); ?></td>
			  	</tr> 
				  <?php if (! empty($pageRank)) { ?>
			 		<tr>
					 <td class="seo_section"><?php echo TEXT_PAGE_RANK; ?></td>
				     <td class="seo_section"><?php echo sprintf("%d ( %s )",$pageRank, $prRating[(int)$pageRank]); ?> </td>
				   </tr>
				   <tr>
				     <td class="seo_section"><?php echo TEXT_CHECKSUM; ?></td>
				     <td class="seo_section"><?php echo sprintf("%s", CheckSum($rank_url)); ?> </td>
				   </tr>
				  <?php } ?>
			   </table></td>				 
				</tr>					 		  
      </form>
      <tr>
       <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
      </tr>
			<!-- END RANK CODE --> 
			
			<!-- BEGIN LINK POPULARITY CODE --> 			
			<tr> 
			 <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
      </tr>	
			<tr>
       <td><?php echo tep_black_line(); ?></td>
      </tr>
			<tr>
			 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
         <td class="seo_subHead"><?php echo HEADING_TITLE_LINKPOP; ?></td>
        </tr>	
        <tr>
         <td class="seo_section"><?php echo TEXT_LINKPOP; ?></td>
        </tr> 				 
       </table></td>
			</tr>				
			<tr>
			 <td align="right" > <?php echo tep_draw_form('seo_linkpop', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action_link')) . 'action2=' . $form_action, 'post' ); ?></td>
      </tr>          
			<tr> 
			 <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
      </tr>
			<tr class="infoBoxContents">
       <td><table border="0" cellspacing="2" cellpadding="2">
        <tr> 
			   <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
         <td><?php echo tep_draw_input_field('linkpop_url', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	   <td ><?php echo (tep_image_submit('button_link_popularity.png', IMAGE_LINK_POPULARITY) ); ?></td>
			  </tr>  					 
			  <tr> 
			   <td class="seo_section"><?php echo TEXT_COMPARE; ?></td>
         <td><?php echo tep_draw_input_field('linkpop_2_url', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	  </tr>					 
			 </table></td>				 
			</tr>		
			<?php if ($total) { ?>
      <tr>
       <td colspan=2 height=5><!-- SPACER --></td>
      </tr>
      <tr>
      <td><table class="smallText" border=1 cellpadding=2 cellspacing=0>
			 <tr>
   	    <th class="smallText" align="center" width="25"><?php echo TEXT_DOMAIN; ?></th>
   	    <th class="smallText" align="center" width="150"><?php echo $link_1_url; ?></th>
			   <?php if ($show_second_link) { ?> <th class="smallText" align="center" width="150"><?php echo $link_2_url; ?></th> <?php } ?>
			 </tr>
       <tr>
        <td class="seo_section"><?php echo TEXT_ALEXA_TRAFFIC_RANKING; ?></td><td class="seo_section" align='right'><?php echo "{$results['alexa'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['alexa'][1]}"; ?>'>view</a>)</td>
				 <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['alexa'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['alexa'][1]}"; ?>'>view</a>)</td> <?php } ?>
  		 </tr>
				
       <tr>
        <td class="seo_section"><?php echo TEXT_PRESENT_IN_DMOZ; ?></td><td class="seo_section" align='right'><?php echo "{$results['dmoz'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['dmoz'][1]}"; ?>'>view</a>)</td>
			   <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['dmoz'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['dmoz'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_PRESENT_IN_ZEAL; ?></td><td class="seo_section" align='right'><?php echo "{$results['zeal'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['zeal'][1]}"; ?>'>view</a>)</td>
				<?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['zeal'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['zeal'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
      	  
			 <tr>
        <td colspan=3 height=5 bgcolor="#FF0000"><!-- SPACER --></td>
       </tr>
		   <tr>
        <td class="seo_section"><?php echo TEXT_ALLTHEWEB; ?></td><td class="seo_section" align='right'><?php echo "{$results['alltheweb'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['alltheweb'][1]}"; ?>'>view</a>)</td>
				<?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['alltheweb'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['alltheweb'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_ALTAVISTA; ?></td><td class="seo_section" align='right'><?php echo "{$results['altavista'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['altavista'][1]}"; ?>'>view</a>)</td>
			   <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['altavista'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['altavista'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_GOOGLE; ?></td><td class="seo_section" align='right'><?php echo "{$results['google'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results['google'][1]}"; ?>'>view</a>)</td>
			   <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['google'][0]}"; ?> (<a target="_blank" href='<?php echo "{$results_2['google'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_HOTBOT; ?></td>
        <td class="seo_section" align='right'><?php echo "{$results['hotbot'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results['hotbot'][1]}"; ?>'>view</a>)</td>
			   <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['hotbot'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results_2['hotbot'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_MSN; ?></td>
        <td class="seo_section" align='right'><?php echo "{$results['msn'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results['msn'][1]}"; ?>'>view</a>)</td>
				<?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['msn'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results_2['msn'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
	        
			 <tr>
        <td class="seo_section"><?php echo TEXT_YAHOO; ?></td>
        <td class="seo_section" align='right'><?php echo "{$results['yahoo'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results['yahoo'][1]}"; ?>'>view</a>)</td>
			   <?php if ($show_second_link) { ?> <td class="seo_section" align='right'><?php echo "{$results_2['yahoo'][0]}"; ?> (<a class="seo_section" target="_blank" href='<?php echo "{$results_2['yahoo'][1]}"; ?>'>view</a>)</td> <?php } ?>
			 </tr>
		      
			 <tr>
        <td class="seo_section"><b><?php echo TEXT_TOTAL; ?></b></td>
        <td class="seo_section" align='right'><b><?php echo number_format($total); ?></b></td>
				<?php if ($show_second_link) { ?>	<td class="seo_section" align='right'><b><?php echo number_format($total_2); ?></b></td> <?php } ?>		
			 </tr>          
			</table></td>
      </tr>
      <?php } ?>
     </form>
     <tr>
      <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
     </tr>     
			<!-- END LINK POPULARITY CODE --> 
			
			<!-- BEGIN KEYWORD DENSITY CODE --> 			
			<tr> 
			 <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
      </tr>	
			<tr>
       <td><?php echo tep_black_line(); ?></td>
      </tr>
			<tr>
			 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
         <td class="seo_subHead"><?php echo HEADING_TITLE_DENSITY; ?></td>
        </tr>	
        <tr>
         <td class="seo_section"><?php echo TEXT_DENSITY; ?></td>
        </tr>  				 
       </table></td>
			</tr>				
			<tr>
			 <td align="right" > <?php echo tep_draw_form('keyword_density', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action3')) . 'action3=' . $form_action, 'post' ); ?></td>
      </tr>          
			<tr> 
			 <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
      </tr>
			<tr class="infoBoxContents">			 
       <td><table border="0" cellspacing="2" cellpadding="2">
        <tr> 
			   <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
         <td><?php echo tep_draw_input_field('density_url', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	   <td ><?php echo (tep_image_submit('button_check_density.png', IMAGE_CHECK_DENSITY)); ?></td>
			  </tr> 					 
			 </table></td>	
			 <tr>
			  <td><table border="0" cellspacing="2" cellpadding="2">
				<tr>
				 <td class="seo_section"><?php echo TEXT_INCLUDE_META_TAGS; ?></td>
          <td><?php echo tep_draw_checkbox_field('use_meta_tags', '', false, ''); ?> </td>
				 <td>&nbsp;</td>
				 <td class="seo_section"><?php echo TEXT_USE_PARTIAL_TOTAL; ?></td>
          <td><?php echo tep_draw_checkbox_field('use_partial_total', '', false, ''); ?> </td>
	 			</tr>	
			  </table></td>	
			 </tr> 
			</tr>					 
			<?php if (! empty($dens[1])) { ?>
			<tr> 
			 <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
      </tr>	
			<tr>
			 <td class="seo_section"><?php echo TEXT_TOTAL_WORDS . $ttl_words; ?></td>
			</tr>
			<tr>
			 <td><table border="1" width="100%" cellspacing="0" cellpadding="0">	 
  		  <th class="smallText" align="center" width="20%"><?php echo TEXT_SINGLE_WORD; ?></th>
  		  <th class="smallText" align="center" width="5%"><?php echo TEXT_COUNT; ?></th>
	      <th class="smallText" align="center" width="5%"><?php echo TEXT_DENSITY_TABLE; ?></th>
 		    <th class="smallText" align="center" width="20%"><?php echo TEXT_DOUBLE_WORD; ?></th>
 		    <th class="smallText" align="center" width="5%"><?php echo TEXT_COUNT; ?></th>
		    <th class="smallText" align="center" width="5%"><?php echo TEXT_DENSITY_TABLE; ?></th>
 			  <th class="smallText" align="center" width="30%"><?php echo TEXT_TRIPLE_WORD; ?></th>
	      <th class="smallText" align="center" width="5%"><?php echo TEXT_COUNT; ?></th>
			  <th class="smallText" align="center" width="5%"><?php echo TEXT_DENSITY_TABLE; ?></th>
        <?php
				 $cnt2=0; $cnt3=0; 
				 while (list($key, $val) = each($dens[1])) { 
			  ?>
	      <tr>
	       <td class="seo_section"><?php  echo $key; ?> </td>
				<td class="seo_section"><?php echo $dens[$key]; ?> </td>
	       <td  class="seo_section" width="5%"><?php  echo $val; ?> </td>
	      <?php
			  if ($cnt2 < count($dens[2])) {  
				  while (list($key2, $val2) = each($dens[2])) { ?>
	          <td class="seo_section"><?php  echo $key2; ?> </td>
					<td class="seo_section"><?php echo $dens[$key2]; ?> </td>
		        <td  class="seo_section" width="5%"><?php  echo $val2; ?> </td>
					<?php 
					 if ($cnt2 < count($dens[3])) {
					   while (list($key3, $val3) = each($dens[3])) { ?>
                <td class="seo_section"><?php echo $key3; ?></td>
						 <td class="seo_section"><?php echo $dens[$key3]; ?> </td>
				       <td  class="seo_section" width="5%"><?php echo $val3; ?></td>
		            <?php
		             break;
               }
					 } else {
					 ?>
				     <td>&nbsp;</td>
              <td>&nbsp;</td>
					  <td>&nbsp;</td>
					 <?php
					 }							 			
             break;
           }	
			  } else {
			  ?>
			   <td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  <?php if ($cnt3 < count($dens[1])) {	?>
  			<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  <?php
			  }
			}
			$cnt2++; 
			$cnt3++;
			?>
		 </tr>   
     <?php  } ?>
		</table></td>
	 </tr> 
	  <?php } ?> 
   </form>
   <tr>
    <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
   </tr>
			<!-- END KEYWORD DENSITY CODE --> 
      
      <!-- BEGIN CHECK LINKS CODE --> 			
			  <tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>	
			  <tr>
         <td><?php echo tep_black_line(); ?></td>
        </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="seo_subHead"><?php echo HEADING_TITLE_CHECK_LINKS; ?></td>
          </tr>	
          <tr>
           <td class="seo_section"><?php echo TEXT_CHECK_LINKS; ?></td>
          </tr>   				 
         </table></td>
			  </tr>				
			  <tr>
			   <td align="right" > <?php echo tep_draw_form('check_links', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action2')) . 'action2=' . $form_action, 'post' ); ?></td>
        </tr>          
			  <tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
			  <tr class="infoBoxContents">
         <td><table border="0" cellspacing="2" cellpadding="2">
          <tr> 
			  	  <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
           <td><?php echo tep_draw_input_field('check_page', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	     <td ><?php echo (tep_image_submit('button_check_links.png', IMAGE_CHECK_LINKS) ); ?></td>
			  	 </tr> 
         </table></td>				 
			  </tr>		
        <?php if (tep_not_null($action_check_links)) { ?>      
        <tr> 
		      <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
        <tr>
          <td class="seo_section"><?php echo TEXT_FOUND; ?><?php echo count($badLinks); ?>&nbsp;suspected bad link(s) out of a total of&nbsp; <?php echo $totalLinks; ?> </td>
        </tr> 
        <tr> 
  	      <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>     
        <tr>           
         <td><table border="1" width="80%">
         <?php for ($idx = 0; $idx < count($badLinks); $idx++) { ?>
	  	 	 <tr>
				  <td class="seo_section" width="15%"><?php echo TEXT_BROKEN_LINK; ?></td>
				  <td class="seo_section"><?php echo $badLinks[$idx]; ?> </td>
				 </tr>		
         <?php } ?> 			
         </table></td>
        </tr>
        <?php } ?>
			 			 		  
      </form>
      <tr>
       <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
      </tr>
			<!-- END CHECK LINKS CODE --> 
      
        <!-- BEGIN HEADER STATUS CODE --> 			
				<tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>	
				<tr>
         <td><?php echo tep_black_line(); ?></td>
        </tr>
				<tr>
				 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="seo_subHead"><?php echo HEADING_TITLE_HEADER_STATUS; ?></td>
          </tr>			
           <tr>
            <td class="seo_section"><?php echo TEXT_HEADER_STATUS; ?></td>
          </tr>		 
        </table></td>
				</tr>				
				<tr>
			   <td align="right" > <?php echo tep_draw_form('seotips', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action2')) . 'action2=' . $form_action, 'post' ); ?></td>
        </tr>          
			  <tr> 
			   <td width="10"><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
				<tr class="infoBoxContents">
          <td><table border="0" cellspacing="2" cellpadding="2">
           <tr> 
			  	   <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
            <td><?php echo tep_draw_input_field('header_url', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	      <td ><?php echo (tep_image_submit('button_admin_get_header.png', IMAGE_GET_HEADER) ); ?></td>
			  	  </tr> 
          </table></td>	
         </tr>
				<?php if (! empty($headerInfo['0'])) { ?>
         <tr>
          <td><table border="0" cellspacing="2" cellpadding="2">
			 	  <tr>
	  			<td class="seo_section" colspn="2'><?php echo TEXT_HEADER_STATUS; ?></td>
           </tr>
           <tr> 
				   <td class="seo_section"><?php echo $headerInfo['0']; ?></td>
            <td width="50%" class="smallText"> <script>document.writeln('<a style="cursor:hand" onclick="javascript:popup=window.open('
                                           + '\'<?php echo tep_href_link('seo_header_explain_popup_help.php'); ?>\',\'popup\','
                                           + '\'scrollbars,resizable,width=520,height=550,left=50,top=50\'); popup.focus(); return false;">'
                                           + '<font color="red"><u><?php echo HEADING_TITLE_HEADER_CODE_EXPLAIN; ?></u></font></a>');
            </script></td>
 			     </tr>					
          </table></td>	
         </tr>	
				<?php } ?>
      </form>
      <tr>
       <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
      </tr>
			<!-- END HEADER STATUS CODE -->       
      
        <!-- BEGIN CHECK SIDS CODE --> 			
				<tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>	
				<tr>
         <td><?php echo tep_black_line(); ?></td>
        </tr>
				<tr>
				 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="seo_subHead"><?php echo HEADING_TITLE_CHECK_SIDS; ?></td>
          </tr>			
           <tr>
            <td class="seo_section"><?php echo TEXT_CHECK_SIDS; ?></td>
          </tr>		 
        </table></td>
			  </tr>				
        <tr>		  
         <td><table border="0" cellspacing="2" cellpadding="2">
          <tr> 
           <?php if ($spidersOption == 'False') { ?>
           <td class="seo_section" style="color: red;" colspan="5"><?php echo TEXT_SPIDER_WARNING; ?> </td>
           <?php } ?>
          </tr>               
         </table></td>          
        </tr>	          
			  <tr>
			   <td align="right" > <?php echo tep_draw_form('seotips', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action2')) . 'action2=' . $form_action, 'post' ); ?></td>
        </tr>          
			  <tr> 
			   <td width="10"><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
				<tr class="infoBoxContents">
         <td><table border="0" cellspacing="2" cellpadding="2">
	        <tr>
			     <td class="seo_section"><p><?php echo TEXT_TOTAL_SEARCHES; ?></td>
           <td><?php  echo tep_draw_input_field('searchcount_check_sids', tep_not_null($searchtotal) ? $searchtotal : '100', 'maxlength="255"', false); ?> </td>
          </tr>
          <tr> 
			     <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
           <td><?php echo tep_draw_input_field('check_sids', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	     <td ><?php echo (tep_image_submit('button_check_sids.png', IMAGE_CHECK_SIDS) ); ?></td>
			  	 </tr>
			   </table></td>				 
				</tr>				
         <tr class="infoBoxContents">
          <td><table border="0" cellspacing="2" cellpadding="2">
           <tr> 
 		        <td class="seo_section"><?php echo TEXT_SEARCH; ?></td>
            <td><?php echo tep_draw_checkbox_field('searchsidsGoogle', '', $searchSids_google, ''); ?> </td>
			      <td class="seo_section"><?php echo TEXT_GOOGLE; ?>&nbsp;</td>
            <td><?php echo tep_draw_checkbox_field('searchsidsMsn', '', $searchSids_msn, ''); ?> </td>
	  		   <td class="seo_section"><?php echo TEXT_MSN; ?>&nbsp;</td>
            <td><?php echo tep_draw_checkbox_field('searchsidsYahoo', '', $searchSids_yahoo, ''); ?> </td>
			      <td class="seo_section"><?php echo TEXT_YAHOO; ?>&nbsp;</td>
           </tr>
           <tr>
            <td class="seo_section"><?php echo TEXT_SHOW_LINKS; ?></td>
            <td><?php echo tep_draw_checkbox_field('show_sid_links', $showsidlinks, false, ''); ?> </td>
           </tr>               
          </table></td>          
         </tr>	 
         
         <!-- BEGIN DISPLAY GOOGLE -->
         <?php if ($searchSids_google) { ?>
          <tr class="infoBoxContents">
           <td><table border="0" cellspacing="2" cellpadding="2">
            <tr><td height="10"></td></tr>
            <tr>
             <td class="seo_section"><b><?php echo TEXT_GOOGLE; ?></b></td>
            </tr>             
            <tr> 
	 			    <td class="seo_section"><?php echo sprintf("%s: %s",TEXT_TOTAL_LINKS_LISTED, $totalLinks_Google); ?> </td>
				   </tr>		
            <tr>
             <td class="seo_section"><?php echo sprintf("%s: %d",TEXT_TOTAL_SIDS_FOUND, $foundSID_Google); ?> </td>
            </tr> 
            <?php if ($showsidlinks && count($sidURL_Google)) {  
             for ($i = 0; $i < count($sidURL_Google); ++$i) { ?>
              <tr>
               <td class="smallText"><a href="<?php echo $sidURL_Google[$i]; ?>" target="_blank"><?php echo $sidURL_Google[$i]; ?></a></td>
              </tr>
             <?php } ?>
  			   <?php } ?>
           </table>
           </td>
          </tr>   
         <?php } ?>                  

         <!-- BEGIN DISPLAY MSN -->
         <?php if ($searchSids_msn) { ?>
          <tr class="infoBoxContents">
           <td><table border="0" cellspacing="2" cellpadding="2">
            <tr><td height="10"></td></tr>         
            <tr>
             <td class="seo_section"><b><?php echo TEXT_MSN; ?></b></td>
            </tr>             
            <tr> 
	 			    <td class="seo_section"><?php echo sprintf("%s: %s",TEXT_TOTAL_LINKS_LISTED, $totalLinks_Msn); ?> </td>
				   </tr>			         
            <tr>
             <td class="seo_section"><?php echo sprintf("%s: %d",TEXT_TOTAL_SIDS_FOUND, $foundSID_Msn); ?> </td>
            </tr> 
            <?php if ($showsidlinks && count($sidURL_Msn)) { 
             for ($i = 0; $i < count($sidURL_Msn); ++$i) { ?>
             <tr>
              <td class="smallText"><a href="<?php echo $sidURL_Msn[$i]; ?>" target="_blank"><?php echo $sidURL_Msn[$i]; ?></a></td>
             </tr>
             <?php } ?>
				   <?php } ?>            
           </table>
           </td>
          </tr>   
         <?php } ?>         
                     
         <!-- BEGIN DISPLAY YAHOO -->
         <?php if ($searchSids_yahoo) { ?>
          <tr class="infoBoxContents">
           <td><table border="0" cellspacing="2" cellpadding="2">
            <tr><td height="10"></td></tr>                
            <tr>
             <td class="seo_section"><b><?php echo TEXT_YAHOO; ?></b></td>
            </tr>             
            <tr> 
	 			    <td class="seo_section"><?php echo sprintf("%s: %s",TEXT_TOTAL_LINKS_LISTED, $totalLinks_Yahoo); ?> </td>
				   </tr>			
            <tr>
             <td class="seo_section"><?php echo sprintf("%s: %d",TEXT_TOTAL_SIDS_FOUND, $foundSID_Yahoo); ?> </td>
            </tr> 
            <?php if ($showsidlinks && count($sidURL_Yahoo)) {  
             for ($i = 0; $i < count($sidURL_Yahoo); ++$i) { ?>
              <tr>
               <td class="smallText"><a href="<?php echo $sidURL_Yahoo[$i]; ?>" target="_blank"><?php echo $sidURL_Yahoo[$i]; ?></a></td>
              </tr>
              <?php } ?>                        
				    <?php } ?>
            </table>
           </td>
          </tr>
         <?php } ?>         
         <tr>
          <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
         </tr>         
         
      </form>
			<!-- END CHECK SIDS CODE -->       
      
        <!-- BEGIN SUPPLEMENTAL CODE --> 			
				<tr> 
			   <td><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>	
				<tr>
         <td><?php echo tep_black_line(); ?></td>
        </tr>
				<tr>
				 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="seo_subHead"><?php echo HEADING_TITLE_SUPPLEMENTAL; ?></td>
          </tr>			
           <tr>
            <td class="seo_section"><?php echo TEXT_SUPPLEMENTAL; ?></td>
          </tr>		 
        </table></td>
				</tr>				
				<tr>
			   <td align="right" > <?php echo tep_draw_form('seotips', FILENAME_SEO_ASSISTANT, tep_get_all_get_params(array('action')) . 'action=' . $form_action, 'post' ); ?></td>
        </tr>          
			  <tr> 
			   <td width="10"><?php echo tep_draw_separator('pixel_trans.png', '10', '10'); ?></td>
        </tr>
				<tr class="infoBoxContents">
         <td><table border="0" cellspacing="2" cellpadding="2">
	        <tr>
			     <td class="seo_section"><p><?php echo TEXT_TOTAL_SEARCHES; ?></td>
           <td><?php  echo tep_draw_input_field('searchcount_supplemental', tep_not_null($searchtotal) ? $searchtotal : '100', 'maxlength="255"', false); ?> </td>
          </tr>
          <tr> 
			     <td class="seo_section"><?php echo TEXT_ENTER_URL; ?></td>
           <td><?php echo tep_draw_input_field('supplementalURL', tep_not_null($searchurl) ? $searchurl : '', 'maxlength="255" size="40"',   false); ?> </td>
    	     <td ><?php echo (tep_image_submit('button_supplemental.png', IMAGE_CHECK_SUPPLEMENTAL) ); ?></td>
			  	 </tr>
			   </table></td>				 
				</tr>				
         <tr class="infoBoxContents">
          <td><table border="0" cellspacing="2" cellpadding="2">
           <tr>
            <td class="seo_section"><?php echo TEXT_SHOW_LINKS; ?></td>
            <td><?php echo tep_draw_checkbox_field('show_supplemental_links', $showsupplementallinks, false, ''); ?> </td>
           </tr>               
          </table></td>
         </tr>	 		  
         
         <!-- BEGIN DISPLAY GOOGLE -->
         <?php if (tep_not_null($action_supplemental)) { ?>
          <tr class="infoBoxContents">
           <td><table border="0" cellspacing="2" cellpadding="2">
            <tr><td height="10"></td></tr>
            <tr>
             <td class="seo_section"><b><?php echo TEXT_GOOGLE; ?></b></td>
            </tr>             
            <tr> 
	 			    <td class="seo_section"><?php echo sprintf("%s: %s",TEXT_TOTAL_LINKS_LISTED, $totalSupplementalLinks_Google); ?> </td>
				   </tr>		
            <tr>
             <td class="seo_section"><?php echo sprintf("%s: %d",TEXT_TOTAL_SUPPLEMENTAL_FOUND, $foundSupplemental_Google); ?> </td>
            </tr> 
            <?php if ($showsupplementalLinks && count($supplementalURL_Google)) {  
             for ($i = 0; $i < count($supplementalURL_Google); ++$i) { ?>
              <tr>
               <td class="smallText"><a href="<?php echo $sidURL_Google[$i]; ?>" target="_blank"><?php echo $supplementalURL_Google[$i]; ?></a></td>
              </tr>
             <?php } ?>
  			   <?php } ?>
           </table>
           </td>
          </tr>  
         <?php } ?>  
         <tr>
          <td class="seo_section" align="right"><a title="Top" href="<?php echo PageLink('top'); ?>"> Top</a></td>
         </tr>
      </form>
			<!-- END SUPPLEMENTAL CODE -->         
			
			</table></td>   
		 </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
