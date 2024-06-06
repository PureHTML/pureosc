<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: backup_mysql.php,v 1.1.1.1 2005/09/22 15:50:19 vitex Exp $
//

  require('includes/application_top.php');
 //$debug='ON';

  if (isset($_GET['debug']) && $_GET['debug']=='ON') $debug='ON';

// Note that LOCAL_EXE_MYSQL and LOCAL_EXE_MYSQL_DUMP are defined in the /admin/includes/languages/backup_mysql.php file
// These can occasionally be overridden in the URL by specifying &tool=/path/to/foo/bar/plus/utilname, depending on server support
// Do not change them here ... edit the LANGUAGES file instead.
// the following 7 lines check to be sure that they've been entered correctly in the language file
  $pathsearch=array(str_replace('mysql','',LOCAL_EXE_MYSQL).'/','/usr/bin/','/usr/local/bin/','c:/mysql/bin/','d:/mysql/bin/','e:/mysql/bin/','/usr/local/bin/', 'c:/apache2triad/mysql/bin/', 'd:/apache2triad/mysql/bin/', 'e:/apache2triad/mysql/bin/', 'c:/appserv/mysql/bin/', 'd:/appserv/mysql/bin/', 'e:/appserv/mysql/bin/');
  foreach($pathsearch as $path){
  	$path = str_replace('\\','/',$path); // convert backslashes
  	$path = str_replace('//','/',$path); // convert double slashes to singles
  	$path = (substr($path,-1)!='/') ? $path . '/' : $path; // add a '/' to the end if missing
    if (tep_not_null($mysql_exe)) continue;
    if (file_exists($path.'mysql')) $mysql_exe = $path.'mysql';
    if (file_exists($path.'mysql.exe')) $mysql_exe = $path.'mysql.exe';
    if (tep_not_null($mysqldump_exe)) continue;
    if (file_exists($path.'mysqldump')) $mysqldump_exe = $path.'mysqldump';
    if (file_exists($path.'mysqldump.exe')) $mysqldump_exe = $path.'mysqldump.exe';
    if ($debug=='ON') $messageStack->add_session('Checking Path: '.$path.'<br>','caution');
  }
  if (!$mysql_exe){
    $mysql_exe =     ((file_exists($mysql_exe) ? $mysql_exe : 'mysql' ) );
  }
  if (!$mysqldump_exe){
    $mysqldump_exe = ((file_exists($mysqldump_exe) ? $mysqldump_exe : 'mysqldump' ) );
  }
  if ($debug=='ON') $messageStack->add_session('<br>','caution');
  if ($debug=='ON') $messageStack->add_session('COMMAND FILES FOUND/SELECTED:','caution');
  if ($debug=='ON') $messageStack->add_session('mysqlexe='.$mysql_exe.'<br>','caution');
  if ($debug=='ON') $messageStack->add_session('mysqldumpexe='.$mysqldump_exe.'<br><br>','caution');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'forget':
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
        $messageStack->add_session(SUCCESS_LAST_RESTORE_CLEARED, 'success');
        //jsp:natvrdo jmeno soubru nebo odkaz 
        tep_redirect(tep_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'backupnow':
        tep_set_time_limit(250);  // not sure if this is needed anymore?

        $backup_file = 'db_' . DB_DATABASE . '-' . date('YmdHis') . '.sql';

        $dump_params .= ' --host=' . DB_SERVER;
        $dump_params .= ' --user=' . DB_SERVER_USERNAME;
        $dump_params .= ' --password=' . DB_SERVER_PASSWORD;
   //     $dump_params .= ' --opt';   //"optimized" -- turns on all "fast" and optimized export methods
        $dump_params .= ' --complete-insert';  // undo optimization slightly and do "complete inserts"--lists all column names for benefit of restore of diff systems
     $dump_params .= ' --add-drop-table ' ; //adds drop table

//        $dump_params .= ' --skip-comments'; // mysqldump inserts '--' as comment delimiters, which is invalid on import (only for mysql v4.01+)
//        $dump_params .= ' --skip-quote-names';
//        $dump_params .= ' --force';  // ignore SQL errors if they occur
//        $dump_params .= ' --compatible=postgresql'; // other options are: ,mysql323, mysql40
        $dump_params .= ' --result-file=' . DIR_FS_BACKUP . $backup_file;
        $dump_params .= ' ' . DB_DATABASE;

        // if using the "--tables" parameter, this should be the last parameter, and tables should be space-delimited
        // fill $tables_to_export with list of tables, separated by spaces, if wanna just export certain tables
        $dump_params .= (($tables_to_export=='') ? '' : ' --tables ' . $tables_to_export);
        $dump_params .= " 2>&1";

        $toolfilename = (isset($_GET['tool']) && $_GET['tool'] != '') ? $_GET['tool'] : $mysqldump_exe;
        if ($debug=='ON') $messageStack->add_session('COMMAND: '.$toolfilename . ' ' . $dump_params, 'caution');
        $resultcodes=exec($toolfilename . $dump_params , $output, $dump_results );
        exec("exit(0)");

        #parse the value that comes back from the script
        list($strA, $strB) = split ('[|]', $resultcodes);
        if ($debug=='ON') $messageStack->add_session("valueA: " . $strA,'error');
        if ($debug=='ON') $messageStack->add_session("valueB: " . $strB,'error');

        if ($debug=='ON' || (tep_not_null($dump_results) && $dump_results!='0')) $messageStack->add_session('Result code: '.$dump_results, 'caution');
        foreach($output as $key=>$value) {$messageStack->add_session("$key => $value<br />",'caution'); }
        //$output contains response strings from execution. This displays if needed.

        if (file_exists(DIR_FS_BACKUP . $backup_file) && ($dump_results == '0' || $dump_results=='')) { // display success message noting that MYSQLDUMP was used
          $messageStack->add_session('<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $backup_file . '">' . SUCCESS_DATABASE_SAVED . '</a>', 'success');
        } elseif ($dump_results=='127') {
          $messageStack->add_session(FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND, 'error');
        } else {
          $messageStack->add_session(FAILURE_DATABASE_NOT_SAVED, 'error');
        }

        //compress the file as requested & optionally download
        if (isset($_POST['download']) && ($_POST['download'] == 'yes')) {
          switch ($_POST['compress']) {
            case 'gzip':
              exec(LOCAL_EXE_GZIP . ' ' . DIR_FS_BACKUP . $backup_file);
              $backup_file .= '.gz';
              break;
            case 'zip':
              exec(LOCAL_EXE_ZIP . ' -j ' . DIR_FS_BACKUP . $backup_file . '.zip ' . DIR_FS_BACKUP . $backup_file);
              unlink(DIR_FS_BACKUP . $backup_file);
              $backup_file .= '.zip';
          }
      if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {
            header('Content-Type: application/octetstream');
//            header('Content-Disposition: inline; filename="' . $backup_file . '"');
            header('Content-Disposition: attachment; filename=' . $backup_file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: must_revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header("Cache-control: private");
      } else {
            header('Content-Type: application/x-octet-stream');
            header('Content-Disposition: attachment; filename=' . $backup_file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Pragma: no-cache");
      }

          readfile(DIR_FS_BACKUP . $backup_file);
          unlink(DIR_FS_BACKUP . $backup_file);

          exit;
        } else {
          switch ($_POST['compress']) {
            case 'gzip':
              exec(LOCAL_EXE_GZIP . ' ' . DIR_FS_BACKUP . $backup_file);
              break;
            case 'zip':
              exec(LOCAL_EXE_ZIP . ' -j ' . DIR_FS_BACKUP . $backup_file . '.zip ' . DIR_FS_BACKUP . $backup_file);
              unlink(DIR_FS_BACKUP . $backup_file);
          }
        }
        tep_redirect(tep_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'restorenow':
      case 'restorelocalnow':
        tep_set_time_limit(300);
          $specified_restore_file = (isset($_GET['file'])) ? $_GET['file'] : '';

          if ($specified_restore_file !='' && file_exists(DIR_FS_BACKUP . $specified_restore_file)) {
            $restore_file = DIR_FS_BACKUP . $specified_restore_file;
            $extension = substr($specified_restore_file, -3);

            //determine file format and unzip if needed
            if ( ($extension == 'sql') || ($extension == '.gz') || ($extension == 'zip') ) {
              switch ($extension) {
                case 'sql':
                  $restore_from = $restore_file;
                  $remove_raw = false;
                  break;
                case '.gz':
                  $restore_from = substr($restore_file, 0, -3);
                  exec(LOCAL_EXE_GUNZIP . ' ' . $restore_file . ' -c > ' . $restore_from);
                  $remove_raw = true;
                  break;
                case 'zip':
                  $restore_from = substr($restore_file, 0, -4);
                  exec(LOCAL_EXE_UNZIP . ' ' . $restore_file . ' -d ' . DIR_FS_BACKUP);
                  $remove_raw = true;
              }
            }
        } elseif ($action == 'restorelocalnow') {
            $sql_file = new upload('sql_file', DIR_FS_BACKUP);
            $specified_restore_file = $sql_file->filename;
            $restore_from = DIR_FS_BACKUP . $specified_restore_file;
        }

        //Restore using "mysql"
        $load_params  = ' --database=' . DB_DATABASE;
        $load_params .= ' --host=' . DB_SERVER;
        $load_params .= ' --user=' . DB_SERVER_USERNAME;
        $load_params .= ((DB_SERVER_PASSWORD =='') ? '' : ' --password=' . DB_SERVER_PASSWORD);
        $load_params .= ' ' . DB_DATABASE; // this needs to be the 2nd-last parameter
        $load_params .= ' < ' . $restore_from; // this needs to be the LAST parameter
        $load_params .= " 2>&1";
        //DEBUG echo $mysql_exe . ' ' . $load_params;

        if (file_exists($restore_from) && $specified_restore_file != '') {
          $toolfilename = (isset($_GET['tool']) && $_GET['tool'] != '') ? $_GET['tool'] : $mysql_exe;
          if ($debug=='ON') $messageStack->add_session('COMMAND: '.$toolfilename . ' ' . $dump_params, 'caution');

          $resultcodes=exec($toolfilename . $load_params , $output, $load_results );
          exec("exit(0)");
          #parse the value that comes back from the script
          list($strA, $strB) = split ('[|]', $resultcodes);
          if ($debug=='ON') $messageStack->add_session("valueA: " . $strA,'error');
          if ($debug=='ON') $messageStack->add_session("valueB: " . $strB,'error');
          if ($debug=='ON' || (tep_not_null($load_results) && $load_results!='0')) $messageStack->add_session('Result code: '.$load_results, 'caution');

          if ($load_results == '0') {
            // store the last-restore-date, if successful
            tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
            tep_db_query("insert into " . TABLE_CONFIGURATION . " values ('', 'Last Database Restore', 'DB_LAST_RESTORE', '" . $specified_restore_file . "', 'Last database restore file', '6', '', '', now(), '', '')");
            $messageStack->add_session('<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $specified_restore_file . '">' . SUCCESS_DATABASE_RESTORED . '</a>', 'success');
            } elseif ($load_results == '127') {
            $messageStack->add_session(FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND, 'error');
            } else {
            $messageStack->add_session(FAILURE_DATABASE_NOT_RESTORED, 'error');
            } // endif $load_results
          } else {
          $messageStack->add_session(sprintf(FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND, '[' . $restore_from .']'), 'error');
          } // endif file_exists

        tep_redirect(tep_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'download':
        $extension = substr($_GET['file'], -3);

        if ( ($extension == 'zip') || ($extension == '.gz') || ($extension == 'sql') ) {
          if ($fp = fopen(DIR_FS_BACKUP . $_GET['file'], 'rb')) {
            $buffer = fread($fp, filesize(DIR_FS_BACKUP . $_GET['file']));
            fclose($fp);

            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $_GET['file']);

            echo $buffer;

            exit;
          }
        } else {
          $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) tep_redirect(tep_href_link(FILENAME_BACKUP_MYSQL));

        tep_remove(DIR_FS_BACKUP . '/' . $_GET['file']);

        if (!$tep_remove_error) {
          $messageStack->add_session(SUCCESS_BACKUP_DELETED, 'success');

          tep_redirect(tep_href_link(FILENAME_BACKUP_MYSQL));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = false;
  if (is_dir(DIR_FS_BACKUP)) {
    if (is_writeable(DIR_FS_BACKUP)) {
      $dir_ok = true;
    } else {
      $messageStack->add(ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
    }
  } else {
    $messageStack->add(ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

// check to see if safe_mode is on -- can't use mysqldump in safe mode
  if (get_cfg_var('safe_mode')) {
    $messageStack->add(ERROR_CANT_BACKUP_IN_SAFE_MODE, 'error');
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
        </tr>
</table></td>
<?php if (ENABLE_SSL_ADMIN != 'true') {  // display security warning about downloads if not SSL
?>
          <tr>
            <td class="main"><?php echo WARNING_NOT_SECURE_FOR_DOWNLOADS; ?></td>
            <td class="main" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>
<!--        </table></td> //-->
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FILE_DATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILE_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
//  if (!get_cfg_var('safe_mode') && $dir_ok == true) {
    $dir = dir(DIR_FS_BACKUP);
    $contents = array();
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_BACKUP . $file)) {
        if ($file != '.empty' && $file != 'empty.txt') {
          $contents[] = $file;
        }
      }
    }
    sort($contents);

    for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
      $entry = $contents[$i];

      $check = 0;

      if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] == $entry))) && !isset($buInfo) && ($action != 'backup') && ($action != 'restorelocal')) {
        $file_array['file'] = $entry;
        $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry));
        $file_array['size'] = number_format(filesize(DIR_FS_BACKUP . $entry)) . ' bytes';
        switch (substr($entry, -3)) {
          case 'zip': $file_array['compression'] = 'ZIP'; break;
          case '.gz': $file_array['compression'] = 'GZIP'; break;
          default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
        }

        $buInfo = new objectInfo($file_array);
      }

      if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $buInfo->file . '&action=restore';
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $entry;
      }
?>
<!--                 <td class="dataTableContent" onclick="document.location.href='<?php echo tep_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'action=download&file=' . $entry) . '">' . tep_image(DIR_WS_ICONS . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td> -->
                <td class="dataTableContent" onclick="document.location.href='<?php echo tep_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo '<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $entry . '">' . tep_image(DIR_WS_ICONS . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td>
                <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo tep_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry)); ?></td>
                <td class="dataTableContent" align="right" onclick="document.location.href='<?php echo tep_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo number_format(filesize(DIR_FS_BACKUP . $entry)); ?> bytes</td>
                <td class="dataTableContent" align="right"><?php if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $entry) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
    $dir->close();
//  } // endif safe-mode & dir_ok

// now let's display the backup/restore buttons below filelist
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_BACKUP_DIRECTORY . ' ' . DIR_FS_BACKUP; ?></td>
                <td align="right" class="smallText">
                    <?php if ( ($action != 'backup') && (isset($dir)) && !get_cfg_var('safe_mode') && $dir_ok == true ) {
                             echo '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'action=backup'.(($debug=='ON')?'&debug=ON':'')) . '">' .
                                   tep_image_button('button_backup.gif', IMAGE_BACKUP) . '</a>&nbsp;&nbsp;';
                          }
                          if ( ($action != 'restorelocal') && isset($dir) ) {
                             echo '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'action=restorelocal'.(($debug=='ON')?'&debug=ON':'')) . '">' .
                                   tep_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>';
                          } ?>
                </td>
              </tr>
<?php
  if (defined('DB_LAST_RESTORE')) {
?>
              <tr>
                <td class="smallText" colspan="4"><?php echo TEXT_LAST_RESTORATION . ' ' . DB_LAST_RESTORE . ' <a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'action=forget') . '">' . TEXT_FORGET . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'backup':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_NEW_BACKUP . '</strong>');

      $contents = array('form' => tep_draw_form('backup', FILENAME_BACKUP_MYSQL, 'action=backupnow'.(($debug=='ON')?'&debug=ON':'')));
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);

      $contents[] = array('text' => '<br />' . tep_draw_radio_field('compress', 'no', true) . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
      if (file_exists(LOCAL_EXE_GZIP)) $contents[] = array('text' => '<br />' . tep_draw_radio_field('compress', 'gzip') . ' ' . TEXT_INFO_USE_GZIP);
      if (file_exists(LOCAL_EXE_ZIP)) $contents[] = array('text' => tep_draw_radio_field('compress', 'zip') . ' ' . TEXT_INFO_USE_ZIP);


      // Download to file --- Should only be done if SSL is active, otherwise database is exposed as clear text
      if ($dir_ok == true) {
        $contents[] = array('text' => '<br />' . tep_draw_checkbox_field('download', 'yes') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><span class="errorText">*' . TEXT_INFO_BEST_THROUGH_HTTPS . '</span>');
      } else {
        $contents[] = array('text' => '<br />' . tep_draw_radio_field('download', 'yes', true) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><span class="errorText">*' . TEXT_INFO_BEST_THROUGH_HTTPS . '</span>');
      }

      // display backup button
      $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_backup.gif', IMAGE_BACKUP) . '&nbsp;<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL,(($debug=='ON')?'debug=ON':'')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restore':
      $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

      $contents[] = array('text' => tep_break_string(sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP . (($buInfo->compression != TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression != TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : ''), 35, ' '));
      $contents[] = array('align' => 'center', 'text' => '<br /><a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=restorenow'.(($debug=='ON')?'&debug=ON':'')) . '">' . tep_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file.(($debug=='ON')?'&debug=ON':'')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restorelocal':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</strong>');

      $contents = array('form' => tep_draw_form('restore', FILENAME_BACKUP_MYSQL, 'action=restorelocalnow'.(($debug=='ON')?'&debug=ON':''), 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br /><br />' . TEXT_INFO_BEST_THROUGH_HTTPS);
      $contents[] = array('text' => '<br />' . tep_draw_file_field('sql_file'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE);
      $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_restore.gif', IMAGE_RESTORE) . '&nbsp;<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL,(($debug=='ON')?'debug=ON':'')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      if ($dir_ok == false) continue;
      $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

      $contents = array('form' => tep_draw_form('delete', FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br /><strong>' . $buInfo->file . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($buInfo) && is_object($buInfo)) {
        $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

        $contents[] = array('align' => 'center',
                            'text' => '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=restore'.(($debug=='ON')?'&debug=ON':'')) . '">' .
                                                    tep_image_button('button_restore.gif', IMAGE_RESTORE) . '</a> ' .
                                      (($dir_ok==true) ? '<a href="' . tep_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=delete') . '">' .
                                                    tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>' : '' ) );
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
