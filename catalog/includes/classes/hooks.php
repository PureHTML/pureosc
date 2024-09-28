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

class hooks
{
    public $_site;
    public $_hooks = [];

    public function __construct($site)
    {
        $this->_site = basename($site);

        $this->register('global');
    }

    public function register($group): void
    {
        $group = basename($group);

        $directory = DIR_FS_CATALOG.'includes/hooks/'.$this->_site.'/'.$group;

        if (file_exists($directory)) {
            if ($dir = @dir($directory)) {
                while ($file = $dir->read()) {
                    if (!is_dir($directory.'/'.$file)) {
                        if (substr($file, strrpos($file, '.')) === '.php') {
                            $code = substr($file, 0, strrpos($file, '.'));
                            $class = $code;

                            include $directory.'/'.$file;
                            $GLOBALS[$class] = new $class();

                            foreach (get_class_methods($GLOBALS[$class]) as $method) {
                                if (substr($method, 0, 7) === 'listen_') {
                                    $this->_hooks[$this->_site][$group][substr($method, 7)][] = $code;
                                }
                            }
                        }
                    }
                }

                $dir->close();
            }
        }
    }

    public function call($group, $action)
    {
        $result = '';

        if (isset($this->_hooks[$this->_site][$group][$action])) {
            foreach ($this->_hooks[$this->_site][$group][$action] as $hook) {
                $result .= \call_user_func([$GLOBALS['hook_'.$this->_site.'_'.$group.'_'.$hook], 'listen_'.$action]);
            }
        }

        if (!empty($result)) {
            return $result;
        }
    }
}
