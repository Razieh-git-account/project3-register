<?php

class Database {

  private $DB_HOST = "mysql-DB"  ;
  private $DB_USER = "root" ;
  private $DB_PASS = "1234" ;
  private $DB_NAME = "My_db" ;
  private $TABLE_NAME = "Users" ;



  public function connect(){
   
    $conn =mysqli_connect($this->DB_HOST , $this->DB_USER , $this->DB_PASS , $this->DB_NAME);
    return $conn;
  }

  public function saveRecord($n , $e , $p){
    $con = $this->connect();
    mysqli_query($con , "INSERT INTO ".$this->TABLE_NAME."(name , email, password) VALUES ('$n' , '$e' , '$p')") 
    or die(mysqli_error($con));
    header('Location: ok.php');
  }

}

?>