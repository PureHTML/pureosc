<?php
/*
  $Id: pollbooth.php,v 1.1.1.1 2003/04/01 20:19:05 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
// Translation by Peter Fürsicht [mailto:peter@fuersicht.de]

if (!isset($HTTP_GET_VARS['op'])) {
	$HTTP_GET_VARS['op']="list";
	}
if ($HTTP_GET_VARS['op']=='results') {
  define('TOP_BAR_TITLE', 'Abstimmung');
  define('HEADING_TITLE', 'Sehen Sie den derzeitigen Trend:');
  define('SUB_BAR_TITLE', 'Abstimmungs-Ergebnis');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Abstimmung');
  define('HEADING_TITLE', 'Unsere bereits erfolgten Abtimmungen');
  define('SUB_BAR_TITLE', 'Previous Polls');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Abstimmung');
  define('HEADING_TITLE', 'derzeitig aktive Abstimmung');
  define('SUB_BAR_TITLE', 'Vote in this poll');
}
define('_WARNING', 'Achtung : ');
define('_ALREADY_VOTED', 'Sie haben bereits für diesen Trend gestimmt.');
define('_NO_VOTE_SELECTED', 'Leider wurde keine Auswahl getroffen.');
define('_TOTALVOTES', 'bereits abgegebene Stimmen');
define('_OTHERPOLLS', 'weitere Abstimmungen');
define('NAVBAR_TITLE_1', 'Abstimmung');
define('_POLLRESULTS', 'zum aktuellen Zwischenstand');
define('_VOTING', 'Jetzt Abstimmen');
define('_RESULTS', 'Zwischenstand');
define('_VOTES', 'Trend');
define('_VOTE', 'Abstimmen');
define('_PUBLIC','öffentlich');
define('_PRIVATE','nicht öffentlich');
define('_POLLOPEN','derzeit aktiv');
define('_POLLCLOSED','bereits beendet');
define('_POLLPRIVATE','Abstimmung nur für Kunden die eingeloggt sind!');
define('_ADD_COMMENTS', 'Add Comment');
define('_COMMENTS', 'Comments');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> comments)');
?>
