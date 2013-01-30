<?php

class LinkTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $link = new HyperStrata\Link;

        $this->assertInstanceOf('HyperStrata\Link', $link);
    }
}
