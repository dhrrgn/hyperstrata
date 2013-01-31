<?php

namespace HyperStrata;

class ListResource implements ResourceInterface
{
    protected $linkBag;

    public function __construct()
    {
        $this->linkBag = new LinkBag;
    }

    /**
     * Sets the Resource Base URI.
     *
     * @param  string $uri
     * @return \HyperStrata\ResourceInterface
     */
    public function setUri($uri)
    {

    }

    /**
     * Adds a link to the Resource's LinkBag.
     *
     * @param  \HyperStrata\Link $link
     * @return \HyperStrata\ResourceInterface
     */
    public function addLink(Link $link)
    {

    }

    /**
     * Adds multiple links to the Resource's LinkBag.  $links must be an array of
     * \HyperStrata\Link objects.
     *
     * @param  array $links
     * @return \HyperStrata\ResourceInterface
     */
    public function addLinks(array $links)
    {

    }

    /**
     * Returns the current Resource as an array.
     *
     * @return array
     */
    public function toArray()
    {

    }

    /**
     * Returns the Resource as a JSON encoded string.
     *
     * @return string
     */
    public function toJson()
    {

    }

    /**
     * Returns the Resource as a JSON encoded string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
