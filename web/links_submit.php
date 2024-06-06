<?php

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
//          $_POST[$key] = preg_replace("/[^ \/\na-zA-Z0-9@:{}_.-]/i", "", urldecode($_POST[$key]));
$_POST[$key] = urldecode($_POST[$key]);
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
                        $lurl = tep_db_prepare_input($_POST['url']);//jsp:todo:security
                        $lurl = preg_replace('/http;/','http:',$lurl);
                        $reciprocal = tep_db_input($_POST['recurl']);
                        $reciprocal = preg_replace('/http;/','http:',$reciprocal);
                        $sql_data_array = array('link_title' => $site_title ,
                                                                                                                                        'link_url' => $lurl,
                                                                                                                                        'link_description' => tep_db_input($description),
                                                                                                                                        'link_date' => date("Y-m-d H:i:s"),
                                                                                                                                        'name' => tep_db_prepare_input($name),
                                                                                                                                        'email' => tep_db_prepare_input($email),
                                                                                                                                        'category' => (int)tep_db_input($_POST['category']),
                                                                                                                                        'new_category' => tep_db_prepare_input($_POST['new_category']),
                                                                                                                                        'reciprocal' => tep_db_input($_POST['recurl']));//jsp:todo:security 
                                                                                                                                        tep_db_perform('links', $sql_data_array);
                                                if ( $email_owner ) tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, LINK_ADD_SUBJECT, sprintf(LINK_ADD_MESSAGE,$name,$site_title ,$lurl), $name, $email);
//jsp:orig                                          tep_redirect(tep_href_link('links_submit.php',tep_get_all_get_params(array('action')) . 'action=submited'));
                                          tep_redirect(META_HTTP_SERVER . '/links_submit.php?action=submited');//jsp:fixme !
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

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link($content));

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>