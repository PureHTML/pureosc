<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (isset($_GET['lID']) && is_numeric($_GET['lID'])) {
    $log_query = tep_db_query("select l.*, unix_timestamp(l.date_added) as date_added, c.customers_firstname, c.customers_lastname from oscom_app_paypal_log l left join customers c on (l.customers_id = c.customers_id) where id = '".(int) $_GET['lID']."'");

    if (tep_db_num_rows($log_query)) {
        $log = tep_db_fetch_array($log_query);

        $log_request = [];

        $req = explode("\n", $log['request']);

        foreach ($req as $r) {
            $p = explode(':', $r, 2);

            $log_request[$p[0]] = $p[1];
        }

        $log_response = [];

        $res = explode("\n", $log['response']);

        foreach ($res as $r) {
            $p = explode(':', $r, 2);

            $log_response[$p[0]] = $p[1];
        }

        $content = 'log_view.php';
    }
}
