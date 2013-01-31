<?php

use HyperStrata\Link;
use HyperStrata\LinkBag;

class LinkBagTest extends PHPUnit_Framework_TestCase
{
    /***********************
     * Instantiation Tests
     ***********************/

    public function testCanInstantiate()
    {
        $bag = new LinkBag();
        $this->assertInstanceOf('HyperStrata\LinkBag', $bag);
    }

    public function testCanInstantiateWithLinks()
    {
        $bag = new LinkBag('/users', array(
            new Link('foo', '/foo'),
            new Link('bar', '/foo'),
            new Link('baz', '/foo'),
        ));

        $links = new ReflectionProperty($bag, 'links');
        $links->setAccessible(true);

        $this->assertEquals(3, count($links->getValue($bag)));
    }

    /***********************
     * getSelf Tests
     ***********************/

    public function testSelfPropertyIsProtected()
    {
        $bag = new LinkBag();
        $self = new ReflectionProperty($bag, 'self');
        $this->assertTrue($self->isProtected());
    }

    public function testGetSelf()
    {
        $bag = new LinkBag();
        $self = new ReflectionProperty($bag, 'self');
        $self->setAccessible(true);
        $self->setValue($bag, '/foobar');

        $this->assertEquals('/foobar', $bag->getSelf());

    }

    public function testSetSelfWithValidDate()
    {
        $bag = new LinkBag();
        $self = new ReflectionProperty($bag, 'self');
        $self->setAccessible(true);

        $bag->setSelf('/bar');
        $this->assertEquals('/bar', $self->getValue($bag));

        $bag->setSelf(null);
        $this->assertEquals(null, $self->getValue($bag));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelfWithInvalidDataThrowsException()
    {
        $bag = new LinkBag();
        $bag->setSelf(new stdClass);
    }

    /*************************************
     * IteratorAggregate Interface Tests
     *************************************/

    public function testProperlyImplementsIteratorAggregate()
    {
        $bag = new LinkBag();
        $this->assertInstanceOf('ArrayIterator', $bag->getIterator());
    }

    /***********************
     * addLink Tests
     ***********************/

    public function testAddLink()
    {
        $bag = new LinkBag();
        $bag->addLink(new Link('foo', '/foo'));

        $links = new ReflectionProperty($bag, 'links');
        $links->setAccessible(true);

        $this->assertEquals(1, count($links->getValue($bag)));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddLinkWithInvalidValueThrowsException()
    {
        $bag = new LinkBag();
        $bag->addLink(new stdClass);
    }

    /***********************
     * toArray Tests
     ***********************/

    public function testToArrayWithSelf()
    {
        $expected = array(
            "self" => "/users",
            "foo" => array(
                "method" => "GET",
                "uri" => "/foo"
            ),
            "bar" => array(
                "method" => "POST",
                "uri" => "/bar"
            ),
            "baz" => array(
                "method" => "DELETE",
                "uri" => "/baz"
            ),
        );
        $bag = new LinkBag('/users', array(
            new Link('foo', '/foo'),
            new Link('bar', '/bar', 'POST'),
            new Link('baz', '/baz', 'DELETE'),
        ));

        $this->assertEquals($expected, $bag->toArray());
    }

    public function testToArrayWithoutSelf()
    {
        $expected = array(
            "foo" => array(
                "method" => "GET",
                "uri" => "/foo"
            ),
            "bar" => array(
                "method" => "POST",
                "uri" => "/bar"
            ),
            "baz" => array(
                "method" => "DELETE",
                "uri" => "/baz"
            ),
        );
        $bag = new LinkBag(null, array(
            new Link('foo', '/foo'),
            new Link('bar', '/bar', 'POST'),
            new Link('baz', '/baz', 'DELETE'),
        ));

        $this->assertEquals($expected, $bag->toArray());
    }

    /***********************
     * toJson Tests
     ***********************/

    public function testToJson()
    {
        $expected = array(
            "self" => "/users",
            "foo" => array(
                "method" => "GET",
                "uri" => "/foo"
            ),
            "bar" => array(
                "method" => "POST",
                "uri" => "/bar"
            ),
            "baz" => array(
                "method" => "DELETE",
                "uri" => "/baz"
            ),
        );
        $bag = new LinkBag('/users', array(
            new Link('foo', '/foo'),
            new Link('bar', '/bar', 'POST'),
            new Link('baz', '/baz', 'DELETE'),
        ));

        $this->assertJsonStringEqualsJsonString(json_encode($expected, JSON_NUMERIC_CHECK), $bag->toJson());
    }

    /***********************
     * __toString Tests
     ***********************/

    public function testToString()
    {
        $expected = array(
            "self" => "/users",
            "foo" => array(
                "method" => "GET",
                "uri" => "/foo"
            ),
        );
        $bag = new LinkBag('/users', array(
            new Link('foo', '/foo'),
        ));

        $this->assertJsonStringEqualsJsonString(json_encode($expected, JSON_NUMERIC_CHECK), (string) $bag);
    }

}
