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
// Get the installed version number
function osc_get_version()
{
    static $v;

    if (!isset($v)) {
        $v = trim(implode('', file('../includes/version.php')));
    }

    return $v;
}

// //
// Sets timeout for the current script.
// Cant be used in safe mode.
function osc_set_time_limit($limit): void
{
    set_time_limit($limit);
}

function osc_realpath($directory)
{
    return str_replace('\\', '/', realpath($directory));
}

// //
// This function encrypts a phpass password from a plaintext
// password.
function osc_encrypt_password($plain)
{
    if (!class_exists('PasswordHash')) {
        include '../includes/classes/passwordhash.php';
    }

    $hasher = new PasswordHash(10, true);

    return $hasher->HashPassword($plain);
}

// //
// Wrapper function for is_writable() for Windows compatibility
function osc_is_writable($file)
{
    if (strtolower(substr(\PHP_OS, 0, 3)) === 'win') {
        if (file_exists($file)) {
            $file = realpath($file);

            if (is_dir($file)) {
                $result = @tempnam($file, 'osc');

                if (\is_string($result) && file_exists($result)) {
                    unlink($result);

                    return (strpos($result, $file) === 0) ? true : false;
                }
            } else {
                $handle = @fopen($file, 'r+b');

                if (\is_resource($handle)) {
                    fclose($handle);

                    return true;
                }
            }
        } else {
            $dir = \dirname($file);

            if (file_exists($dir) && is_dir($dir) && osc_is_writable($dir)) {
                return true;
            }
        }

        return false;
    }

    return is_writable($file);
}

// //
// Parse the data used in the html tags to ensure the tags will not break
function osc_parse_input_field_data($data, $parse)
{
    return strtr(trim((string)$data), $parse);
}

function osc_output_string($string, $translate = false, $protected = false)
{
    if ($protected === true) {
        return htmlspecialchars($string);
    }

    if ($translate === false) {
        return osc_parse_input_field_data($string, ['"' => '&quot;']);
    }

    return osc_parse_input_field_data($string, $translate);
}

function check_permissions(array $path_array)
{
    $configfile_array = [];

    foreach ($path_array as $key => $value) {
        if (\is_int($key)) {
            $key = $value;
            $value = '';
        }

        $realpath = rtrim(osc_realpath(__DIR__.'/../../../'.$key).'/'.$value, '/');

        if (file_exists($realpath) && !osc_is_writable($realpath)) {
            @chmod($realpath, 0777);
        }

        if (file_exists($realpath) && !osc_is_writable($realpath)) {
            $configfile_array[] = $realpath;
        }
    }

    return $configfile_array;
}
