<?php

/*

 *************************************
 * osCommerce Virus & Threat Scanner *
 * v.1.0.9                           *
 *************************************
 
*/
// ***************************************************************************
// IF YOU ARE GOING TO USE THIS FEATURE, REMEMBER TO BACKUP YOUR SITE FIRST !!
// ***************************************************************************

// Configuration for checking and removing whitespace

// check for leading & trailing whitespace:
$chk_ws = true;  // ON
//$chk_ws = false;  // OFF

// remove leading & trailing whitespace if found (if set to true, $chk_ws also need to be true!):
//$rmv_ws = true;  // ON
$rmv_ws = false;  // OFF

$ftp_site = 'yoursite.com';      // your ftp site
$ftp_usr = 'username';        // your ftp username
$ftp_pwd = 'password';     // your ftp password
$ftp_root =  'public_html'; // your ftp site root folder
// where to backup the original file before removing whitespace:  IN TEST, DONT USE!
//$bck_dir = '/home/yoursite/public_html/catalog/admin/AV/backup/'; // the 'backup' dir must be chmod 777

?>