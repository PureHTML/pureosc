<?php
/*
  $Id: ssl_check.php,v 1.1 2003/03/10 23:32:20 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Security Check');
define('HEADING_TITLE', 'Security Check');

define('TEXT_INFORMATION', 'We have detected that your browser has generated a different SSL Session ID used throughout our secure pages.<br /><br />For security measures you will need to logon to your account again to continue shopping online.<br /><br />Some browsers such as Konqueror 3.1 does not have the capability of generating a secure SSL Session ID automatically which we require. If you use such a browser, we recommend switching to another browser such as <a href="http://www.microsoft.com/ie/" >Microsoft Internet Explorer</a>, <a href="http://channels.netscape.com/ns/browsers/download_other.jsp" >Netscape</a>, or <a href="http://www.mozilla.org/releases/" >Mozilla</a>, to continue your online shopping experience.<br /><br />We have taken this measurement of security for your benefit, and apologize upfront if any inconveniences are caused.<br /><br />Please contact the store owner if you have any questions relating to this requirement, or to continue purchasing products offline.');

define('BOX_INFORMATION_HEADING', 'Privacy and Security');
define('BOX_INFORMATION', 'We validate the SSL Session ID automatically generated by your browser on every secure page request made to this server.<br /><br />This validation assures that it is you who is navigating on this site with your account and not somebody else.');
?>
