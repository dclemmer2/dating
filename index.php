<?php
/*
 * Dana Clemmer
 * 2/8/21
 * index.php controller page that sets up fat free and routes for a dating website
 */

//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start a session
session_start();

$validator = new Validate();
$dataLayer = new DataLayer();
//$order = new Order();
$controller = new Controller($f3);

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default route (home page)
$f3->route('GET /', function() {
    global $controller;
    $controller->home();
});

//Define a personal info route
$f3->route('GET|POST /personal', function () {
    global $controller;
    $controller->personal();
});

//Define a profile route
$f3->route('GET|POST /profile', function () {
    global $controller;
    $controller->profile();
});

//Define an interests route
$f3->route('GET|POST /interests', function () {
    global $controller;
    $controller->interests();
});

//Define a summary route
$f3->route('GET /summary', function () {
    global $controller;
    $controller->summary();
});

//Run fat free
$f3->run();