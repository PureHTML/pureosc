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
class LOGIN
{
    public $_title;
    public $_short_title;
    public $_introduction;
    public $_req_notes;
    public $_cm_code = 'login/cm_paypal_login';
    public $_sort_order = 1000;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->_title = $OSCOM_PayPal->getDef('module_login_title');
        $this->_short_title = $OSCOM_PayPal->getDef('module_login_short_title');
        $this->_introduction = $OSCOM_PayPal->getDef('module_login_introduction');

        $this->_req_notes = [];

        if (!\function_exists('curl_init')) {
            $this->_req_notes[] = $OSCOM_PayPal->getDef('module_login_error_curl');
        }

        if (\defined('OSCOM_APP_PAYPAL_LOGIN_STATUS')) {
            if (((OSCOM_APP_PAYPAL_LOGIN_STATUS === '1') && (!tep_not_null(OSCOM_APP_PAYPAL_LOGIN_LIVE_CLIENT_ID) || !tep_not_null(OSCOM_APP_PAYPAL_LOGIN_LIVE_SECRET))) || ((OSCOM_APP_PAYPAL_LOGIN_STATUS === '0') && (!tep_not_null(OSCOM_APP_PAYPAL_LOGIN_SANDBOX_CLIENT_ID) || !tep_not_null(OSCOM_APP_PAYPAL_LOGIN_SANDBOX_SECRET)))) {
                $this->_req_notes[] = $OSCOM_PayPal->getDef('module_login_error_credentials');
            }

            $this->_req_notes[] = $OSCOM_PayPal->getDef('module_login_notice_paypal_app_return_url', [
                'return_url' => tep_catalog_href_link('login.php', 'action=paypal_login'),
            ]);
        }
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getShortTitle()
    {
        return $this->_short_title;
    }

    public function install($OSCOM_PayPal): void
    {
        $installed = explode(';', MODULE_CONTENT_INSTALLED);
        $installed[] = $this->_cm_code;

        $OSCOM_PayPal->saveParameter('MODULE_CONTENT_INSTALLED', implode(';', $installed));
    }

    public function uninstall($OSCOM_PayPal): void
    {
        $installed = explode(';', MODULE_CONTENT_INSTALLED);
        $installed_pos = array_search($this->_cm_code, $installed, true);

        if ($installed_pos !== false) {
            unset($installed[$installed_pos]);

            $OSCOM_PayPal->saveParameter('MODULE_CONTENT_INSTALLED', implode(';', $installed));
        }
    }

    public function canMigrate()
    {
        $class = basename($this->_cm_code);

        if (file_exists(DIR_FS_CATALOG.'includes/modules/content/'.$this->_cm_code.'.php')) {
            if (!class_exists($class)) {
                include DIR_FS_CATALOG.'includes/modules/content/'.$this->_cm_code.'.php';
            }

            $module = new $class();

            if (isset($module->signature)) {
                $sig = explode('|', $module->signature);

                if (isset($sig[0]) && ($sig[0] === 'paypal') && isset($sig[1]) && ($sig[1] === 'paypal_login') && isset($sig[2])) {
                    return version_compare($sig[2], 4) >= 0;
                }
            }
        }

        return false;
    }

    public function migrate($OSCOM_PayPal): void
    {
        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE')) {
            $server = (MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE === 'Live') ? 'LIVE' : 'SANDBOX';

            if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_CLIENT_ID')) {
                if (tep_not_null(MODULE_CONTENT_PAYPAL_LOGIN_CLIENT_ID)) {
                    if (!\defined('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_CLIENT_ID') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_CLIENT_ID'))) {
                        $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_CLIENT_ID', MODULE_CONTENT_PAYPAL_LOGIN_CLIENT_ID);
                    }
                }

                $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_CLIENT_ID');
            }

            if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_SECRET')) {
                if (tep_not_null(MODULE_CONTENT_PAYPAL_LOGIN_SECRET)) {
                    if (!\defined('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_SECRET') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_SECRET'))) {
                        $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_'.$server.'_SECRET', MODULE_CONTENT_PAYPAL_LOGIN_SECRET);
                    }
                }

                $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_SECRET');
            }
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_THEME')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_THEME', MODULE_CONTENT_PAYPAL_LOGIN_THEME);
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_THEME');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_ATTRIBUTES')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_ATTRIBUTES', MODULE_CONTENT_PAYPAL_LOGIN_ATTRIBUTES);
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_ATTRIBUTES');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_CONTENT_WIDTH')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_CONTENT_WIDTH', MODULE_CONTENT_PAYPAL_LOGIN_CONTENT_WIDTH, 'Content Width', 'Should the content be shown in a full or half width container?', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ');
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_CONTENT_WIDTH');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_SORT_ORDER')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_SORT_ORDER', MODULE_CONTENT_PAYPAL_LOGIN_SORT_ORDER, 'Sort Order', 'Sort order of display (lowest to highest).');
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_SORT_ORDER');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_STATUS')) {
            $status = '-1';

            if ((MODULE_CONTENT_PAYPAL_LOGIN_STATUS === 'True') && \defined('MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE')) {
                if (MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE === 'Live') {
                    $status = '1';
                } else {
                    $status = '0';
                }
            }

            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_LOGIN_STATUS', $status);
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_STATUS');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE')) {
            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_VERIFY_SSL')) {
            if (!\defined('OSCOM_APP_PAYPAL_VERIFY_SSL')) {
                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_VERIFY_SSL', (MODULE_CONTENT_PAYPAL_LOGIN_VERIFY_SSL === 'True') ? '1' : '0');
            }

            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_VERIFY_SSL');
        }

        if (\defined('MODULE_CONTENT_PAYPAL_LOGIN_PROXY')) {
            if (!\defined('OSCOM_APP_PAYPAL_PROXY')) {
                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_PROXY', MODULE_CONTENT_PAYPAL_LOGIN_PROXY);
            }

            $OSCOM_PayPal->deleteParameter('MODULE_CONTENT_PAYPAL_LOGIN_PROXY');
        }
    }
}
