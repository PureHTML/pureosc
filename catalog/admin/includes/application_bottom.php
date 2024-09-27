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
    if (!\is_object($logger)) {
        $logger = new logger();
    }

    echo $logger->timer_stop(DISPLAY_PAGE_PARSE_TIME);
}
