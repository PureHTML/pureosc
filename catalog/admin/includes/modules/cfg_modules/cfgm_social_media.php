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

class cfgm_social_media
{
    public $code = 'social_media';
    public $directory;
    public $language_directory = DIR_FS_CATALOG_LANGUAGES;
    public $key = 'MODULE_SOCIAL_MEDIA_INSTALLED';
    public $title;
    public $template_integration = false;

    public function __construct()
    {
        $this->directory = DIR_FS_CATALOG_MODULES.'social_media/';
        $this->title = MODULE_CFG_MODULE_SOCIAL_MEDIA_TITLE;
    }
}
