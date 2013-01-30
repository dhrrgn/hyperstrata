<?php

use HyperStrata\Link;

class LinkTest extends PHPUnit_Framework_TestCase
{
    /***********************
     * Instantiation Tests
     ***********************/

    public function testCanInstantiate()
    {
        $link = new Link('foo');
        $this->assertInstanceOf('HyperStrata\Link', $link);
    }

    public function testInstatiationSetsName()
    {
        $link = new Link('foo');
        $name = new ReflectionProperty($link, 'name');
        $name->setAccessible(true);

        $this->assertEquals('foo', $name->getValue($link));
    }

    public function testCanInstantiateWithUri()
    {
        $link = new Link('foo', '/users');
        $uri = new ReflectionProperty($link, 'uri');
        $uri->setAccessible(true);

        $this->assertEquals('/users', $uri->getValue($link));

    }

    public function testCanInstantiateWithMethod()
    {
        $link = new Link('foo', '/users', 'DELETE');
        $method = new ReflectionProperty($link, 'method');
        $method->setAccessible(true);

        $this->assertEquals('DELETE', $method->getValue($link));

    }

    /***********************
     * Name Tests
     ***********************/

    public function testNamePropertyIsProtected()
    {
        $link = new Link('foo');
        $name = new ReflectionProperty($link, 'name');
        $this->assertTrue($name->isProtected());
    }

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

        $name = new ReflectionProperty($link, 'name');
        $name->setAccessible(true);

        $this->assertEquals('bar', $name->getValue($link));
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

    public function testUriPropertyIsProtected()
    {
        $link = new Link('foo');
        $uri = new ReflectionProperty($link, 'uri');
        $this->assertTrue($uri->isProtected());
    }

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

        $uri = new ReflectionProperty($link, 'uri');
        $uri->setAccessible(true);
        $this->assertEquals('/users', $uri->getValue($link));

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

    public function testMethodPropertyIsProtected()
    {
        $link = new Link('foo');
        $method = new ReflectionProperty($link, 'method');
        $this->assertTrue($method->isProtected());
    }

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

        $method = new ReflectionProperty($link, 'method');
        $method->setAccessible(true);
        $this->assertEquals('POST', $method->getValue($link));

    }

    public function testSetMethodConvertsMethodToUpperCase()
    {
        $link = new Link('foo');
        $link->setMethod('post');

        $method = new ReflectionProperty($link, 'method');
        $method->setAccessible(true);
        $this->assertEquals('POST', $method->getValue($link));

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
