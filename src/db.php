<?php

class Database {

  private $DB_HOST = "mysql-DB" ;
  private $DB_USER = "root" ;
  private $DB_PASS = "1234";
  private $DB_NAME = "My_db";


  protected function connect(){
    $conn = new mysqli_connect($this->$DB_HOST , $this->$DB_USER , $this->$DB_PASS , $this->$DB_NAME);
    return $conn;
  }

}

?>