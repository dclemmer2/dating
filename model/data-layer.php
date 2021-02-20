<?php

/* model/data-layer.php
 * returns data for my dating app
 *
 */

class DataLayer
{
    /** getIndoor() returns an array of indoor activities
     *  @return array
     */
    function getIndoor()
    {
        return array("tv", "puzzles", "movies", "reading", "cooking",
            "playing cards", "board games", "videogames");
    }

    /** getOutdoor() returns an array of outdoor activities
     *  @return array
     */
    function getOutdoor()
    {
        return array("hiking", "walking", "biking", "climbing", "swimming", "collecting");
    }
}