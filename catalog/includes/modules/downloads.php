<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

if (!strstr($PHP_SELF, 'account_history_info.php')) {
    // Get last order id for checkout_success
    $orders_query = tep_db_query("select orders_id from orders where customers_id = '".(int) $customer_id."' order by orders_id desc limit 1");
    $orders = tep_db_fetch_array($orders_query);
    $last_order = $orders['orders_id'];
} else {
    $last_order = $_GET['order_id'];
}

// Now get all downloadable products in that order
$downloads_query = tep_db_query("select date_format(o.date_purchased, '%Y-%m-%d') as date_purchased_day, opd.download_maxdays, op.products_name, opd.orders_products_download_id, opd.orders_products_filename, opd.download_count, opd.download_maxdays from orders o, orders_products op, orders_products_download opd, orders_status os where o.customers_id = '".(int) $customer_id."' and o.orders_id = '".(int) $last_order."' and o.orders_id = op.orders_id and op.orders_products_id = opd.orders_products_id and opd.orders_products_filename is not null and o.orders_status = os.orders_status_id and os.downloads_flag = '1' and os.language_id = '".(int) $languages_id."'");

if (tep_db_num_rows($downloads_query) > 0) {
    ?>

  <h2><?php echo HEADING_DOWNLOAD; ?></h2>

  <div class="mb-3">
    <table class="table table-borderless table-sm">
      <tbody>

      <?php
        while ($downloads = tep_db_fetch_array($downloads_query)) {
            // MySQL 3.22 does not have INTERVAL
            [$dt_year, $dt_month, $dt_day] = explode('-', $downloads['date_purchased_day']);
            $download_timestamp = mktime(23, 59, 59, $dt_month, $dt_day + $downloads['download_maxdays'], $dt_year);
            $download_expiry = date('Y-m-d H:i:s', $download_timestamp);

            echo '<tr>';

            // The link will appear only if:
            // - Download remaining count is > 0, AND
            // - The file is present in the DOWNLOAD directory, AND EITHER
            // - No expiry date is enforced (maxdays == 0), OR
            // - The expiry date is not reached
            if (($downloads['download_count'] > 0) && file_exists(DIR_FS_DOWNLOAD.$downloads['orders_products_filename']) && (($downloads['download_maxdays'] === 0) || ($download_timestamp > time()))) {
                echo '<td><a href="'.tep_href_link('download.php', 'order='.$last_order.'&id='.$downloads['orders_products_download_id']).'">'.$downloads['products_name'].'</a></td>';
            } else {
                echo '<td>'.$downloads['products_name'].'</td>';
            }

            echo '  <td>'.TABLE_HEADING_DOWNLOAD_DATE.tep_date_long($download_expiry).<<<'EOD'
</td>
                <td class="text-end">
EOD.$downloads['download_count'].TABLE_HEADING_DOWNLOAD_COUNT.<<<'EOD'
</td>
              </tr>
EOD;
        }

    ?>

      </tbody>
    </table>

    <?php
    if (!strstr($PHP_SELF, 'account_history_info.php')) {
        ?>

      <p><?php printf(FOOTER_DOWNLOAD, '<a href="'.tep_href_link('account.php').'">'.HEADER_TITLE_MY_ACCOUNT.'</a>'); ?></p>

      <?php
    }

    ?>

  </div>

  <?php
}
