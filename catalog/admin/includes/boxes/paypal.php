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

include DIR_FS_CATALOG.'includes/apps/paypal/admin/functions/boxes.php';

$cl_box_groups[] = ['heading' => MODULES_ADMIN_MENU_PAYPAL_HEADING,
    'apps' => app_paypal_get_admin_box_links()];
