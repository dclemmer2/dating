<?php

/*
 * controllers/controller.php
 * Controller file
 */


class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /** Display home page */
    function home()
    {
        //Display a view
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /** Display personal info page */
    function personal()
    {
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get the data from the POST array
            $userFirstName = $_POST['fname'];
            $userLastName = $_POST['lname'];
            $userAge = trim($_POST['age']);
            $userGender = $_POST['gender'];
            $userPhone = $_POST['phone'];
            $premium = $_POST['premium'];

            //check if premium member to create an object based on that
            if (isset($premium)) {
                $member = new PremiumMember($userFirstName, $userLastName,
                    $userAge, $userGender, $userPhone);
            }
            else {
                $member = new Member($userFirstName, $userLastName,
                    $userAge, $userGender, $userPhone);
            }

            //If first name is valid --> Store in session
            if ($validator->validFirstName($userFirstName)) {
                //add first name to member and premium member objects
                $member->setFname($userFirstName);
            } //First name is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["fname"]', "*First name cannot be blank and must contain only characters");
            }

            //If last name is valid --> Store in session
            if ($validator->validLastName($userLastName)) {
                $member->setLname($userLastName);
            } //Last name is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["lname"]', "*Last name cannot be blank and must contain only characters");
            }

            //If gender is input, store in session
            if (isset($userGender)) {
                if ($validator->validGender($userGender)) {
                    $member->setGender($userGender);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["gender"]', "*Go away, evildoer!");
                }
            }

            //If age is valid --> Store in session
            if ($validator->validAge($userAge)) {
                $member->setAge($userAge);
            } //Age is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["age"]', "*Age cannot be blank and must be a valid age between 18 and 118");
            }

            //If phone is valid --> Store in session
            if ($validator->validPhone($userPhone)) {
                $member->setPhone($userPhone);
            } //Email is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["phone"]', "*Phone cannot be blank and must be a valid number");
            }

            //If there are no errors, redirect to /profile
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['member'] = $member;
                $this->_f3->reroute('/profile');
            }
        }

        //add genders array
        $this->_f3->set('genders', $dataLayer->getGender());

        //Make form sticky
        $this->_f3->set('userFName', isset($userFirstName) ? $userFirstName : "");
        $this->_f3->set('userLName', isset($userLastName) ? $userLastName : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");
        $this->_f3->set('userPremium', isset($premium) ? $premium : "");

        //Display a view
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    /** Display profile page */
    function profile()
    {
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get the data from the POST array
            $userEmail = trim($_POST['email']);
            $genderSeeking = $_POST['seeking'];
            $userBio = $_POST['bio'];
            $userState = $_POST['state'];

            //If email is valid --> Store in session
            if ($validator->validEmail($userEmail)) {
                $_SESSION['member']->setEmail($userEmail);
            } //Email is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["email"]', "*Email cannot be blank and must be a valid email");
            }

            //If state is input, store in session
            if (isset($userState)) {
                if ($validator->validState($userState)) {
                    $_SESSION['member']->setState($userState);
                } else if ($userState == "Choose...") {
                    $_SESSION['member']->setState("");
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["state"]', "*Go away, evildoer!");
                }
            }

            //If gender seeking is input, store in session
            if (isset($genderSeeking)) {
                if ($validator->validGender($genderSeeking)) {
                    $_SESSION['member']->setSeeking($genderSeeking);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["seeking"]', "*Go away, evildoer!");
                }
            }

            //If bio is input, store in session
            if (isset($userBio)) {
                $_SESSION['member']->setBio($userBio);
            }

            //if premium checkbox is checked and there are no errors, redirect to /interests
            if ($_SESSION['member'] instanceOf PremiumMember && empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/interests');
            }//if premium checkbox is not checked and there are no errors, redirect to /summary
            else {
                if (empty($this->_f3->get('errors'))) {
                    $this->_f3->reroute('/summary');
                }
            }
        }

        //get arrays
        $this->_f3->set('genders', $dataLayer->getGender());
        $this->_f3->set('states', $dataLayer->getStates());

        //Make form sticky
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('genderSeeking', isset($genderSeeking) ? $genderSeeking : "");
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");
        $this->_f3->set('userState', isset($userState) ? $userState : "");

        //Display a view
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /** Display interests page */
    function interests()
    {
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get activities from post array
            $indoorActivities = $_POST['indoor'];
            $outdoorActivities = $_POST['outdoor'];

            //If indoor interests were selected
            if (isset($indoorActivities)) {
                //Data is valid -> Add to session
                if ($validator->validIndoor($indoorActivities)) {
                    $indoorActivities = implode(", ", $indoorActivities);
                    $_SESSION['member']->setIndoorInterests($indoorActivities);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["indoor"]', "*Go away, evildoer!");
                }

                /*   if(isset($_POST['indoor'])) {
                       $_SESSION['indoor'] = implode(", ", $_POST['indoor']) . ",";
                   }
                   else {
                       $_SESSION['indoor'] = "";
                   }*/
            }

            //If outdoor interests were selected
            if (isset($outdoorActivities)) {
                //Data is valid -> Add to session
                if ($validator->validOutdoor($outdoorActivities)) {
                    $outdoorActivities = ", " . implode(", ", $outdoorActivities);
                    $_SESSION['member']->setOutdoorInterests($outdoorActivities);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["outdoor"]', "*Go away, evildoer!");
                }

                /*
                   if(isset($_POST['outdoor'])) {
                       $_SESSION['outdoor'] = implode(", ", $_POST['outdoor']);
                   }
                   else {
                       $_SESSION['outdoor'] = "";
                   }*/
            }

            //If there are no errors, redirect user to interests page
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');
            }
        }
        //get arrays
        $this->_f3->set('indoor', $dataLayer->getIndoor());
        $this->_f3->set('outdoor', $dataLayer->getOutdoor());

        //Display a view
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /** Display summary page */
    function summary()
    {
        //var_dump($_SESSION);

        //Display a view
        $view = new Template();
        echo $view->render('views/summary.html');

        //Clear the SESSION array
        session_destroy();
    }
}
