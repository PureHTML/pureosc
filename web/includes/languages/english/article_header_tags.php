<?php
/*
  $Id: article_header_tags.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Mofification of Header Tags Contribution
// WebMakers.com Added: Header Tags Generator v2.0

/* If you have the Header Tags Controller already installed, replicate the
   global details from header_tags.php into the indented section below  */

   // Define your email address to appear on all pages
   define('HEAD_REPLY_TAG_ALL','admin@sitename.com');

   // For all pages not defined or left blank, and for articles not defined
   // These are included unless you set the toggle switch in each section below to OFF ( '0' )
   // The HEAD_TITLE_TAG_ALL is included BEFORE the specific one for the page
   // The HEAD_DESC_TAG_ALL is included AFTER the specific one for the page
   // The HEAD_KEY_TAG_ALL is included AFTER the specific one for the page
   define('HEAD_TITLE_TAG_ALL','Site Name');
   define('HEAD_DESC_TAG_ALL','This is a description for the entire site.');
   define('HEAD_KEY_TAG_ALL','keyword1, keyword2, keyword3');

/* End of Indented Section */

// DEFINE TAGS FOR INDIVIDUAL PAGES

// articles.php
define('HTTA_ARTICLES_ON','1'); // Include HEAD_TITLE_TAG_ALL in Title
define('HTKA_ARTICLES_ON','1'); // Include HEAD_KEY_TAG_ALL in Keywords
define('HTDA_ARTICLES_ON','1'); // Include HEAD_DESC_TAG_ALL in Description
define('HEAD_TITLE_TAG_ARTICLES','Articles');
define('HEAD_DESC_TAG_ARTICLES','Articles');
define('HEAD_KEY_TAG_ARTICLES','articles');

// article_info.php - if left blank in articles_description table these values will be used
define('HTTA_ARTICLE_INFO_ON','1');
define('HTKA_ARTICLE_INFO_ON','1');
define('HTDA_ARTICLE_INFO_ON','1');
define('HEAD_TITLE_TAG_ARTICLE_INFO','Articles');
define('HEAD_DESC_TAG_ARTICLE_INFO','');
define('HEAD_KEY_TAG_ARTICLE_INFO','');

// articles_new.php - new articles
// If HEAD_KEY_TAG_ARTICLES_NEW is left blank, it will build the keywords from the articles_names of all new articles
define('HTTA_ARTICLES_NEW_ON','1');
define('HTKA_ARTICLES_NEW_ON','1');
define('HTDA_ARTICLES_NEW_ON','1');
define('HEAD_TITLE_TAG_ARTICLES_NEW','');
define('HEAD_DESC_TAG_ARTICLES_NEW','');
define('HEAD_KEY_TAG_ARTICLES_NEW','');

// article_reviews_info.php and article_reviews.php - if left blank in articles_description table these values will be used
define('HTTA_ARTICLE_REVIEWS_INFO_ON','1');
define('HTKA_ARTICLE_REVIEWS_INFO_ON','1');
define('HTDA_ARTICLE_REVIEWS_INFO_ON','1');
define('HEAD_TITLE_TAG_ARTICLE_REVIEWS_INFO','');
define('HEAD_DESC_TAG_ARTICLE_REVIEWS_INFO','');
define('HEAD_KEY_TAG_ARTICLE_REVIEWS_INFO','');

?>