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
  define('HEADING_TITLE', 'Poll Results');
  define('SUB_BAR_TITLE', 'Poll Results');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Polls Overview');
  define('SUB_BAR_TITLE', 'Previous Polls');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Thank you for your feedback');
  define('SUB_BAR_TITLE', 'Vote in this poll');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Comment on this poll');
}
define('_WARNING', 'Warning : ');
define('_ALREADY_VOTED', 'Sorry, you have already voted in this poll.');
define('_NO_VOTE_SELECTED', 'Please select what you would like to vote for.');
define('_TOTALVOTES', 'Total votes cast');
define('_OTHERPOLLS', 'Other Polls');
define('NAVBAR_TITLE_1', 'Polling Booth');
define('_POLLRESULTS', 'Poll results');
define('_VOTING', 'Vote Now');
define('_RESULTS', 'View Results');
define('_VOTES', 'Votes');
define('_VOTE', 'VOTE');
define('_COMMENT', 'Comment');
define('_COMMENTS', 'Comments');
define('_COMMENTS_POSTED', 'Comments Posted');
define('_COMMENTS_BY', 'Comment made by ');
define('_COMMENTS_ON', ' on ');
define('_YOURNAME', 'Your Name:');
define('_YOURCOMMENT', 'Your Comment:');
define('_PUBLIC','Public');
define('_PRIVATE','Private');
define('_POLLOPEN','Poll Open');
define('_POLLCLOSED','Sorry, this poll is closed.');
define('_POLLPRIVATE','Private Poll, you must be logged in to vote');
define('_ADD_COMMENTS', 'Add Comment');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> comments)');
?>
