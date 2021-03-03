<?php
/**
 * Class PremiumMember creates an object for a premium member
 * signing up for a dating site. Is a subclass of Member
 * @author Dana Clemmer
 */
class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;


    /**
     * Gets indoor interests
     * @return array
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * Sets indoor interests
     * @param array $indoorInterests
     */
    public function setIndoorInterests($indoorInterests): void
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * Gets outdoor interests
     * @return array
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * Sets outdoor interests
     * @param array $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests): void
    {
        $this->_outdoorInterests = $outdoorInterests;
    }


}