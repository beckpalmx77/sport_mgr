<?php

/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 13/6/2563
 * Time: 9:03
 */

include('config.php');

class database
{
    public function __construct()
    {
       $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
       if($this->connection->connect_errno)
            die("Error " . $this->connection->connect_error);
    }

    public function delete($id) {
        echo "I'm " . $id;
        //echo "I live in $this->homeTown\n";
    }
}

?>