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
  define('HEADING_TITLE', 'See what others think');
  define('SUB_BAR_TITLE', 'Poll Results');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'We value your thoughts');
  define('SUB_BAR_TITLE', 'Previous Polls');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Our customers matter');
  define('SUB_BAR_TITLE', 'Vote in this poll');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Comment on this poll');
}
define('_WARNING', 'Warning : ');
define('_ALREADY_VOTED', 'You\'ve recently voted in this poll.');
define('_NO_VOTE_SELECTED', 'You didn\'t select an option to vote for.');
define('_TOTALVOTES', 'Total votes cast');
define('_OTHERPOLLS', 'Other Polls');
define('NAVBAR_TITLE_1', 'Polling Booth');
define('_POLLRESULTS', 'Click here for Poll results');
define('_VOTING', 'Vote Now');
define('_RESULTS', 'Results');
define('_VOTES', 'Votes');
define('_VOTE', 'VOTE');
define('_COMMENT', 'Comment');
define('_COMMENTS', 'Comments');
define('_COMMENTS_POSTED', 'Comments Posted');
define('_COMMENTS_BY', 'Comment made by ');
define('_COMMENTS_ON', ' on ');
define('_YOURNAME', 'Your Name');
define('_PUBLIC','Public');
define('_PRIVATE','Private');
define('_POLLOPEN','Poll Open');
define('_POLLCLOSED','Poll Closed');
define('_POLLPRIVATE','Private Poll, you must be logged in to vote');
define('_ADD_COMMENTS', 'Add Comment');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> comments)');
?>
