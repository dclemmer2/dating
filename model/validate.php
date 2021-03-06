<?php
/* model/validate.php
 * Contains validation functions for Dating app
 *
 */

class Validate
{
    private $_dataLayer;

    function __construct($dataLayer)
    {
        $this->_dataLayer = $dataLayer;
    }

    /** validFirstName() returns true if first name is not empty and
     * contains only letters
     * @param String $fname
     * @return boolean
     */
    function validFirstName($fname)
    {
        return !empty(trim($fname)) && ctype_alpha($fname);
    }

    /** validLastName() returns true if last name is not empty and
     * contains only letters
     * @param String $lname
     * @return boolean
     */
    function validLastName($lname)
    {
        return !empty(trim($lname)) && ctype_alpha($lname);
    }

    /** validAge() returns true if age is not empty and contains
     * only numbers and is between 18 and 118
     * @param int $age
     * @return boolean
     */
    function validAge($age)
    {
        return !empty(is_numeric($age)) && 18 <= $age && $age <= 118;
    }

    /** validGender() returns true if selected gender is in list of valid options
     * @param String $gender
     * @return boolean
     */
    function validGender($gender)
    {
        $validGender = $this->_dataLayer->getGender();
        return in_array($gender, $validGender);
    }

    /** validPhone() returns true if phone number is not empty and valid
     * @param String $phone
     * @return boolean
     */
    function validPhone($phone)
    {
        return !empty($phone) && preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/", $phone);
    }

    /** validEmail() returns true if email is not empty and valid
     * @param String $email
     * @return boolean
     */
    function validEmail($email)
    {
        return !empty(preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email));
    }

    /** validState() returns true if selected state is in list of valid options
     * @param String $state
     * @return boolean
     */
    function validState($state)
    {
        $validState = $this->_dataLayer->getStates();
        return in_array($state, $validState);
    }

    /** validIndoor() returns true if selected indoor interests are all in
     * the list of valid options
     * @param String $selectedIndoor
     * @return boolean
     */
    function validIndoor($selectedIndoor)
    {
        //Get valid indoor activities from data layer
        $validIndoor = $this->_dataLayer->getIndoor();

        //Check every selected indoor activity
        foreach ($selectedIndoor as $selected) {

            return in_array($selected, $validIndoor);
        }
    }


    /** validOutdoor() returns true if selected outdoor interests are all in
     * the list of valid options
     * @param String $selectedOutdoor
     * @return boolean
     */
    function validOutdoor($selectedOutdoor)
    {
        //Get valid outdoor activities from data layer
        $validOutdoor = $this->_dataLayer->getOutdoor();

        //Check every selected outdoor activity
        foreach ($selectedOutdoor as $selected) {

            return in_array($selected, $validOutdoor);
        }
    }
}