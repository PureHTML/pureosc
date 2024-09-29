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

// don't display errors

// log errors
if (is_dir(DIR_FS_CATALOG.'includes/work') && is_writable(DIR_FS_CATALOG.'includes/work')) {
    if (!is_dir(DIR_FS_CATALOG.'includes/work/error_logs')) {
        mkdir(DIR_FS_CATALOG.'includes/work/error_logs', 0777, true);
    }

    if (is_dir(DIR_FS_CATALOG.'includes/work/error_logs') && is_writable(DIR_FS_CATALOG.'includes/work/error_logs')) {
        ini_set('log_errors', true);
        ini_set('error_log', DIR_FS_CATALOG.'includes/work/error_logs/errors-'.date('Ymd').'.txt');
    }
}

// //
// Recursively handle magic_quotes_gpc turned off.
// This is due to the possibility of have an array in
// $HTTP_xxx_VARS
// Ie, products attributes
function do_magic_quotes_gpc(&$ar)
{
    if (!\is_array($ar)) {
        return false;
    }

    foreach ($ar as $key => $value) {
        if (\is_array($ar[$key])) {
            do_magic_quotes_gpc($ar[$key]);
        } else {
            $ar[$key] = addslashes($value);
        }
    }

    reset($ar);
}

$HTTP_GET_VARS = &$_GET;
$HTTP_POST_VARS = &$_POST;
$HTTP_COOKIE_VARS = &$_COOKIE;
$HTTP_SESSION_VARS = &$_SESSION;
$HTTP_POST_FILES = &$_FILES;
$HTTP_SERVER_VARS = &$_SERVER;

// set default timezone if none exists (PHP 5.3 throws an E_WARNING)
date_default_timezone_set(\defined('CFG_TIME_ZONE') ? CFG_TIME_ZONE : date_default_timezone_get());
