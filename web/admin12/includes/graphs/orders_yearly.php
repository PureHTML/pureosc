<?php

  include(DIR_WS_CLASSES . 'phplot.php');

  $stats = array(array('0', '0', '0'));
  $store_stats_query = tep_db_query("select year(store_history_date) as year, sum(amount_products) as value, sum(amount_orders) as dvalue, sum(orders_price) as orders_price from " . TABLE_STORE_HISTORY . " group by year");
  $count=1;
  while ($store_stats = tep_db_fetch_array($store_stats_query)) {
    $stats[] = array($store_stats['year'], (($store_stats['value']) ? $store_stats['value'] : '0'), (($store_stats['dvalue']) ? $store_stats['dvalue'] : '0'));
    $orders_price[$count] = array((($store_stats['orders_price']) ? $store_stats['orders_price'] : '0'));
    $count++;
  }

  $graph_type = $_GET['graph_type'];
  touch(DIR_FS_ADMIN . 'images/graphs/orders_yearly_' . $graph_type . '.' . $store_extension); // Create blank file
  chmod(DIR_FS_ADMIN . 'images/graphs/orders_yearly_' . $graph_type . '.' . $store_extension,0777);
  $graph = new PHPlot(600, 350, 'images/graphs/orders_yearly_' . $graph_type . '.' . $store_extension);

  $graph->SetFileFormat($store_extension);
  $graph->SetIsInline(1);
  $graph->SetPrintImage(0);

  $graph->SetSkipBottomTick(1);
  $graph->SetDrawYGrid(1);
  $graph->SetPrecisionY(0);

  switch($graph_type){
        case 'lines': $graph->SetPlotType('lines');
          break;
        case 'pie': $graph->SetPlotType('pie');
          break;
        case 'linepoints': $graph->SetPlotType('linepoints');
          break;
        case 'bars': $graph->SetPlotType('bars');
          break;
        default:
          $graph->SetPlotType('bars');
  }

  $graph->SetPlotBorderType('left');
  $graph->SetTitleFontSize('4');
  $graph->SetTitle(sprintf(TEXT_BANNERS_YEARLY_STATISTICS, $store['store_title']));

  $graph->SetBackgroundColor('white');

  $graph->SetVertTickPosition('plotleft');
  $graph->SetDataValues($stats);
  $graph->SetDataColors(array('blue','red'),array('blue', 'red'));

  $graph->DrawGraph();

  $graph->PrintImage();
?>
