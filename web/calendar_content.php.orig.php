<?php
/*
  $Id: events_calendar v1.00 2003/03/08 18:09:16 ip chilipepper.it Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License
*/
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_EVENTS_CALENDAR);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="cs" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- events_calendar //-->
<link rel="stylesheet" type="text/css" href="calendar.css">
    <LINK rel="shortcut icon" href="favicon.ico" >
    <LINK rel="icon" href="favicon.ico" >
<SCRIPT LANGUAGE="JavaScript">
    function jump(view, url)
    {
        if (document.all||document.getElementById)
        {
            month= document.calendar._month.options[document.calendar._month.selectedIndex].value;
            year=  document.calendar._year.options[document.calendar._year.selectedIndex].value;
            return url +'?_month='+ month +'&_year='+ year +'&year_view='+ view;
        }
    }
</SCRIPT>
<?php
// Construct a calendar to show the current month
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
    $year = date('Y');
    $month = date('m');
    $month_= $month;
    $year_= $year;
}
?>
</head>
<body>
<table class="calendarBox" cellspacing="0">
    <tr>
        <td class="calendarBoxHeader" align="left">
            &nbsp;&nbsp;
            <A class="calendarBoxHeader" href="<?php echo tep_href_link(FILENAME_EVENTS_CALENDAR, 'view=all_events');?>" title="<?php echo BOX_CALENDAR_TITLE; ?>" target="_parent">
                <?php echo HEADING_TITLE; ?>
            </A>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top">
            <?php echo $cal->getMonthView($month,$year); ?>
        </td>
    </tr>
    <form method="get" name="calendar" action="events_calendar.php">
    <tr>
        <td class="yearHeader" style="line-height: 2px;">&nbsp;</td>
    </tr>
    <tr>
        <td class="yearHeader" align="center" valign="top" nowrap>
            <!-- Month List -->
            <select name="_month">
            <?php
                $monthShort = explode(",", MONTHS_SHORT_ARRAY);
                $month = date('m');
                while (list($key, $value) = each($monthShort))
                {
                    if ($HTTP_GET_VARS['_month'])
                    {
                        $selected = '';
                        if($key+1 == $_month)
                        {
                            $selected = 'selected';
                        }
                        $key=$key+1;
            ?>          
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?> >
                            <?php echo $value; ?>
                        </option> 
            <?php
                    }
                    else
                    {
                        $selected = '';
                        if($key+1 == $month)
                        {
                            $selected = 'selected';
                        }
                        $key=$key+1;
            ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?> >
                            <?php echo $value; ?>
                        </option> 
            <?php
                    }
                }
            ?>
            </select><select name="_year">
            <!-- Year List -->
            <?php
                $year = date('Y');
                $years = NUMBER_OF_YEARS;
                for ($y=0; $y < $years; $y++)
                {
                    $_y = $year+$y;
                    if ($HTTP_GET_VARS['_month'])
                    {
                        if($_y == $_year)
                        {
                            echo '<option value="'. $_y .'" selected>'. $_y .'</option>' . "\n";
                        }
                        else
                        {
                            echo '<option value="'. $_y .'">'. $_y .'</option>' . "\n";
                        }
                    }
                    else
                    {
                        if($_y == $year)
                        {
                            echo '<option value="'. $_y .'" selected>'. $_y .'</option>' . "\n";
                        }
                        else
                        {
                            echo '<option value="'. $_y .'">'. $_y .'</option>' . "\n";
                        }
                    }
                }
            ?>
            </select
            ><input type="button" class="yearHeaderButton" title="<?php echo BOX_GO_BUTTON_TITLE; ?>" 
                value="<?php echo BOX_GO_BUTTON; ?>"  
                onclick="top.window.location=jump(0,'<?php echo  FILENAME_EVENTS_CALENDAR; ?>')"
            /><input type="button" class="yearHeaderButton" title="<?php echo BOX_YEAR_VIEW_BUTTON_TITLE; ?>" 
                value="<?php echo BOX_YEAR_VIEW_BUTTON; ?>" 
                onclick="top.window.location=jump(1,'<?php echo  FILENAME_EVENTS_CALENDAR ; ?>')"
            /><input class="yearHeaderButton" title="<?php echo BOX_TODAY_BUTTON_TITLE; ?>" 
                value="<?php echo BOX_TODAY_BUTTON; ?>" 
                onclick='top.calendar.location="<?php echo  FILENAME_EVENTS_CALENDAR_CONTENT; ?>?_month=<?php echo $this_month . '&_year=' . $this_year ?>"' 
            <?php
                if (($month != $this_month) || ($month_ != $this_month))
                {
                    $todayBtnType = 'button';
                }
                else
                {
                    $todayBtnType = 'hidden';
                }
            ?>
                type="<?php echo $todayBtnType; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="yearHeader" align="center" height="100%">
        </td>   
    </tr>
   <tr>
        <td height="100" class="yearHeader"></td>
    </tr> 
    </form>
</table>
<!-- events_calendar //-->
</body>
</html>