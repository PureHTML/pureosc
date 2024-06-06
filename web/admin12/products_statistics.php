<?php

  require('includes/application_top.php');

  $type = (isset($_GET['type']) ? $_GET['type'] : '');

  $store_extension = 'png';

// check if the graphs directory exists
  $dir_ok = false;
  if (function_exists('imagecreate') && tep_not_null($store_extension)) {
    if (is_dir(DIR_WS_IMAGES . 'graphs')) {
      if (is_writeable(DIR_WS_IMAGES . 'graphs')) {
        $dir_ok = true;
      } else {
        $messageStack->add(ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE, 'error');
      }
    } else {
      $messageStack->add(ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST, 'error');
    }
  }




  $years_array = array();
  $years_query = tep_db_query("select distinct year(store_history_date) as store_year from " . TABLE_STORE_HISTORY);
  while ($years = tep_db_fetch_array($years_query)) {
    $years_array[] = array('id' => $years['store_year'],
                           'text' => $years['store_year']);
  }

  $months_array = array();
  for ($i=1; $i<13; $i++) {
    $months_array[] = array('id' => $i,
                            'text' => strftime('%B', mktime(0,0,0,$i)));
  }

  $type_array = array(array('id' => 'daily',
                            'text' => STATISTICS_TYPE_DAILY),
                      array('id' => 'monthly',
                            'text' => STATISTICS_TYPE_MONTHLY),
                      array('id' => 'yearly',
                            'text' => STATISTICS_TYPE_YEARLY));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%">
        <?php echo tep_draw_form('year', FILENAME_PRODUCTS_STATISTICS, '', 'get'); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', '1', HEADING_IMAGE_HEIGHT); ?></td>
            <td class="main" align="right"><?php echo TITLE_TYPE . ' ' . tep_draw_pull_down_menu('type', $type_array,(tep_not_null($type) ? $type : 'daily'), 'onchange="this.form.submit();"'); ?><noscript><input type="submit" value="GO"/></noscript><br />
<?php
  switch ($type) {
    case 'yearly': break;
    case 'monthly':
      echo TITLE_YEAR . ' ' . tep_draw_pull_down_menu('year', $years_array, (isset($_GET['year']) ? $_GET['year'] : date('Y')), 'onchange="this.form.submit();"') . '<noscript><input type="submit" value="GO"/></noscript>';
      break;
    default:
    case 'daily':
      echo TITLE_MONTH . ' ' . tep_draw_pull_down_menu('month', $months_array, (isset($_GET['month']) ? $_GET['month'] : date('n')), 'onchange="this.form.submit();"') . '<noscript><input type="submit" value="GO"/></noscript><br />' . TITLE_YEAR . ' ' . tep_draw_pull_down_menu('year', $years_array, (isset($_GET['year']) ? $_GET['year'] : date('Y')), 'onchange="this.form.submit();"') . '<noscript><input type="submit" value="GO"/></noscript>';
      break;
  }
?>
            </td>
          <?php echo tep_draw_hidden_field('page', $_GET['page']) . tep_draw_hidden_field('sID', $_GET['sID']); ?></tr>
        </table>
        </form>
        </td>
      </tr>
      <tr>
        <td class="main">
           <?php echo TEXT_DESCRIPTION; ?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
       <tr>
        <td align="center">
          <?php
            echo tep_draw_form('goto', FILENAME_PRODUCTS_STATISTICS, '', 'get');
            $graph_type_array[] = array('id' => 'bars', 'text' => 'Please select graph type');
            $graph_type_array[] = array('id' => 'lines', 'text' => 'lines');
            $graph_type_array[] = array('id' => 'pie', 'text' => 'pie');
            $graph_type_array[] = array('id' => 'linepoints', 'text' => 'linepoints');
            $graph_type_array[] = array('id' => 'bars', 'text' => 'bars');

            echo tep_draw_hidden_field('type',$type);
            echo tep_draw_hidden_field('month',(($_GET['month']) ? $_GET['month'] : date('n')));
            echo tep_draw_hidden_field('year',(($_GET['year']) ? $_GET['year'] : date('Y')));

            echo  tep_draw_pull_down_menu('graph_type', $graph_type_array, '', 'onchange="this.form.submit();"');
            echo '</form>';
          ?>

        </td>
      </tr>
      <tr>
        <td align="center">
<?php
  if (function_exists('imagecreate') && ($dir_ok == true) && tep_not_null($store_extension)) {
    $store_id = (int)$_GET['sID'];
    $graph_type = $_GET['graph_type'];

    switch ($type) {
      case 'yearly':
        include(DIR_WS_INCLUDES . 'graphs/products_yearly.php');
        echo tep_image(DIR_WS_IMAGES . 'graphs/products_yearly_' . $graph_type . '.' . $store_extension);
        break;
      case 'monthly':
        include(DIR_WS_INCLUDES . 'graphs/products_monthly.php');
        echo tep_image(DIR_WS_IMAGES . 'graphs/products_monthly_' . $graph_type . '.' . $store_extension);
        break;
      default:
      case 'daily':
        include(DIR_WS_INCLUDES . 'graphs/products_daily.php');
        echo tep_image(DIR_WS_IMAGES . 'graphs/products_daily_' . $graph_type . '.' . $store_extension);
        break;
    }
?>
          <table border="0" width="600" cellspacing="0" cellpadding="2" class="dataTableRow">
            <tr class="dataTableHeadingRow">
             <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_SOURCE; ?></td>
             <td class="dataTableHeadingContent" align="right">Viewed</td>
             <td class="dataTableHeadingContent" align="right">Purchased</td>
           </tr>
<?php
    $total_host = 0;
    $total_hit = 0;
    for ($i=0, $n=sizeof($stats); $i<$n; $i++) {
    if($stats[$i][0]!='0')
      echo '            <tr onmouseover="this.style.background=\'#ffffff\'"  onmouseout="this.style.background=\'none\'"  >' . "\n" .
           '              <td class="dataTableContent">' . $stats[$i][0] . '</td>' . "\n" .
           '              <td class="dataTableContent" align="right">' . number_format($stats[$i][1]) . '</td>' . "\n" .
           '              <td class="dataTableContent" align="right">' . number_format($stats[$i][2]) . '</td>' . "\n" .
           '            </tr>' . "\n";

      $total_host += $stats[$i][1];
      $total_hit += $stats[$i][2];
    }
?>

           <tr class="dataTableHeadingRow">
             <td class="dataTableHeadingContent"><b>Total:</b></td>
             <td class="dataTableHeadingContent" align="right"><b><?php echo number_format($total_host);?></b></td>
             <td class="dataTableHeadingContent" align="right"><b><?php echo number_format($total_hit);?></b></td>
           </tr>
          </table>
<?php
  }

?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>

    </table></td>
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
