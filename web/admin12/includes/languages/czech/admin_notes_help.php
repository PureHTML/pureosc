<?php
/*
  $Id: admin_notes_help.php,v 2.2 2005/04/15 11:25:32 PopTheTop Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  
_________________________________________________________________
Admin Notes MODULE for osC Admin Side
By PopTheTop of www.popthetop.com
Original Code By: Robert Hellemans of www.RuddlesMills.com 
These are LIVE SHOPS - So please, no TEST accounts etc...
We will report you to your ISP if you abuse our websites!

*/

define('TEXT_GRAY_TITLE','Admin Notes Help');
define('ADMIN_NOTES_TITLE','Admin Notes v2.1');
define('AUTHOR','<br />Created by: PopTheTop');
define('TEXT_NOTE','<STRONG><FONT COLOR="RED">PLEASE NOTE:</FONT></STRONG><br />Please ask any additional questions at the osC contributions forum.<br />Forum Thread Topic: <A HREF="http://forums.oscommerce.com/index.php?showtopic=119993" TARGET="_blank"><FONT COLOR="#0000FF">Admin Notes</FONT></A>');
define('TEXT_IC_ONE','<br /><br /><STRONG>Note Title:</STRONG><br />&nbsp;&nbsp;&nbsp;This is the name or title of the note you entered.<br />&nbsp;&nbsp;&nbsp;Click on it to highlight it in Overview.<br />&nbsp;&nbsp;&nbsp;Float your mouse over it to view the Category your note is in.<br /><br /><b>Buttons:</b><br />&nbsp;&nbsp;&nbsp;This is only a marker for your reference and does nothing<br />&nbsp;&nbsp;&nbsp;but highlights a button to show the importance of your note.<br /><br />&nbsp;&nbsp;&nbsp;Samples are:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.png', 'Important', 10, 10) . ' = Important<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_green.png', 'No so important', 10, 10) . ' = No so important<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_yellow.png', 'Caution', 10, 10) . ' = Caution (Keep an eye on this one)<br /><br /><STRONG>Insert</STRONG>:<br />&nbsp;&nbsp;&nbsp;Click this to add a new note.<br /><br />The rest of it should be self explanatory...');
define('TEXT_CLOSE_WINDOW','<br /><font color=red><b>Close Window</b></font>');
?>