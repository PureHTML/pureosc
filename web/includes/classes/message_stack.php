<?php
/*
  $Id: message_stack.php,v 1.1 2003/05/19 19:45:42 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License

  Example usage:

  $messageStack = new messageStack();
  $messageStack->add('general', 'Error: Error 1', 'error');
  $messageStack->add('general', 'Error: Error 2', 'warning');
  if ($messageStack->size('general') > 0) echo $messageStack->output('general');
*/

  class messageStack extends tableBox {

// class constructor
    function messageStack() {
      global $messageToStack;

      $this->messages = array();

      if (tep_session_is_registered('messageToStack')) {
        for ($i=0, $n=sizeof($messageToStack); $i<$n; $i++) {
          $this->add($messageToStack[$i]['class'], $messageToStack[$i]['text'], $messageToStack[$i]['type']);
        }
        tep_session_unregister('messageToStack');
      }
    }

// class methods
    function add($class, $message, $type = 'error') {
      if ($type == 'error') {
        $this->messages[] = array('params' => '><span class="messageStackError"', 'class' => $class, 'text' => tep_image_2ma (DIR_WS_ICONS . 'error.png', ICON_ERROR) . '&nbsp;' . $message . '</span>');
      } elseif ($type == 'warning') {
        $this->messages[] = array('params' => '><span class="messageStackWarning"', 'class' => $class, 'text' => tep_image_2ma (DIR_WS_ICONS . 'warning.png', ICON_WARNING) . '&nbsp;' . $message . '</span>');
      } elseif ($type == 'success') {
        $this->messages[] = array('params' => '><span class="messageStackSuccess"', 'class' => $class, 'text' => tep_image_2ma (DIR_WS_ICONS . 'success.png', ICON_SUCCESS) . '&nbsp;' . $message . '</span>');
      } else {
        $this->messages[] = array('params' => '><span class="messageStackError"', 'class' => $class, 'text' => $message . '</span>');
      }
    }

    function add_session($class, $message, $type = 'error') {
      global $messageToStack;

      if (!tep_session_is_registered('messageToStack')) {
        tep_session_register('messageToStack');
        $messageToStack = array();
      }

      $messageToStack[] = array('class' => $class, 'text' => $message, 'type' => $type);
    }

    function reset() {
      $this->messages = array();
    }

    function output($class) {
      $this->table_data_parameters = 'class="messageBox"';

      $output = array();
      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class) {
          $output[] = $this->messages[$i];
        }
      }

      return $this->tableBox($output);
    }

    function size($class) {
      $count = 0;

      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class) {
          $count++;
        }
      }

      return $count;
    }
  }
?>
