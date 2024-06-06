<?php
  include(DIR_WS_CLASSES . 'phplot.php');

  $year = (($_GET['year']) ? $_GET['year'] : date('Y'));

  $stats = array();
  for ($i=1; $i<13; $i++) {
    $stats[] = array(strftime('%b', mktime(0,0,0,$i)), '0', '0');
  }

  $store_stats_query = tep_db_query("select month(store_history_date) as store_month, sum(store_products_shown) as value, sum(store_products_purchased) as dvalue from " . TABLE_STORE_PRODUCTS_HISTORY . " where year(store_history_date) = '" . $year . "' group by store_month");
  while ($store_stats = tep_db_fetch_array($store_stats_query)) {
    $stats[($store_stats['store_month']-1)] = array(strftime('%b', mktime(0,0,0,$store_stats['store_month'])), (($store_stats['value']) ? $store_stats['value'] : '0'), (($store_stats['dvalue']) ? $store_stats['dvalue'] : '0'));
  }

  $graph_type = $_GET['graph_type'];
  @touch(DIR_FS_ADMIN . 'images/graphs/products_monthly_' . $graph_type . '.' . $store_extension); // Create blank file
  @chmod(DIR_FS_ADMIN . 'images/graphs/products_monthly_' . $graph_type . '.' . $store_extension,0777);
  $graph = new PHPlot(600, 350, 'images/graphs/products_monthly_' . $graph_type . '.' . $store_extension);

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
  $graph->SetTitle(sprintf(TEXT_BANNERS_MONTHLY_STATISTICS, $store['store_title'], $year));

  $graph->SetBackgroundColor('white');

  $graph->SetVertTickPosition('plotleft');
  $graph->SetDataValues($stats);
  $graph->SetDataColors(array('blue','red'),array('blue', 'red'));

  $graph->DrawGraph();

  $graph->PrintImage();
?>
