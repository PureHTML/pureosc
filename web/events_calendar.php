<?php

  require('includes/application_top.php');

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_EVENTS_CALENDAR);

  include(DIR_WS_MODULES . '/dynamic_sitemap.php');





define('SECTION', NAVBAR_TITLE);  
  
$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_EVENTS_CALENDAR, '', 'NONSSL'));

//add breadcrumb for requested 
if(isset($single_event) || $HTTP_GET_VARS['select_event'])
{
    $navbarEventTitle = NAVBAR_EVENT_TITLE_DETAIL;
}
else if($HTTP_GET_VARS['year_view'] == 1)
{
    $navbarEventTitle = NAVBAR_EVENT_TITLE_YEAR;
}
else if($HTTP_GET_VARS['_day'])
{
    $navbarEventTitle = NAVBAR_EVENT_TITLE_DAY;
}
else if($HTTP_GET_VARS['view'] == 'all_events')
{
    $navbarEventTitle = NAVBAR_EVENT_TITLE_ALL;
}
else
{
    $navbarEventTitle = NAVBAR_EVENT_TITLE_MONTH;
}
$breadcrumb->add($navbarEventTitle, $HTTP_SERVER_VARS["REQUEST_URI"], '', 'NONSSL');

$i =1;
$cal = new Calendar;
$cal->setStartDay(FIRST_DAY_OF_WEEK);
$this_month = date('m');
$this_year = date('Y');

if ($HTTP_GET_VARS['_month']) 
{
    $month = $_month;
    $year = $_year;
    $a = $cal->adjustDate($month, $year);
    $month_ = $a[0];
    $year_= $a[1];
}
else
{
    $year = $this_year;
    $month = $this_month;
    $yeventear_= $year;
    $month_= $month;
    $year_= $year;
}
if($HTTP_GET_VARS['_day'])
{
    $ev_query = tep_db_query("select event_id from " . TABLE_EVENTS_CALENDAR 
        . " where DAYOFMONTH(start_date)= '" . $_day . "' and MONTH(start_date) = '" . $_month 
        . "' and YEAR(start_date) = '" . $_year . "' AND language_id = '" . $languages_id . "'");
    if(tep_db_num_rows($ev_query) == 1)
    {
        $ev = tep_db_fetch_array($ev_query);
        $single_event = true;
        $select_event = $ev['event_id'];
    }
}


  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>