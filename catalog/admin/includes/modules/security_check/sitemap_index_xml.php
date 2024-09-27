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

class sitemap_index_xml
{
    public $type = 'warning';
    public $title;

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/sitemap_index_xml.php';

        $this->title = MODULE_SECURITY_CHECK_SITEMAP_INDEX_XML_TITLE;
    }

    public function pass()
    {
        if (!file_exists(DIR_FS_CATALOG.'sitemap-index.xml') || filesize(DIR_FS_CATALOG.'/sitemap-index.xml') === 0) {
            return false;
        }

        return true;
    }

    public function getMessage()
    {
        return '<a href="'.tep_catalog_href_link('sitemap.php').'" target="_blank">'.WARNING_SITEMAP_INDEX_XML_EXIST.'</a>';
    }
}
