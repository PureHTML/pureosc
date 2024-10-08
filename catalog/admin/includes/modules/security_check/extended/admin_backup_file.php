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
class extended_admin_backup_file
{
    public $type = 'error';
    public $has_doc = true;

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended/admin_backup_file.php';

        $this->title = MODULE_SECURITY_CHECK_EXTENDED_ADMIN_BACKUP_FILE_TITLE;
    }

    public function pass()
    {
        $backup_file = null;

        if (is_dir(DIR_FS_BACKUP)) {
            $dir = dir(DIR_FS_BACKUP);
            $contents = [];

            while ($file = $dir->read()) {
                if (!is_dir(DIR_FS_BACKUP.$file)) {
                    $ext = substr($file, strrpos($file, '.') + 1);

                    if (\in_array($ext, ['zip', 'sql', 'gz'], true) && !isset($contents[$ext])) {
                        $contents[$ext] = $file;

                        if ($ext !== 'sql') { // zip and gz (binaries) are prioritized over sql (plain text)
                            break;
                        }
                    }
                }
            }

            if (isset($contents['zip'])) {
                $backup_file = $contents['zip'];
            } elseif (isset($contents['gz'])) {
                $backup_file = $contents['gz'];
            } elseif (isset($contents['sql'])) {
                $backup_file = $contents['sql'];
            }
        }

        $result = true;

        if (isset($backup_file)) {
            $request = $this->getHttpRequest(tep_href_link('backups/'.$backup_file));

            $result = ($request['http_code'] !== 200);
        }

        return $result;
    }

    public function getMessage()
    {
        return MODULE_SECURITY_CHECK_EXTENDED_ADMIN_BACKUP_FILE_HTTP_200;
    }

    public function getHttpRequest($url)
    {
        $server = parse_url($url);

        if (isset($server['port']) === false) {
            $server['port'] = ($server['scheme'] === 'https') ? 443 : 80;
        }

        if (isset($server['path']) === false) {
            $server['path'] = '/';
        }

        $curl = curl_init($server['scheme'].'://'.$server['host'].$server['path'].(isset($server['query']) ? '?'.$server['query'] : ''));
        curl_setopt($curl, \CURLOPT_PORT, $server['port']);
        curl_setopt($curl, \CURLOPT_HEADER, false);
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, \CURLOPT_FORBID_REUSE, true);
        curl_setopt($curl, \CURLOPT_FRESH_CONNECT, true);
        curl_setopt($curl, \CURLOPT_CUSTOMREQUEST, 'HEAD');
        curl_setopt($curl, \CURLOPT_NOBODY, true);

        if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            curl_setopt($curl, \CURLOPT_USERPWD, $_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']);

            $this->type = 'warning';
        }

        $result = curl_exec($curl);

        $info = curl_getinfo($curl);

        curl_close($curl);

        return $info;
    }
}
