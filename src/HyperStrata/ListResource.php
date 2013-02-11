<?php

namespace HyperStrata;

class ListResource extends AbstractResource
{
    protected $dataKey = 'data';

    /**
     * Sets the key to use for the data.
     *
     * @param  string  The key to use.
     * @return \HyperStrata\ListResource
     */
    public function setDataKey($dataKey)
    {
        $this->dataKey = $dataKey;

        return $this;
    }

    /**
     * Sets the data for the Resource.
     *
     * @param  array  An array of \HyperStrata\InstanceResource objects.
     * @return \HyperStrata\ListResource
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Adds an item to the data list
     *
     * @param  \HyperStrata\InstanceResource  The Resource to add.
     * @return \HyperStrata\ListResource
     */
    public function addItem(InstanceResource $item)
    {
        $this->data[] = $item;

        return $this;
    }

    /**
     * Returns the current Resource as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        $arr[$this->linksKey] = $this->linkBag->toArray();

        $data = array();
        foreach ($this->data as $item) {
            $arr[$this->dataKey][] = $item->toArray();
        }
        return $arr;
    }
}
