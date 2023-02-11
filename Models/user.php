<?php
namespace Models;

require_once('../config.php');
class user extends model
{
    public function __construct()
    {
        $this->table ='user';
        $this->startConnection();
    }
    public function insertToDB($arr_values)
    {
        $password = password_hash($arr_values['password'], PASSWORD_DEFAULT);
        $name = $arr_values['name'];
        $exp_date = $arr_values['date_expiration'];
        $email = $arr_values['email'];
        var_dump([$name , $password , $email , $exp_date]);
        $query = "INSERT INTO `user`(`name`, `email`, `password` ,`exp_date`)
         VALUES ('$name','$email','$password' , '$exp_date')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $query = "select * from `user` where email = '$email'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user_data_from_DB = mysqli_fetch_assoc($result);
            if(password_verify($password , $user_data_from_DB['password'])) {
                return $user_data_from_DB;
            }        
            return false;
        }
        return false;
    }
}

?>