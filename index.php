<?php
//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default route (home page)
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a personal info route
$f3->route('GET /personal', function () {
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

//Define a profile route
$f3->route('POST /profile', function () {
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Define an interests route
$f3->route('POST /interests', function () {
    $view = new Template();
    echo $view->render('views/interests.html');
});

//Run fat free
$f3->run();