<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

require 'includes/classes/currencies.php';
$currencies = new currencies();

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'insert':
        case 'save':
            if (isset($_GET['cID'])) {
                $currency_id = tep_db_prepare_input($_GET['cID']);
            }

            $title = tep_db_prepare_input($_POST['title']);
            $code = tep_db_prepare_input($_POST['code']);
            $symbol_left = tep_db_prepare_input($_POST['symbol_left']);
            $symbol_right = tep_db_prepare_input($_POST['symbol_right']);
            $decimal_point = tep_db_prepare_input($_POST['decimal_point']);
            $thousands_point = tep_db_prepare_input($_POST['thousands_point']);
            $decimal_places = tep_db_prepare_input($_POST['decimal_places']);
            $value = tep_db_prepare_input($_POST['value']);

            $sql_data_array = ['title' => $title,
                'code' => $code,
                'symbol_left' => $symbol_left,
                'symbol_right' => $symbol_right,
                'decimal_point' => $decimal_point,
                'thousands_point' => $thousands_point,
                'decimal_places' => $decimal_places,
                'value' => $value];

            if ($action === 'insert') {
                tep_db_perform('currencies', $sql_data_array);
                $currency_id = tep_db_insert_id();
            } elseif ($action === 'save') {
                tep_db_perform('currencies', $sql_data_array, 'update', "currencies_id = '".(int) $currency_id."'");
            }

            if (isset($_POST['default']) && ($_POST['default'] === 'on')) {
                tep_db_query("update configuration set configuration_value = '".tep_db_input($code)."' where configuration_key = 'DEFAULT_CURRENCY'");
            }

            tep_redirect(tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$currency_id));

            break;
        case 'deleteconfirm':
            $currencies_id = tep_db_prepare_input($_GET['cID']);

            $currency_query = tep_db_query("select currencies_id from currencies where code = '".tep_db_input(DEFAULT_CURRENCY)."'");
            $currency = tep_db_fetch_array($currency_query);

            if ($currency['currencies_id'] === $currencies_id) {
                tep_db_query("update configuration set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
            }

            tep_db_query("delete from currencies where currencies_id = '".(int) $currencies_id."'");

            tep_redirect(tep_href_link('currencies.php', 'page='.$_GET['page']));

            break;
        case 'update':
            $server_used = CURRENCY_SERVER_PRIMARY;

            $currency_query = tep_db_query('select currencies_id, code, title from currencies');

            while ($currency = tep_db_fetch_array($currency_query)) {
                $quote_function = 'quote_'.CURRENCY_SERVER_PRIMARY.'_currency';
                $rate = $quote_function($currency['code']);

                if (empty($rate) && (!empty(CURRENCY_SERVER_BACKUP))) {
                    $messageStack->add_session(sprintf(WARNING_PRIMARY_SERVER_FAILED, CURRENCY_SERVER_PRIMARY, $currency['title'], $currency['code']), 'warning');

                    $quote_function = 'quote_'.CURRENCY_SERVER_BACKUP.'_currency';
                    $rate = $quote_function($currency['code']);

                    $server_used = CURRENCY_SERVER_BACKUP;
                }

                if (!empty($rate)) {
                    tep_db_query("update currencies set value = '".tep_db_input($rate)."', last_updated = now() where currencies_id = '".(int) $currency['currencies_id']."'");

                    $messageStack->add_session(sprintf(TEXT_INFO_CURRENCY_UPDATED, $currency['title'], $currency['code'], $server_used), 'success');
                } else {
                    $messageStack->add_session(sprintf(ERROR_CURRENCY_INVALID, $currency['title'], $currency['code'], $server_used), 'error');
                }
            }

            tep_redirect(tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$_GET['cID']));

            break;
        case 'delete':
            $currencies_id = tep_db_prepare_input($_GET['cID']);

            $currency_query = tep_db_query("select code from currencies where currencies_id = '".(int) $currencies_id."'");
            $currency = tep_db_fetch_array($currency_query);

            $remove_currency = true;

            if ($currency['code'] === DEFAULT_CURRENCY) {
                $remove_currency = false;
                $messageStack->add(ERROR_REMOVE_DEFAULT_CURRENCY, 'error');
            }

            break;
    }
}

$currency_select = ['USD' => ['title' => 'U.S. Dollar', 'code' => 'USD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'EUR' => ['title' => 'Euro', 'code' => 'EUR', 'symbol_left' => '', 'symbol_right' => '€', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'JPY' => ['title' => 'Japanese Yen', 'code' => 'JPY', 'symbol_left' => '¥', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'GBP' => ['title' => 'Pounds Sterling', 'code' => 'GBP', 'symbol_left' => '£', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'CHF' => ['title' => 'Swiss Franc', 'code' => 'CHF', 'symbol_left' => '', 'symbol_right' => 'CHF', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'AUD' => ['title' => 'Australian Dollar', 'code' => 'AUD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'CAD' => ['title' => 'Canadian Dollar', 'code' => 'CAD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'SEK' => ['title' => 'Swedish Krona', 'code' => 'SEK', 'symbol_left' => '', 'symbol_right' => 'kr', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'HKD' => ['title' => 'Hong Kong Dollar', 'code' => 'HKD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'NOK' => ['title' => 'Norwegian Krone', 'code' => 'NOK', 'symbol_left' => 'kr', 'symbol_right' => '', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'NZD' => ['title' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'MXN' => ['title' => 'Mexican Peso', 'code' => 'MXN', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'SGD' => ['title' => 'Singapore Dollar', 'code' => 'SGD', 'symbol_left' => '$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'BRL' => ['title' => 'Brazilian Real', 'code' => 'BRL', 'symbol_left' => 'R$', 'symbol_right' => '', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'CNY' => ['title' => 'Chinese RMB', 'code' => 'CNY', 'symbol_left' => '￥', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'CZK' => ['title' => 'Czech Koruna', 'code' => 'CZK', 'symbol_left' => '', 'symbol_right' => 'Kč', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'DKK' => ['title' => 'Danish Krone', 'code' => 'DKK', 'symbol_left' => '', 'symbol_right' => 'kr', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'HUF' => ['title' => 'Hungarian Forint', 'code' => 'HUF', 'symbol_left' => '', 'symbol_right' => 'Ft', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'ILS' => ['title' => 'Israeli New Shekel', 'code' => 'ILS', 'symbol_left' => '₪', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'INR' => ['title' => 'Indian Rupee', 'code' => 'INR', 'symbol_left' => 'Rs.', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'MYR' => ['title' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol_left' => 'RM', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'PHP' => ['title' => 'Philippine Peso', 'code' => 'PHP', 'symbol_left' => 'Php', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'PLN' => ['title' => 'Polish Zloty', 'code' => 'PLN', 'symbol_left' => '', 'symbol_right' => 'zł', 'decimal_point' => ',', 'thousands_point' => '.', 'decimal_places' => '2'],
    'THB' => ['title' => 'Thai Baht', 'code' => 'THB', 'symbol_left' => '', 'symbol_right' => '฿', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2'],
    'TWD' => ['title' => 'Taiwan New Dollar', 'code' => 'TWD', 'symbol_left' => 'NT$', 'symbol_right' => '', 'decimal_point' => '.', 'thousands_point' => ',', 'decimal_places' => '2']];

$currency_select_array = [['id' => '', 'text' => TEXT_INFO_COMMON_CURRENCIES]];

foreach ($currency_select as $cs) {
    if (!isset($currencies->currencies[$cs['code']])) {
        $currency_select_array[] = ['id' => $cs['code'], 'text' => '['.$cs['code'].'] '.$cs['title']];
    }
}

require 'includes/template_top.php';
?>

<script>
var currency_select = new Array();
<?php
  foreach ($currency_select_array as $cs) {
      if (!empty($cs['id'])) {
          echo 'currency_select["'.$cs['id'].'"] = new Array("'.$currency_select[$cs['id']]['title'].'", "'.$currency_select[$cs['id']]['symbol_left'].'", "'.$currency_select[$cs['id']]['symbol_right'].'", "'.$currency_select[$cs['id']]['decimal_point'].'", "'.$currency_select[$cs['id']]['thousands_point'].'", "'.$currency_select[$cs['id']]['decimal_places'].'");'."\n";
      }
  }

?>

function updateForm() {
  var cs = document.forms["currencies"].cs[document.forms["currencies"].cs.selectedIndex].value;

  document.forms["currencies"].title.value = currency_select[cs][0];
  document.forms["currencies"].code.value = cs;
  document.forms["currencies"].symbol_left.value = currency_select[cs][1];
  document.forms["currencies"].symbol_right.value = currency_select[cs][2];
  document.forms["currencies"].decimal_point.value = currency_select[cs][3];
  document.forms["currencies"].thousands_point.value = currency_select[cs][4];
  document.forms["currencies"].decimal_places.value = currency_select[cs][5];
  document.forms["currencies"].value.value = 1;
}
</script>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CURRENCY_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CURRENCY_CODES; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_CURRENCY_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $currency_query_raw = 'select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, last_updated, value from currencies order by title';
$currency_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $currency_query_raw, $currency_query_numrows);
$currency_query = tep_db_query($currency_query_raw);

while ($currency = tep_db_fetch_array($currency_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] === $currency['currencies_id']))) && !isset($cInfo) && (substr($action, 0, 3) !== 'new')) {
        $cInfo = new objectInfo($currency);
    }

    if (isset($cInfo) && \is_object($cInfo) && ($currency['currencies_id'] === $cInfo->currencies_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=edit').'\'">'."\n";
    } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$currency['currencies_id']).'\'">'."\n";
    }

    if (DEFAULT_CURRENCY === $currency['code']) {
        echo '                <td class="dataTableContent"><strong>'.$currency['title'].' ('.TEXT_DEFAULT.")</strong></td>\n";
    } else {
        echo '                <td class="dataTableContent">'.$currency['title']."</td>\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $currency['code']; ?></td>
                <td class="dataTableContent" align="right"><?php echo number_format($currency['value'], 8); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && \is_object($cInfo) && ($currency['currencies_id'] === $cInfo->currencies_id)) {
                    echo tep_image('images/icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$currency['currencies_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $currency_split->display_count($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CURRENCIES); ?></td>
                    <td class="smallText" align="right"><?php echo $currency_split->display_links($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr>
                    <td class="smallText"><?php if (CURRENCY_SERVER_PRIMARY) {
                        echo tep_draw_button(IMAGE_UPDATE_CURRENCIES, 'refresh', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=update'));
                    }

      ?></td>
                    <td class="smallText" align="right"><?php echo tep_draw_button(IMAGE_NEW_CURRENCY, 'plus', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=new')); ?></td>
                  </tr>
<?php
  }

?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'new':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_CURRENCY.'</strong>'];

        $contents = ['form' => tep_draw_form('currencies', 'currencies.php', 'page='.$_GET['page'].(isset($cInfo) ? '&cID='.$cInfo->currencies_id : '').'&action=insert')];
        $contents[] = ['text' => TEXT_INFO_INSERT_INTRO];
        $contents[] = ['text' => '<br />'.tep_draw_pull_down_menu('cs', $currency_select_array, '', 'onchange="updateForm();"')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_TITLE.'<br />'.tep_draw_input_field('title')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_CODE.'<br />'.tep_draw_input_field('code')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_SYMBOL_LEFT.'<br />'.tep_draw_input_field('symbol_left')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_SYMBOL_RIGHT.'<br />'.tep_draw_input_field('symbol_right')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_DECIMAL_POINT.'<br />'.tep_draw_input_field('decimal_point')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_THOUSANDS_POINT.'<br />'.tep_draw_input_field('thousands_point')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_DECIMAL_PLACES.'<br />'.tep_draw_input_field('decimal_places')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_VALUE.'<br />'.tep_draw_input_field('value')];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_INFO_SET_AS_DEFAULT];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$_GET['cID']))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_CURRENCY.'</strong>'];

        $contents = ['form' => tep_draw_form('currencies', 'currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=save')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_TITLE.'<br />'.tep_draw_input_field('title', $cInfo->title)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_CODE.'<br />'.tep_draw_input_field('code', $cInfo->code)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_SYMBOL_LEFT.'<br />'.tep_draw_input_field('symbol_left', $cInfo->symbol_left)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_SYMBOL_RIGHT.'<br />'.tep_draw_input_field('symbol_right', $cInfo->symbol_right)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_DECIMAL_POINT.'<br />'.tep_draw_input_field('decimal_point', $cInfo->decimal_point)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_THOUSANDS_POINT.'<br />'.tep_draw_input_field('thousands_point', $cInfo->thousands_point)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_DECIMAL_PLACES.'<br />'.tep_draw_input_field('decimal_places', $cInfo->decimal_places)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_VALUE.'<br />'.tep_draw_input_field('value', $cInfo->value)];

        if (DEFAULT_CURRENCY !== $cInfo->code) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_INFO_SET_AS_DEFAULT];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_CURRENCY.'</strong>'];

        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$cInfo->title.'</strong>'];
        $contents[] = ['align' => 'center', 'text' => '<br />'.(($remove_currency) ? tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=deleteconfirm'), 'primary') : '').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id))];

        break;

    default:
        if (\is_object($cInfo)) {
            $heading[] = ['text' => '<strong>'.$cInfo->title.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('currencies.php', 'page='.$_GET['page'].'&cID='.$cInfo->currencies_id.'&action=delete'))];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_TITLE.' '.$cInfo->title];
            $contents[] = ['text' => TEXT_INFO_CURRENCY_CODE.' '.$cInfo->code];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_SYMBOL_LEFT.' '.$cInfo->symbol_left];
            $contents[] = ['text' => TEXT_INFO_CURRENCY_SYMBOL_RIGHT.' '.$cInfo->symbol_right];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_DECIMAL_POINT.' '.$cInfo->decimal_point];
            $contents[] = ['text' => TEXT_INFO_CURRENCY_THOUSANDS_POINT.' '.$cInfo->thousands_point];
            $contents[] = ['text' => TEXT_INFO_CURRENCY_DECIMAL_PLACES.' '.$cInfo->decimal_places];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_LAST_UPDATED.' '.tep_date_short($cInfo->last_updated)];
            $contents[] = ['text' => TEXT_INFO_CURRENCY_VALUE.' '.number_format($cInfo->value, 8)];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENCY_EXAMPLE.'<br />'.$currencies->format('30', false, DEFAULT_CURRENCY).' = '.$currencies->format('30', true, $cInfo->code)];
        }

        break;
}

if ((!empty($heading)) && (!empty($contents))) {
    echo '            <td width="25%" valign="top">'."\n";

    $box = new box();
    echo $box->infoBox($heading, $contents);

    echo "            </td>\n";
}

?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
