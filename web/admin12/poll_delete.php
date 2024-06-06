<?php
                if (isset($HTTP_GET_VARS['pollid'])) {
                        $pollid=$HTTP_GET_VARS['pollid'];
                } else {
                $pollid=1;
                }
                  if (isset($HTTP_GET_VARS['comment'])) {
                        $commentid=$HTTP_GET_VARS['comment'];
                } else {
                $comment=1;
                }
                  require('includes/application_top.php');
                tep_db_query("delete FROM phesis_comments where pollid = '" . $pollid . "' and commentid = '" . $comment . "'");
           //     include('poll_list.php?pollid='.$pollid.'');
           // header("Location: http://www.example.com/");
                tep_redirect(tep_href_link('polls.php', 'op=list'));
            //    tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=edit&cID=' . $poInfo->pollID, 'NONSSL') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a>
?>
