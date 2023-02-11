<?php
namespace Controllers;
require_once('../vendor/autoload.php');
session_start();
use Models\order as orderModel;
use Models\user as userModel;

$GLOBALS['orderModel']= new orderModel();
$GLOBALS['userModel']= new userModel();

class orderController {

    public function getCounter()
    {
        $userData = $GLOBALS['userModel']->getRowByKey('email' ,$_SESSION['email']);
        // var_dump($GLOBALS['orderModel']->getDownloadCounter($userData['id']));
        return $GLOBALS['orderModel']->getDownloadCounter($userData['id']);
    }   

    public function increaseCounter(){

        $userData = $GLOBALS['userModel']->getRowByKey('email' ,$_SESSION['email']);
        $GLOBALS['orderModel']->increaseDownloadCounter($userData['id']);
    }
}
?>