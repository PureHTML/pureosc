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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class cfg_modules
{
    public $_modules = [];

    public function __construct()
    {
        global $PHP_SELF, $language;

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $directory = 'includes/modules/cfg_modules';

        if ($dir = @dir($directory)) {
            while ($file = $dir->read()) {
                if (!is_dir($directory.$file)) {
                    if (substr($file, strrpos($file, '.')) === $file_extension) {
                        $class = substr($file, 0, strrpos($file, '.'));

                        include 'includes/languages/'.$language.'/modules/cfg_modules/'.$file;

                        include 'includes/modules/cfg_modules/'.$class.'.php';

                        $m = new $class();

                        $this->_modules[] = ['code' => $m->code,
                            'directory' => $m->directory,
                            'language_directory' => $m->language_directory,
                            'key' => $m->key,
                            'title' => $m->title,
                            'template_integration' => $m->template_integration];
                    }
                }
            }
        }
    }

    public function getAll()
    {
        return $this->_modules;
    }

    public function get($code, $key)
    {
        foreach ($this->_modules as $m) {
            if ($m['code'] === $code) {
                return $m[$key];
            }
        }
    }

    public function exists($code)
    {
        foreach ($this->_modules as $m) {
            if ($m['code'] === $code) {
                return true;
            }
        }

        return false;
    }
}
