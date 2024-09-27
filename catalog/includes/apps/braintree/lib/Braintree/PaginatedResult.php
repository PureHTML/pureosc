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
