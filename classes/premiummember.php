<?php

class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;


    /**
     * @return array
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param array $indoorInterests
     */
    public function setIndoorInterests($indoorInterests): void
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return array
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param array $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests): void
    {
        $this->_outdoorInterests = $outdoorInterests;
    }


}