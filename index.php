<?php
//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

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

//Define a summary route
$f3->route('POST /summary', function () {
    //Add data from forms to Session array
    if(isset($_POST['fname'])) {
        $_SESSION['fname'] = $_POST['fname'];
    }
    if(isset($_POST['lname'])) {
        $_SESSION['lname'] = $_POST['lname'];
    }
    if(isset($_POST['age'])) {
        $_SESSION['age'] = $_POST['age'];
    }
    if(isset($_POST['phone'])) {
        $_SESSION['phone'] = $_POST['phone'];
    }
    if(isset($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
    }
    if(isset($_POST['state'])) {
        $_SESSION['state'] = $_POST['state'];
    }
    if(isset($_POST['indoor'])) {
        $_SESSION['indoor'] = implode(", ", $_POST['indoor']);
    }
    if(isset($_POST['outdoor'])) {
        $_SESSION['outdoor'] = implode(", ", $_POST['outdoor']);
    }
    if(isset($_POST['biography'])) {
        $_SESSION['biography'] = $_POST['biography'];
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();