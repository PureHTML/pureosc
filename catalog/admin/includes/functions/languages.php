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
 * @param mixed $code
 */
function tep_get_languages_directory($code)
{
    global $languages_id;

    $language_query = tep_db_query("select languages_id, directory from languages where code = '".tep_db_input($code)."'");

    if (tep_db_num_rows($language_query)) {
        $language = tep_db_fetch_array($language_query);
        $languages_id = $language['languages_id'];

        return $language['directory'];
    }

    return false;
}
