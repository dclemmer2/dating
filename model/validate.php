<?php
/* model/validate.php
 * Contains validation functions for Dating app
 *
 */

class Validate
{
    private $_dataLayer;

    function __construct()
    {
        $this->_dataLayer = new DataLayer();
    }

    /** validName() returns true if name is not empty and
     * contains only letters
     * @param String $name
     * @return boolean
     */
    function validName($name)
    {
        return !empty(trim($name)) && ctype_alpha($name);
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

    /** validPhone() returns true if phone number is not empty and valid
     * @param String $phone
     * @return boolean
     */
    function validPhone($phone)
    {
        return !empty(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone));
    }

    /** validEmail() returns true if email is not empty and valid
     * @param String $email
     * @return boolean
     */
    function validEmail($email)
    {
        return !empty(strpos($email, '@')) && strpos($email, '.');
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

            return !in_array($selected, $validIndoor);
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

            return !in_array($selected, $validOutdoor);
        }
    }
}