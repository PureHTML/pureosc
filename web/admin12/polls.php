<?php


  require('includes/application_top.php');

  $languages = tep_get_languages();

  if ($HTTP_GET_VARS['action'] == 'update') {
    mysql_query('SET NAMES UTF8'); //jsp:!
    $poll_update=tep_db_query("update phesis_poll_desc set catID='".$HTTP_POST_VARS['cPath']."' where pollid='".$HTTP_POST_VARS['pollid']."'");
    for ($l=0; $l<sizeof($languages); $l++) {
      $language_id = $languages[$l]['id'];
      for ($i=0;$i<9;$i++){
        $h_voteid='voteid'.$i;
        $polltext = $HTTP_POST_VARS[$h_voteid][$language_id];
        $update_query ="update phesis_poll_data set ";
        $update_query .= "optiontext='".$polltext."' ";
        $update_query .= " where voteid = '" . $i."' and pollid='".$HTTP_POST_VARS['pollid']."' and language_id = '" . $language_id . "'";
//die($HTTP_POST_VARS['$h_voteid'][$language_id]);
        tep_db_query($update_query);
      }
    }
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'info=' . $HTTP_POST_VARS['pollid'], 'NONSSL')); tep_exit();
  } elseif ($HTTP_GET_VARS['action'] == 'save_config') {
    tep_db_query("update phesis_poll_config set configuration_value = '" . $HTTP_POST_VARS['configuration_value'] . "', last_modified = now() where configuration_id = '" . $HTTP_POST_VARS['configuration_id'] . "'");
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'action=config', 'NONSSL')); tep_exit();
  } elseif ($HTTP_GET_VARS['action'] == 'poll_type') {
    mysql_query('SET NAMES UTF8'); //jsp
    $poll_query=tep_db_query("select poll_type from phesis_poll_desc where pollid=".$HTTP_GET_VARS['info']);
    $poll_type=tep_db_fetch_array($poll_query);
    $new_poll_type=1;
    if ($poll_type['poll_type']==1) {
      $new_poll_type=0;
    }
    mysql_query('SET NAMES UTF8'); //jsp
    $poll_update=tep_db_query("update phesis_poll_desc set poll_type=".$new_poll_type." where pollid=".$HTTP_GET_VARS['info']);
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'info=' . $HTTP_POST_VARS['pollid'], 'NONSSL')); tep_exit();
 } elseif ($HTTP_GET_VARS['action'] == 'poll_open') {
    $poll_query=tep_db_query("select poll_open from phesis_poll_desc where pollid=".$HTTP_GET_VARS['info']);
    $poll_open=tep_db_fetch_array($poll_query);
    $new_poll_open=1;
    if ($poll_open['poll_open']==1) {
        $new_poll_open=0;
        }
    $poll_update=tep_db_query("update phesis_poll_desc set poll_open=".$new_poll_open." where pollid=".$HTTP_GET_VARS['info']);
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'info=' . $HTTP_POST_VARS['pollid'], 'NONSSL')); tep_exit();
 } elseif ($HTTP_GET_VARS['action'] == 'deleteconfirm') {
    $delete_query="delete from phesis_poll_desc where pollid='".$HTTP_POST_VARS['cID']."'";
    tep_db_query($delete_query);
    $delete_query="delete from phesis_poll_data where pollid='".$HTTP_POST_VARS['cID']."'";
    tep_db_query($delete_query);
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action','info')), 'NONSSL'));
  } elseif ($HTTP_GET_VARS['action'] == 'updatenew') {
    $insert_query="insert into phesis_poll_desc (timestamp,voters,catID) values (NOW(), '0', '" . $HTTP_POST_VARS['cPath'] . "')";
    $poll_query = tep_db_query($insert_query);
    $pollid = tep_db_insert_id();
    for ($l=0; $l<sizeof($languages); $l++) {
      $language_id = $languages[$l]['id'];
      for ($i=0;$i<9;$i++){
        $h_voteid='voteid'.$i;
        $polltext = $HTTP_POST_VARS['$h_voteid'][$language_id];
        $insert_query="insert into phesis_poll_data (pollid,optiontext,optioncount,voteid, language_id) values ($pollid, '".$HTTP_POST_VARS[$h_voteid][$language_id]."', 0, $i, '" . $language_id ."')";
        tep_db_query($insert_query);
      }
    }
    header('Location: ' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'info=' . $HTTP_POST_VARS['pollid'], 'NONSSL')); tep_exit();
  }
?>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<?php
?>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
 if ($HTTP_GET_VARS['action'] == 'new') {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'table_background_account.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <td><table border="0" width="70%" cellspacing="0" cellpadding="0">
       <form name="polls" <?php echo 'action="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'action=updatenew', 'NONSSL') . '"'; ?> method="post"><input type="hidden" name="pollid" value="NULL">
      <tr>
        <td>&nbsp</td>
      </tr>
        <tr>
        <td class="main"><?php echo TEXT_POLL_CATEGORY; ?>&nbsp;</td>
<?php
$categories = tep_get_category_tree();
$categories[0]['text'] = 'All Categories';
?>
        <td><?php echo tep_draw_pull_down_menu('cPath', $categories, 0 ); ?></td>
      </tr>
      <tr>
        <td>&nbsp</td>
      </tr>
<?php
    for ($l=0; $l<sizeof($languages); $l++) {
?>
      <tr>
        <td>&nbsp</td>
      </tr>
        <tr>
        <td class="main"><?php echo TEXT_POLL_TITLE; ?>&nbsp;&nbsp;<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$l]['directory'] . '/images/' . $languages[$l]['image'], $languages[$l]['name']);?></td>
        <td><input type="text" name="voteid0[<?php echo $languages[$l]['id']; ?>]" maxlength="255" size="50" value=""></td>
      </tr>
      <tr>
        <td>&nbsp</td>
      </tr>
<?php
      for ($i=1; $i<9; $i++){
?>
      <tr>
        <td class="main"><?php echo TEXT_OPTION . ' ' . $i?>&nbsp</td>
      <td><input type="text" name="voteid<?php echo $i?>[<?php echo $languages[$l]['id']; ?>]" maxlength="50" size="50" value=""></td>
      </tr>
<?php
        }
       }
?>
        <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'info=' . $HTTP_GET_VARS['cID'], 'NONSSL') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
        </form>
      </table></td></tr>
<?php
  } elseif ($HTTP_GET_VARS['action'] == 'config' || $HTTP_GET_VARS['action'] == 'edit_config') {
?>
<tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $rows = 0;
  $configuration_query = tep_db_query("select configuration_id as cfgID, configuration_title as cfgTitle, configuration_value as cfgValue from phesis_poll_config");
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    $rows++;
    if (((!$HTTP_GET_VARS['info']) || (@$HTTP_GET_VARS['info'] == $configuration['cfgID'])) && (!$cfgInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
      $cfg_extra_query = tep_db_query("select configuration_key as cfgKey, configuration_description as cfgDesc, date_added, last_modified from phesis_poll_config where configuration_id = '" . $configuration['cfgID'] . "'");
      $cfg_extra = tep_db_fetch_array($cfg_extra_query);

      $cfgInfo_array = array_merge($configuration, $cfg_extra);
      $cfgInfo = new objectInfo($cfgInfo_array);
    }

    if ( (is_object($cfgInfo)) && ($configuration['cfgID'] == $cfgInfo->cfgID)) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link('polls.php', 'info=' . $cfgInfo->cfgID . '&action=edit_config') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link('polls.php', 'info=' . $configuration['cfgID']. '&action=config') . '\'">' . "\n";
    }
?>
                <td class="smallText">&nbsp;<?php echo $configuration['cfgTitle']; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $configuration['cfgValue']; ?>&nbsp;</td>
<?php
    if ($configuration['cfgID'] == $cfgInfo->id) {
?>
                    <td align="center" class="smallText">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); ?>&nbsp;</td>
<?php
    } else {
?>
                    <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action')) . 'action=config&info=' . $configuration['cfgID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; ?>&nbsp;</td>
<?php
    }
?>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  if ($cfgInfo) $heading[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $cfgInfo->cfgTitle . '</b>&nbsp;');
  if ((!$peInfo) && ($HTTP_GET_VARS['action'] == 'new')) $heading[] = array('align' => 'left', 'text' => '&nbsp;<b>' . TEXT_INFO_HEADING_NEW_PRODUCT . '</b>&nbsp;');

  if ($HTTP_GET_VARS['action'] == 'edit_config') {
    $form = '<form name="configuration" action="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'action=save_config', 'NONSSL') . '" method="post"><input type="hidden" name="configuration_id" value="' . $HTTP_GET_VARS['info'] . '">' . "\n";

    if (tep_not_null($cfgInfo->set_function)) {
      $set_function = $cfgInfo->set_function;
      $value_field = $set_function($cfgInfo->cfgValue);
    } else {
      $value_field = '<input type="text" name="configuration_value" value="' . $cfgInfo->cfgValue . '">';
    }

    $contents[] = array('text' => $form);
    $contents[] = array('align' => 'left', 'text' => TEXT_INFO_EDIT_INTRO . '<br>&nbsp;');
    $contents[] = array('align' => 'left', 'text' => '<b>' . $cfgInfo->cfgTitle . '</b><br>' . $cfgInfo->cfgDesc . '<br>' . $value_field . '<br>&nbsp;');
    $contents[] = array('align' => 'center', 'text' => tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')).'action=config', 'NONSSL') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    $contents[] = array('text' => '</form>');
  } else {
    $contents = array('text' => $form);

    $contents[] = array('align' => 'center', 'text' =>
                       '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=edit_config&info=' . $cfgInfo->cfgID, 'NONSSL') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a>
                        <a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=confirm&info=' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>
                        <a href="' . tep_href_link(FILENAME_POLLBOOTH, 'op=list' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_preview.gif', IMAGE_PREVIEW) . '</a>');


    $contents[] = array('align' => 'left', 'text' => '<br>' . TEXT_INFO_DESCRIPTION . '<br>' . $cfgInfo->cfgDesc);
    $contents[] = array('align' => 'left', 'text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($cfgInfo->date_added) . '<br>' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($cfgInfo->last_modified));
    $contents[] = array('text' => '</<form>');
  }
echo '            <td width="25%" valign="top">' . "\n";
  $box = new box;
  echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
?>
<?php
  } elseif ($HTTP_GET_VARS['action'] == 'edit') {
    $poll_query = tep_db_query("select * from phesis_poll_desc where pollid = '" . $HTTP_GET_VARS['cID'] . "'");
    $polls = tep_db_fetch_array($poll_query);
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <td><table border="0" width="70%" cellspacing="0" cellpadding="0">
       <form name="polls" <?php echo 'action="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'action=update', 'NONSSL') . '"'; ?> method="post"><input type="hidden" name="pollid" value="<?php echo $HTTP_GET_VARS['cID']; ?>">
      <tr>
        <td>&nbsp</td>
      </tr>
        <tr>
        <td class="main"><?php echo TEXT_POLL_CATEGORY; ?>&nbsp;</td>
<?php
$categories = tep_get_category_tree();
$categories[0]['text'] = 'All Categories';
?>
        <td><?php echo tep_draw_pull_down_menu('cPath', $categories, $polls['catID'] ); ?></td>
      </tr>
      <tr>
        <td>&nbsp</td>
      </tr>
<?php
    for ($l=0; $l<sizeof($languages); $l++) {
    $poll_data_query=tep_db_query("select * from phesis_poll_data where pollid = '" . $HTTP_GET_VARS['cID'] . "' and voteid='0' and language_id = '".$languages[$l]['id']."'");
    $polls_data=tep_db_fetch_array($poll_data_query);

?>
      <tr>
        <td>&nbsp</td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_POLL_TITLE; ?>&nbsp;&nbsp;<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$l]['directory'] . '/images/' . $languages[$l]['image'], $languages[$l]['name']);?></td>
        <td><input type="text" name="voteid0[<?php echo $languages[$l]['id']; ?>]" maxlength="255" size="50" value="<?php echo $polls_data['optionText']; ?>"></td>
      </tr>
      <tr>
        <td>&nbsp</td>
      </tr>
<?php
      for ($i=1; $i<9; $i++){
    $poll_data_query=tep_db_query("select * from phesis_poll_data where pollid = '" . $HTTP_GET_VARS['cID'] . "' and voteid='" .$i . "' and language_id = '".$languages[$l]['id']."'");
    $polls_data=tep_db_fetch_array($poll_data_query);

?>
      <tr>
        <td class="main"><?php echo TEXT_OPTION . ' ' . $i?>&nbsp</td>
      <td><input type="text" name="voteid<?php echo $i?>[<?php echo $languages[$l]['id']; ?>]" maxlength="50" size="50" value="<?php //echo $polls_data['optionText']; ?>"></td>


      </tr>
<?php
        }
       }
?>
       <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'info=' . $HTTP_GET_VARS['cID'], 'NONSSL') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr> <table>
  <tr>
    <td><?PHP include('poll_list.php'); ?></td>
  </tr>
</table>
        </form>



      </table></td></tr>
<?php
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_TITLE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_VOTES; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_CREATED; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_PUBLIC; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPEN; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php

    $poll_query_raw = "Select pollID, voters, timeStamp, poll_type, poll_open from phesis_poll_desc order by pollID asc";
    $polls_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $poll_query_raw, $poll_query_numrows);
    $poll_query=tep_db_query($poll_query_raw);
    $rows = 0;
    while ($polls = tep_db_fetch_array($poll_query)) {
      $rows++;
        if (((!$HTTP_GET_VARS['info']) || (@$HTTP_GET_VARS['info'] == $polls['pollID'])) && (!$poInfo)) {
      $poInfo = new objectInfo($polls);
      }
//      if (!$poInfo->pollID) $poInfo->pollID = $polls['pollID'];
      if ( (is_object($poInfo)) && ($polls['pollID'] == $poInfo->pollID) ) {
?>
          <tr class="dataTableRowSelected" onmouseover="this.style.cursor='hand'" onclick="document.location.href='<?php echo tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=edit&cID=' . $poInfo->pollID, 'NONSSL'); ?>'">
<?php
      } else {
?>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'" onclick="document.location.href='<?php echo tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'info=' . $polls['pollID'], 'NONSSL'); ?>'">
<?php
      }
      $title_query = tep_db_query("select optionText from phesis_poll_data where voteid = '0' and pollID = '" . $polls['pollID'] . "' and language_id = '" . $languages_id ."'");
      $title = tep_db_fetch_array($title_query);
?>
                <td class="dataTableContent" align="center">&nbsp;<?php echo $polls['pollID']; ?>&nbsp;</td>
                <td class="dataTableContent">&nbsp;<?php echo $title['optionText']; ?>&nbsp;</td>
                <td class="dataTableContent" align="center">&nbsp;<?php echo $polls['voters']; ?>&nbsp;</td>
                <td class="dataTableContent" align="center">&nbsp;<?php echo tep_date_short($polls['timeStamp']); ?>&nbsp;</td>
                <td class="dataTableContent" align="center">&nbsp;
                        <?php
                        if ($polls['poll_type']==1) {
                                echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_type&info=' . $polls['pollID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', _ALT_PUBLIC) . '</a>';
                                } else {
                                echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_type&info=' . $polls['pollID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', _ALT_PRIVATE) . '</a>';
                                }
                  ?>
                &nbsp;</td>
                <td class="dataTableContent" align="center">&nbsp;
                        <?php
                         if ($polls['poll_open']==1) {
                                echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_open&info=' . $polls['pollID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', _ALT_REOPEN) . '</a>';
                                } else {
                                echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_open&info=' . $polls['pollID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', _ALT_CLOSE) . '</a>';
                                }
                        ?>
                        &nbsp;</td>
<?php
      if ($polls['pollID'] == $poInfo->pollID) {
?>
                <td class="smallText" align="center">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); ?>&nbsp;</td>
<?php
      } else {
?>
                <td class="smallText" align="center">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'info=' . $polls['pollID'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; ?>&nbsp;</td>
<?php
      }
?>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smalltext" valign="top">&nbsp;<?php echo $polls_split->display_count($poll_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_POLLS); ?>&nbsp;&nbsp;</td>
                    <td class="smalltext" align="right">&nbsp;<?php echo $polls_split->display_links($poll_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;<? echo '<br><br>&nbsp;<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info')) . 'action=new', 'NONSSL') . '">' . tep_image_button('button_new_poll.gif', IMAGE_NEW_POLL) . '</a>&nbsp;';?></td>
                        </tr>
                </table></td>
              </tr>
            </table></td>
<?php
// this is the table to left main polls.php

  $heading=array();
  $contents=array();

  $heading[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $poInfo->pollTitle . '</b>&nbsp;');

  if ($HTTP_GET_VARS['action'] == 'confirm') {
    $form = '<form action="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'action=deleteconfirm', 'NONSSL') . '" method="post"><input type="hidden" name="cID" value="' . $poInfo->pollID . '">'  ."\n";
    $contents[] = array('text' => $form);
    $contents[] = array('align' => 'left', 'text' => TEXT_DELETE_INTRO . '<br>&nbsp;<b>' . $poInfo->name . '</b><br>&nbsp;');
    $contents[] = array('align' => 'center', 'text' => tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
  } else {
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=edit&cID=' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=confirm&info=' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>                      &nbsp;<a href="' . tep_href_link('pollbooth.php', 'op=results&pollid=' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_preview.gif', IMAGE_PREVIEW) . '</a>');
}
if ($poll_query_numrows==0){
        $contents[] = array('align' => 'center', 'text' => 'No polls defined');
}
if ($form) $contents[] = array('text' => '</form>');

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
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
