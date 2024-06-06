<table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td nowrap><H1><?php echo HEADING_TITLE ?></H1></td>
                </tr>
                <tr>
                    <td  class="main" nowrap>
                    <?php
                        echo tep_draw_form('goto_event', FILENAME_EVENTS_CALENDAR, '', 'get');
                        $ev_query = tep_db_query("select *, DAYOFMONTH(start_date) AS day, MONTH(start_date) AS month, YEAR(start_date) AS year"
                            . " from " . TABLE_EVENTS_CALENDAR 
                            . " where start_date >= '" . date('Y-m-d H:i:s') . "' and language_id = '" . $languages_id . "'"
                            . " order by start_date");
                        if(tep_db_num_rows($ev_query) > 0)
                        {
                            $event_array[]  = array('id' => '', 'text' => TEXT_SELECT_EVENT);
                            while ($q_events = tep_db_fetch_array($ev_query))
                            {
                                $year = $q_events['year'];
                                $month = $q_events['month'];
                                $day = $q_events['day'];
                                $event_array[] = array('id' => $q_events['event_id'], 'text' => $cal->monthNames[$month - 1] . ' ' . $day . ' -> ' . $q_events['title']);
                            }
                            echo tep_draw_pull_down_menu('select_event', $event_array, NULL, 'onChange="(this.value != \'\') ? this.form.submit() : \'\' " ;', $required = false);
                        }
                    ?>
                    </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
<?php
$dateDisplayFormat = "F d, Y";

if(isset($single_event) || $HTTP_GET_VARS['select_event'])
{   //Show Details of a single event.
    $events_query = tep_db_query("select *, DAYOFMONTH(start_date) AS event"
        . " from " . TABLE_EVENTS_CALENDAR 
        . " where event_id = '" . $select_event . "' and language_id = '" . $languages_id . "'");

    while($events = tep_db_fetch_array($events_query))
    {
        list($year, $month, $day) = split ('[/.-]', $events['start_date']);
        $date_start = date($dateDisplayFormat, mktime(0,0,0,$month,$day,$year));
?>
            <H2><?php echo $events['title']?></H2>
<?php
        if($events['end_date'])
        {
            list($year_end, $month_end, $day_end) = split ('[/.-]', $events['end_date']);
            $date_end = date($dateDisplayFormat, mktime(0,0,0,$month_end,$day_end,$year_end));
        }
        $event_array = array('id' => $events['event_id'],
                             'title' => $events['title'],
                             'image' => $events['event_image'],
                             'description' => $events['description'],
                             'first_day' => $date_start,
                             'last_day' => $date_end,
                             'OSC_link' => $events['OSC_link'],
                             'link' => $events['link']);
        $clsp = 2;
?>
            <table width="100%" cellspacing="0" cellpadding="4" class="event_description">
                <tr>
                    <td class="event_header_dates" nowrap>
                        <?php 
                            if($event_array['last_day'])
                            {
                                echo '<b>' . TEXT_EVENT_START_DATE . '</b>';
                            }
                        ?>
                        &nbsp;&nbsp;<?php echo $event_array['first_day'];?>
                    </td>
<?php
        if($event_array['last_day'])
        {
?>
                    <td class="event_header_dates" nowrap>
                        <b><?php echo TEXT_EVENT_END_DATE;?></b>&nbsp;&nbsp;<?php echo $event_array['last_day'];?>
                    </td>
<?php
            $clsp++;
        }
?>
                    <td width="100%" class="event" nowrap>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="<?php echo $clsp;?>" class="event_description">
                        <H4><?php echo TEXT_EVENT_DESCRIPTION;?></H4>
<?php
        if ($event_array['image'])
        {
?>
                        <table border="0" cellspacing="0" cellpadding="0" align="right">
                            <tr>
                                <td class="main" valign="top">
                                    <?php echo tep_image(DIR_WS_IMAGES .'events_images/' . $event_array['image'], $event_array['title'], '', '', 'align="right" hspace="0" vspace="0" style="margin-left:14px"');?>
                                </td>
                            </tr>
                        </table>
<?php
        }
        echo stripslashes($event_array['description']);
?>
                    </td>
<?php
        if($event_array['OSC_link'])
        {
?>
                </tr>
                <tr>
                    <td colspan="<?php echo $clsp;?>"  align="left" class="event_header">
                        <?php echo TEXT_EVENT_OSC_LINK;?>&nbsp;&nbsp;
                        <a href="<?php echo $event_array['OSC_link'];?>">
                            <?php echo $event_array['OSC_link'];?>
                        </a>
                    </td>
<?php
        }
        if($event_array['link'])
        {
?>
                </tr>
                <tr>
                    <td colspan="<?php echo $clsp;?>" align="left" class="event_header">
                        <?php echo TEXT_EVENT_LINK;
                        //jsp:bugfix delete http:// prefix o dva radky dal
                        ?>&nbsp;&nbsp;
                        <a href="<?php echo $event_array['link'];?>" target="_blank">
                            <?php echo $event_array['link'];?>
                        </a>
                    </td>
<?php
        }
?>
                </tr>
            </table>
<?php
    }

    //Show all other events for the same day or during the duration of the selected event.
    $beginDay = $year . '-' . $month . '-' . $day;
    $endDay = $year_end . '-' . $month_end . '-' . $day_end;
    $other_events_query = tep_db_query("select *, DAYOFMONTH(start_date) AS event from ". TABLE_EVENTS_CALENDAR 
        . " where ( (start_date BETWEEN '" . $beginDay . "' and '". $endDay . "')"
        . "			or (end_date BETWEEN '" . $beginDay . "' and '" . $endDay . "')" 
        . "         or ( (start_date <= '" . $beginDay . "' and start_date <= '" . $endDay . "')" 
        . "             and (end_date >= '" . $beginDay . "' and end_date >= '" . $endDay . "') ) )" 
        . " and language_id = '" . $languages_id . "' and event_id != '" . $select_event 
        . "' order by start_date");
    if (tep_db_num_rows($other_events_query) > 0) 
    {
?>
            <H4><?php echo TEXT_OTHER_EVENTS;?></H4>
            <table border="0" width="100%" cellspacing="0" cellpadding="2" class="event_header">
<?php
        while ($other_events = tep_db_fetch_array($other_events_query))
        {
            $event_array = array('id' => $other_events['event_id'],
                                 'event' => $other_events['event'],
                                 'title' => $other_events['title']);
?>
                <tr>
                    <td align="center" width="24" class="event_header" nowrap>
                        <b><?php echo $i; ?></b>
                    </td>
                    <td width="100%" class="event">
                        <a href="<?php echo FILENAME_EVENTS_CALENDAR;?>?select_event=<?php echo $event_array['id'];?>">
                            <?php echo $event_array['title'];?>
                        </a>
                    </td>
                </tr>
<?php
            $i++;
        }
?>
            </table>
<?php
    }
}
elseif($HTTP_GET_VARS['year_view'] == 1)
{   //Show the full year view.
?>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td><?php echo $cal->getYearView($year_); ?></td>
                </tr>
            </table>
<?php
}
elseif($HTTP_GET_VARS['_day'])
{   //Show all Events for the specified date.
    $events_query_raw = "select *, DAYOFMONTH(start_date) AS event from " . TABLE_EVENTS_CALENDAR
	. " where '" . $_year . "-" . $_month . "-" . $_day . "' BETWEEN start_date and end_date" 
        . " and language_id = '" . $languages_id . "' order by start_date";
        
    $listingTitle = date($dateDisplayFormat, mktime(0, 0, 0, $_month, $_day, $_year));
    $displayPagingSuffix = $listingTitle;
    require(DIR_WS_MODULES . 'events_calendar_listing.php');
}
else if($HTTP_GET_VARS['view'] == 'all_events')
{   //Show all Events from current date.
    $events_query_raw = "select *, DAYOFMONTH(start_date) AS event from " . TABLE_EVENTS_CALENDAR 
        . " where (start_date >= '" . date('Y-m-d H:i:s') . "' or end_date >= '" . date('Y-m-d H:i:s') . "')"
        . " and language_id = '" . $languages_id . "' order by start_date";
    
    $listingTitle = 'All Events';
    $displayPagingSuffix = NULL;
    require(DIR_WS_MODULES . 'events_calendar_listing.php');
}
else
{   //Show All Events for the current or specified month/year
    $events_query_raw = "select *, DAYOFMONTH(start_date) AS event from " . TABLE_EVENTS_CALENDAR 
        . " where ((MONTH(start_date) = '" . $month_ . "' and YEAR(start_date) = '" . $year_ . "')"
        . "        or (MONTH(end_date) = '" . $month_ . "' and YEAR(end_date) = '" . $year_ . "'))"
        . " and language_id = '" . $languages_id . "'  order by start_date";
        
    $months = $cal->monthNames[$month_ - 1];
    
    $listingTitle = $months . ' ' . $year_;
    $displayPagingSuffix = $listingTitle;
    require(DIR_WS_MODULES . 'events_calendar_listing.php');
}
?>
        </td>
    </tr>
</table>