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

include 'includes/application_top.php';

if (!isset($_SESSION['customer_id'])) {
    exit;
}

// Check download.php was called with proper GET parameters
if ((isset($_GET['order']) && !is_numeric($_GET['order'])) || (isset($_GET['id']) && !is_numeric($_GET['id']))) {
    exit;
}

// Check that order_id, customer_id and filename match
$downloads_query = tep_db_query("select date_format(o.date_purchased, '%Y-%m-%d') as date_purchased_day, opd.download_maxdays, opd.download_count, opd.download_maxdays, opd.orders_products_filename from orders o, orders_products op, orders_products_download opd, orders_status os where o.customers_id = '".(int) $customer_id."' and o.orders_id = '".(int) $_GET['order']."' and o.orders_id = op.orders_id and op.orders_products_id = opd.orders_products_id and opd.orders_products_download_id = '".(int) $_GET['id']."' and opd.orders_products_filename != '' and o.orders_status = os.orders_status_id and os.downloads_flag = '1' and os.language_id = '".(int) $languages_id."'");

if (!tep_db_num_rows($downloads_query)) {
    exit;
}

$downloads = tep_db_fetch_array($downloads_query);
// MySQL 3.22 does not have INTERVAL
[$dt_year, $dt_month, $dt_day] = explode('-', $downloads['date_purchased_day']);
$download_timestamp = mktime(23, 59, 59, $dt_month, $dt_day + $downloads['download_maxdays'], $dt_year);

// Die if time expired (maxdays = 0 means no time limit)
if (($downloads['download_maxdays'] !== 0) && ($download_timestamp <= time())) {
    exit;
}

// Die if remaining count is <=0
if ($downloads['download_count'] <= 0) {
    exit;
}

// Die if file is not there
if (!file_exists(DIR_FS_DOWNLOAD.$downloads['orders_products_filename'])) {
    exit;
}

// Now decrement counter
tep_db_query("update orders_products_download set download_count = download_count-1 where orders_products_download_id = '".(int) $_GET['id']."'");

// Returns a random name, 16 to 20 characters long
// There are more than 10^28 combinations
// The directory is "hidden", i.e. starts with '.'
function tep_random_name()
{
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $dirname = '.';
    $length = floor(tep_rand(16, 20));

    for ($i = 1; $i <= $length; ++$i) {
        $q = floor(tep_rand(1, 26));
        $dirname .= $letters[$q];
    }

    return $dirname;
}

// Unlinks all subdirectories and files in $dir
// Works only on one subdir level, will not recurse
function tep_unlink_temp_dir($dir): void
{
    $h1 = opendir($dir);

    while ($subdir = readdir($h1)) {
        // Ignore non directories
        if (!is_dir($dir.$subdir)) {
            continue;
        }

        // Ignore . and .. and CVS
        if ($subdir === '.' || $subdir === '..' || $subdir === 'CVS') {
            continue;
        }

        // Loop and unlink files in subdirectory
        $h2 = opendir($dir.$subdir);

        while ($file = readdir($h2)) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            @unlink($dir.$subdir.'/'.$file);
        }

        closedir($h2);
        @rmdir($dir.$subdir);
    }

    closedir($h1);
}

// Now send the file with header() magic
header('Expires: Mon, 26 Nov 1962 00:00:00 GMT');
header('Last-Modified: '.gmdate('D,d M Y H:i:s').' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: Application/octet-stream');
header('Content-disposition: attachment; filename="'.$downloads['orders_products_filename'].'"');

if (DOWNLOAD_BY_REDIRECT === 'true') {
    // This will work only on Unix/Linux hosts
    tep_unlink_temp_dir(DIR_FS_DOWNLOAD_PUBLIC);
    $tempdir = tep_random_name();
    umask(0000);
    mkdir(DIR_FS_DOWNLOAD_PUBLIC.$tempdir, 0777);
    symlink(DIR_FS_DOWNLOAD.$downloads['orders_products_filename'], DIR_FS_DOWNLOAD_PUBLIC.$tempdir.'/'.$downloads['orders_products_filename']);

    if (file_exists(DIR_FS_DOWNLOAD_PUBLIC.$tempdir.'/'.$downloads['orders_products_filename'])) {
        tep_redirect(tep_href_link(DIR_WS_DOWNLOAD_PUBLIC.$tempdir.'/'.$downloads['orders_products_filename']));
    }
}

// Fallback to readfile() delivery method. This will work on all systems, but will need considerable resources
readfile(DIR_FS_DOWNLOAD.$downloads['orders_products_filename']);
