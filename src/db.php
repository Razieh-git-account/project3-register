<?php

class Database {

  private $DB_HOST ;
  private $DB_USER ;
  private $DB_PASS ;
  private $DB_NAME ;


  public function connect(){
    $this->$DB_HOST = "mysql-DB" ;
    $this->$DB_USER = "root" ;
    $this->$DB_PASS = "1234";
    $this->$DB_NAME = "My_db";
    
    $conn = new mysqli_connect($this->$DB_HOST , $this->$DB_USER , $this->$DB_PASS , $this->$DB_NAME);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  }

}

?>