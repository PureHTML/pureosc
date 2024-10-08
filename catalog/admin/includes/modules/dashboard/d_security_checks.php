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
class d_security_checks
{
    public $code = 'd_security_checks';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_TITLE;
        $this->description = MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_DESCRIPTION;

        if (\defined('MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER;
            $this->enabled = (MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        global $PHP_SELF;

        $output = '';

        $secCheck_types = ['info', 'warning', 'error'];
        $secCheck_messages = [];

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $secmodules_array = [];

        if ($secdir = @dir(DIR_FS_ADMIN.'includes/modules/security_check/')) {
            while ($file = $secdir->read()) {
                if (!is_dir(DIR_FS_ADMIN.'includes/modules/security_check/'.$file)) {
                    if (substr($file, strrpos($file, '.')) === $file_extension) {
                        $secmodules_array[] = $file;
                    }
                }
            }

            sort($secmodules_array);
            $secdir->close();
        }

        foreach ($secmodules_array as $secmodule) {
            include DIR_FS_ADMIN.'includes/modules/security_check/'.$secmodule;

            $secclass = 'securityCheck_'.substr($secmodule, 0, strrpos($secmodule, '.'));

            if (tep_class_exists($secclass)) {
                $secCheck = new $secclass();

                if (!$secCheck->pass()) {
                    if (!\in_array($secCheck->type, $secCheck_types, true)) {
                        $secCheck->type = 'info';
                    }

                    $secCheck_messages[$secCheck->type][] = $secCheck->getMessage();
                }
            }
        }

        if (isset($secCheck_messages['error'])) {
            $output .= '<div class="secError">';

            foreach ($secCheck_messages['error'] as $error) {
                $output .= '<p class="smallText">'.$error.'</p>';
            }

            $output .= '</div>';
        }

        if (isset($secCheck_messages['warning'])) {
            $output .= '<div class="secWarning">';

            foreach ($secCheck_messages['warning'] as $warning) {
                $output .= '<p class="smallText">'.$warning.'</p>';
            }

            $output .= '</div>';
        }

        if (isset($secCheck_messages['info'])) {
            $output .= '<div class="secInfo">';

            foreach ($secCheck_messages['info'] as $info) {
                $output .= '<p class="smallText">'.$info.'</p>';
            }

            $output .= '</div>';
        }

        if (empty($secCheck_messages)) {
            $output .= '<div class="secSuccess"><p class="smallText">'.MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SUCCESS.'</p></div>';
        }

        return $output;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Security Checks Module', 'MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS', 'True', 'Do you want to run the security checks for this installation?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS', 'MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER'];
    }
}
