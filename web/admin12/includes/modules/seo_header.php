<?php 
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  12.10.2006
  Originally Created by: Jack_mcs
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
*/
   
   function get_http_headers($url){ 
      if (!eregi("\:\/\/", $url)) 
         $url = "http://" . $url;        //add http to the url if missing
 
      $url_parsed = parse_url ("$url");  //break the string
      
      if (! empty($url_parsed["path"]))
        $url = substr($url, 0 , -(strlen($url_parsed["path"]))); //remove the sub-driectory
      
      if (empty($url_parsed["port"])) 
         $url_parsed["port"] = "80"; 
      $port = $url_parsed["port"]; 

      if (empty($url_parsed["path"])) 
         $url_parsed["path"] = "/"; 
      $path = $url_parsed["path"]; 

      $query = $url_parsed["query"]; 
      $host  = $url_parsed["host"]; 
 
      $fp = fsockopen("$host", "$port", &$err_num, &$err_msg, 10); 
      if (!$fp)
      { 
         if ($err_num == 9) 
            $connection_refused_message = "  It is possible that the connection was refused."; 
         print ("I'm sorry, I encountered an error processing your request.  Error message: <I>$err_msg</I>.  Error number: <I>$err_num</I>.$connection_refused_message<br />\n"); 
      } 
      else 
      { 
         fputs($fp, "GET $url$path$query HTTP/1.0\r\n"); 
         if (php_sapi_name() == "apache")
         { 
            $headers = getallheaders(); 
            while (list ($header, $value) = each ($headers)) 
            { 
               if ($header == "Referer") 
                  $value = "http://$host"; 
               if ($header == "Connection:") 
                  $value = "close"; 
               if ($header == "Host:") 
                  $value = "$host";        
            } 
         } 
          
         fputs($fp, "\r\n"); // Finish talking to the server. 
         
         for($i=1;;$i++)
         { 
            $str = fgets($fp, 256); 
            if(strlen($str) < 3) 
               break; 

            if ($i==1) 
            {
               if (strncasecmp(substr($str, 0, 4), "HTTP", 4) != 0)
               { 
                  print ("The server at <I>$host</I> listening on port <I>$port</I> is not an HTTP server<br />\n"); 
                  break; 
               }
            }    
            $headerInfo[] = $str;           
         } 
         fclose($fp); 
      } 
      return $headerInfo;
   } 

   if ($header_url) 
     $headerInfo = get_http_headers($header_url); 
?> 