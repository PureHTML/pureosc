<?php
  /**
  *
  * ULTIMATE Seo Urls 5 PRO ( version 1.1 )
  *
  * 
  * @package Ultimate Seo Urls 5 PRO v1.1
  * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
  * @link http://www.fwrmedia.co.uk
  * @copyright Copyright 2008-2009 FWR Media
  * @copyright Portions Copyright 2005 ( rewrite uri concept ) Bobby Easland
  * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
  * @lastdev $Author:: Rob                                              $:  Author of last commit
  * @lastmod $Date:: 2010-12-21 22:45:02 +0000 (Tue, 21 Dec 2010)       $:  Date of last commit
  * @version $Rev:: 196                                                 $:  Revision of last commit
  * @Id $Id:: cache_interface.php 196 2010-12-21 22:45:02Z Rob          $:  Full Details   
  */
  
  interface iCache_System {
    
    public static function i();
    
    public function store( array $registry_vars = array() );
    
    public function retrieve();
    
    public function gc( $file_info = false );

  } // end interface