<?php
/*
  $Id: sessions.php,v 1.9 2003/06/23 01:20:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if (STORE_SESSIONS == 'mysql') {
//jsp:stop    if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
//orig -> configure.php      $SESS_LIFE = 144000; 
//    }

    function _sess_open($save_path, $session_name) {
      return true;
    }

    function _sess_close() {
      return true;
    }

    function _sess_read($key) {
      $value_query = tep_db_query("select value from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "' and expiry > '" . time() . "'");
      $value = tep_db_fetch_array($value_query);

      if (isset($value['value'])) {
        return $value['value'];
      }

      return '';
    }

    function _sess_write($key, $val) {
      global $SESS_LIFE;

      $expiry = time() + $SESS_LIFE;
      $value = $val;

      $check_query = tep_db_query("select count(*) as total from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "'");
      $check = tep_db_fetch_array($check_query);

      if ($check['total'] > 0) {
        return tep_db_query("update " . TABLE_SESSIONS . " set expiry = '" . tep_db_input($expiry) . "', value = '" . tep_db_input($value) . "' where sesskey = '" . tep_db_input($key) . "'");
      } else {
        return tep_db_query("insert into " . TABLE_SESSIONS . " values ('" . tep_db_input($key) . "', '" . tep_db_input($expiry) . "', '" . tep_db_input($value) . "')");
      }
    }

    function _sess_destroy($key) {
      return tep_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "'");
    }

    function _sess_gc($maxlifetime) {
      tep_db_query("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");

      return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
  }

  function tep_session_start() {
// >>> BEGIN REGISTER_GLOBALS
    $success = session_start();

    // Work-around to allow disabling of register_globals - map all defined
    // session variables
    if ($success && count($_SESSION))
    {
      $session_keys = array_keys($_SESSION);
      foreach($session_keys as $variable)
      {
        link_session_variable($variable, true);
      }
    }

    return $success;
// <<< END REGISTER_GLOBALS
  }

  function tep_session_register($variable) {
// >>> BEGIN REGISTER_GLOBALS
// -skip-   return session_register($variable);

    // Work-around to allow disabling of register_globals - map session variable
    link_session_variable($variable, true);

    return true;
// <<< END SESSION_REGISTER
  }

  function tep_session_is_registered($variable) {
// >>> BEGIN REGISTER_GLOBALS
    return (isset($_SESSION) && array_key_exists($variable,$_SESSION));
// <<< END REGISTER_GLOBALS
  }

  function tep_session_unregister($variable) {
// >>> BEGIN REGISTER_GLOBALS
    // Work-around to allow disabling of register_globals - unmap session variable
    link_session_variable($variable, false);
    unset($_SESSION[$variable]);

//  return session_unregister($variable);
    return true;
// <<< END REGISTER_GLOBALS
  }

// >>> BEGIN REGISTER_GLOBALS
  // Work-around function to allow disabling of register_globals in php.ini
  // This is pretty crude but it works. What it does is map session variables to
  // a corresponding global variable.
  // In this way, the main application code can continue to use the existing
  // global varaible names but they are actually redirected to the real session
  // variables
  //
  // If the global variable is already set with a value at the time of the mapping
  // then it is copied over to the real session variable before being mapped back
  // back again
  //
  // Parameters:
  // var_name - Name of session variable
  // map - true = map variable, false = unmap varaible
  //
  // Returns:
  // None
  function link_session_variable($var_name, $map)
  {
    if ($map)
    {
      // Map global to session variable. If the global variable is already set to some value
      // then its value overwrites the session variable. I **THINK** this is correct behaviour
      if (array_key_exists($var_name,$GLOBALS)) {
        $_SESSION[$var_name] =& $GLOBALS[$var_name];
      } else {
        $GLOBALS[$var_name] =& $_SESSION[$var_name];
      }
    }
    else
    {
      // Unmap global from session variable. Note that the global variable keeps the value of
      // the session variable. This should be unnecessary but it reflects the same behaviour
      // as having register_globals enabled, so in case the OSC code assumes this behaviour,
      // it is reproduced here
      $nothing = 0;
      $GLOBALS[$var_name] =& $nothing;
      unset($GLOBALS[$var_name]);
      $GLOBALS[$var_name] = $_SESSION[$var_name];
    }
  }
// <<< END REGISTER_GLOBALS

  function tep_session_id($sessid = '') {
    if ($sessid != '') {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function tep_session_name($name = '') {
    if ($name != '') {
      return session_name($name);
    } else {
      return session_name();
    }
  }

  function tep_session_close() {
// >>> BEGIN REGISTER_GLOBALS
    // Work-around to allow disabling of register_gloabls - unmap all defined
    // session variables
    if (count($_SESSION))
    {
      $session_keys = array_keys($_SESSION);
      foreach($session_keys as $variable)
      {
        link_session_variable($variable, false);
      }
    }

    if (function_exists('session_close')) {
      session_close();
    }
// <<< END REGISTER_GLOBALS
  }

  function tep_session_destroy() {
// >>> BEGIN REGISTER_GLOBALS
    // Work-around to allow disabling of register_gloabls - unmap all defined
    // session variables
    if (count($_SESSION))
    {
      $session_keys = array_keys($_SESSION);
      foreach($session_keys as $variable)
      {
        link_session_variable($variable, false);
        unset($_SESSION[$variable]);
      }
    }
// <<< END REGISTER_GLOBALS
    return session_destroy();
  }

  function tep_session_save_path($path = '') {
    if ($path != '') {
      return session_save_path($path);
    } else {
      return session_save_path();
    }
  }
?>
