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

$cl_box_groups[] = [
    'heading' => BOX_HEADING_TOOLS,
    'apps' => [
        [
            'code' => 'action_recorder.php',
            'title' => BOX_TOOLS_ACTION_RECORDER,
            'link' => tep_href_link('action_recorder.php'),
        ],
        [
            'code' => 'backup.php',
            'title' => BOX_TOOLS_BACKUP,
            'link' => tep_href_link('backup.php'),
        ],
        [
            'code' => 'cache.php',
            'title' => BOX_TOOLS_CACHE,
            'link' => tep_href_link('cache.php'),
        ],
        [
            'code' => 'define_language.php',
            'title' => BOX_TOOLS_DEFINE_LANGUAGE,
            'link' => tep_href_link('define_language.php'),
        ],
        [
            'code' => 'mail.php',
            'title' => BOX_TOOLS_MAIL,
            'link' => tep_href_link('mail.php'),
        ],
        [
            'code' => 'newsletters.php',
            'title' => BOX_TOOLS_NEWSLETTER_MANAGER,
            'link' => tep_href_link('newsletters.php'),
        ],
        [
            'code' => 'sec_dir_permissions.php',
            'title' => BOX_TOOLS_SEC_DIR_PERMISSIONS,
            'link' => tep_href_link('sec_dir_permissions.php'),
        ],
        [
            'code' => 'server_info.php',
            'title' => BOX_TOOLS_SERVER_INFO,
            'link' => tep_href_link('server_info.php'),
        ],
        [
            'code' => 'version_check.php',
            'title' => BOX_TOOLS_VERSION_CHECK,
            'link' => tep_href_link('version_check.php'),
        ],
    ],
];
