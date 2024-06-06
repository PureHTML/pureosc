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
  define('TOP_BAR_TITLE', 'Кабина для голосования');//Polling Booth
  define('HEADING_TITLE', 'Результаты опроса');
  define('SUB_BAR_TITLE', 'Результаты опроса');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Кабина для голосования');//Polling Booth
  define('HEADING_TITLE', 'Обзор опросов');//Polls Overview
  define('SUB_BAR_TITLE', 'Предыдущие опросы');//Previous Polls
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Кабина для голосования');//Polling Booth
  define('HEADING_TITLE', 'Спасибо за ваш отклик');//Thank you for your feedback
  define('SUB_BAR_TITLE', 'Проголосуйте в этом опросе');//Vote in this poll
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Комментарий на этот опрос');//Comment on this poll
}
define('_WARNING', 'Предупреждение: ');
define('_ALREADY_VOTED', 'Извините, но вы уже участвовали в этом опросе.');
define('_NO_VOTE_SELECTED', 'Пожалуйста, выберите за что вы хотите проголосовать.');
define('_TOTALVOTES', 'Всего голосов');//Total votes cast
define('_OTHERPOLLS', 'Другие опросы');
define('NAVBAR_TITLE_1', 'Кабина для голосования');//Polling Booth
define('_POLLRESULTS', 'Результаты опросов');
define('_VOTING', 'Проголосуй!');//Vote Now
define('_RESULTS', 'Смотреть результаты');
define('_VOTES', 'Голосов');//Votes
define('_VOTE', 'ГОЛОСОВАТЬ');
define('_COMMENT', 'Комментарий');
define('_COMMENTS', 'Комментарии');
define('_COMMENTS_POSTED', 'Комментарии добавлены');//Comments Posted
define('_COMMENTS_BY', 'Комментарий создал ');//Comment made by
define('_COMMENTS_ON', ' на ');
define('_YOURNAME', 'Ваше имя:');
define('_YOURCOMMENT', 'Ваш комментарий:');
define('_PUBLIC','Общее');
define('_PRIVATE','Частное');
define('_POLLOPEN','Опрос открыт');
define('_POLLCLOSED','Извините, этот опрос закрыт.');
define('_POLLPRIVATE','Частный опрос. Вы должны зарегистрироваться, чтобы проголосовать');//Private Poll, you must be logged in to vote
define('_ADD_COMMENTS', 'Добавить комментарий');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Показано с <b>%d</b> по <b>%d</b> (из <b>%d</b> комментариев)');
?>
