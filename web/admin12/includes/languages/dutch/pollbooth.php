<?php
/*
  $Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
if (!isset($HTTP_GET_VARS['op'])) {
	$HTTP_GET_VARS['op']="list";
	}
if ($HTTP_GET_VARS['op']=='results') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Kijk naar andere stemmen');
  define('SUB_BAR_TITLE', 'Poll Rasultaten');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'We waarderen uw stem');
  define('SUB_BAR_TITLE', 'Voorgaande Polls');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Our customers matter');
  define('SUB_BAR_TITLE', 'Stem in deze poll');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'opmerkingen in deze poll');
}
define('_WARNING', 'Waarschuwing : ');
define('_ALREADY_VOTED', 'Je hebt recentelijk gestemt in deze poll.');
define('_NO_VOTE_SELECTED', 'Je hebt geen optie geselecteer voor je stem.');
define('_TOTALVOTES', 'Totaal stemmen');
define('_OTHERPOLLS', 'Andere Polls');
define('NAVBAR_TITLE_1', 'Polling Booth');
define('_POLLRESULTS', 'Klik hier voor de Poll resultaten');
define('_VOTING', 'Stem nu');
define('_RESULTS', 'Resultaten');
define('_VOTES', 'Stemmen');
define('_VOTE', 'STEM');
define('_COMMENT', 'Opmerkingen');
define('_COMMENTS', 'Opmerkingen');
define('_COMMENTS_POSTED', 'Geposte opmerkingen');
define('_COMMENTS_BY', 'Opmerkingen gemaakt door ');
define('_COMMENTS_ON', ' op ');
define('_YOURNAME', 'Je Naam');
define('_PUBLIC','Publiek');
define('_PRIVATE','Prive');
define('_POLLOPEN','Poll Open');
define('_POLLCLOSED','Poll Gesloten');
define('_POLLPRIVATE','Privee Poll, je moet inlogen om te kunnen stemmen');
define('_ADD_COMMENTS', 'Voeg komentaar toe');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Weergeven <b>%d</b> tot <b>%d</b> (van <b>%d</b> opmerkingen)');
?>
