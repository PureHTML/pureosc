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

include DIR_FS_CATALOG.'includes/apps/braintree/admin/functions/boxes.php';

$cl_box_groups[] = ['heading' => MODULES_ADMIN_MENU_BRAINTREE_HEADING,
    'apps' => app_braintree_get_admin_box_links()];
