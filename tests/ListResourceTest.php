<?php

class ListResourceTest extends PHPUnit_Framework_TestCase
{
    protected $listArr = array(
        '_links' => array(
            'self' => '/users'
        ),
        'data' => array(
            array(
                '_links' => array(
                    'self' => '/users/12'
                ),
                'name'  => 'Dan',
                'email' => 'me@dandoescode.com'
            ),
            array(
                '_links' => array(
                    'self' => '/users/13'
                ),
                'name'  => 'Joe',
                'email' => 'joe@foo.com'
            ),
        )
    );

    public function testCanInstantiate()
    {
        $resource = new HyperStrata\ListResource;

        $this->assertInstanceOf('HyperStrata\ListResource', $resource);
    }

    public function testSetData()
    {
        $resource = new HyperStrata\ListResource('/users');

        $resource->setData(array(
            new HyperStrata\InstanceResource('/users/12', array(
                'name'  => 'Dan',
                'email' => 'me@dandoescode.com'
            )),
            new HyperStrata\InstanceResource('/users/13', array(
                'name'  => 'Joe',
                'email' => 'joe@foo.com'
            )),
        ));

        $this->assertEquals($this->listArr, $resource->toArray());
    }

    public function testAddItem()
    {
        $resource = new HyperStrata\ListResource('/users');

        $resource->addItem(new HyperStrata\InstanceResource('/users/12', array(
            'name'  => 'Dan',
            'email' => 'me@dandoescode.com'
        )));
        $resource->addItem(new HyperStrata\InstanceResource('/users/13', array(
            'name'  => 'Joe',
            'email' => 'joe@foo.com'
        )));

        $this->assertEquals($this->listArr, $resource->toArray());
    }

    public function testSetDataKey()
    {
        $resource = new HyperStrata\ListResource('/users');

        $resource->setDataKey('foo');

        $resource->addItem(new HyperStrata\InstanceResource('/users/12', array(
            'name'  => 'Dan',
            'email' => 'me@dandoescode.com'
        )));
        $resource->addItem(new HyperStrata\InstanceResource('/users/13', array(
            'name'  => 'Joe',
            'email' => 'joe@foo.com'
        )));

        $arr = $this->listArr;
        $arr['foo'] = $arr['data'];
        unset($arr['data']);

        $this->assertEquals($arr, $resource->toArray());
    }

}
