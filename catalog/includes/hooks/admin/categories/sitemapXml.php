<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// TODO:neponjal orig:admin_categories_sitemapXml
class sitemapXml
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
        $action_list = 'setflag|insert|update|confirm';

        return isset($_GET['action']) && preg_match('/^('.$action_list.')/', $_GET['action']);
    }
}
