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
  * @Id $Id:: uri_modules.php 196 2010-12-21 22:45:02Z Rob              $:  Full Details   
  */

  /**
  * Abstract class extended by all uri modules
  * 
  * Sets the contract for all uri modules to implement the abstract methods of this class
  * @package USU5_PRO
  */
  abstract class aUri_Modules {
    /**
    * Abstract method implemented in the uri modules.
    * 
    * Creates a link string based on the uri type
    * 
    * @see includes/usu_general_functions usu5_multi_language()
    * @param string $page - base filename
    * @param string $text - uri link text
    * @param string $seperator - e.g. -p- or -c-
    * @param string $value - either an integer or a path based string
    * 
    * @access public
    */
    abstract public function createLinkString( $page, $text, $seperator, $value );
    /**
    * Abstract method implemented in the uri modules.
    * 
    * Seperates the uri text with e.g. hyphen
    * 
    * @param array $array
    * @todo method should be separateUriText( array $array = array() )
    * 
    * @access public
    */
    abstract public function separateUriText( $array );
    /**
    * Abstract method implemented in the uri modules.
    * Examines the current request to determine if it is valid for a particular uri module
    * 
    * @access protected
    */
    abstract protected function isValidUri();
    /**
    * Abstract method implemented in the uri modules.
    * Adds a filename to the uri if a non rewrite uri
    * @example product_info.php/my-great-product-p-32
    * 
    * @access public
    */
    abstract public function addFilename();
    /**
    * Global method available to all extending classes, strips scheme, domain, path and querystring from the uri
    * 
    * @param string $fulluri - full request uri
    * @param mixed $basename - looks to be superfluous
    * @uses ltrim()
    * @uses str_replace()
    * @uses strrchr()
    * @todo Remove $basename as it looks superfluous
    * 
    * @access public
    * @return mixed - bool false / string stripped uri
    */
    public function stripSeoUri( $fulluri, $basename ) {
      $http_strip = ltrim( str_replace( array( HTTP_SERVER, HTTPS_SERVER, DIR_WS_CATALOG ), array( '', '', '/' ), $fulluri ), '/' );
      if ( false === $this->isValidUri() ) {
        return false;
      } 
      return str_replace( strrchr( $http_strip, '?' ), '', $http_strip );
    } // end method
    /**
    * Remove the language from the request uri if present
    * 
    * @uses preg_match()
    * @uses array_key_exists()
    * @uses str_replace()
    * 
    * @access protected
    * @return string - uri with language removed
    * 
    */
    protected function withoutLanguage() {
      preg_match( '@^[a-z]{2}/@', Usu_Main::i()->getVar( 'request_uri' ), $matches );
      if ( array_key_exists( 0, $matches ) ) {
        return str_replace( $matches[0], '', Usu_Main::i()->getVar( 'request_uri' ) );
      }
      return Usu_Main::i()->getVar( 'request_uri' );
    } // end method

  } // end class