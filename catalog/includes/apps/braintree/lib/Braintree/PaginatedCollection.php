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

namespace Braintree;

/**
 * Braintree PaginatedCollection
 * PaginatedCollection is a container object for paginated data.
 *
 * retrieves and pages through large collections of results
 *
 * example:
 * <code>
 * $result = MerchantAccount::all();
 *
 * foreach($result as $merchantAccount) {
 *   print_r($merchantAccount->status);
 * }
 * </code>
 */
class PaginatedCollection implements \Iterator
{
    private $_pager;
    private $_pageSize;
    private $_currentPage;
    private $_index;
    private $_totalItems;
    private $_items;

    /**
     * set up the paginated collection.
     *
     * expects an array of an object and method to call on it
     *
     * @param array $pager
     */
    public function __construct($pager)
    {
        $this->_pager = $pager;
        $this->_pageSize = 0;
        $this->_currentPage = 0;
        $this->_totalItems = 0;
        $this->_index = 0;
    }

    /**
     * returns the current item when iterating with foreach.
     */
    public function current()
    {
        return $this->_items[$this->_index % $this->_pageSize];
    }

    public function key()
    {
        return null;
    }

    /**
     * advances to the next item in the collection when iterating with foreach.
     */
    public function next(): void
    {
        ++$this->_index;
    }

    /**
     * rewinds the collection to the first item when iterating with foreach.
     */
    public function rewind(): void
    {
        $this->_index = 0;
        $this->_currentPage = 0;
        $this->_pageSize = 0;
        $this->_totalItems = 0;
        $this->_items = [];
    }

    /**
     * returns whether the current item is valid when iterating with foreach.
     */
    public function valid()
    {
        if ($this->_currentPage === 0 || $this->_index % $this->_pageSize === 0 && $this->_index < $this->_totalItems) {
            $this->_getNextPage();
        }

        return $this->_index < $this->_totalItems;
    }

    private function _getNextPage(): void
    {
        ++$this->_currentPage;
        $object = $this->_pager['object'];
        $method = $this->_pager['method'];

        if (isset($this->_pager['query'])) {
            $query = $this->_pager['query'];
            $result = \call_user_func(
                [$object, $method],
                $query,
                $this->_currentPage,
            );
        } else {
            $result = \call_user_func(
                [$object, $method],
                $this->_currentPage,
            );
        }

        $this->_totalItems = $result->getTotalItems();
        $this->_pageSize = $result->getPageSize();
        $this->_items = $result->getCurrentPage();
    }
}
