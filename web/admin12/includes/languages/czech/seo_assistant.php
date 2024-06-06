<?php
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  08.03.2004
  Originally Created by: Jack York
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
  
*/ 
 
  define('NAVBAR_TITLE', 'SEO Assistant');
  define('HEADING_TITLE', '<a name="top" class="seoHead">SEO Assistant</a>');
  define('HEADING_TITLE_SUB', '<p>SEO (search engine optimization) is one the most important
  things a shop owner can do to improve his or her shop. This page contains a number of tools that
  help with that optimization process.<br />
  </p>
  ');
  
  define('HEADING_TITLE', 'Search Engine Ranking');
  define('HEADING_TITLE_INDEX', '<a name="index"></a>Index Position');
	define('HEADING_TITLE_YAHOO', 'Yahoo Position_Results');
	define('HEADING_TITLE_MSN', 'MSN Position_Results');  
  define('HEADING_TITLE_RANK', '<a name="pagerank"></a>Page Rank');
  define('HEADING_TITLE_LINKPOP', '<a name="linkpop"></a>Link Popularity');
  define('HEADING_TITLE_DENSITY', '<a name="density"></a>Keyword Density');
  define('HEADING_TITLE_CHECK_LINKS', '<a name="checklinks"></a>Check Links');
  define('HEADING_TITLE_CHECK_SIDS', '<a name="checksids"></a>Check for SID\'s');
  define('HEADING_TITLE_HEADER_STATUS', '<a name="headerstatus"></a>Header Status');
  define('HEADING_TITLE_HEADER_CODE_EXPLAIN', 'Explain Code');  
  define('HEADING_TITLE_SUPPLEMENTAL', '<a name="supplemental"></a>Supplemental Listings');
  define('TEXT_ALEXA_TRAFFIC_RANKING', 'Alexa Traffic Ranking');
  define('TEXT_ALLTHEWEB', 'All the Web');
  define('TEXT_ALTAVISTA', 'AltaVista');
  define('TEXT_BROKEN_LINK', 'Broken Link:');
  define('TEXT_COMPARE', 'Compare: ');
  define('TEXT_COUNT', 'Count');
  define('TEXT_DENSITY_TABLE', 'Density');
  define('TEXT_DOMAIN', 'DOMAIN');
  define('TEXT_DOUBLE_WORD', 'Double Word');
  define('TEXT_ENTER_URL', 'Enter URL: ');
  define('TEXT_FOUND', 'Found ');
  define('TEXT_GOOGLE', 'Google');
  define('TEXT_HOTBOT', 'HotBot');
  define('TEXT_INCLUDE_META_TAGS', 'Include Meta Tags: ');
  define('TEXT_MSN', 'MSN');
  define('TEXT_PAGE_RANK', 'Page Rank: ');
  define('TEXT_CHECKSUM','CheckSum: ');
  define('TEXT_PRESENT_IN_DMOZ', 'Present in DMOZ');
  define('TEXT_PRESENT_IN_ZEAL', 'Present in Zeal');
  define('TEXT_SEARCH', 'Search: ');
  define('TEXT_SEARCH_TERM', 'Enter search term: '); 
  define('TEXT_SEARCH_URL', 'Enter URL to search for: ');
  define('TEXT_SHOW_HISTORY', 'Show History: ');
  define('TEXT_SHOW_LINKS', 'Show Links: ');
  define('TEXT_SHOW_RESULTS', 'Show Results: ');
  define('TEXT_SINGLE_WORD', 'Single Word');
  define('TEXT_SPIDER_WARNING', 'Warning! The Prevent Spiders Sessions setting in your database 
    is set to False.  This option should be set to True in almost all cases. It is meant to 
    prevent session ID\'s from being added to links in the search engine listings.');
  define('TEXT_TOTAL', 'Total');
  define('TEXT_TOTAL_LINKS_LISTED', 'Total Links Listed');
  define('TEXT_TOTAL_SEARCHES', 'Enter total searches: ');
  define('TEXT_TOTAL_SIDS_FOUND', 'Total SID\'s found');
  define('TEXT_TOTAL_SUPPLEMENTAL_FOUND', 'Total Supplemental Links Found');
  define('TEXT_TOTAL_WORDS', 'Total Words: ');
  define('TEXT_TRIPLE_WORD', 'Triple Word');
  define('TEXT_USE_PARTIAL_TOTAL', 'Use Partial Total: ');
  define('TEXT_YAHOO', 'Yahoo');
  
  
  define('TEXT_POSITION', 'The search engines display sites on their pages using what is called
  an "Index," (like the Index of a book). The closer you are to the top, number one, position in this
  index, the more traffic your site will receive. This section allows you to check your position
  in the indexes of Google, MSN and Yahoo. Most people have their browsers
  set to display 10 results per page so if you are not in the top 20 or 30, they 
  probably won\'t find your site. The code in this section checks for entries  
  with www and without. So if a domain name is entered without www, for example, and
  a link is found with www, the result will state it is found. This should not be a problem
  for most checking.');

  define('TEXT_RANK', 'Page Rank (PR) is a measure of how many links there are to a 
  page on your site.  Each page will have its own PR.  Note that PR is wholly
  determined by the number of links to your page and the relevance of those links to you
  site - nothing else. So the more links you can generate (with link exchanges, 
  posting your url on forums and even
  links within your own site) the higher your PR will be.');

  define('TEXT_LINKPOP', 'Link Popularity (LP) is very similar to Page Rank except 
  it goes a little further. Actually, Page Rank is a subset of Link Popularity. 
  Where PR is mainly determined by the number of links to a page, LP
  figures in the relevance of those links.  For example, if you sell Widgets and all other 
  Widget sites are linking to you then the search engines figure that your site
  must be the one to watch and will give you extra points for that.');

  define('TEXT_DENSITY', 'Keyword Density (KD) is a ratio of your chosen keyword(s)
  to the total number of words on the page.  A KD of around 4% to 6% is considered a 
  good figure.  If it is too low, the SE\'s will not rank you as high as they otherwise would.
  But if it is too high, they may think that you are trying to trick them, and they 
  may even punish you by banning your site.');

  define('TEXT_CHECK_LINKS', 'Having working code is an important part of SEO.
  If a search engine search bot cannot follow a link, it is unlikely that it will list
  it.  Having working links is also important to your visitors. If they can\'t
  find their way around your site, they, like the search engine bots, will 
  usually just go away.');

  define('TEXT_HEADER_STATUS', 'It is very important that your site returns the 
  proper status code to the search engines. This is what they use to determine
  if a site is being redirected and how, in part, if it contains duplicate content 
  (which can get it banned).');
  
  define('TEXT_CHECK_SIDS', 'Session ID\'s, (SID\'s), is that long list of characters attached to the
  url and are used in oscommerce to track a customers movement through the shop. A search
  engine should not be assigned a SID. But it can happen if the settings in your shop are not
  correct. Once the search engines have a listing with a SID attached, you have to take 
  extra steps to remove those. This option will allow you to check if there are any listings
  that have SID\'s attached.');
  
  define('TEXT_SUPPLEMENTAL', 'Google now uses a "Supplemental Index" and many shop
  owners are finding their sites listed in this index. As usual, google is not forthcoming
  as to the reasons for pages being listed as supplemental. It could indicate a minor
  problem like google could not find enough information about the page, or, it could indicate
  a major problem like it is being seen as duplicate content, or, it could be something else. 
  If you have pages listed as supplemental, then you should look closer at them to try to isolate
  the cause.');
  
  define('IMAGE_GET_PAGE_RANK', 'Get Page Rank');
  define('IMAGE_CHECK_DENSITY', 'Check Density');
  define('IMAGE_CHECK_LINKS', 'Check Links');
  define('IMAGE_CHECK_SIDS', 'Check for SID\'s');
  define('IMAGE_CHECK_SUPPLEMENTAL', 'Get Supplemental');
  define('IMAGE_LINK_POPULARITY', 'Link Popularity');
  define('IMAGE_GET_HEADER', 'Get Header');
  define('IMAGE_SEARCH', 'Search');  
?>