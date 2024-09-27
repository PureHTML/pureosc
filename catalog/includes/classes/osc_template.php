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

class osc_template
{
    public $_title;
    public $_blocks = [];
    public $_content = [];
    public $_grid_container_width = 24;
    public $_grid_content_width = 16;
    public $_grid_column_width = 4;
    public $_data = [];

    public function __construct()
    {
        $this->_title = TITLE;
    }

    public function setGridContainerWidth($width): void
    {
        $this->_grid_container_width = $width;
    }

    public function getGridContainerWidth()
    {
        return $this->_grid_container_width;
    }

    public function setGridContentWidth($width): void
    {
        $this->_grid_content_width = $width;
    }

    public function getGridContentWidth()
    {
        return $this->_grid_content_width;
    }

    public function setGridColumnWidth($width): void
    {
        $this->_grid_column_width = $width;
    }

    public function getGridColumnWidth()
    {
        return $this->_grid_column_width;
    }

    public function setTitle($title): void
    {
        $this->_title = $title;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function addBlock($block, $group): void
    {
        $this->_blocks[$group][] = $block;
    }

    public function hasBlocks($group)
    {
        return isset($this->_blocks[$group]) && !empty($this->_blocks[$group]);
    }

    public function getBlocks($group)
    {
        if ($this->hasBlocks($group)) {
            return '<!-- block '.$group." -->\n".implode("\n", $this->_blocks[$group])."\n<!-- end block ".$group." -->\n";
        }
    }

    public function buildBlocks(): void
    {
        global $language;

        if (\defined('TEMPLATE_BLOCK_GROUPS') && !empty(TEMPLATE_BLOCK_GROUPS)) {
            $tbgroups_array = explode(';', TEMPLATE_BLOCK_GROUPS);

            foreach ($tbgroups_array as $group) {
                $module_key = 'MODULE_'.strtoupper($group).'_INSTALLED';

                if (\defined($module_key) && !empty(\constant($module_key))) {
                    $modules_array = explode(';', \constant($module_key));

                    foreach ($modules_array as $module) {
                        $class = substr($module, 0, strrpos($module, '.'));

                        if (!class_exists($class)) {
                            if (file_exists('includes/languages/'.$language.'/modules/'.$group.'/'.$module)) {
                                include 'includes/languages/'.$language.'/modules/'.$group.'/'.$module;
                            }

                            if (file_exists('includes/modules/'.$group.'/'.$class.'.php')) {
                                include 'includes/modules/'.$group.'/'.$class.'.php';
                            }
                        }

                        if (class_exists($class)) {
                            $mb = new $class();

                            if ($mb->isEnabled()) {
                                $mb->execute();
                            }
                        }
                    }
                }
            }
        }
    }

    public function addContent($content, $group): void
    {
        $this->_content[$group][] = $content;
    }

    public function hasContent($group)
    {
        return isset($this->_content[$group]) && !empty($this->_content[$group]);
    }

    public function getContent($group)
    {
        global $language;

        if (!class_exists('tp_'.$group) && file_exists('includes/modules/pages/tp_'.$group.'.php')) {
            include 'includes/modules/pages/tp_'.$group.'.php';
        }

        if (class_exists('tp_'.$group)) {
            $template_page_class = 'tp_'.$group;
            $template_page = new $template_page_class();
            $template_page->prepare();
        }

        foreach ($this->getContentModules($group) as $module) {
            if (!class_exists($module)) {
                if (file_exists('includes/modules/content/'.$group.'/'.$module.'.php')) {
                    if (file_exists('includes/languages/'.$language.'/modules/content/'.$group.'/'.$module.'.php')) {
                        include 'includes/languages/'.$language.'/modules/content/'.$group.'/'.$module.'.php';
                    }

                    include 'includes/modules/content/'.$group.'/'.$module.'.php';
                }
            }

            if (class_exists($module)) {
                $mb = new $module();

                if ($mb->isEnabled()) {
                    $mb->execute();
                }
            }
        }

        if (class_exists('tp_'.$group)) {
            $template_page->build();
        }

        if ($this->hasContent($group)) {
            return '<!-- block '.$group." -->\n".implode("\n", $this->_content[$group])."\n<!-- end block ".$group." -->\n";
        }
    }

    public function getContentModules($group)
    {
        $result = [];

        foreach (explode(';', MODULE_CONTENT_INSTALLED) as $m) {
            $module = explode('/', $m, 2);

            if ($module[0] === $group) {
                $result[] = $module[1];
            }
        }

        return $result;
    }
}
