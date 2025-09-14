<?php

namespace Razorpay\Api;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

class Resource implements ArrayAccess, IteratorAggregate
{
    protected $attributes = array();

    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }

    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return (isset($this->attributes[$offset]));
    }

    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->attributes[$offset];
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function __get($key)
    {
        return $this->attributes[$key];
    }

    #[\ReturnTypeWillChange]
    public function __set($key, $value)
    {
        return $this->attributes[$key] = $value;
    }

    #[\ReturnTypeWillChange]
    public function __isset($key)
    {
        return (isset($this->attributes[$key]));
    }

    #[\ReturnTypeWillChange]
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
}