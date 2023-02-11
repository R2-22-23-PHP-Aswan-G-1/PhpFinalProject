<?php

namespace Models;

require_once('../config.php');
abstract class model
{

    protected $table;
    protected $conn;
    public function startConnection()
    {
        $this->conn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function getRowByKey($key, $search_value)
    {
        $query = "select * from `$this->table` where `$key` = '$search_value'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $data_from_DB = mysqli_fetch_assoc($result);
            return $data_from_DB;
        } else {
            return false;
        }
    }

    public function closeConnection()
    {
        mysqli_close($this->conn);
    }
}
