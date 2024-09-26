<?php
 /**
 *
 * ULTIMATE Seo Urls 5.1 PRO
 *
 * 
 * @package USU5_PRO
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link http://www.fwrmedia.co.uk
 * @copyright Copyright 2008-2009 FWR Media
 * @copyright Portions Copyright 2005 Bobby Easland
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2010-12-21 22:45:02 +0000 (Tue, 21 Dec 2010)       $:  Date of last commit
 * @version $Rev:: 196                                                 $:  Revision of last commit
 * @Id $Id:: osc_experimental.php 196 2010-12-21 22:45:02Z Rob         $:  Full Details   
 */

 /**
 * Module for the osCommerce experimental urls
 * 
 * @package USU5_PRO
 */
  class Osc_Experimental_Uri_Module {
    /**
    * Constructor
    * @access public
    */
    public function __construct() {
    } // end constructor
    /**
    * Strip an seo uri
    * 
    * @param string $fulluri - uri to be stripped
    * @return bool false
    */
    public function stripSeoUri( $fulluri ) {
      return false;
    } // end method
    /**
    * Ensure the difference between this uri class and all the other uri classes.
    * Marker validity is checked later
    * @uses substr()
    * @uses strpos()
    * 
    * @access public
    * @return bool - true ( not identified as another uri type ) false ( identified as a different uri type )
    */
    public function isValidUri() {
      // Check for an seo url marker, if there it is not an experimental uri
      $dependencies = Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) )->retrieveDependencies();
      foreach ( $dependencies as $dep => $dummy ) {
        if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), $dependencies[$dep]['marker'] ) ) {
          return false;
        }
      } 
      if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), '.html' ) ) { // uri should not have .html
        return false;
      }
      if ( false === strpos( Usu_Main::i()->getVar( 'request_uri' ), '/' ) ) { // uri must have / in the uri
        return false;
      }
      return __CLASS__;
    } // end method
    /**
    * Break up an osC experimental seo url into an _GET query
    * Add the key => value pairs to _GET and $HTTP_GET_VARS
    * @uses explode()
    * @uses count()
    * @uses http_build_query(
    * @see Usu_Main::setVar()
    * @see Usu_Main::getVar()
    * @see includes/usu_general_functions.php usu_cleanse()
    * 
    * @access public
    * @return string - querystring
    */
    public function parsePath() {
      global $HTTP_GET_VARS;
      Usu_Main::i()->setVar( 'parsing_module', __CLASS__ );
      $tmp = explode( '/', Usu_Main::i()->getVar( 'request_uri' ) );
      $count = count( $tmp );
      for ( $i=0; $i<$count; $i=$i+2 ) {
        $newget[usu_cleanse( $tmp[$i] )] = usu_cleanse( $tmp[$i+1] );
        // assign cleansed key=>value pair to _GET
        $_GET[usu_cleanse( $tmp[$i] )] = usu_cleanse( $tmp[$i+1] );
        $HTTP_GET_VARS[usu_cleanse( $tmp[$i] )] = usu_cleanse( $tmp[$i+1] );
      }
      Usu_Main::i()->setVar( 'request_querystring', http_build_query( $_GET ) );
      // Newly created _GET array added to the querystring and converted to _GET string
      return http_build_query( $newget );
    } // End method

  } // End class