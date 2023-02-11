<?php
namespace Models;

require_once('../config.php');
class product extends model
{
    public function __construct()
    {
         $this->table = 'product';
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    public function changeFileName(){
        $newFileName =bin2hex(random_bytes(5));
        $query ="UPDATE `product` SET `product_link`='$newFileName' WHERE 1";
        $result = mysqli_query($this->conn, $query);
        if($result) {
            return $newFileName;
        }else {
            return false;
        }
}
}
