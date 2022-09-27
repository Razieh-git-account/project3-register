<?php

define('DB_HOST','mysql-DB');
define('DB_USER','root');
define('DB_PASS','1234');
define('DB_NAME','My_db');
define('TABLE_NAME','Users');

class Database {
  public function __construct(){
   
    $conn = new mysqli(DB_HOST , DB_USER , DB_PASS ,DB_NAME);
    if($conn->connect_error)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        //echo "Database Connected Successfully";
        return $this->conn = $conn;
    }
}


?>
