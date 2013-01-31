<?php

namespace HyperStrata;

use InvalidArgumentException;

class Link
{
    protected $name = '';

    protected $uri = '';

    protected $method = '';

    protected $validMethods = array('GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD', 'OPTIONS');

    /**
     * Constructs the Link object.
     *
     * @param string $uri
     * @param string $name
     * @param string $method
     */
    public function __construct($name, $uri = '', $method = 'GET')
    {
        $this->setName($name);
        $this->setUri($uri);
        $this->setMethod($method);
    }

    /**
     * Gets the Name of the Link.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Link's Name.
     *
     * @param  string $name
     * @return \HyperStrata\Link
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if ( ! is_string($name)) {
            throw new InvalidArgumentException('The Link Name must be a string.');
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Gets the Uri of the Link.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Sets the Link's Uri.
     *
     * @param  string $uri
     * @return \HyperStrata\Link
     * @throws \InvalidArgumentException
     */
    public function setUri($uri)
    {
        if ( ! is_string($uri)) {
            throw new InvalidArgumentException('The URI must be a string.');
        }

        $this->uri = $uri;
        return $this;
    }

    /**
     * Gets the Method of the Link.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the Link's Method.
     *
     * @param  string $method
     * @return \HyperStrata\Link
     * @throws \InvalidArgumentException
     */
    public function setMethod($method)
    {
        if ( ! is_string($method)) {
            throw new InvalidArgumentException('The Link Name must be a string.');
        }

        $method = strtoupper($method);
        if ( ! in_array($method, $this->validMethods)) {
            throw new InvalidArgumentException(
                sprintf('Invalid Link Method. Valid Methods: %s', implode(', ', $this->validMethods))
            );
        }

        $this->method = $method;
        return $this;
    }

    /**
     * Returns the Link as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'method' => $this->getMethod(),
            'uri' => $this->getUri()
        );
    }

}
