<?php
/*
$Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $
osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License

Translated by Vlad Savitsky
http://solti.com.ua
*/
if (!isset($HTTP_GET_VARS['op'])) {
    $HTTP_GET_VARS['op']="list";
    }
if ($HTTP_GET_VARS['op']=='results') {
  define('TOP_BAR_TITLE', '������ ��� �����������');//Polling Booth
  define('HEADING_TITLE', '���������� ������');
  define('SUB_BAR_TITLE', '���������� ������');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', '������ ��� �����������');//Polling Booth
  define('HEADING_TITLE', '����� �������');//Polls Overview
  define('SUB_BAR_TITLE', '���������� ������');//Previous Polls
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', '������ ��� �����������');//Polling Booth
  define('HEADING_TITLE', '������� �� ��� ������');//Thank you for your feedback
  define('SUB_BAR_TITLE', '������������ � ���� ������');//Vote in this poll
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', '����������� �� ���� �����');//Comment on this poll
}
define('_WARNING', '��������������: ');
define('_ALREADY_VOTED', '��������, �� �� ��� ����������� � ���� ������.');
define('_NO_VOTE_SELECTED', '����������, �������� �� ��� �� ������ �������������.');
define('_TOTALVOTES', '����� �������');//Total votes cast
define('_OTHERPOLLS', '������ ������');
define('NAVBAR_TITLE_1', '������ ��� �����������');//Polling Booth
define('_POLLRESULTS', '���������� �������');
define('_VOTING', '����������!');//Vote Now
define('_RESULTS', '�������� ����������');
define('_VOTES', '�������');//Votes
define('_VOTE', '����������');
define('_COMMENT', '�����������');
define('_COMMENTS', '�����������');
define('_COMMENTS_POSTED', '����������� ���������');//Comments Posted
define('_COMMENTS_BY', '����������� ������ ');//Comment made by
define('_COMMENTS_ON', ' �� ');
define('_YOURNAME', '���� ���:');
define('_YOURCOMMENT', '��� �����������:');
define('_PUBLIC','�����');
define('_PRIVATE','�������');
define('_POLLOPEN','����� ������');
define('_POLLCLOSED','��������, ���� ����� ������.');
define('_POLLPRIVATE','������� �����. �� ������ ������������������, ����� �������������');//Private Poll, you must be logged in to vote
define('_ADD_COMMENTS', '�������� �����������');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', '�������� � <b>%d</b> �� <b>%d</b> (�� <b>%d</b> ������������)');
?>
