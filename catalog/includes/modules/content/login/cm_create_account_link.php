<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

class cm_create_account_link {
  var $code;
  var $group;
  var $title;
  var $description;
  var $sort_order;
  var $enabled = false;

  function __construct() {
    $this->code = get_class($this);
    $this->group = basename(dirname(__FILE__));

    $this->title = MODULE_CONTENT_CREATE_ACCOUNT_LINK_TITLE;
    $this->description = MODULE_CONTENT_CREATE_ACCOUNT_LINK_DESCRIPTION;

    if (defined('MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS')) {
      $this->sort_order = MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER;
      $this->enabled = (MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS == 'True');
    }
  }

  function execute() {
    global $oscTemplate;

    ob_start();
    include('includes/modules/content/' . $this->group . '/templates/create_account_link.php');
    $template = ob_get_clean();

    $oscTemplate->addContent($template, $this->group);
  }

  function isEnabled() {
    return $this->enabled;
  }

  function check() {
    return defined('MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS');
  }

  function install() {
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable New User Module', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'True', 'Do you want to enable the new user module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER', '2', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
  }

  function remove() {
    tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }

  function keys() {
    return array('MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER');
  }
}
