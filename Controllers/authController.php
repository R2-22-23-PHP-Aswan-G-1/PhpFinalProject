<?php

namespace Controllers;
use Models\user as userModel;
require_once('../vendor/autoload.php');

$GLOBALS['userModel'] = new userModel();

class auth
{
    
    public function login($email, $password)
    {
        $user_data = $GLOBALS['userModel']->login($email, $password);
        if ($user_data) {
            $_SESSION["is_login"] = 'yes';
            $_SESSION["email"] = $user_data['email'];
            if (isset($_POST['rememberme'])) {
                setcookie('email', $_POST['email'], time() + 30 * 24 * 60 * 60, '/');
                setcookie('password', $_POST['password'], time() + 30 * 24 * 60 * 60, '/');
            } else {
                setcookie('email', $_POST['email'], time() - 30 * 24 * 60 * 60, '/');
                setcookie('password', $_POST['password'], time() - 30 * 24 * 60 * 60, '/');
            }
            $_SESSION['username'] = $user_data['name'];
            header('Location:../Views/home.php');
        } else {
            $_SESSION['errors'] = ['Enter Valid Data'];
            header('Location:../Views/login.php');
        }
    }

    public function register($arrayOfData)
    {    
        if($GLOBALS['userModel']->insertToDB($arrayOfData)){
            $_SESSION["is_login"] = 'yes';
            return true;
        }else {
            return false;
        }
    }

    public function logout(){
        unset($_SESSION['is_login']);
        header('Location:../Views/login.php');
    }

}
