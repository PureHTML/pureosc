<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class d_total_revenue
{
    public $code = 'd_total_revenue';
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct()
    {
        $this->title = MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_TITLE;
        $this->description = MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_DESCRIPTION;

        if (\defined('MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER;
            $this->enabled = (MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS === 'True');
        }
    }

    public function getOutput()
    {
        $days = [];

        for ($i = 0; $i < 30; ++$i) {
            $days[date('Y-m-d', strtotime('-'.$i.' days'))] = 0;
        }

        $orders_query = tep_db_query("select date_format(o.date_purchased, '%Y-%m-%d') as dateday, sum(ot.value) as total from orders o, orders_total ot where date_sub(curdate(), interval 30 day) <= o.date_purchased and o.orders_id = ot.orders_id and ot.class = 'ot_total' group by dateday");

        while ($orders = tep_db_fetch_array($orders_query)) {
            $days[$orders['dateday']] = $orders['total'];
        }

        $days = array_reverse($days, true);

        $js_array = '';

        foreach ($days as $date => $total) {
            $js_array .= '['.(mktime(0, 0, 0, (int) substr($date, 5, 2), (int) substr($date, 8, 2), (int) substr($date, 0, 4)) * 1000).', '.$total.'],';
        }

        if (!empty($js_array)) {
            $js_array = substr($js_array, 0, -1);
        }

        $chart_label = tep_output_string(MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_CHART_LINK);
        $chart_label_link = tep_href_link('orders.php');

        return <<<EOD
<div id="d_total_revenue" style="width: 100%; height: 150px;"></div>
<script>
$(function () {
  var plot30 = [{$js_array}];
  $.plot($('#d_total_revenue'), [ {
    label: '{$chart_label}',
    data: plot30,
    lines: { show: true, fill: true },
    points: { show: true },
    color: '#66CC33'
  }], {
    xaxis: {
      ticks: 4,
      mode: 'time'
    },
    yaxis: {
      ticks: 3,
      min: 0
    },
    grid: {
      backgroundColor: { colors: ['#fff', '#eee'] },
      hoverable: true
    },
    legend: {
      labelFormatter: function(label, series) {
        return '<a href="{$chart_label_link}">' + label + '</a>';
      }
    }
  });
});

function showTooltip(x, y, contents) {
  $('<div id="tooltip">' + contents + '</div>').css( {
    position: 'absolute',
    display: 'none',
    top: y + 5,
    left: x + 5,
    border: '1px solid #fdd',
    padding: '2px',
    backgroundColor: '#fee',
    opacity: 0.80
  }).appendTo('body').fadeIn(200);
}

var monthNames = [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ];

var previousPoint = null;
$('#d_total_revenue').bind('plothover', function (event, pos, item) {
  if (item) {
    if (previousPoint != item.datapoint) {
      previousPoint = item.datapoint;

      $('#tooltip').remove();
      var x = item.datapoint[0],
          y = item.datapoint[1],
          xdate = new Date(x);

      showTooltip(item.pageX, item.pageY, y + ' for ' + monthNames[xdate.getMonth()] + '-' + xdate.getDate());
    }
  } else {
    $('#tooltip').remove();
    previousPoint = null;
  }
});
</script>
EOD;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS');
    }

    public function install(): void
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Total Revenue Module', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS', 'True', 'Do you want to show the total revenue chart on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\\'True\\', \\'False\\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        return ['MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER'];
    }
}
