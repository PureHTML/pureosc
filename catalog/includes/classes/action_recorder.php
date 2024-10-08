<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
class action_recorder
{
    public $_module;
    public $_user_id;
    public $_user_name;

    public function __construct($module, $user_id = null, $user_name = null)
    {
        global $language, $PHP_SELF;

        $module = tep_sanitize_string(str_replace(' ', '', $module));

        if (\defined('MODULE_ACTION_RECORDER_INSTALLED') && !empty(MODULE_ACTION_RECORDER_INSTALLED)) {
            if (!empty($module) && \in_array($module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1), explode(';', MODULE_ACTION_RECORDER_INSTALLED), true)) {
                if (!class_exists($module)) {
                    if (file_exists('includes/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1))) {
                        include 'includes/languages/'.$language.'/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1);

                        include 'includes/modules/action_recorder/'.$module.'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1);
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

    public function canPerform()
    {
        if (!empty($this->_module)) {
            return $GLOBALS[$this->_module]->canPerform($this->_user_id, $this->_user_name);
        }

        return false;
    }

    public function getTitle()
    {
        if (!empty($this->_module)) {
            return $GLOBALS[$this->_module]->title;
        }
    }

    public function getIdentifier()
    {
        if (!empty($this->_module)) {
            return $GLOBALS[$this->_module]->identifier;
        }
    }

    public function record($success = true)
    {
        if (!empty($this->_module)) {
            tep_db_query("insert into action_recorder (module, user_id, user_name, identifier, success, date_added) values ('".tep_db_input($this->_module)."', '".(int) $this->_user_id."', '".tep_db_input($this->_user_name)."', '".tep_db_input($this->getIdentifier())."', '".($success === true ? 1 : 0)."', now())");

            // reset session token
            return $GLOBALS['sessiontoken'] = md5(tep_rand().tep_rand().tep_rand().tep_rand());
        }
    }

    public function expireEntries()
    {
        if (!empty($this->_module)) {
            return $GLOBALS[$this->_module]->expireEntries();
        }
    }
}
