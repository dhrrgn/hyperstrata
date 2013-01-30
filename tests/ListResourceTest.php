<?php

class ListResourceTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $resource = new HyperStrata\ListResource;

        $this->assertInstanceOf('HyperStrata\ListResource', $resource);
    }
}
