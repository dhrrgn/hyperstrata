<?php

class AbstractResourceTest extends PHPUnit_Framework_TestCase
{
    /***********************
     * Instantiation Tests
     ***********************/

    public function testInstantiationCreatesLinkBag()
    {
        $mock = Mockery::mock('HyperStrata\AbstractResource[toArray,setData]', array(''));

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
        $mock = Mockery::mock('HyperStrata\AbstractResource[toArray,setData]');
        $mock->shouldReceive('toArray')->andReturn($linksArr)->mock();


        $this->assertJsonStringEqualsJsonString(json_encode($linksArr, JSON_NUMERIC_CHECK), $mock->toJson());
    }
}
