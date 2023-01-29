<?php

interface model{

    public function startConnection();
    public function getDataById();
    public function getCounter();
    public function insertToDB();
    public function updateInDB();

}

?>