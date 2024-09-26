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
  * @lastmod $Date:: 2010-12-21 22:45:02 +0000 (Tue, 21 Dec 2010)       $:  Date of last commit
  * @version $Rev:: 196                                                 $:  Revision of last commit
  * @Id $Id:: notfound_404.php 196 2010-12-21 22:45:02Z Rob             $:  Full Details   
  */
  
  /**
  * Page not found html with 404 header
  * @package USU5_PRO
  * 
  * @var array $text - array of text strings to be used in the html
  */
  $text = array( 'title' => 'Page not found',
                 'text' => 'The page you were looking for could not be found. Please click the below link to return to ' . STORE_NAME . '
                            <p><a href="' . tep_href_link( FILENAME_DEFAULT ) . '" title="' . STORE_NAME . '">' . STORE_NAME . '</a></p><br />' );
  header( "HTTP/1.0 404 Not Found" );
?>
  <title>Page Not Found</title>  
  <div style="padding: 3em; font-family: verdana; margin: 3em; border: 1px solid #e5e5e5;">
    <div style="background-color: #2E8FCA; font-size: 12pt; font-weight: bold; padding: 0.5em; color: #00598E;">
      <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div><?php echo $text['title']; ?></div>
    <div style="padding: 0.5em; font-size: 9pt; font-family: verdana;"><?php echo $text['text']; ?></div></div>
  </div>