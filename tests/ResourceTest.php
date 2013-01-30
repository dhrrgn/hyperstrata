<?php

class ResourceTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $resource = new HyperStrata\Resource;

        $this->assertInstanceOf('HyperStrata\Resource', $resource);
    }
}
