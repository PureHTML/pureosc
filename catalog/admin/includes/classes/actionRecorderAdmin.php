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
