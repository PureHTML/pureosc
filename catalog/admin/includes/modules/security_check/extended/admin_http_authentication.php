<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

  class securityCheckExtended_admin_http_authentication {
    var $type = 'warning';

    function __construct() {
      global $language;

      include(DIR_FS_ADMIN . 'includes/languages/' . $language . '/modules/security_check/extended/admin_http_authentication.php');

      $this->title = MODULE_SECURITY_CHECK_EXTENDED_ADMIN_HTTP_AUTHENTICATION_TITLE;
    }

    function pass() {
      return isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']);
    }

    function getMessage() {
      return MODULE_SECURITY_CHECK_EXTENDED_ADMIN_HTTP_AUTHENTICATION_ERROR;
    }
  }
?>
