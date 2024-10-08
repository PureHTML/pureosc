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
 *
 * @param mixed $products_id
 */
function tep_get_reviews_rating($products_id)
{
    return tep_db_fetch_array(tep_db_query("SELECT round(avg(reviews_rating) + 0.0, 1) AS rating, count(*) AS `count` FROM reviews WHERE products_id = '".(int) $products_id."' AND reviews_status = 1"));
}

if (!\function_exists('tep_datetime_short')) {
    function tep_datetime_short($raw_datetime)
    {
        if (($raw_datetime === '0000-00-00 00:00:00') || ($raw_datetime === '')) {
            return false;
        }

        $year = (int) substr($raw_datetime, 0, 4);
        $month = (int) substr($raw_datetime, 5, 2);
        $day = (int) substr($raw_datetime, 8, 2);
        $hour = (int) substr($raw_datetime, 11, 2);
        $minute = (int) substr($raw_datetime, 14, 2);
        $second = (int) substr($raw_datetime, 17, 2);

        return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    }
}

// compatibility 2.3
if (!\function_exists('tep_draw_stars') && \defined('TEXT_OF_5_STARS')) {
    function tep_draw_stars($rating = null)
    {
        if (!empty($rating)) {
            return tep_image('images/stars_'.(int) $rating.'.png', sprintf(TEXT_OF_5_STARS, (int) $rating));
        }

        return null;
    }
}
