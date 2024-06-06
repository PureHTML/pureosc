                <table summary="2" border="0" width="98%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
<td width="100%" align="center" valign="top">

 <?php if ($action == 'submited'){ ?>
                                 <table summary="3" width="60%" height="300" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td align="center" class="title"><br /><p ><b><?php echo SUBMIT;?></b></p></td></tr>
 <tr><td><br /><br /><? echo MSINFO; ?></td></tr>
 <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '40'); ?></td>
  </tr>
 <tr><td align="center"><?php echo  tep_draw_form(add_link,tep_href_link('links.php',tep_get_all_get_params(array('action'))));
 echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?>
</form></td></tr>
                         </table>
 <?php } else {
  if ($action == 'add_link') $status = 'class="messageStackSuccess"'?>

                        <table summary="3" width="98%" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td><h1><?php echo SUBMIT;?></h1>
      <p align="center"><b><?php echo STEP1;?></b></p>
                                        <table summary="border" style="border:3px double #666666;"  >
<tr><td align="left">
                                      <table summary="5" width="100%" border="0" class="infoBoxContents" >

          <tr>
            <td width="20%"><?php echo TURL ?></td>
            <td width="80%"><font size="2"><a class="headerInfo" href="<?php echo Website_URL; ?>" target="_blank"><?php echo Website_URL; ?></a></font></td>
          </tr>
          <tr>
            <td><?php echo TTITLE;  ?></td>
            <td><?php echo Website_Title; ?></td>
          </tr>
          <tr >
            <td style="vertical-align:top;"><?php echo TDESCRIPTION; ?></td>
            <td ><?php echo Description;?></td>
          </tr>

                                      </table>
                                                        </td></tr><tr>
            <td align="center">
                                                        <table summary="" width="90%">
<tr><td>
                                                        <p >
        <?php echo tep_draw_textarea_field('codes','30','5','<a href="'.Website_URL.'">'.Website_Title.'</a> - '.Description);?>
      </p></td></tr>
                                                        </table>

                                                        </td></tr>
                                        </table> <!-- border -->

      <p align="center"><b><?php echo STEP2;?></b></p>
      <p class="main" align="center"><?php echo STEP2DS?></p>

     </td></tr><tr><td align="center">
                 <?php echo  tep_draw_form('add_link',tep_href_link('links_submit.php',tep_get_all_get_params() . 'action=add_link' . ($sess_id ? '' : '#submit')), 'post');?>
                                 <table summary="4" border="0" >
<tr><td>
                                <table summary="border" class="infoBoxContents" style="border:3px double #666666;" cellspacing="4" cellpadding="3">

                                        <?php
  if ($error) {
?>
                        <tr>
        <td id="mess" colspan="3" class="messageStackError" align="center"><?php echo 'Error: Not All Fields Completed Correctly'; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
<?php
  }
?>
            <tr>
              <td align="left"><b><?php echo NAME  ?></b></td>
              <td <?php echo ($nameerror ? 'class="messageStackError"' : $status) ?>><?php echo tep_draw_input_field('name', $name, 'maxlength="70" size="60"', 'text', false) ?>
                          </td>
            </tr>
            <tr>
              <td align="left"><b><?php echo EMAIL?></b></td>
              <td <?php echo ($mailerror ? 'class="messageStackError"' : $status) ?>><?php echo tep_draw_input_field('email', $_POST['email'], 'maxlength="80" size="60" ' ); ?></td>
            </tr>
            <tr>
              <td align="left"><b><?php echo WTITLE?></b></td>
              <td <?php echo ($titleerror ? 'class="messageStackError"' : $status) ?>><?php echo tep_draw_input_field('title', $site_title , 'maxlength="70" size="60"', 'text', false) ?></td>
            </tr>
            <tr>
              <td align="left"><b><?php echo WURL?></b></td>
              <td <?php echo ($urlerror ? 'class="messageStackError"' : $status) ?>><?php echo tep_draw_input_field('url', ($_POST['url'] ? $_POST['url'] : 'http://'), 'maxlength="80" size="60"') ?></td>
            </tr>
            <tr>
              <td align="left"><b><?php echo RURL;?></b></td>
              <td <?php echo ($rurlerror ? 'class="messageStackError"' : $status) ?>><?php echo tep_draw_input_field('recurl', ($_POST['recurl'] ? $_POST['recurl'] : 'http://'), 'maxlength="80" size="60"') ?></td>
            </tr>
                                                <tr>
              <td align="left" valign="top"><b><?php echo MSCAT;?></b></td>
                                                        <td >
                                                                        <table summary="6" width="100%" cellspacing="0" cellpadding="0"><tr><td align="left" class="smallText"><?php echo tep_draw_pull_down_menu('category', $category_array, $_POST['category']). '</td><td align="right" class="smallText">'.MSSUG . tep_draw_input_field('new_category', $_POST['new_category'], 'maxlength="32" size="18" ' );; ?></td></tr>
                                                                        </table></td>
            </tr>
                                                <tr>
              <td align="left" valign="top"><b><br /><br /><?php echo TDESCRIPTION;?></b></td>
                                                        <td align="left">
                                                                        <table summary="5" width="100%" cellspacing="0" cellpadding="0"><tr><td align="center" class="smallText"><br />
        <p   <?php echo ($descerror ? 'class="messageStackError"' : $status) ?>><b><?php echo WDES;?></b><br />
            <?php echo tep_draw_textarea_field('description','Physical',40,$description,'',false);?>
        </p></td></tr>
                                                     </table>
                                                </td>
      </tr>
                        <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
                  </table> <!-- border -->
                                </td></tr>
                                <tr><td align="center"><br />
        <p>
          <?php //echo tep_image_submit('button_submit_link.gif', 'Submit Website Link') ?>
                                        <INPUT type=submit id="submit" value="<?php echo ADD;?>">
        </p>
      </td>
      </tr>
             <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
                  </table>
           </form>

      <table summary="4">
<tr><td><a href="<?php echo  tep_href_link('links.php',tep_get_all_get_params(array('action')));?>"><?php echo  tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . 'button_back.gif', IMAGE_BUTTON_BACK) ?></a></td></tr>
                        </table>
        </td>
  </tr>
</table>

<?php } // action end ?>


</td>
  </tr>
</table>
