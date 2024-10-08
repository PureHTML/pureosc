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

/**
 * Braintree ResourceCollection
 * ResourceCollection is a container object for result data.
 *
 * stores and retrieves search results and aggregate data
 *
 * example:
 * <code>
 * $result = Customer::all();
 *
 * foreach($result as $transaction) {
 *   print_r($transaction->id);
 * }
 * </code>
 */
class ResourceCollection implements \Iterator
{
    private $_batchIndex;
    private $_ids;
    private $_index;
    private $_items;
    private $_pageSize;
    private $_pager;

    /**
     * set up the resource collection.
     *
     * expects an array of attributes with literal keys
     *
     * @param array $response
     * @param array $pager
     */
    public function __construct($response, $pager)
    {
        $this->_pageSize = $response['searchResults']['pageSize'];
        $this->_ids = $response['searchResults']['ids'];
        $this->_pager = $pager;
    }

    /**
     * returns the current item when iterating with foreach.
     */
    public function current()
    {
        return $this->_items[$this->_index];
    }

    /**
     * returns the first item in the collection.
     *
     * @return mixed
     */
    public function firstItem()
    {
        $ids = $this->_ids;
        $page = $this->_getPage([$ids[0]]);

        return $page[0];
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
     * rewinds the testIterateOverResults collection to the first item when iterating with foreach.
     */
    public function rewind(): void
    {
        $this->_batchIndex = 0;
        $this->_getNextPage();
    }

    /**
     * returns whether the current item is valid when iterating with foreach.
     */
    public function valid()
    {
        if ($this->_index === \count($this->_items) && $this->_batchIndex < \count($this->_ids)) {
            $this->_getNextPage();
        }

        if ($this->_index < \count($this->_items)) {
            return true;
        }

        return false;
    }

    public function maximumCount()
    {
        return \count($this->_ids);
    }

    /**
     * returns all IDs in the collection.
     *
     * @return array
     */
    public function getIds()
    {
        return $this->_ids;
    }

    private function _getNextPage(): void
    {
        if (empty($this->_ids)) {
            $this->_items = [];
        } else {
            $this->_items = $this->_getPage(\array_slice($this->_ids, $this->_batchIndex, $this->_pageSize));
            $this->_batchIndex += $this->_pageSize;
            $this->_index = 0;
        }
    }

    /**
     * requests the next page of results for the collection.
     *
     * @param mixed $ids
     */
    private function _getPage($ids)
    {
        $object = $this->_pager['object'];
        $method = $this->_pager['method'];
        $methodArgs = [];

        foreach ($this->_pager['methodArgs'] as $arg) {
            $methodArgs[] = $arg;
        }

        $methodArgs[] = $ids;

        return \call_user_func_array(
            [$object, $method],
            $methodArgs,
        );
    }
}
