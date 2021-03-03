<?php
/**
 * Class Member creates an object for a member signing up for a dating site
 * @author Dana Clemmer
 */
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
     * Gets first name
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Sets first name
     * @param String $fname
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * Gets last name
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets last name
     * @param String $lname
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * Gets age
     * @return int
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Sets age
     * @param int $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * Gets gender
     * @return String
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Sets gender
     * @param String $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * Gets phone number
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Sets phone number
     * @param String $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * Gets email
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets email
     * @param String $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * Gets state
     * @return String
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Sets state
     * @param String $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * Gets gender seeking
     * @return String
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Sets gender seeking
     * @param String $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * Gets bio
     * @return String
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Sets bio
     * @param String $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }
}
