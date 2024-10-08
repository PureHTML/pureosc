<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

// //
// Sets the status of a special product
function tep_set_specials_status($specials_id, $status)
{
    return tep_db_query("update specials set status = '".(int) $status."', date_status_change = now() where specials_id = '".(int) $specials_id."'");
}

// //
// Auto expire products on special
function tep_expire_specials(): void
{
    $specials_query = tep_db_query("select specials_id from specials where status = '1' and now() >= expires_date and expires_date > 0");

    if (tep_db_num_rows($specials_query)) {
        while ($specials = tep_db_fetch_array($specials_query)) {
            tep_set_specials_status($specials['specials_id'], '0');
        }
    }
}
