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
  * @lastmod $Date:: 2011-01-26 15:27:34 +0000 (Wed, 26 Jan 2011)       $:  Date of last commit
  * @version $Rev:: 199                                                 $:  Revision of last commit
  * @Id $Id:: newsdesk_reviews_info.php 199 2011-01-26 15:27:34Z Rob    $:  Full Details   
  */

  /**
  * Page module for newsdesk reviews info
  * 
  * @package USU5_PRO
  */
  class Newsdesk_Reviews_Info_Page_Module extends aPage_Modules {
    private static $_singleton = null;
    /**
    * Array of _GET key dependencies for this page
    * - marker is the seo url replacement for the dependent _GET key ( e.g. -c- replaces cPath )
    * - query is the query used to extract the link text from the database
    * - to_replace is an array of texts that are to be replace with real values in the query
    * @example protected $dependencies = array( 'cPath' => array( 'marker'     => '-c-',
    * @var array $dependencies
    */
    protected $dependencies = array( 'reviews_id' => array( 'marker'     => '-nri-',
                                                            'query'      => "SELECT newsdesk_article_name FROM :TABLE_NEWSDESK_DESCRIPTION WHERE newsdesk_id=':reviews_id' AND language_id=':languages_id' LIMIT 1",
                                                            'to_replace' => array( ':TABLE_NEWSDESK_DESCRIPTION', ':reviews_id', ':languages_id' ) ) );
    /**
    * The current dependency key extracted from the incoming parameters
    *                                                               
    * @var string $key - dependency key
    */
    protected $key = null;
    /**
    * extracts the key => value pairs from the querystring in order to build a unique cache name for the loaded page
    *  
    * @var array $cache_name_builder
    */
    protected $cache_name_builder = array( 'reviews_id' => 1 ); // xxx = _GET key ( e.g. cPath ), you may want to add "page" if there are paging functions
    /**
    * Class constructor
    * @access private
    */
    private function __construct() {
    } // end constructor
    /**
    * Returns a singleton instance of this object
    * 
    * @access public
    * @return Newsdesk_Reviews_Info_Page_Module
    */
    public static function i() {
     if ( !self::$_singleton instanceof self ) {
       self::$_singleton = new self;
     }
     return self::$_singleton; 
    } // end method
    /**
    * Retrieve the dependencies array for this page module
    * 
    * @access public
    * @return array $dependencies
    */
    public function retrieveDependencies() {
      return $this->dependencies;
    }
    /**
    * Acquire an array of single or multiple link texts from the query
    * this will be cached for later retrieval.
    * 
    * @see Usu_Main::query()
    * @uses trim()
    * 
    * @access protected
    * @return array array of link test 
    */
    protected function acquireLinkText() {
      $result = Usu_Main::i()->query( $this->query );
      $text_array = tep_db_fetch_array( $result );
      tep_db_free_result( $result );
      if ( false === $text_array ) {
        return false;
      }
      $final_text_array = array();
      foreach ( $text_array as $key => $text ) {
        if ( tep_not_null( trim( $text ) ) ) {
          $final_text_array[$key] = $text;
        }
      }
      // We will cache this result 
      return $final_text_array;
    }
    /**
    * The main method of this class that receives input needed to build a link
    * then finally returns a fully built seo link if it has not previousluy returned false.
    * 
    * @see Usu_Main::getVar()
    * @see Usu_Main::setVar()
    * @see aPage_Modules::stripPathToLastNumber()
    * @see aPage_Modules::setQuery()
    * @see aPage_Modules::unsetProperties()
    * @see aPage_Modules::getDependencyKey()
    * @see aPage_Modules::setAllParams()
    * @see aPage_Modules::validRequest()
    * @see aPage_Modules::returnFinalLink()
    * @param string $page - valid osCommerce page name
    * @param string $parameters - querystring parameters
    * @param bool $add_session_id - true / false
    * @param string $connection - NONSSL / SSL
    * @param array $extract - array of _GET keys to remove from the querystring or bool false to do nothing
    * @uses trigger_error()
    * @throws - triggers an error of type E_USER_WARNING for an incorrect or inexistant dependency key
    * @access public
    * @return bool false - forces the system to return the standard osCommerce link wrapper
    * @return string - fully built seo url
    */
    public function buildLink( $page, $parameters, $add_session_id, $connection ) {
      $extract = array( 'reviews_id' );
      $this->setAllParams( $page, $parameters, $add_session_id, $connection, $extract );
      if ( false === $this->validRequest() ) {
        $this->unsetProperties();
        return false;
      }
      $this->key = $this->getDependencyKey();
      /**
      * If the shop has issues it may pass in null values, in this case return false to force the standard osCommerce link wrapper
      */
      if ( !array_key_exists( $this->key, $this->keys_index ) || !tep_not_null( $this->keys_index[$this->key] ) ) {
        return false;
      }
      // Switch statement where the correct query and query marker replacements to use are selected via the _GET key detected
      switch ( true ) {
        case $this->key == 'reviews_id': // xxx = _GET key ( e.g. cPath )
          // This array contains replacements for the to_replace array ( see the $dependencies array )
          $this->setQuery( array( TABLE_NEWSDESK_DESCRIPTION, $this->stripPathToLastNumber( $this->keys_index[$this->key] ), Usu_Main::i()->getVar( 'languages_id' ) ) );
          break;
        default:
          trigger_error( __CLASS__ . '::' . __FUNCTION__ . ' Incorrect or inexistant dependency key.', E_USER_WARNING );
          break;
      } // end switch
      $link_text = $this->acquireLinkText();
      // If the query returned false then we return nothing and set $page_not_found to true forcing a 404 page
      Usu_Main::i()->setVar( 'page_not_found', false );
      if ( false === $link_text ) {
        Usu_Main::i()->setVar( 'page_not_found', true );
        $this->unsetProperties();
        return;
      }
      // Return a fully built seo url
      return $this->returnFinalLink( Usu_Main::i()
                  ->getVar( 'uri_modules', USU5_URLS_TYPE )
                  ->createLinkString( $this->page, Usu_Main::i()
                  ->getVar( 'uri_modules', USU5_URLS_TYPE )
                  ->separateUriText( $this->linktext( $link_text ) ), $this->dependencies[$this->key]['marker'], $this->keys_index[$this->key] ) );
    } // end method

  } // end class