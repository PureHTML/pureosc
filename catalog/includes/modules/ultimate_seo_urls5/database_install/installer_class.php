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
  * @Id $Id:: installer_class.php 196 2010-12-21 22:45:02Z Rob          $:  Full Details   
  */

  /**
  * Installs the database entries for USU5 PRO
  * 
  * @package USU5_PRO
  */
  final class Installer_Class {

    private static $_singleton = null;
    private $container = array();
    private $constants = array();
    private $delete_config_group_query = "DELETE FROM :TABLE_CONFIGURATION_GROUP WHERE ( configuration_group_title = 'SEO URLs' OR configuration_group_title = 'SEO URLS 5' )";
    private $delete_config_settings_query = "DELETE FROM :TABLE_CONFIGURATION WHERE configuration_key = ':configuration_key'";
    private $max_sort_query = "SELECT MAX(sort_order) AS current_max FROM :TABLE_CONFIGURATION_GROUP";
    private $install_config_group_query = "INSERT INTO :TABLE_CONFIGURATION";
    private $config_group_id = null;
    private $sort_order = null;
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
    * @access public
    * @return Installer_Class
    */
    public static function i() {
     if ( !self::$_singleton instanceof Installer_Class ) {
       self::$_singleton = new self;
     }
     return self::$_singleton; 
    } // end method
    /**
    * Add configuration constants, these are configuration keys in the osCommerce database
    * 
    * @see Usu5_Bootstrap::adminInstalled()
    * @param array $array - array of configuration keys
    * 
    * @access public
    * @return Installer_Class - chaining
    */
    public function setConfigConstants( array $array = array() ) {
      $this->container[] = $array;
      return $this;
    } // end method
    /**
    * Iterate the constants container adding them to the constants array if not already present
    * @see Usu5_Bootstrap::adminInstalled()
    * @uses in_array()
    * 
    * @access public
    * @return void
    */
    public function setConfigArray() {
      foreach (  $this->container as $numkey => $array ) {
        foreach ( $array as $numkey2 => $constant ) {
          if ( !in_array( $constant, $this->constants ) ) {
            $this->constants[] = $constant;
          }
        }
      }
      return $this;
    } // end method
    /**
    * Remove the configuration group settings of either the old series 2 seo urls or USU5/PRO
    * @uses str_replace()
    * @see Usu5_Bootstrap::adminInstalled()
    * 
    * @access public
    * @return Installer_Class - chaining
    */
    public function removeConfigurationGroup() {
      tep_db_query( str_replace( ':TABLE_CONFIGURATION_GROUP', TABLE_CONFIGURATION_GROUP, $this->delete_config_group_query ) );
      return $this; 
    } // end method
    /**
    * Remove the configuration settings of either the old series 2 seo urls or USU5/PRO
    * 
    * Iterates the constants array removing all from the osCommerce configuration table
    * @uses str_replace()
    * @see Usu5_Bootstrap::adminInstalled()
    * 
    * @access public
    * @return Installer_Class - chaining
    */
    public function removeConfigurationSettings() {
      $it = new ArrayIterator( $this->constants );
      while ( $it->valid() ) {
        $to_replace = array( ':TABLE_CONFIGURATION', ':configuration_key' );
        $replacements = array( TABLE_CONFIGURATION, $it->current() ); 
        tep_db_query( str_replace( $to_replace, $replacements, $this->delete_config_settings_query ) ); 
        $it->next();
      }
      return $this;
    } // end method
    /**
    * Drop the cache table of USU5/PRO - series 2 table named just "cache" is left in place in case it is being used for the advanced cache contribution.
    * 
    * @access public
    * @return void
    */
    public function dropTable() {
      $query = "DROP TABLE IF EXISTS usu_cache";
      tep_db_query( $query );
    }
    /**
    * Intelligently selects the configuration group id to use based on the earliest available.
    * 
    * The majority of osCommerce configuration group tables are corrupted due to bad contributions.
    * This method will "fill in" an earlier unused configuration group id as opposed to "adding to the mayhem"
    * @todo What if there are still entries in the configuration table for the old configuration group id?
    * @uses is_numeric()
    * 
    * @access public
    * @return Installer_Class - chaining
    */
    public function getConfigGroupId() {
      $unused_config_id = '';
      $iterate_config_ids_query = "SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . "";
      $result = tep_db_query( $iterate_config_ids_query );
      // Iterate through all the ids to see if there's a gap we can fill in
      while( $row = tep_db_fetch_array( $result ) ) {
        if ( !isset( $counter ) ) {
          $counter = $row['configuration_group_id'];
        } else {
          if( $row['configuration_group_id'] != $counter+1 ) {
            $unused_config_id = $counter+1; // Found a gap we can use
            break;
          }
          $counter = $row['configuration_group_id']; 
        }
      }
      tep_db_free_result( $result );

      if ( tep_not_null( $unused_config_id ) && is_numeric( $unused_config_id ) ) {
        $this->config_group_id = $unused_config_id; // use the gap we found
      } else {
        // Get the next available auto increment
        $next_auto_increment_query = "SHOW TABLE STATUS LIKE '" . TABLE_CONFIGURATION_GROUP . "'";
        $result = tep_db_query( $next_auto_increment_query );
        $row = tep_db_fetch_array( $result );
        tep_db_free_result( $result );
        $auto_increment = $row['Auto_increment'];
        // Many osCommerce databases have messed up auto increments so in this case we would use ( $counter +1 )
        if ( ( $counter +1 ) < $auto_increment ) {
          $this->config_group_id = ( $counter +1 ); // Auto increment looks ruined so we use the last entry +1
        } else {
          $this->config_group_id = $row['Auto_increment']; // Use the next auto increment
        } 
      }
      return $this;
    } // end method
    /**
    * Set the sort order of our configuration group id
    * @uses str_replace()
    * 
    * @access public
    * @return Installer_Class - chaining 
    */
    public function getMaxSort() {
      $to_replace = array( ':TABLE_CONFIGURATION_GROUP' );
      $replacements = array( TABLE_CONFIGURATION_GROUP );
      $result = tep_db_query( str_replace( $to_replace, $replacements, $this->max_sort_query ) );
      $row = tep_db_fetch_array( $result );
      tep_db_free_result( $result );
      $this->sort_order = ( $row['current_max'] +1 );
      return $this; 
    } // end method
    /**
    * Add our configuration group to the table
    * 
    * @uses implode()
    * @uses array_keys()
    * @uses str_replace()
    * @param array $data - array of configuration group data
    * 
    * @access public
    * @return Installer_Class - chaining 
    */
    public function addConfigGroup( array $data = array() ) {
      $query = "INSERT INTO " . TABLE_CONFIGURATION_GROUP . " ";
      $query .= "(" . implode( ',', array_keys( $data ) ) . ") VALUES ";
      $query .= "(" . implode( ',', array_values( $data ) ) . ")";
      $query = str_replace( array( '[--config_group_id--]', '[--sort_order--]' ), array( $this->config_group_id, $this->sort_order ), $query );
      tep_db_query( $query );
      return $this; 
    } // end method
    /**
    * Add our configuration data to the table
    * 
    * @uses implode()
    * @uses array_keys()
    * @uses str_replace()
    * @param array $data - array of configuration data
    * 
    * @access public
    * @return Installer_Class - chaining 
    */
    public function addConfigSettings( $data ) {
      foreach ( $data as $index => $config_vals ) {
        $query = "INSERT INTO " . TABLE_CONFIGURATION . " ";
        $query .= "(" . implode( ',', array_keys( $config_vals ) ) . ") VALUES ";
        $query .= "(" . implode( ',', array_values( $config_vals ) ) . ")";
        $query = str_replace('[--config_group_id--]', $this->config_group_id, $query );
        tep_db_query( $query );
      }
      return $this;
    } // end method
    /**
    * Add the USU5 PRO cache table to the database
    * 
    * @access public
    * @return void
    */
    public function addTable() {
      $query = "CREATE TABLE IF NOT EXISTS `usu_cache` ( `cache_name` varchar(64) NOT NULL, `cache_data` mediumtext NOT NULL, `cache_date` datetime NOT NULL, UNIQUE KEY `cache_name` (`cache_name`) );";
      tep_db_query( $query );
    } // end method

  } // end class
