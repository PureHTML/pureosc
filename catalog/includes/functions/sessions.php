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

if (STORE_SESSIONS === 'mysql') {
    function _sess_open($save_path, $session_name)
    {
        return true;
    }

    function _sess_close()
    {
        return true;
    }

    function _sess_read($key)
    {
        $value_query = tep_db_query("select value from sessions where sesskey = '".tep_db_input($key)."'");
        $value = tep_db_fetch_array($value_query);

        if (isset($value['value'])) {
            return $value['value'];
        }

        return '';
    }

    function _sess_write($key, $value)
    {
        $check_query = tep_db_query("select 1 from sessions where sesskey = '".tep_db_input($key)."'");

        if (tep_db_num_rows($check_query) > 0) {
            $result = tep_db_query("update sessions set expiry = '".tep_db_input(time())."', value = '".tep_db_input($value)."' where sesskey = '".tep_db_input($key)."'");
        } else {
            $result = tep_db_query("insert into sessions values ('".tep_db_input($key)."', '".tep_db_input(time())."', '".tep_db_input($value)."')");
        }

        return $result !== false;
    }

    function _sess_destroy($key)
    {
        $result = tep_db_query("delete from sessions where sesskey = '".tep_db_input($key)."'");

        return $result !== false;
    }

    function _sess_gc($maxlifetime)
    {
        $result = tep_db_query("delete from sessions where expiry < '".(time() - $maxlifetime)."'");

        return $result !== false;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
}

function tep_session_start()
{
    $sane_session_id = true;

    if (isset($_GET[tep_session_name()])) {
        if ((SESSION_FORCE_COOKIE_USE === 'True') || (preg_match('/^[a-zA-Z0-9,-]+$/', $_GET[tep_session_name()]) === false)) {
            unset($_GET[tep_session_name()]);

            $sane_session_id = false;
        }
    }

    if (isset($_POST[tep_session_name()])) {
        if ((SESSION_FORCE_COOKIE_USE === 'True') || (preg_match('/^[a-zA-Z0-9,-]+$/', $_POST[tep_session_name()]) === false)) {
            unset($_POST[tep_session_name()]);

            $sane_session_id = false;
        }
    }

    if (isset($_COOKIE[tep_session_name()])) {
        if (preg_match('/^[a-zA-Z0-9,-]+$/', $_COOKIE[tep_session_name()]) === false) {
            $session_data = session_get_cookie_params();

            setcookie(tep_session_name(), '', time() - 42000, $session_data['path'], $session_data['domain']);
            unset($_COOKIE[tep_session_name()]);

            $sane_session_id = false;
        }
    }

    if ($sane_session_id === false) {
        tep_redirect(tep_href_link('index.php', '', 'SSL', false));
    }

    register_shutdown_function('session_write_close');

    return session_start();
}

function tep_session_register($variable)
{
    global $session_started, $login_request;

    if ((!isset($login_request) || isset($login_request)) || $session_started === true) {
        if (!isset($GLOBALS[$variable])) {
            $GLOBALS[$variable] = null;
        }

        $_SESSION[$variable] = &$GLOBALS[$variable];
    }

    return false;
}

function tep_session_is_registered($variable)
{
    return isset($_SESSION) && \array_key_exists($variable, $_SESSION);
}

function tep_session_unregister($variable): void
{
    unset($_SESSION[$variable]);
}

function tep_session_id($sessid = '')
{
    if (!empty($sessid)) {
        return session_id($sessid);
    }

    return session_id();
}

function tep_session_name($name = '')
{
    if (!empty($name)) {
        return session_name($name);
    }

    return session_name();
}

function tep_session_close()
{
    return session_write_close();
}

function tep_session_destroy()
{
    if (isset($_COOKIE[tep_session_name()])) {
        $session_data = session_get_cookie_params();

        setcookie(tep_session_name(), '', time() - 42000, $session_data['path'], $session_data['domain']);
        unset($_COOKIE[tep_session_name()]);
    }

    return session_destroy();
}

function tep_session_save_path($path = '')
{
    if (!empty($path)) {
        return session_save_path($path);
    }

    return session_save_path();
}

function tep_session_recreate(): void
{
    global $SID;

    session_regenerate_id(true);

    if (!empty($SID)) {
        $SID = tep_session_name().'='.tep_session_id();
    }
}
