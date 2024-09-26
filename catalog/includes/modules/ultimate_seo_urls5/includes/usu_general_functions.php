<?php
  /**
  *
  * ULTIMATE Seo Urls 5 PRO ( version 1.1 )
  *
  * 
  * @package USU5_PRO
  * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
  * @link http://www.fwrmedia.co.uk
  * @copyright Copyright 2008-2009 FWR Media
  * @copyright Portions Copyright 2005 ( rewrite uri concept ) Bobby Easland
  * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
  * @lastdev $Author:: Rob                                              $:  Author of last commit
  * @lastmod $Date:: 2011-02-28 11:13:41 +0000 (Mon, 28 Feb 2011)       $:  Date of last commit
  * @version $Rev:: 200                                                 $:  Revision of last commit
  * @Id $Id:: usu_general_functions.php 200 2011-02-28 11:13:41Z Rob    $:  Full Details   
  */
  
  /**
  * General functions used by USU5 PRO
  * @package USU5_PRO
  */

  /**
  * Standard osCommerce tep_href_link() link wrapper function
  * @uses die()
  * @uses substr()
  * @uses strstr()
  * @uses str_replace()
  * 
  * 
  * @param string $page - base file name or sometimes a path
  * @param string $parameters - querystring parameters
  * @param string $connection - SSL / NONSSL
  * @param bool $add_session_id
  * @param bool $search_engine_safe
  * @return string - URL
  */
  function osc_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    $multi_language_valid = true;
    if ( ( false !== strpos( $page, '/' ) ) || ( substr( $page, -4, strlen( $page ) ) != '.php' ) ) {
      $multi_language_valid = false;
    }
    if ( tep_not_null( $parameters ) ) {
      $link .= $page; 
      $link .= ( $multi_language_valid ? usu5_multi_language( 'left' ) : null ) . '?' . tep_output_string( $parameters );
      $separator = '&';
    } else {
      $link .= $page;
      $link .= ( $multi_language_valid ? usu5_multi_language( 'left' ) : null );
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
    }

    if (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
    }
    // Remove index.php from the link when it is www.mysite.com/index.php
    if ( false !== do_homepage_redirect( $link ) ) {
     $link = str_replace( FILENAME_DEFAULT, '', $link );
    }
    if ( Usu_Main::monitorPerformance() ) {
      Usu_Main::$performance['std_urls']++;
      Usu_Main::$performance['std_url_array'][] = $link;
    }
    switch ( defined( 'USU5_USE_W3C_VALID' ) && ( USU5_USE_W3C_VALID == 'true' ) ) {
      case true:
        return htmlspecialchars( utf8_encode( $link ) );
        break;
      default:
        return $link;
        break;
    }
    return $link;
  }
  /**
  * Simple but powerful tool for debugging variables and arrays
  * @uses is_array()
  * @uses is_object()
  * @uses var_dump()
  * @uses print_r()
  * 
  * @param mixed $output - array or a variable to be output
  * @param bool $exit - true will exit the script after output / false will output but the script continues
  * @param string $file - Tells us which file the code was initiated in. The input was __FILE__
  * @param string $line - Tells us which line in the file the code was initiated in. The input was __LINE__
  * @param string $function - function to use to output an array, the default is print_r it could also be var_dump
  */
  function usu_say( $output, $exit = false, $file = false, $line = false, $function = 'print_r' ) {
    $additional = '';
    if ( false !== $file ) {
      $additional .= 'Fine: ' . $file . '<br />' . PHP_EOL;
    }
    if ( false !== $line ) {
      $additional .= 'Line: ' . $line . '<br />' . PHP_EOL;
    }
    if ( is_array( $output ) || is_object( $output ) ) {
      switch ( $function ) {
        case 'var_dump':
          echo $additional . '<pre>' . PHP_EOL;
          echo var_dump( $output );
          echo '</pre>' . PHP_EOL;
          break;
        default:
          echo $additional . '<pre>' . print_r( $output, true ) . '</pre><br />' . PHP_EOL;
          break;
      }
    } else { 
      echo $additional . $output . '<br />' . PHP_EOL;
    }
    if ( false !== $exit ) {
      exit;
    }
  } // end function
  /**
  * Standard whitelist value cleansing
  * @uses preg_replace()
  * 
  * @param string $value - value to be cleansed
  * @return string - cleansed value
  */
  function usu_cleanse( $value ) {
    return preg_replace( '@[^a-z0-9_]@i', '', $value );
  }
  /**
  * Remove the querystring from a uri
  * @uses strpos()
  * @uses str_replace()
  * @uses strrchr()
  * 
  * @param string $path - URI
  * @return string - stripped URI
  */
  function remove_querystring( $path ) {
    if ( false !== strpos( $path, '?' ) ) {
      return str_replace( strrchr( $path, '?' ), '', $path ); // Remove any/all querystring if it exists
    }
    return $path;
  } // End method
  /**
  * Remove the session id from a uri
  * @uses htmlspecialchars_decode()
  * @uses strpos()
  * @uses preg_match()
  * @uses ltrim()
  * @uses strrchr()
  * @uses explode()
  * 
  * @param string $uri
  * @return string - uri stripped of session id
  */
  function remove_session_id( $uri ) {
    $uri = htmlspecialchars_decode( $uri );
    if ( false !== ( $pos = strpos( $uri, '?' ) ) ) {
      $session_name = tep_session_name();
      if ( preg_match( '@[\?&]' . $session_name . '=[a-z0-9]+@', $uri ) ) {
        $qs = ltrim( strrchr( $uri, '?' ), '?' );
        $uri = substr( $uri, 0, $pos );
        $qs_array = explode( '&', $qs );
        $separator = '?';
        foreach ( $qs_array as $numkey => $keypair ) {
          if ( false === strpos( $keypair, $session_name ) ) {
            $uri .= $separator . $keypair;
            $separator = '&';
          }
        } 
      }
    }
    return $uri;
  }
  /**
  * Force www.mysite.com/index.php to 301 redirect to www.mysite.com/
  * @uses defined()
  * @uses substr()
  * @uses strlen()
  */
  function do_homepage_redirect( $url = false ) { 
    if ( defined( 'USU5_HOME_PAGE_REDIRECT' ) && ( USU5_HOME_PAGE_REDIRECT == 'true' )
                                              && ( USU5_ENABLED == 'true' ) ) {
      if ( false === $url ) {
        $original_request_uri = remove_querystring( Usu_Main::i()->getVar( 'original_request_uri' ) );
        $possible_file = substr( $original_request_uri, ( strlen( $original_request_uri ) - strlen( FILENAME_DEFAULT ) ), strlen( FILENAME_DEFAULT ) );   
        if ( !tep_not_null( Usu_Main::i()->getVar( 'request_uri' ) ) && ( $possible_file == FILENAME_DEFAULT ) ) {
          return true;
      }
      } else {
        $url = remove_querystring( $url );
        $possible_file = substr( $url, ( strlen( $url ) - strlen( FILENAME_DEFAULT ) ), strlen( FILENAME_DEFAULT ) );
        if ( $possible_file == FILENAME_DEFAULT ) {
          return true;
        }
      } 
    }
    return false;
  } // end method;
  /**
  * Directory iterator
  * @uses substr()
  * 
  * @param string $fullpath - full path to the director we wish to iterate
  * @return array - numerical index of returned pages
  */
  function usu_dir_iterator( $fullpath ) {
    $it = new DirectoryIterator( $fullpath );
    while( $it->valid() ) {
     if ( !$it->isDot() && $it->isFile() && $it->isReadable() && ( substr( $it->getFilename(), -4, 4 ) == '.php' ) ) {
       $files[] = $it->getFilename();
     }
     $it->next();
    }
    return $files;
  } // End method
  /**
  * Adds language code to a uri
  * @uses defined()
  * 
  * @param string $separator
  * @return string 2 letter language code with a / added if required
  */
  function usu5_multi_language( $separator = false ) {

    if ( !defined( 'USU5_ENABLED' ) || ( USU5_ENABLED != 'true' ) 
                                    || !defined( 'USU5_MULTI_LANGUAGE_SEO_SUPPORT' ) 
                                    || ( USU5_MULTI_LANGUAGE_SEO_SUPPORT != 'true' )
                                    || ( false === Usu_Main::i()->getVar( 'current_language', 'code' ) ) 
                                    || ( DEFAULT_LANGUAGE == Usu_Main::i()->getVar( 'current_language', 'code' ) ) ) {
      return false;
    } 
    switch ( true ) {
      case $separator == 'left':
        return '/' . Usu_Main::i()->getVar( 'current_language', 'code' );
        break;
      case $separator == 'right':
        return Usu_Main::i()->getVar( 'current_language', 'code' ) . '/';
        break;
      case $separator == 'both':
        return '/' . Usu_Main::i()->getVar( 'current_language', 'code' ) . '/';
        break;
      default:
        return Usu_Main::i()->getVar( 'current_language', 'code' );
        break;
    }
  } // end function
  /**
  * Standardises module naming
  * @uses str_replace()
  * @uses ucwords()
  * @uses strtolower()
  * 
  * @param string $filename
  * @param string $module_suffix
  */
  function module_naming_convention( $filename, $module_suffix ) {
    return str_replace( ' ', '_', ucwords( str_replace( '_', ' ', strtolower( $filename ) ) ) ) . $module_suffix;
  }
  /**
  * Attempt to make a path writeable
  * @uses is_readable()
  * @uses is_writeable()
  * @uses function_exists()
  * @uses chmod()
  * @uses clearstatcache()
  * 
  * @param string $path - path to file or directory
  */
  function usu5_make_writeable( $path ) {
    if ( false === is_readable( $path ) ) {
      return false;
    }
    if ( !is_writeable( $path ) ) {
      if ( function_exists( 'chmod' ) ) {
        @chmod( $path, 0755 );
        clearstatcache();
        if ( !is_writeable( $path ) ) {
          @chmod( $path, 0777 );
          clearstatcache();
        }
      }
    }
    if ( !is_writeable( $path ) ) {
      return false;
    } else return true;
  } // end function
  /**
  * Performance reporting
  * 
  * reports on links built queries used, time to load cache, cache size
  */
  function performance() {

    if ( defined( 'USU5_OUPUT_PERFORMANCE' ) && ( USU5_OUPUT_PERFORMANCE !== 'true' ) ) {
      return false;
    }
    $cache_loaded_colour = Usu_Main::$performance['cache_loaded'] == 'true' ? 'green' : 'red';
    ( USU5_CACHE_ON == 'true' ) ? $status = '<span style="color: green; font-weight: bold;">On</span>' : $status = '<span style="color: red; font-weight: bold;">Off</span>';
    $total_query_time = 0;
    foreach ( Usu_Main::$performance['queries'] as $index => $query ) {
      $total_query_time += $query['time'];
    }
?>
<div style="padding: 3em; font-family: verdana; width: 750px; margin-left: auto ; margin-right: auto; clear: both;">
  <div style="width: 100%; background-color: #ffffdd; border: 1px solid #1659AC; font-size: 10pt;">
    <div style="background-color: #2E8FCA; font-size: 12pt; font-weight: bold; padding: 0.5em; color: #00598E;">
      <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div>
        ULTIMATE Seo Urls <span style="color: #CC3300;">5</span> PRO <span style="font-size: xx-small; color: #dddddd; font-style: italic;"> ( <?php echo Usu_Main::$version; ?> )</span> - Performance
    </div>
    <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Standard URI produced: <?php echo Usu_Main::$performance['std_urls']; ?></div>
    <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">SEO URI produced: <?php echo Usu_Main::$performance['seo_urls']; ?></div>
    <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Query Count: <?php echo Usu_Main::$performance['querycount']; ?></div>
    <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">Queries Saved: <?php echo Usu_Main::$performance['queries_saved']; ?></div>
    <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Cache load time: <?php echo Usu_Main::$performance['time_extracting_cache']; ?> seconds <span style=" font-size: x-small; font-style: italic;">( includes gzinflate/base64_decode/unserialize )</span></div>
    <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">Data loaded from cache: <span style="font-weight: bold; color: <?php echo $cache_loaded_colour; ?>;"><?php echo Usu_Main::$performance['cache_loaded']; ?></span> <span style=" font-size: x-small; font-style: italic;">( Cache System: <?php echo Usu_Main::$performance['cache_system']; ?> )</span></div>
    <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Total query time: <?php echo $total_query_time; ?> seconds</div>
    <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">Cache system is <?php echo $status; ?></div>
    <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Standard Urls:</span></div>
      <div>
<?php
      foreach ( Usu_Main::$performance['std_url_array'] as $index => $url ) {
        echo '          ' . $url . '<br />' . PHP_EOL;
      } 
?>
      </div>
    </div>
    <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Seo Urls:</span></div>
      <div>
<?php
      foreach ( Usu_Main::$performance['seo_url_array'] as $index => $url ) {
        echo '        ' . $url . '<br />' . PHP_EOL;
      } 
?>
      </div>
    </div>
    <div style="background-color: #fff; padding: 0.5em; color: #737373; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Queries:</span></div>
<?php
      foreach ( Usu_Main::$performance['queries'] as $index => $query ) {
        echo '      <div style="padding: 0.2em; font-family: tahoma; font-size: 7pt;"><b>Time:</b> ' . $query['time'] . ' seconds<br /><b>Query:</b> ' . $query['query'] . '</div>' . PHP_EOL;
      }
?>
    </div>
  </div>
</div>
<?php
    } // end function
    
  function usu5_show_vars( $vars ) {
?>
<div style="padding: 3em; font-family: verdana; width: 750px; margin-left: auto; margin-right: auto; clear: both;">
  <div style="width: 100%; background-color: #ffffdd; border: 1px solid #1659AC; font-size: xx-small;">
    <div style="background-color: #2E8FCA; font-size: medium; font-weight: bold; padding: 0.5em; color: #00598E;">
      <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div>
      Debug: Variable &amp; Array Output. ( $this<span style="color: #000000;">=></span>vars )
    </div>
<?php
    usu_say( $vars );
?> 
  </div>
</div>
<?php  
  } // end function
