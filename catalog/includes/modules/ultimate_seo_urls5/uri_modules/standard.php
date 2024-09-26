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
 * @Id $Id:: standard.php 196 2010-12-21 22:45:02Z Rob                 $:  Full Details   
 */

 /**
 * Standard uri modiule
 * 
 * @example product_info.php/my-great-product-p-47
 * @package USU5_PRO 
 */
  class Standard_Uri_Module extends aUri_Modules {
    /**
    * Class constructor
    * @access public
    */
    public function __construct() {
    } // end constructor
    /**
    * Add the base file name to the uri
    *
    * @access public
    * @return base filename/
    */
    public function addFilename() {
      return usu::$basename . '/';
    }
    /**
    * Create the uri link string for this module
    * 
    * @param string $page - base file name
    * @param string $text - uri link text
    * @param string $seperator - e.g. -p- or -c- etc.
    * @param string $value - integer or string if a path like 44_22_2
    * @see includes/usu_general_functions.php usu5_multi_language()
    * 
    * @access public
    * @return string - uri link string
    */
    public function createLinkString( $page, $text, $seperator, $value ) {
      return $page . '/' . usu5_multi_language( $separator = 'right' ) . $text . $seperator . $value;
    } // end method
    /**
    * Seperate the products test
    * 
    * products text can be made up of category model products name
    * @uses rtrim()
    * 
    * @access public
    * @return string - link text separated by /
    */
    public function separateUriText( $array ) {
      $return = '';
      foreach( $array as $index => $text ) {
        $return .= $text . '-';
      }
      return rtrim( $return, '-' );
    } // end method
    /**
    * Ensure the difference between this uri class and all the other uri classes
    * Marker validity is checked later
    * @uses substr()
    * @uses strpos()
    * @see aUri_Modules::withoutLanguage()
    * @see Usu_Main::getvar()
    * 
    * @access public
    * @return bool - true ( not identified as another uri type ) false ( identified as a different uri type )
    */
    public function isValidUri() {
      $dependencies = Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) )->retrieveDependencies();
      $validated = false;
      foreach ( $dependencies as $dep => $dummy ) {
        // osC experimental urls
        if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), $dep . '/' ) ) {
          return false;
        }
      }
      if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), '.html' ) ) { // Standard seo url does not have .html
        return false;
      }
      // Not a path based uri
      if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), '/' ) ) { // Standard seo url does not have a / in the uri
        return false; // there shouldn't be a seperator in the request_uri
      }
      return __CLASS__;
    } // end method
    /**
    * Parse the path into superglobal _GET and long array HTTP_GET_VARS
    * @uses substr()
    * @uses strpos()
    * @uses explode()
    * @uses str_replace()
    * @uses http_build_query()
    * 
    * @access public
    * @return mixed - bool false / string key=value
    */
    public function parsePath() {
      global $HTTP_GET_VARS;
      Usu_Main::i()->setVar( 'parsing_module', __CLASS__ );
      $dependencies = Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 )  )->retrieveDependencies();
      foreach ( $dependencies as $get_key => $detail ) {
        if ( false !== strpos( Usu_Main::i()->getVar( 'request_uri' ), $detail['marker'] ) ) {
          // Found an seo marker so explode into two component parts
          $tmp = explode( $detail['marker'], Usu_Main::i()->getVar( 'request_uri' ) );
          // assign the key=>value pair to _GET
          $value =  ( false !== strpos($tmp[1], '.html')) ? usu_cleanse( str_replace( '.html', '', $tmp[1] ) ) : usu_cleanse($tmp[1] ); 
          $_GET[$get_key] = $value;
          $HTTP_GET_VARS[$get_key] = $value;
          Usu_Main::i()->setVar( 'request_querystring', http_build_query( $_GET ) );
          return $get_key . '=' .  $value;
        } 
      }
      return false;
    } // end method

  } // End class