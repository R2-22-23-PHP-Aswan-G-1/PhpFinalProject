<?php

namespace Models;

require_once('../config.php');

class order  extends model
{
    public function __construct()
    {
        $this->table = 'order';
        $this->startConnection();
    }
    public function getDownloadCounter($search_value)
    {
        $query = "select `counter` as `counter` from `order` where order_id = '$search_value'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $counter = mysqli_fetch_assoc($result);
            if ($counter['counter'] <= 6) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function increaseDownloadCounter($id)
    {
        $query = "UPDATE `order` SET `counter`= 
        (select `counter` from `order` where `user_id` = '$id') + 1
         WHERE `user_id` = '$id' ";
        $result = mysqli_query($this->conn, $query);
        if($result) {
            return true;
        }else {
            return false;
        }
    }
}
