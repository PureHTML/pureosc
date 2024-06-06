<?php
/*
  $Id: events_calendar v2.00 2003/06/16 18:09:20 ip chilipepper.it Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  define(FILENAME_DEFAULT_CATALOG, 'index.php');
  define(FILENAME_PRODUCT_INFO, 'product_info.php');

  $languages = tep_get_languages();

    if ($HTTP_GET_VARS['action']) {

    switch ($HTTP_GET_VARS['action']) {
      case 'edit':
        $HTTP_GET_VARS['action'] = 'new';
        break;

      case 'preview':
      case 'insert':
      case 'update':

      if (!$HTTP_POST_VARS['preview_x']) {
      if (($HTTP_POST_VARS['edit_x']) || ($HTTP_POST_VARS['edit_y']) || ($HTTP_POST_VARS['manufacturers_id']) || ($HTTP_POST_VARS['cPath']) || ($HTTP_POST_VARS['products_id']) || ($HTTP_POST_VARS['upcoming']) ) {
          $HTTP_GET_VARS['action'] = 'new';
          break;
        }
      }
      
        $event_id = $HTTP_POST_VARS['eID'];
        $start_event = $HTTP_POST_VARS['start'];
        $event_error = false;
        
        if (empty($start_event)) {
          $messageStack->add(ERROR_EVENT_START_DATE, 'error');
          $event_error = true;
        }
        
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          $event_title = $HTTP_POST_VARS['title'][$language_id];
          if (empty($event_title)) {
          $messageStack->add(ERROR_EVENT_TITLE, 'error');
          $event_error = true;
          }
        }

        if (!$event_error) {
          if ($HTTP_GET_VARS['action'] == 'preview') {
          break;
          }
          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('start_date' => tep_db_prepare_input($HTTP_POST_VARS['start']),
                                  'end_date' => tep_db_prepare_input($HTTP_POST_VARS['end']),
                                  'title' => tep_db_prepare_input($HTTP_POST_VARS['title'][$language_id]),
                                  'description' => tep_db_prepare_input($HTTP_POST_VARS['description'][$language_id]),
                                  'event_image' => tep_db_prepare_input($HTTP_POST_VARS['event_image']),
                                  'OSC_link' =>  tep_db_prepare_input($HTTP_POST_VARS['OSC_link']),
                                  'link' =>  tep_db_prepare_input($HTTP_POST_VARS['link']));

          if ($HTTP_GET_VARS['action'] == 'insert') {
            $sql_data_array['event_id'] = $event_id;
            $sql_data_array['language_id'] = $language_id;
            $sql_data_array['date_added'] = 'now()';
            tep_db_perform(TABLE_EVENTS_CALENDAR, $sql_data_array);

            $event_id = tep_db_insert_id();

          } elseif ($HTTP_GET_VARS['action'] == 'update') {
            tep_db_perform(TABLE_EVENTS_CALENDAR, $sql_data_array, 'update', 'event_id = \'' . tep_db_input($event_id) . '\' and language_id = \'' . $language_id . '\'');
          }
        }

          tep_redirect(tep_href_link(FILENAME_EVENTS_MANAGER));

        } else {
          $HTTP_GET_VARS['action'] = 'new';
        }
        break;

      case 'delete_event':
        $HTTP_GET_VARS['action'] = 'delete_event';
        break;

      case 'delete_confirm':
        $event_id = tep_db_prepare_input($HTTP_GET_VARS['eID']);
        tep_db_query("delete from " . TABLE_EVENTS_CALENDAR . " where event_id = '" . tep_db_input($event_id) . "'");
        tep_redirect(tep_href_link(FILENAME_EVENTS_MANAGER));
        break;
        
      case 'delete_events':
        $HTTP_GET_VARS['action'] = 'delete_events';
        break;

      case 'delete_events_confirm':
        $before = tep_db_prepare_input($HTTP_GET_VARS['b_date']);
        tep_db_query("delete from " . TABLE_EVENTS_CALENDAR . " where start_date < '" . tep_db_input($before) . "'");
        tep_redirect(tep_href_link(FILENAME_EVENTS_MANAGER));
        break;
    }
  }
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?> ">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<style type="text/css">
<!--
TD.main, P.main { font-family: Verdana, Arial, sans-serif; font-size: 11px; line-height: 1.5; }
.event { font-family: Arial, Verdana; font-size: 11px; color: #000000; background-color: #FFFFFF; text-decoration: none; border:1px solid #E6E6E6; }
-->
</style>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>

<script language="javascript"><!--

var submitted = false;
function check_delete_events() {
  var error = 0;
  var error_message = "<?php echo EVENTS_ERROR; ?>";
  var before = document.delete_events.before.value;

  if (document.delete_events.elements['before'].type != "hidden") {
    if (before == '' || before == "yyyy-MM-dd" ) {
      error_message = error_message + "<?php echo DELETE_EVENTS_ERROR; ?>";
      error = 1;
    }
  }
  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>

</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?> " valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?> " cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <table border="0" width="600" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" height="36"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">
            <?php echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER, 'action=new') . '">' . tep_image_button('button_new_event.gif', IMAGE_NEW_EVENT, 'align=absmiddle' ) . '</a>'; ?></td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
      <td valign="top">
<?php
if ($HTTP_GET_VARS['action'] == 'new') {
    $form_action = 'preview';
    if ($HTTP_GET_VARS['eID']) {
      $eID = tep_db_prepare_input($HTTP_GET_VARS['eID']);
      $form_action = 'preview';
      $events_query = tep_db_query("select event_id, start_date, end_date, event_image, link, OSC_link, date_added from " . TABLE_EVENTS_CALENDAR . " where event_id = '" . tep_db_input($eID) . "'");

      $events = tep_db_fetch_array($events_query);
      }
      $start_d =($HTTP_POST_VARS['start'] ? $HTTP_POST_VARS['start'] : $events['start_date']);
      $end_d =($HTTP_POST_VARS['end'] ? $HTTP_POST_VARS['end'] : $events['end_date']);
      //print_r ($events);
      $languages = tep_get_languages();
          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];

          $events_language_query = tep_db_query("select title, description from " . TABLE_EVENTS_CALENDAR . " where event_id = '" . tep_db_input($eID) . "' and language_id = '" . $languages[$i]['id'] . "'");
          $events_language[$i] = tep_db_fetch_array($events_language_query);
          //print_r ($events_language[$i]);
      }
?>

<?php
if ($HTTP_POST_VARS['upcoming']){
      $available_query = tep_db_query("select products_date_available from " . TABLE_PRODUCTS . " where products_id = '" . $HTTP_POST_VARS['upcoming'] . "'");
      $available = tep_db_fetch_array($available_query);
      $start_d = substr($available['products_date_available'],0 ,10);
      $end_d = '';
   }
?>

<script language="javascript">
var scImgPath = '../includes/javascript/spiffyCal/images/';
var start_date = new ctlSpiffyCalendarBox("start_date", "events", "start", "btnDate1","<?php echo $start_d ; ?>",scBTNMODE_CUSTOMBLUE);
var end_date = new ctlSpiffyCalendarBox("end_date", "events", "end", "btnDate2","<?php echo $end_d ; ?>",scBTNMODE_CUSTOMBLUE);
</script>

<table border="0" width="600" cellspacing="2" cellpadding="2">
<tr>
<?php echo tep_draw_form('events', FILENAME_EVENTS_MANAGER, '&eID='. $eID .'&action=' . $form_action, 'post', 'enctype="multipart/form-data"'); if ($HTTP_GET_VARS['eID']) echo tep_draw_hidden_field('eID', $eID); ?>
  <td>
    <table width="600" border="0" cellspacing="2" cellpadding="4"  class="columnLeft">
     <?php
     if ($HTTP_GET_VARS['eID'])
     echo '<tr>'.
          '<td class="main" colspan="2">'. TEXT_EVENT_ID .'&nbsp;'. $events['event_id'] .'&nbsp;&nbsp;&nbsp;&nbsp;'. TEXT_EVENT_DATE_ADDED .'&nbsp;'. $events['date_added'] .'</td></tr>'.
          '</tr>';
     ?>
    <tr>
     <td colspan="2">
       <table border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td class="main"><?php echo TEXT_EVENT_START; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
           <td class="main"><script language="javascript">start_date.writeControl(); start_date.dateFormat="yyyy-MM-dd";</script>&nbsp;<font color="red"> * required </font></td>
           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
           <td class="main"><?php echo TEXT_EVENT_END; ?>&nbsp;&nbsp;</td>
           <td class="main"><script language="javascript">end_date.writeControl(); end_date.dateFormat="yyyy-MM-dd";</script></td>
        </tr>
     </table>
     </td>
     </tr>
     
<?php
    $languages = tep_get_languages();
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $language_id = $languages[$i]['id'];
?>

     <tr>
      <?php if ($i == 0) echo '<td class="main" valign="top" rowspan="'. $n .'" nowrap>'. TEXT_EVENT_TITLE; ?></td>
      <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' .
      tep_draw_input_field('title[' . $language_id . ']',(($HTTP_POST_VARS['title'][$language_id]) ? $HTTP_POST_VARS['title'][$language_id] : $events_language[$i]['title']), 'size="50"', false); ?>&nbsp;<font color="red"> * required </font></td>
     </tr>
<?php
    }
?>
     <tr>
<?php
    $languages = tep_get_languages();
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $language_id = $languages[$i]['id'];
?>
      <?php if ($i == 0) echo '<td class="main" valign="top" rowspan="'. $n .'" nowrap>'. TEXT_EVENT_DESCRIPTION; ?></td>
      <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_textarea_field('description[' . $language_id . ']', 'soft', '80%', '6', (($HTTP_POST_VARS['description'][$language_id]) ? $HTTP_POST_VARS['description'][$language_id] : $events_language[$i]['description']) ); ?></td>
     </tr>
<?php
    }
            if($HTTP_POST_VARS['manufacturers_id']!= ''){

///////////////////
    $manufacturers_query = tep_db_query("select manufacturers_name from ". TABLE_MANUFACTURERS ." where manufacturers_id = '" . $HTTP_POST_VARS['manufacturers_id'] . "'");
    if ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    $manufacturers_name = $manufacturers['manufacturers_name'];
    }
///////////////////

             $OSC_link = tep_catalog_href_link(FILENAME_DEFAULT_CATALOG , 'manufacturers_id='. $HTTP_POST_VARS['manufacturers_id'] );
             $OSC_links = '<a href='. $OSC_link .' target=_blank>'. $manufacturers_name .'</a>';

            }elseif($HTTP_POST_VARS['cPath']!= 0){
             $OSC_link = tep_catalog_href_link(FILENAME_DEFAULT_CATALOG , 'cPath='. $HTTP_POST_VARS['cPath'] );
             $OSC_links = '<a href='. $OSC_link .' target=_blank>'. tep_get_category_name($HTTP_POST_VARS['cPath'], $languages_id) .'</a>';

            }elseif($HTTP_POST_VARS['products_id'] != ''){
             $OSC_link = tep_catalog_href_link(FILENAME_PRODUCT_INFO , 'products_id='. $HTTP_POST_VARS['products_id'] );
             $OSC_links = '<a href='. $OSC_link .'>'. tep_get_products_name($HTTP_POST_VARS['products_id']) .'</a>';

            }elseif($HTTP_POST_VARS['upcoming'] != ''){
             $OSC_link = tep_catalog_href_link(FILENAME_PRODUCT_INFO , 'products_id='. substr($HTTP_POST_VARS['upcoming'],0,$sep) );
             $OSC_links = '<a href='. $OSC_link .'>'. tep_get_products_name($HTTP_POST_VARS['upcoming']) .'</a>';

            }else{
             $OSC_links = (($HTTP_POST_VARS['OSC_link']) ? $HTTP_POST_VARS['OSC_link'] : $events['OSC_link']);
            }
?>
      
      <tr>
      <td colspan="2">

       <table border="0" width="100%" cellspacing="0" cellpadding="2" class="columnLeft">
        <tr>
         <td colspan="3" class="main"><b><?php echo TEXT_EVENT_OSC_LINK ; ?></b>&nbsp;&nbsp;<font class="smalltext"><?php echo TEXT_EVENT_OSC_LINK_HELP ; ?></font></td>
        </tr>
        <tr>
         <?php //jsp:todo:error //include(DIR_WS_BOXES . 'event_drop_dns.php'); ?>
        </tr>
        <tr>
         <td colspan="3" class="smalltext"><?php echo TEXT_START_DATE_NOTE; ?></td>
        </tr>
        <?php 
//jsp tady
if ($OSC_links){
        ?>
        <tr>
         <td colspan="3" align="center" height="24" bgcolor="#DDE0E6" class="main"><?php if ($OSC_links) echo TEXT_CURRENT_OSC_LINK .'&nbsp;'. $OSC_links . tep_draw_hidden_field('OSC_link', $OSC_links); ?></td>
        </tr>
        <?php 
        }
        ?>
       </table>
      </td>
     </tr>
     <tr>
      <td class="main"><?php echo TEXT_EVENT_LINK; ?></td>
      <td class="main"><?php echo tep_draw_input_field('link', $events['link'], 'size="50"', false); ?><br><font class="smalltext"><?php echo TEXT_EVENT_LINK_HELP ; ?></font></td>
     </tr>
     <tr>
      <td class="main"><?php echo TEXT_EVENT_IMAGE; ?></td>
      <td class="main">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="main">
      <?php
      echo tep_draw_file_field('event_image') . tep_draw_hidden_field('event_previous_image', (($HTTP_POST_VARS['event_image']) ? $HTTP_POST_VARS['event_image'] : $events['event_image'])) .'<td><td class="main">'. (($HTTP_POST_VARS['event_image']) ? $HTTP_POST_VARS['event_image'] : $events['event_image']) .'&nbsp;&nbsp</td>';
      if ($HTTP_POST_VARS['event_image'] || $events['event_image']) {
      $event_image = ($HTTP_POST_VARS['event_image'] ? $HTTP_POST_VARS['event_image'] : $events['event_image']);
      echo '<td class="main">'. tep_image(DIR_WS_CATALOG_IMAGES .'events_images/' . $event_image , $HTTP_POST_VARS['title'][$language_id], 50, 50, 'align="right" hspace="2" vspace="2"') .'</td>'.
           '<td class="main">&nbsp'. TEXT_EVENT_NO_IMAGE .'&nbsp;&nbsp;'. tep_draw_checkbox_field('no_image', $value = '', $checked = false, $compare = '') .'</td>';
       }
      ?>
        </tr>
       </table>
      </td>
     </tr>
    </table>
      </td>
     </tr>
     <tr>
      <td>
         <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="right">
            <?php if ($HTTP_GET_VARS['eID']) echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER, '&eID=' . tep_db_input($eID) . '&action=delete_event') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>' ?>
            <?php echo tep_image_submit('button_preview.gif', IMAGE_PREVIEW, 'name="preview"') . '&nbsp;' . tep_image_button('button_reset.gif', IMAGE_RESET ,'onClick=reset() style="cursor: hand;"') ; ?></td>
          </tr>
        </table>
      </td>
      </form>
     </tr>
    </table>
<?php
} elseif ($HTTP_GET_VARS['action'] == 'preview') {
    $form_action = 'insert';
    if ($HTTP_GET_VARS['eID']) {
      $eID = tep_db_prepare_input($HTTP_GET_VARS['eID']);
      $form_action = 'update';
      }

      if($HTTP_POST_VARS['no_image']) {
         $event_image = '';
      }else{
      if ($event_image = new upload('event_image', DIR_FS_CATALOG_IMAGES . 'events_images/')) {
        $event_image = $event_image->filename;
      } else {
        $event_image = $HTTP_POST_VARS['event_previous_image'];
      }
}

?>
<table width="600" border="0" cellspacing="1" cellpadding="2">
<?php echo tep_draw_form('events', FILENAME_EVENTS_MANAGER, '&eID='. $eID .'&action=' . $form_action); if ($form_action == 'update' || $form_action == 'insert') echo tep_draw_hidden_field('eID', $eID); ?>
  <tr>
    <td colspan="3" align="center" class="main"><b><?php echo TEXT_EVENT_PREVIEW; ?></b></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>

<?php
    $languages = tep_get_languages();
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $language_id = $languages[$i]['id'];
    
          $clsp = 2;
          echo '<tr><td class="main" valign="top">'. tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;</td>';
          echo '<td width="100%" >';
          echo '<table border="0" width="100%" cellspacing="0" cellpadding="4" class="event">'.
               '<tr>'.
               '<td width="100%" bgcolor="#D9DEE6" class="main" style="border-bottom: 1px solid #D9DEE6" nowrap>'. TEXT_EVENT_TITLE .'&nbsp;&nbsp;'. $HTTP_POST_VARS['title'][$language_id] .  tep_draw_hidden_field('title[' . $language_id . ']', $HTTP_POST_VARS['title'][$language_id]) .'</td>';
          if($HTTP_POST_VARS['end']){
          echo '<td bgcolor="#D9DEE6" align="center" nowrap><div class="event" style="border: 1px inset #F2F4F7">&nbsp;&nbsp;'. TEXT_EVENT_START .'&nbsp;&nbsp;'. $HTTP_POST_VARS['start'] .'&nbsp;&nbsp;</div></td><td bgcolor="#D9DEE6" align="center" nowrap><div class="event" style="border: 1px inset #F2F4F7">&nbsp;&nbsp;'. TEXT_EVENT_END .'&nbsp;&nbsp;'. $HTTP_POST_VARS['end'] .'&nbsp;&nbsp;</div></td>';
          $clsp++;
          }
          echo '</tr><tr>'.
               '<td colspan="'. $clsp . '" class="main">'. TEXT_EVENT_DESCRIPTION .'<br>';

               if ($event_image != ''){
                  echo'<table border="0" cellspacing="0" cellpadding="0" align="right"><tr>'.
                      '<td class="main">'. tep_image(DIR_WS_CATALOG_IMAGES .'events_images/' . $event_image , $HTTP_POST_VARS['title'][$language_id], '', '', 'align="right" hspace="5" vspace="5"') .'</td>'.
                      '</tr></table>';
                      }

          echo $HTTP_POST_VARS['description'][$language_id] . tep_draw_hidden_field('description[' . $language_id . ']',  $HTTP_POST_VARS['description'][$language_id]) .'</td>';

          if($HTTP_POST_VARS['OSC_link']){
          echo '</tr><tr>'.
               '<td colspan="'. $clsp . '"  bgcolor="#F5F5F5" align="left" class="main">'. TEXT_EVENT_OSC_LINK .'&nbsp;&nbsp;'. $HTTP_POST_VARS['OSC_link'] . '</a>'. tep_draw_hidden_field('OSC_link', $HTTP_POST_VARS['OSC_link']) .'</td>';
          }
          if($HTTP_POST_VARS['link']){
          echo '</tr><tr>'.
               '<td colspan="'. $clsp . '"  bgcolor="#F5F5F5" align="left" class="main">'. TEXT_EVENT_LINK .'&nbsp;&nbsp;<a href="http://'. $HTTP_POST_VARS['link'] .'" target="_blank">'. $HTTP_POST_VARS['link'] .'</a>'. tep_draw_hidden_field('link', $HTTP_POST_VARS['link']) .'</td>';
          }
          echo '</tr></table>';
    }
    echo'</td></tr>';
?>
     <tr>
      <td colspan="3" class="main" valign="top"><?php echo TEXT_EVENT_START .'&nbsp;&nbsp;'. $HTTP_POST_VARS['start'] . tep_draw_hidden_field('start', $HTTP_POST_VARS['start']) . tep_draw_hidden_field('event_image', $event_image_name); ?></td>
     </tr>

     <?php
     if ($HTTP_POST_VARS['end'])
     echo '<tr><td colspan="3" class="main">'. TEXT_EVENT_END .'&nbsp;&nbsp;'. $HTTP_POST_VARS['end'] . tep_draw_hidden_field('end', $HTTP_POST_VARS['end']) .'</td></tr>';
     if ($HTTP_POST_VARS['OSC_link'])
     echo '<tr><td colspan="3" class="main">'. TEXT_EVENT_OSC_LINK .'&nbsp;&nbsp;'. $HTTP_POST_VARS['OSC_link'] . tep_draw_hidden_field('OSC_link', $HTTP_POST_VARS['OSC_link']) .'</td></tr>';
     if ($HTTP_POST_VARS['link'])
     echo '<tr><td colspan="3" class="main">'. TEXT_EVENT_LINK .'&nbsp;&nbsp;<a href="http://'. $HTTP_POST_VARS['link'] .'" target="_blank">'. $HTTP_POST_VARS['link'] .'</a>'. tep_draw_hidden_field('link', $HTTP_POST_VARS['link']) .'</td></tr>';
     ?>
     <tr>
      <td colspan="3">
         <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="right">
            <?php echo tep_image_submit('button_back.gif', IMAGE_BACK, 'name="edit" align="absmiddle"') . '&nbsp;'; ?>
            <?php echo (($form_action == 'insert') ? tep_image_submit('button_insert.gif', IMAGE_INSERT, 'align="absmiddle"') : tep_image_submit('button_update.gif', IMAGE_UPDATE, 'align="absmiddle"')); ?>
            </td>
          </tr>
        </table>
       </td>
     </tr>
     </form>
   </table>
<?php
} elseif  ($HTTP_GET_VARS['action'] == 'delete_event')  {
?>
<table border="0" width="600" cellspacing="0" cellpadding="2">
  <?php echo tep_draw_form('events', FILENAME_EVENTS_MANAGER, '&eID='. $eID .'&action=delete_confirm'); ?>
    <tr>
      <td class="main" height="60"><?php echo TEXT_EVENT_DELETE_CONFIRM ?>&nbsp;&nbsp;<?php echo tep_image_submit('button_delete.gif', IMAGE_DELETE, 'align="absmiddle"'); ?>
        <?php echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER) . '">' . tep_image_button('button_back.gif', IMAGE_BACK, 'align="absmiddle"') . '</a>' ?>
    </tr>
  </table>
<?php
} else {

if ($HTTP_GET_VARS['action'] == 'delete_events')  {
$query_before = 'and start_date < "'. $HTTP_POST_VARS['before'] .'"';
$bgcolor = 'style =" background: #FFB3B5 ;"';
?>

<table border="0" width="600" cellspacing="0" cellpadding="2">
  <?php echo tep_draw_form('events', FILENAME_EVENTS_MANAGER, '&b_date='. $before .'&action=delete_events_confirm'); ?>
    <tr>
      <td class="main" height="60"><?php echo TEXT_EVENTS_DELETE_CONFIRM ?>&nbsp;&nbsp;<?php echo tep_image_submit('button_delete.gif', IMAGE_DELETE, 'align="absmiddle"'); ?>
        <?php echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER) . '">' . tep_image_button('button_back.gif', IMAGE_BACK, 'align="absmiddle"') . '</a>' ?>
    </tr>
  </table>

<?php
}
?>

<script language="javascript">
var scImgPath = '../includes/javascript/spiffyCal/images/';
var before_date = new ctlSpiffyCalendarBox("before_date", "delete_events", "before", "btnDate3","yyyy-MM-dd",scBTNMODE_CUSTOMBLUE);
</script>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_START; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_END; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_LINKS; ?></td>
<?php if (!isset($query_before)){
?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ACTION; ?></td>
<?php
}
?>
              </tr>
<?php
$events_query = tep_db_query("select *, LENGTH(description) as content_length from ". TABLE_EVENTS_CALENDAR ." where language_id = '" . $languages_id . "' $query_before order by start_date");
   if(tep_db_num_rows($events_query)>0){
      while ($events = tep_db_fetch_array($events_query)){
          list ($year, $month, $day) = split ('[/.-]', $events['start_date']);
          $date_start = date("F j, Y", mktime(0,0,0,$month,$day,$year));
          if($events['end_date']){
          list ($year_end, $month_end, $day_end) = split ('[/.-]', $events['end_date']);
          $date_end = date("F j, Y", mktime(0,0,0,$month_end,$day_end,$year_end));
          }
          $events_array = array('id' => $events['event_id'],
                               'size' => $events['content_length'],
                               'title' => $events['title'],
                               'date_added' => $events['date_added'],
                               'OSC_link' => $events['OSC_link'],
                               'link' => $events['link'],
                               'first_day' => $date_start,
                               'last_day' => $date_end);
                               
        echo '<tr class="dataTableRow" '. $bgcolor .' onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_EVENTS_MANAGER, '&eID=' . $events_array['id'] . '&action=edit') . '\'">' . "\n";
?>
                <td height="20" class="dataTableContent" align="center"><?php echo $events_array['id']; ?></td>
                <td class="dataTableContent" align="left"><?php echo number_format($events_array['size']) . ' bytes'; ?></td>
                <td class="dataTableContent" align="left" nowrap><?php echo $events_array['title']; ?></td>
                <td class="dataTableContent" align="left"><?php echo tep_date_short($events_array['date_added']); ?></td>
                <td class="dataTableContent" align="lef"><?php echo $events_array['first_day']; ?></td>
                <td class="dataTableContent" align="left"><?php echo(($events['end_date']) ? $events_array['last_day'] : '-'); ?></td>
                <td class="dataTableContent" align="left"><?php echo '<a href="http://' . $events_array['link'] . '">' . $events_array['link'] . '</a><br>' . $events_array['OSC_link'] . '</a>'; ?></td>
<?php if (!isset($query_before)){
?>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER, '&eID=' . $events_array['id'] . '&action=delete_event') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE, 'width="53" height="19" align="absmiddle"') . '</a>' ?>
                <?php echo '<a href="' . tep_href_link(FILENAME_EVENTS_MANAGER, '&eID=' . $events_array['id'] . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT, 'width="53" height="19" align="absmiddle"') . '</a>' ?></td>
<?php
}
?>
              </tr>
              <tr>
                <td colspan="8"></td>
              </tr>
<?php
  }
if (!isset($query_before)){
?>
              <tr>
                 <td class="main" colspan="8" height="60">
                <?php echo tep_draw_form('delete_events', FILENAME_EVENTS_MANAGER, 'action=delete_events', 'post', 'onSubmit="return check_delete_events()"') . TEXT_DELETE_EVENTS; ?>&nbsp;&nbsp;&nbsp;<script language="javascript">before_date.writeControl(); before_date.dateFormat="yyyy-MM-dd";</script>&nbsp;&nbsp;&nbsp;<?php echo tep_image_submit('button_delete.gif', IMAGE_DELETE, 'align="absmiddle"'); ?></form>
                </td>
              </tr>
<?php
 }
}else{
?>
             <tr>
              <td colspan="8" class="dataTableContent"><br><?php echo TEXT_NO_EVENTS; ?></td>
             </tr>
<?php
  }
}
?>
        </table>
<?php echo tep_draw_separator(); ?>
      </td>
     </tr>
    </table>
   </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
