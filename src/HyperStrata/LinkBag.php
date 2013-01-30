<?php

namespace HyperStrata;

use ArrayIterator;
use IteratorAggregate;
use BadMethodCallException;
use InvalidArgumentException;

class LinkBag implements IteratorAggregate
{
    protected $links = array();

    public function __construct(array $links = array())
    {
        $this->addLinks($links);
    }

    public function addLink($link)
    {
        if ( ! ($link instanceof Link)) {
            throw new InvalidArgumentException('You may only add HyperStrata\Link objects to the LinkBag.');
        }

        array_push($this->links, $link);
        return $this;
    }

    public function addLinks(array $links)
    {
        foreach ($links as $link) {
            $this->addLink($link);
        }
        return $this;
    }

    /**
     * Gets an ArrayIterator for all the links.  This is required for IteratorAggregate
     * interface.
     *
     * @return IteratorAggregate
     */
    public function getIterator() {
        return new ArrayIterator($this->links);
    }

    /**
     * Converts the Bag to an Array.
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        foreach ($this->links as $link) {
            $arr[$link->getName()] = $link->toArray();
        }

        return $arr;
    }

    /**
     * Converts the Bag to an Json String.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_NUMERIC_CHECK);
    }

}
