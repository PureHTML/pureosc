<?php
  /*
  Module: Information Pages Unlimited
          File date: 2007/02/17
          Based on the FAQ script of adgrafics
          Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
  */

if(!isset($_POST)) {
extract($HTTP_POST_VARS);
extract($HTTP_GET_VARS);
} else {
extract($_POST);
extract($_GET);
}

require('includes/application_top.php');

	include(DIR_WS_LANGUAGES . $language . '/' . "information.php");


$languages = tep_get_languages();

// Group information
$gID = (isset($_GET['gID'])) ? $HTTP_GET_VARS['gID'] : ((isset($_POST['gID'])) ? $HTTP_POST_VARS['gID'] : 1);
$info_group_query = tep_db_query("select information_group_title, locked from " . TABLE_INFORMATION_GROUP . " where information_group_id = '" . (int)$gID . "'");
$info_group = tep_db_fetch_array($info_group_query);
//$info_group['locked'] = ''; // DEBUG, to ignore locked fields


// Create additional information records for unknown languages
// NOTE: This is a function with some overhead, but is needed as this is an add-on
//       and the new languages are not automatically generated by languages.php
function tep_update_information_languages($language_id = 0) {
	global $languages, $languages_id, $gID;
	if ($language_id == 0) $language_id = $languages_id;

	// Count all items
	$information_query = tep_db_query("select count(*) as information_count from " . TABLE_INFORMATION. " where information_group_id = '" . (int)$gID . "'");
	$information = tep_db_fetch_array($information_query);
	$information_count_all = $information['information_count'];

	// Count items for main language
	$information_query = tep_db_query("select count(*) as information_count from " . TABLE_INFORMATION . " where information_group_id = '" . (int)$gID . "' and language_id = '" . (int)$language_id . "'");
	$information = tep_db_fetch_array($information_query);
	$information_count_single = $information['information_count'];

	if($information_count_all !=  $information_count_single * sizeof($languages))
	{
		// Create array of language id's in information table
		$information_query = tep_db_query("select language_id from " . TABLE_INFORMATION . " where information_group_id = '" . (int)$gID . "' group by language_id");
		while ($information_language = tep_db_fetch_array($information_query)) {
			$information_languages[] = $information_language['language_id'];
		}

		// Create array of language id's in languages
		foreach( $languages as $language) {
			$languages_ids[] = $language['id'];
		}

		// Remove entries with languages no longer being used
		foreach( $information_languages as $_language_id) {
			if(!in_array($_language_id, $languages_ids)) {
				tep_db_query("delete from " . TABLE_INFORMATION . " where information_group_id = '" . (int)$gID . "' and language_id = '" . (int)$_language_id . "'");
			}
		}

		$information_query = tep_db_query("select * from " . TABLE_INFORMATION . " where information_group_id = '" . (int)$gID . "' and language_id = '" . (int)$language_id . "'");
		while ($information = tep_db_fetch_array($information_query)) {
			foreach( $languages_ids as $_language_id) {
				if(!in_array($_language_id, $information_languages)) {
					$sql_data_array = array(
						'language_id' 				=> $_language_id,
						'visible' 					=> tep_db_prepare_input($information['visible']),
						'sort_order' 				=> tep_db_prepare_input($information['sort_order']),
						'information_id'			=> tep_db_prepare_input($information['information_id']),
						'information_group_id' 		=> tep_db_prepare_input($information['information_group_id']),
						'information_title' 		=> tep_db_prepare_input($information['information_title']),
						'information_description' 	=> tep_db_prepare_input($information['information_description'])
					);
					tep_db_perform(TABLE_INFORMATION, $sql_data_array);
				}
			}
		}
	}
}

function tep_get_information_list ($language_id = 0) {
	global $languages_id, $gID;
	if ($language_id == 0) $language_id = $languages_id;

    $information_query = tep_db_query("select * from " . TABLE_INFORMATION . " where language_id = '" . (int)$language_id . "' and information_group_id = '" . (int)$gID . "' order by sort_order");

	$c=0;
	while ($buffer = tep_db_fetch_array($information_query)) {
		$result[$c] = $buffer;
		$c++;
	}
	return $result;
}

function tep_get_information_entry ($information_id, $language_id = 0, $column = '') {
	global $languages_id;
	if ($language_id == 0) $language_id = $languages_id;

	$information_query = tep_db_query("select * from " . TABLE_INFORMATION . " where information_id = '" . (int)$information_id . "' and language_id = '" . (int)$language_id . "'");
	$information = tep_db_fetch_array($information_query);

	if(!empty($column)) return $information[$column]; 
	else return $information;
}

$warning = tep_image(DIR_WS_ICONS . 'warning.png', WARNING_INFORMATION); 

function error_message($error) {
	global $warning;
	switch ($error) {
		case "20":return "<tr class=messageStackError><td>$warning ." . ERROR_20_INFORMATION . "</td></tr>";break;
		case "80":return "<tr class=messageStackError><td>$warning " . ERROR_80_INFORMATION . "</td></tr>";break;
		default:return $error;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />

<?php if (WEB_EDITOR_LIST == 'htmlarea'){ ?>
	<script>
  		_editor_url = "includes/javascript/htmlarea/";
  		_editor_lang = "en";
	</script>
	<script type="text/javascript" src="includes/javascript/htmlarea/htmlarea.js"></script>
<?php } elseif (WEB_EDITOR_LIST == 'tiny_mce') { ?>
<script type="text/javascript" src="includes/javascript/tiny_mce/tiny_mce.js"></script>
<script>
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "style,layer,table,save,advhr,advimage,advlink,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	template_external_list_url : "example_template_list.js"
});
</script>
<?php } ?>

</head>
<?php if (WEB_EDITOR_LIST == 'htmlarea'){ ?>
<body style="margin:0;" onload="HTMLArea.replace('description0');HTMLArea.replace('description1');HTMLArea.replace('description2');HTMLArea.replace('description3');HTMLArea.replace('description4');HTMLArea.replace('description5');">
<?php } else { ?>
<body style="margin:0;">
<?php } ?>
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
    <td width="100%" valign="top">
<table border=0 width="100%">
<tr><td align=right><?php //echo $languages_id; ?></td></tr>
<?php
switch($_REQUEST['information_action']) {

case "Added":
	$data = tep_get_information_list();
	$no = 1;
	if (sizeof($data) > 0) {
		while (list($key, $val)=each($data)) {$no++; }	
	}
	$title = ADD_QUEUE_INFORMATION . " #$no";
	echo tep_draw_form('',FILENAME_INFORMATION_MANAGER, 'information_action=AddSure');
	echo tep_draw_hidden_field('gID', $gID);
	include('information_form.php');
	break;

case "AddSure":
	$language_id = $languages[0]['id']; // First insert the 1st known language
	$sql_data_array = array(
		'language_id' => $language_id,
		'information_group_id' => tep_db_prepare_input($gID)
	);
	if(isset($_POST['visible']))					$sql_data_array['visible'] = tep_db_prepare_input($_POST['visible']);
	if(isset($_POST['sort_order']))					$sql_data_array['sort_order'] = tep_db_prepare_input($_POST['sort_order']);
	if(isset($_POST['parent_id']))					$sql_data_array['parent_id'] = tep_db_prepare_input($_POST['parent_id']);
	if(isset($_POST['information_title']))			$sql_data_array['information_title'] = tep_db_prepare_input($_POST['information_title'][$language_id]);
	if(isset($_POST['information_description']))	$sql_data_array['information_description'] = tep_db_prepare_input($_POST['information_description'][$language_id]);

	tep_db_perform(TABLE_INFORMATION, $sql_data_array);

	$information_id = tep_db_insert_id();

	for ($i=1, $n=sizeof($languages); $i<$n; $i++) {
		$language_id = $languages[$i]['id'];

		$sql_data_array = array(
			'information_id' => $information_id,
			'language_id' => $languages[$i]['id'],
			'information_group_id' => tep_db_prepare_input($gID)
		);
		if(isset($_POST['visible']))					$sql_data_array['visible'] = tep_db_prepare_input($_POST['visible']);
		if(isset($_POST['sort_order']))					$sql_data_array['sort_order'] = tep_db_prepare_input($_POST['sort_order']);
		if(isset($_POST['parent_id']))					$sql_data_array['parent_id'] = tep_db_prepare_input($_POST['parent_id']);
		if(isset($_POST['information_title']))			$sql_data_array['information_title'] = tep_db_prepare_input($_POST['information_title'][$language_id]);
		if(isset($_POST['information_description']))	$sql_data_array['information_description'] = tep_db_prepare_input($_POST['information_description'][$language_id]);

		if(count($sql_data_array) > 1) {
			tep_db_perform(TABLE_INFORMATION, $sql_data_array);
		}
	}
	$data = tep_get_information_list();
	$title = tep_image(DIR_WS_ICONS . 'confirm_red.png', CONFIRM_INFORMATION) .SUCCED_INFORMATION . ADD_QUEUE_INFORMATION . " $sort_order ";
	include('information_list.php');
	unset($data);
	break;

case "Edit":
	if ($information_id = $_REQUEST['information_id']) {
		$edit = tep_get_information_entry($information_id);
		$data = tep_get_information_list();
		$button = array("Update");
		$title = EDIT_ID_INFORMATION . " $information_id";
		echo tep_draw_form('',FILENAME_INFORMATION_MANAGER, 'information_action=Update');
		echo tep_draw_hidden_field('information_id', $information_id);
		echo tep_draw_hidden_field('gID', $gID);
		include('information_form.php');
	}
	else {$error="80";}
	break;

case "Update":
	if ((int)$_POST['information_id']) 
	{
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			$language_id = $languages[$i]['id'];

			$sql_data_array = array();
			if(isset($_POST['visible']))					$sql_data_array['visible'] = tep_db_prepare_input($_POST['visible']);
			if(isset($_POST['sort_order']))					$sql_data_array['sort_order'] = tep_db_prepare_input($_POST['sort_order']);
			if(isset($_POST['parent_id']))					$sql_data_array['parent_id'] = tep_db_prepare_input($_POST['parent_id']);
			if(isset($_POST['information_title']))			$sql_data_array['information_title'] = tep_db_prepare_input($_POST['information_title'][$language_id]);
			if(isset($_POST['information_description']))	$sql_data_array['information_description'] = tep_db_prepare_input($_POST['information_description'][$language_id]);

			if(count($sql_data_array) > 0) {
				$sql_data_array['information_group_id'] = tep_db_prepare_input($gID);
				tep_db_perform(TABLE_INFORMATION, $sql_data_array, 'update', "information_id = '" . (int)$_POST['information_id'] . "' and language_id = '" . (int)$language_id . "'");
			}
		}
		$data = tep_get_information_list();
		$title = "$confirm " . UPDATE_ID_INFORMATION . " $information_id " . SUCCED_INFORMATION . "";
		include('information_list.php');
	} else {$error="80";}
	break;

case "Visible":
	if (($visible == 1) || ($visible == '1')) {
		$vivod=DEACTIVATION_ID_INFORMATION;
		tep_db_query("update " . TABLE_INFORMATION . " set visible = '0' where information_id = '" . (int)$information_id . "'");
	} else {
		$vivod=ACTIVATION_ID_INFORMATION;
		tep_db_query("update " . TABLE_INFORMATION . " set visible = '1' where information_id = '" . (int)$information_id . "'");
	}
	$data=tep_get_information_list();
	$title="$confirm $vivod $information_id " . SUCCED_INFORMATION . "";
	include('information_list.php');
	break;

case "Delete":
	if ($information_id = $_GET['information_id']) {
		$delete = tep_get_information_entry($information_id);
		$data = tep_get_information_list();
		$title = DELETE_CONFIRMATION_ID_INFORMATION . " $information_id";
		echo '<tr class=pageHeading><td>' . $title . '</td></tr>';
		echo '<tr class=dataTableHeadingRow><td align=left class=dataTableHeadingContent>' . ENTRY_TITLE . '</td></tr>';
		echo '<tr><td class="dataTableContent" bgcolor="#DEE4E8" style="line-height: 18px;">' . $delete['information_title'] . '</td></tr>';
		echo '<tr><td></td></tr><tr><td align=right>';
		echo tep_draw_form('',FILENAME_INFORMATION_MANAGER, "information_action=DelSure&amp;information_id=" . $delete['information_id']);
		echo tep_draw_hidden_field('information_id', $information_id);
		echo tep_draw_hidden_field('gID', $gID);
		echo tep_image_submit('button_delete.png', IMAGE_DELETE);
		echo '&nbsp;<a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, "gID=$gID", 'NONSSL') . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>';
		echo "</form></td></tr>";
	} 
	else {$error="80";}
	break;


case "DelSure":
	if ($information_id = $_GET['information_id']) {
		tep_db_query("delete from " . TABLE_INFORMATION . " where information_id = '" . (int)$information_id . "'");
		$data = tep_get_information_list();
		$title = "$confirm " . DELETED_ID_INFORMATION . " $information_id " . SUCCED_INFORMATION . "";
		include('information_list.php');
	} 
	else {$error="80";}
	break;

default:
	$data = tep_get_information_list();
	$title = MANAGER_INFORMATION . " <font size='-1'>/ " . $info_group['information_group_title'] . "</font>";
	include('information_list.php');
	flush();
	tep_update_information_languages();
} // END SWITCH


if ($error) {
	$content=error_message($error);
	echo $content;
	$data = tep_get_information_list();
	$no = 1;
	if (sizeof($data) > 0) {
		while (list($key, $val)=each($data)) {$no++; }	
	}
	$title = ADD_QUEUE_INFORMATION . " $no";
	echo tep_draw_form('',FILENAME_INFORMATION_MANAGER, 'information_action=AddSure');
	echo tep_draw_hidden_field('gID', $gID);
	include('information_form.php');
}
?>
</table>
</td>


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