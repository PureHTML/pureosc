<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

function tep_dt_get_tables()
{
    $result = [];

    $tables_query = tep_db_query('show table status');

    while ($tables = tep_db_fetch_array($tables_query)) {
        $result[] = $tables['Name'];
    }

    return $result;
}

$mysql_charsets = [['id' => 'auto', 'text' => ACTION_UTF8_CONVERSION_FROM_AUTODETECT]];

$charsets_query = tep_db_query('show character set');

while ($charsets = tep_db_fetch_array($charsets_query)) {
    $mysql_charsets[] = ['id' => $charsets['Charset'], 'text' => sprintf(ACTION_UTF8_CONVERSION_FROM, $charsets['Charset'])];
}

$action = null;
$actions = [['id' => 'check',
    'text' => ACTION_CHECK_TABLES],
    ['id' => 'analyze',
        'text' => ACTION_ANALYZE_TABLES],
    ['id' => 'optimize',
        'text' => ACTION_OPTIMIZE_TABLES],
    ['id' => 'repair',
        'text' => ACTION_REPAIR_TABLES],
    ['id' => 'utf8',
        'text' => ACTION_UTF8_CONVERSION]];

if (isset($_POST['action'])) {
    if (\in_array($_POST['action'], ['check', 'analyze', 'optimize', 'repair', 'utf8'], true)) {
        if (isset($_POST['id']) && \is_array($_POST['id']) && !empty($_POST['id'])) {
            $tables = tep_dt_get_tables();

            foreach ($_POST['id'] as $key => $value) {
                if (!\in_array($value, $tables, true)) {
                    unset($_POST['id'][$key]);
                }
            }

            if (!empty($_POST['id'])) {
                $action = $_POST['action'];
            }
        }
    }
}

switch ($action) {
    case 'check':
    case 'analyze':
    case 'optimize':
    case 'repair':
        tep_set_time_limit(0);

        $table_headers = [TABLE_HEADING_TABLE,
            TABLE_HEADING_MSG_TYPE,
            TABLE_HEADING_MSG,
            tep_draw_checkbox_field('masterblaster')];

        $table_data = [];

        foreach ($_POST['id'] as $table) {
            $current_table = null;

            $sql_query = tep_db_query($action.' table '.$table);

            while ($sql = tep_db_fetch_array($sql_query)) {
                $table_data[] = [($table !== $current_table) ? tep_output_string_protected($table) : '',
                    tep_output_string_protected($sql['Msg_type']),
                    tep_output_string_protected($sql['Msg_text']),
                    ($table !== $current_table) ? tep_draw_checkbox_field('id[]', $table, isset($_POST['id']) && \in_array($table, $_POST['id'], true)) : ''];

                $current_table = $table;
            }
        }

        break;
    case 'utf8':
        $charset_pass = false;

        if (isset($_POST['from_charset'])) {
            if ($_POST['from_charset'] === 'auto') {
                $charset_pass = true;
            } else {
                foreach ($mysql_charsets as $c) {
                    if ($_POST['from_charset'] === $c['id']) {
                        $charset_pass = true;

                        break;
                    }
                }
            }
        }

        if ($charset_pass === false) {
            tep_redirect(tep_href_link('database_tables.php'));
        }

        tep_set_time_limit(0);

        if (isset($_POST['dryrun'])) {
            $table_headers = [TABLE_HEADING_QUERIES];
        } else {
            $table_headers = [TABLE_HEADING_TABLE,
                TABLE_HEADING_MSG,
                tep_draw_checkbox_field('masterblaster')];
        }

        $table_data[] = ['alter database `'.DB_DATABASE.'` convert to character set utf8mb4 collate utf8mb4_unicode_ci'];

        foreach ($_POST['id'] as $table) {
            $result = 'OK';

            $queries = [];

            $cols_query = tep_db_query('show full columns from '.$table);

            while ($cols = tep_db_fetch_array($cols_query)) {
                if (!empty($cols['Collation'])) {
                    if ($_POST['from_charset'] === 'auto') {
                        $old_charset = substr($cols['Collation'], 0, strpos($cols['Collation'], '_'));
                    } else {
                        $old_charset = $_POST['from_charset'];
                    }

                    $queries[] = 'update '.$table.' set '.$cols['Field'].' = convert(binary convert('.$cols['Field'].' using '.$old_charset.') using utf8mb4) where char_length('.$cols['Field'].') = length(convert(binary convert('.$cols['Field'].' using '.$old_charset.') using utf8mb4))';
                }
            }

            $query = 'alter table '.$table.' convert to character set utf8mb4 collate utf8mb4_unicode_ci';

            if (isset($_POST['dryrun'])) {
                $table_data[] = [$query];

                foreach ($queries as $q) {
                    $table_data[] = [$q];
                }
            } else {
                // mysqli_query() is directly called as tep_db_query() dies when an error occurs
                if (mysqli_query($db_link, $query)) {
                    foreach ($queries as $q) {
                        if (!mysqli_query($db_link, $q)) {
                            $result = mysqli_error($db_link);

                            break;
                        }
                    }
                } else {
                    $result = mysqli_error($db_link);
                }
            }

            if (!isset($_POST['dryrun'])) {
                $table_data[] = [tep_output_string_protected($table),
                    tep_output_string_protected($result),
                    tep_draw_checkbox_field('id[]', $table, true)];
            }
        }

        break;

    default:
        $table_headers = [TABLE_HEADING_TABLE,
            TABLE_HEADING_ROWS,
            TABLE_HEADING_SIZE,
            TABLE_HEADING_ENGINE,
            TABLE_HEADING_COLLATION,
            tep_draw_checkbox_field('masterblaster')];

        $table_data = [];

        $sql_query = tep_db_query('show table status');

        while ($sql = tep_db_fetch_array($sql_query)) {
            $table_data[] = [tep_output_string_protected($sql['Name']),
                tep_output_string_protected($sql['Rows']),
                round(($sql['Data_length'] + $sql['Index_length']) / 1024 / 1024, 2).'M',
                tep_output_string_protected($sql['Engine']),
                tep_output_string_protected($sql['Collation']),
                tep_draw_checkbox_field('id[]', $sql['Name'])];
        }
}

require 'includes/template_top.php';
?>

<?php
  if (isset($action)) {
      echo '<div style="float: right;">'.tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link('database_tables.php')).'</div>';
  }

?>

<h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

<?php
  echo tep_draw_form('sql', 'database_tables.php');
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="dataTableHeadingRow">

<?php
  foreach ($table_headers as $th) {
      echo '    <td class="dataTableHeadingContent">'.$th."</td>\n";
  }

?>
  </tr>

<?php
  foreach ($table_data as $td) {
      echo '  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";

      foreach ($td as $data) {
          echo '    <td class="dataTableContent">'.$data."</td>\n";
      }

      echo "  </tr>\n";
  }

?>

</table>

<?php
  if (!isset($_POST['dryrun'])) {
      ?>

<div class="main" style="text-align: right;">
  <?php echo '<span class="runUtf8" style="display: none;">'.sprintf(ACTION_UTF8_DRY_RUN, tep_draw_checkbox_field('dryrun')).'</span>'.tep_draw_pull_down_menu('action', $actions, '', 'id="sqlActionsMenu"').'<span class="runUtf8" style="display: none;">&nbsp;'.tep_draw_pull_down_menu('from_charset', $mysql_charsets).'</span>&nbsp;'.tep_draw_button(BUTTON_ACTION_GO); ?>
</div>

<?php
  }

?>

</form>

<script>
$(function() {
  if ( $('form[name="sql"] input[type="checkbox"][name="masterblaster"]').length > 0 ) {
    $('form[name="sql"] input[type="checkbox"][name="masterblaster"]').click(function() {
      $('form[name="sql"] input[type="checkbox"][name="id[]"]').prop('checked', $('form[name="sql"] input[type="checkbox"][name="masterblaster"]').prop('checked'));
    });
  }

  if ( $('#sqlActionsMenu').val() == 'utf8' ) {
    $('.runUtf8').show();
  }

  $('#sqlActionsMenu').change(function() {
    var selected = $(this).val();

    if ( selected == 'utf8' ) {
      $('.runUtf8').show();
    } else {
      $('.runUtf8').hide();
    }
  });
});
</script>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
