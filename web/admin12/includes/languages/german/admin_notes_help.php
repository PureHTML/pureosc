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

define('TEXT_GRAY_TITLE','Admin Notizen Hilfe');
define('ADMIN_NOTES_TITLE','Admin Notes v2.1');
define('AUTHOR','<br />Created by: PopTheTop');
define('TEXT_NOTE','<STRONG><FONT COLOR="RED">Wichtig:</FONT></STRONG><br />Fals Sie nachträglich Fragen haben, wenden Sie sich bitte an das osc contributions forum.<br />Forum Thread Thema: <A HREF="http://forums.oscommerce.com/index.php?showtopic=119993" TARGET="_blank"><FONT COLOR="#0000FF">Admin Notes</FONT></A>');
define('TEXT_IC_ONE','<br /><br /><STRONG>Notiz Title:</STRONG><br />&nbsp;&nbsp;&nbsp;Das ist der Titel der Notiz.<br />&nbsp;&nbsp;&nbsp;Anklicken um die Notiz zu betrachten.<br />&nbsp;&nbsp;&nbsp;Die Maus darüber bewegen um die Kategorie der Notiz zu sehen.<br /><br /><b>Schalter:</b><br />&nbsp;&nbsp;&nbsp;Ein Marker für die Wichtigkeit der Notiz.<br />&nbsp;&nbsp;&nbsp;Anklicken um den Status zu markieren.<br /><br />&nbsp;&nbsp;&nbsp;Bedeutung:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.png', 'Important', 10, 10) . ' = Wichtig<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_green.png', 'No so important', 10, 10) . ' = nicht so wichtig<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_yellow.png', 'Caution', 10, 10) . ' = Vorsicht! (im Auge behalten)<br /><br /><STRONG>Einfügen</STRONG>:<br />&nbsp;&nbsp;&nbsp;Anklicken um eine neue Notiz zu erstellen.<br /><br />Der Rest ist selbsterklärend...');
define('TEXT_CLOSE_WINDOW','<br /><font color=red><b>Fenster Schließen</b></font>');
?>