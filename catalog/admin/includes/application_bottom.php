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

// close session (store variables)
tep_session_close();

if (STORE_PAGE_PARSE_TIME === 'true') {
    if (!\is_object($logger)) {
        $logger = new logger();
    }

    echo $logger->timer_stop(DISPLAY_PAGE_PARSE_TIME);
}
