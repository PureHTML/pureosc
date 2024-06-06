<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
    header("Content-type: application/rss+xml");
    require('includes/application_top.php');

   function mysqlTimestamp2unix($input){
            $y = substr($input,0,4);$m = substr($input,6,2);$d = substr($input,9,2);
            $h = substr($input,12,2);$min = substr($input,15,2);$s = substr($input,18,2);
                return mktime($h,$min,$s,$m,$d,$y);
            }
//1234567890123456789 
//2007-01-01 15:48:04

    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_RSS);

    $language_query = tep_db_query("select code from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$languages_id . "'");
        $language_code = tep_db_fetch_array($language_query);
        $code_lang = $language_code['code'];

     echo "<?xml version='1.0' ?><rss version='2.0'><channel>\n

     <title>" . NEWS_TITLE . "</title>\n";

     echo "<link>" . HTTP_SERVER . "</link>\n";
     echo "<description>" . NEWS_DESCRIPTION . "</description>\n";
     echo "<language>" . $code_lang . "</language>\n";
     echo "<docs>" . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_ARTICLE_RSS . "</docs>\n";

//   $news_query_raw = tep_db_query("select nd.name, n.date_created, nd.content, n.id from " . TABLE_NEWS . " n, " . TABLE_NEWS_DESC . " nd where nd.language_id = '" . (int)$languages_id . "' and n.id = nd.news_id order by n.id desc 																																																												 																																																												 																																																												 																																																												 																																																												 																																																												 																																																												 																																		" );
   /*$news_query_raw = tep_db_query("select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, ad.articles_description, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' order by a.articles_date_added desc, ad.articles_name limit". NEWS_RSS_ARTICLE);*/
   
   $news_query_raw = tep_db_query("select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, ad.articles_description, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' order by a.articles_date_added desc, ad.articles_name limit " . NEWS_RSS_ARTICLE);
   
// use language_id for language support.
       while ($content_rec = tep_db_fetch_array($news_query_raw)) {
        echo "<item>";

        $headline = $content_rec['articles_name'];
        $mydate = mysqlTimestamp2unix($content_rec['articles_date_added']);
        $date = date('r',$mydate);
        $content_1 = substr($content_rec['articles_description'], 0, NEWS_RSS_CHARACTERS);
        $content = strip_tags($content_1);
        if (strlen($content_rec['content']) > NEWS_RSS_CHARACTERS) {
            $content = $content . "....";
						// maybe read more here?
        }
				$article_author= $content_rec['authors_name'];
        // $article_url= $content_rec['articles_url'];
        $article_topic= $content_rec['topics_name'];
        $item_link = HTTP_SERVER . DIR_WS_CATALOG . FILENAME_ARTICLE_INFO . "?articles_id=" . $content_rec['articles_id'];

        echo "<title>$headline</title>\n";
        echo "<pubDate>$date</pubDate>\n";
        echo "<description>$content</description>\n";
        echo "<author>$article_author</author>\n";
        echo "<category>$article_topic</category>\n";
        echo "<link>$item_link</link>\n";
        echo "<guid>$item_link</guid>\n";
        echo "</item>\n";
    }

       echo "</channel></rss>";
?>