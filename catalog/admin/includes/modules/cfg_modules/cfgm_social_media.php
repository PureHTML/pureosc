<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

  class cfgm_social_media {
    var $code = 'social_media';
    var $directory;
    var $language_directory = DIR_FS_CATALOG_LANGUAGES;
    var $key = 'MODULE_SOCIAL_MEDIA_INSTALLED';
    var $title;
    var $template_integration = false;

    function __construct() {
      $this->directory = DIR_FS_CATALOG_MODULES . 'social_media/';
      $this->title = MODULE_CFG_MODULE_SOCIAL_MEDIA_TITLE;
    }
  }
?>
