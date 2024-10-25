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

function BeginSynchronized(): void
{
    global $UniSyncFile;

    if (!isset($UniSyncFile)) {
        register_shutdown_function('SynchronizedShutdownHandler');
    }

    if ($UniSyncFile !== null) {
        trigger_error('ERROR: BeginSynchronized v ramci aktivni synchronizace');
    }

    $UniSyncFile = fopen(__DIR__.'/sync.lock', 'r+b');

    if (!flock($UniSyncFile, \LOCK_EX | \LOCK_NB)) { // do an exclusive lock
        SynchronizedWriteLog('BLOCK: Cekam na sync');

        if (!flock($UniSyncFile, \LOCK_EX)) {
            SynchronizedWriteLog('ERROR: Synchronizace se nezdarila');
            trigger_error('ERROR: Synchronizace se nezdarila');

            return;
        }

        SynchronizedWriteLog('BLOCK: Dockal jsem se');
    }
}

function EndSynchronized(): void
{
    global $UniSyncFile;

    if ($UniSyncFile === null) {
        trigger_error('ERROR: EndSynchronized bez BeginSynchronized');

        return;
    }

    flock($UniSyncFile, \LOCK_UN); // release the lock
    fclose($UniSyncFile);
    $UniSyncFile = 0;  // isset pak vraci true
}

function BeginMaybeExitSynchronized(): void
{
    global $UniSyncFile, $UniSyncMaybeExit;

    if ($UniSyncFile === null) {
        trigger_error('ERROR: BeginMaybeExitSynchronized bez BeginSynchronized');

        return;
    }

    if ($UniSyncMaybeExit) {
        trigger_error('ERROR: BeginMaybeExitSynchronized jiz aktivni');

        return;
    }

    $UniSyncMaybeExit = true;
}

function EndMaybeExitSynchronized(): void
{
    global $UniSyncFile, $UniSyncMaybeExit;

    if ($UniSyncFile === null) {
        trigger_error('ERROR: EndMaybeExitSynchronized bez BeginSynchronized');

        return;
    }

    if (!$UniSyncMaybeExit) {
        trigger_error('ERROR: EndMaybeExitSynchronized bez EndMaybeExitSynchronized');

        return;
    }

    $UniSyncMaybeExit = false;
}

function SynchronizedShutdownHandler(): void
{
    global $UniSyncFile, $UniSyncMaybeExit;

    if ($UniSyncFile !== null && !$UniSyncMaybeExit) {
        SynchronizedWriteLog('ERROR: Shutdown bez ukonceni synchronizace');
        trigger_error('ERROR: Shutdown bez ukonceni synchronizace');
    }
}

function SynchronizedWriteLog($msg): void
{
    $logger = new UniLogger();
    $logger->WriteLog('Sync: '.$msg);
}
