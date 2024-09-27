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

class admin_manufacturers_sitemapXml
{
    public function __construct()
    {
        if ($this->isAction()) {
            $this->listen_removeSitemapIndexXml();
        }
    }

    public function listen_removeSitemapIndexXml(): void
    {
        $file_index = DIR_FS_CATALOG.'/sitemap-index.xml';

        if (file_exists($file_index)) {
            @unlink($file_index);
        }
    }

    public function isAction()
    {
        $action_list = 'new|edit|delete';

        return isset($_GET['action']) && !preg_match('/^('.$action_list.')/', $_GET['action']);
    }
}
