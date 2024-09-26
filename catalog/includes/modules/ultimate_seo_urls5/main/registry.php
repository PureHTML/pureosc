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
  * @Id $Id:: registry.php 196 2010-12-21 22:45:02Z Rob                 $:  Full Details   
  */

  /**
  * Data registry
  * 
  * @package USU5_PRO
  */
  final class Data_Registry {

    private static $_singleton = null;
    private $vars = array();
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
    * Returns a singleton instance of the class
    * 
    * @access public
    * @return Data_Registry
    */
    public static function i() {
     if ( !self::$_singleton instanceof Data_Registry ) {
       self::$_singleton = new self;
     }
     return self::$_singleton; 
    } // end method

    /**
    * Prepare the vars array to be serialized
    * 
    * @access public
    * @return $vars
    */
    public function __sleep() {
      return array( 'vars' );
    } // end method
    /**
    * Unimplemented magic method
    * 
    * @access public
    * @return void
    */
    public function __wakeup() {
    } // end method
    /**
    * Attach data to the $vars array
    * 
    * @param string $index - index key of $vars
    * @param string $index2 - secondary index of $vars
    * @example $this->vars[$index][$index2]
    * @param mixed $array_values - bool false / array
    * 
    * @access public
    * @return void
    */
    public function attach( $index, $index2, $array_values = false ) {
      if ( false === array_key_exists( $index, $this->vars ) ) {
        if ( false === $array_values ) {
          return $this->vars[$index] = $index2;
        } else {
          $this->vars[$index] = array();
        }
      }
      if ( false === array_key_exists( $index2, $this->vars[$index] ) ) {
        $this->vars[$index][$index2] = array();
        $this->vars[$index][$index2] = $array_values;
      }
    } // end method
    /**
    * Retrieve data from the $vars array
    * 
    * @param string $index - primary index
    * @param string $index2 - secondary index
    * 
    * @access public
    * @return mixed - bool false / data found by the retrieval
    */
    public function retrieve( $index, $index2 = false ) {
      if ( !is_array( $this->vars ) ) $this->vars = array();
      if ( array_key_exists( $index, $this->vars ) ) {
        if ( false === $index2 ) {
          return $this->vars[$index]; 
        }
        if ( array_key_exists( $index2, $this->vars[$index] ) ) {
          return $this->vars[$index][$index2];
        }
      }
      return false;
    } // end method
    /**
    * Return the $vars array to be stored by the cache system
    * 
    * @access public
    * @return array $vars
    */
    public function store() {
      return $this->vars;
    }
    /**
    * Re populate the registry from the cache system
    * 
    * @see USU_Main::extractCacheData()
    * @param mixed $cached_registry_data
    * 
    * @access public
    * @return void
    */
    public function load( array $cached_registry_data = array() ) {
      $this->vars = $cached_registry_data;
    }

  } // end class