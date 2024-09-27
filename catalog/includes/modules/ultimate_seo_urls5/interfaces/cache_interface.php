<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
   * ULTIMATE Seo Urls 5 PRO ( version 1.1 ).
   *
   * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
   *
   * @see http://www.fwrmedia.co.uk
   *
   * @copyright Copyright 2008-2009 FWR Media
   * @copyright Portions Copyright 2005 ( rewrite uri concept ) Bobby Easland
   * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk
   *
   * @lastdev $Author:: Rob                                              $:  Author of last commit
   *
   * @lastmod $Date:: 2010-12-21 22:45:02 +0000 (Tue, 21 Dec 2010)       $:  Date of last commit
   *
   * @version $Rev:: 196                                                 $:  Revision of last commit
   *
   * @Id $Id:: cache_interface.php 196 2010-12-21 22:45:02Z Rob          $:  Full Details
   */
interface cache_interface
{
    public static function i();

    public function store(array $registry_vars = []);

    public function retrieve();

    public function gc($file_info = false);
} // end interface
