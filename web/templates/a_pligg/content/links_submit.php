<?php
/*
  $Id: links_submit.php v3.3 2008-11-14 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
  $email_owner = true; //Set to false to prevent notification emails on submit.

    require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/links.php');
  $action = $HTTP_GET_VARS['action'];
        $sess_id = (tep_not_null(SID));
        if ($action == 'add_link'){
        $error=false;
        // clean posted vars
        reset($_POST);
      while (list($key, $value) = each($_POST)) {
                          if (!is_array($_POST[$key])) {
          $_POST[$key] = preg_replace("/[^ \/\na-zA-Z0-9@:{}_.-]/i", "", urldecode($_POST[$key]));
        } else { unset($_POST[$key]); } // no arrays expected
      }
        $name = str_replace(array('http://','www.'),'',$_POST['name']);
        $site_title  = str_replace(array('http://'),'',$_POST['title']);
  $_POST['description'] = str_replace(array('http://','www.'),'',$_POST['description']);

  $mailerror = (strlen(trim($_POST['email']))<1);
        if (strlen(trim($_POST['email']))>0 && tep_validate_email($_POST['email']) == false) $mailerror = true;
        $urlerror = (strlen(trim($_POST['url'],'http:// '))<1);
        $rurlerror = (strlen(trim($_POST['recurl'],'http:// '))<1);
        $titleerror = (strlen(trim($site_title))<1);
        $descerror = (strlen(trim($_POST['description']))<1 || strlen($_POST['description'])>280 );
        $nameerror = (strlen(trim($name))<1);
        $description = wordwrap(substr($_POST['description'],0,280),50,'-',true);
        $error = $nameerror || $descerror || $titleerror || $rurlerror || $mailerror || $urlerror;
                  if (!$error) {
                        $name = tep_db_prepare_input($name);
                        $email = tep_db_prepare_input($_POST['email']);
                        $site_title  = tep_db_prepare_input($site_title );
                        $lurl = tep_db_prepare_input($_POST['url']);
                        $sql_data_array = array('link_title' => $site_title ,
                                                                                                                                        'link_url' => $lurl,
                                                                                                                                        'link_description' => tep_db_prepare_input($description),
                                                                                                                                        'link_date' => date("Y-m-d H:i:s"),
                                                                                                                                        'name' => $name,
                                                                                                                                        'email' => $email,
                                                                                                                                        'category' => (int)tep_db_prepare_input($_POST['category']),
                                                                                                                                        'new_category' => tep_db_prepare_input($_POST['new_category']),
                                                                                                                                        'reciprocal' => tep_db_prepare_input($_POST['recurl']));
                                                                                                                                        tep_db_perform('links', $sql_data_array);
                                                if ( $email_owner ) tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, LINK_ADD_SUBJECT, sprintf(LINK_ADD_MESSAGE,$name,$site_title ,$lurl), $name, $email);
                                          tep_redirect(tep_href_link('links_submit.php',tep_get_all_get_params(array('action')) . 'action=submited'));
                        }
  }
  $category_array = array();
        $category_array[0] = array('id' => '0', 'text' => MSCHOSE);
        $category_query = tep_db_query("select category_id, category_name from links_categories where status = 1 order by sort_order, category_name");
  while ($category_values = tep_db_fetch_array($category_query)) {
    $category_array[] = array('id' => $category_values['category_id'], 'text' => $category_values['category_name']);
  }
        $breadcrumb->add('links', tep_href_link('links.php'));
  $breadcrumb->add('links submit', tep_href_link('links_submit.php'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<meta name="Copyright" content="" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="Rating" content="General" />
    <meta name="Robots" content="All" />
</head>
<body style="margin:0;">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>

    <td width="100%" align="center" valign="top">
<!-- body_text //-->



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
    <td align="center" ><br /><p class="title" ><b><?php echo SUBMIT;?></b></p>
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
        <?php echo tep_draw_textarea_field('codes','Physical',30,5,'<a href="'.Website_URL.'">'.Website_Title.'</a>-'.Description);?>
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
            <?php echo tep_draw_textarea_field('description','Physical',40,4,$description,'',false);?>
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

<!-- body_text_eof //-->

        </td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
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