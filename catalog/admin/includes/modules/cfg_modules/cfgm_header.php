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

class cfgm_header
{
    public $code = 'header';
    public $directory;
    public $language_directory = DIR_FS_CATALOG_LANGUAGES;
    public $key = 'MODULE_HEADER_INSTALLED';
    public $title;
    public $template_integration = true;

    public function __construct()
    {
        $this->directory = DIR_FS_CATALOG_MODULES.'header/';
        $this->title = MODULE_CFG_MODULE_HEADER_TITLE;
    }
}
