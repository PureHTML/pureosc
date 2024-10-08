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

require DIR_FS_CATALOG.'includes/classes/action_recorder.php';

class actionRecorderAdmin extends action_recorder
{
    public function __construct($module, $user_id = null, $user_name = null)
    {
        global $language, $PHP_SELF;

        $module = tep_sanitize_string(str_replace(' ', '', $module));

        if (\defined('MODULE_ACTION_RECORDER_INSTALLED') && !empty(MODULE_ACTION_RECORDER_INSTALLED)) {
            if (!empty($module) && \in_array($module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1), explode(';', MODULE_ACTION_RECORDER_INSTALLED), true)) {
                if (!class_exists($module)) {
                    if (file_exists(DIR_FS_CATALOG.'includes/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1))) {
                        include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1);

                        include DIR_FS_CATALOG.'includes/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1);
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

        $this->_module = $module;

        if (!empty($user_id) && is_numeric($user_id)) {
            $this->_user_id = $user_id;
        }

        if (!empty($user_name)) {
            $this->_user_name = $user_name;
        }

        $GLOBALS[$this->_module] = new $module();
        $GLOBALS[$this->_module]->setIdentifier();
    }
}
