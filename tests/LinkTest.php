<?php

use HyperStrata\Link;

class LinkTest extends PHPUnit_Framework_TestCase
{
    /***********************
     * Instantiation Tests
     ***********************/

    public function testCanInstantiate()
    {
        $this->assertInstanceOf('HyperStrata\Link', new Link('foo'));
    }

    public function testInstatiationSetsName()
    {
        $this->assertAttributeEquals('foo', 'name', new Link('foo'));
    }

    public function testCanInstantiateWithUri()
    {
        $this->assertAttributeEquals('/users', 'uri', new Link('foo', '/users'));
    }

    public function testCanInstantiateWithMethod()
    {
        $this->assertAttributeEquals('DELETE', 'method', new Link('foo', '/users', 'DELETE'));
    }

    /***********************
     * Name Tests
     ***********************/

    public function testGetName()
    {
        $link = new Link('');

        $name = new ReflectionProperty($link, 'name');
        $name->setAccessible(true);
        $name->setValue($link, 'foobar');

        $this->assertEquals('foobar', $link->getName());

    }

    public function testSetNameWithString()
    {
        $link = new Link('foo');
        $link->setName('bar');

        $this->assertAttributeEquals('bar', 'name', $link);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetNameWithNonStringThrowsException()
    {
        $link = new Link('foo');
        $link->setName(new stdClass);
    }

    /***********************
     * Uri Tests
     ***********************/

    public function testGetUri()
    {
        $link = new Link('foo');

        $uri = new ReflectionProperty($link, 'uri');
        $uri->setAccessible(true);
        $uri->setValue($link, '/hello');

        $this->assertEquals('/hello', $link->getUri());

    }

    public function testCanSetUriWithString()
    {
        $link = new Link('foo');
        $link->setUri('/users');

        $this->assertAttributeEquals('/users', 'uri', $link);

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUriWithNonStringThrowsException()
    {
        $link = new Link('foo');
        $link->setUri(new stdClass);
    }

    /***********************
     * Method Tests
     ***********************/

    public function testGetMethod()
    {
        $link = new Link('foo');

        $method = new ReflectionProperty($link, 'method');
        $method->setAccessible(true);
        $method->setValue($link, 'POST');

        $this->assertEquals('POST', $link->getMethod());

    }

    public function testCanSetMethodWithString()
    {
        $link = new Link('foo');
        $link->setMethod('POST');

        $this->assertAttributeEquals('POST', 'method', $link);

    }

    public function testSetMethodConvertsMethodToUpperCase()
    {
        $link = new Link('foo');
        $link->setMethod('post');

        $this->assertAttributeEquals('POST', 'method', $link);

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetMethodWithNonStringThrowsException()
    {
        $link = new Link('foo');
        $link->setMethod(new stdClass);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetMethodWithInvalidMethodThrowsException()
    {
        $link = new Link('foo');
        $link->setMethod('JOLLY');
    }

    /***********************
     * toArray Tests
     ***********************/

    public function testToArray()
    {
        $expected = array(
            "method" => "GET",
            "uri" => "/users"
        );
        $link = new Link('users', '/users', 'GET');

        $this->assertEquals($expected, $link->toArray());
    }

}
