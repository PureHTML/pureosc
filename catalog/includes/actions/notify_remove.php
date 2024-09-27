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

if (isset($_SESSION['customer_id'], $_GET['products_id'])) {
    $check_query = tep_db_query("select count(*) as count from products_notifications where products_id = '".(int) $_GET['products_id']."' and customers_id = '".(int) $customer_id."'");

    $check = tep_db_fetch_array($check_query);

    if ($check['count'] > 0) {
        tep_db_query("delete from products_notifications where products_id = '".(int) $_GET['products_id']."' and customers_id = '".(int) $customer_id."'");
    }

    tep_redirect(tep_href_link($PHP_SELF, tep_get_all_get_params(['action'])));
} else {
    $_SESSION['navigation']->set_snapshot();

    tep_redirect(tep_href_link('login.php'));
}
