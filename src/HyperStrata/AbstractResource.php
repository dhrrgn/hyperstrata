<?php

namespace HyperStrata;

abstract class AbstractResource
{
    /**
     * Sets the data for the Resource.
     *
     * @return \HyperStrata\AbstractResource
     */
    abstract public function setData(array $data);

    /**
     * Returns the current Resource as an array.
     *
     * @return array
     */
    abstract public function toArray();


    protected $data;

    protected $linkBag;

    protected $linksKey = '_links';

    public function __construct($uri = null, array $data = null)
    {
        // @codeCoverageIgnoreStart
        $this->linkBag = new LinkBag;
        $this->setUri($uri);

        if ( ! is_null($data)) {
            $this->setData($data);
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * Sets the Resource Base URI.
     *
     * @param  string $uri
     * @return \HyperStrata\AbstractResource
     */
    public function setUri($uri)
    {
        // @codeCoverageIgnoreStart
        $this->linkBag->setSelf($uri);
        // @codeCoverageIgnoreEnd
    }

    /**
     * Adds a link to the Resource's LinkBag.
     *
     * @param  \HyperStrata\Link $link
     * @return \HyperStrata\AbstractResource
     */
    public function addLink(Link $link)
    {
        // @codeCoverageIgnoreStart
        $this->linkBag->addLink($link);
        return $this;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Adds multiple links to the Resource's LinkBag.  $links must be an array of
     * \HyperStrata\Link objects.
     *
     * @param  array $links
     * @return \HyperStrata\AbstractResource
     */
    public function addLinks(array $links)
    {
        // @codeCoverageIgnoreStart
        $this->linkBag->addLinks($links);
        return $this;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Returns the Resource as a JSON encoded string.
     *
     * @return string
     */
    public function toJson($flags = 0)
    {
        return json_encode($this->toArray(), $flags);
    }

    /**
     * Returns the Resource as a JSON encoded string.
     *
     * @return string
     */
    public function __toString()
    {
        // @codeCoverageIgnoreStart
        return $this->toJson();
        // @codeCoverageIgnoreEnd
    }
}
