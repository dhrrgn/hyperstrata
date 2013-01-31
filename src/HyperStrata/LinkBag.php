<?php

namespace HyperStrata;

use ArrayIterator;
use IteratorAggregate;
use BadMethodCallException;
use InvalidArgumentException;

class LinkBag implements IteratorAggregate
{
    protected $links = array();

    protected $self = null;

    public function __construct($self = null, array $links = array())
    {
        $this->setSelf($self);
        $this->addLinks($links);
    }

    /**
     * Gets the LinkBag's Self Uri.
     *
     * @return strting
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Sets the LinkBags self Uri.
     *
     * @param string $uri
     * @return \HyperStrata\LinkBag
     * @throws  \InvalidArgumentException
     */
    public function setSelf($uri)
    {
        if ( ! is_string($uri) && ! is_null($uri)) {
            throw new InvalidArgumentException('The LinkBag self link must be a string.');
        }

        $this->self = $uri;
        return $this;
    }

    /**
     * Adds a link to the LinkBag.
     *
     * @param  \HyperStrata\Link $link
     * @return \HyperStrata\LinkBag
     * @throws  \InvalidArgumentException
     */
    public function addLink($link)
    {
        if ( ! ($link instanceof Link)) {
            throw new InvalidArgumentException('You may only add HyperStrata\Link objects to the LinkBag.');
        }

        array_push($this->links, $link);
        return $this;
    }

    /**
     * Adds multiple links to the LinkBag.  $links must be an array of
     * \HyperStrata\Link objects.
     *
     * @param  array $links
     * @return \HyperStrata\LinkBag
     */
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
     * @return \IteratorAggregate
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

        // A loose type check is used here because we do not want to include
        // "self" if it is an empty string, false, or null.
        if ($this->self != false) {
            $arr['self'] = $this->self;
        }

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

    /**
     * Returns the Json string for the Bag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

}
