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

function app_braintree_get_admin_box_links()
{
    return [
        ['code' => 'braintree.php',
            'title' => MODULES_ADMIN_MENU_BRAINTREE_CONFIGURE,
            'link' => tep_href_link('braintree.php', 'action=configure')],
        ['code' => 'braintree.php',
            'title' => MODULES_ADMIN_MENU_BRAINTREE_MANAGE_CREDENTIALS,
            'link' => tep_href_link('braintree.php', 'action=credentials')],
    ];
}
