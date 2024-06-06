<?php
require('includes/application_top.php');
require(DIR_WS_LANGUAGES . $language . '/pollbooth.php');
$pollid=$HTTP_POST_VARS['pollid'];
$voteid=$HTTP_POST_VARS['voteid'];
$forwarder=$HTTP_POST_VARS['forwarder'];
$ip = getenv("REMOTE_ADDR");
$past = time()-90800;
$votevalid=1;
// tep_db_query("DELETE FROM phesis_poll_check WHERE time < ".$past."");
if ($voteid) {
        $result=tep_db_query("select poll_type, poll_open from phesis_poll_desc where pollid='".$pollid."'");
        $poll=tep_db_fetch_array($result);
        if ($poll['poll_open']=='1') {
                $votevalid=0;
                $info_message1 = _POLLCLOSED;
                }
        if ($poll['poll_type']=='1' && !isset($customer_id)) {
                $votevalid=0;
                $info_message1 = _POLLPRIVATE;
                }
        /*  If you want to check by IP uncomment this block  */
 if ($votevalid==1 && POLL_SPAM==0) {
               $result=tep_db_query("SELECT ip FROM phesis_poll_check WHERE ip='".$ip."' and pollid='".$pollid."'");
               $result1=tep_db_fetch_array($result);
               $ips=$result1['ip'];
               $ctime = time();
               if ($ip == $ips) {
                       $votevalid = 0;
//                     $info_message1 = _ALREADY_VOTED;
                     $info_message1 = 'Již jste hlasoval';
                           } else {
                     tep_db_query("INSERT INTO phesis_poll_check (ip, time, pollID) VALUES ('".$ip."', '".$ctime."' , '".$pollid."')");
                       $votevalid = 1;
     
/*This block checks by customer id (1 vote per customer id)
       if ($votevalid==1 && POLL_SPAM==0) {
               $result=tep_db_query("SELECT customer_id FROM phesis_poll_check WHERE customer_id='".$customer_id."' and pollid='".$pollid."'");
               $result1=tep_db_fetch_array($result);
               $customers=$result1['customer_id'];
               $ctime = time();
               if ($customer_id == $customers) {
                       $votevalid = 0;
                     $info_message1 = "YOU ALREADY VOTED ";
                           } else {
                     tep_db_query("INSERT INTO phesis_poll_check (ip, time, pollID, customer_id) VALUES ('".$ip."', '".$ctime."' , '".$pollid."', '".$customer_id."')");
                       $votevalid = 1;   */      
        }
    }
}
if (!$voteid){
         $votevalid=0;
         $info_message1 = _NO_VOTE_SELECTED;
         }
 if($votevalid>0) {
       $result1=tep_db_query("UPDATE phesis_poll_data SET optionCount=optionCount+1 WHERE (pollid='".$pollid."') AND (voteid='".$voteid."') and (language_id='".$languages_id."')");
       $result2=tep_db_query("UPDATE phesis_poll_desc SET voters=voters+1 WHERE pollid='".$pollid."'");
      header("Location: pollbooth.php?op=results&pollid=".$pollid."");
    } else {
       // $info_message = $info_message1 . "YOU ARE NOT ALLOWED TO VOTE";
      header("Location: pollbooth.php?op=results&pollid=$pollid&info_message=$info_message1");
       exit;
    }
?>
