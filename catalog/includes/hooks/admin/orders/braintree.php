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
class admin_orders_braintree
{
    public function listen_orderAction()
    {
        if (!class_exists('braintree_hook_admin_orders_action')) {
            include DIR_FS_CATALOG.'includes/apps/braintree/hooks/admin/orders/action.php';
        }

        $hook = new braintree_hook_admin_orders_action();

        return $hook->execute();
    }

    public function listen_orderTab()
    {
        if (!class_exists('braintree_hook_admin_orders_tab')) {
            include DIR_FS_CATALOG.'includes/apps/braintree/hooks/admin/orders/tab.php';
        }

        $hook = new braintree_hook_admin_orders_tab();

        return $hook->execute();
    }
}
