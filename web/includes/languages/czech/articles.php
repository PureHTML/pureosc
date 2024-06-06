<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'Nové Články v %s');

if ( ($topic_depth == 'articles') || (isset($HTTP_GET_VARS['authors_id'])) ) {
  define('HEADING_TITLE', $topics['Název tématu-topics_name']);
  define('TABLE_HEADING_ARTICLES', 'Články');
  define('TABLE_HEADING_AUTHOR', 'Autor');
  define('TEXT_NO_ARTICLES', 'Nejsou žádné články k tomuto tématu.');
  define('TEXT_NO_ARTICLES2', 'Nejsou zde žádné články od tohoto autora.');
  define('TEXT_NUMBER_OF_ARTICLES', 'Číslo článku: ');
  define('TEXT_SHOW', 'Zobrazit:');
  define('TEXT_NOW', '\' teď');
  define('TEXT_ALL_TOPICS', 'Všechna témata');
  define('TEXT_ALL_AUTHORS', 'Všichi autoři');
  define('TEXT_ARTICLES_BY', 'Články o ');
  define('TEXT_ARTICLES', 'Níže je uveden seznam všech článků dle jejich čtenosti.');  
  define('TEXT_DATE_ADDED', 'Publikováno:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Téma:');
  define('TEXT_BY', 'autor');
  define('TEXT_READ_MORE', 'Čtěte dál...');
  define('TEXT_MORE_INFORMATION', 'pro další informace, navštivte stránky autora <a href="http://%s" target="_blank">web page</a>.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'Všechny články');
  define('TEXT_ALL_ARTICLES', 'Níže je uveden seznam všech článků dle jejich čtenosti.');
  define('TEXT_ARTICLES', 'Níže je uveden seznam všech článků dle jejich čtenosti.');  
  define('TEXT_CURRENT_ARTICLES', 'Aktuální články');
  define('TEXT_UPCOMING_ARTICLES', 'Nové-Upcoming články');
  define('TEXT_NO_ARTICLES', 'Tyto články aktuálně nejsou k dispozici.');
  define('TEXT_DATE_ADDED', 'Publikován:');
  define('TEXT_DATE_EXPECTED', 'Čekající-Expected:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Téma:');
  define('TEXT_BY', 'autor');
  define('TEXT_READ_MORE', 'Čtěte dále...');
} elseif ($topic_depth == 'vnořený-nested') {
  define('HEADING_TITLE', 'Články');
}

?>
