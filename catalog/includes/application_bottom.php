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

// close session (store variables)
tep_session_close();

if (STORE_PAGE_PARSE_TIME === 'true') {
    $time_start = explode(' ', PAGE_PARSE_START_TIME);
    $time_end = explode(' ', microtime());
    $parse_time = number_format($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0]), 3);
    error_log(strftime(STORE_PARSE_DATE_TIME_FORMAT).' - '.getenv('REQUEST_URI').' ('.$parse_time."s)\n", 3, STORE_PAGE_PARSE_TIME_LOG);

    if (DISPLAY_PAGE_PARSE_TIME === 'true') {
        echo '<span class="smallText">Parse Time: '.$parse_time.'s</span>';
    }
}
