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

namespace Braintree;

class PaginatedResult
{
    private $_totalItems;
    private $_pageSize;
    private $_currentPage;

    public function __construct($totalItems, $pageSize, $currentPage)
    {
        $this->_totalItems = $totalItems;
        $this->_pageSize = $pageSize;
        $this->_currentPage = $currentPage;
    }

    public function getTotalItems()
    {
        return $this->_totalItems;
    }

    public function getPageSize()
    {
        return $this->_pageSize;
    }

    public function getCurrentPage()
    {
        return $this->_currentPage;
    }
}
