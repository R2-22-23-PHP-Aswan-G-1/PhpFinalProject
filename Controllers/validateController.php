<?php

namespace Controllers;

session_start();

use Models\user;

require_once('../vendor/autoload.php');

//////////////////// User - Validation //////////////////////////
$GLOBALS['userModel'] =  new user();
$GLOBALS['authController'] = new auth();
$GLOBALS['orderController'] = new orderController();

class validation
{
    public function RegistrationValidation()
    {
        if ($this->checkRequestMethod("POST")) {
            foreach ($_POST as $key => $value) {
                $$key = $value;
                $this->sanitizeInput($value);
            }
            ///validation of name
            if ($this->requiredVal($name)) {
                $errors[] = "name is required";
            } elseif ($this->minVal($name, 3)) {
                $errors[] = "name must be at lest 3 char ";
            }
            //validation of email 
            if ($this->requiredVal($email)) {
                $errors[] = "email  is required";
            } elseif ($this->emailVal($email)) {
                $errors[] = "invalid email ";
            }
            //validation of password 
            if ($this->requiredVal($password)) {
                $errors[] = "password is required";
            } elseif ($this->regex($password)) {
                $errors[] = "password must be from 8-16 and contains at least one digit and one upper case letter";
            }
            /// matching password
            if ($this->matching_password($password, $confirm_password)) {
                $errors[] = "passwords do not  match1! ";
            }
            // date expiration
            if ($this->requiredVal($date_expiration)) {
                $errors[] = "date expiration  is required";
            } elseif ($this->date_regex($date_expiration)) {
                $errors[] = "date expiration must be like this  MM/YY";
            }
            //validation of credit card 
            if ($this->requiredVal($credit_card)) {
                $errors[] = "credit card number is required";
            } elseif ($this->credit($credit_card)) {
                $errors[] = "credit card number must be 16 positve number";
            }
            if (!empty($errors)) {
                $_SESSION["errors"] = $errors;
                header("location:../Views/register.php");
            } else {
                if (!$GLOBALS['userModel']->getRowByKey('email', $_POST['email'])) {
                    if ($GLOBALS['authController']->register($_POST)) {
                        $_SESSION['username'] = $_POST['name'];
                        $_SESSION['email'] = $_POST['email'];
                        redirectToView('home');
                    } else {
                        $_SESSION["errors"] = ['An Error Occur'];
                        redirectToView('register');
                    }
                } else {
                    $_SESSION["errors"] = ['This Email Is exist'];
                    redirectToView('register');
                }
            }
        }
    }
    public function loginValidation()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $GLOBALS['authController']->login($_POST['email'], $_POST['password']);
        } else {
            redirectToView('login', 'All Credintials Are Required');
        }
    }
    public function checkRequestMethod($method)
    {
        if (isset($_SERVER["REQUEST_METHOD"]) == $method) {
            return true;
        } else {
            return false;
        }
    }

    public function sanitizeInput($input)
    {
        return trim(htmlspecialchars(htmlentities($input)));
    }

    public function requiredVal($input)
    {
        if (!empty($input)) {
            return false;
        } else {
            return true;
        }
    }

    public function minVal($input, $lenght)
    {
        if (strlen($input) < $lenght) {
            return true;
        }
        return false;
    }

    public function maxVal($input, $lenght)
    {
        if (strlen($input) > $lenght) {
            return true;
        }
        return false;
    }

    public function emailVal($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }
    public function matching_password($input1, $input2)
    {
        if ($input1 != $input2) {
            return true;
        }
        return false;
    }
    public function regex($input)
    {
        $regex = "/^(?=.*[A-Z])(?=.*\d).{8,16}+$/";
        if (!preg_match($regex, $input)) {
            return true;
        } else {
            return false;
        }
    }
    function credit($input)
    {
        $regex = "/^\d{16}$/";
        if (!preg_match($regex, $input)) {
            return true;
        } else {
            return false;
        }
    }
    ///  update this it not work yet
    function date_regex($input)
    {
        $regex = "/^[0-9]{4}-[0-1][0-9]$/";
        if (!preg_match($regex, $input)) {
            return true;
        } else {
            return false;
        }
    }
}

function redirectToView($view)
{
    header('Location:../Views/' . $view . '.php');
}

$validator = new Validation();
if(!empty($_POST)){
    if ($_POST['validationType'] == "login") {
        $validator->loginValidation();
    } elseif($_POST['validationType'] == "register") {
        $validator->RegistrationValidation($_POST);
    }
}else {
    $GLOBALS['authController']->logout();
}
