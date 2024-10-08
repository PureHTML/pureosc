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

// //
// ! Write out serialized data.
//  write_cache uses serialize() to store $var in $filename.
//  $var      -  The variable to be written out.
//  $filename -  The name of the file to write to.
function write_cache(&$var, $filename)
{
    $filename = DIR_FS_CACHE.$filename;
    $success = false;

    // try to open the file
    if ($fp = @fopen($filename, 'wb')) {
        // obtain a file lock to stop corruptions occuring
        flock($fp, 2); // LOCK_EX
        // write serialized data
        fwrite($fp, serialize($var));
        // release the file lock
        flock($fp, 3); // LOCK_UN
        fclose($fp);
        $success = true;
    }

    return $success;
}

// //
// ! Read in seralized data.
//  read_cache reads the serialized data in $filename and
//  fills $var using unserialize().
//  $var      -  The variable to be filled.
//  $filename -  The name of the file to read.
function read_cache(&$var, $filename, $auto_expire = false)
{
    $filename = DIR_FS_CACHE.$filename;
    $success = false;

    if (($auto_expire === true) && file_exists($filename)) {
        $now = time();
        $filetime = filemtime($filename);
        $difference = $now - $filetime;

        if ($difference >= $auto_expire) {
            return false;
        }
    }

    // try to open file
    if ($fp = @fopen($filename, 'rb')) {
        // read in serialized data
        $szdata = fread($fp, filesize($filename));
        fclose($fp);
        // unserialze the data
        $var = unserialize($szdata);

        $success = true;
    }

    return $success;
}

// //
// ! Get data from the cache or the database.
//  get_db_cache checks the cache for cached SQL data in $filename
//  or retreives it from the database is the cache is not present.
//  $SQL      -  The SQL query to exectue if needed.
//  $filename -  The name of the cache file.
//  $var      -  The variable to be filled.
//  $refresh  -  Optional.  If true, do not read from the cache.
function get_db_cache($sql, &$var, $filename, $refresh = false): void
{
    $var = [];

    // check for the refresh flag and try to the data
    if (($refresh === true) || !read_cache($var, $filename)) {
        // Didn' get cache so go to the database.
        //      $conn = mysql_connect("localhost", "apachecon", "apachecon");
        $res = tep_db_query($sql);

        //      if ($err = mysql_error()) trigger_error($err, E_USER_ERROR);
        // loop through the results and add them to an array
        while ($rec = tep_db_fetch_array($res)) {
            $var[] = $rec;
        }

        // write the data to the file
        write_cache($var, $filename);
    }
}
