<?php

class InstanceResourceTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $resource = new HyperStrata\InstanceResource;

        $this->assertInstanceOf('HyperStrata\InstanceResource', $resource);
    }

    public function testSimpleData()
    {
        $resource = new HyperStrata\InstanceResource('/users/12');

        $resource->setData(array(
            'name'  => 'Dan',
            'email' => 'me@dandoescode.com'
        ));

        $this->assertEquals(array(
            '_links' => array(
                'self' => '/users/12'
            ),
            'name'  => 'Dan',
            'email' => 'me@dandoescode.com'
        ), $resource->toArray());
    }

}
