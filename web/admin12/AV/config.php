<?php

$ver = 'v1.0.12';

// Font colors for ocVTSa
$fb1 = '<font color="#FF0000"><b>'; // color ERROR description
$fe1 = '</font></b>';
$fb2 = '<font color="#CC3300">';  // color SUSPECTED (shell execution)
$fe2 = '</font>';
$fb3 = '<font color="#0000FF">'; // color ERROR filename
$fe3 = '</font>';
$fb4 = '<font color="#FF00FF">'; // color SUSPECTED (eval/base64_decode found)
$fe4 = '</font>';


//
// Example configuration file for osCommerce V&TS
// Please read readme.txt before editing this file.
//

// DEBUG MODE
// ----------
// Uncomment this option to enable 'debug' mode
// You will receive verbose reports including clean & infected
// files, as well as debug information for file reading and
// database connections.
// Default: Off (0)

//$CONFIG['debug'] = 0; // OFF
$CONFIG['debug'] = 1;  // ON //jsp:default stop

// ROOT PATH TO SCAN
// -----------------
// This can be a relative or full path WITHOUT a trailing
// slash. All files and folders will be recursively scanned
// within this path. NB: Due to your web host's configuration
// it is likely this script will be terminated after 30-60
// seconds of continuous operation. Please keep an eye on
// the number of files inside this directory - if it is too
// large it may fail.
// Default: Document root defined in Apache

$CONFIG['scanpath'] = $_SERVER['DOCUMENT_ROOT'];

//$CONFIG['scanpath'] = $_SERVER['DOCUMENT_ROOT']."/catalog";


// SCANABLE FILES
// --------------
// The next few lines tell PHP AntiVirus what files to scan
// within the directory set above. It does it by file
// extension (the text after the period or dot in the file
// name) - for example "htm", "html" or "php" files.
// Default: None

// Static files? This should be a comprehensive list, add
// more if required.

$CONFIG['extensions'][] = 'htm';
$CONFIG['extensions'][] = 'html';
$CONFIG['extensions'][] = 'shtm';
$CONFIG['extensions'][] = 'shtml';
$CONFIG['extensions'][] = 'css';
$CONFIG['extensions'][] = 'js';
$CONFIG['extensions'][] = 'vbs';
$CONFIG['extensions'][] = 'ess';  // This will check the .htaccess file


// PHP files? This should be a comprehensive list, add more
// if required.

$CONFIG['extensions'][] = 'php';
$CONFIG['extensions'][] = 'php3';
$CONFIG['extensions'][] = 'php4';
$CONFIG['extensions'][] = 'php5';

// Text files? Virus code is harmless but invasive,
// although uncommenting these lines may cause false
// positives.

 $CONFIG['extensions'][] = 'txt';//jsp:default stop
 $CONFIG['extensions'][] = 'rtf';//jsp:default stop
 $CONFIG['extensions'][] = 'doc';//jsp:default stop
 $CONFIG['extensions'][] = 'conf';//jsp:default stop
 $CONFIG['extensions'][] = 'dat';//jsp:default stop

// Flat file data? Only enable these if you regularly store
// data in flat files.

 $CONFIG['extensions'][] = 'conf';//jsp:default stop
 $CONFIG['extensions'][] = 'config';//jsp:default stop
 $CONFIG['extensions'][] = 'csv';//jsp:default stop
 $CONFIG['extensions'][] = 'tab';//jsp:default stop
 $CONFIG['extensions'][] = 'sql';//jsp:default stop

// CGI scripts? Unlikely but entirely possible.

 $CONFIG['extensions'][] = 'pl';//jsp:default stop
 $CONFIG['extensions'][] = 'perl';//jsp:default stop
 $CONFIG['extensions'][] = 'cgi';//jsp:default stop
// $CONFIG['extensions'][] = '';

// Image files for the truely paranoid
// $CONFIG['extensions'][] = 'jpg';
// $CONFIG['extensions'][] = 'gif';
// $CONFIG['extensions'][] = 'bmp';
?>