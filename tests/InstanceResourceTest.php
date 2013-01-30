<?php

class InstanceResourceTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $resource = new HyperStrata\InstanceResource;

        $this->assertInstanceOf('HyperStrata\InstanceResource', $resource);
    }
}
