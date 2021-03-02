<?php

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor
     * @param $_fname
     * @param $_lname
     * @param $_age
     * @param $_gender
     * @param $_phone
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param String $fname
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param String $lname
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param int $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * @return String
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param String $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return String
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param String $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * @return String
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param String $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return String
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param String $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }
}
