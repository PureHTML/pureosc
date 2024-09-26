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
  * @Id $Id:: uri_redirects_class.php 196 2010-12-21 22:45:02Z Rob      $:  Full Details   
  */
 
 /**
 * Simple uri redirects
 * @package USU5_PRO
 * 
 * @see includes/uri_redirects_array.php
 */
  final class Uri_Redirects {
    private static $_singleton = null;
    private static $redirects = array();
    /**
    * Class constructor
    * @access private
    */
    private function __construct() {
    } // end constructor
    /**
    * Class destructor
    * @access public
    */
    public function __destruct() {
    } // end destructor
    /**
    * Returns a singleton instance of Uri_Redirects
    * @uses is_array()
    * 
    * @access public
    * @return Uri_Redirects
    */
    public static function i() {
      if ( !self::$_singleton instanceof Uri_Redirects ) {
        include_once Usu_Main::i()->getVar( 'includes_path' ) . 'uri_redirects_array.php';
        if ( isset( $usu5_uri_redirects ) && is_array( $usu5_uri_redirects ) && !empty( $usu5_uri_redirects ) ) {
          self::$redirects = $usu5_uri_redirects;
        }
        self::$_singleton = new self;
      }
      return self::$_singleton; 
    } // end method
    /**
    * Iterates the redirects array returning the uri to redirect to if a match is found
    * @uses htmlspecialchars_decode()
    * 
    * @access public
    * @return mixed - bool false / string redirection url 
    */
    public function needsRedirect() {
     if ( !empty( self::$redirects ) ) {
       foreach ( self::$redirects as $target => $uri_data ) {
         if ( Usu_Main::i()->getVar( 'request_uri' ) == $target ) {
           return htmlspecialchars_decode( tep_href_link( $uri_data[0], $uri_data[1] ) );
         }
       }
     }
     return false;
    }

  } // end class