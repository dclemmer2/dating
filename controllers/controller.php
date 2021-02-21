<?php

//  controllers/controller.php

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
        //  global $order;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get the data from the POST array
            $userFirstName = $_POST['fname'];
            $userLastName = $_POST['lname'];
            $userAge = trim($_POST['age']);
            $userGender = $_POST['gender'];
            $userPhone = $_POST['phone'];

            //If first name is valid --> Store in session
            if ($validator->validFirstName($userFirstName)) {
                //$order->setFood($userFood);
                $_SESSION['fname'] = $userFirstName;
            } //First name is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["fname"]', "First name cannot be blank and must contain only characters");
            }

            //If last name is valid --> Store in session
            if ($validator->validLastName($userLastName)) {
                //$order->setFood($userFood);
                $_SESSION['lname'] = $userLastName;
            } //Last name is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["lname"]', "Last name cannot be blank and must contain only characters");
            }

            //If gender is input, store in session
            if (isset($userGender)) {
                if ($validator->validGender($userGender)) {
                    $_SESSION['gender'] = $userGender;
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["gender"]', "Go away, evildoer!");
                }
            }

            //If age is valid --> Store in session
            if ($validator->validAge($userAge)) {
                //$order->setFood($userFood);
                $_SESSION['age'] = $userAge;
            } //Age is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["age"]', "Age cannot be blank and must be a valid age between 18 and 118");
            }

            //If phone is valid --> Store in session
            if ($validator->validPhone($userPhone)) {
                //$order->setFood($userFood);
                $_SESSION['phone'] = $userPhone;
            } //Email is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["phone"]', "Phone cannot be blank and must be a valid number");
            }

            //If there are no errors, redirect to /profile
            if (empty($this->_f3->get('errors'))) {
                // $_SESSION['order'] = $order;
                $this->_f3->reroute('/profile');
            }
        }

        $this->_f3->set('gender', $dataLayer->getGender());

        //Make form sticky
        $this->_f3->set('userFName', isset($userFirstName) ? $userFirstName : "");
        $this->_f3->set('userLName', isset($userLastName) ? $userLastName : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        //  $this->_f3->set('userMeal', isset($userMeal) ? $userMeal : "");

        //Display a view
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    function profile()
    {
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get the data from the POST array
            $userEmail = trim($_POST['email']);
            $genderSeeking = $_POST['seeking'];

            //If email is valid --> Store in session
            if ($validator->validEmail($userEmail)) {
                //$order->setFood($userFood);
                $_SESSION['email'] = $userEmail;
            } //Email is not valid -> Set an error in F3 hive
            else {
                $this->_f3->set('errors["email"]', "Email cannot be blank and must be a valid email");
            }

            //store state in session
            $_SESSION['state'] = $_POST['state'];

            //If gender seeking is input, store in session
            if (isset($genderSeeking)) {
                if ($validator->validGender($genderSeeking)) {
                    $_SESSION['seeking'] = $genderSeeking;
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["seeking"]', "Go away, evildoer!");
                }
            }

            //If bio is input, store in session
            if (isset($_POST['bio'])) {
                $_SESSION['bio'] = $_POST['bio'];
            }

            //If there are no errors, redirect to /profile
            if (empty($this->_f3->get('errors'))) {
                // $_SESSION['order'] = $order;
                $this->_f3->reroute('/interests');
            }
        }

        $this->_f3->set('gender', $dataLayer->getGender());

        //Make form sticky
        $this->_f3->set('userGender', isset($genderSeeking) ? $genderSeeking : "");

        //Display a view
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //If indoor interests were selected
            if (isset($_POST['indoor'])) {
                //Get indoor activities from post array
                $indoorActivities = $_POST['indoor'];
                $outdoorActivities = $_POST['outdoor'];

                //Data is valid -> Add to session
                if ($validator->validIndoor($indoorActivities)) {
                    // $condimentString = implode(", ", $indoorActivities);
                    // $_SESSION['indoor']->setCondiments($condimentString);
                    $_SESSION['indoor'] = implode(", ", $indoorActivities);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["indoor"]', "Go away, evildoer!");
                }

                //Data is valid -> Add to session
                if ($validator->validOutdoor($outdoorActivities)) {
                    // $condimentString = implode(", ", $indoorActivities);
                    // $_SESSION['indoor']->setCondiments($condimentString);
                    $_SESSION['outdoor'] = implode(", ", $outdoorActivities);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["outdoor"]', "Go away, evildoer!");
                }

                /*   if(isset($_POST['indoor'])) {
                       $_SESSION['indoor'] = implode(", ", $_POST['indoor']) . ",";
                   }
                   else {
                       $_SESSION['indoor'] = "";
                   }
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

        $this->_f3->set('indoor', $dataLayer->getIndoor());
        $this->_f3->set('outdoor', $dataLayer->getOutdoor());

        //Display a view
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        //Display a view
        $view = new Template();
        echo $view->render('views/summary.html');

        //Clear the SESSION array
        session_destroy();
    }
}
