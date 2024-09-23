<?php
/*
  $Id: whos_online.php,v 3.5 2008/06/13 SteveDallas Exp $

  2008 Jun 13 v3.5   Glen Hoag aka SteveDallas Moved hostname resolution to catalog/includes/functions/whos_online.php
                                                to reduce admin tool load
                                               Removed "manual bot detection" code.  Install latest spiders.txt instead
                                                http://addons.oscommerce.com/info/2455
                                               Moved version number out of language files; it is now appended to 
                                                HEADING_TITLE in this file.
                                               Changed refresh time and profile display to drop-down menus.
                                               Added "Show Bots" checkbox
                                               Fixed SQL Table name bug for non-standard tables, from v3.4.1 by lynkit
                                               The following changes are courtesy of Mike Challis (CRUZN8R):
                                               Cleaned up usage of get vars on refresh
                                               Added wordwrap to referer URL
                                               Added active customer count to summary
  2007 Dec 4  v3.3.2 Glen Hoag aka SteveDallas Removed bug introduced by previous contributor that 
                                                prevented cart display if STORE_SESSIONS was set to null
  2007 Dec 2  v3.3.1 Glen Hoag aka SteveDallas Minor fix to correct link for IP lookup
  2007 Dec 1  v3.3   Glen Hoag aka SteveDallas Many fixes for HTML 4.01 DTD conformance
                                               Rewrote product/category name display for robustness
                                               Added product/category name display for Ultimate SEO URLs
                                               Fixed gethostbyname errors 
                                               Rewrote duplicate counting code

  updated version number because of version number jumble and provide installation instructions.

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// Version number text
  $wo_version = '3.5';
/*
  Configuration Values
    Set these to easily personalize your Whos Online
*/

// Seconds that a visitor is considered "active"
  $active_time = 300;
// Seconds before visitor is removed from display
  $track_time = 900;

 // # mjc mike challis wordwrap referrer url
  $referrer_wordwrap_chars = 150; // <= set to number of characters to wrap to

// Automatic refresh times in seconds and display names
//   Time and Display Text order must match between the arrays
//   "None" is handled separately in the code
  $refresh_time = array(     30,    60,     120,     300,    600 );
  $refresh_display = array( '0:30', '1:00', '2:00', '5:00', '10:00' );
  $refresh_values = array();
  $refresh_values[] = array('id' => 'none', 'text' => TEXT_NONE_);
  $refresh_values[] = array('id' => '30', 'text' => '0:30');
  $refresh_values[] = array('id' => '60', 'text' => '1:00');
  $refresh_values[] = array('id' => '120', 'text' => '2:00');
  $refresh_values[] = array('id' => '300', 'text' => '5:00');
  $refresh_values[] = array('id' => '600', 'text' => '10:00');

  $show_type = array();
  $show_type[] = array('id' => '', 'text' => TEXT_NONE_);
  $show_type[] = array('id' => 'all', 'text' => TEXT_ALL);
  $show_type[] = array('id' => 'bots', 'text' => TEXT_BOTS);
  $show_type[] = array('id' => 'cust', 'text' => TEXT_CUSTOMERS);

// Images used for status lights
  $status_active_cart = 'icon_status_cart.png'; // replace word cart with green if you dont want the new icon.
  $status_active_cart_top = 'icon_status_cart_top.png';
  $status_inactive_cart = 'icon_status_red.png';
  $status_active_nocart = 'icon_status_green_light.png';
  $status_inactive_nocart = 'icon_status_red_light.png';
  $status_active_bot = 'icon_status_green_border_light.png';
  $status_inactive_bot = 'icon_status_red_border_light.png';

// Text color used for table entries - different colored text for different users
//   Named colors and Hex values should work fine here
  $fg_color_bot = 'maroon';
  $fg_color_admin = '#0000AC';
  $fg_color_guest = 'green';
  $fg_color_account = 'blue'; // '#000000'; // Black

// Added by Erick Cedano aka Graphicore.
// Previous versions required adding this function to admin/includes/functions/general.php
  if (!function_exists("tep_get_ip_address")) {
    function tep_get_ip_address($ip) {
      if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
      } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
          $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
          $ip = getenv('HTTP_CLIENT_IP');
        } else {
          $ip = getenv('REMOTE_ADDR');
        }
      }
      return $ip;
    }
  }

// Determines status and cart of visitor and displays appropriate icon.
  // mjc mike challis modified next line, added $the_ip for count active guests and customers feature
  function tep_check_cart($customer_id, $session_id, $the_ip) {
    global $cart, $status_active_cart, $status_active_cart_top, $status_inactive_cart, $status_active_nocart, $status_inactive_nocart, $status_inactive_bot, $status_active_bot, $active_time;
    // mjc added next line for count active guests and customers without duplicates
    global $ip_addrs_active;

    // Pull Session data from the correct source.

    if (STORE_SESSIONS == 'mysql') {
      $session_data = tep_db_query("select value from " . TABLE_SESSIONS . " WHERE sesskey = '" . $session_id . "'");
      $session_data = tep_db_fetch_array($session_data);
      $session_data = trim($session_data['value']);
    } else {
      if ((file_exists(tep_session_save_path() . '/sess_' . $session_id)) && (filesize(tep_session_save_path() . '/sess_' . $session_id) > 0)) {
        $session_data = file(tep_session_save_path() . '/sess_' . $session_id);
        $session_data = trim(implode('', $session_data));
      }
    }
    // mjc mike challis bof added to fix shopping cart indicator bug
    # the bug was .. When one of the visitors has an item in their cart,
    # every "customer" has the Active with Cart or Inactive with Cart icon blinking.

    $products =0;
    if ($length = strlen($session_data)) {
      #contents";a:0: <= no products in cart
      #contents";a:5: <= 5 products in cart
      preg_match('|contents";a:(\d+):|i',$session_data, $find);
      $products = $find[1];
    }
    // mjc mike challis eof added to fix shopping cart indicator bug

    $which_query = $session_data;
    $who_data =   tep_db_query("select time_entry, time_last_click
                                 from " . TABLE_WHOS_ONLINE . "
                                 where session_id='" . $session_id . "'");
    $who_query = tep_db_fetch_array($who_data);

    // Determine if visitor active/inactive
    $xx_mins_ago_long = (time() - $active_time);

    if($customer_id < 0) {
	// inactive 
      if ($who_query['time_last_click'] < $xx_mins_ago_long) {
        return tep_image(DIR_WS_IMAGES . $status_inactive_bot, TEXT_STATUS_INACTIVE_BOT);
	// active 
      } else {
        return tep_image(DIR_WS_IMAGES . $status_active_bot, TEXT_STATUS_ACTIVE_BOT);
      }
    }	

    // Determine active/inactive and cart/no cart status
    // no cart
    // mjc mike challis modified the next line to fix shopping cart indicator bug
    if ($products == 0 ) {
      // inactive
      if ($who_query['time_last_click'] < $xx_mins_ago_long) {
        return tep_image(DIR_WS_IMAGES . $status_inactive_nocart, TEXT_STATUS_INACTIVE_NOCART);
      // active
      } else {
            // mjc mike challis added next 3 lines for count active guests and customers without duplicates
            if (!in_array($the_ip,$ip_addrs_active)) {
             $the_ip != $_SERVER["REMOTE_ADDR"] and $ip_addrs_active[]=$the_ip;
            }
        return tep_image(DIR_WS_IMAGES . $status_active_nocart, TEXT_STATUS_ACTIVE_NOCART);
      }
    // cart
    } else {
      // inactive
      if ($who_query['time_last_click'] < $xx_mins_ago_long) {
        return tep_image(DIR_WS_IMAGES . $status_inactive_cart, TEXT_STATUS_INACTIVE_CART);
      // active
      } else {
        // mjc mike challis added next 3 lines for count active guests and customers without duplicates
            if (!in_array($the_ip,$ip_addrs_active)) {
             $the_ip != $_SERVER["REMOTE_ADDR"] and $ip_addrs_active[]=$the_ip;
            }
        return tep_image(DIR_WS_IMAGES . $status_active_cart, TEXT_STATUS_ACTIVE_CART);
      }
    }
  }

  /* Display the details about a visitor */
  function display_details() {
    global $whos_online, $is_bot, $is_admin, $is_guest, $is_account;
    // mjc mike challis added next line for wordwrap
    global $referrer_wordwrap_chars;

    // Display Name
    echo '<b>' . TABLE_HEADING_FULL_NAME . ':</b> ' . $whos_online['full_name'];
    echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';

    // Display Customer ID for non-bots
    if ( !$is_bot ){
      echo '<b>' . TABLE_HEADING_CUSTOMER_ID . ':</b> ' . $whos_online['customer_id'];
      echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';
    }

    //  original code of 2.8      :      echo '<b>' . TABLE_HEADING_IP_ADDRESS . ':</b> ' . $whos_online['ip_address'];  // commenter for whois by azer v1.9

    // Display IP Address modified by azer for 1.9, to be tested if it doesnt work comment the ligne using variable and uncomment the whois url hardcoded ligne
    // whois url hardcoded        :  
    echo '<b>' . TABLE_HEADING_IP_ADDRESS . ':</b> ' . "<a href='http://www.dnsstuff.com/tools/whois.ch?ip=$whos_online[ip_address]' target='_new'>" . $whos_online['ip_address'] . "</a>";
    // whois url with variable added in admin    :     echo '<b>' . TABLE_HEADING_IP_ADDRESS . ':</b> ' . "<a href='" . AZER_WHOSONLINE_WHOIS_URL . $whos_online['ip_address'] . "' target='_new'>" . $whos_online['ip_address'] . "</a>";

    echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';

    // Display User Agent
    echo '<b>' . TEXT_USER_AGENT . ':</b> ' . $whos_online['user_agent'];
    echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';

    // Display Session ID.  Bots with no Session ID, have it set to their IP address.  Don't display these.
    if ( $whos_online['session_id'] != $whos_online['ip_address'] ) {
      echo '<b>' . TEXT_OSCID . ':</b> ' . $whos_online['session_id'];
      echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';
    }

    // Display Referer if available
    // mjc mike challis wordwrap referrer
    if($whos_online['http_referer'] != "" ) {
      echo '<b>' . TABLE_HEADING_HTTP_REFERER . ':</b> ' . wordwrap(htmlspecialchars($whos_online['http_referer']), $referrer_wordwrap_chars, "<br />", true);
      echo '<br clear="all">' . tep_draw_separator('pixel_trans.png', '10', '4') . '<br clear="all">';
    }
  }

  // Time to remove old entries
  $xx_mins_ago = (time() - $track_time);

  // remove entries that have expired
  tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

<?php
  // WOL 1.6 - Cleaned up refresh
  // mjc mike challis bof - more standard use of get vars on refresh
  if(  isset($_GET['refresh'])&& is_numeric($_GET['refresh'])  ){  
    echo '<meta http-equiv="refresh" content="' . htmlspecialchars($_GET['refresh']) . ';URL=' . FILENAME_WHOS_ONLINE . '?' . htmlspecialchars($_SERVER["QUERY_STRING"]) . '">';
  }
  // mjc mike challis eof - more standard use of get vars on refresh
  // WOL 1.6 EOF
?>

    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <script type="text/javascript" src="includes/general.js"></script>
  </head>
  <body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2">
      <tr>
        <td width="<?php echo BOX_WIDTH; ?>" valign="top">
          <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
          </table>
        </td>
<!-- body_text //-->
        <td width="100%" valign="top">
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="bottom" class="pageHeading">
                      <?php echo HEADING_TITLE . " " . $wo_version; ?>
                      <br clear="all"><br />
                      <!-- Display Profile links -->
 
                      <table>
                        <tr>
                          <td class="smallText" align="left">
                            <?php 
                              echo tep_draw_form('update', FILENAME_WHOS_ONLINE, '', 'get');
                                if (isset($_GET['info'])) {echo tep_draw_hidden_field('info', $_GET['info']);}
                                echo TEXT_SET_REFRESH_RATE . ': ' . tep_draw_pull_down_menu('refresh', $refresh_values, '', 'onChange="this.form.submit();"') . '<br />';
                                echo TEXT_PROFILE_DISPLAY . ': ' . tep_draw_pull_down_menu('show', $show_type, '', 'onChange="this.form.submit();"') . '<br />';
                                echo TEXT_SHOW_BOTS . ': <input type="checkbox" name="bots" value="show" onChange="this.form.submit()"' . ($_GET['bots'] == 'show' ? ' checked="checked"': '') . '>';  ?>
                            </form>
                          </td>
                        </tr>
                      </table>          
                    </td>

                    <!-- Status Legend - Uses variables for image names -->
                    <td align="right" class="smallText" valign="bottom">
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_active_cart_top, TEXT_STATUS_ACTIVE_CART) . '&nbsp;' . TEXT_STATUS_ACTIVE_CART . '&nbsp;&nbsp;';?>
                          </td>
           	              <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_inactive_cart, TEXT_STATUS_INACTIVE_CART) . '&nbsp;' . TEXT_STATUS_INACTIVE_CART . '&nbsp;&nbsp;';?>
                          </td>
                        </tr>
                        <tr>
                          <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_active_nocart, TEXT_STATUS_ACTIVE_NOCART) . '&nbsp;' . TEXT_STATUS_ACTIVE_NOCART   .'&nbsp;&nbsp;';?>
                          </td>
           	              <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_inactive_nocart, TEXT_STATUS_INACTIVE_NOCART) . '&nbsp;' . TEXT_STATUS_INACTIVE_NOCART   . '&nbsp;&nbsp;';?>
                          </td>
                        </tr>
                        <tr>
                          <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_active_bot, TEXT_STATUS_ACTIVE_BOT) . '&nbsp;' . TEXT_STATUS_ACTIVE_BOT . '&nbsp;&nbsp;';?>
                          </td>
           	              <td class="smallText"><?php echo
                            tep_image(DIR_WS_IMAGES . $status_inactive_bot, TEXT_STATUS_INACTIVE_BOT) . '&nbsp;' . TEXT_STATUS_INACTIVE_BOT . '&nbsp;&nbsp;';?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td class="pageHeading" align="center">
                <font size="2" face="Arial" color="blue">
                  <script>
                    <!-- Begin
                    Stamp = new Date();
                    document.write('<?php echo TEXT_LAST_REFRESH. '&nbsp;'; ?>');
                    var Hours;
                    var Mins;
                    var Time;
                    Hours = Stamp.getHours();
                    if (Hours >= 12) {
                      Time = " p.m.";
                      Hours -= 12;
                    } else {
                      Time = " a.m.";
                    }
                    if (Hours == 0) {
                      Hours = 12;
                    }
                    Mins = Stamp.getMinutes();
                    if (Mins < 10) {
                      Mins = "0" + Mins;
                    }
                    document.write('&nbsp;' + Hours + ":" + Mins + Time );
                    // End -->
                  </script>
                </font>
              </td>
            </tr>
            <tr>
              <td valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="dataTableHeadingRow">
                          <td class="dataTableHeadingContent" colspan="2" nowrap align="center"><?php echo TABLE_HEADING_ONLINE; ?></td>
                          <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_FULL_NAME; ?></td>
                          <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_IP_ADDRESS; ?></td>
                          <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_ENTRY_TIME; ?></td>
                          <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_LAST_CLICK; ?></td>
                          <td class="dataTableHeadingContent" width="200"><?php echo TABLE_HEADING_LAST_PAGE_URL; ?>&nbsp;</td>
                          <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_USER_SESSION; ?>&nbsp;</td>
                          <td class="dataTableHeadingContent" align="center" nowrap><?php echo TABLE_HEADING_HTTP_REFERER; ?>&nbsp;</td>
                        </tr>

<?php
  // Order by is on Last Click. Also initialize total_bots and total_admin counts
  $whos_online_query = tep_db_query("select customer_id, full_name, ip_address, hostname, time_entry, time_last_click, last_page_url, http_referer, user_agent, session_id from " . TABLE_WHOS_ONLINE . ' order by time_last_click DESC');
  $total_bots = 0;
  $total_admin = 0;
  $total_guests = 0;
  $total_loggedon = 0;
  $total_dupes = 0;
  // mjc added next line for count active guests and customers feature
  $ip_addrs_active = array();
  $ip_addrs = array();
  // mjc added next line to force info from the get var
  isset($_GET['info']) and $info = $_GET['info'];
  while ($whos_online = tep_db_fetch_array($whos_online_query)) {
    $time_online = ($whos_online['time_last_click'] - $whos_online['time_entry']);
    if ((!isset($_GET['info']) || (isset($_GET['info']) && ($_GET['info'] == $whos_online['session_id']))) && !isset($info)) {
      $info = $whos_online['session_id'];
    }

    $hostname = $whos_online['hostname'];

    //Check for duplicates
    if (in_array($whos_online['ip_address'],$ip_addrs)) {$total_dupes++;};
    $ip_addrs[] = $whos_online['ip_address'];

    if ($whos_online['session_id'] == $info) {
       if($whos_online['http_referer'] != "")
       {
        $http_referer_url = $whos_online['http_referer'];
       }
      // mjc added "onclick" to allow refresh by clicking on selected row
      echo '
                        <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_WHOS_ONLINE, tep_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online['session_id'], 'NONSSL') . '\'">' . "\n";
    } else {
      echo '
                        <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_WHOS_ONLINE, tep_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online['session_id'], 'NONSSL') . '\'">' . "\n";
    }

    // Display Status
    //   Check who it is and set values
    $is_bot = $is_admin = $is_guest = $is_account = false;

    if ($whos_online['customer_id'] < 0) {  
      $total_bots++;
      $fg_color = $fg_color_bot;
      $is_bot = true;

      // Admin detection
//    } elseif ($whos_online['ip_address'] == tep_get_ip_address() ) {
    } elseif ($whos_online['ip_address'] == $_SERVER["REMOTE_ADDR"]) {
      $total_admin++;
      $fg_color = $fg_color_admin;
      $is_admin = true;
    // Guest detection (may include Bots not detected by Prevent Spider Sessions/spiders.txt)
    } elseif ($whos_online['customer_id'] == 0) {
      $fg_color = $fg_color_guest;
      $is_guest = true;
      $total_guests++;
    // Everyone else (should only be account holders)
    } else {
      $fg_color = $fg_color_account;
      $is_account = true;
      $total_loggedon++;
    }

    if (!($is_bot && !isset($_GET['bots']))) {
?>
                          <!-- Status Light -->
<?php
                          // mjc mike challis added ,$whos_online['ip_address'] for count active guests and customers without duplicates feature
?>
                          <td class="dataTableContent" align="left" valign="top"><?php echo '&nbsp;' . tep_check_cart($whos_online['customer_id'], $whos_online['session_id'], $whos_online['ip_address']); ?></td>

                          <!-- Time Online -->
                          <td class="dataTableContent" valign="top"><font color="<?php echo $fg_color; ?>"><?php echo gmdate('H:i:s', $time_online); ?></font>&nbsp;</td>

                          <!-- Name -->
                          <?php
                          echo '
                          <td class="dataTableContent" valign="top"><font color="' . $fg_color .'">';

                          // WOL 1.6 Restructured to Check for Guest or Admin
                          if ( $is_guest || $is_admin ){
                            echo $whos_online['full_name'] . '&nbsp;';
                          // Check for Bot
                          } elseif ( $is_bot ) {
                            // Tokenize UserAgent and try to find Bots name
                            $tok = strtok($whos_online['full_name']," ();/");
                            while ($tok !== false) {  // edited from forum perfectpassion
                              if ( strlen(strtolower($tok)) > 3 )
                                if ( !strstr(strtolower($tok), "mozilla") &&
                                     !strstr(strtolower($tok), "compatible") &&
                                     !strstr(strtolower($tok), "msie") &&
                                     !strstr(strtolower($tok), "windows")
                                   ) {
                                  echo "$tok";
                                  break;
                                }
                              $tok = strtok(" ();/");
                            }
                          // Check for Account
                          } elseif ( $is_account ) {
                            echo '<a HREF="customers.php?selected_box=customers&cID=' . $whos_online['customer_id'] . '&action=edit">';
                            echo '<font color="' . $fg_color . '">' . $whos_online['full_name'] . '</font></a>';
                          } else {
                            echo TEXT_ERROR;
                          }
                          echo '</font></td>';
                          ?>

                          <!-- IP Address -->
                          <td class="dataTableContent" valign="top"> 
                            <?php
                            // Show 'Admin' instead of IP for Admin
                            if ( $is_admin ) {
                              echo '<font color="' . $fg_color . '">' . TEXT_ADMIN . '</font>' . "\n";
                            } elseif ( $hostname == 'unknown' ) {
                              echo '<font color="' . $fg_color . '">' . $hostname . '</font>' . "\n";
                            } else {
                              echo '<a href="http://www.showmyip.com/?ip=' . $whos_online['ip_address'] . '&amp;get=nmap" target="_blank">';
                              echo '<font color="' . $fg_color . '">' . $hostname . '</font></a>' . "\n";
                            }
                            ?>
                          </td>

                          <!-- Time Entry -->
                          <td class="dataTableContent" valign="top"><font color="<?php echo $fg_color; ?>"><?php echo date('H:i:s', $whos_online['time_entry']); ?></font></td>

                          <!-- Last Click -->
                          <td class="dataTableContent" align="center" valign="top"><font color="<?php echo $fg_color; ?>"><?php echo date('H:i:s', $whos_online['time_last_click']); ?></font>&nbsp;</td>

                          <!-- Last URL -->
                          <td class="dataTableContent" valign="top"><?php
                            $temp_url_link = $whos_online['last_page_url'];
                            if (eregi('^(.*)' . tep_session_name() . '=[a-f,0-9]+[&]*(.*)', $whos_online['last_page_url'], $array)) {
                              $temp_url_display =  $array[1] . $array[2];
                            } else {
                              $temp_url_display = $whos_online['last_page_url'];
                            }

                            // WOL 1.6 - Removes osCsid from the Last Click URL and the link
                            if ( $osCsid_position = strpos($temp_url_display, "osCsid") )
                              $temp_url_display = substr_replace($temp_url_display, "", $osCsid_position - 1 );
                            if ( $osCsid_position = strpos($temp_url_link, "osCsid") )
                              $temp_url_link = substr_replace($temp_url_link, "", $osCsid_position - 1 );

                            // escape any special characters to conform to HTML DTD
                            $temp_url_display = htmlspecialchars($temp_url_display);

                            // alteration for last url product name  bof
                            if (strpos($temp_url_link,'product_info.php')) {
                              if (strpos($temp_url_link,'products_id=')) {
                                //Standard osC install using parameters
                                $temp = strstr($temp_url_link,'?');
                                $temp=str_replace('?','',$temp);
                                $parameters=split("&",$temp);

                                $i=0;
                                while($i < count($parameters)) {
                                  $a=split("=",$parameters[$i]);
                                  if ($a[0]=="products_id") { $products_id=$a[1]; }
                                  $i++;
                                }
                              } elseif (strpos($temp_url_link,'products_id/')) {
                                //osC search-engine safe URL
                                $temp = strstr($temp_url_link,'products_id');
                                $temparr=split("\/",$temp);
                                $products_id=$temparr[1];
                              } else {
                                //couldn't figure it out
                                $products_id = '';
                              }
                              if ($products_id) {
                                $product_query=tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION. " where products_id='" . $products_id . "' and language_id = '" . $languages_id . "'");
                                $product = tep_db_fetch_array($product_query);
                                $display_link = $product['products_name'].' <i>(Product)</i>';
                              } else {
                                $display_link = $temp_url_display;
                              }
                            } elseif (strpos($temp_url_link,'cPath')) {
                              if (strpos($temp_url_link,'cPath=')) {
                                //Standard osC install using parameters
                                $temp = strstr($temp_url_link,'?');
                                $temp=str_replace('?','',$temp);
                                $parameters=split("&",$temp);

                                $i=0;
                                while($i < count($parameters)) {
                                  $a=split("=",$parameters[$i]);
                                  if ($a[0]=="cPath") { $cat=$a[1]; }
                                  $i++;
                                }
                              } elseif (strpos($temp_url_link,'cPath/')) {
                                //osC search-engine safe URL
                                $temp = strstr($temp_url_link,'cPath');
                                $temparr=split("\/",$temp);
                                $cat=$temparr[1];
                              } else {
                                //couldn't figure it out
                                $cat = '';
                              }

                              $parameters=split("_",$cat);
 
                              $i=0;
                              while($i < count($parameters)) {
                                $category_query=tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id='" . $parameters[$i] . "' and language_id = '" . $languages_id . "'");
                                $category = tep_db_fetch_array($category_query);
                                if ($i>0) { $cat_list.=' / ' . $category['categories_name']; } else { $cat_list=$category['categories_name']; }

                                $i++;
                              }
                              $display_link = $cat_list.' <i>(Category)</i>';
                            } else {
                              $display_link = $temp_url_display;
                            }

                            // alteration for last url product name  eof
 
                            // Get product and category from Ultimate SEO URLs bof
                            if ( preg_match('/^(.*)-p-(.*).html/',$temp_url_link,$matches) ) {
                              $products_id=$matches[2];
                              $product_query=tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id='" . $products_id . "' and language_id = '" . $languages_id . "'");
                              $product = tep_db_fetch_array($product_query);

                              $display_link = $product['products_name'].' <i>(Product)</i>';
                            } elseif ( preg_match('/^(.*)-c-(.*).html/',$temp_url_link,$matches) ) {
                              $cat=$matches[2];
                              $parameters=split("_",$cat);

                              $i=0;
                              while($i < count($parameters)) {
                                $category_query=tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id='" . $parameters[$i] . "' and language_id = '" . $languages_id . "'");
                                $category = tep_db_fetch_array($category_query);
                                if ($i>0) { $cat_list.=' / '.$category['categories_name']; } else { $cat_list=$category['categories_name']; }

                                $i++;
                              }
                              $display_link = $cat_list.' <i>(Category)</i>';
                            }
                            // Get product and category from Ultimate SEO URLs eof

                            echo '<a HREF="' . (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . htmlspecialchars($temp_url_link) . '" target="_blank"><font color="' . $fg_color . '">' . $display_link . '</font></a></td>';
                          ?>

                          <!-- osCsid? -->
                          <td class="dataTableContent" align="center" valign="top"><font color="<?php echo $fg_color; ?>"><?php echo (($whos_online['session_id'] != $whos_online['ip_address']) ? TEXT_IN_SESSION : TEXT_NO_SESSION);?></font></td>

                          <!-- Referer? -->
                          <td class="dataTableContent" align="center" valign="top"><font color="<?php echo $fg_color; ?>"><?php echo (($whos_online['http_referer'] == "") ? TEXT_HTTP_REFERER_NOT_FOUND : TEXT_HTTP_REFERER_FOUND);?></font></td>
                        </tr>

                      <?php
                        // mjc mchallis modified next line for more standard use of query get vars
                        if (($_GET['show'] == 'all') || (($_GET['show'] == 'bots') && $is_bot) || (($_GET['show'] == 'cust') && ( $is_guest || $is_account || $is_admin )) ) {
                      ?>
                        <tr class="dataTableRow">
                          <td class="dataTableContent" colspan="3"></td>
                          <td class="dataTableContent" colspan="6"><font color="<?php echo $fg_color; ?>"><?php display_details(); ?></font></td>
                        </tr>
                      <?php
                        }
    } // closes "if $isbot statement
  } // closes "while" statement
                      ?>
<?php
  //Display HTTP referer, if any
  // mjc mike challis added wordwrap to referrer url
  if(isset($http_referer_url)) {
?>
                        <tr>
	                    <td class="smallText" colspan="9"><?php echo '<strong>' . TEXT_HTTP_REFERER_URL . ':</strong><a href="' . htmlspecialchars($http_referer_url) . '" target="_blank">' . wordwrap(htmlspecialchars($http_referer_url), $referrer_wordwrap_chars, "<br />", true) . '</a>'; ?></td>
                        </tr>
<?php
  }
?>
<?php
  $total_sess = tep_db_num_rows($whos_online_query);
  // Subtract Bots and Me from Real Customers.  Only subtract me once as Dupes will remove others
  $total_cust = $total_sess - $total_dupes - $total_bots - ($total_admin > 1? 1 : $total_admin);
?>
                        <tr>
                          <!-- WOL 1.4 - Added Bot and Me counts -->
                          <td class="smallText" colspan="9"><br />
                            <table border="0" cellpadding="0" cellspacing="0" width="600">
                              <tr>
		                    <td class="smallText" align="left" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, $total_sess);?></td>
	                        </tr>
	                        <tr>
		                    <td class="smallText" align="right" width="30"><?php print "$total_dupes" ?></td>
		                    <td class="smallText" align="left" width="570">&nbsp;&nbsp;<?php echo TEXT_DUPLICATE_IP; ?></td>
	                        </tr>
	                        <tr>
		                    <td class="smallText" align="right" width="30"><?php print "$total_bots" ?></td>
		                    <td class="smallText" width="570">&nbsp;&nbsp;<?php echo TEXT_BOTS; ?></td>
	                        </tr>
	                        <tr>
                                <td class="smallText" align="right" width="30"><?php print "$total_admin" ?></td>
                                <td class="smallText" width="570">&nbsp;&nbsp;<?php echo TEXT_ME; ?></td>
                              </tr>
                              <tr>
                                <td class="smallText" align="right" width="30"><?php print "$total_cust" ?></td>
                                <td class="smallText" width="570">&nbsp;&nbsp;<?php echo TEXT_REAL_CUSTOMERS; if(count($ip_addrs_active) > 0) echo ', <font color="' . $fg_color_guest . '">' . count($ip_addrs_active) . TEXT_ACTIVE_CUSTOMERS . '</font>'; ?></td>
                              </tr>
                            </table><br />
                            <?php echo "<b>" . TEXT_MY_IP_ADDRESS . ":</b>&nbsp;".$_SERVER["REMOTE_ADDR"]; ?><br />
                            <?php echo TEXT_NOT_AVAILABLE;?>
                          </td>
                          <!-- WOL 1.4 eof -->
                        </tr>
                      </table>
                    </td>

<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text' => '<b>' . TABLE_HEADING_SHOPPING_CART . '</b>');
  // mjc mchallis modified next line to get $info from get vars
  if (  isset($_GET['info']) and $info = $_GET['info'] ) {
    if (STORE_SESSIONS == 'mysql') { 
      $session_data = tep_db_query("select value from " . TABLE_SESSIONS . " WHERE sesskey = '" . $info . "'");
      $session_data = tep_db_fetch_array($session_data);
      $session_data = trim($session_data['value']);
    } else {
      if ( (file_exists(tep_session_save_path() . '/sess_' . $info)) && (filesize(tep_session_save_path() . '/sess_' . $info) > 0) ) {
        $session_data = file(tep_session_save_path() . '/sess_' . $info);
        $session_data = trim(implode('', $session_data));
      }
    }
    if ($length = strlen($session_data)) {

      if (PHP_VERSION < 4) {
        $start_cart = strpos($session_data, 'cart[==]o');
        $start_currency = strpos($session_data, 'currency[==]s');
      } else {
        $start_cart = strpos($session_data, 'cart|O');
        $start_currency = strpos($session_data, 'currency|s');
      }

      for ($i=$start_cart; $i<$length; $i++) {
        if ($session_data[$i] == '{') {
          if (isset($tag)) {
            $tag++;
          } else {
            $tag = 1;
          }
        } elseif ($session_data[$i] == '}') {
          $tag--;
        } elseif ( (isset($tag)) && ($tag < 1) ) {
          break;
        }
      }

      $session_data_cart = substr($session_data, $start_cart, $i);
      $session_data_currency = substr($session_data, $start_currency, (strpos($session_data, ';', $start_currency) - $start_currency + 1));

      session_decode($session_data_cart);
      session_decode($session_data_currency);

      if (PHP_VERSION < 4) {
        $broken_cart = $cart;
        $cart = new shoppingCart;
        $cart->unserialize($broken_cart);
      }

      if (is_object($cart)) {
        $products = $cart->get_products();
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
          $contents[] = array('text' => $products[$i]['quantity'] . ' x ' . $products[$i]['name']);
        }
        if (sizeof($products) > 0) {
          $contents[] = array('text' => tep_draw_separator('pixel_black.png', '100%', '1'));
          $contents[] = array('align' => 'right', 'text' => TEXT_SHOPPING_CART_SUBTOTAL . ' ' . $currencies->format($cart->show_total(), true, $currency));
        } else {
          $contents[] = array('text' => '<i>' . TEXT_EMPTY . '</i>');
        }
      }
    }
  }
   // Show shopping cart contents for selected entry
?>
                    <td valign="top">
 <?php
  $box = new box;
   echo $box->infoBox($heading, $contents);
?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
<!-- body_text_eof //-->
      </tr>
    </table>
<!-- body_eof //-->

<!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
    <br />
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>