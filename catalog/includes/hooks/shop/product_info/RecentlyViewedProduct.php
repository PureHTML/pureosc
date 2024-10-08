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
class RecentlyViewedProduct
{
    public function __construct()
    {
        if ($this->hasProduct() && $this->isEnabledModule()) {
            $this->listen_addRecentlyViewedProduct();
        }
    }

    public function listen_addRecentlyViewedProduct(): void
    {
        if (!isset($_SESSION['recently_viewed_products'])) {
            tep_session_register('recently_viewed_products');
        }

        $id = (int) $_GET['products_id'];

        if (isset($_SESSION['recently_viewed_products'])) {
            foreach ($_SESSION['recently_viewed_products'] as $key => $value) {
                if ($value === $id) {
                    unset($_SESSION['recently_viewed_products'][$key]);

                    break;
                }
            }

            if ($_SESSION['recently_viewed_products'] && \count($_SESSION['recently_viewed_products']) > MAX_DISPLAY_SEARCH_RESULTS) {
                array_pop($_SESSION['recently_viewed_products']);
            }
        } else {
            $_SESSION['recently_viewed_products'] = [];
        }

        array_unshift($_SESSION['recently_viewed_products'], $id);
    }

    public function hasProduct()
    {
        return isset($_GET['products_id']) && !empty($_GET['products_id']);
    }

    public function isEnabledModule()
    {
        return \defined('MODULE_FOOTER_RECENTLY_VIEWED_PRODUCTS_STATUS') && MODULE_FOOTER_RECENTLY_VIEWED_PRODUCTS_STATUS === 'True';
    }
}
