<?php

namespace HyperStrata;

class InstanceResource extends AbstractResource
{
    /**
     * Sets the data for the Resource.
     *
     * @return \HyperStrata\InstanceResource
     */
    public function setData(array $data)
    {
        $this->data = $data;

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

        return array_merge($arr, $this->data);
    }
}
