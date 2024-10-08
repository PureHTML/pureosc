<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'forget':
            tep_db_query("delete from configuration where configuration_key = 'DB_LAST_RESTORE'");

            $messageStack->add_session(SUCCESS_LAST_RESTORE_CLEARED, 'success');

            tep_redirect(tep_href_link('backup.php'));

            break;
        case 'backupnow':
            set_time_limit(0);
            $backup_file = 'db_'.DB_DATABASE.'_'.date('Y-m-d_H-i-s').'.sql';
            $fp = fopen(DIR_FS_BACKUP.$backup_file, 'wb');

            $schema = "# osCommerce, Open Source E-Commerce Solutions\n".
              "# http://www.oscommerce.com\n".
              "#\n".
              '# Database Backup For '.STORE_NAME."\n".
              '# Copyright (c) '.date('Y').' '.STORE_OWNER."\n".
              "#\n".
              '# Database: '.DB_DATABASE."\n".
              '# Database Server: '.DB_SERVER."\n".
              "#\n".
              '# Backup Date: '.date(PHP_DATE_TIME_FORMAT)."\n\n".
              'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'."\n\n";
            fwrite($fp, $schema);

            $tables_query = tep_db_query('show tables');

            while ($tables = tep_db_fetch_array($tables_query)) {
                $table = reset($tables);

                $schema = 'DROP TABLE IF EXISTS `'.$table."`;\n";

                $fields_query = tep_db_query('show create table '.$table);

                while ($fields = tep_db_fetch_array($fields_query)) {
                    $schema .= $fields['Create Table'];
                }

                $schema .= ";\n\n";
                fwrite($fp, $schema);

                $table_list = [];
                $fields_query = tep_db_query('show fields from '.$table);

                while ($fields = tep_db_fetch_array($fields_query)) {
                    $table_list[] = $fields['Field'];
                }

                // dump the data
                $j = null;

                if ($table !== 'sessions') {
                    $rows_query = tep_db_query('select '.implode(',', $table_list).' from '.$table);

                    while ($rows = tep_db_fetch_array($rows_query)) {
                        if (empty($j)) {
                            $schema = 'INSERT INTO `'.$table.'` (`'.implode('`, `', $table_list)."`) VALUES\n(";
                        } else {
                            $schema = ",\n(";
                        }

                        foreach ($table_list as $i) {
                            if (!isset($rows[$i])) {
                                $schema .= 'NULL,';
                            } elseif ($rows[$i] !== '') {
                                $row = addslashes($rows[$i]);
                                $row = preg_replace("/\n#/", "\n".'\#', $row);

                                $schema .= '\''.$row.'\',';
                            } else {
                                $schema .= '\'\',';
                            }
                        }

                        ++$j;

                        fwrite($fp, preg_replace('/,$/', '', $schema).')');
                    }

                    if (!empty($j)) {
                        fwrite($fp, ";\n\n");
                    }
                }
            }

            fclose($fp);

            if (isset($_POST['download']) && ($_POST['download'] === 'yes')) {
                switch ($_POST['compress']) {
                    case 'gzip':
                        exec(LOCAL_EXE_GZIP.' '.DIR_FS_BACKUP.$backup_file);
                        $backup_file .= '.gz';

                        break;
                    case 'zip':
                        exec(LOCAL_EXE_ZIP.' -j '.DIR_FS_BACKUP.$backup_file.'.zip '.DIR_FS_BACKUP.$backup_file);
                        unlink(DIR_FS_BACKUP.$backup_file);
                        $backup_file .= '.zip';
                }

                header('Content-type: application/x-octet-stream');
                header('Content-disposition: attachment; filename='.$backup_file);

                readfile(DIR_FS_BACKUP.$backup_file);
                unlink(DIR_FS_BACKUP.$backup_file);

                exit;
            }

            switch ($_POST['compress']) {
                case 'gzip':
                    exec(LOCAL_EXE_GZIP.' '.DIR_FS_BACKUP.$backup_file);

                    break;
                case 'zip':
                    exec(LOCAL_EXE_ZIP.' -j '.DIR_FS_BACKUP.$backup_file.'.zip '.DIR_FS_BACKUP.$backup_file);
                    unlink(DIR_FS_BACKUP.$backup_file);
            }

            $messageStack->add_session(SUCCESS_DATABASE_SAVED, 'success');

            tep_redirect(tep_href_link('backup.php'));

            break;
        case 'restorenow':
        case 'restorelocalnow':
            tep_set_time_limit(0);

            if ($action === 'restorenow') {
                $read_from = $_GET['file'];

                if (file_exists(DIR_FS_BACKUP.$_GET['file'])) {
                    $restore_file = DIR_FS_BACKUP.$_GET['file'];
                    $extension = substr($_GET['file'], -3);

                    if (($extension === 'sql') || ($extension === '.gz') || ($extension === 'zip')) {
                        switch ($extension) {
                            case 'sql':
                                $restore_from = $restore_file;
                                $remove_raw = false;

                                break;
                            case '.gz':
                                $restore_from = substr($restore_file, 0, -3);
                                exec(LOCAL_EXE_GUNZIP.' '.$restore_file.' -c > '.$restore_from);
                                $remove_raw = true;

                                break;
                            case 'zip':
                                $restore_from = substr($restore_file, 0, -4);
                                exec(LOCAL_EXE_UNZIP.' '.$restore_file.' -d '.DIR_FS_BACKUP);
                                $remove_raw = true;
                        }

                        if (isset($restore_from) && file_exists($restore_from) && (filesize($restore_from) > 1024)) {
                            $fd = fopen($restore_from, 'rb');
                            $restore_query = fread($fd, filesize($restore_from));
                            fclose($fd);
                        }
                    }
                }
            } elseif ($action === 'restorelocalnow') {
                $sql_file = new upload('sql_file');

                if ($sql_file->parse()) {
                    $restore_query = fread(fopen($sql_file->tmp_filename, 'rb'), filesize($sql_file->tmp_filename));
                    $read_from = $sql_file->filename;
                }
            }

            if (isset($restore_query)) {
                $sql_array = [];
                $drop_table_names = [];
                $sql_length = \strlen($restore_query);
                $pos = strpos($restore_query, ';');

                for ($i = $pos; $i < $sql_length; ++$i) {
                    if ($restore_query[0] === '#') {
                        $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
                        $sql_length = \strlen($restore_query);
                        $i = strpos($restore_query, ';') - 1;

                        continue;
                    }

                    if ($restore_query[$i + 1] === "\n") {
                        for ($j = ($i + 2); $j < $sql_length; ++$j) {
                            if (trim($restore_query[$j]) !== '') {
                                $next = substr($restore_query, $j, 6);

                                if ($next[0] === '#') {
                                    // find out where the break position is so we can remove this line (#comment line)
                                    for ($k = $j; $k < $sql_length; ++$k) {
                                        if ($restore_query[$k] === "\n") {
                                            break;
                                        }
                                    }

                                    $query = substr($restore_query, 0, $i + 1);
                                    $restore_query = substr($restore_query, $k);
                                    // join the query before the comment appeared, with the rest of the dump
                                    $restore_query = $query.$restore_query;
                                    $sql_length = \strlen($restore_query);
                                    $i = strpos($restore_query, ';') - 1;

                                    break 2;
                                }

                                break;
                            }
                        }

                        if ($next === '') { // get the last insert query
                            $next = 'insert';
                        }

                        if (preg_match('/create/i', $next) || preg_match('/insert/i', $next) || preg_match('/drop t/i', $next)) {
                            $query = substr($restore_query, 0, $i);

                            $next = '';
                            $sql_array[] = $query;
                            $restore_query = ltrim(substr($restore_query, $i + 1));
                            $sql_length = \strlen($restore_query);
                            $i = strpos($restore_query, ';') - 1;

                            if (preg_match('/^create*/i', $query)) {
                                $table_name = trim(substr($query, stripos($query, 'table ') + 6));
                                $table_name = substr($table_name, 0, strpos($table_name, ' '));

                                $drop_table_names[] = $table_name;
                            }
                        }
                    }
                }

                tep_db_query('drop table if exists '.implode(', ', $drop_table_names));

                for ($i = 0, $n = \count($sql_array); $i < $n; ++$i) {
                    tep_db_query($sql_array[$i]);
                }

                tep_session_close();

                tep_db_query('delete from sessions');

                tep_db_query("delete from configuration where configuration_key = 'DB_LAST_RESTORE'");
                tep_db_query("insert into configuration values (null, 'Last Database Restore', 'DB_LAST_RESTORE', '".$read_from."', 'Last database restore file', '6', '0', null, now(), '', '')");

                if (isset($remove_raw) && $remove_raw) {
                    unlink($restore_from);
                }

                $messageStack->add_session(SUCCESS_DATABASE_RESTORED, 'success');
            }

            tep_redirect(tep_href_link('backup.php'));

            break;
        case 'download':
            $extension = substr($_GET['file'], -3);

            if (($extension === 'zip') || ($extension === '.gz') || ($extension === 'sql')) {
                if ($fp = fopen(DIR_FS_BACKUP.$_GET['file'], 'rb')) {
                    $buffer = fread($fp, filesize(DIR_FS_BACKUP.$_GET['file']));
                    fclose($fp);

                    header('Content-type: application/x-octet-stream');
                    header('Content-disposition: attachment; filename='.$_GET['file']);

                    echo $buffer;

                    exit;
                }
            } else {
                $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
            }

            break;
        case 'deleteconfirm':
            if (strstr($_GET['file'], '..')) {
                tep_redirect(tep_href_link('backup.php'));
            }

            tep_remove(DIR_FS_BACKUP.'/'.$_GET['file']);

            $messageStack->add_session(SUCCESS_BACKUP_DELETED, 'success');

            tep_redirect(tep_href_link('backup.php'));

            break;
    }
}

// check if the backup directory exists
$dir_ok = false;

if (is_dir(DIR_FS_BACKUP)) {
    if (tep_is_writable(DIR_FS_BACKUP)) {
        $dir_ok = true;
    } else {
        $messageStack->add(ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
    }
} else {
    $messageStack->add(ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
}

require 'includes/template_top.php';
?>

  <table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
      <td>
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="dataTableHeadingRow">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TITLE; ?></td>
                  <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FILE_DATE; ?></td>
                  <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILE_SIZE; ?></td>
                  <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                </tr>
                <?php
                if ($dir_ok) {
                    $dir = dir(DIR_FS_BACKUP);
                    $contents = [];

                    while ($file = $dir->read()) {
                        if (!is_dir(DIR_FS_BACKUP.$file) && \in_array(substr($file, -3), ['zip', 'sql', '.gz'], true)) {
                            $contents[filemtime(DIR_FS_BACKUP.$file)] = $file;
                        }
                    }

                    krsort($contents);

                    foreach ($contents as $entry) {
                        $check = 0;

                        if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] === $entry))) && !isset($buInfo) && ($action !== 'backup') && ($action !== 'restorelocal')) {
                            $file_array['file'] = $entry;
                            $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP.$entry));
                            $file_array['size'] = number_format(filesize(DIR_FS_BACKUP.$entry)).' bytes';

                            switch (substr($entry, -3)) {
                                case 'zip':
                                    $file_array['compression'] = 'ZIP';

                                    break;
                                case '.gz':
                                    $file_array['compression'] = 'GZIP';

                                    break;

                                default:
                                    $file_array['compression'] = TEXT_NO_EXTENSION;

                                    break;
                            }

                            $buInfo = new objectInfo($file_array);
                        }

                        if (isset($buInfo) && \is_object($buInfo) && ($entry === $buInfo->file)) {
                            echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
                            $onclick_link = 'file='.$buInfo->file.'&action=restore';
                        } else {
                            echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
                            $onclick_link = 'file='.$entry;
                        }

                        ?>
                    <td class="dataTableContent" onclick="document.location.href='<?php echo tep_href_link('backup.php', $onclick_link); ?>'"><?php echo '<a href="'.tep_href_link('backup.php', 'action=download&file='.$entry).'">'.tep_image('images/icons/file_download.gif', ICON_FILE_DOWNLOAD).'</a>&nbsp;'.$entry; ?></td>
                    <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo tep_href_link('backup.php', $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP.$entry)); ?></td>
                    <td class="dataTableContent" align="right" onclick="document.location.href='<?php echo tep_href_link('backup.php', $onclick_link); ?>'"><?php echo number_format(filesize(DIR_FS_BACKUP.$entry)); ?> bytes</td>
                    <td class="dataTableContent" align="right"><?php if (isset($buInfo) && \is_object($buInfo) && ($entry === $buInfo->file)) {
                        echo tep_image('images/icon_arrow_right.gif', '');
                    } else {
                        echo '<a href="'.tep_href_link('backup.php', 'file='.$entry).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                    }

                        ?>&nbsp;
                    </td>
                    </tr>
                    <?php
                    }

                    $dir->close();
                }

?>
                <tr>
                  <td class="smallText" colspan="3"><?php echo TEXT_BACKUP_DIRECTORY.' '.DIR_FS_BACKUP; ?></td>
                  <td align="right" class="smallText"><?php if (($action !== 'backup') && (isset($dir))) {
                      echo tep_draw_button(IMAGE_BACKUP, 'copy', tep_href_link('backup.php', 'action=backup'));
                  }

if (($action !== 'restorelocal') && isset($dir)) {
    echo tep_draw_button(IMAGE_RESTORE, 'arrowrefresh-1-w', tep_href_link('backup.php', 'action=restorelocal'));
}

?></td>
                </tr>
                <?php
               if (\defined('DB_LAST_RESTORE')) {
                   ?>
                  <tr>
                    <td class="smallText" colspan="4"><?php echo TEXT_LAST_RESTORATION.' '.DB_LAST_RESTORE.' <a href="'.tep_href_link('backup.php', 'action=forget').'">'.TEXT_FORGET.'</a>'; ?></td>
                  </tr>
                  <?php
               }

?>
              </table>
            </td>
            <?php
            $heading = [];
$contents = [];

switch ($action) {
    case 'backup':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_BACKUP.'</strong>'];

        $contents = ['form' => tep_draw_form('backup', 'backup.php', 'action=backupnow')];
        $contents[] = ['text' => TEXT_INFO_NEW_BACKUP];

        $contents[] = ['text' => '<br />'.tep_draw_radio_field('compress', 'no', true).' '.TEXT_INFO_USE_NO_COMPRESSION];

        if (file_exists(LOCAL_EXE_GZIP)) {
            $contents[] = ['text' => '<br />'.tep_draw_radio_field('compress', 'gzip').' '.TEXT_INFO_USE_GZIP];
        }

        if (file_exists(LOCAL_EXE_ZIP)) {
            $contents[] = ['text' => tep_draw_radio_field('compress', 'zip').' '.TEXT_INFO_USE_ZIP];
        }

        if ($dir_ok === true) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('download', 'yes').' '.TEXT_INFO_DOWNLOAD_ONLY.'*<br /><br />*'.TEXT_INFO_BEST_THROUGH_HTTPS];
        } else {
            $contents[] = ['text' => '<br />'.tep_draw_radio_field('download', 'yes', true).' '.TEXT_INFO_DOWNLOAD_ONLY.'*<br /><br />*'.TEXT_INFO_BEST_THROUGH_HTTPS];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_BACKUP, 'copy', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('backup.php'))];

        break;
    case 'restore':
        $heading[] = ['text' => '<strong>'.$buInfo->date.'</strong>'];

        $contents[] = ['text' => sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP.(($buInfo->compression !== TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression !== TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : '')];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_RESTORE, 'arrowrefresh-1-w', tep_href_link('backup.php', 'file='.$buInfo->file.'&action=restorenow'), 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('backup.php', 'file='.$buInfo->file))];

        break;
    case 'restorelocal':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_RESTORE_LOCAL.'</strong>'];

        $contents = ['form' => tep_draw_form('restore', 'backup.php', 'action=restorelocalnow', 'post', 'enctype="multipart/form-data"')];
        $contents[] = ['text' => TEXT_INFO_RESTORE_LOCAL.'<br /><br />'.TEXT_INFO_BEST_THROUGH_HTTPS];
        $contents[] = ['text' => '<br />'.tep_draw_file_field('sql_file')];
        $contents[] = ['text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_RESTORE, 'arrowrefresh-1-w', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('backup.php'))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.$buInfo->date.'</strong>'];

        $contents = ['form' => tep_draw_form('delete', 'backup.php', 'file='.$buInfo->file.'&action=deleteconfirm')];
        $contents[] = ['text' => TEXT_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$buInfo->file.'</strong>'];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('backup.php', 'file='.$buInfo->file))];

        break;

    default:
        if (isset($buInfo) && \is_object($buInfo)) {
            $heading[] = ['text' => '<strong>'.$buInfo->date.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_RESTORE, 'arrowrefresh-1-w', tep_href_link('backup.php', 'file='.$buInfo->file.'&action=restore')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('backup.php', 'file='.$buInfo->file.'&action=delete'))];
            $contents[] = ['text' => '<br />'.TEXT_INFO_DATE.' '.$buInfo->date];
            $contents[] = ['text' => TEXT_INFO_SIZE.' '.$buInfo->size];
            $contents[] = ['text' => '<br />'.TEXT_INFO_COMPRESSION.' '.$buInfo->compression];
        }

        break;
}

if ((!empty($heading)) && (!empty($contents))) {
    echo '            <td width="25%" valign="top">'."\n";

    $box = new box();
    echo $box->infoBox($heading, $contents);

    echo "            </td>\n";
}

?>
          </tr>
        </table>
      </td>
    </tr>
  </table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
