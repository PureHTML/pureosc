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
class HS
{
    public $_title;
    public $_short_title;
    public $_introduction;
    public $_req_notes;
    public $_pm_code = 'paypal_pro_hs';
    public $_sort_order = 300;

    public function __construct()
    {
        global $OSCOM_PayPal;

        $this->_title = $OSCOM_PayPal->getDef('module_hs_title');
        $this->_short_title = $OSCOM_PayPal->getDef('module_hs_short_title');
        $this->_introduction = $OSCOM_PayPal->getDef('module_hs_introduction');

        $this->_req_notes = [];

        if (!\function_exists('curl_init')) {
            $this->_req_notes[] = $OSCOM_PayPal->getDef('module_hs_error_curl');
        }

        if (\defined('OSCOM_APP_PAYPAL_GATEWAY')) {
            if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && !$OSCOM_PayPal->hasCredentials('HS')) { // PayPal
                $this->_req_notes[] = $OSCOM_PayPal->getDef('module_hs_error_credentials');
            } elseif (OSCOM_APP_PAYPAL_GATEWAY === '0') { // Payflow
                $this->_req_notes[] = $OSCOM_PayPal->getDef('module_hs_error_payflow');
            }
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
        $installed = explode(';', MODULE_PAYMENT_INSTALLED);
        $installed[] = $this->_pm_code.'.php';

        $OSCOM_PayPal->saveParameter('MODULE_PAYMENT_INSTALLED', implode(';', $installed));
    }

    public function uninstall($OSCOM_PayPal): void
    {
        $installed = explode(';', MODULE_PAYMENT_INSTALLED);
        $installed_pos = array_search($this->_pm_code.'.php', $installed, true);

        if ($installed_pos !== false) {
            unset($installed[$installed_pos]);

            $OSCOM_PayPal->saveParameter('MODULE_PAYMENT_INSTALLED', implode(';', $installed));
        }
    }

    public function canMigrate()
    {
        $class = $this->_pm_code;

        if (file_exists(DIR_FS_CATALOG.'includes/modules/payment/'.$class.'.php')) {
            if (!class_exists($class)) {
                include DIR_FS_CATALOG.'includes/modules/payment/'.$class.'.php';
            }

            $module = new $class();

            if (isset($module->signature)) {
                $sig = explode('|', $module->signature);

                if (isset($sig[0]) && ($sig[0] === 'paypal') && isset($sig[1]) && ($sig[1] === $class) && isset($sig[2])) {
                    return version_compare($sig[2], 4) >= 0;
                }
            }
        }

        return false;
    }

    public function migrate($OSCOM_PayPal): void
    {
        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER')) {
            $server = (MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER === 'Live') ? 'LIVE' : 'SANDBOX';

            if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_ID')) {
                if (tep_not_null(MODULE_PAYMENT_PAYPAL_PRO_HS_ID)) {
                    if (!\defined('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL'))) {
                        $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL', MODULE_PAYMENT_PAYPAL_PRO_HS_ID);
                    }
                }

                $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_ID');
            }

            if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_PRIMARY_ID')) {
                if (tep_not_null(MODULE_PAYMENT_PAYPAL_PRO_HS_PRIMARY_ID)) {
                    if (!\defined('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL_PRIMARY') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL_PRIMARY'))) {
                        $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL_PRIMARY', MODULE_PAYMENT_PAYPAL_PRO_HS_PRIMARY_ID);
                    }
                }

                $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_PRIMARY_ID');
            }

            if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_API_USERNAME') && \defined('MODULE_PAYMENT_PAYPAL_PRO_HS_API_PASSWORD') && \defined('MODULE_PAYMENT_PAYPAL_PRO_HS_API_SIGNATURE')) {
                if (tep_not_null(MODULE_PAYMENT_PAYPAL_PRO_HS_API_USERNAME) && tep_not_null(MODULE_PAYMENT_PAYPAL_PRO_HS_API_PASSWORD) && tep_not_null(MODULE_PAYMENT_PAYPAL_PRO_HS_API_SIGNATURE)) {
                    if (!\defined('OSCOM_APP_PAYPAL_'.$server.'_API_USERNAME') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_'.$server.'_API_USERNAME'))) {
                        if (!\defined('OSCOM_APP_PAYPAL_'.$server.'_API_PASSWORD') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_'.$server.'_API_PASSWORD'))) {
                            if (!\defined('OSCOM_APP_PAYPAL_'.$server.'_API_SIGNATURE') || !tep_not_null(\constant('OSCOM_APP_PAYPAL_'.$server.'_API_SIGNATURE'))) {
                                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_'.$server.'_API_USERNAME', MODULE_PAYMENT_PAYPAL_PRO_HS_API_USERNAME);
                                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_'.$server.'_API_PASSWORD', MODULE_PAYMENT_PAYPAL_PRO_HS_API_PASSWORD);
                                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_'.$server.'_API_SIGNATURE', MODULE_PAYMENT_PAYPAL_PRO_HS_API_SIGNATURE);
                            }
                        }
                    }
                }

                $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_API_USERNAME');
                $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_API_PASSWORD');
                $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_API_SIGNATURE');
            }
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_TRANSACTION_METHOD')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_TRANSACTION_METHOD', (MODULE_PAYMENT_PAYPAL_PRO_HS_TRANSACTION_METHOD === 'Sale') ? '1' : '0');
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_TRANSACTION_METHOD');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_PREPARE_ORDER_STATUS_ID')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_PREPARE_ORDER_STATUS_ID', MODULE_PAYMENT_PAYPAL_PRO_HS_PREPARE_ORDER_STATUS_ID);
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_PREPARE_ORDER_STATUS_ID');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_ORDER_STATUS_ID')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_ORDER_STATUS_ID', MODULE_PAYMENT_PAYPAL_PRO_HS_ORDER_STATUS_ID);
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_ORDER_STATUS_ID');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_ZONE')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_ZONE', MODULE_PAYMENT_PAYPAL_PRO_HS_ZONE);
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_ZONE');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_SORT_ORDER')) {
            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_SORT_ORDER', MODULE_PAYMENT_PAYPAL_PRO_HS_SORT_ORDER, 'Sort Order', 'Sort order of display (lowest to highest).');
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_SORT_ORDER');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_TRANSACTIONS_ORDER_STATUS_ID')) {
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_TRANSACTIONS_ORDER_STATUS_ID');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_STATUS')) {
            $status = '-1';

            if ((MODULE_PAYMENT_PAYPAL_PRO_HS_STATUS === 'True') && \defined('MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER')) {
                if (MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER === 'Live') {
                    $status = '1';
                } else {
                    $status = '0';
                }
            }

            $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_HS_STATUS', $status);
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_STATUS');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER')) {
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_GATEWAY_SERVER');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_VERIFY_SSL')) {
            if (!\defined('OSCOM_APP_PAYPAL_VERIFY_SSL')) {
                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_VERIFY_SSL', (MODULE_PAYMENT_PAYPAL_PRO_HS_VERIFY_SSL === 'True') ? '1' : '0');
            }

            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_VERIFY_SSL');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_PROXY')) {
            if (!\defined('OSCOM_APP_PAYPAL_PROXY')) {
                $OSCOM_PayPal->saveParameter('OSCOM_APP_PAYPAL_PROXY', MODULE_PAYMENT_PAYPAL_PRO_HS_PROXY);
            }

            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_PROXY');
        }

        if (\defined('MODULE_PAYMENT_PAYPAL_PRO_HS_DEBUG_EMAIL')) {
            $OSCOM_PayPal->deleteParameter('MODULE_PAYMENT_PAYPAL_PRO_HS_DEBUG_EMAIL');
        }
    }
}
