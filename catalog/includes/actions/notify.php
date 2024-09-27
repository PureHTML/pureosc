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

if (isset($_SESSION['customer_id'])) {
    if (isset($_GET['products_id'])) {
        $notify = $_GET['products_id'];
    } elseif (isset($_GET['notify'])) {
        $notify = $_GET['notify'];
    } elseif (isset($_POST['notify'])) {
        $notify = $_POST['notify'];
    } else {
        tep_redirect(tep_href_link($PHP_SELF, tep_get_all_get_params(['action', 'notify'])));
    }

    if (!\is_array($notify)) {
        $notify = [$notify];
    }

    for ($i = 0, $n = \count($notify); $i < $n; ++$i) {
        $check_query = tep_db_query("select count(*) as count from products_notifications where products_id = '".(int) $notify[$i]."' and customers_id = '".(int) $customer_id."'");
        $check = tep_db_fetch_array($check_query);

        if ($check['count'] < 1) {
            tep_db_query("insert into products_notifications (products_id, customers_id, date_added) values ('".(int) $notify[$i]."', '".(int) $customer_id."', now())");
        }
    }

    tep_redirect(tep_href_link($PHP_SELF, tep_get_all_get_params(['action', 'notify'])));
} else {
    $_SESSION['navigation']->set_snapshot();

    tep_redirect(tep_href_link('login.php'));
}
