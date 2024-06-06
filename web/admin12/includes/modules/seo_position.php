<?php 
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  08.03.2004
  Originally Created by: Jack_mcs
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
*/
  	$query = str_replace(" ","+",$searchquery);	
  	$query = str_replace("%26","&",$query);	   
  	$position  = 0;  // This will be the index position in the listings  	
  	$real_position = 0; // This is the index position minus the duplicates 
  	$found   = NULL;
  	$lastURL = NULL;
    $siteresults = array();
    $out = array();

  	for($i=0;$i<$searchtotal && empty($found);$i+=$hits_per_page)
  	{  
      switch ($siteName)
      {
         case "Google":  $filename = "http://www.google.com/search?as_q=$query".
                             			 "&num={$hits_per_page}&hl=en&ie=UTF-8&btnG=Google+Search".
  			                            "&as_epq=&as_oq=&as_eq=&lr=&as_ft=i&as_filetype=".
  			                            "&as_qdr=all&as_nlo=&as_nhi=&as_occt=any&as_dt=i".
  			                            "&as_sitesearch=&safe=images&start=$i";
         break;
         case "msn": $filename = "http://search.msn.com/results.aspx?q=$query&FORM=MSNH&first=$i&count=".$hits_per_page;
         break;
         case "Yahoo": $filename = "http://search.yahoo.com/search?_adv_prop=web&x=op&ei=UTF-8".
                                   "&prev_vm=p&va=$query&va_vt=any&vp=&vp_vt=any&vo=&vo_vt=any".
                                   "&ve=&ve_vt=any&vd=all&vst=0&vs=&vf=all&vm=p".
                                   "&vc=&fl=0&n={$hits_per_page}&b=$page_var";
         break;                          
         default: echo 'Bad case '.$siteName; exit;
      }
 
      // Open the search page.
  		$file = fopen($filename, "r");
  		if (!$file) 
  		{
  			echo "<p>Unable to open remote file $filename.\n";
  		}
  		else
  		{          
  			while (!feof($file))  // load the file into a variable line at a time
  			{
  				$var = fgets($file, 1024);

	          if (eregi($conditions,$var,$out)) // find the html code this SE uses to show the site URL
  			   {  
               // highlight search terms within URLS 
   					$out[1] = strtolower(strip_tags($out[1]));
               // Get the domain name by looking for the first /
               if (($x = strpos($out[1],"/")) !== FALSE)
               {
                 if (strstr($out[1], "https"))
            	  {
         	       $x += 2;
         	       $x = strpos($out[1],"/", $x);
         	     }
               }  
               else
                $x = strlen($out[1]);	
      				
               // and get the URL
  					$url = substr($out[1],0,$x);                        
               $url = substr($url, 0, strlen($searchurl));
               $position++;

               // If you want to see the hits, set $showlinks_msn to something
  					if($showlinks)
						  $siteresults[] = $url;
 
               // If the last result process is the same as this one, it
               // is a nest or internal domain result, so don't count it
               // on $real_position
  					if(strcmp($lastURL,$url)<>0)
						  $real_position++;
  
  					$lastURL = $url;

               // Else if the sites match we have found it!!!
  					if(strcmp($searchurl,$url)==0)
  					{ 
  						$found = $position;
  						break; // We quit out, we don't need to go any further. 
  					}	
  					else 
               {
                  if (strpos($searchurl, "www") !== FALSE)
                    $search_alt = substr($searchurl, 4, strlen($searchurl) - 4);
                  else  
                    $search_alt = sprintf("www.%s",$searchurl);
                    
  	   				$url_alt = substr($out[1],0,$x);
                  $url_alt = substr($url_alt, 0, strlen($search_alt));               

             	   if(strcmp($search_alt,$url_alt)==0)
                  {
  						 $found = $position;
  						 break; // We quit out, we don't need to go any further.
                  }  
  					}	               
  				}
	 			}
  		}		 
  		fclose($file);	
  	}
?>