<?PHP
if (isset($HTTP_GET_VARS['pollid'])) {
$pollid=$HTTP_GET_VARS['pollid'];
} else {
$pollid=1;
 }
$poll_query = tep_db_query("SELECT pollid, timeStamp FROM phesis_poll_desc WHERE pollid='".$pollid."'");
$polls = tep_db_fetch_array($poll_query);
$title_query = tep_db_query("select optionText from phesis_poll_data where pollid='".$pollid."' and voteid='0' and language_id = '" . $languages_id . "'");
$title = tep_db_fetch_array($title_query);
?>
<?php echo tep_draw_form('poll_comment', tep_href_link('pollbooth.php', 'action=do_comment&pollid=' . $pollid), 'post'); ?>

<tr><td colspan="2" align="center" class="main"><font size="+1"><b><? echo $title['optionText'] ?></b></font></td><BR><BR>

<?php
if (!$customer_id) {
?>

<tr><td class="main"><?php echo _YOURNAME; ?><BR><?php echo tep_draw_input_field('comment_name',''); ?></td></tr>
<?php
 }
?>
<tr><td class="main"><?php echo _YOURCOMMENT; ?><BR><?php echo tep_draw_textarea_field('comment', 'soft', '30', '4', ''); ?></td></tr>
<tr><td><?php echo tep_image_submit('button_continue.gif','TEXT_CONTINUE'); ?></td></tr>


<?php
$nolink = true;
?>
