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

// Pouzivani bez souhlasu autora neni povoleno
// #Ver:PRV089-22-g45d1515b:2021-09-02#

// $GLOBALS['UniErrorReporting_DBG'] = 1;   // pro ladeni neparovych UniErru

if (file_exists(__DIR__.'/UniModulConfig.php')) {
    include 'UniModulConfig.php';
}

if (!isset($GLOBALS['UniErrorControl'])) {
    $GLOBALS['UniErrorControl'] = 0;
}

function get_debug_print_backtrace($traces_to_ignore = 1)
{
    $traces = debug_backtrace();
    $ret = [];

    foreach ($traces as $i => $call) {
        if ($i < $traces_to_ignore) {
            continue;
        }

        $object = '';

        if (isset($call['class'])) {
            $object = $call['class'].$call['type'];
            /*
            if (isset($call['args']) && is_array($call['args'])) {
                foreach ($call['args'] as &$arg) {
                    get_arg($arg);
                }
            }
             */
        }

        if (isset($call['file'], $call['args'])) {
            $ret[] = '#'.str_pad($i - $traces_to_ignore, 3, ' ').$object.$call['function'].'() called at ['/* implode(', ', $call['args']). */.$call['file'].':'.$call['line'].']';
        }
    }

    return implode("\n", $ret);
}

/*
 *  // TODO: sice se nepouziva, ale kdyby jo, nutno odstranit dosazovani do reference $arg!!
function get_arg(&$arg) {
    if (is_object($arg)) {
        $arr = (array)$arg;
        $args = array();
        foreach($arr as $key => $value) {
            if (strpos($key, chr(0)) !== false) {
                $key = '';    // Private variable found
            }
            $args[] =  '['.$key.'] => '.get_arg($value);
        }

        $arg = get_class($arg) . ' Object ('.implode(',', $args).')';
        STOPPP('funkce prave zmenila promenou v ramci stacku, ma dopad na runtime reference parametry!');
    }
}
 */

// UniErr Logging
if (!\defined('E_UNIERR_DEFAULT')) {
    \define('E_UNIERR_DEFAULT', \E_ALL & ~\E_STRICT);
}

function BeginUniErr($erlev = E_UNIERR_DEFAULT): void
{
    if (!isset($GLOBALS['UniErrorReporting'])) {
        $GLOBALS['UniErrorReporting'] = [];
        $GLOBALS['UniErrorReporting'][] = $erlev;

        if ($GLOBALS['UniErrorControl'] !== 0) {
            $GLOBALS['UniErrorReporting_PrevErrHandler'] = set_error_handler('UniErrHandler');
            $GLOBALS['UniErrorReporting_PrevExcHandler'] = set_exception_handler('UniErrExceptionHandler');
            register_shutdown_function('UniErrShutdownHandler');
        }
    } else {
        $GLOBALS['UniErrorReporting'][] = $erlev;

        if ($GLOBALS['UniErrorControl'] === 2) {   // opakovana kontrola a obnova proti prebirani handleru jinymi funkcemi
            $prevHandler = set_error_handler('UniErrHandler');

            if ($prevHandler === 'UniErrHandler') {
                restore_error_handler();
            }

            $prevHandler = set_exception_handler('UniErrExceptionHandler');

            if ($prevHandler === 'UniErrExceptionHandler') {
                restore_exception_handler();
            }
        }
    }

    if (isset($GLOBALS['UniErrorReporting_DBG'])) {
        UniWriteErrLog(E_UNIERR_INTERNAL, 'BeginUniErr '.\count($GLOBALS['UniErrorReporting']), 0, 0, 2);
    }
}

function EndUniErr($ret = null)
{
    if (isset($GLOBALS['UniErrorReporting_DBG'])) {
        UniWriteErrLog(E_UNIERR_INTERNAL, 'EndUniErr '.\count($GLOBALS['UniErrorReporting']), 0, 0, 2);
    }

    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        array_pop($GLOBALS['UniErrorReporting']);
    } else {
        UniWriteErrLog(E_UNIERR_INTERNAL, 'EndUniErr bez odpovidajiciho BeginUniErr', 0, 0, 2);
        trigger_error('EndUniErr bez odpovidajiciho BeginUniErr');
    }

    return $ret;
}

function ResetUniErr($new = [])
{
    if (isset($GLOBALS['UniErrorReporting_DBG'])) {
        UniWriteErrLog(E_UNIERR_INTERNAL, 'ResetUniErr '.\count($GLOBALS['UniErrorReporting']), 0, 0, 2);
    }

    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        $old = $GLOBALS['UniErrorReporting'];
    } else {
        $old = [];
    }

    $GLOBALS['UniErrorReporting'] = $new;

    return $old;
}

function ExceptionUniErr($ex): void
{
    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        UniWriteErrLog('Rethrowing exception', $ex->__toString()."\n".$ex->getTraceAsString(), 0, 0);

        throw $ex;
    }
}

function UniErrHandler($errno, $errstr, $errfile, $errline, $errcontext = null)
{
    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        $erlev = end($GLOBALS['UniErrorReporting']);

        if ($erlev & $errno) {
            UniWriteErrLog($errno, $errstr, $errfile, $errline);
        }
    }

    if (!empty($GLOBALS['UniErrorReporting_PrevErrHandler'])) {
        return $GLOBALS['UniErrorReporting_PrevErrHandler']($errno, $errstr, $errfile, $errline, $errcontext);
    }

    return false; // normal err handling
}

function UniErrExceptionHandler($ex): void
{
    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        UniWriteErrLog('Unhandled exception', $ex->__toString(), 0, 0);
    }

    if (!empty($GLOBALS['UniErrorReporting_PrevExcHandler'])) {
        $GLOBALS['UniErrorReporting_PrevExcHandler']($ex);
    } else {
        $ue = ResetUniErr();
        trigger_error($ex->__toString());
        ResetUniErr($ue);
    }
}

function UniErrShutdownHandler(): void
{
    if (isset($GLOBALS['UniErrorReporting']) && \count($GLOBALS['UniErrorReporting']) !== 0) {
        $err = error_get_last();

        if ($err['type'] & (\E_ERROR | \E_PARSE | \E_CORE_ERROR | \E_COMPILE_ERROR | \E_USER_ERROR | \E_RECOVERABLE_ERROR)) {
            $GLOBALS['UniErrorReporting_PrevErrHandler'] = null; // vypneme volani pripadneho retezeneho err handleru
            UniErrHandler($err['type'], 'UniErr-SHUTDOWN '.$err['message'], $err['file'], $err['line'], null);
        } else {
            if (!empty($GLOBALS['UniErrorReporting_ShutdownMessage'])) {
                UniWriteErrLog(E_UNIERR_INTERNAL, 'SpecialShutdown: '.$GLOBALS['UniErrorReporting_ShutdownMessage'], 0, 0);
            } else {
                UniWriteErrLog(E_UNIERR_INTERNAL, 'Shutdown s aktivním UniErrem!, hloubka: '.\count($GLOBALS['UniErrorReporting']), 0, 0);
            }
        }

        ResetUniErr(); // musi se to killnout, jinak nasledny shutdown kod vyvolava ruzne warningu, coz je matouci
    }
}

function UniWriteErrLog($errno, $errstr, $errfile, $errline, $traces_to_ignore = 3, $backTrace = null): void
{
    $logger = new UniLogger();

    if (!isset($GLOBALS['UniErrorReportingUsed'])) {
        $logger->WriteLog('UniErrInfo: -------------------------------------------- new request #Ver:PRV089-22-g45d1515b:2021-09-02#');
        $logger->writeLogNoNewLines('UniErrInfo: REQUEST '.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI'].' PostData: '.var_export($_POST, true));
        $GLOBALS['UniErrorReportingUsed'] = 1;
    }

    $logger->WriteLog('UniErrInfo: '.errnoName($errno).", {$errstr}, {$errfile}, {$errline}\n".($backTrace !== null ? $backTrace : get_debug_print_backtrace($traces_to_ignore)));
}

function errnoName($errno)
{
    if (!\is_int($errno)) {
        return $errno;
    }

    $errbitNames = ['E_ERROR', 'E_WARNING', 'E_PARSE', 'E_NOTICE', 'E_CORE_ERROR', 'E_CORE_WARNING', 'E_COMPILE_ERROR', 'E_COMPILE_WARNING', 'E_USER_ERROR', 'E_USER_WARNING', 'E_USER_NOTICE', 'E_STRICT', 'E_RECOVERABLE_ERROR', 'E_DEPRECATED', 'E_USER_DEPRECATED', 'E_UNIERR_INTERNAL'];
    $errStr = '';

    for ($i = 0; $i < \count($errbitNames); ++$i) {
        if (($errno >> $i) & 1) {
            $errStr .= $errbitNames[$i].' ';
        }
    }

    return $errStr;
}

function my_dump($v): void
{
    echo '<p><pre>';
    var_export($v);
    echo '</pre></p>';
}

if (!\defined('E_RECOVERABLE_ERROR')) {
    \define('E_RECOVERABLE_ERROR', 4096);
}

if (!\defined('E_DEPRECATED')) {
    \define('E_DEPRECATED', 8192);
}

if (!\defined('E_USER_DEPRECATED')) {
    \define('E_USER_DEPRECATED', 16384);
}

\define('E_UNIERR_INTERNAL', 2 << 18);
