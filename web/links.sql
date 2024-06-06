DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `links_id` int(4) NOT NULL auto_increment,
  `link_url` varchar(127) NOT NULL default '',
  `link_description` text NOT NULL default '',
  `link_codes` varchar(127)  NOT NULL,
  `link_state` int(1) NOT NULL default '0',
  `link_date` varchar(10) NOT NULL default '',
  `link_title` varchar(100) NOT NULL default '',
  `links_image` varchar(64) default NULL, 
  `name` varchar(31) NOT NULL default '',
  `email` varchar(127) NOT NULL default '',
  `reciprocal` varchar(127) NOT NULL default '',
  `link_found` int(1) NOT NULL default '0',
  `category` int(2) default NULL,
  `new_category` varchar(32) default NULL, 
  `date_last_checked` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`links_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `links_categories`;
CREATE TABLE IF NOT EXISTS `links_categories` (
  `category_id` int(3) NOT NULL auto_increment,
  `category_name` varchar(32) NOT NULL,
  `sort_order` int(2) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`category_id`),
  KEY `idx_date_added` (`date_added`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;







INSERT INTO `links` (`links_id`, `link_url`, `link_description`, `link_codes`, `link_state`, `link_date`, `link_title`, `name`, `email`, `reciprocal`) VALUES 
(1, 'http://www.onvon.com', 'Wholesale Consumer Electronics, Car Audio, Digital Cameras, Computer Electronics, MP3 Players, Bluetooth Products, MP4 Players, Spy Cameras, Security Products and Electronic Gadgets from China.', 'Wholesale Consumer Electronics, Car Audio, Digital Cameras, Computer Electronics, MP3 Players, Bluetooth Products, MP4 Players, Spy Cameras, Security Products and Electronic Gadgets from China.', 1, '2008-08-01', 'onvon.com China onlineshop', 'raptor', 'blueer23@163.com', 'http://');
