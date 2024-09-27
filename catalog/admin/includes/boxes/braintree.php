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

include DIR_FS_CATALOG.'includes/apps/braintree/admin/functions/boxes.php';

$cl_box_groups[] = ['heading' => MODULES_ADMIN_MENU_BRAINTREE_HEADING,
    'apps' => app_braintree_get_admin_box_links()];
