<!-- body_text //-->
<table>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
         <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
           <tr>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_specials.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
        </table>
       <table width="100%">
<?php 
if (!isset($HTTP_GET_VARS['op'])) {
        $HTTP_GET_VARS['op']="list";
        }
switch ($HTTP_GET_VARS['op']) {
     case "results":
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_results.php");
        echo("</tr></table>\n");
        break;

     case 'comment':
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_comment.php");
        echo("</tr></table>\n");
        break;

     case 'list':
     echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_list.php");
        echo("</tr></table>\n");
        break;

     case "vote":
        echo("<table align='center' valign='top'><tr><td>\n");
        include("poll_vote.php");
        echo("</tr></table>\n");
        break;
}
if (!$nolink) {
?>
<br><center><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>' . "</center>"; ?>
<?php
}
?>
</table>
<!-- body_text_eof //-->