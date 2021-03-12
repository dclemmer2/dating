<?php

/* model/data-layer.php
 * returns data for my dating app
 *
 */

class DataLayer
{
    private $_dbh;
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /** getGender() returns an array of gender options
     *  @return array
     */
    function getGender()
    {
        return array("male", "female");
    }

    /** getIndoor() returns an array of indoor activities
     *  @return array
     */
    function getIndoor()
    {
        return array("tv", "movies", "reading", "cooking",
            "puzzles", "playing cards", "board games", "videogames");
    }

    /** getOutdoor() returns an array of outdoor activities
     *  @return array
     */
    function getOutdoor()
    {
        return array("hiking", "walking", "biking", "climbing", "swimming", "collecting");
    }

    /** getStates() returns an array of states
     *  @return array
     */
    function getStates()
    {
        return array("washington", "oregon", "california");
    }
}