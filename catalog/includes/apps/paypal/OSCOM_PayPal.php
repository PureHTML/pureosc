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

include DIR_FS_CATALOG.'includes/apps/paypal/functions/compatibility.php';

class OSCOM_PayPal
{
    public $_code = 'paypal';
    public $_title = 'PayPal App';
    public $_version;
    public $_api_version = '204';
    public $_identifier = 'osCommerce_PPapp_v5';
    public $_definitions = [];

    public function log($module, $action, $result, $request, $response, $server, $is_ipn = false)
    {
        global $customer_id;

        $do_log = false;

        if (\in_array(OSCOM_APP_PAYPAL_LOG_TRANSACTIONS, ['1', '0'], true)) {
            $do_log = true;

            if ((OSCOM_APP_PAYPAL_LOG_TRANSACTIONS === '0') && ($result === 1)) {
                $do_log = false;
            }
        }

        if ($do_log !== true) {
            return false;
        }

        $filter = ['ACCT', 'CVV2', 'ISSUENUMBER'];

        $request_string = '';

        if (\is_array($request)) {
            foreach ($request as $key => $value) {
                if ((strpos($key, '_nh-dns') !== false) || \in_array($key, $filter, true)) {
                    $value = '**********';
                }

                $request_string .= $key.': '.$value."\n";
            }
        } else {
            $request_string = $request;
        }

        $response_string = '';

        if (\is_array($response)) {
            foreach ($response as $key => $value) {
                if (\is_array($value)) {
                    $value = http_build_query($value);
                } elseif ((strpos($key, '_nh-dns') !== false) || \in_array($key, $filter, true)) {
                    $value = '**********';
                }

                $response_string .= $key.': '.$value."\n";
            }
        } else {
            $response_string = $response;
        }

        $data = ['customers_id' => isset($_SESSION['customer_id']) ? $customer_id : 0,
            'module' => $module,
            'action' => $action.(($is_ipn === true) ? ' [IPN]' : ''),
            'result' => $result,
            'server' => ($server === 'live') ? 1 : -1,
            'request' => trim($request_string),
            'response' => trim($response_string),
            'ip_address' => sprintf('%u', ip2long(tep_get_ip_address())),
            'date_added' => 'now()'];

        tep_db_perform('oscom_app_paypal_log', $data);
    }

    public function migrate()
    {
        $migrated = false;

        foreach ($this->getModules() as $module) {
            if (!\defined('OSCOM_APP_PAYPAL_'.$module.'_STATUS')) {
                $this->saveParameter('OSCOM_APP_PAYPAL_'.$module.'_STATUS', '');

                $class = 'OSCOM_PayPal_'.$module;

                if (!class_exists($class)) {
                    $this->loadLanguageFile('modules/'.$module.'/'.$module.'.php');

                    include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/'.$module.'.php';
                }

                $m = new $class();

                if (method_exists($m, 'canMigrate') && $m->canMigrate()) {
                    $m->migrate($this);

                    if ($migrated === false) {
                        $migrated = true;
                    }
                }
            }
        }

        return $migrated;
    }

    public function getModules()
    {
        static $result;

        if (!isset($result)) {
            $result = [];

            if ($dir = @dir(DIR_FS_CATALOG.'includes/apps/paypal/modules/')) {
                while ($file = $dir->read()) {
                    if (!\in_array($file, ['.', '..'], true) && is_dir(DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$file) && file_exists(DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$file.'/'.$file.'.php')) {
                        $sort_order = $this->getModuleInfo($file, 'sort_order');

                        if (is_numeric($sort_order)) {
                            $counter = (int) $sort_order;
                        } else {
                            $counter = \count($result);
                        }

                        while (true) {
                            if (isset($result[$counter])) {
                                ++$counter;

                                continue;
                            }

                            $result[$counter] = $file;

                            break;
                        }
                    }
                }

                ksort($result, \SORT_NUMERIC);
            }
        }

        return $result;
    }

    public function isInstalled($module)
    {
        if (file_exists(DIR_FS_CATALOG.'includes/apps/paypal/modules/'.basename($module).'/'.basename($module).'.php')) {
            return \defined('OSCOM_APP_PAYPAL_'.basename($module).'_STATUS') && tep_not_null(\constant('OSCOM_APP_PAYPAL_'.basename($module).'_STATUS'));
        }

        return false;
    }

    public function getModuleInfo($module, $info)
    {
        $class = 'OSCOM_PayPal_'.$module;

        if (!class_exists($class)) {
            $this->loadLanguageFile('modules/'.$module.'/'.$module.'.php');

            include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/'.$module.'.php';
        }

        $m = new $class();

        return $m->{'_'.$info};
    }

    public function hasCredentials($module, $type = null)
    {
        if (!\defined('OSCOM_APP_PAYPAL_'.$module.'_STATUS')) {
            return false;
        }

        $server = \constant('OSCOM_APP_PAYPAL_'.$module.'_STATUS');

        if (!\in_array($server, ['1', '0'], true)) {
            return false;
        }

        $server = ($server === '1') ? 'LIVE' : 'SANDBOX';

        if ($type === 'email') {
            $creds = ['OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL'];
        } elseif (substr($type, 0, 7) === 'payflow') {
            if (\strlen($type) > 7) {
                $creds = ['OSCOM_APP_PAYPAL_PF_'.$server.'_'.strtoupper(substr($type, 8))];
            } else {
                $creds = ['OSCOM_APP_PAYPAL_PF_'.$server.'_VENDOR',
                    'OSCOM_APP_PAYPAL_PF_'.$server.'_PASSWORD',
                    'OSCOM_APP_PAYPAL_PF_'.$server.'_PARTNER'];
            }
        } else {
            $creds = ['OSCOM_APP_PAYPAL_'.$server.'_API_USERNAME',
                'OSCOM_APP_PAYPAL_'.$server.'_API_PASSWORD',
                'OSCOM_APP_PAYPAL_'.$server.'_API_SIGNATURE'];
        }

        foreach ($creds as $c) {
            if (!\defined($c) || (trim(\constant($c)) === '')) {
                return false;
            }
        }

        return true;
    }

    public function getCredentials($module, $type)
    {
        if (\constant('OSCOM_APP_PAYPAL_'.$module.'_STATUS') === '1') {
            if ($type === 'email') {
                return \constant('OSCOM_APP_PAYPAL_LIVE_SELLER_EMAIL');
            }

            if ($type === 'email_primary') {
                return \constant('OSCOM_APP_PAYPAL_LIVE_SELLER_EMAIL_PRIMARY');
            }

            if (substr($type, 0, 7) === 'payflow') {
                return \constant('OSCOM_APP_PAYPAL_PF_LIVE_'.strtoupper(substr($type, 8)));
            }

            return \constant('OSCOM_APP_PAYPAL_LIVE_API_'.strtoupper($type));
        }

        if ($type === 'email') {
            return \constant('OSCOM_APP_PAYPAL_SANDBOX_SELLER_EMAIL');
        }

        if ($type === 'email_primary') {
            return \constant('OSCOM_APP_PAYPAL_SANDBOX_SELLER_EMAIL_PRIMARY');
        }

        if (substr($type, 0, 7) === 'payflow') {
            return \constant('OSCOM_APP_PAYPAL_PF_SANDBOX_'.strtoupper(substr($type, 8)));
        }

        return \constant('OSCOM_APP_PAYPAL_SANDBOX_API_'.strtoupper($type));
    }

    public function hasApiCredentials($server, $type = null)
    {
        $server = ($server === 'live') ? 'LIVE' : 'SANDBOX';

        if ($type === 'email') {
            $creds = ['OSCOM_APP_PAYPAL_'.$server.'_SELLER_EMAIL'];
        } elseif (substr($type, 0, 7) === 'payflow') {
            $creds = ['OSCOM_APP_PAYPAL_PF_'.$server.'_'.strtoupper(substr($type, 8))];
        } else {
            $creds = ['OSCOM_APP_PAYPAL_'.$server.'_API_USERNAME',
                'OSCOM_APP_PAYPAL_'.$server.'_API_PASSWORD',
                'OSCOM_APP_PAYPAL_'.$server.'_API_SIGNATURE'];
        }

        foreach ($creds as $c) {
            if (!\defined($c) || (trim(\constant($c)) === '')) {
                return false;
            }
        }

        return true;
    }

    public function getApiCredentials($server, $type)
    {
        if (($server === 'live') && \defined('OSCOM_APP_PAYPAL_LIVE_API_'.strtoupper($type))) {
            return \constant('OSCOM_APP_PAYPAL_LIVE_API_'.strtoupper($type));
        }

        if (\defined('OSCOM_APP_PAYPAL_SANDBOX_API_'.strtoupper($type))) {
            return \constant('OSCOM_APP_PAYPAL_SANDBOX_API_'.strtoupper($type));
        }
    }

    public function getParameters($module)
    {
        $result = [];

        if ($module === 'G') {
            if ($dir = @dir(DIR_FS_CATALOG.'includes/apps/paypal/cfg_params/')) {
                while ($file = $dir->read()) {
                    if (!is_dir(DIR_FS_CATALOG.'includes/apps/paypal/cfg_params/'.$file) && (substr($file, strrpos($file, '.')) === '.php')) {
                        $result[] = 'OSCOM_APP_PAYPAL_'.strtoupper(substr($file, 0, strrpos($file, '.')));
                    }
                }
            }
        } else {
            if ($dir = @dir(DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/cfg_params/')) {
                while ($file = $dir->read()) {
                    if (!is_dir(DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/cfg_params/'.$file) && (substr($file, strrpos($file, '.')) === '.php')) {
                        $result[] = 'OSCOM_APP_PAYPAL_'.$module.'_'.strtoupper(substr($file, 0, strrpos($file, '.')));
                    }
                }
            }
        }

        return $result;
    }

    public function getInputParameters($module)
    {
        $result = [];

        if ($module === 'G') {
            $cut = 'OSCOM_APP_PAYPAL_';
        } else {
            $cut = 'OSCOM_APP_PAYPAL_'.$module.'_';
        }

        $cut_length = \strlen($cut);

        foreach ($this->getParameters($module) as $key) {
            $p = strtolower(substr($key, $cut_length));

            if ($module === 'G') {
                $cfg_class = 'OSCOM_PayPal_Cfg_'.$p;

                if (!class_exists($cfg_class)) {
                    $this->loadLanguageFile('cfg_params/'.$p.'.php');

                    include DIR_FS_CATALOG.'includes/apps/paypal/cfg_params/'.$p.'.php';
                }
            } else {
                $cfg_class = 'OSCOM_PayPal_'.$module.'_Cfg_'.$p;

                if (!class_exists($cfg_class)) {
                    $this->loadLanguageFile('modules/'.$module.'/cfg_params/'.$p.'.php');

                    include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/cfg_params/'.$p.'.php';
                }
            }

            $cfg = new $cfg_class();

            if (!\defined($key)) {
                $this->saveParameter($key, $cfg->default, $cfg->title ?? null, $cfg->description ?? null, $cfg->set_func ?? null);
            }

            if (!isset($cfg->app_configured) || ($cfg->app_configured !== false)) {
                if (isset($cfg->sort_order) && is_numeric($cfg->sort_order)) {
                    $counter = (int) $cfg->sort_order;
                } else {
                    $counter = \count($result);
                }

                while (true) {
                    if (isset($result[$counter])) {
                        ++$counter;

                        continue;
                    }

                    $set_field = $cfg->getSetField();

                    if (!empty($set_field)) {
                        $result[$counter] = $set_field;
                    }

                    break;
                }
            }
        }

        ksort($result, \SORT_NUMERIC);

        return $result;
    }

    // APP calls require $server to be "live" or "sandbox"
    public function getApiResult($module, $call, $extra_params = null, $server = null, $is_ipn = false)
    {
        if ($module === 'APP') {
            $function = 'OSCOM_PayPal_Api_'.$call;

            if (!\function_exists($function)) {
                include DIR_FS_CATALOG.'includes/apps/paypal/api/'.$call.'.php';
            }
        } else {
            if (!isset($server)) {
                $server = (\constant('OSCOM_APP_PAYPAL_'.$module.'_STATUS') === '1') ? 'live' : 'sandbox';
            }

            $function = 'OSCOM_PayPal_'.$module.'_Api_'.$call;

            if (!\function_exists($function)) {
                include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/api/'.$call.'.php';
            }
        }

        $result = $function($this, $server, $extra_params);

        $this->log($module, $call, ($result['success'] === true) ? 1 : -1, $result['req'], $result['res'], $server, $is_ipn);

        return $result['res'];
    }

    public function makeApiCall($url, $parameters = null, $headers = null, $opts = null)
    {
        $server = parse_url($url);

        if (!isset($server['port'])) {
            $server['port'] = ($server['scheme'] === 'https') ? 443 : 80;
        }

        if (!isset($server['path'])) {
            $server['path'] = '/';
        }

        $curl = curl_init($server['scheme'].'://'.$server['host'].$server['path'].(isset($server['query']) ? '?'.$server['query'] : ''));
        curl_setopt($curl, \CURLOPT_PORT, $server['port']);
        curl_setopt($curl, \CURLOPT_HEADER, false);
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, \CURLOPT_FORBID_REUSE, true);
        curl_setopt($curl, \CURLOPT_FRESH_CONNECT, true);
        curl_setopt($curl, \CURLOPT_ENCODING, ''); // disable gzip

        if (isset($parameters)) {
            curl_setopt($curl, \CURLOPT_POST, true);
            curl_setopt($curl, \CURLOPT_POSTFIELDS, $parameters);
        }

        if (isset($headers) && \is_array($headers) && !empty($headers)) {
            curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        }

        if (isset($server['user'], $server['pass'])) {
            curl_setopt($curl, \CURLOPT_USERPWD, $server['user'].':'.$server['pass']);
        }

        if (\defined('OSCOM_APP_PAYPAL_VERIFY_SSL') && (OSCOM_APP_PAYPAL_VERIFY_SSL === '1')) {
            curl_setopt($curl, \CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, \CURLOPT_SSL_VERIFYHOST, 2);

            if ((substr($server['host'], -10) === 'paypal.com') && file_exists(DIR_FS_CATALOG.'ext/modules/payment/paypal/paypal.com.crt')) {
                curl_setopt($curl, \CURLOPT_CAINFO, DIR_FS_CATALOG.'ext/modules/payment/paypal/paypal.com.crt');
            } elseif (file_exists(DIR_FS_CATALOG.'includes/cacert.pem')) {
                curl_setopt($curl, \CURLOPT_CAINFO, DIR_FS_CATALOG.'includes/cacert.pem');
            }
        } else {
            curl_setopt($curl, \CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, \CURLOPT_SSL_VERIFYHOST, false);
        }

        if (substr($server['host'], -10) === 'paypal.com') {
            $ssl_version = 0;

            if (\defined('OSCOM_APP_PAYPAL_SSL_VERSION') && (OSCOM_APP_PAYPAL_SSL_VERSION === '1')) {
                $ssl_version = 6;
            }

            if (isset($opts['sslVersion']) && \is_int($opts['sslVersion'])) {
                $ssl_version = $opts['sslVersion'];
            }

            if ($ssl_version !== 0) {
                curl_setopt($curl, \CURLOPT_SSLVERSION, $ssl_version);
            }
        }

        if (\defined('OSCOM_APP_PAYPAL_PROXY') && tep_not_null(OSCOM_APP_PAYPAL_PROXY)) {
            curl_setopt($curl, \CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($curl, \CURLOPT_PROXY, OSCOM_APP_PAYPAL_PROXY);
        }

        $result = curl_exec($curl);

        if (isset($opts['returnFull']) && ($opts['returnFull'] === true)) {
            $result = [
                'response' => $result,
                'error' => curl_error($curl),
                'info' => curl_getinfo($curl),
            ];
        }

        curl_close($curl);

        return $result;
    }

    public function drawButton($title = null, $link = null, $type = null, $params = null, $force_css = false)
    {
        $colours = ['success' => '#1cb841',
            'error' => '#ca3c3c',
            'warning' => '#ebaa16',
            'info' => '#42B8DD',
            'primary' => '#0078E7'];

        if (!isset($type) || !\in_array($type, array_keys($colours), true)) {
            $type = 'info';
        }

        $css = 'font-size:14px;color:#fff;padding:8px 16px;border:0;border-radius:4px;text-shadow:0 1px 1px rgba(0, 0, 0, 0.2);text-decoration:none;display:inline-block;cursor:pointer;white-space:nowrap;vertical-align:baseline;text-align:center;background-color:'.$colours[$type].';';

        $button = '';

        if (isset($link)) {
            $button .= '<a href="'.$link.'" class="pp-button';

            if (isset($type)) {
                $button .= ' pp-button-'.$type;
            }

            $button .= '"';

            if (isset($params)) {
                $button .= ' '.$params;
            }

            if ($force_css === true) {
                $button .= ' style="'.$css.'"';
            }

            $button .= '>'.$title.'</a>';
        } else {
            $button .= '<button type="submit" class="pp-button';

            if (isset($type)) {
                $button .= ' pp-button-'.$type;
            }

            $button .= '"';

            if (isset($params)) {
                $button .= ' '.$params;
            }

            if ($force_css === true) {
                $button .= ' style="'.$css.'"';
            }

            $button .= '>'.$title.'</button>';
        }

        return $button;
    }

    public function createRandomValue($length, $type = 'mixed')
    {
        if (($type !== 'mixed') && ($type !== 'chars') && ($type !== 'digits')) {
            $type = 'mixed';
        }

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '0123456789';

        $base = '';

        if (($type === 'mixed') || ($type === 'chars')) {
            $base .= $chars;
        }

        if (($type === 'mixed') || ($type === 'digits')) {
            $base .= $digits;
        }

        $value = '';

        if (!class_exists('PasswordHash') && file_exists(DIR_FS_CATALOG.'includes/classes/passwordhash.php')) {
            include DIR_FS_CATALOG.'includes/classes/passwordhash.php';

            $hasher = new PasswordHash(10, true);

            do {
                $random = base64_encode($hasher->get_random_bytes($length));

                for ($i = 0, $n = \strlen($random); $i < $n; ++$i) {
                    $char = substr($random, $i, 1);

                    if (strpos($base, $char) !== false) {
                        $value .= $char;
                    }
                }
            } while (\strlen($value) < $length);

            if (\strlen($value) > $length) {
                $value = substr($value, 0, $length);
            }

            return $value;
        }

        // fallback for v2.3.1
        while (\strlen($value) < $length) {
            if ($type === 'digits') {
                $char = tep_rand(0, 9);
            } else {
                $char = \chr(tep_rand(0, 255));
            }

            if ($type === 'mixed') {
                if (preg_match('/^[a-z0-9]$/i', $char)) {
                    $value .= $char;
                }
            } elseif ($type === 'chars') {
                if (preg_match('/^[a-z]$/i', $char)) {
                    $value .= $char;
                }
            } elseif ($type === 'digits') {
                if (preg_match('/^[0-9]$/i', $char)) {
                    $value .= $char;
                }
            }
        }

        return $value;
    }

    public function saveParameter($key, $value, $title = null, $description = null, $set_func = null): void
    {
        if (!\defined($key)) {
            if (!isset($title)) {
                $title = 'PayPal App Parameter';
            }

            if (!isset($description)) {
                $description = 'A parameter for the PayPal Application.';
            }

            tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".tep_db_input($title)."', '".tep_db_input($key)."', '".tep_db_input($value)."', '".tep_db_input($description)."', '6', '0', now())");

            if (isset($set_func)) {
                tep_db_query("update configuration set set_function = '".tep_db_input($set_func)."' where configuration_key = '".tep_db_input($key)."'");
            }

            \define($key, $value);
        } else {
            tep_db_query("update configuration set configuration_value = '".tep_db_input($value)."' where configuration_key = '".tep_db_input($key)."'");
        }
    }

    public function deleteParameter($key): void
    {
        tep_db_query("delete from configuration where configuration_key = '".tep_db_input($key)."'");
    }

    public function formatCurrencyRaw($total, $currency_code = null, $currency_value = null)
    {
        global $currencies, $currency;

        if (empty($currency_code)) {
            $currency_code = $currency ?? DEFAULT_CURRENCY;
        }

        if (empty($currency_value) || !is_numeric($currency_value)) {
            $currency_value = $currencies->currencies[$currency_code]['value'];
        }

        return number_format(tep_round($total * $currency_value, $currencies->currencies[$currency_code]['decimal_places']), $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getVersion()
    {
        if (!isset($this->_version)) {
            $version = trim(file_get_contents(DIR_FS_CATALOG.'includes/apps/paypal/version.txt'));

            if (is_numeric($version)) {
                $this->_version = $version;
            } else {
                trigger_error('OSCOM APP [PAYPAL]: Could not read App version number.');
            }
        }

        return $this->_version;
    }

    public function getApiVersion()
    {
        return $this->_api_version;
    }

    public function getIdentifier()
    {
        return $this->_identifier;
    }

    public function hasAlert()
    {
        return isset($_SESSION['OSCOM_PayPal_Alerts']);
    }

    public function addAlert($message, $type): void
    {
        global $OSCOM_PayPal_Alerts;

        if (\in_array($type, ['error', 'warning', 'success'], true)) {
            if (!isset($_SESSION['OSCOM_PayPal_Alerts'])) {
                $OSCOM_PayPal_Alerts = [];
                tep_session_register('OSCOM_PayPal_Alerts');
            }

            $OSCOM_PayPal_Alerts[$type][] = $message;
        }
    }

    public function getAlerts()
    {
        global $OSCOM_PayPal_Alerts;

        $output = '';

        if (isset($_SESSION['OSCOM_PayPal_Alerts']) && !empty($OSCOM_PayPal_Alerts)) {
            $result = [];

            foreach ($OSCOM_PayPal_Alerts as $type => $messages) {
                if (\in_array($type, ['error', 'warning', 'success'], true)) {
                    $m = '<ul class="pp-alerts-'.$type.'">';

                    foreach ($messages as $message) {
                        $m .= '<li>'.tep_output_string_protected($message).'</li>';
                    }

                    $m .= '</ul>';

                    $result[] = $m;
                }
            }

            if (!empty($result)) {
                $output .= '<div class="pp-alerts">'.implode("\n", $result).'</div>';
            }
        }

        unset($_SESSION['OSCOM_PayPal_Alerts']);

        return $output;
    }

    public function install($module): void
    {
        $cut_length = \strlen('OSCOM_APP_PAYPAL_'.$module.'_');

        foreach ($this->getParameters($module) as $key) {
            $p = strtolower(substr($key, $cut_length));

            $cfg_class = 'OSCOM_PayPal_'.$module.'_Cfg_'.$p;

            if (!class_exists($cfg_class)) {
                $this->loadLanguageFile('modules/'.$module.'/cfg_params/'.$p.'.php');

                include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/cfg_params/'.$p.'.php';
            }

            $cfg = new $cfg_class();

            $this->saveParameter($key, $cfg->default, $cfg->title ?? null, $cfg->description ?? null, $cfg->set_func ?? null);
        }

        $m_class = 'OSCOM_PayPal_'.$module;

        if (!class_exists($m_class)) {
            $this->loadLanguageFile('modules/'.$module.'/'.$module.'.php');

            include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/'.$module.'.php';
        }

        $m = new $m_class();

        if (method_exists($m, 'install')) {
            $m->install($this);
        }
    }

    public function uninstall($module): void
    {
        tep_db_query("delete from configuration where configuration_key like 'OSCOM_APP_PAYPAL_".tep_db_input($module)."_%'");

        $m_class = 'OSCOM_PayPal_'.$module;

        if (!class_exists($m_class)) {
            $this->loadLanguageFile('modules/'.$module.'/'.$module.'.php');

            include DIR_FS_CATALOG.'includes/apps/paypal/modules/'.$module.'/'.$module.'.php';
        }

        $m = new $m_class();

        if (method_exists($m, 'uninstall')) {
            $m->uninstall($this);
        }
    }

    public function logUpdate($message, $version): void
    {
        if (is_writable(DIR_FS_CATALOG.'includes/apps/paypal/work')) {
            file_put_contents(DIR_FS_CATALOG.'includes/apps/paypal/work/update_log-'.$version.'.php', '['.date('d-M-Y H:i:s').'] '.$message."\n", \FILE_APPEND);
        }
    }

    public function loadLanguageFile($filename, $lang = null): void
    {
        global $language;

        $lang = isset($lang) ? basename($lang) : basename($language);

        if ($lang !== 'english') {
            $this->loadLanguageFile($filename, 'english');
        }

        $pathname = DIR_FS_CATALOG.'includes/apps/paypal/languages/'.$lang.'/'.$filename;

        if (file_exists($pathname)) {
            $contents = file($pathname);

            $ini_array = [];

            foreach ($contents as $line) {
                $line = trim($line);

                if (!empty($line) && (substr($line, 0, 1) !== '#')) {
                    $delimiter = strpos($line, '=');

                    if (($delimiter !== false) && (preg_match('/^[A-Za-z0-9_-]/', substr($line, 0, $delimiter)) === 1) && (substr_count(substr($line, 0, $delimiter), ' ') === 1)) {
                        $key = trim(substr($line, 0, $delimiter));
                        $value = trim(substr($line, $delimiter + 1));

                        $ini_array[$key] = $value;
                    } elseif (isset($key)) {
                        $ini_array[$key] .= "\n".$line;
                    }
                }
            }

            unset($contents);

            $this->_definitions = array_merge($this->_definitions, $ini_array);

            unset($ini_array);
        }
    }

    public function getDef($key, $values = null)
    {
        $def = $this->_definitions[$key] ?? $key;

        if (\is_array($values)) {
            $keys = array_keys($values);

            foreach ($keys as &$k) {
                $k = ':'.$k;
            }

            $def = str_replace($keys, array_values($values), $def);
        }

        return $def;
    }

    public function getDirectoryContents($base, &$result = [])
    {
        foreach (scandir($base) as $file) {
            if (($file === '.') || ($file === '..')) {
                continue;
            }

            $pathname = $base.'/'.$file;

            if (is_dir($pathname)) {
                $this->getDirectoryContents($pathname, $result);
            } else {
                $result[] = str_replace('\\', '/', $pathname); // Unix style directory separator "/"
            }
        }

        return $result;
    }

    public function isWritable($location)
    {
        if (!file_exists($location)) {
            while (true) {
                $location = \dirname($location);

                if (file_exists($location)) {
                    break;
                }
            }
        }

        return is_writable($location);
    }

    public function rmdir($dir)
    {
        foreach (scandir($dir) as $file) {
            if (!\in_array($file, ['.', '..'], true)) {
                if (is_dir($dir.'/'.$file)) {
                    $this->rmdir($dir.'/'.$file);
                } else {
                    unlink($dir.'/'.$file);
                }
            }
        }

        return rmdir($dir);
    }

    public function displayPath($pathname)
    {
        if (\DIRECTORY_SEPARATOR === '/') {
            return $pathname;
        }

        return str_replace('/', \DIRECTORY_SEPARATOR, $pathname);
    }
}
