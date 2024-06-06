<?php
/*
  Modulo per pagamento tramite Ricarica PostePay (www.poste.it)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  class postepay {
    var $code, $title, $description, $enabled;

// class constructor
    function postepay() {
      global $order;

      $this->code = 'postepay';
      $this->title = MODULE_PAYMENT_POSTEPAY_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_POSTEPAY_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_POSTEPAY_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_POSTEPAY_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_POSTEPAY_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_POSTEPAY_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    
      $this->email_footer = MODULE_PAYMENT_POSTEPAY_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() 
    {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_POSTEPAY_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_POSTEPAY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
 			$max_amount_allowed = MODULE_PAYMENT_POSTEPAY_MAX_AMOUNT_ALLOWED; 
			if ( ($this->enabled == true) && ( $order->info['total'] > (int)$max_amount_allowed)  && ( $max_amount_allowed != "" ) ) $this->enabled = false;
		}

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_POSTEPAY_TEXT_CONFIRMATION.'<br /><br />'.MODULE_PAYMENT_POSTEPAY_TEXT_DELIVERY);
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_POSTEPAY_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita il pagamento tramite Ricarica PostePay', 'MODULE_PAYMENT_POSTEPAY_STATUS', 'True', 'Vuoi accettare pagamenti tramite Ricarica PostePay?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Intestatario Carta PostePay', 'MODULE_PAYMENT_POSTEPAY_INTESTATARIO', '', 'Intestario della Carta PostePay', '6', '3', now())");
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Numero Carta PostePay', 'MODULE_PAYMENT_POSTEPAY_NUMERO_CARTA', '', 'Numero della carta ricaricabile PostePay', '6', '7', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Massimo ammontare accettato.', 'MODULE_PAYMENT_POSTEPAY_MAX_AMOUNT_ALLOWED', '99999', 'Valore massimo accettato, in Euro, per questo modulo.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zona abilitata', 'MODULE_PAYMENT_POSTEPAY_ZONE', '0', 'Se una zona è abilitata, solo da questa è possibile utilizzare questo metodo di pagamento.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Stato Ordine', 'MODULE_PAYMENT_POSTEPAY_ORDER_STATUS_ID', '0', 'Imposta lo stato di un ordine dopo aver utilizzato questo pagamento', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
	  	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordine di visualizzazione.', 'MODULE_PAYMENT_POSTEPAY_SORT_ORDER', '0', 'Ordine di visualizzazione. Più il valore è basso, prima viene visualizzato.', '6', '0', now())");
	}

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_POSTEPAY_STATUS', 'MODULE_PAYMENT_POSTEPAY_INTESTATARIO', 'MODULE_PAYMENT_POSTEPAY_NUMERO_CARTA', 'MODULE_PAYMENT_POSTEPAY_MAX_AMOUNT_ALLOWED','MODULE_PAYMENT_POSTEPAY_ZONE', 'MODULE_PAYMENT_POSTEPAY_ORDER_STATUS_ID', 'MODULE_PAYMENT_POSTEPAY_SORT_ORDER');
    }
  }
?>
