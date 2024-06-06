<?php

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_CALENDAR
                              );
?>
<!-- events_calendar //-->
  <tr>
    <td>
            <iframe name="calendar" id="calendar" class="calendarBox"
                align="center" valign="top" marginwidth="0" marginheight="0" frameborder="0" scrolling="no"
                src="<?php echo FILENAME_EVENTS_CALENDAR_CONTENT .'?_month='. $_month .'&_year='. $_year ?>">Sorry, your browser does not support iframes.</iframe>
    </td>
  </tr>
<!-- events_calendar //-->
