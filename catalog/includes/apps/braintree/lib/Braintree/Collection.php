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

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Braintree Generic collection.
 *
 * Based on Generic Collection class from:
 * {@link http://codeutopia.net/code/library/CU/Collection.php}
 */
class Collection implements \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * @var array collection storage
     */
    protected array $_collection = [];

    /**
     * Add a value into the collection.
     *
     * @param string $value
     */
    public function add($value): void
    {
        $this->_collection[] = $value;
    }

    /**
     * Set index's value.
     *
     * @param int   $index
     * @param mixed $value
     *
     * @throws \OutOfRangeException
     */
    public function set($index, $value): void
    {
        if ($index >= $this->count()) {
            throw new \OutOfRangeException('Index out of range');
        }

        $this->_collection[$index] = $value;
    }

    /**
     * Remove a value from the collection.
     *
     * @param int $index index to remove
     *
     * @throws \OutOfRangeException if index is out of range
     */
    public function remove($index): void
    {
        if ($index >= $this->count()) {
            throw new \OutOfRangeException('Index out of range');
        }

        array_splice($this->_collection, $index, 1);
    }

    /**
     * Return value at index.
     *
     * @param int $index
     *
     * @throws \OutOfRangeException
     *
     * @return mixed
     */
    public function get($index)
    {
        if ($index >= $this->count()) {
            throw new \OutOfRangeException('Index out of range');
        }

        return $this->_collection[$index];
    }

    /**
     * Determine if index exists.
     *
     * @param int $index
     *
     * @return bool
     */
    public function exists($index)
    {
        if ($index >= $this->count()) {
            return false;
        }

        return true;
    }
    /**
     * Return count of items in collection
     * Implements countable.
     *
     * @return int
     */
    public function count()
    {
        return \count($this->_collection);
    }

    /**
     * Return an iterator
     * Implements IteratorAggregate.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_collection);
    }

    /**
     * Set offset to value
     * Implements ArrayAccess.
     *
     * @see set
     *
     * @param int   $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * Unset offset
     * Implements ArrayAccess.
     *
     * @see remove
     *
     * @param int $offset
     */
    public function offsetUnset($offset): void
    {
        $this->remove($offset);
    }

    /**
     * get an offset's value
     * Implements ArrayAccess.
     *
     * @see get
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Determine if offset exists
     * Implements ArrayAccess.
     *
     * @see exists
     *
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }
}
