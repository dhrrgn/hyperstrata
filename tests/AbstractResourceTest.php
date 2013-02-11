<?php

class AbstractResourceTest extends PHPUnit_Framework_TestCase
{
    /***********************
     * Instantiation Tests
     ***********************/

    public function testInstantiationCreatesLinkBag()
    {
        $mock = $this->getMockForAbstractClass('HyperStrata\AbstractResource');

        $this->assertAttributeInstanceOf('HyperStrata\LinkBag', 'linkBag', $mock);
    }

    public function testToJson()
    {
        $linksArr = array(
            'self' => '/users',
            'create' => array(
                'method' => 'POST',
                'uri'    => '/users'
            )
        );
        $mock = $this->getMockForAbstractClass('HyperStrata\AbstractResource');
        $mock->expects($this->once())
             ->method('toArray')
             ->will($this->returnValue($linksArr));

        $this->assertJsonStringEqualsJsonString(json_encode($linksArr, JSON_NUMERIC_CHECK), $mock->toJson());
    }
}
