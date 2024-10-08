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
class extended_ext_directory_listing
{
    public $type = 'warning';
    public $has_doc = true;

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended/ext_directory_listing.php';

        $this->title = MODULE_SECURITY_CHECK_EXTENDED_EXT_DIRECTORY_LISTING_TITLE;
    }

    public function pass()
    {
        $request = $this->getHttpRequest(tep_catalog_href_link('ext/'));

        return $request['http_code'] !== 200;
    }

    public function getMessage()
    {
        return MODULE_SECURITY_CHECK_EXTENDED_EXT_DIRECTORY_LISTING_HTTP_200;
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

        $result = curl_exec($curl);

        $info = curl_getinfo($curl);

        curl_close($curl);

        return $info;
    }
}
